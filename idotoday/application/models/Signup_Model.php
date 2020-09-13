<?php

class Signup_Model extends CI_Model{


    function __construct(){
        parent::__construct();
        $this->load->library('email');

        // $this->load->database();

    }

    public function insert($data){
        if($this->db->insert('users',$data)){
        $insert_id = $this->db->insert_id();
        self::initialiseTables($insert_id);

        return  $insert_id;        
        }
    }

    public function notGoogleOrFacebook($email){

        $row= $this->db->get_where('users',array('email'=>$email))->row();
        if($row->google_subject==null){
            return true;
        }else{
            return false;
        }
        
    }

    private function initialiseTables($userId){
        $this->db->insert('workstatus',array('user_id'=>$userId));
        $this->db->insert('profilepics',array('user_id'=>$userId));
        $this->db->insert('about',array('user_id'=>$userId));

    }

    public function sendEmail($data){
        $from = "gagefunky789@gmail.com";    //senders email address
        $subject = 'email verification';  //email subject
        
        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
        <a href=\'http://www.localhost/idoo/index.php/regist/Signup/confirmEmail/'.$data['id'].'/'.$data['hash'].'\'>Click Here</a><br><br>Thanks';
        
        
        
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

    public function getUserRow($email){
        
        return $this->db->get_where('users',array('email'=>$email))->row();
    }
    public function verifyUniqueEmail($email){
        
        $this->db->select('email');
        return $this->db->get_where('users',array('email'=>$email))->row();

    }

    public function getGoogleUserRow($google_sub){
        return $this->db->get_where('users',array('google_subject'=>$google_sub))->row();
    }

    public function get_hash_value($id){
        $this->db->select('verified,hash');
        return $this->db->get_where('users',array('user_id'=>$id))->row();
    }

    public function get_reset_pass_hash_value($id){
        $this->db->select('pwd_reset_hash');
        return $this->db->get_where('users',array('user_id'=>$id))->row();
    }

    public function verifyEmail($id){
        $data=array('verified'=>1);
        $this->db->where('user_id',$id);
        return $this->db->update('users', $data);

    }




}