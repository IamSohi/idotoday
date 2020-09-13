
<div class="col-sm-8">

<main>
<?php
echo '<div class="row mt-3"><div class="col-12">';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Passion</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['passion'].'</span>';
echo '<a class="col-3" href="'.base_url().'index.php/people/search/passion/'.$user['passion'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';
echo '</div>';
echo '</div>';
echo '</div>';


echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Purpose</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['purpose'].'</span>';
echo '<a class="col-3" href="'.base_url().'index.php/people/search/purpose/'.$user['purpose'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Lifegoals</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['lifegoals'].'</span>';
echo '<a class="col-3" href="'.base_url().'index.php/people/search/lifegoals/'.$user['lifegoals'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';
echo '</div>';
echo '</div>';
echo '</div>';


echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Date of Birth</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
if($user['dob']==0){
    echo '<span class="col-8 align-self-center justify-content-center"></span>';
}else{
    echo '<span class="col-8 align-self-center justify-content-center">'.$user['dob'].'</span>';
}
echo '<span class="col-3"><i class="input-group-addon fa fa-birthday-cake" aria-hidden="true"></i></span>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Phone Number</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
if($user['phone_number']==0){
    echo '<span class="col-8 align-self-center justify-content-center"></span>';
}else{
    echo '<span class="col-8 align-self-center justify-content-center">'.$user['country_code'].' '.$user['phone_number'].'</span>';
}
echo '<span class="col-3"><i class="input-group-addon fa fa-phone-square" aria-hidden="true"></i></span>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Facebook Url</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['facebook_url'].'</span>';
echo '<a class="col-3" href="'.$user['facebook_url'].'"><i class="input-group-addon fa fa-facebook-official" style="color:#3b538"  aria-hidden="true"></i></a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Twitter Url</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['twitter_url'].'</span>';
echo '<a class="col-3" href="'.$user['twitter_url'].'"><i class="input-group-addon fa fa-twitter-square" style="color:#0084b4" aria-hidden="true"></i></a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-between pt-2 pb-2 rounded">';
echo '<span class="col-sm-4 col-3 align-self-center">Living In</span>';
echo '<div class="col-8">';
echo '<div class="row border rounded border-info">';
echo '<span class="col-8 align-self-center justify-content-center">'.$user['city'].'</span>';
echo '<span class="col-3"><i class="input-group-addon fa fa-home" aria-hidden="true"></i></span>';
echo '</div>';
echo '</div>';
echo '</div>';



    ?>


</div>

<main>
</div>
</div>