<?php

class Professions extends CI_Controller{

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
            $result['result']=$this->User_Model->getUserProfessions($_SESSION['uid']);
            if(!isset($_SESSION['profession_token'])){
                $_SESSION['profession_token']=md5(uniqid(rand(), true));
            }


            // print_r($this->User_Model->getUserProfessions($_SESSION['uid']));
$result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        
        $this->load->view('subHeaders/userSubHeader');
        $this->load->view('forms/professionsForm');
        $this->load->view('user/professions',$result);
        


        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }
    }

    public function person($id){
        $profession_array['result']=$this->User_Model->getUserProfessions($id);
        // print_r($profession_array['result']);

        
        $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
        $result['user']=$this->User_Model->getUserById($id);
        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/otherUserSubHeader',$result);
        
        $this->load->view('user/professions',$profession_array);
        

        $this->load->view('layout/footer');
        
    }

    public function add(){

        if($this->input->post('token')==$_SESSION['profession_token']){


        $config=array(
            array(
                'field'=>'profession',
                'Label'=>'Profession',
                'rules'=>'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'category',
                'Label'=>'category',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z& -]*$/]',
            ),
            array(
                'field'=>'description',
                'Label'=>'Description',
                'rules'=>'min_length[2]|max_length[500]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]',
            ),
            array(
                'field'=>'workplace',
                'Label'=>'Place Of Work',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'price',
                'Label'=>'Amount Charged',
                'rules'=>'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z0-9., -]*$/]',
            ),
            array(
                'field'=>'currency',
                'Label'=>'Currency',
                'rules'=>'',
            ),
            array(
                'field'=>'timescale',
                'Label'=>'',
                'rules'=>'',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            echo '<div><span id="notValid" hidden>NotValid</span></div>';

            echo validation_errors();

            // self::index();
            // return false;
                    
        }else{

            if(is_numeric($this->input->post('price'))){
                $charge_scale=$this->input->post('timescale');
                $currency=$this->input->post('currency');
                

            }else{
                $charge_scale=null;
                $currency=null;
                

            }

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'profession'=>$this->input->post('profession'),
                'category'=>$this->input->post('category'),
                'description'=>$this->input->post('description'),
                'work_place'=>$this->input->post('workplace'),
                'postal_code'=>$_SESSION['postal_code'],
                'amount_charge'=>$this->input->post('price'),
                'charge_scale'=>$charge_scale,
                'currency'=>$currency
            );
            
            if($this->User_Model->insert_1('professions',$data)){

               
                $result['result']=$this->User_Model->getUserProfessions($_SESSION['uid']);
                $this->load->view('user/professions',$result);
            }else{

            }


        }
        }else{
        echo "Something Went Wrong";
    }

    }

    public function updateProfession(){

        if($this->input->post('token')==$_SESSION['profession_token']){


        $config=array(
            array(
                'field'=>'profession',
                'Label'=>'Profession',
                'rules'=>'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'category',
                'Label'=>'category',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z& -]*$/]',
            ),
            array(
                'field'=>'description',
                'Label'=>'Description',
                'rules'=>'min_length[2]|max_length[500]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]',
            ),
            array(
                'field'=>'workplace',
                'Label'=>'Place Of Work',
                'rules'=>'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'price',
                'Label'=>'Amount Charged',
                'rules'=>'required|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z0-9., -]*$/]',
            ),
            array(
                'field'=>'currency',
                'Label'=>'Currency',
                'rules'=>'',
            ),
            array(
                'field'=>'timescale',
                'Label'=>'',
                'rules'=>'',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            echo '<div><span id="notValid" hidden>NotValid</span></div>';

            echo validation_errors();

            // self::index();
            // return false;
                    
        }else{

            if(is_numeric($this->input->post('price'))){
                $charge_scale=$this->input->post('timescale');
                $currency=$this->input->post('currency');
                

            }else{
                $charge_scale=null;
                $currency=null;
                

            }

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'profession'=>$this->input->post('profession'),
                'category'=>$this->input->post('category'),
                'description'=>$this->input->post('description'),
                'work_place'=>$this->input->post('workplace'),
                'postal_code'=>$_SESSION['postal_code'],
                'amount_charge'=>$this->input->post('price'),
                'charge_scale'=>$charge_scale,
                'currency'=>$currency
            );
            
            if($this->User_Model->insert('professions',$data,array('profession_id'=>$this->input->post('profession_id')))){

               
                // $result['result']=$this->User_Model->getUserProfessions($_SESSION['uid']);
                // $this->load->view('user/professions',$result);
            }else{

            }


        }

    }else{
        echo "Something Went Wrong";
    }
    }


public function deleteProfession($id){
    $this->User_Model->deleteRow('profession_id',$id,'professions');
    
}

}

?>