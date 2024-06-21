<?php
include 'config.php';
include 'Photo.php';

session_start();

$photoObj = new Photo($db);
if (isset($_SESSION['user_id'])) {
    $photos = $photoObj->getUserPhotos($_SESSION['user_id']);
} else {
    $photos = $photoObj->getAllPublicPhotos();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Photos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            margin-bottom: 20px;
        }
        .header a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }
        .gallery-item {
            flex: 1 0 21%;
            box-sizing: border-box;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .gallery-item img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .gallery-item .details {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            text-decoration: none;
            color: #333;
            margin-right: 5px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        @media (max-width: 1200px) {
            .gallery-item {
                flex: 1 0 45%; /* 2 items per row */
            }
        }
        @media (max-width: 768px) {
            .gallery-item {
                flex: 1 0 100%; /* 1 item per row */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Photo Gallery</h2>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="add_photo.php">Add Photo</a>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </div>
        <div class="gallery">
            <?php if (!empty($photos)) { ?>
                <?php foreach ($photos as $photo) { ?>
                <div class="gallery-item">
                    <img src="uploads/<?php echo $photo['file_name']; ?>" alt="Photo">
                    <div class="details">
                        <p>Uploaded by: <?php echo $photo['username']; ?></p>
                        <p>Date: <?php echo date('F j, Y, g:i a', strtotime($photo['uploaded_on'])); ?></p>
                        <p>Visibility: <?php echo ucfirst($photo['visibility']); ?></p>
                    </div>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $photo['user_id']) { ?>
                    <div class="actions">
                        <a href="edit_photo.php?id=<?php echo $photo['id']; ?>">Edit</a>
                        <a href="delete_photo.php?id=<?php echo $photo['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } else { ?>
                <p>No photos found...</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
