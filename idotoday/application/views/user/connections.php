<div class="col-sm-8">
<div class="row justify-content-center">

<div class="col-12">
<main>
<h2>People</h2>

<?php 

if(isset($people)){

foreach($people as $item):?>

<?php if($item['connection'] !=NULL ){

if($item['connection']=='Connected'){?>

<div class="row mt-3 border rounded border-secondary bg-light p-2 justify-content-center">
<div class="col-5">
<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" height="100" width="100">
</div>

<div class="col">
<div class="row justify-content-center">
<a class="mb-1" href='<?php echo base_url();?>index.php/users/profile/<?php echo $item['user_id'];?>'><h2> <?php echo $item['firstName'].' '.$item['lastName'];?> </h2></a>
</div>
<div class="row justify-content-center">
<button class="btn color-pink col-11" type="button" id="connect<?php echo $item['user_id'];?>" name="connect" value="Connect" class="connect" onclick="connect(<?php echo $item['user_id'];?>)" style="display:none">Connect</button>
<button class="btn color-pink col-11" type="button" id="unconnect<?php echo $item['user_id'];?>" name="unconnect" value="unConnect" class="unconnect" onclick="unConnect(<?php echo $item['user_id'];?>)">Connected</button>
</div>
</div>

</div>
   
<?php }else{?>

<div class="row mt-3 border rounded border-secondary bg-light p-2 justify-content-center">

<div class="col-5">
<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" height="100" width="100">

</div>
<div class="col">
<div class="row justify-content-center">

<a href='<?php echo base_url();?>index.php/users/profile/<?php echo $item['user_id'];?>'><h3> <?php echo $item['firstName'].' '.$item['lastName'];?> </h3></a>

</div>
<div class="row justify-content-center">
<button class="btn color-pink col-11" type="button" id="connect<?php echo $item['user_id'];?>" name="connect" value="Connect" class="connect" onclick="connect(<?php echo $item['user_id'];?>)">Connect</button>
<button class="btn color-pink col-11" type="button" id="unconnect<?php echo $item['user_id'];?>" name="unconnect" value="unConnect" class="unconnect" onclick="unConnect(<?php echo $item['user_id'];?>)" style="display:none">Connected</button>
</div>

</div>
</div>

<?php }
}else{?>

<div class="row mt-3 border rounded border-secondary bg-light p-2 justify-content-center">
<div class="col-5">
<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" height="100" width="100">
</div>

<div class="col align-self-center">
<div class="row justify-content-center">

<a class="mb-1 align-self-center" href='<?php echo base_url();?>index.php/home'><h2> <?php echo $item['firstName'].' '.$item['lastName'];?> </h2></a>
</div>
</div> 

<?php }endforeach;

}else{
}?>

</main>

<?php
if(isset($searching)){
echo '</div></div></div>';
}else{

}?>
</div>

</div>
</div>