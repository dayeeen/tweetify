<?php 

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    public function __construct() {
        $url = $this->parseURL();
        //fix error undefined offset
        //jika tidak ada url[0] maka set url[0] = 'Home'
        if(!isset($url[0])) {
            $url[0] = 'Home';
        }

        // controller
        if(file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]); // untuk menghapus elemen array ke-0
        }
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        
        // method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]); // untuk menghapus elemen array ke-1
            }
        }

        // params
        if(!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    public function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // rtrim() untuk menghapus tanda / di akhir url
            $url = filter_var($url, FILTER_SANITIZE_URL); // filter_var() untuk membersihkan url dari karakter-karakter yang tidak diinginkan
            $url = explode('/', $url); // explode() untuk memecah url berdasarkan tanda / dan menjadikannya array
            return $url;
        }
    }
}


?>