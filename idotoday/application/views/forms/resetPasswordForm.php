<?php echo form_open('user/settings/resetpassword','id="resetPasswordForm"');?>

<input type='text' name='token' hidden value='<?php if(isset($_SESSION["reset_pass_token"]))echo $_SESSION["reset_pass_token"];?>'>

<input type='password' name='pwd' placeholder="New Password" required>


</form>

<button type='submit' name='submit' id='reset_Pass_btn'>Reset</button>


