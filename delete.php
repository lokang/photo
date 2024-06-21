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
    echo "You do not have permission to delete this photo.";
    exit();
}

if ($photoObj->deletePhoto($id)) {
    echo "Photo deleted successfully.";
} else {
    echo "Failed to delete the photo.";
}
header("Location: view_photos.php");
?>
