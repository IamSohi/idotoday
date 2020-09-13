<?php

class Home extends CI_Controller{

    function __construct(){
        parent::__construct();
        
         $this->load->helper('form'); 
         $this->load->helper('url');


    }

    public function index(){

        $this->load->view('layout/header');
        $this->load->view('headers/signupHeader');
        $this->load->view('index');
        $this->load->view('layout/footer');

    }

}