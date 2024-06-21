<?php
class User {
    private $db;
    private $table = 'users';

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $passwordHash);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT id, password FROM {$this->table} WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $passwordHash);
        $stmt->fetch();
        if (password_verify($password, $passwordHash)) {
            return $id;
        } else {
            return false;
        }
    }

    public function setPasswordResetToken($email, $token) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET reset_token = ? WHERE email = ?");
        $stmt->bind_param('ss', $token, $email);
        return $stmt->execute();
    }

    public function verifyPasswordResetToken($token) {
        $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE reset_token = ?");
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }

    public function updatePassword($id, $newPassword) {
        $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password = ?, reset_token = NULL WHERE id = ?");
        $stmt->bind_param('si', $passwordHash, $id);
        return $stmt->execute();
    }
}
?>
