<?php

class User extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->library('form_validation');


    }

    public function index(){
        if($_SESSION['logged_in']){


        $array=$this->User_Model->getImageName($_SESSION['uid']);
        print_r($array);
        echo $_SESSION['uName'];
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$this->User_Model->getImageName($_SESSION['uid']));
        $this->load->view('forms/userProfileForm',$this->User_Model->getProfileInfo($_SESSION['uid']));
        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }


    }
}



?>