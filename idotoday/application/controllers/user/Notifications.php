<?php

class Notifications extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('Notification_Model');
        
        $this->load->library('form_validation');


    }

    public function index(){
        if($_SESSION['logged_in']){
            
            $this->load->view('layout/header');
            $this->load->view('headers/mainHeader');
                    // $this->load->view('layout/footer');
                    self::getUserNotification();
                    self::setNotificationViewed();
                    
        }else{
            redirect('regist/login');
            
        }

    }

    public function getUserNotification(){
        $result['notifications']=$this->Notification_Model->getUserNotification($_SESSION['uid']);

        $this->load->view('utils/notifications',$result);
        


    }

    public function getUserNotificationNumber(){
        echo $this->Notification_Model->getUserNotificationNumber($_SESSION['uid']);

        
    }
    public function setNotificationViewed(){
        $this->Notification_Model->setNotificationViewed($_SESSION['uid']);

    }
}

?>