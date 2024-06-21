<?php
include 'config.php';
include 'Photo.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$photoObj = new Photo($db);

if (isset($_POST['submit'])) {
    $visibility = $_POST['visibility'];
    $statusMsg = $photoObj->upload($_FILES['file'], $_SESSION['user_id'], $visibility);
    echo $statusMsg;
}
?>
