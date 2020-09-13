<?php

class Reviews extends CI_Controller{

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

        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('forms/reviewsForm');


        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }
    }

    public function person($id){

        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/otherUserSubHeader',array("id"=>$id));
        


        $this->load->view('layout/footer');
    }

    public function post(){

        $config=array(
            array(
                'field'=>'rating',
                'Label'=>'Rating',
                'rules'=>'required|min_length[1]|max_length[5]|regex_match[/^[0-5]*$/]',
            ),
            array(
                'field'=>'review',
                'Label'=>'Review',
                'rules'=>'min_length[10]|max_length[1000]|regex_match[/^[a-zA-Z0-9._\s,-]*$/]',
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            self::index();
                    
        }else{

            $data=array(
                'user_id'=>$_SESSION['uid'],
                'hire_id'=>$this->input->post('hire_id'),
                // 'hire_id'=>$_SESSION['hire_id'],
                'rating'=>$this->input->post('rating'),
                'review'=>$this->input->post('review')


            );

            if($this->User_Model->insert_1('reviews',$data)){

                // echo 'updated';
                redirect('user/reviews');

            }else{

            }

    }
    }




}

?>