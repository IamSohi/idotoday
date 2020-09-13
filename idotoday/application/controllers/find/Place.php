<?php

class Place extends CI_Controller{

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

        // redirect("home");
        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('sub_subHeaders/workSubHeader');
        // echo "ok";



    }

    public function search($place,$searchTag){

        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');

        

        $this->load->view('work');
        $this->load->view('search/placeNav.php',array('place'=>$place));
        $this->load->view('mainElement',array('mainElementId'=>'searchPlace'));

        switch($searchTag){
            case "workstatus":
            self::workStatuses($place);
            break;

            case "profession":
            self::professions($place);
            break;

            case "requests":
            self::requests($place);
            break;

        }

        $this->load->view('layout/footer');



        
    }

    public function workStatuses($place){
        $result['workStatuses']=$this->Work_Model->getWorkStatusByPlace2($place);        
        if(count($result['workStatuses'])){

        $this->load->view('work/workStatus',$result);

        }else{
        $result['workStatuses']=$this->Work_Model->getWorkStatusByPlace($place);        
        $this->load->view('work/workStatus',$result);
        }



    }

    public function professions($place){
        $result['professions']=$this->Work_Model->getProfessionByPlace2($place);
        
        if(count($result['professions'])){

        $this->load->view('work/professions',$result);

        }else{
        $result['professions']=$this->Work_Model->getProfessionByPlace($place);
        $this->load->view('work/professions',$result);
        }


    }

    public function people($place){
        $result['people']=$this->People_Model->getPeopleByPlace($place);

        $userFriendList=$this->User_Model->getUserConnections($_SESSION['uid']);

        if(!empty($result['people'])){
        foreach ($result['people'] as $key=>$id) {

                if($id['user_id']===$_SESSION['uid']){
                    $result['people'][$key]['connection']=NULL;
                }else if(isset($userFriendList) && in_array($id['user_id'],$userFriendList)){
                    $result['people'][$key]['connection']='Connected';
                }else{
                    $result['people'][$key]['connection']='Connect';

                }
                
            }
        }

        $this->load->view('search/people',$result);

    }

    public function requests($place){
        $result['requests']=$this->Requests_Model->getRequestsByPlace2($place);
        if(count($result['requests'])){

        $this->load->view('grequests/requestsByPlace',$result);

        }else{
        $result['requests']=$this->Requests_Model->getRequestsByPlace($place);
        $this->load->view('grequests/requestsByPlace',$result);
        }

    }

    

}