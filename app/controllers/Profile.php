<?php

class Profile extends Controller{
    public function index() {
        $data['judul'] = 'Profile';
        $data['css'] = 'profile.css';
        $this->view('templates/header', $data);
        $this->view('profile/index');
        $this->view('templates/footer');
    }
    public function page() {
        $this->view('about/page');
    }
}