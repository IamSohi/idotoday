<?php

class Home extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->library('form_validation');


    }

    public function index(){

        if($_SESSION['logged_in']){
            if($loc=$this->User_Model->getUserCurrentLocation($_SESSION['uid'])){
                $_SESSION['postal_code']=$loc['postal_code'];
                $_SESSION['locality']=$loc['locality'];
                $_SESSION['place']=$loc['place'];
            }
            redirect('user/workstatus');

         }else{
                redirect('regist/login');
        }


    }

    public function updateUserName(){
        $json=json_decode(stripslashes($_POST['data']), true);
        echo $json.userName;

        // $this->User_Model->updateUserName($json.userName);

    }

    public function storeCurrentLocation(){

        $array =explode(",",$_POST['latlog'],2);
        $data=array(
            "user_id"=>$_SESSION['uid'],
            "place"=>$_POST['political'],
            "administrative_area_level_1"=>$_POST['level'],
            "country"=>$_POST['country'],
            "postal_code"=>$_POST['pincode'],
            "lat"=>$array[0],
            "log"=>$array[1],
            "place_id"=>$_POST['place_id'],
            "locality"=>$_POST['locality']

        );

        $this->User_Model->insertCurrentLocation($data);
        $_SESSION['postal_code']=$_POST['pincode'];
        $_SESSION['locality']=$_POST['locality'];
        $_SESSION['place']=$_POST['political'];

    }

    public function checkForSameLocation(){
        
        $lat=$_POST['lat'];
        $log=$_POST['log'];

        $patternArray=array(
            'col_name'=>'lat',
            'match'=>substr($lat,0,5),
            'wildcard'=>'after'
        );

        $patternArray2=array(
            'col_name'=>'log',
            'match'=>substr($log,0,5),
            'wildcard'=>'after'
        );

      if($result=$this->User_Model->getRowArrayWithPattern('currentlocation',array('user_id'=>$_SESSION['uid']),$patternArray,$patternArray2)){
            $data=array(
                'lat'=>$lat,
                'log'=>$log
            );

        $this->User_Model->updateCurrentLocation($data,array('location_id'=>$result['location_id']));

        // $result=$this->User_Model->getRowArray('currentlocation',array('user_id'=>$_SESSION['uid']));
// echo $result;

        
        // if(preg_match("/^[".$lat."]{5}/",$result['lat'])&&preg_match("/^[".$log."]{5}/",$result['log'])){

            $_SESSION['postal_code']=$result['postal_code'];
            $_SESSION['locality']=$result['locality'];
            $_SESSION['place']=$result['place'];
            // echo "success";
            $myObj =new stdClass();
            $myObj->result="success";
            $myObj->postal_code=$result['postal_code'];
            $myObj->locality=$result['locality'];
            $myObj->place=$result['place'];
            $myJSON=json_encode($myObj);
            echo $myJSON;

        }else{
            $myObj =new stdClass();
            $myObj->result="fail";
            $myJSON=json_encode($myObj);
            echo $myJSON;
            
        }

    }

    public function updatetable(){
        
        $this->User_Model->update_table(array('user_id'=>$_SESSION['uid']));
        echo "done";
    }



    public function uploadpic(){


        if(empty($_FILES['profilePic'])){
            echo '<img src='.base_url().'uploads/profilePic'.$_SESSION['uid'].'.jpg?'.time().'>';
            return;
        }else{

        
        $path =base_url();
        // echo pathinfo($path.'uploads/'.$_FILES['profilePic']['name'],PATHINFO_EXTENSION);

        

        $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
         $config['max_size']      = 5000; 
         $config['max_width']     = 0; 
         $config['max_height']    = 0;
         $config['file_name']     = 'profilePic'.$_SESSION['uid'].'.'.pathinfo($path.'uploads/'.$_FILES['profilePic']['name'],PATHINFO_EXTENSION);
         $this->load->library('upload', $config);

        //  echo $path.'uploads/'.$config['file_name'];

         $data=array(
             'imageName'=> $config['file_name']
         );


         $this->User_Model->imageUpload($data,$_SESSION['uid']);



         if( file_exists('uploads/'.$config['file_name'])){
             unlink('uploads/'.$config['file_name']);

         }

         if ( ! $this->upload->do_upload('profilePic')) {
             

        $error = array('error' => $this->upload->display_errors()); 
        print $error['error'];
       }else{

           list($width, $height) = getimagesize('uploads/'.$config['file_name']);
        //    redirect('user/profile');
$config1['image_library'] = 'gd2';
$config1['source_image'] = 'uploads/'.$config['file_name'];
$config1['new_image']='uploads/profilePic'.$_SESSION['uid'].'.jpg';
$config1['maintain_ratio']='false';

if($height>=$width){
$config1['master_dim'] = 'width';
$config1['width']         = $width;
$config1['height']       = $width;
}else{
    $config1['master_dim'] = 'height';
$config1['width']         = $height;
$config1['height']       = $height;

}


$config1['x_axis']         = 0;
$config1['y_axis']       = 0;


$this->load->library('image_lib', $config1);

if ( ! $this->image_lib->crop())
{
        echo $this->image_lib->display_errors();
}


$config1['width']         = 300;
$config1['height']       = 300;

$this->image_lib->initialize($config1);

if ( ! $this->image_lib->resize())
{
        echo $this->image_lib->display_errors();
}


           echo '<img src="'.base_url().'uploads/'.$config['file_name'].'?'.time().'"height="100" width="100">';
                       
       }
        }
			
        
        
    }

}