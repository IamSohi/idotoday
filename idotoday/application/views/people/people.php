<article id="people">
<h2>People</h2>


<?php 

if(isset($people)){

foreach($people as $item):?>

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
<button class="btn color-pink col-11" type="button" id="connect<?php echo $item['user_id'];?>" name="connect" value="Connect" class="connect" onclick="connect(<?php echo $item['user_id'];?>)">Connect</button>
<button class="btn color-pink col-11" type="button" id="unconnect<?php echo $item['user_id'];?>" name="unconnect" value="unConnect" class="unconnect" onclick="unConnect(<?php echo $item['user_id'];?>)" style="display:none">Connected</button>
</div>

</div>
</div>

   
<?php endforeach;

}?>

</article>
</main>
</div>
</div>
</div>