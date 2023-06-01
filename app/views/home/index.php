<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login");
    exit;
}
$twt = new Tweetify();
$profile = new Setting();
$profile->displayProfile($_SESSION["id"]);
$pro = $profile->displayProfile($_SESSION["id"]);
$twt->post($_POST);
$twt->delete($_POST);
$tweets = $twt->display($_POST);
?>


    <header>
        <nav class="navbar navbar-custom navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="home">
                    <!-- onclick swalfire -->
                    <span class="navbar-brand-text">
                        Tweetify
                    </span>
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
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/home">
                                <i class="icon fa-solid fa-house">
                                    <span class="navbar-toggler-text">
                                        Home
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/profile">
                                <i class="icon fa-solid fa-user">
                                    <span class="navbar-toggler-text">
                                        Profile
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">
                                <i class="icon fa-solid fa-message">
                                    <span class="navbar-toggler-text">
                                        Messages
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/notifications">
                                <i class="icon fa-solid fa-bell">
                                    <span class="navbar-toggler-text">
                                        Notifications
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/settings">
                                <i class="icon fa-solid fa-gear">
                                    <span class="navbar-toggler-text">
                                        Setting
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>/bookmarks" id="">
                                <i class="icon fa-solid fa-bookmark">
                                    <span class="navbar-toggler-text">
                                        Bookmarks
                                    </span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout" id="logout-link">
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
                    <ul class="trending-list">
                        <!-- data dummy for trending things -->
                        <li><a href="#">Trending Topic 1</a></li>
                        <li><a href="#">Trending Topic 2</a></li>
                        <li><a href="#">Trending Topic 3</a></li>
                    </ul>
                </div>
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
                <div class="sidebar-item">
                    <a href="#">
                        <i class="fa fa-hashtag"></i>
                        <span>Who to follow?</span>
                    </a>
                    <ul class="trending-list">
                        <!-- data dummy for trending things -->
                        <li><a href="#">User 1</a></li>
                        <li><a href="#">User 2</a></li>
                        <li><a href="#">User 3</a></li>
                    </ul>
                </div>
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
            <!-- bagian utama -->
            <div class="content">
                <div class="tweet-box">
                    <!-- avatar icon -->
                    <div class="tweet-box-head">
                        <!-- username berdasarkan id yang login -->
                        <?php foreach ($pro as $u): ?>
                            <img src="img/white-avatar.png" alt="avatar" class="avatar">
                            <span class="username">
                                <?= $u['username']; ?>
                            </span>
                            <!-- Jika akun premium, maka akan mendapat centang -->
                            <?php if ($u['acc_type'] == 1): ?>
                                <i class="fa fa-check-circle"></i>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="tweet-box-body">
                        <form action="" method="post">
                            <textarea name="tweet" id="tweet" cols="2" rows="3" placeholder="What's happening, <?= $data['nama']; ?>?"
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
                        <div class="tweet-container">
                            <div class="tweet-list-head">
                                <div class="tweet-head-left">
                                    <img src="img/black-avatar.png" alt="" width="30px">
                                    <span class="head-usn">
                                        <?= $tweet['nickname'] ?>
                                        <!-- Jika akun premium, maka akan mendapat centang -->
                                        <?php if ($tweet['acc_type'] == 1): ?>
                                            <i class="fa fa-check-circle"></i>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="tweet-head-right">
                                    <!-- Jika user adalah user yang sedang login, maka tampilkan opsi crud -->
                                    <?php if ($tweet['user_id'] == $_SESSION["id"]): ?>
                                        <!-- Buat dropdown untuk menampilkan edit dan delete -->
                                        <div class="btn-group dropstart">
                                            <button class="btn btn-secondary bg-transparent border-0" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                <li>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                        <button type="submit" name="edit-tweet"
                                                            class="dropdown-item">Edit</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                        <button type="submit" name="delete-tweet"
                                                            class="dropdown-item">Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                        <button type="submit" name="report-tweet"
                                                            class="dropdown-item">Report</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tweet-list-body">
                                <p>
                                    <?= $tweet['tweet_text'] ?>
                                </p>
                            </div>
                            <div class="tweet-list-footer">
                                <div class="tweet-list-footer-left">
                                    <ul class="action-buttons">
                                        <li>
                                            <?php $twt->reply($_POST) ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                                                <button class="replied bg-transparent border-0" type="submit"
                                                    name="reply-tweet" onclick="changeColor(this)">
                                                    <span class="icon-wrapper">
                                                        <i class="fa fa-comment"></i>
                                                    </span>
                                                    <span>0</span>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <?php $twt->retweet($_POST) ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                                                <button class="bg-transparent border-0" type="submit" name="retweet"
                                                    onclick="changeColor(this)">
                                                    <span class="icon-wrapper">
                                                        <i class="fa fa-retweet"></i>
                                                    </span>
                                                    <span>0</span>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <?php $likes = $twt->displayLike($_POST); ?>
                                            <form id="like-form-<?= $tweet['id'] ?>" action="" method="post">
                                                <input type="hidden" name="id" value="<?= $tweet['id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                                                <button class="bg-transparent border-0 like-button" type="button"
                                                    data-tweet-id="<?= $tweet['id'] ?>">
                                                    <span class="icon-wrapper">
                                                        <i class="fa fa-heart"></i>
                                                    </span>
                                                    <span class="like-count" id="like-count">
                                                        <?= $likes ?>
                                                    </span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tweet-list-footer-right">
                                    <p>
                                        <?= $tweet['created_at'] ?>
                                    </p>
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scripts.js"></script>
