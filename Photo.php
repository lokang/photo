<?php
class Photo {
    private $db;
    private $table = 'photos';

    public function __construct($db) {
        $this->db = $db;
    }

    public function upload($file, $userId, $visibility) {
        $statusMsg = '';
        $targetDir = "uploads/";
        $fileName = basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (!empty($file["name"])) {
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $insert = $this->db->query("INSERT INTO {$this->table} (user_id, file_name, uploaded_on, visibility) VALUES ('" . $userId . "', '" . $fileName . "', NOW(), '" . $visibility . "')");
                    if ($insert) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        return $statusMsg;
    }

   public function getAllPublicPhotos() {
    $query = $this->db->query("SELECT p.*, u.username, u.email FROM {$this->table} p JOIN users u ON p.user_id = u.id WHERE p.visibility = 'public' ORDER BY p.uploaded_on DESC");
    return $query->fetch_all(MYSQLI_ASSOC);
}

public function getUserPhotos($userId) {
    $query = $this->db->query("SELECT p.*, u.username, u.email FROM {$this->table} p JOIN users u ON p.user_id = u.id WHERE p.user_id = $userId ORDER BY p.uploaded_on DESC");
    return $query->fetch_all(MYSQLI_ASSOC);
}


    public function getPhoto($id) {
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE id = $id");
        return $query->fetch_assoc();
    }

    public function updatePhoto($id, $file, $visibility) {
        $statusMsg = '';
        $targetDir = "uploads/";
        $fileName = basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (!empty($file["name"])) {
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $update = $this->db->query("UPDATE {$this->table} SET file_name = '" . $fileName . "', uploaded_on = NOW(), visibility = '" . $visibility . "' WHERE id = $id");
                    if ($update) {
                        $statusMsg = "The file " . $fileName . " has been updated successfully.";
                    } else {
                        $statusMsg = "File update failed, please try again.";
                    }
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        return $statusMsg;
    }

    public function deletePhoto($id) {
        $photo = $this->getPhoto($id);
        if ($photo) {
            unlink("uploads/" . $photo['file_name']);
            $delete = $this->db->query("DELETE FROM {$this->table} WHERE id = $id");
            return $delete ? true : false;
        } else {
            return false;
        }
    }
}
?>
