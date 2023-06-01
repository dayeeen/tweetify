<?php
session_start();
require '../app/lib/functions.php';
//inisiasi objek
$twt = new Tweetify();
//cek cookie
$twt->cekCookie();
//panggil fungsi register
$twt->register($_POST);
//jika tombol register ditekan

//panggil fungsi login
$twt->login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/logo.png">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <html lang="en">

    <body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <div id="form">
            <div class="container">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="active"><a href="#signup" role="tab" data-toggle="tab">Sign up</a></li>
                            <li><a href="#login" role="tab" data-toggle="tab">Log in</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="signup">
                                <h2 class="text-uppercase text-center"> Sign Up for Free</h2>
                                <form id="signup" method="post">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name<span class="req">*</span> </label>
                                                <input type="text" name="firstname" class="form-control" id="first_name"
                                                    required data-validation-required-message="Please enter your name."
                                                    autocomplete="off" maxlength="10">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label> Last Name<span class="req">*</span> </label>
                                                <input type="text" name="lastname" class="form-control" id="last_name"
                                                    required data-validation-required-message="Please enter your name."
                                                    autocomplete="off" maxlength="20">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> Your Nickname<span class="req">*</span> </label>
                                        <input type="text" name="nickname" class="form-control" id="nickname" required
                                            data-validation-required-message="Please enter your nickname."
                                            autocomplete="off" maxlength="20">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label> Your Username<span class="req">*</span> </label>
                                        <input type="text" name="username" class="form-control" id="username" required
                                            data-validation-required-message="Please enter your username."
                                            autocomplete="off" maxlength="12">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label> Your Email<span class="req">*</span> </label>
                                        <input type="email" name="email" class="form-control" id="email" required
                                            data-validation-required-message="Please enter your email address."
                                            autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label> Password<span class="req">*</span> </label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" required
                                                    data-validation-required-message="Please enter your password"
                                                    autocomplete="off">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label> Confirm Password<span class="req">*</span> </label>
                                                <input type="password" name="password2" class="form-control"
                                                    id="password" required
                                                    data-validation-required-message="Please enter your password"
                                                    autocomplete="off">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mrgn-30-top">
                                        <button type="submit" name="register" class="btn btn-larger btn-block" />
                                        Sign up
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="login">
                                <h2 class="text-uppercase text-center"> Log in</h2>
                                <form id="login" method="post">
                                    <div class="form-group">
                                        <label for="username"> Username<span class="req">*</span> </label>
                                        <input type="text" name="username" class="form-control" id="username" required
                                            data-validation-required-message="Please enter your username"
                                            autocomplete="off" maxlength="12">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"> Password<span class="req">*</span> </label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required data-validation-required-message="Please enter your password"
                                            autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <!-- checkbox remember me -->
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" value="remember-me"> Remember me
                                        </label>
                                    </div>
                                    <div class="mrgn-30-top">
                                        <button type="submit" name="login" class="btn btn-larger btn-block" />
                                        Log in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
    <!-- partial -->
    <script src="js/scripts.js"></script>
</body>

</html>