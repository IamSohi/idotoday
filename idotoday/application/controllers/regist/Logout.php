<?php

class Logout extends CI_Controller{


    function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

    }

    public function index(){
        if($_SESSION['logged_in']){

        session_destroy();
        redirect('regist/login');
        }else{
            redirect('regist/login');

        }
    }
}