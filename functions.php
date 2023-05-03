<?php
require "class.php";

// Class Twitter ini banyak mengatur tentang fungsi query, register, login, logout, dan cekCookie
// Ditambah dengan adanya fungsi post, display, dan delete yang merupakan implementasi dari interface TweetManager
class Twitter extends UserManager implements TweetManager
{
    //fungsi query untuk menampilkan data
    function query()
    {
        $result = mysqli_query($this->getConn(), "SElECT * FROM users");
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    //fungsi register
    function register($data)
    {
        if (isset($_POST["register"])) {
            $username = strtolower(stripslashes($data["username"]));
            $firstname = ucfirst(strtolower(stripslashes($data["firstname"])));
            $lastname = ucfirst(strtolower(stripslashes($data["lastname"])));
            $nickname = strtolower(stripslashes($data["nickname"]));
            $email = strtolower(stripslashes($data["email"]));
            $password = mysqli_real_escape_string($this->getConn(), $data["password"]);
            $password2 = mysqli_real_escape_string($this->getConn(), $data["password2"]);
            $joinDate = date("Y-m-d H:i:s");
            // cek username sudah ada atau belum
            $result = mysqli_query($this->getConn(), "SELECT username FROM users WHERE username = '$username'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                alert('username sudah terdaftar!');
                </script>";
                return false;
            }
            // cek konfirmasi password
            if ($password !== $password2) {
                echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
                return false;
            }
            // enkripsi password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // tambahkan user baru ke database
            mysqli_query($this->getConn(), "INSERT INTO users (id, username, nickname, first_name, last_name, email, password, join_date) 
            VALUES('', '$username', '$nickname', '$firstname', '$lastname', '$email', '$password', '$joinDate')");

            if (mysqli_affected_rows($this->getConn()) == 1) {
                echo "<script>
        alert('user baru berhasil ditambahkan!');
    </script>";
            } else {
                echo "<script>
        alert('gagal menambahkan user baru: " . mysqli_error($this->getConn()) . "');
    </script>";
                return false;
            }
            return mysqli_affected_rows($this->getConn());

        }
    }

    //fungsi login
    function login()
    {
        //jika tombol login ditekan
        if (isset($_SESSION['login'])) {
            header("Location: index.php");
            exit;
        }

        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // cek username
            $result = mysqli_query($this->getConn(), "SELECT * FROM users WHERE username = '$username'");
            // cek apakah username ada atau tidak
            if (mysqli_num_rows($result) === 1) {
                // cek password
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row["password"])) {
                    // set session
                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["acc_type"] = $row["acc_type"];
                    // Maksud variable session di atas adalah untuk menyimpan data user yang sedang login
                    // id, username, dan acc_type akan digunakan untuk menampilkan data user yang sedang login

                    // cek remember me
                    if (isset($_POST['remember'])) {
                        // buat cookie
                        setcookie('id', $row['id'], time() + 60);
                        setcookie('key', hash('sha256', $row['username']), time() + 60);
                    }

                    header("Location: index.php");
                    exit;
                }
            }
            //jika username dan password salah, maka akan muncul alert
            $error = true;
            echo "<script>
            alert('username / password salah!');
            </script>";
        }
    }

    //fungsi cookie untuk mengingat login
    function cekCookie()
    {
        if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
            $id = $_COOKIE['id'];
            $key = $_COOKIE['key'];

            // ambil username berdasarkan id
            $result = mysqli_query($this->getConn(), "SELECT username FROM users WHERE id = $id");
            $row = mysqli_fetch_assoc($result);

            // cek cookie dan username
            if ($key === hash('sha256', $row['username'])) {
                $_SESSION['login'] = true;
            }
        }
    }

    // fungsi posting tweet
    function post($data)
    {
        if (isset($_POST["post"])) {
            $tweet = $data["tweet"];
            // mengambil id user yang login dari session
            $id = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
            // Ketika ngepost tweet, nyimpen session user_id
            $_SESSION["user_id"] = $id;
            if ($id) {
                // tambahkan tweet baru ke database
                mysqli_query($this->getConn(), "INSERT INTO tweets (user_id, tweet_text, created_at) VALUES('$id', '$tweet', NOW())");

                if (mysqli_affected_rows($this->getConn()) == 1) {
                    echo "<script>
                        alert('tweet berhasil ditambahkan!');
                      </script>";
                } else {
                    echo "<script>
                        alert('gagal menambahkan tweet: " . mysqli_error($this->getConn()) . "');
                      </script>";
                    return false;
                }
                return mysqli_affected_rows($this->getConn());
            } else {
                echo "<script>
                    alert('Silahkan login untuk menambahkan tweet!');
                  </script>";
            }
        }
    }

    // Fungsi Edit Tweet
    function edit($data)
    {
        if (isset($_POST["edit-tweet"])) {
            $tweet = $data["tweet"];
            $id = $data["id"];
            mysqli_query($this->getConn(), "UPDATE tweets SET tweet_text = '$tweet' WHERE id = $id");
            if (mysqli_affected_rows($this->getConn()) == 1) {
                echo "<script>
                alert('tweet berhasil diubah!');
                </script>";
            } else {
                echo "<script>
                alert('gagal mengubah tweet: " . mysqli_error($this->getConn()) . "');
                </script>";
                return false;
            }
            return mysqli_affected_rows($this->getConn());
        }
    }

    // fungsi hapus tweet
    function delete($id)
    {
        if (isset($_POST["delete-tweet"])) {
            $id = $_POST["id"];
            mysqli_query($this->getConn(), "DELETE FROM tweets WHERE id = $id");
            if (mysqli_affected_rows($this->getConn()) == 1) {
                echo "<script type='text/javascript'>
                alert('tweet berhasil dihapus!');
            </script>";
            } else {
                echo "<script>
                    alert('gagal menghapus tweet: " . mysqli_error($this->getConn()) . "');
                </script>";
                return false;
            }
            return mysqli_affected_rows($this->getConn());
        }
    }

    // fungsi untuk menampilkan tweet
    function display($data)
    {
        $query = "SELECT tweets.id, tweets.user_id, tweets.tweet_text, tweets.created_at, users.username, users.nickname, users.acc_type
              FROM tweets 
              INNER JOIN users ON tweets.user_id = users.id 
              ORDER BY created_at DESC";

        $result = mysqli_query($this->getConn(), $query);
        $tweets = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tweets[] = $row;
        }
        return $tweets;
    }

    //fungsi logout
    function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie('id', '', time() - 3600);
        setcookie('key', '', time() - 3600);

        header("Location: login.php");
        exit;
    }
}

class Profile extends Database implements TweetManager
{
    function query()
    {

    }
    //Fungsi Display Profile
    //Fungsi ini dijalankan pada halaman profile.php
    function display($data)
    {
        $query = "SELECT username, first_name, last_name, email, acc_type, bio FROM users WHERE id = '$data'";
        $result = mysqli_query($this->getConn(), $query);
        // Query dapat darimana?
        // Query diambil dari database, yang isinya adalah data user yang sedang login
        // Jadi, query ini akan mengambil data user yang sedang login

        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }

    //Fungsi post disini dioverride menjadi update profile
    function post($data)
    {
        if (isset($_POST["update"])) {
            $firstname = $_POST["first_name"];
            $lastname = $_POST["last_name"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $bio = $_POST["bio"];
            $id = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
            // ketika update profile, nyimpen session user_id
            $_SESSION["user_id"] = $id;
            if ($id) {
                // Update profile ke database
                mysqli_query($this->getConn(), "UPDATE users SET first_name = '$firstname', last_name = '$lastname', username =  '$username', email = '$email', bio = '$bio' WHERE id = '$id'");

                if (mysqli_affected_rows($this->getConn()) == 1) {
                    echo "<script>
                        alert('Profile berhasil diupdate!');
                        window.location.href='profile.php';
                      </script>";
                } else {
                    echo "<script>
                        alert('gagal mengupdate profile: " . mysqli_error($this->getConn()) . "');
                        window.location.href='profile.php';
                      </script>";
                    return false;
                }
            } else {
                echo "<script>
                    alert('Silahkan login untuk mengupdate profile!');
                    window.location.href='profile.php';
                  </script>";
            }
            // Kenapa window.location.href='profile.php'?
            // Karena setelah update profile, user akan diarahkan ke halaman profile.php
            // Jadi, setelah update profile, user akan melihat profile yang sudah diupdate
            // Selain itu, penggunaan header("Location: profile.php") kurang cocok
            // karena tidak menampilkan alert, sehingga user tidak tahu bahwa profile sudah diupdate
        }
    }

    //Fungsi delete disini dioverride menjadi delete profile
    //Atau bisa juga untuk delete atribut foto profil dan bio
    function delete($id)
    {

    }
}

?>