<?php

class Login_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }

    function getUserRow($email){
        return $this->db->get_where('users',array('email'=>$email))->row();
    }


}