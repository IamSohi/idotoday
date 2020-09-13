<?php

class Search extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('People_Model');
        $this->load->model('Work_Model');
        $this->load->library('form_validation');

    }

    public function index(){


    }

    public function search(){
        
    }
    public function searchPeople(){
        
        
        $result['displaySidebar']=true;
        $result['id']=$_SESSION['uid'];
        $result['userName']=$_SESSION['uName'];
        $result['userEmail']=$_SESSION['email'];

        if(isset($_POST['searchPeople'])){
            $name=$_POST['searchPeople'];
            
                $result2['people']=$this->People_Model->searchPeople(explode(" ",$name));


                $userFriendList=$this->User_Model->getUserConnections($_SESSION['uid']);
                
                
                        if(!empty($result2['people'])){
                        foreach ($result2['people'] as $key=>$kid) {
                                // $result2['people'][$key]['user_name']=$this->User_Model->getUserName($id['user_id']);
                
                                if($kid['user_id']===$_SESSION['uid']){
                                    $result2['people'][$key]['connection']=NULL;
                                }else if(isset($userFriendList) && in_array($kid['user_id'],$userFriendList)){
                                    $result2['people'][$key]['connection']='Connected';
                                }else{
                                    $result2['people'][$key]['connection']='Connect';
                
                                }
                                
                            }
                        }

                        $result2['searching']=true;

                    }else{
                        $result2['searching']=true;
                        
                    }
                        
                





                $this->load->view('layout/header');
                $this->load->view('headers/mainHeader');
                
                $this->load->view('user/profile',$result);
                $this->load->view('subHeaders/userSubHeader');
                // $this->load->view('sub_subHeaders/peopleSubHeader');
        
                $this->load->view('people');
                $this->load->view('mainElement',array('mainElementId'=>'people'));
                
                $this->load->view('user/connections',$result2);
                $this->load->view('layout/footer');
                
        
    }
    public function searchWork(){
        $work=$_POST['searchWork'];
        
        $result['displaySidebar']=true;
        $result['id']=$_SESSION['uid'];
        $result['userName']=$_SESSION['uName'];
        $result['userEmail']=$_SESSION['email'];

        
                $result2['workStatuses']=$this->Work_Model->searchWorkstatus(explode(" ",$work));
                $result2['searching']=true;

                $result3['professions']=$this->Work_Model->searchProfession(explode(" ",$work));

                $this->load->view('layout/header');
                $this->load->view('headers/mainHeader');
                $this->load->view('user/profile',$result);
                $this->load->view('subHeaders/userSubHeader');
                
                $this->load->view('sub_subHeaders/workSubHeader',array('searching'=>true));
        
                $this->load->view('work');                
                $this->load->view('mainElement',array('mainElementId'=>'work'));
                $this->load->view('work/workStatus',$result2);
                $this->load->view('work/professions',$result3);
                $this->load->view('layout/footer');
                
        
    }


    

}