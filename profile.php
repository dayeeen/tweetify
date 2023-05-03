<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require "functions.php";
$twitter = new Profile();
$profile = $twitter->display($_SESSION["id"]);
$twitter->post($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="img/logo.png">
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
    <h1>Edit profile</h1>
    <div class="edit-profile">
        <form action="" method="post">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="<?= $p['first_name']; ?>">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="<?= $p['last_name']; ?>">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $p['username']; ?>">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $p['email']; ?>">
            <label for="bio">Bio</label>
            <input type="text" name="bio" id="bio" value="<?= $p['bio']; ?>">
            <button type="submit" name="update">Submit</button>
        </form>
    </div>
</body>

</html>