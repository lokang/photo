<?php
include 'config.php';
include 'User.php';

session_start();

$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userId = $userObj->login($email, $password);
    if ($userId) {
        $_SESSION['user_id'] = $userId;
        header('Location: index.php');
    } else {
        echo "Login failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="forgot_password.php">Forgot Password?</a>
</body>
</html>
