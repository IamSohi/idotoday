
<br/>
<button type='button'  onclick='postReview()'>Post A Review</button>
<?php echo validation_errors(); ?>
<?php echo form_open('user/reviews/post','id="review" hidden'); ?>


<input type='number' name='hire_id' required><br/>
<input type='number' name='rating' required><br/>
<textarea name='review' placeholder='Your Review'  rows="4" cols="50"></textarea><span>(Optional)</span><br/>


<input type='submit' name='submit' value='Post'>

</form>
<br/>
<br/>