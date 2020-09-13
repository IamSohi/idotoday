
<h2>CREATE AN ACCOUNT</h2>

<div id='si_fo_valid'></div>
<?php echo form_open('regist/signup/signitup','id="si_fo"'); ?>
<input type='text' name='token' hidden value='<?php if(isset($_SESSION["signup_token"]))echo $_SESSION["signup_token"];?>'>

<input type='text' name='firstname' placeholder='firstName' value='<?php echo set_value('firstname'); ?>' required>
<input type='text' name='lastname' placeholder='lastName' value='<?php echo set_value('lastname'); ?>' required><br/>
<input type='email' name='email' id='si_em_id' placeholder='eamil or phone' value='<?php echo set_value('email'); ?>' required><br/>
<input type='password' name='pwd' id='si_em_pwd' placeholder='password' required><br/>
<input type='radio' name='gender' value='male' required> Male
<input type='radio' name='gender' value='female' required> Female
<input type='radio'  name='gender' value='other' required> Other<br/>


</form>
<button  id='si_su_bt' name='submit' value='SignUp'>SignUp</button>
