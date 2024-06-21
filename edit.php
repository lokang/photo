<?php
include 'config.php';
include 'Photo.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$photoObj = new Photo($db);
$id = $_GET['id'];
$photo = $photoObj->getPhoto($id);

if ($photo['user_id'] != $_SESSION['user_id']) {
    echo "You do not have permission to edit this photo.";
    exit();
}

if (isset($_POST['submit'])) {
    $statusMsg = $photoObj->updatePhoto($id, $_FILES['file']);
    echo $statusMsg;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Photo</title>
</head>
<body>
    <h2>Edit Photo</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Choose a photo to upload:</label>
        <input type="file" name="file" id="file" required>
        <input type="submit" name="submit" value="Upload">
    </form>
    <a href="index.php">View Photos</a>
</body>
</html>
