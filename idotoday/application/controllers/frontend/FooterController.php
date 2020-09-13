<?php

class FooterController extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function options($option){
        $this->load->view('footers/'.$option);
    }

}