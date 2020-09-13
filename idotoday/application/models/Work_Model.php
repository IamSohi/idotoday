<?php

class Work_Model extends CI_Model{

    function __construct(){
        parent::__construct();

    }
    
    public function insertStatus($data,$array){
        $this->db->set($data);
        $this->db->where($array);
        if($this->db->update('workstatus')){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function insert($table,$data){
        if($this->db->insert($table,$data)){
        // $insert_id = $this->db->insert_id();
    
        return TRUE;      
        }else{
            return FALSE;
        }
    }

    public function getUsers(){
        return $this->db->select('id')->get('users')->result_array();

    }

    public function getUserWorkStatus($id){
        $this->db->select('users.firstName,users.lastName,workstatus.*,users.user_id')->from('users');
        $this->db->join('workstatus', 'users.user_id = workstatus.user_id','inner');
        $this->db->where('users.user_id',$id);
        if($query=$this->db->get()->row_array()){
            return $query;
        }else{
            $this->db->select('user_id,firstName,lastName')->from('users');
            $this->db->where('user_id',$id);
            return $this->db->get()->row_array();
        }
    }
    public function getWorkStatusAtRandom_1(){
        $this->db->select('*')->from('workstatus');
        $this->db->order_by('id','RANDOM');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->select('*')->from('workstatus');
        $this->db->order_by('id','RANDOM');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }


    public function getWorkStatusAtRandom($postal_code){
        $this->db->select('*')->from('workstatus');
        $this->db->where('postal_code <=',$postal_code);
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->select('*')->from('workstatus');
        $this->db->where('postal_code >',$postal_code);
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }

    public function getWorkStatusByCategory($category){

        return $this->db->get_where('workstatus', array('category' => $category))->result_array();

    }
    public function getWorkStatusById($id){
        
                return $this->db->get_where('workstatus', array('id' => $id))->row_array();
        
    }

    public function getProfessionById($id){
        
                return $this->db->get_where('professions', array('profession_id' => $id))->row_array();
        
    }

    public function getWorkStatusByPlace($place){

        $this->db->select('*')->from('workstatus');
        $this->db->like('place',$place);
        return $this->db->get()->result_array();
    }

    public function getWorkStatusByPlace2($place){
        
        $this->db->select('workstatus.*')->from('workstatus');
        $this->db->join('currentlocation', 'workstatus.user_id = currentlocation.user_id','inner');
        $this->db->like('workstatus.place',$place);
        $this->db->or_like('currentlocation.place',$place);
        $this->db->or_like('locality',$place);
        $this->db->or_like('administrative_area_level_1',$place);
        $this->db->or_like('country',$place);
        $this->db->or_like('workstatus.postal_code',$place);
        return $this->db->get()->result_array();
    }


    public function getPeopleByWorkstatus($array){
        $length=sizeof($array);

        $this->db->select('user_id')->from('workstatus');
        $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('workstatus',$array[$i],'both');
        }
        return $this->db->get()->result_array();
    }

    public function searchWorkstatus($array){
        $length=sizeof($array);

        $this->db->select('*')->from('workstatus');
        $this->db->like('workstatus',$array[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('workstatus',$array[$i],'both');
            $this->db->or_like('description',$array[$i],'both');

        }
        return $this->db->get()->result_array();
        
    }
    public function searchProfession($array){
        $length=sizeof($array);

        $this->db->select('*')->from('professions');
        $this->db->like('profession',$array[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('profession',$array[$i],'both');
            $this->db->or_like('description',$array[$i],'both');


        }
        return $this->db->get()->result_array();
    }
    public function getProfessionAtRandom_1(){
        $this->db->select('*')->from('professions');
        $this->db->order_by('profession_id','RANDOM');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->select('*')->from('professions');
        $this->db->order_by('profession_id','RANDOM');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }


    public function getProfessionAtRandom($postal_code){
        $this->db->select('*')->from('professions');
        $this->db->where('postal_code <=',$postal_code);
        $this->db->order_by('postal_code','DESC');
        $this->db->limit(10);
        $array1=$this->db->get()->result_array();

        $this->db->select('*')->from('professions');
        $this->db->where('postal_code >',$postal_code);
        $this->db->order_by('postal_code','ASC');
        $this->db->limit(10);
        $array2=$this->db->get()->result_array();
        return array_merge($array1,$array2);
    // return $query->result_array();
    }

    public function getProfessionByCategory($category){

        return $this->db->get_where('professions', array('category' => $category))->result_array();

    }

    public function getProfessionByPlace($place){

        $this->db->select('*')->from('professions');
        $this->db->like('work_place',$place,'both');
        return $this->db->get()->result_array();
    }

    public function getProfessionByPlace2($place){
        
        $this->db->select('professions.*')->from('professions');
        $this->db->join('currentlocation', 'professions.user_id = currentlocation.user_id','inner');
        $this->db->like('work_place',$place);
        $this->db->or_like('place',$place);
        $this->db->or_like('locality',$place);
        $this->db->or_like('administrative_area_level_1',$place);
        $this->db->or_like('country',$place);
        $this->db->or_like('professions.postal_code',$place);
        return $this->db->get()->result_array();
    }

    

    public function getPeopleByProfession($profession){
        $length=sizeof($profession);

        $this->db->select('user_id')->from('professions');
        $this->db->like('profession',$profession[0],'both');
        for($i=0;$i<$length;$i++){
            $this->db->or_like('profession',$profession[$i],'both');
        }
        return $this->db->get()->result_array();
    }



    

}