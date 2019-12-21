<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/fontAwesome.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css?<?= rand(1,100)?>">
    <script src="/js/custom.js?<?= rand(1,100)?>"></script>
    <title>photo || <?=$title ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="/home/index">Photo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <a class="btn btn-success" href="/account/upload">Upload</a>
        </ul>
        <?php if($this->isAdmin()) :?>
        <a class="btn btn-outline-secondary my-2 my-sm-0 mr-2" href="/admin/users">Users</a>
        <?php endif; ?>
        <?php if($this->auth):?>
            <a class="btn btn-outline-secondary my-2 my-sm-0 mr-2" href="/account/photos/<?=$this->auth['id'] ?>">My Photos</a>
            <a class="btn btn-outline-secondary my-2 my-sm-0 mr-2" href="/account/profile">Profile</a>
            <a class="btn btn-outline-success my-2 my-sm-0 mr-2" href="/account/index">Account</a>
            <a class="btn btn-danger my-2 my-sm-0 " href="/account/logout">Logout</a>
        <?php else: ?>
            <a class="btn btn-outline-success my-2 my-sm-0 mr-2" href="/home/login">Login</a>
            <a class="btn btn-outline-success my-2 my-sm-0 " href="/home/register">Register</a>
        <?php endIf ?>
    </div>
    </div>
</nav>

