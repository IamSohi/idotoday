<div id='urequests'>

<article id='acceptedRequests'>
<h2>Accepted Requests</h2>

<?php
if(isset($acceptedRequests)){
   foreach($acceptedRequests as $item):
    
        
        echo '<div class="row mt-3 border rounded border-info"><div class="col-12">';
        echo '<div class="row justify-content-between bg-info pt-2 pb-2 rounded">';
        echo '<div class="col-2 pl-sm-3 pr-sm-3 pl-2 pr-2">';

    if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
        echo '<a href='.base_url().'index.php/people/person/'.$item['user_id'].'><img src="'.base_url().'/uploads/profilePic'.$item['user_id'].'.jpg'.'?'.time().' class="rounded-circle" height="40" width="40"/></a>';
    }else{
        echo '<a href='.base_url().'index.php/people/person/'.$item['user_id'].'><img src="'.base_url().'/uploads/defaultprofilepic.jpg" class="rounded-circle" height="40" width="40"/></a>';
    }

     echo '</div>';
     echo '<div class="col align-self-center text-center">';
    echo '<span class="align-self-center">'.$item['request'].'</span></div>';
    echo '<div class="col-2"></div>';
    echo '</div>';

    echo '<div class="row justify-content-between pt-2 pr-1 pl-1 bg-light rounded">';    
    
    if(isset($item['bounty'])){
        echo '<span class="card-subtitle text-muted">'.$item['bounty'].' '.$item['currency'].'</span>';
    }

    echo '</div>';
    
    if(isset($item['description'])){
        echo '<p class="card-text more pt-3">'.$item['description'].'</p>';
    }
    echo '<div class="row justify-content-between pr-2 pl-2 pt-1 pb-1 bg-light rounded">';       

    echo '<a href="'.base_url().'index.php/find/place/search/'.$item['location'].'/requests">'.$item['location'].'</a><span>       </span>';
    echo '<a href="'.base_url().'index.php/find/category/search/'.$item['category'].'/requests">'.$item['category'].'</a>';
    echo '</div>';

    echo 'Accepted on '.$item['date_time'];
    
    echo '<div class="row justify-content-center pt-1 pb-1 rounded">';            

    
    
    echo '<button class="btn col-6 btn-info" type="button" id="accept'.$item['request_id'].'" onclick="acceptRequest('.$item["request_id"].')" style="display:none">Accept</button>';
    echo '<button class="btn col-6 btn-info" type="button" id="reject'.$item['request_id'].'" onclick="rejectRequest('.$item["request_id"].')" >Accepted</button>';
    
    echo '</div>';
    echo '</div>';
    echo '</div>';

endforeach;
}?>

</article>
</main>
</div>