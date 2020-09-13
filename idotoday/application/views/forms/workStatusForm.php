
<div class="col-sm-8">
<div class="row justify-content-center mt-3">
<h2 class="font-bold">Share What You're Doing</h2>
</div>

<div class="row justify-content-center mt-4">
<div class="col-sm-12">
<?php echo validation_errors(); ?>
<?php echo form_open('user/workstatus/updatestatus','id="workstatusForm"'); ?>

 <input type="text" name="token" hidden value="<?php if(isset($_SESSION["workstatus_token"]))echo $_SESSION["workstatus_token"];?>">


<div class="form-group">
<div class="input-group">

<input type="text"  class="form-control" name="status" placeholder="Work Status" value="<?php if(isset($workStatus)) echo $workStatus;?>">
<div class="input-group-addon"><a href="<?php echo base_url().'index.php/people/search/workstatus/'.strtolower($workStatus);?>"><i class="input-group-addon fa fa-users d-inline" aria-hidden="true"></i></a>
</div>
</div>
</div>

<div class="form-group">
<textarea class="form-control" name="description" class placeholder="Description Or Tasks it involves. (Optional)" value="<?php if(isset($description)) echo $description;?>" rows="4"><?php if(isset($description)) echo $description;?></textarea>
</div>

<div class="form-group">
<input class="form-control" type="text" name="place" value="<?php if(isset($place)) echo $place;?>" placeholder="Place of Work" required>
</div>

<div class="form-group row">
<label for="category" class="col-sm-2 col-form-label">Category</label>
<span id="workstatus_category"hidden><?php if(isset($category)) echo $category;?></span>
<div class="col-sm-10">
<select class="form-control" name="category" id="category" required>
<option value="Art & Design">Art &amp; Design</option>
<option value="Business">Business</option>
<option value="Engineering">Engineering</option>
<option value="Legal">Legal</option>
<option value="Tech">Tech</option>
<option value="Manufacturing">Manufacturing</option>
<option value="Medical & Health">Medical &amp; Health</option>
<option value="Science & Research">Science &amp; Research</option>
<option value="Service">Service</option>
<option value="Sports">Sports</option>
<option value="Travel">Travel</option>
</select>
</div>
</div>


<div class="form-group row">
<label for="feeling" class="col-sm-2 col-form-label">Feeling</label>
<span id="workstatus_feeling" hidden><?php if(isset($feelings)) echo $feelings;?></span>
<div class="col-sm-10">
<select class="form-control" name="feeling" id="feeling">
  <option value="Love-it">Love-it</option>
  <option value="Happy">Happy</option>
  <option value="Free">Free</option>
  <option value="Busy">Busy</option>
</select>
</div>
</div>

<div class="form-group row justify-content-center">
<!-- <div class="col-sm-12"> -->
<input class="btn px-5 btn-info" type="submit" name="submit" id="updateWorkstatus" value="Update">
<!-- </div> -->
</div>

</form>
</div>
</div>
</div>