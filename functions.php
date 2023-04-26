<?php
require "class.php";
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
            $email = strtolower(stripslashes($data["email"]));
            $password = mysqli_real_escape_string($this->getConn(), $data["password"]);
            $password2 = mysqli_real_escape_string($this->getConn(), $data["password2"]);

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
            mysqli_query($this->getConn(), "INSERT INTO users (id, username, first_name, last_name, email, password) 
            VALUES('', '$username', '$firstname', '$lastname', '$email', '$password')");

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
                    $_SESSION["id"] = $row["id"]; // tambahkan kode ini
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["acc_type"] = $row["acc_type"];

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
                    alert('Username atau Password Salah!');
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
                mysqli_query($this->getConn(), "INSERT INTO tweets (user_id, tweet_text) VALUES('$id', '$tweet')");

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

    // fungsi untuk menampilkan tweet
    function display($data)
    {
        $query = "SELECT tweets.id, tweets.user_id, tweets.tweet_text, tweets.created_at, users.username, users.acc_type
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

    // fungsi hapus tweet
    function delete($id)
    {
        
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
        $result = mysqli_query($this->getConn(), "SElECT * FROM users");
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    //Fungsi Display Profile
    function display($data)
    {
        $query = "SELECT username, first_name, last_name, email, acc_type, bio FROM users WHERE id = '$data'";
        $result = mysqli_query($this->getConn(), $query);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }
    
    function post($data){

    }
    function delete($id){

    }
}

?>