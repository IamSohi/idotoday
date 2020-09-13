<?php

class Message_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }

    public function insertMessage($data){
        if($this->db->insert('messages',$data)){
        return TRUE;      
        }else{
            return FALSE;
        }
    }


    public function getUserMessage($user_id){

        // if($this->db->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")){
        // $this->db->select('users.firstName,users.lastName,messages.*')->from('users');        
        // $this->db->join('messages', 'users.user_id = messages.user_id','inner');
// $this->db->distinct();
        // $this->db->select('m1.*')->from('messages m1');
        // $this->db->where('date_time','SELECT m2.date_time From messages m2 where m2.friend_id=m1.friend_id order By m2.date_time DESC LIMIT 1');

        // $sql='SELECT t1.* FROM messages t1
        // JOIN (SELECT user_id, MAX(date_time) date_time FROM messages GROUP BY user_id) t2
        //   ON t1.user_id = t2.user_id AND t1.date_time = t2.date_time';
        // return $this->db->query('SELECT user_id,MAX(date_time) date_time FROM messages GROUP BY user_id')->result_array();

        $this->db->select('users.firstName,users.lastName,m1.*')->from('messages m1');        
        $this->db->join('(SELECT user_id, MAX(message_id) message_id FROM messages GROUP BY user_id) m2', 'm1.user_id = m2.user_id AND m1.message_id = m2.message_id','inner');
        $this->db->join('users', 'users.user_id = m1.user_id','inner');

        
        $this->db->where(array('friend_id'=>$user_id));
        // $this->db->order_by('date_time','DESC');
        
        // $this->db->limit(1);
        // $this->db->group_by('user_id');
        // $this->db->or_having('messages.date_time=MAX(messages.date_time)');
        
        

        
        
        if($result=$this->db->get()->result_array()){
            return $result;
        }else{
            return false;
        }
    // }
    }

    public function getUserChat($user_id,$friend_id){
        
        $this->db->select('*')->from('messages');
        $where = "user_id='".$user_id."' AND friend_id='".$friend_id."' OR user_id='".$friend_id."' AND friend_id='".$user_id."'";
        
        $this->db->where($where);
        // $this->db->or_where(array('user_id'=>$friend_id,'friend_id'=>$user_id));
        $this->db->order_by('date_time','DESC');
        return $this->db->get()->result_array();


    }

    public function getUserChat2($user_id,$friend_id){
        
        $this->db->select('*')->from('messages');
        $where = "user_id='".$user_id."' AND friend_id='".$friend_id."' OR user_id='".$friend_id."' AND friend_id='".$user_id."'";
        
        $this->db->where($where);
        // $this->db->or_where(array('user_id'=>$friend_id,'friend_id'=>$user_id));
        $this->db->order_by('date_time','ASC');
        return $this->db->get()->result_array();


    }

    public function setMessageViewed($id){
        
        $this->db->set(array('viewed'=>1));
        $this->db->where(array('friend_id'=>$id));
        if($this->db->update('messages')){
            return TRUE;      
        }else{
            return FALSE;
        }


        
    } 


    public function getUserMessageNumber($user_id){
        $this->db->select('*')->from('messages');
        $this->db->where(array('friend_id'=>$user_id,'viewed'=>0));
        $this->db->order_by('date_time','DESC');
        return $this->db->count_all_results();
    }
    

}