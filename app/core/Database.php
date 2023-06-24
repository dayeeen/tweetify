<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $dbh;
    private $stmt;

    // constructor database
    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->name;

        // option
        $option = [
                // persistent connection
                // untuk menghindari koneksi ke database terus menerus
            PDO::ATTR_PERSISTENT => true,
                // error mode
                // untuk menampilkan error
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // check connection
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // function untuk menjalankan query
    public function query($query)
    {
        // prepare statement
        $this->stmt = $this->dbh->prepare($query);
    }

    // function untuk binding data
    public function bind($param, $value, $type = null)
    {
        // jika type nya null
        if (is_null($type)) {
            // cek tipe datanya
            switch (true) {
                // jika tipe datanya integer
                case is_int($value):
                    // set type nya menjadi integer
                    $type = PDO::PARAM_INT;
                    break;
                // jika tipe datanya boolean
                case is_bool($value):
                    // set type nya menjadi boolean
                    $type = PDO::PARAM_BOOL;
                    break;
                // jika tipe datanya null
                case is_null($value):
                    // set type nya menjadi null
                    $type = PDO::PARAM_NULL;
                    break;
                // selain dari itu set type nya menjadi string
                default:
                    // set type nya menjadi string
                    $type = PDO::PARAM_STR;
            }
        }

        // binding data
        $this->stmt->bindValue($param, $value, $type);
    }

    // function untuk eksekusi query
    public function execute() {
        $this->stmt->execute();
    }

    // function untuk mengambil semua data
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // function untuk mengambil satu data
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
?>