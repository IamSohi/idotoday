<?php

class People extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('People_Model');
        $this->load->model('Work_Model');
        
        $this->load->model('User_Model');
        $this->load->model('Notification_Model');
        $this->load->library('form_validation');

        
    }

    public function index(){

        // print_r($this->People_Model->getUsers());

        if($_SESSION['logged_in']){

//         $result['people']=$this->People_Model->getUsersData();
//         $friendList=$this->User_Model->getUserConnections($_SESSION['uid']);


//         foreach ($result['people'] as $key=>$id) {
//             if($id['user_id']===$_SESSION['uid']){
//                 // echo 'done';
//                 unset($result['people'][$key]);
//                 // print_r($key);
//             }
//             if(isset($friendList) && in_array($id['user_id'],$friendList)){
//                 // echo 'done';
//                 unset($result['people'][$key]);
//                 // print_r($key);
//         }else{
//             continue;
//         }
        

// }

$result['displaySidebar']=true;
$result['id']=$_SESSION['uid'];
$result['userName']=$_SESSION['uName'];
$result['userEmail']=$_SESSION['email'];

$this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('user/profile',$result);
        $this->load->view('subHeaders/userSubHeader');
        // $this->load->view('sub_subHeaders/peopleSubHeader');

        $this->load->view('people');
        $this->load->view('mainElement',array('mainElementId'=>'people'));
        self::gPeople();


        $this->load->view('layout/footer');
        
        }else{
                        redirect('regist/login');

        }

        // print_r($result['people']);
        

    }

    public function gPeople(){
        if(isset($_SESSION['postal_code'])){
        $result['people']=$this->People_Model->getUsersAround($_SESSION['postal_code']);
        $friendList=$this->User_Model->getUserConnections($_SESSION['uid']);


        foreach ($result['people'] as $key=>$id) {
            if($id['user_id']===$_SESSION['uid']){
                // echo 'done';
                unset($result['people'][$key]);
                // print_r($key);
            }
            if(isset($friendList) && in_array($id['user_id'],$friendList)){
                // echo 'done';
                unset($result['people'][$key]);
                // print_r($key);
            }else{
                continue;
            }
        }
        $this->load->view('people/people',$result);
    }else{
        $result['people']=$this->People_Model->getUsersAround_1();
        $friendList=$this->User_Model->getUserConnections($_SESSION['uid']);


        foreach ($result['people'] as $key=>$id) {
            if($id['user_id']===$_SESSION['uid']){
                // echo 'done';
                unset($result['people'][$key]);
                // print_r($key);
            }
            if(isset($friendList) && in_array($id['user_id'],$friendList)){
                // echo 'done';
                unset($result['people'][$key]);
                // print_r($key);
            }else{
                continue;
            }
        }
        $this->load->view('people/people',$result);

    }

}


        public function professionals(){

            $result['professionals']=$this->People_Model->getProfessionalPeople2($_SESSION['postal_code']);
        $this->load->view('people/professionals',$result);

    }


    public function search($searchTag,$searchTitle){

        
        
$result0['displaySidebar']=true;
$result0['id']=$_SESSION['uid'];
$result0['userName']=$_SESSION['uName'];
$result0['userEmail']=$_SESSION['email'];
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('user/profile',$result0);
        $this->load->view('subHeaders/userSubHeader');

        $this->load->view('people');
        $this->load->view('mainElement',array('mainElementId'=>'searchPlace'));

        
            switch($searchTag){
                case "workstatus":
                self::workStatus($searchTitle);
                break;

                case "profession":
                self::profession($searchTitle);
                break;

                case "passion":
                self::passion($searchTitle);
                break;

                case "purpose":
                self::purpose($searchTitle);
                break;

                case "lifegoals":
                self::lifegoals($searchTitle);
                break;

        }
        
        $this->load->view('layout/footer');



    }



    public function workStatus($workStatusId){
        $data=$this->Work_Model->getWorkStatusById($workStatusId);
        $workStatus_array=explode(" ",$data['workStatus']);

        if(!empty($data['description'])){
            
        $description_array=explode(" ",$data['description']);
        
            $result['people']=$this->People_Model->getPeopleByWorkstatus($workStatus_array,$description_array);

        }else{
            $result['people']=$this->People_Model->getPeopleByWorkstatus2($workStatus_array);
            
        }

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

    public function profession($professionId){
        
        $data=$this->Work_Model->getProfessionById($professionId);
        $profession_array=explode(" ",$data['profession']);

        
        if(!empty($data['description'])){
            
        $description_array=explode(" ",$data['description']);
        $result['people']=$this->People_Model->getPeopleByProfession($profession_array,$description_array);
        }else{
            $result['people']=$this->People_Model->getPeopleByProfession2($profession_array);
            
        }

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


    public function workStatus2($workStatus){

        $workStatus_array=explode("%20",$workStatus);
        $result['people']=$this->People_Model->getPeopleByWorkstatus2($workStatus_array);
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

    public function profession2($profession){
        $profession_array=explode("%20",$profession);
        $result['people']=$this->People_Model->getPeopleByProfession2($profession_array);
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

    public function purpose($purpose){
        $purpose_array=explode("%20",$purpose);
        $result['people']=$this->People_Model->getPeopleByPurpose($purpose_array);
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
    
    public function lifegoals($lifegoals){
        $lifegoals_array=explode("%20",$lifegoals);
        $result['people']=$this->People_Model->getPeopleByLifegoals($lifegoals_array);
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
    
    public function passion($passion){
        $passion_array=explode("%20",$passion);
        $result['people']=$this->People_Model->getPeopleByPassion($passion_array);
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
    

    

    

    public function person($id){
        // $_SESSION['ouid']=$id;
        redirect('user/about/person/'.$id);


    }

    public function connect($id){
        
        // $insert_id=0;
        $uid=$_SESSION['uid'];
        if($id>$uid){
            
        $this->People_Model->connect($uid,$id);

        }else{
            
        $this->People_Model->connect($id,$uid);
        }

        self::insertConnectNotification($id);


    }
    public function insertConnectNotification($id){
        
                // $userName=$this->User_Model->getUserName2($);
        
                // $fullName=$userName['firstName'].' '.$userName['lastName'];

                $data_array=array(
                    'recipient_id'=>$id,
                    'sender_id'=>$_SESSION['uid'],
                    'type_of_notification'=>'1',
                    'notification'=>$_SESSION['uName'].' is now connected with you. Visit profile and see what '.$_SESSION['uName'].' is upto.'
                    // 'href'=>base_url().'index.php/users/profile/'.$_S
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
        // echo 'done'.$_SESSION['uid'];

    }




}