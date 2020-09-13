<?php

class Users extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('People_Model');
        $this->load->model('Notification_Model');
        

        $this->load->library('form_validation');

    }

    public function index(){
        redirect('people');


    }

    public function profile($id){

        if($_SESSION['logged_in']){
            redirect('user/workstatus/person/'.$id);


// $result['image']=$this->User_Model->getImageName($_SESSION['uid']);


        // $array=$this->User_Model->getImageName($_SESSION['uid']);
        // print_r($array);
        // echo $_SESSION['uName'];
        // $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
        // $result['id']=$id;

        // $this->load->view('layout/header');
        // $this->load->view('headers/mainHeader');
        // $this->load->view('subHeaders/otherUserSubHeader',$result);

        // $this->load->view('user/profile',$this->User_Model->getImageName($_SESSION['uid']));
        // $this->load->view('forms/userProfileForm',$this->User_Model->getProfileInfo($_SESSION['uid']));
        // $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }

    }

    public function connect($id){
        
        // $insert_id;
        $uid=$_SESSION['uid'];
        if($id>$uid){
            
        $this->People_Model->connect($uid,$id);

        }else{
            
        $this->People_Model->connect($id,$uid);
        }

        self::insertConnectNotification($id);


        self::profile($id);


    }

    public function insertConnectNotification($id){

        // $userName=$this->User_Model->getUserName2($id);

        // $fullName=$userName['firstName'].' '.$userName['lastName'];

        $data_array=array(
            'recipient_id'=>$id,
            'sender_id'=>$_SESSION['uid'],
            'type_of_notification'=>'1',
            'notification'=>$_SESSION['uName'].' is now connected with you. Visit profile and see what '.$_SESSION['uName'].' is upto.'
            // 'href'=>base_url().'index.php/users/profile/'.$id
        );
        $this->Notification_Model->insertNotification($data_array);
        

    }

    public function unConnect($id){
        // echo 'done';
        $uid=$_SESSION['uid'];
        if($id>$uid){
            
        $this->People_Model->unConnect($id,$uid);

        }else{
            
        $this->People_Model->unConnect($uid,$id);
        }
                self::profile($id);


    }

}