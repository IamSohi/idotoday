<?php
class Message extends CI_Controller{

    function __construct(){
        parent::__construct();
        
         $this->load->helper('url');
        $this->load->library('session');

    }

    function index(){
        
        $this->load->view('layout/header');
        $this->load->view('headers/messageHeader');
        $this->load->view('message');
        $this->load->view('layout/footer');
    }

    function logmessage(){
        if($_SESSION['logged_in']){
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('message');
        $this->load->view('layout/footer');

    }else{
        self::index;
    }

}
} 


?>