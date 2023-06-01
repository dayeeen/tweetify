<?php 

class Login extends Controller {
    public function index() {
        $data['judul'] = 'Login';
        $data['css'] = 'login.css';
        $this->view('login/login');
        $this->view('templates/footer');
    }
}

?>