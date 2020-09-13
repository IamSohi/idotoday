<?php

class Settings_Model extends CI_Model{


    function __construct(){
        parent::__construct();
        $this->load->library('email');

        // $this->load->database();

    }

    public function updateEmail($data,$array){
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update('users')){
        // if($this->db->query("'INSERT INTO '.$table.' (city'"){
        // $insert_id = $this->db->insert_id();
        // return  $insert_id;  
        return TRUE;      
        }else{
            return FALSE;
        }
    }
    

    public function sendResetEmail($data){
        $from = "gagefunky789@gmail.com";    //senders email address
        $subject = 'email verification';  //email subject
        
        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
        <a href=\'http://www.localhost/idoo/index.php/regist/login/resetpass/'.$data['id'].'/'.$data['pwd_reset_hash'].'\'>Click Here</a><br><br>Thanks';
        
        
        
        //config email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'gag@SOHI!!';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n"; 
        
        $this->load->library('email', $config);
		$this->email->initialize($config);
        //send email
        $this->email->from($from);
        $this->email->to($data['email']);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if($this->email->send()){
            return true;
        }else{
            return false;
        }

    }






}