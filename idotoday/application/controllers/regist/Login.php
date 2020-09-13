<?php

class Login extends CI_Controller{

    function __construct(){
        parent::__construct();
        
         $this->load->helper('form'); 
         $this->load->helper('url');
         $this->load->database();
         $this->load->model('Login_Model');
         $this->load->model('Signup_Model');
         $this->load->model('User_Model');
         $this->load->model('Settings_Model');
         $this->load->library('session');
        $this->load->library('form_validation');
        // $this->load->library('MyFormValidation');
        



    }

    public function index(){
        if(!isset($_SESSION['login_token'])){
            $_SESSION['login_token']=md5(uniqid(rand(), true));
        }

        $this->load->view('layout/header');
        $this->load->view('headers/LoginHeader');
        $this->load->view('forms/loginform');
        $this->load->view('layout/footer');

    }

    public function forgetPassword(){
        if(!isset($_SESSION['forget_pass_token'])){
            $_SESSION['forget_pass_token']=md5(uniqid(rand(), true));
        }

        $this->load->view('layout/header');
        $this->load->view('headers/LoginHeader');
        $this->load->view('forms/forgetPasswordForm');
        $this->load->view('layout/footer');

    }

    public function loggedIn(){

        $email=$_POST['email'];
        $pwd=$_POST['pwd'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($query=$this->Login_Model->getUserRow($email)){
                
                if(password_verify($pwd, $query->pwd)){
                    $_SESSION['email']=$email;
                    $_SESSION['logged_in']=TRUE;
                    $_SESSION['uid']=$query->user_id;
                    $_SESSION['uName']=$query->firstName.' '.$query->lastName;
                $myObj =new stdClass();
                $myObj->result="success";
                $myObj->uid=$_SESSION['uid'];
                $myObj->uName=$_SESSION['uName'];
                $myJSON=json_encode($myObj);
                echo $myJSON;
    
                } else{
                    // echo 'pwd';
                    redirect('regist/login');
                    
    
                }
                }else{
                    // echo 'exist';
                    
                    redirect('regist/login');
                }
    
        }else{
            // echo 'email';
            
            redirect('regist/login');
        }


    }

    public function logitin(){

        if($this->input->post('token')==$_SESSION['login_token']){

        $config=array(
            array(
                'field'=>'email',
                'label'=>'Email',
                'rules'=>'required|valid_email|notGoogleOrFacebook',
                'errors'=>'%s unvalid %d already signed in with google'

            ),
            array(
                'field'=>'pwd',
                'label'=>'Password',
                'rules'=>'required|trim|min_length[8]|max_length[15]'
            )

            

        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){

            $myObj =new stdClass();
            $myObj->result="not_valid";
            $myObj->validationError=validation_errors();
            $myJSON=json_encode($myObj);
            echo $myJSON;



        }else if($query=$this->Login_Model->getUserRow($this->input->post('email'))){
            

            // $result=$query->row_array();

            if(password_verify($this->input->post('pwd'), $query->pwd)){
                $_SESSION['email']=$this->input->post('email');
                $_SESSION['logged_in']=TRUE;
                $_SESSION['uid']=$query->user_id;
                $_SESSION['uName']=$query->firstName.' '.$query->lastName;
            $myObj =new stdClass();
            $myObj->result="success";
            $myObj->uid=$_SESSION['uid'];
            $myObj->uName=$_SESSION['uName'];
            $myJSON=json_encode($myObj);
            echo $myJSON;

            } else{

            $myObj =new stdClass();
            $myObj->result="wrong_password";
            $myJSON=json_encode($myObj);
            echo $myJSON;

            }
            }else{
                $myObj =new stdClass();
            $myObj->result="email_not_exist";
            $myJSON=json_encode($myObj);
            echo $myJSON;
            }

    }else{
        echo "Something Went Wrong";
    }

    }

    public function loginWithFacebook() {

        $fbUserId=$_POST['fbUserId'];
        if($query=$this->Signup_Model->getGoogleUserRow($fbUserId)){

            $email;
            if(isset($query->email)){
                $email=$query->email;

            }else{
                $email='null';
            }
            
                    $_SESSION['email']=$email;
                    $_SESSION['logged_in']=TRUE;
                    $_SESSION['uid']=$query->user_id;
                    $_SESSION['uName']=$query->firstName.' '.$query->lastName;
                    
                    
                    
                    $myObj =new stdClass();
                    $myObj->result="success";
                    $myObj->uid=$_SESSION['uid'];
                    $myObj->uName=$_SESSION['uName'];      
                    $myObj->fbUserId=$fbUserId;                  
                    $myJSON=json_encode($myObj);
                    echo $myJSON;
                    
                                
            
            }else{
                redirect('regist/login');
                
                
            }
    }

    public function loginWithGoogle() {
        $googleSub=$_POST['googleSub'];
        if($query=$this->Signup_Model->getGoogleUserRow($googleSub)){

            $email;
            if(isset($query->email)){
                $email=$query->email;

            }else{
                $email='null';
            }
            
                    $_SESSION['email']=$email;
                    $_SESSION['logged_in']=TRUE;
                    $_SESSION['uid']=$query->user_id;
                    $_SESSION['uName']=$query->firstName.' '.$query->lastName;
                    
                    
                    
                    $myObj =new stdClass();
                    $myObj->result="success";
                    $myObj->uid=$_SESSION['uid'];
                    $myObj->uName=$_SESSION['uName'];      
                    $myJSON=json_encode($myObj);
                    echo $myJSON;
                    
                                
            
            }else{
                redirect('regist/login');
                
                
            }
    }


    public function userForgetPassword(){

        if($this->input->post('token')==$_SESSION['login_token']){
            
                    $config=array(
                        array(
                            'field'=>'email',
                            'label'=>'Email',
                            'rules'=>'required|valid_email',
                            'errors'=>'%s unvalid'
            
                        )
            
                    );
                    $this->form_validation->set_rules($config);
            
                    if ($this->form_validation->run() == FALSE){
            
                        self::forgetPassword();
            
            
            
                    }else if($query=$this->Login_Model->getUserRow($this->input->post('email'))){
                        $data=array(
                            'pwd_reset_hash'=>md5(rand(0, 1000))
                        );

                        if($this->User_Model->update('users',$data,array('email'=>$this->input->post('email')))){

                            $data['email']=$this->input->post('email');
                            $data['id']=$query->user_id;
            
                        // $result=$query->row_array();
                        if($this->Settings_Model->sendResetEmail($data)){

                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered.<br/> Please first confirm the mail that has been sent to your email to use the WebSite.
                                <a href='.base_url().'index.php/home>Go Home</a></div>');
                                redirect('message');


                            }else{
                                
                                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to send confirmation email Please check your email address and try again.
                                <a href='.base_url().'index.php/regist/signup/sendemail>Send Email Again</a></div>
                                <div><a href='.base_url().'index.php/user/settings/updateemail>Update Email</a></div>');
                                redirect('message');
                                
                                


                                
                            
                        }
                    }
            
                        }else{
                            $myObj =new stdClass();
                        $myObj->result="email_not_exist";
                        $myJSON=json_encode($myObj);
                        echo $myJSON;
                        }
            
                }else{
                    echo "Something Went Wrong";
                }

    }



    function resetpass($id,$hashcode){

        $result = $this->Signup_Model->get_reset_pass_hash_value($id);
        if($result){
            if($result->pwd_reset_hash==$hashcode){
                
        if(!isset($_SESSION['reset_pass_token'])){
            $_SESSION['reset_pass_token']=md5(uniqid(rand(), true));
        }
        $_SESSION['uid']=$id;
                $this->load->view('layout/header');
                $this->load->view('headers/mainHeader');                            
                $this->load->view('forms/resetPasswordForm');
                $this->load->view('layout/footer');


            

            
        }else{
            
            $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Wrong Token.
            <a href='.base_url().'index.php/regist/login>Login Here</a></div>');
            redirect('message');
            
        }
        
                
    }



}
}