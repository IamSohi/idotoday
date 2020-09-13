<?php

class People_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }
    
    public function getUsers(){
        return $this->db->select('user_id')->get('users')->result_array();

    }
    public function getUsersData(){
        return $this->db->select('user_id,firstName,lastName,')->get('users')->result_array();

    }

    public function connect($id,$uid){

        $data=array('user_id'=>$uid,'friend_id'=>$id);

        if($this->db->insert('connections',$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }
    }

    public function unConnect($id,$fid){

        $data=array('user_id'=>$id,'friend_id'=>$fid);

        if($this->db->delete('connections',$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }
    }

    public function searchPeople($array){
        $length=sizeof($array);

        $this->db->select('*')->from('users');
        $this->db->like('firstName',$array[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('firstName',$array[$i],'both');
            $this->db->or_like('lastName',$array[$i],'both');

        }
        return $this->db->get()->result_array();
    }

    public function getPeopleByPassion($passion){
        
                $passion_length=sizeof($passion);
        
                $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
                $this->db->join('about', 'users.user_id = about.user_id','inner');        
                // $this->db->like('workstatus',$array[0],'both');
                for($i=0;$i<$passion_length;$i++){
                    $this->db->or_like('passion',$passion[$i],'both');
                }
                return $this->db->get()->result_array();
    }
    public function getPeopleByLifegoals($Lifegoals){
        
                $Lifegoals_length=sizeof($Lifegoals);
        
                $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
                $this->db->join('about', 'users.user_id = about.user_id','inner');        
                // $this->db->like('workstatus',$array[0],'both');
                for($i=0;$i<$Lifegoals_length;$i++){
                    $this->db->or_like('Lifegoals',$Lifegoals[$i],'both');
                }
                return $this->db->get()->result_array();
    }
    public function getPeopleByPurpose($Purpose){
        
                $Purpose_length=sizeof($Purpose);
        
                $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
                $this->db->join('about', 'users.user_id = about.user_id','inner');        
                // $this->db->like('workstatus',$array[0],'both');
                for($i=0;$i<$Purpose_length;$i++){
                    $this->db->or_like('Purpose',$Purpose[$i],'both');
                }
                return $this->db->get()->result_array();
    }





    public function getPeopleByProfession($profession,$description){

        $profession_length=sizeof($profession);
        $description_length=sizeof($description);

        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('professions', 'users.user_id = professions.user_id','inner');        
        // $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$profession_length;$i++){
            $this->db->or_like('profession',$profession[$i],'both');
        }
        for($i=0;$i<$description_length;$i++){
            $this->db->or_like('description',$description[$i],'both');

        }
        return $this->db->get()->result_array();
    }

    public function getPeopleByWorkstatus($workStatus,$description){
        $workStatus_length=sizeof($workStatus);
        $description_length=sizeof($description);

        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('workstatus', 'users.user_id = workstatus.user_id','inner');        
        // $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$workStatus_length;$i++){
            $this->db->or_like('workstatus',$workStatus[$i],'both');
        }
        for($i=0;$i<$description_length;$i++){
            $this->db->or_like('description',$description[$i],'both');

        }
        return $this->db->get()->result_array();
    }

    public function getPeopleByProfession2($profession){

        $profession_length=sizeof($profession);

        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('professions', 'users.user_id = professions.user_id','inner');        
        // $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$profession_length;$i++){
            $this->db->or_like('profession',$profession[$i],'both');
        }
        return $this->db->get()->result_array();
    }

    public function getPeopleByWorkstatus2($workStatus){
        $workStatus_length=sizeof($workStatus);

        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('workstatus', 'users.user_id = workstatus.user_id','inner');        
        // $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$workStatus_length;$i++){
            $this->db->or_like('workstatus',$workStatus[$i],'both');
        }
        return $this->db->get()->result_array();
    }






    public function getUsersAround_1(){
        
        
                $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
                $this->db->join('currentlocation', 'users.user_id = currentlocation.user_id','inner');
                $this->db->order_by('user_id','RANDOM');
                
                $this->db->limit(10);
                $array1=$this->db->get()->result_array();
        
        
                $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
                $this->db->join('currentlocation', 'users.user_id = currentlocation.user_id','inner');
                $this->db->order_by('user_id','RANDOM');
                
                $this->db->limit(10);
                $array2=$this->db->get()->result_array();
                return array_merge($array1,$array2);
                
    }

    public function getUsersAround($postal_code){


        // if($this->db->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")){
        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('currentlocation', 'users.user_id = currentlocation.user_id','inner');
        $this->db->where('postal_code <=',$postal_code);
        // $this->db->group_by('user_id');
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();


        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('currentlocation', 'users.user_id = currentlocation.user_id','inner');
        $this->db->where('postal_code >',$postal_code);
        // $this->db->group_by('user_id');
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
        // }
    }

    public function getProfessionalPeople2($postal_code){
        if($this->db->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'")){

        $this->db->select('users.firstName,users.lastName,professions.profession,users.user_id')->from('users');
        $this->db->join('professions', 'users.user_id = professions.user_id','inner');
        $this->db->where('postal_code <=',$postal_code);
        $this->db->group_by('user_id');
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(2);
        $array1=$this->db->get()->result_array();
        

        $this->db->select('users.firstName,users.lastName,professions.profession,users.user_id')->from('users');
        $this->db->join('professions', 'users.user_id = professions.user_id','inner');
        $this->db->where('postal_code >',$postal_code);
        $this->db->group_by('user_id');
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(2);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    }
    }







    

    public function getUserIdProfessions($postal_code){
        $this->db->distinct();
        $this->db->select('user_id')->from('professions');
        $this->db->where('postal_code <=',$postal_code);
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->distinct();
        $this->db->select('user_id')->from('professions');
        $this->db->where('postal_code >',$postal_code);
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }


    public function getProfessionalPeople($postal_code){
        $this->db->distinct();
        $this->db->select('user_id')->from('professions');
        $this->db->where('postal_code <=',$postal_code);
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->distinct();
        $this->db->select('user_id')->from('professions');
        $this->db->where('postal_code >',$postal_code);
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }

    public function getPeopleByPlace($place){

        $this->db->select('users.firstName,users.lastName,users.user_id')->from('users');
        $this->db->join('currentlocation', 'users.user_id = currentlocation.user_id','inner');
        $this->db->or_like('place',$place);
        $this->db->or_like('locality',$place);
        $this->db->or_like('administrative_area_level_1',$place);
        $this->db->or_like('country',$place);
        $this->db->or_like('postal_code',$place);

        // $this->db->limit(10);
        return $this->db->get()->result_array();
        
        
    }

    



}