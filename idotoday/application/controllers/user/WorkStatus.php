<?php 

class WorkStatus extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('Work_Model');
        $this->load->model('User_Model');

        $this->load->library('form_validation');


    }

    public function index(){


        if(!isset($_SESSION['workstatus_token'])){
                $_SESSION['workstatus_token']=md5(uniqid(rand(), true));
            }

        $result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('forms/workStatusForm',$this->Work_Model->getUserWorkStatus($_SESSION['uid']));
        $this->load->view('layout/footer');

    }

    public function person($id){

        
        $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
        // print_r($result['connected']);
        $result['user']=$this->Work_Model->getUserWorkStatus($id);
                // print_r($result['user']);


        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/otherUserSubHeader',$result);
        
        $this->load->view('user/workstatus',$result);
        $this->load->view('layout/footer');

    }

    function updateStatus(){

        if($this->input->post('token')==$_SESSION['workstatus_token']){


        $config=array(
            array(
                'field'=>'status',
                'Label'=>'Work Status',
                'rules'=>'required|min_length[2]|max_length[255]|regex_match[/^[a-zA-Z0-9._ -]*$/]'
            ),
            array(
                'field'=>'category',
                'Label'=>'category',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z& -]*$/]'
            ),
            array(
                'field'=>'description',
                'Label'=>'Description',
                'rules'=>'min_length[10]|max_length[1000]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]'
            ),
            array(
                'field'=>'place',
                'Label'=>'Place',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]'
            ),
            array(
                'field'=>'feeling',
                'Label'=>'Feelings',
                'rules'=>'',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            self::index();
                    
        }else{

            // $this->User_Model->get_postal_code();

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'workStatus'=>$this->input->post('status'),
                'category'=>$this->input->post('category'),
                'description'=>$this->input->post('description'),
                'place'=>$this->input->post('place'),
                'postal_code'=>$_SESSION['postal_code'],
                'feelings'=>$this->input->post('feeling'),

            );

            if($this->Work_Model->insertStatus($data,array('user_id ='=>$_SESSION['uid']))){

                echo 'updated'.$_SESSION['postal_code'];
                // redirect('user/workstatus');

            }else{

            }

        }
    }else{
        echo "Something Went Wrong";
    }
    }


}