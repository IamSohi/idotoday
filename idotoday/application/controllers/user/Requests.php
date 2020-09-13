<?php

class Requests extends CI_Controller{

    private $requests;
    private $hiredRequests;


    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('Requests_Model');
        $this->load->model('Notification_Model');

        $this->load->library('form_validation');
        $requests=[];
        // $hiredRequests=[];


    }


    

    public function index(){
        if($_SESSION['logged_in']){

//             // print_r($this->User_Model->getResultArray('requests',array('user_id'=>$_SESSION['uid'])));
//             $requests['result']=$this->User_Model->getResultArray('requests',array('user_id'=>$_SESSION['uid']));
//             $requests['requestsForYou']=$this->User_Model->getAllRows('requests');
//             $requests['acceptedByUser']=$this->Requests_Model->getRequestIdFromHired($_SESSION['uid']);
//             // print_r($this->Requests_Model->getRequestIdFromHired($_SESSION['uid']));
//             foreach ($requests['acceptedByUser'] as $key=>$id) {
//                  $requests['acceptedRequests']=$this->Requests_Model->getRequestFromId($id['request_id']);
//                  $requests['acceptedRequests'][$key]['from_userName']=$this->User_Model->getUserName($requests['acceptedRequests'][$key]['user_id']);

//             }

//             // $requests['acceptedRequests']=
            // $hiredRequests=$this->User_Model->getHiredRequests();
            // print_r($hiredRequests);

//             // print_r($this->User_Model->getUserName($this->User_Model->getHiredUser($id['request_id'])));
// // print_r($this->User_Model->getHiredUser(1));
//             foreach ($requests['result'] as $key=>$id) {
//                 $requests['result'][$key]['accepted_by']=$this->User_Model->getUserName($this->User_Model->getHiredUser($id['request_id']));
//                 $requests['result'][$key]['accepted_by_user_id']=$this->User_Model->getHiredUser($id['request_id']);

//                 // echo $id['accepted_by'];
//             }
// // print_r($requests['requestsForYou']);
//             foreach ($requests['requestsForYou'] as $key=>$id) {
//                 // echo $id['user_id'].'       '.$_SESSION['uid'].'     ';
//                 // print_r($key);
//                 if($id['user_id']==$_SESSION['uid']){
//                     // echo 'dome';
//                     unset($requests['requestsForYou'][$key]);
//                 }
//             if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
//                 // echo 'done';
//                 unset($requests['requestsForYou'][$key]);
//             }else{
                
//             continue;
//         }

// }
// print_r($requests['requestsForYou']);
if(!isset($_SESSION['request_token'])){
                $_SESSION['request_token']=md5(uniqid(rand(), true));
            }

$result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        $this->load->view('subHeaders/userSubHeader');
        $this->load->view('sub_subHeaders/requestsSubHeader');
        $this->load->view('forms/requestsForm',array('renderAskBtn'=>true));
        


        $this->load->view('user/requests');


                

        

        self::requestsForU();
        // $this->load->view('user/requests',$requests);



        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }
    }


    public function requestsForU(){
        $hiredRequests=$this->User_Model->getHiredRequests();
        $requests['requestsForYou']=$this->User_Model->getRequestsForUser($_SESSION['uid']);
        foreach ($requests['requestsForYou'] as $key=>$id) {
            if($id['user_id']==$_SESSION['uid']){
                    // echo 'dome';
                    unset($requests['requestsForYou'][$key]);
                    
            }
            if(isset($hiredRequests) && in_array($id['request_id'],$hiredRequests)){
                
                unset($requests['requestsForYou'][$key]);
            }else{
                
                
            continue;
            }
        }

        $this->load->view('user/urequests/requestForU',$requests);
    }

    public function uRequests(){

        $requests['result']=$this->Requests_Model->getUserRequests($_SESSION['uid']);
        foreach ($requests['result'] as $key=>$id) {

            if($id['to_who']=='All Around You'){
                if($hiredUser=$this->Requests_Model->getHiredUser($id['request_id'])){
                    
                $requests['result'][$key]['accepted_by']=$hiredUser['firstName'].' '.$hiredUser['lastName'];
                $requests['result'][$key]['accepted_by_user_id']=$hiredUser['user_id'];


                }
                

            }else{
                if($hiredUser=$this->Requests_Model->getHiredUser($id['request_id'])){
                    $requests['result'][$key]['accepted']='Accepted on '.$hiredUser['date_time'];
                    
                }
                // else{
                //     $requests['result'][$key]['accepted']='Accepted on'.$hiredUser['date_time'];
                    
                // }

            }
            // if($hiredUserId=$this->User_Model->getHiredUser($id['request_id'])){
            //     $requests['result'][$key]['accepted_by']=$this->User_Model->getUserName($hiredUserId);
            // $requests['result'][$key]['accepted_by_user_id']=$hiredUserId;
            // } 
        }
        // print_r($requests);
        
        $this->load->view('user/urequests/myRequests',$requests);
    }

    public function acceptedRequests(){
        // print_r($this->Requests_Model->getAcceptedRequests($_SESSION['uid']));
        $requests['acceptedRequests']=$this->Requests_Model->getAcceptedRequests($_SESSION['uid']);
        $this->load->view('user/urequests/acceptedRequests',$requests);
        
            // print_r($this->Requests_Model->getRequestIdFromHired($_SESSION['uid']));
        //     foreach ($requests['acceptedByUser'] as $key=>$id) {
        //          $requests['acceptedRequests']=$this->Requests_Model->getRequestFromId($id['request_id']);
        //          $requests['acceptedRequests'][$key]['from_userName']=$this->User_Model->getUserName($requests['acceptedRequests'][$key]['user_id']);

        // }


    }

    public function request(){

        if($this->input->post('token')==$_SESSION['request_token']){


        $config=array(
            array(
                'field'=>'request',
                'Label'=>'Request',
                'rules'=>'required|min_length[2]|max_length[255]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'category',
                'Label'=>'category',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z& -]*$/]',
            ),
            array(
                'field'=>'description',
                'Label'=>'Description',
                'rules'=>'min_length[10]|max_length[1000]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]',
            ),
            array(
                'field'=>'place',
                'Label'=>'Place',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'toWhom',
                'Label'=>'toWhom',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'bounty',
                'Label'=>'Bounty',
                'rules'=>'',
            ),
            array(
                'field'=>'currency',
                'Label'=>'Currency',
                'rules'=>'',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            echo '<div><span id="notValid" hidden>NotValid</span></div>';
             echo validation_errors();

        // $this->load->view('forms/requestsForm');


                                // self::uRequests();
                                // return 'false';
            // echo 'not valid';



            // self::index();
                    
        }else{

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'request'=>$this->input->post('request'),
                'category'=>$this->input->post('category'),
                'description'=>$this->input->post('description'),
                'location'=>$this->input->post('place'),
                'postal_code'=>$_SESSION['postal_code'],
                'to_who'=>$this->input->post('toWhom'),
                'bounty'=>$this->input->post('bounty'),
                'currency'=>$this->input->post('currency')


            );

            if($insert_id=$this->Requests_Model->insertRequest($data)){

                if(preg_match('/^1000/',$data['to_who'])){

                    self::insertRequestNotification($data,$insert_id);

                }

                        // $this->load->view('forms/requestsForm');

                                self::uRequests();


                // echo 'updated';
                // redirect('user/requests');
                // $requests['result']=$this->User_Model->getResultArray('requests',array('user_id'=>$_SESSION['uid']));
                //         $this->load->view('user/requests',$requests);


            }else{

            }

        }
    }else{
        echo "Something Went Wrong";
    }
}

public function insertRequestNotification($data,$request_id){

    // $userName=$this->User_Model->getUserName2($data['to_who']);
    
    //         $fullName=$userName['firstName'].' '.$userName['lastName'];
    
            $data_array=array(
                'recipient_id'=>$data['to_who'],
                'sender_id'=>$_SESSION['uid'],
                'source_id'=>$request_id,
                'type_of_notification'=>'2',
                'notification'=>$_SESSION['uName'].' has requested you. See full Details.'
                // 'href'=>base_url().'index.php/user/requests'
            );

            $this->Notification_Model->insertNotification($data_array);
    
}



public function requestUser($id){

    if($_SESSION['logged_in']){
        
                    
                $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
                $result['user']=$this->User_Model->getUserById($id);
                $result['renderAskBtn']=false;
                
        
                
                $this->load->view('layout/header');
                $this->load->view('headers/mainHeader');
                
                $this->load->view('subHeaders/otherUserSubHeader',$result);
                
                $this->load->view('forms/requestsForm',$result);
                
        
                $this->load->view('layout/footer');
                }else{
                        redirect('regist/login/index');
                }
        

    




}

public function updateRequest(){
        if($this->input->post('token')==$_SESSION['request_token']){


        $config=array(
            array(
                'field'=>'request',
                'Label'=>'Request',
                'rules'=>'required|min_length[2]|max_length[255]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'category',
                'Label'=>'category',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z& -]*$/]',
            ),
            array(
                'field'=>'description',
                'Label'=>'Description',
                'rules'=>'min_length[10]|max_length[1000]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]',
            ),
            array(
                'field'=>'place',
                'Label'=>'Place',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'toWhom',
                'Label'=>'toWhom',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'bounty',
                'Label'=>'Bounty',
                'rules'=>'',
            ),
            array(
                'field'=>'currency',
                'Label'=>'Currency',
                'rules'=>'',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){
 echo '<div><span id="notValid" hidden>NotValid</span></div>';
 echo validation_errors();

//         $this->load->view('forms/requestsForm');
                    
        }else{
            if(empty($this->input->post('bounty'))){
                $bounty=NULL;
                $currency=NULL;


            }else{
                $bounty=$this->input->post('bounty');
                $currency=$this->input->post('currency');
            }

            $request_id=$this->input->post('request_id');

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'request'=>$this->input->post('request'),
                'category'=>$this->input->post('category'),
                'description'=>$this->input->post('description'),
                'location'=>$this->input->post('place'),
                'postal_code'=>$_SESSION['postal_code'],
                'to_who'=>$this->input->post('toWhom'),
                'bounty'=>$bounty,
                'currency'=>$currency


            );

            // if($this->User_Model->insert('requests',$data,array('request_id'=>$this->input->post('request_id')))){
            if($this->Requests_Model->updateRequest($data,array('request_id'=>$request_id))){
                    if(preg_match('/^1000/',$data['to_who'])){
                        
                        self::updateRequestNotification($data,$request_id);
    
                    }
                


                // echo 'updated';
                // redirect('user/requests');
                // $requests['result']=$this->User_Model->getResultArray('requests',array('user_id'=>$_SESSION['uid']));
                //         $this->load->view('user/requests',$requests);


            }else{

            }

        }
    }else{
        echo "Something Went Wrong";
    }
}
public function updateRequestNotification($data,$request_id){
    
        // $userName=$this->User_Model->getUserName2($data['to_who']);
        
        //         $fullName=$userName['firstName'].' '.$userName['lastName'];
        
                $data_array=array(
                    'recipient_id'=>$data['to_who'],
                    'sender_id'=>$_SESSION['uid'],
                    'source_id'=>$request_id,
                    'type_of_notification'=>'2',
                    'notification'=>$_SESSION['uName'].' has updated the request. See full Details.'
                    // 'href'=>base_url().'index.php/user/requests'
                );
    
                $this->Notification_Model->insertNotification($data_array);
        
}

public function deleteRequest($id){
    $this->User_Model->deleteRow('request_id',$id,'requests');
    
}


      
}

?>