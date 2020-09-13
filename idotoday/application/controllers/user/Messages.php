<?php

class Messages extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('Message_Model');
        $this->load->library('form_validation');


    }

    public function index(){

        if($_SESSION['logged_in']){
                    $this->load->view('layout/header');
                    $this->load->view('headers/mainHeader');
                    // $this->load->view('layout/footer');
                    self::getUserMessage2();
                    self::setMessageViewed();
                    
                    }else{
                        redirect('regist/login');
            
                    }

    }
    public function getUserMessage(){
        $result['messages']=$this->Message_Model->getUserMessage($_SESSION['uid']);

        $this->load->view('utils/messages',$result);
        
    }
    public function getUserChat($fid,$fname){
        $result['messages']=$this->Message_Model->getUserChat2($_SESSION['uid'],$fid);
        $result['fname']=$fname;
        $result['id']=$fid;
        // print_r($result['messages']);
        $this->load->view('utils/chatContainer',$result);
        
        $this->load->view('utils/chat',$result);
        
    }
    public function insertUserChat($fid){
        // echo $fid;
        $result['messages']=$this->Message_Model->getUserChat2($_SESSION['uid'],$fid);
        // $result['fname']=$fname;
        // print_r($result['messages']);
        $this->load->view('utils/chat',$result);
        
    }
    public function getUserMessage2(){
        $result['messages']=$this->Message_Model->getUserMessage($_SESSION['uid']);
        $result['SmallScreenChat']=true;

        $this->load->view('utils/messages',$result);
        
    }

    public function getUserMessageNumber(){
        echo $this->Message_Model->getUserMessageNumber($_SESSION['uid']);

        
    }
    public function setMessageViewed(){
        $this->Message_Model->setMessageViewed($_SESSION['uid']);

    }
    public function chat($id){
        if($_SESSION['logged_in']){
            $result['id']=$id;
            $fname=$this->User_Model->getUserName($id);
            $this->load->view('layout/header');
            $this->load->view('headers/mainHeader');
            // $this->load->view('layout/footer');
            self::getUserChat($id,$fname);
            $this->load->view('utils/chatFrame',$result);
            
            
            }else{
                redirect('regist/login');
    
            }

    }

}

?>