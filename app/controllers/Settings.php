<?php 

class Settings extends Controller {
    public function index() {
        $data['judul'] = 'Setting';
        $data['css'] = 'setting.css';
        $this->view('templates/header', $data);
        $this->view('settings/index');
        $this->view('templates/footer');
    }
}

?>