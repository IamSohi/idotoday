<?php

class Settings extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('Signup_Model');
        $this->load->model('Settings_Model');
        
        
        $this->load->library('form_validation');

    }

    function index(){
        if($_SESSION['logged_in']){



            
$result['id']=$_SESSION['uid'];
$result['userName']=$_SESSION['uName'];
$result['userEmail']=$_SESSION['email'];

            $this->load->view('layout/header');
            $this->load->view('headers/mainHeader');
            $this->load->view('user/profile',$result);
            
            $this->load->view('subHeaders/userSubHeader');
            
            $this->load->view('forms/settings',$this->User_Model->getAboutInfo($_SESSION['uid']));
    
    
            $this->load->view('layout/footer');



        }else{
            redirect('regist/login');
        }
            
        
    }

    function updateEmail(){

        
if(!isset($_SESSION['update_email_token'])){
    $_SESSION['update_email_token']=md5(uniqid(rand(), true));
}
        $result['id']=$_SESSION['uid'];
        $result['userName']=$_SESSION['uName'];
        $result['userEmail']=$_SESSION['email'];
        
        $this->load->view('layout/header');
        $this->load->view('headers/mainHeader');
        $this->load->view('user/profile',$result);
                    
        $this->load->view('subHeaders/userSubHeader');
                    
        $this->load->view('forms/updateEmailForm');
            
            
        $this->load->view('layout/footer');

    }

function resetpass(){
        
                
        if(!isset($_SESSION['reset_pass_token'])){
            $_SESSION['reset_pass_token']=md5(uniqid(rand(), true));
        }
                $result['id']=$_SESSION['uid'];
                $result['userName']=$_SESSION['uName'];
                $result['userEmail']=$_SESSION['email'];
                
                $this->load->view('layout/header');
                $this->load->view('headers/mainHeader');
                $this->load->view('user/profile',$result);
                            
                $this->load->view('subHeaders/userSubHeader');
                            
                $this->load->view('forms/resetPasswordForm');
                    
                    
                $this->load->view('layout/footer');
        
}

    function updateUserEmail(){
        if($this->input->post('token')==$_SESSION['update_email_token']){
            $config=array(
                array(
                    'field'=>'email',
                    'label'=>'Email',
                    'rules'=>'required|valid_email|is_unique[users.email]',
                    'errors'=>'%s is unvalid'
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
                        $data=array(
                            'email'=>$this->input->post('email'),
                            'verified'=>0,
                            'hash'=>md5(rand(0, 1000))                            
                        );

                        if($this->Settings_Model->updateEmail($data,array('user_id'=>$_SESSION['uid']))){
                            $data['id']=$_SESSION['uid'];
                            $_SESSION['uEmail']=$data['email'];
                            if($this->Signup_Model->sendEmail($data)){
                                
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully registered.<br/> Please first confirm the mail that has been sent to your email to use the WebSite.
                                <a href='.base_url().'index.php/home>Go Home</a></div>');
                                
                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->email=$_SESSION['uEmail'];
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
                                
                            }else{

                                
                                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to send confirmation email Please check your email address and try again.
                                <a href='.base_url().'index.php/regist/signup/sendemail>Send Email Again</a></div>
                                <div><a href='.base_url().'index.php/user/settings/updateemail>Update Email</a></div>');
                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->email=$_SESSION['uEmail'];
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
                                
                                


                                
                            
                            }
                            



                        }

                            




                    }


        }else{
            echo "Something went wrong";
        }

    }

    function resetPassword(){
        if($this->input->post('token')==$_SESSION['reset_pass_token']){
            $config=array(
                array(
                    'field'=>'pwd',
                    'label'=>'Password',
                    'rules'=>'required|trim|min_length[8]|max_length[15]|regex_match[/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/]',
                    'errors'=>'%s must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit'
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
                        $data=array(
                            'pwd'=>password_hash($this->input->post('pwd'), PASSWORD_BCRYPT),
                        );

                        if($this->Settings_Model->updateEmail($data,array('user_id'=>$_SESSION['uid']))){
                                
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Re.<br/> Please first confirm the mail that has been sent to your email to use the WebSite.
                                <a href='.base_url().'index.php/home>Go Home</a></div>');
                                
                                $myObj =new stdClass();
                                $myObj->result="success";
                                $myObj->pwd=$this->input->post('pwd');
                                $myJSON=json_encode($myObj);
                                echo $myJSON;
                                
                            



                        }

                            




                    }


        }else{
            echo "Something went wrong";
        }


    }

}


?>