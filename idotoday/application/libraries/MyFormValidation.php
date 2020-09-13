<?php
class MYFormValidation extends CI_Form_validation{    
     function __construct($config = array()){
          parent::__construct($config);
          
        $this->load->database();
        $this->load->library('email');
        $this->load->model('Signup_Model');
     }

     function notGoogleOrFacebook($email){

        return $this->Signup_Model->notGoogleOrFacebook($email);

         
     }
}