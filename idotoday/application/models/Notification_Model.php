<?php

class Notification_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }

    public function insertNotification($data){
        if($this->db->insert('notifications',$data)){
        return TRUE;      
        }else{
            return FALSE;
        }
    }


    public function getUserNotification($user_id){


        $this->db->select('*')->from('notifications');
        $this->db->where(array('recipient_id'=>$user_id));
        $this->db->order_by('date_time','DESC');
        if($result=$this->db->get()->result_array()){
            return $result;
        }else{
            return false;
        }
    }

    public function setNotificationViewed($id){
        
        $this->db->set(array('viewed'=>1));
        $this->db->where(array('recipient_id'=>$id));
        if($this->db->update('notifications')){
            return TRUE;      
        }else{
            return FALSE;
        }


        
    } 


    public function getUserNotificationNumber($user_id){
        $this->db->select('*')->from('notifications');
        $this->db->where(array('recipient_id'=>$user_id,'viewed'=>0));
        $this->db->order_by('date_time','DESC');
        // $this->db->get_where(
        return $this->db->count_all_results();
                // if($result=$this->db->get_where('notifications',array('recipient_id'=>$user_id,'viewed'=>0))->order_by('date_time','DESC')->count_all_results()){
                //     return $result;
                // }else{
                //     return false;
                // }
    }
    

}