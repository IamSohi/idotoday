<?php

class Requests_Model extends CI_Model{

    function __construct(){
        parent::__construct();


    }

    public function getRequestIdFromHired($user_id){
        $this->db->select('request_id');
        
        return $this->db->get_where('hired', array('user_id'=>$user_id))->result_array();

    }

    public function getUserRequests($user_id){

                $this->db->select('users.firstName,users.lastName,requests.*')->from('users');
                $this->db->join('requests', 'users.user_id = requests.to_who','right');
                $this->db->where('requests.user_id',$user_id);
                
                $this->db->order_by('requests.date_time','DESC');

                return $this->db->get()->result_array();
    }
    public function getHiredUser($request_id){
        
        $this->db->select('users.user_id,users.firstName,users.lastName,hired.*')->from('users');
        $this->db->join('hired', 'hired.user_id = users.user_id','inner');
        $this->db->where('hired.request_id',$request_id);
        return $this->db->get()->row_array();
        // return $array['user_id'];
    }
    public function getAcceptedRequests($user_id){
        
        $this->db->select('users.firstName,users.lastName,requests.*,hired.*,users.user_id')->from('requests');
        $this->db->join('users', 'users.user_id = requests.user_id','left');
        $this->db->join('hired', 'hired.request_id = requests.request_id','left');
        $this->db->where('hired.user_id',$user_id);
        
        $this->db->order_by('hired.date_time','DESC');
        return $this->db->get()->result_array();
        

    }


    public function getRequestFromId($request_id){
        
        return $this->db->get_where('requests', array('request_id'=>$request_id))->result_array();



    }

    public function insertRequest($data){
        if($this->db->insert('requests',$data)){
            // $insert_id = $this->db->insert_id();
        
            return $this->db->insert_id();      
            }else{
                return FALSE;
            }

    }

    public function updateRequest($data,$array){
        
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update('requests')){
            // $insert_id = $this->db->insert_id();
        
            return TRUE;      
            }else{
                return FALSE;
            }

    }

    public function acceptRequest($data){
        if($this->db->insert('hired',$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }

    }

    public function rejectRequest($request_id){
        $data=array('request_id'=>$request_id);
        if($this->db->delete('hired',$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }

    }
    public function getRequestsAround_1(){
        
                // if($this->db->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")){
        
                $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
                $this->db->join('requests', 'users.user_id = requests.user_id','inner');
                $this->db->not_like('to_who', 10000,'after');
                $this->db->order_by('request_id','RANDOM');
                
                $this->db->limit(5);
                $array1=$this->db->get()->result_array();
        
                $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
                $this->db->join('requests', 'users.user_id = requests.user_id','inner');
                $this->db->not_like('to_who', 10000,'after');
                $this->db->order_by('request_id','RANDOM');
                
                $this->db->limit(5);
                $array2=$this->db->get()->result_array();
                return array_merge($array1,$array2);
                // }
            }

    public function getRequestsAround($postal_code){

        // if($this->db->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,ONLY_FULL_GROUP_BY,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")){

        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('postal_code <',$postal_code);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(5);
        $array1=$this->db->get()->result_array();

        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('postal_code >=',$postal_code);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(5);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
        // }
    }


    public function getRewardedRequests($postal_code){
        
        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('postal_code <',$postal_code);
        $this->db->where('bounty !=',0);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(5);
        $array1=$this->db->get()->result_array();

        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('postal_code >=',$postal_code);
        $this->db->where('bounty !=',0);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(5);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    }

    public function getRewardedRequests_1(){
        
        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('bounty !=',0);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('request_id','RANDOM');
        
        $this->db->limit(5);
        $array1=$this->db->get()->result_array();

        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('bounty !=',0);
        $this->db->not_like('to_who', 10000,'after');
        $this->db->order_by('request_id','RANDOM');
        
        $this->db->limit(5);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    }

    public function searchRequests($array){
        $length=sizeof($array);

        $this->db->select('*')->from('requests');
        $this->db->like('request',$array[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('request',$array[$i],'both');
            $this->db->or_like('description',$array[$i],'both');


        }
        return $this->db->get()->result_array();
    }

    public function getRequestsByPlace($place){

        $this->db->select('requests.*,users.firstName,users.lastName')->from('requests');
        $this->db->join('users', 'requests.user_id = users.user_id','inner');
        $this->db->like('location',$place,'both');
        return $this->db->get()->result_array();
    }

    public function getRequestsByPlace2($place){

        // $this->db->select('*')->from('requests');
        // $this->db->like('location',$place,'both');
        // return $this->db->get()->result_array();

        $this->db->select('requests.*,users.firstName,users.lastName')->from('requests');
        $this->db->join('currentlocation', 'requests.user_id = currentlocation.user_id','inner');
        $this->db->join('users', 'requests.user_id = users.user_id','inner');

        $this->db->like('place',$place);
        $this->db->or_like('requests.location',$place);
        $this->db->or_like('locality',$place);
        $this->db->or_like('administrative_area_level_1',$place);
        $this->db->or_like('country',$place);
        $this->db->or_like('requests.postal_code',$place);
        return $this->db->get()->result_array();
    }

    public function getRequestsByCategory($category){

        
        $this->db->select('requests.*,users.firstName,users.lastName')->from('requests');
        $this->db->join('users', 'requests.user_id = users.user_id','inner');
        $this->db->where('category =',$category);
        return $this->db->get()->result_array();



    }



    
}