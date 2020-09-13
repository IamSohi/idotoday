<?php

class About extends CI_Controller{

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
if(!isset($_SESSION['about_token'])){
            $_SESSION['about_token']=md5(uniqid(rand(), true));
}

$result['id']=$_SESSION['uid'];
            $result['userName']=$_SESSION['uName'];
            $result['userEmail']=$_SESSION['email'];


        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
        
        $this->load->view('subHeaders/userSubHeader');
        
        $this->load->view('forms/aboutForm',$this->User_Model->getAboutInfo($_SESSION['uid']));


        $this->load->view('layout/footer');
        
        }else{
                redirect('regist/login/index');
        }
    }


    public function person($id){
        if($_SESSION['logged_in']){

            
        $result['connected']=$this->User_Model->checkFriendship($_SESSION['uid'],$id);
        $result['user']=$this->User_Model->getAboutInfo_1($id);

        // print_r($result['user']);

        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        
        $this->load->view('subHeaders/otherUserSubHeader',$result);
        
        $this->load->view('user/about',$result);


        $this->load->view('layout/footer');
        }else{
                redirect('regist/login/index');
        }

    }

    public function edit(){

        if($this->input->post('token')==$_SESSION['about_token']){
        $config=array(
            array(
                'field'=>'userName',
                'label'=>'UserName',
                'rules'=>'required|min_length[2]|max_length[30]|regex_match[/^[a-zA-Z ]*$/]',
                'errors'=>'%s is too Short'
            ),
            array(
                'field'=>'passion',
                'Label'=>'Passion',
                'rules'=>'required|min_length[2]|max_length[210]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'purpose',
                'Label'=>'Purpose',
                'rules'=>'required|min_length[2]|max_length[210]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'lifegoals',
                'Label'=>'Believe',
                'rules'=>'required|min_length[2]|max_length[210]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            array(
                'field'=>'dob',
                'Label'=>'Date of birth',
                'rules'=>'',
            ),
            array(
                'field'=>'country_code',
                'Label'=>'Country Code',
                'rules'=>'min_length[1]|max_length[5]|regex_match[/^[+0-9-]*$/]',
            ),
            array(
                'field'=>'number',
                'Label'=>'number',
                'rules'=>'min_length[1]|max_length[15]|regex_match[/^[0-9-]*$/]',
            ),
            array(
                'field'=>'facebook_url',
                'Label'=>'Facebook Url',
                'rules'=>'valid_url',
            ),
            array(
                'field'=>'twitter_url',
                'Label'=>'Twitter Url',
                'rules'=>'valid_url',
            ),
            array(
                'field'=>'city',
                'Label'=>'City',
                'rules'=>'min_length[2]|max_length[50]|regex_match[/^[a-zA-Z0-9._ -]*$/]',
            ),
            
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            self::index();
                    
        }else{


            //rough
            // if($this->input->post('loveYourWork')){
            //     $loveWork=TRUE;
            // }
            // if($this->input->post('beleive')){
            //     $beleive=TRUE;
            // }
            $user_name_array=explode(" ",$this->input->post('userName'),2);
            $userData=array(
                'firstName'=>$user_name_array[0],
                'lastName'=>$user_name_array[1]
            );

            $data=array(
                // 'user_id'=>$_SESSION['uid'],
                'passion'=>$this->input->post('passion'),
                'purpose'=>$this->input->post('purpose'),
                'lifegoals'=>$this->input->post('lifegoals'),
                'dob'=>$this->input->post('dob'),
                'country_code'=>$this->input->post('country_code'),
                'phone_number'=>$this->input->post('number'),
                'facebook_url'=>$this->input->post('facebook_url'),
                'twitter_url'=>$this->input->post('twitter_url'),
                'city'=>$this->input->post('city')
            );


            if($this->User_Model->insert('about',$data,array('user_id ='=>$_SESSION['uid']))){
                $this->User_Model->update('users',$userData,array('user_id ='=>$_SESSION['uid']));
                $_SESSION['uName']=$this->input->post('userName');
                
                redirect('user/about');

                
                

                        
                }else{

                    $this->session->set_flashdata('login_msg', '<div class="alert alert-success text-center">error in inserting your data. Please try again.</div>');
                    redirect('user/about');

                        

            }

    }
}else{
        echo "Something Went Wrong";
    }
}
}

?>