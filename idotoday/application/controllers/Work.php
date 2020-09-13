<?php

class Work extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('Work_Model');
        $this->load->library('form_validation');

        
    }

    public function index(){
        if($_SESSION['logged_in']){

            $result['displaySidebar']=true;
            $result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];

        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('sub_subHeaders/workSubHeader');

        $this->load->view('work');
        $this->load->view('mainElement',array('mainElementId'=>'work'));
        self::workStatuses();
        $this->load->view('layout/footer');

        }else{
            redirect('regist/login');

        }

    }

    public function workStatuses(){
        if(isset($_SESSION['postal_code'])){
        $result['workStatuses']=$this->Work_Model->getWorkStatusAtRandom($_SESSION['postal_code']);
        // print_r($result['workStatuses']);
        $this->load->view('work/workStatus',$result);
        }else{
            
        $result['workStatuses']=$this->Work_Model->getWorkStatusAtRandom_1();
        $this->load->view('work/workStatus',$result);

        }


    }
    public function workAroundU(){
                $this->load->view('work/workAroundU');


    }
    public function professions(){
        if(isset($_SESSION['postal_code'])){

        $result['professions']=$this->Work_Model->getProfessionAtRandom($_SESSION['postal_code']);
                $this->load->view('work/professions',$result);
        }else{
            
        $result['professions']=$this->Work_Model->getProfessionAtRandom_1();
        $this->load->view('work/professions',$result);
        }


    }
    public function workCategory(){
                $this->load->view('work/workCategory');


    }







}