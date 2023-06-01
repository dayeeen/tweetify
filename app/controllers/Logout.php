<?php 
class Logout extends Controller {
    public function index() {
        $data['judul'] = 'Logout';
        $data['css'] = 'logout.css';
        $this->view('login/logout');
    }
}
?>