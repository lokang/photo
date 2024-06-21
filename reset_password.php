<?php
include 'config.php';
include 'User.php';

$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $userId = $userObj->verifyPasswordResetToken($token);
    if ($userId) {
        $userObj->updatePassword($userId, $newPassword);
        echo "Your password has been reset successfully. <a href='login.php'>Login here</a>";
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
