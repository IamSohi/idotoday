<?php

class Signup extends CI_Controller{



     function __construct(){
        parent::__construct();
        
         $this->load->helper('form'); 
         $this->load->helper('url');
        $this->load->database();
        $this->load->library('email');
        $this->load->model('Signup_Model');
        $this->load->model('Login_Model');
        
        $this->load->library('session');

        $this->load->library('form_validation');
        



    }

    public function index(){
        $_SESSION['signup_token']=md5(uniqid(rand(), true));

        $this->load->view('layout/header');
        $this->load->view('headers/signupHeader');
        $this->load->view('forms/signupform');
        $this->load->view('layout/footer');

    }

    public function signitup(){

        if($this->input->post('token')==$_SESSION['signup_token']){


        $config=array(
            array(
                'field'=>'firstname',
                'label'=>'Firstname',
                'rules'=>'required|min_length[2]|max_length[15]|regex_match[/^[a-zA-Z ]*$/]',
                'errors'=>'%s is too Short'
           
            ),
            array(
                'field'=>'lastname',
                'label'=>'Lastname',
                'rules'=>'required|min_length[2]|max_length[15]|regex_match[/^[a-zA-Z ]*$/]',
                'errors'=>'%s is too short'


            ),
            array(
                'field'=>'email',
                'label'=>'Email',
                'rules'=>'required|valid_email|is_unique[users.email]',
                'errors'=>'%s is unvalid'

            ),
            array(
                'field'=>'pwd',
                'label'=>'Password',
                'rules'=>'required|trim|min_length[8]|max_length[15]|regex_match[/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/]',
                'errors'=>'%s must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit'
            ),
            array(
                'field'=>'gender',
                'label'=>'Gender',
                'rules'=>'required'

            )
        );
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $myObj =new stdClass();
            $myObj->result="not_valid";
            $myObj->validationError=validation_errors();
            $myJSON=json_encode($myObj);
            echo $myJSON;
                    
        }else{
            $gender;
            if($this->input->post('gender')=='male'){
                $gender=1;
            }else if($this->input->post('gender')=='female'){
                $gender=2;
            }else{
                $gender=3;
            }
                    
                        
                        $data=array(
                            'firstName'=>$this->input->post('firstname'),
                            'lastName'=>$this->input->post('lastname'),
                            'email'=>$this->input->post('email'),
                            'pwd'=>password_hash($this->input->post('pwd'), PASSWORD_BCRYPT),
                            'gender'=>$gender,
                            'hash'=>md5(rand(0, 1000))
                        );

                        if($id=$this->Signup_Model->insert($data)){
                            $data['id']=$id;
                            $_SESSION['email']=$data['email'];
                            $_SESSION['logged_in']=TRUE;
                            $_SESSION['uid']=$id;
                            $_SESSION['uName']=$data['firstName'].' '.$data['lastName'];
                            if($this->Signup_Model->sendEmail($data)){

                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered.<br/> Please first confirm the mail that has been sent to your email to use the WebSite.
                                <a href='.base_url().'index.php/home>Go Home</a></div>');

                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->uid=$_SESSION['uid'];
                                $myObj->uName=$_SESSION['uName'];
                                $myJSON=json_encode($myObj);
                                echo $myJSON;

                            }else{
                                
                                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to send confirmation email Please check your email address and try again.
                                <a href='.base_url().'index.php/regist/signup/sendemail>Send Email Again</a></div>
                                <div><a href='.base_url().'index.php/user/settings/updateemail>Update Email</a></div>');
                                
                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->uid=$_SESSION['uid'];
                                $myObj->uName=$_SESSION['uName'];
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
                                


                                
                            
                        }
                        
                }else{
                    $myObj =new stdClass();
                    $myObj->result="fail";
                                $myJSON=json_encode($myObj);
                                echo $myJSON;

                    
                                // $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">error in inserting your data. Please Signup again.
                                // <a href='.base_url().'index.php/regist/signup>Signup</a></div>');
                                // redirect('message');

                                

                        }
        }


        





    }else{
        echo "Something Went Wrong";
    }
    }


    public function signupWithFacebook(){

        $data=json_decode($this->input->post('data'));


        $gender;
        if($data->gender=='male'){
            $gender=1;
        }else if($data->gender=='female'){
            $gender=2;
        }else{
            $gender=3;
        }

        $verified;
        if($data->verified==true){
            $verified=1;
        }else{
            $verified=0;
        }

        $email;
        if(isset($data->email)){
            $email=$data->email;

        }else{
            $email='null';
        }

        $data_array=array(
            'google_subject'=>$data->id,
            'firstName'=>$data->first_name,
            'lastName'=>$data->last_name,
            'email'=>$email,
            'gender'=>$gender,
            'verified'=>$verified
        );
                
    if($query=$this->Signup_Model->getGoogleUserRow($data_array['google_subject'])){

        $_SESSION['email']=$email;
        $_SESSION['logged_in']=TRUE;
        $_SESSION['uid']=$query->user_id;
        $_SESSION['uName']=$data->name;

        
        
        $myObj =new stdClass();
        $myObj->result="success";
        $myObj->uid=$_SESSION['uid'];
        $myObj->uName=$_SESSION['uName'];      
        $myObj->fbUserId=$data->id;                  
        $myJSON=json_encode($myObj);
        echo $myJSON;
        
                    

                }else{

                    

                    if($id=$this->Signup_Model->insert($data_array)){

                        $_SESSION['email']=$data_array['email'];
                        $_SESSION['logged_in']=TRUE;
                        $_SESSION['uid']=$id;
                        $_SESSION['uName']=$data->name;
                        
                        $myObj =new stdClass();
                        $myObj->result="success";
                        $myObj->uid=$_SESSION['uid'];
                        $myObj->uName=$_SESSION['uName'];
                        $myObj->fbUserId=$data->id;                                          
                        $myJSON=json_encode($myObj);
                        echo $myJSON;
                    }else{
                        $myObj =new stdClass();
                        $myObj->result="error";
                        $myJSON=json_encode($myObj);
                        echo $myJSON;
                    }

                }
    }




public function signupWithGoogle(){
        
                $data=json_decode($this->input->post('data'));
        
        
                $gender;
                if(isset($data->gender)){
                if($data->gender=='male'){
                    $gender=1;
                }else if($data->gender=='female'){
                    $gender=2;
                }else{
                    $gender=3;
                }
            }else{
                $gender=0;
            }
        
                $verified;
                if($data->email_verified==true){
                    $verified=1;
                }else{
                    $verified=0;
                }
        
                $data_array=array(
                    'firstName'=>$data->given_name,
                    'lastName'=>$data->family_name,
                    'email'=>$data->email,
                    'gender'=>$gender,
                    'verified'=>$verified,
                    'google_subject'=>$data->sub
                );
                        
            if($query=$this->Signup_Model->getGoogleUserRow($data_array['google_subject'])){
        
                $_SESSION['email']=$data_array['email'];
                $_SESSION['logged_in']=TRUE;
                $_SESSION['uid']=$query->user_id;
                $_SESSION['uName']=$data_array['firstName'].' '.$data_array['lastName'];
                
                $myObj =new stdClass();
                $myObj->result="success";
                $myObj->uid=$_SESSION['uid'];
                $myObj->uName=$_SESSION['uName'];                        
                $myJSON=json_encode($myObj);
                echo $myJSON;
                
                            
        
            }else if($id=$this->Signup_Model->insert($data_array)){
        
                                $_SESSION['email']=$data_array['email'];
                                $_SESSION['logged_in']=TRUE;
                                $_SESSION['uid']=$id;
                                $_SESSION['uName']=$data_array['firstName'].' '.$data_array['lastName'];
                                
                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->uid=$_SESSION['uid'];
                                $myObj->uName=$_SESSION['uName'];                        
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
            }else{
                                $myObj =new stdClass();
                                $myObj->result="error";
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
            }
        
                        
}

            




    function sendemail(){
        if($_SESSION['logged_in']){
        $result = $this->Signup_Model->get_hash_value($_SESSION['uid']);

        $data=array('id'=>$_SESSION['uid'],
                    'email'=>$_SESSION['email'],
                    'hash'=>$result->hash);
        if($this->Signup_Model->sendEmail($data)){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Email successfully sent. Please confirm the mail that has been sent to your email.
            </div>');

            redirect('message/logmessage');

        }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed!! Please check your email address and try again.
            <a href='.base_url().'index.php/regist/signup/sendemail>Send Email</a></div>');
            redirect('message/logmessage');

        
        }
        }else{
            redirect('regist/login');
        }
    }

    function confirmEmail($id,$hashcode){
        $result = $this->Signup_Model->get_hash_value($id);
        if($result){
            if($result->verified==0 && $result->hash==$hashcode){
                $this->Signup_Model->verifyEmail($id);
                if($_SESSION['logged_in']){
                    $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is confirmed.
                <a href='.base_url().'index.php/home>Go Home</a></div>');
                redirect('message/logmessage');

                }else{
                $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is confirmed. Please login to the system.
                <a href='.base_url().'index.php/regist/login>Login Here</a></div>');
                redirect('message');

                }


            }else{
                if($_SESSION['logged_in']){
                    $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is already confirmed.
                <a href='.base_url().'index.php/home>Go Home</a></div>');
                redirect('message/logmessage');

                }else{
                $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is already confirmed. Please login to the system.
                <a href='.base_url().'index.php/regist/login>Login Here</a></div>');
                redirect('message');

                }

            }
        }else{
            if($_SESSION['logged_in']){
                    $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is not confirmed.
                <a href='.base_url().'index.php/home>Go Home</a></div>');
                redirect('message/logmessage');

                }else{
                $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email address is not confirmed. Please login to the system.
                <a href='.base_url().'index.php/regist/login>Login Here</a></div>');
                redirect('message');

                }
            
        }
    }

    
}