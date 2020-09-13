<h1>My Profile</h1>

<?php echo validation_errors(); ?>
<?php echo form_open('user/profile/edit'); ?>





<h3>Work Status</h3><input type='text' name='workStatus' value='<?php echo $workStatus; ?>' required>
<h3>Do yo love what you do?</h3>
<input type='radio' name='loveYourWork' value='true' required id='loveYourWork'>I do
<input type='radio' name='loveYourWork' value='false' required>I donot
<h3>My Passion</h3><input type='text' name='passion' value='<?php echo $passion; ?>' required>
<h3>MY Purpose</h3><input type='text' name='purpose' value='<?php echo $purpose; ?>' required >
<h3>Do you believe what you do?</h3>
<input type='radio' name='beleive'  id='believe' value='true' required>I do
<input type='radio' name='beleive' value='false' required>I donot
<h3>My Profession</h3><input type='text' name='profession' value='<?php echo $Profession; ?>' >
<h3>Work Place</h3><input type='text' name='workPlace' value='<?php echo $workPlace; ?>' required>


<h3>Date of Birth</h3><input type='date' name='dob' value='<?php echo $dob; ?>' >
<h3>City</h3><input type='text' name='city' value='<?php echo $city; ?>' >
<h3>Phone Number</h3><input type='number' name='number' value='<?php echo $number; ?>' >

<input type='submit' name='submit' value='Submit'>

</form>


<script>
if(<?php echo $believeWork; ?>==1){

    document.getElementById('believe').checked=true;
}
if(<?php echo $loveWork; ?>==1){

    document.getElementById('loveYourWork').checked=true;
}



</script>