
<main>
<h2>People</h2>

<?php 

if(isset($people)){

foreach($people as $item):?>

<?php if($item['connection'] !=NULL ){

if($item['connection']=='Connected'){?>
<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" id="preview" height="42" width="42">
<a href="<?php echo base_url();?>index.php/users/profile/<?php echo $item['user_id'];?>"><h3> <?php echo $item['firstName'].' '.$item['lastName'];?> </h3></a>

<button type='button' id='connect<?php echo $item["user_id"];?>' name='connect' value='Connect' class='connect' onclick='connect2(<?php echo $item["user_id"];?>)'hidden>Connect</button>
<button type='button' id='unconnect<?php echo $item["user_id"];?>' name='unconnect' value='unConnect' class='unconnect' onclick='unConnect2(<?php echo $item["user_id"];?>)'>Connected</button>





<br/>

   
<?php }else{?>

<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" id="preview" height="42" width="42">
<a href='<?php echo base_url();?>index.php/users/profile/<?php echo $item['user_id'];?>'><h3> <?php echo $item['firstName'].' '.$item['lastName'];?> </h3></a>


<button type='button' id='connect<?php echo $item["user_id"];?>' name='connect' value='Connect' class='connect' onclick='connect2(<?php echo $item["user_id"];?>)'>Connect</button>
<button type='button' id='unconnect<?php echo $item["user_id"];?>' name='unconnect' value='unConnect' class='unconnect' onclick='unConnect2(<?php echo $item["user_id"];?>)'hidden>Connected</button>

<br/>
<?php }
}else{?>


<img src="<?php if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
echo base_url().'uploads/profilePic'.$item['user_id'].'.jpg';
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" id="preview" height="42" width="42">
<a href='<?php echo base_url();?>index.php/home'><h3> <?php echo $item['firstName'].' '.$item['lastName'];?> </h3></a>


<?php }endforeach;

}else{
}?>

</main>
<!-- </div>
</div>
</div> -->