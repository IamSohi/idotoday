<?php

class Connections extends CI_Controller{

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

            // print_r($this->User_Model->getUserConnections_3($_SESSION['uid']));

            if($array['people']=$this->User_Model->getUserConnections_3($_SESSION['uid'])){
            foreach($array['people'] as $key=>$id) {
                $array['people'][$key]['connection']='Connected';
            }
            }
            $result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('user/connections',$array);
        


        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }
    }


    public function person($id){
        if($_SESSION['logged_in']){


        // $friendlist=$this->User_Model->getUserConnections($id);
        $userFriendList=$this->User_Model->getUserConnections($_SESSION['uid']);

        $array['people']=$this->User_Model->getUserConnections_3($id);
        // $array['user_friendlist']=$this->User_Model->getUserConnections_1($_SESSION['uid']);
        // if(!empty($friendlist)){
        // $re=array_diff($friendlist,$userFriendList);
        // print_r($re);
        // }

        if(!empty($array['people'])){
        foreach ($array['people'] as $key=>$kid) {
                // $array['people'][$key]['user_name']=$this->User_Model->getUserName($id['user_id']);

                if($kid['user_id']===$_SESSION['uid']){
                    $array['people'][$key]['connection']=NULL;
                }else if(isset($userFriendList) && in_array($kid['user_id'],$userFriendList)){
                    $array['people'][$key]['connection']='Connected';
                }else{
                    $array['people'][$key]['connection']='Connect';

                }
                
            }
        }

        $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
        $result['user']=$this->User_Model->getUserById($id);
        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/otherUserSubHeader',$result);
        
        $this->load->view('user/connections',$array);
        $this->load->view('layout/footer');
        }else{
            redirect('regist/login/index');

        }


    }

    // public function userConnections(){
    //     print_r($this->User_Model->getUserConnections($_SESSION['uid']));

    // }
}

?>