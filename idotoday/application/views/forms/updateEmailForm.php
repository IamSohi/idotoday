
<div id='up_em_valid'></div>
<?php echo form_open('user/settings/updateuseremail','id="updateEmailForm"');?>

<input type='text' name='token' hidden value='<?php if(isset($_SESSION["update_email_token"]))echo $_SESSION["update_email_token"];?>'>

<input type='text' name='email' value='<?php if(isset($_SESSION["uEmail"]))echo $_SESSION["uEmail"]; ?>' placeholder="New Email" required>

</form>

<button type='submit' name='submit' id='update_email_btn'>Update</button>
