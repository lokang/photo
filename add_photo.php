<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Photo</title>
</head>
<body>
    <h2>Add Photo</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose a photo to upload:</label>
        <input type="file" name="file" id="file" required><br>
        <label for="visibility">Visibility:</label>
        <select name="visibility" id="visibility">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select><br>
        <input type="submit" name="submit" value="Upload">
    </form>
    <a href="index.php">View Photos</a>
    <a href="logout.php">Logout</a>
</body>
</html>
