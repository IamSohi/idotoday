<div class="row">
<div class="col-lg-2 float-lg-left">
<div class="row justify-content-center mt-5">
<img src="<?php if(file_exists('uploads/profilePic'.$user['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$user['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" height="100" width="100"/>
</div>
<div class="row justify-content-center">
<h3><?php echo $user['firstName'].' '.$user['lastName'];?></h3>
</div>

<div class="row justify-content-center">
<br/>

<?php
$fName='"'.$user['firstName'].' '.$user['lastName'].'"';

 if($connected == 'TRUE'){?>
<a href='<?php echo base_url(); ?>index.php/users/unconnect/<?php echo $user['user_id'];?>'>
<button type='button' id='unconnect<?php echo $user['user_id'];?>' name='unconnect' value='unConnect' class='unconnect'>Connected</button>
</a>

<?php }else{ ?>
    <a href='<?php echo base_url(); ?>index.php/users/connect/<?php echo $user['user_id'];?>'>
<button type='button' id='connect<?php echo $user['user_id'];?>' name='connect' value='Connect' class='connect'>Connect</button></a>

<?php }?>
<button type='button' id='message<?php echo $user['user_id'];?>' name='message' onclick='openMessagePopup(<?php echo $user['user_id'].",".$_SESSION['uid'].",".$fName;?>)'>Message</button>
<a href='<?php echo base_url().'index.php/user/requests/requestuser/'.$user['user_id'];?>'>
<button type='button' id='request<?php echo $user['user_id'];?>' name='requestUser' >Request</button></a>

<div id=result></div>
</div>

<br/>
<div class="row justify-content-center">

<nav class="nav d-flex d-lg-inline">
<a class="nav-link" href="<?php echo base_url(); ?>index.php/user/workstatus/person/<?php echo $user['user_id'];?>">WorkStatus</a>
<a class="nav-link" href="<?php echo base_url(); ?>index.php/user/professions/person/<?php echo $user['user_id'];?>">Professions</a>
<a class="nav-link" href="<?php echo base_url(); ?>index.php/user/about/person/<?php echo $user['user_id'];?>">About</a>
<a class="nav-link" href="<?php echo base_url(); ?>index.php/user/connections/person/<?php echo $user['user_id'];?>">Connections</a>
</nav>
</div>
</div>


<div class="col-lg-8 float-lg-right bg-white">
<div class="row justify-content-center mt-sm-5">