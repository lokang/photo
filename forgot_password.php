<?php
include 'config.php';
include 'User.php';

$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a secure token
    $userObj->setPasswordResetToken($email, $token);

    // Send password reset email
    $resetLink = "http://photo.lokang.com/reset_password.php?token=$token";
    mail($email, "Password Reset", "Click on this link to reset your password: $resetLink");

    echo "A password reset link has been sent to your email.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <input type="submit" value="Send Reset Link">
    </form>
</body>
</html>
