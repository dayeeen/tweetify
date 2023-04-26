<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require "functions.php";
$twitter = new Profile();
$profile = $twitter->display($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <h1>Profile</h1>
    <?php foreach ($profile as $p): ?>
        <div class="profile">
            <p> Nama Lengkap :
                <?= $p['first_name'] . ' ' . $p['last_name']; ?>
            </p>
            <p> Username :
                <?= $p['username']; ?>
            </p>
            <p> Email :
                <?= $p['email']; ?>
            </p>
            <p> Bio :
                <?= $p['bio']; ?>
            </p>
        </div>
    <?php endforeach; ?>
</body>

</html>