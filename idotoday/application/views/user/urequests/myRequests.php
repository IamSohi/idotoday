


<article id='myRequests'>

<h2>My Requests</h2>
<?php
if(isset($result)){
   foreach($result as $item):

    echo '<div id="request_div_'.$item['request_id'].'">';
    
    echo '<div class="row mt-3 border rounded border-info"><div class="col-12">';
    echo '<div class="row justify-content-between bg-info pt-2 pb-2 rounded">';
    echo '<div class="col-9">';
    
echo '<span class="align-self-center" id="urequest'.$item['request_id'].'">'.$item['request'].'</span></div>';


if($item['to_who']=='All Around You'){
    // if(file_exists('uploads/profilePic'.$item['accepted_by_user_id'].'.jpg')){
    //     echo '<a href='.base_url().'index.php/people/person/'.$item['accepted_by_user_id'].'><img src="'.base_url().'/uploads/profilePic'.$item['accepted_by_user_id'].'.jpg'.'?'.time().'height="100" width="100"/>'.$item['accepted_by'].'</a>';
    // }else{
    //     echo '<a href='.base_url().'index.php/people/person/'.$item['accepted_by_user_id'].'><img src="'.base_url().'/uploads/defaultprofilepic.jpg" height="100" width="100"/>'.$item['accepted_by'].'</a>';
    // }
    echo '<i class="input-group-addon fa fa-users mr-2" aria-hidden="true"></i>';

    
}else{
    if(file_exists('uploads/profilePic'.$item['to_who'].'.jpg')){
        echo '<a class="mr-2" href='.base_url().'index.php/people/person/'.$item['to_who'].'><img src="'.base_url().'/uploads/profilePic'.$item['to_who'].'.jpg'.'?'.time().' class="rounded-circle" height="40" width="40"/><span id="utoWhom'.$item['request_id'].'" hidden>'.$item['firstName'].' '.$item['lastName'].'</span></a>';
        echo '<span id="toWho_user_id'.$item['request_id'].'" hidden>'.$item['to_who'].'</span>';
    }else{
        echo '<a class="mr-2" href='.base_url().'index.php/people/person/'.$item['to_who'].'><img src="'.base_url().'/uploads/defaultprofilepic.jpg" class="rounded-circle" height="40" width="40"/><span id="utoWhom'.$item['request_id'].'" hidden>'.$item['firstName'].' '.$item['lastName'].'</span></a>';
        echo '<span id="toWho_user_id'.$item['request_id'].'" hidden>'.$item['to_who'].'</span>';
        
    }

}
echo '</div>';

echo '<div class="row justify-content-between pt-2 pr-1 pl-1 bg-light rounded">'; 
if(isset($item['bounty'])){
    echo '<span class="card-subtitle text-muted" id="ubounty'.$item['request_id'].'">'.$item['bounty'].'</span>';
    echo '<span class="card-subtitle text-muted" id="ucurrency'.$item['request_id'].'"> '.$item['currency'].'</span>';
}
echo '<span class="card-subtitle text-muted">'.$item['date_time'].'</span>';
echo '</div>';


if(isset($item['description'])){

    echo '<p class="card-text more pt-3" id="udescription'.$item['request_id'].'">'.$item['description'].'</p>';
}
echo '<div class="row justify-content-between pr-2 pl-2 pt-1 pb-1 bg-light rounded">';       

echo '<a href="'.base_url().'index.php/find/place/search/'.$item['location'].'/requests"><span id="uplace'.$item['request_id'].'">'.$item['location'].'</span></a><span>       </span>';
echo '<a href="'.base_url().'index.php/find/category/search/'.$item['category'].'/requests"><span id="ucategory'.$item['request_id'].'">'.$item['category'].'</span></a>';
echo '</div>';
    

if(isset($item['accepted_by'])){
    echo '<div class="row justify-content-center align-items-center pt-1 pb-1 rounded">';
    
    if(file_exists('uploads/profilePic'.$item['accepted_by_user_id'].'.jpg')){
        echo '<span class="card-subtitle text-muted">Accepted by:</span>';
        echo '<a href='.base_url().'index.php/people/person/'.$item['accepted_by_user_id'].'><img src="'.base_url().'/uploads/profilePic'.$item['accepted_by_user_id'].'.jpg'.'?'.time().' class="rounded-circle ml-3 mr-3" height="40" width="40"/>'.$item['accepted_by'].'</a>';
    }else{
        echo '<span class="card-subtitle text-muted">Accepted by:</span>';
        echo '<a href='.base_url().'index.php/people/person/'.$item['accepted_by_user_id'].'><img src="'.base_url().'/uploads/defaultprofilepic.jpg" class="rounded-circle ml-3 mr-3" height="40" width="40"/>'.$item['accepted_by'].'</a>';
    }
    echo '</div>';
    
}else{
    echo '<div class="row justify-content-center pt-1 pb-1 rounded">';
echo '<span class="card-subtitle text-muted">Not yet Accepted</span>';
echo '</div>';
echo '<div class="row justify-content-center pt-1 pb-1 rounded">';
echo '<button class="btn col-5 btn-info mr-2" type="button" id="update_request'.$item['request_id'].'" onclick="updateRequest('.$item["request_id"].')">Update</button>';
echo '<button class="btn col-5 btn-info ml-2" type="button" id="delete_request'.$item['request_id'].'" onclick="deleteRequest('.$item["request_id"].')" >Delete</button>';
echo '</div>';

}?>



</div>
</div>
</div>
</div>



   
   
<?php endforeach;
}else{
    echo '<h3>No Request By You</h3>';
}?>
</article>
</main>
</div>
