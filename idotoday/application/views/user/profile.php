
<div class="row">
<?php if(isset($displaySidebar)){
echo '<div class="col-lg-2 d-none d-lg-block float-lg-left">';

}else{
echo '<div class="col-lg-2 float-lg-left">';
}?>
<div class="row justify-content-center mt-5">
<?php echo form_open_multipart('home/uploadpic','id="picform"'); ?>

<label for='fileinput'>
<div id='preview'>

<img src="<?php if(file_exists('uploads/profilePic'.$id.'.jpg')){
echo base_url().'uploads/profilePic'.$id.'.jpg'.'?'.time();
}else{
echo base_url().'uploads/defaultprofilepic.jpg';} ?>" class="rounded-circle" height="100" width="100"/>
</div>
</label>
<input id='fileinput' class="d-none" name='profilePic'  type='file'/>
</form>
</div>
<div class="row justify-content-center">
<input  type="text" id="user_id_for_js" value="<?php if(isset($id)) echo $id;?>" hidden/>
<h3 id="user_name"><?php if(isset($userName))echo $userName;?></h3>
<h3 id="user_email" hidden ><?php echo $userEmail;?></h3>

</div>