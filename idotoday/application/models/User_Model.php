<?php

class User_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }

    public function insert($table,$data,$array){
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update($table)){
        // if($this->db->query("'INSERT INTO '.$table.' (city'"){
        // $insert_id = $this->db->insert_id();
        // return  $insert_id;  
        return TRUE;      
        }else{
            return FALSE;
        }
    }

    public function update($table,$data,$array){
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update($table)){
        // if($this->db->query("'INSERT INTO '.$table.' (city'"){
        // $insert_id = $this->db->insert_id();
        // return  $insert_id;  
        return TRUE;      
        }else{
            return FALSE;
        }
    }


    public function updateCurrentLocation($data,$array){
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update('currentlocation')){
        // if($this->db->query("'INSERT INTO '.$table.' (city'"){
        // $insert_id = $this->db->insert_id();
        // return  $insert_id;  
        return TRUE;      
        }else{
            return FALSE;
        }


    }

    public function getUserCurrentLocation($id){
        if($result=$this->db->get_where('currentlocation',array('user_id'=>$id))->row_array()){
            return $result;
        }else{
            return false;
        }

    }

    public function getUserById($id){
        $this->db->select('user_id,firstName,lastName');
        $this->db->where('user_id',$id);
        return $this->db->get('users')->row_array();

    }



    public function insertCurrentLocation($data){

        $update=array('user_id'=>0);
        self::updateCurrentLocation($update,array('user_id'=>$data['user_id']));
        if($this->db->insert('currentlocation',$data)){
        // if($this->db->query("'INSERT INTO '.$table.' (city'"){
        // $insert_id = $this->db->insert_id();
        // return  $insert_id;  
        return TRUE;      
        }else{
            return FALSE;
        }


    }
    public function getRowArrayWithPattern($table,$array,$pattern_array,$pattern_array2){

        $this->db->select('*')->from($table);
        $this->db->where($array);
        $this->db->like($pattern_array['col_name'],$pattern_array['match'],$pattern_array['wildcard']);
        $this->db->like($pattern_array2['col_name'],$pattern_array2['match'],$pattern_array2['wildcard']);
        return $this->db->get()->row_array();

    }

    public function deleteRow($column_name,$row_id,$table){
        $this->db->where($column_name, $row_id);
        $this->db->delete($table); 
    }
    public function insert_1($table,$data){
        if($this->db->insert($table,$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }
    }




    public function getResultArray($table,$array){
        return $this->db->get_where($table, $array)->result_array();

    }

    public function getRowArray($table,$array){
        return $this->db->get_where($table, $array)->row_array();

    }
    


    public function getResultArrayDesc($table,$array,$column){
        $this->db->order_by($column, 'DESC');
        return $this->db->get_where($table, $array)->result_array();
    }

    public function getHiredRequests(){
        
        $this->db->select('request_id');
        
        $array= $this->db->get('hired')->result_array();

        $array_1=array();

            foreach($array as $row){
                $array_1[]=$row['request_id'];

            }
            return $array_1;

    }
    public function getHiredUser($request_id){
        
        $this->db->select('user_id');
        $array=$this->db->get_where('hired', array('request_id'=>$request_id))->row_array();
        return $array['user_id'];
    }

    public function getUserName($user_id){
        $this->db->select('firstName');

        $firstName=$this->db->get_where('users', array('user_id'=>$user_id))->row_array();
        
        $this->db->select('lastName');

        $lastName=$this->db->get_where('users', array('user_id'=>$user_id))->row_array();

        return $firstName['firstName'].' '.$lastName['lastName'];

    }

    public function getUserName2($user_id){
        $this->db->select('firstName,lastName');
        $userName=$this->db->get_where('users', array('user_id'=>$user_id))->row_array();

        return $userName;

    }

    public function getAllRows($table){
        return $this->db->get($table)->result_array();

    }

    public function imageUpload($data,$id){
        $this->db->set($data);
        $this->db->where('user_id',$id);
        if($this->db->update('profilepics')){
            return True;
        }else{
            return FALSE;
        }

    }

    public function getImageName($id){
        $this->db->select('imageName');
        return $array1= $this->db->get_where('profilepics', array('user_id' => $id))->row_array();
    }

    public function getProfileInfo($id){

        // $this->db->select('dob,city,number');
        // $array1= $this->db->get_where('users', array('id' => $id))->row_array();

        return $this->db->get_where('about', array('user_id' => $id))->row_array();

        // return array_merge($array1,$array2);
        // return $array;

    }

    public function getAboutInfo_1($id){  
        $this->db->select('users.firstName,users.lastName,about.*')->from('users');
        $this->db->join('about', 'users.user_id = about.user_id','inner');
        $this->db->where('users.user_id',$id);
        if($query=$this->db->get()->row_array()){
            return $query;
        }else{
            $this->db->select('user_id,firstName,lastName')->from('users');
            $this->db->where('user_id',$id);
            return $this->db->get()->row_array();
        }
        

    }

    public function getAboutInfo($id){  
        // $this->db->select('users.firstName,users.lastName,about.*')->from('users');
        // $this->db->join('about', 'users.user_id = about.user_id','inner');
        // $this->db->where('users.user_id =',$id);
        // return $this->db->get()->result_array();
        

        // $this->db->select('dob,city,number');
        if($result=$this->db->get_where('about', array('user_id' => $id))->row_array()){
            return $result;
        }else{
            return;
        }

        // $array2= $this->db->get_where('userprofile', array('userId' => $id))->row_array();

        // return array_merge($array1,$array2);
        // return $array;

    }

    public function getRequestsForUser($id){
        
        $this->db->select('users.user_id,users.firstName,users.lastName,requests.*')->from('users');
        $this->db->join('requests', 'users.user_id = requests.user_id','inner');
        $this->db->where('to_Who', $id);
        
        return $this->db->get()->result_array();
        
    }

    public function getUserProfessions($user_id){
        
        $this->db->select('users.firstName,users.lastName,professions.*')->from('users');
        $this->db->join('professions', 'users.user_id = professions.user_id','inner');
        $this->db->where('users.user_id',$user_id);
        return $this->db->get()->result_array();
        // if($this->db->get_where('professions', array('user_id' => $user_id))->result()){
            // return $this->db->get_where('professions', array('user_id' => $user_id))->result_array();
        // }else{
        //     return;
        // }



    }
    public function returnUserInfo($user_id){
        
        $this->db->select('user_id,firstName,lastName')->from('users');
        $this->db->where('user_id',$user_id);
        return $this->db->get()->result_array();
    

    }

    public function getUserConnections($user_id){

        
        $this->db->select('friend_id');
        
        if($array1=$this->db->get_where('connections', array('user_id' => $user_id))->result_array() ){
            // $this->db->select('friend_id');
            //  $this->db->get_where('connections', array('user_id' => $user_id))->result_array();
            $array_1=array();

            foreach($array1 as $row){
                $array_1[]=$row['friend_id'];

            }


            $this->db->select('user_id');
            $array2= $this->db->get_where('connections', array('friend_id' => $user_id))->result_array();
            $array_2=array();
            foreach($array2 as $row){
                $array_2[]=$row['user_id'];

            }

            return array_merge($array_1,$array_2);
        }else{
            return;
        }

    }

    public function getUserConnections_1($user_id){

        

        if($this->db->get_where('connections', array('user_id' => $user_id))->result() ){
            $this->db->select('friend_id');
            $array1= $this->db->get_where('connections', array('user_id' => $user_id))->result_array();
            $array_1=array();

            foreach($array1 as $row){
                $array_1[]=array('user_id'=>$row['friend_id']);

            }


            $this->db->select('user_id');
            $array2= $this->db->get_where('connections', array('friend_id' => $user_id))->result_array();
            $array_2=array();
            foreach($array2 as $row){
                
                $array_2[]=array('user_id'=>$row['user_id']);

            }

            return array_merge($array_1,$array_2);
        }else{
            return;
        }

    }

    public function getUserConnections_3($user_id){

        // $array1=[];

        // if($this->db->get_where('connections', array('user_id' => $user_id))->result() ){
            $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
            $this->db->join('connections', 'users.user_id = connections.friend_id','inner');
            $this->db->where('connections.user_id =',$user_id);
                $array1=$this->db->get()->result_array();

            $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
            $this->db->join('connections', 'users.user_id = connections.user_id','inner');
            $this->db->where('connections.friend_id =',$user_id);
            $array2=$this->db->get()->result_array();
                 return array_merge($array1,$array2);
                 

        

    }



    public function checkFriendship($uid,$fid){

        // return $this->db->get_where('connections', array('user_id' => $uid,'friend_id'=>$fid))->row_array();

        if($uid>$fid){
            if($this->db->get_where('connections', array('user_id' => $uid,'friend_id'=>$fid))->row_array() != null){
                return 'TRUE';
            }else{
                return 'FALSE';
            }
        }else{
            if($this->db->get_where('connections', array('user_id' => $fid,'friend_id'=>$uid))->row_array() !=null){
                return 'TRUE';
            }else{
                return 'FALSE';
            }
        }

    }


    
}