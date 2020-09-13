<?php

class Requests extends CI_Controller{

    private $requests;

    function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('Requests_Model');
        $this->load->library('form_validation');
        $this->load->model('User_Model');
        $requests=[];

    }

    public function index(){

        if($_SESSION['logged_in']){
            if(!isset($_SESSION['request_token'])){
                $_SESSION['request_token']=md5(uniqid(rand(), true));
            }
            

$result['displaySidebar']=true;
$result['id']=$_SESSION['uid'];
$result['userName']=$_SESSION['uName'];
$result['userEmail']=$_SESSION['email'];

            

        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');

        $this->load->view('user/profile',$result);
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('sub_subHeaders/globalRequestsSubHeader');
        $this->load->view('forms/requestsForm',array('renderAskBtn'=>false));
        
        $this->load->view('mainElement',array('mainElementId'=>'gRequests'));
        self::requestsAroundU();
        $this->load->view('layout/footer');

        }else{
                redirect('regist/login');
        }
    }


    public function requestsAroundU(){
        if(isset($_SESSION['postal_code'])){            
            $requests['requestsAroundU']=$this->Requests_Model->getRequestsAround($_SESSION['postal_code']);

            $hiredRequests=$this->User_Model->getHiredRequests();

            
            foreach ($requests['requestsAroundU'] as $key=>$id) {
            if($id['user_id']===$_SESSION['uid']){
                // echo 'done';
                unset($requests['requestsAroundU'][$key]);
                // print_r($key);
            }if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
                // echo 'done';
                unset($requests['requestsAroundU'][$key]);
            }else{
            continue;
        }
    }

        // $requests=[];
        $this->load->view('grequests/requestsAroundU',$requests);
}else{
    $requests['requestsAroundU']=$this->Requests_Model->getRequestsAround_1();

    $hiredRequests=$this->User_Model->getHiredRequests();

    
    foreach ($requests['requestsAroundU'] as $key=>$id) {
    if($id['user_id']===$_SESSION['uid']){
        // echo 'done';
        unset($requests['requestsAroundU'][$key]);
        // print_r($key);
    }if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
        // echo 'done';
        unset($requests['requestsAroundU'][$key]);
    }else{
    continue;
}
}

// $requests=[];
$this->load->view('grequests/requestsAroundU',$requests);

}

    }

    public function rewardedRequests(){
        if(isset($_SESSION['postal_code'])){            
            
        $requests['rewardedRequests']=$this->Requests_Model->getRewardedRequests($_SESSION['postal_code']);

        $hiredRequests=$this->User_Model->getHiredRequests();

            
            foreach ($requests['rewardedRequests'] as $key=>$id) {
            if($id['user_id']===$_SESSION['uid']){
                // echo 'done';
                unset($requests['rewardedRequests'][$key]);
                // print_r($key);
            }if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
                // echo 'done';
                unset($requests['rewardedRequests'][$key]);
            }else{
            continue;
        }
    }

        $this->load->view('grequests/rewardedRequests',$requests);
}else{
    
    $requests['rewardedRequests']=$this->Requests_Model->getRewardedRequests_1();
    
            $hiredRequests=$this->User_Model->getHiredRequests();
    
                
                foreach ($requests['rewardedRequests'] as $key=>$id) {
                if($id['user_id']===$_SESSION['uid']){
                    // echo 'done';
                    unset($requests['rewardedRequests'][$key]);
                    // print_r($key);
                }if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
                    // echo 'done';
                    unset($requests['rewardedRequests'][$key]);
                }else{
                continue;
            }
        }
    
            $this->load->view('grequests/rewardedRequests',$requests);
}

    }

    public function professionalRequests(){
                $requests=[];

        $this->load->view('grequests/professionalRequests',$requests);

    }

    public function requestsCategory(){
                $requests=[];

        $this->load->view('grequests/requestsCategory',$requests);

    }

    public function accept($request_id){
        

        $data=array(
            'user_id'=>$_SESSION['uid'],
            'request_id'=>$request_id
        );

        $this->Requests_Model->acceptRequest($data);

        echo 'done';




    }
    public function donee(){
        echo 'done';
    }

    public function reject($request_id){
        $this->Requests_Model->rejectRequest($request_id);


    }

}


?>