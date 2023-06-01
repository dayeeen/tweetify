<?php 
class Database
{
    //gunakan encapsulation
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tweetify";
    public $conn;

    function setHost($host)
    {
        $this->host = $host;
    }
    function getHost()
    {
        return $this->host;
    }
    function getUsername()
    {
        return $this->username;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getDb_name()
    {
        return $this->db_name;
    }
    function getConn()
    {
        return $this->conn;
    }
    function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
    }
}
// Penerapan Abstract Class
abstract class UserManager extends Database
{
    public string $username;
    public string $password;
    public string $email;
    abstract public function register($data);
    abstract public function cekCookie();
    abstract public function login();
    abstract public function logout();
}

// Penerapan Interface
interface TweetManager
{
    function query();
    function post($data);
    function display($data);
    function delete($data);
}


// fitur tweets
interface FiturTweet {
    function like($data);
    function retweet($data);
    function reply($data);
    function bookmark($data);
}
?>