<article id='professionals'>

<h1>Professionals</h1>

<?php 

if(isset($professionals)){

foreach($professionals as $item):?>



<img src='<?php echo base_url();?>uploads/defaultprofilepic.jpg' id='preview' height='42' width='42'>
<a href='<?php echo base_url();?>index.php/users/profile/<?php echo $item['user_id'];?>'><h3> <?php echo $item['firstName'].' '.$item['lastName'];?> </h3></a>
<h3> <?php echo $item['profession'];?> </h3>


<button type='button' id='connect<?php echo $item["user_id"];?>' name='connect' value='Connect' class='connect' onclick='connect(<?php echo $item["user_id"];?>)'>Connect</button>
<button type='button' id='unconnect<?php echo $item["user_id"];?>' name='unconnect' value='unConnect' class='unconnect' onclick='unConnect(<?php echo $item["user_id"];?>)'hidden>Connected</button>

<br/>

   
<?php endforeach;

}?>


</article>


<!--<h2>Professionals</h3>-->
<!--<h2>People With same Interest</h2>-->
</main>