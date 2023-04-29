<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$twt = new Twitter();
$twt->post($_POST);
$twt->delete($_POST);
$tweets = $twt->display($_POST);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-custom navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" alt="" width="40" height="36" class="d-inline-block align-text-top">
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="icon fa-solid fa-house">
                                    <span class="navbar-toggler-text">
                                        Home
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile.php">
                                <i class="icon fa-solid fa-user">
                                    <span class="navbar-toggler-text">
                                        Profile
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="icon fa-solid fa-message">
                                    <span class="navbar-toggler-text">
                                        Messages
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="icon fa-solid fa-bell">
                                    <span class="navbar-toggler-text">
                                        Notifications
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" id="">
                                <i class="icon fa-solid fa-gear">
                                    <span class="navbar-toggler-text">
                                        Setting
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" id="">
                                <i class="icon fa-solid fa-bookmark">
                                    <span class="navbar-toggler-text">
                                        Bookmarks
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php" id="logout-link">
                                <i class="icon fa-solid fa-right-from-bracket">
                                    <span class="navbar-toggler-text">
                                        Logout
                                    </span>
                                </i>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="POST">
                        <input class="form-control me-2" name="keyword" type="search" placeholder="@username"
                            aria-label="Search">
                        <button class="btn btn-outline-success" name="cari" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="sidebar">
                <div class="sidebar-item">
                    <a href="#">
                        <i class="fa fa-hashtag"></i>
                        <span>What's Trending?</span>
                    </a>
                </div>
                <ul class="trending-list">
                    <!-- data dummy for trending things -->
                    <li><a href="#">Trending Topic 1</a></li>
                    <li><a href="#">Trending Topic 2</a></li>
                    <li><a href="#">Trending Topic 3</a></li>
                </ul>
                <br>
                <div class="sidebar-item">
                    <a href="#">
                        <i class="fa fa-hashtag"></i>
                        <span>Data dummy lainnya</span>
                    </a>
                </div>
                <ul class="trending-list">
                    <!-- data dummy for trending things -->
                    <li><a href="#">Data 1</a></li>
                    <li><a href="#">Data 2</a></li>
                    <li><a href="#">Data 3</a></li>
                </ul>
            </div>
            <div class="sidebar-2">
                <div class="sidebar-item-2">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Who's Online?</span>
                    </a>
                </div>
                <ul>
                    <!-- data dummy for online users -->
                    <li><a href="#">Online User 1</a></li>
                    <li><a href="#">Online User 2</a></li>
                    <li><a href="#">Online User 3</a></li>
                </ul>
            </div>
            <!-- bagian utama -->
            <div class="content">
                <div class="tweet-box">
                    <!-- avatar icon -->
                    <div class="tweet-box-head">
                        <img src="img/dayen.png" alt="" width="30px">
                        <!-- username berdasarkan id yang login -->
                        <span class="username">
                            <?= $_SESSION['username']; ?>
                        </span>
                    </div>
                    <div class="tweet-box-body">
                        <form action="" method="post">
                            <textarea name="tweet" id="tweet" cols="2" rows="3" placeholder="What's happening?"
                                maxlength="280"></textarea>
                            <div class="tweet-box-footer">
                                <div class="tweet-footer-left">
                                    <i class="fa fa-image"></i>
                                    <i class="fa fa-gif"></i>
                                    <i class="fa fa-bar-chart"></i>
                                    <i class="fa fa-smile"></i>
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="tweet-footer-right">
                                    <button type="submit" name="post">Tweet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tweet-list">
                    <!-- ambil data dari query -->
                    <?php foreach ($tweets as $tweet): ?>
                        <div class="tweet-list-head">
                            <div class="tweet-head-left">
                                <img src="img/dayen.png" alt="" width="30px">
                                <span class="head-usn">
                                    <?= $tweet['username']?>
                                    <!-- Jika akun premium, maka akan mendapat centang -->
                                    <?php if ($tweet['acc_type'] == 1): ?>
                                        <i class="fa fa-check-circle"></i>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="tweet-head-right">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash">
                                    <a href="delete.php?id=<?= $tweet['id'] ?>"></a>
                                </i>
                            </div>
                        </div>
                        <div class="tweet-list-body">
                            <p>
                                <?= $tweet['tweet_text'] ?>
                            </p>
                        </div>
                        <div class="tweet-list-footer">
                            <div class="tweet-footer-left">
                                <i class="fa fa-comment"></i>
                                <i class="fa fa-retweet"></i>
                                <i class="fa fa-heart"></i>
                                <i class="fa fa-share"></i>
                            </div>
                            <div class="tweet-footer-right">
                                <p>
                                    <?= $tweet['created_at'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        </div>

    </main>
    <!-- script bootstrap & js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>