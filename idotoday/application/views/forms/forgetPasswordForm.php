
<div id='forget_pwd_valid'></div>

<?php 
echo validation_errors();
echo form_open('regist/login/userForgetPassword','id="forgetPassForm"');?>

<input type='text' name='token' hidden value='<?php if(isset($_SESSION["login_token"]))echo $_SESSION["login_token"];?>'>

<input type='text' name='email' value='<?php if(isset($_SESSION["uEmail"]))echo $_SESSION["uEmail"]; ?>' placeholder="email" required>

<input type='submit' name='submit' id='forget_pass_btn' value='Send Reset Email'/>

</form>

