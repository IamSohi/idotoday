<?php

class Category extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('People_Model');
        $this->load->model('Work_Model');
        $this->load->model('Requests_Model');
        $this->load->library('form_validation');

    }

    public function index(){

    }

    public function search($category,$searchTag){


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');

        

        $this->load->view('work');
        $this->load->view('search/categoryNav.php',array('category'=>$category));
        $this->load->view('mainElement',array('mainElementId'=>'searchCategory'));


        switch($searchTag){
            case "workstatus":
            self::workStatuses($category);
            break;

            case "profession":
            self::professions($category);
            break;

            case "request":
            self::requests($category);
            break;

        }

        $this->load->view('layout/footer');
   
    }

    public function workStatuses($category){

        $result['workStatuses']=$this->Work_Model->getWorkStatusByCategory($category);
        $this->load->view('work/workStatus',$result);


    }

    public function professions($category){
        $result['professions']=$this->Work_Model->getProfessionByCategory($category);
        $this->load->view('work/professions',$result);

    }


    public function requests($category){
        $result['requests']=$this->Requests_Model->getRequestsByCategory($category);
        $this->load->view('grequests/requestsByPlace',$result);

    }

    

}