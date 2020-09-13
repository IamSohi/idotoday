<article id='requests_by_place'>
<?php if(isset($requests)){
foreach($requests as $item):
    if(file_exists('uploads/profilePic'.$item['user_id'].'.jpg')){
        echo '<a href='.base_url().'index.php/people/person/'.$item['user_id'].'><img src="'.base_url().'/uploads/profilePic'.$item['user_id'].'.jpg'.'?'.time().'height="100" width="100"/>'.$item['firstName'].' '.$item['lastName'].'</a>';
    }else{
        echo '<a href='.base_url().'index.php/people/person/'.$item['user_id'].'><img src="'.base_url().'/uploads/defaultprofilepic.jpg" height="100" width="100"/>'.$item['firstName'].' '.$item['lastName'].'</a>';
    }
    echo '<h3>'.$item['request'].'</h3>';

    if(isset($item['bounty'])){
        echo '<br/><span>'.$item['bounty'].' '.$item['currency'].'</span>';
    }
    echo '<span>'.$item['date_time'].'</span>';

    if(isset($item['description'])){
        echo '<h4>'.$item['description'].'</h4>';
    }else{
        echo '<h4>No</h4>';
    }
    echo '<a href="'.base_url().'index.php/find/place/search/'.$item['location'].'/requests">'.$item['location'].'</a><span>       </span>';
    echo '<a href="'.base_url().'index.php/find/category/search/'.$item['category'].'/requests">'.$item['category'].'</a><br/>';


    echo '<button type="button" id="accept'.$item['request_id'].'" onclick="acceptRequest("'.$item["request_id"].'") >Accept</button>';
    echo '<button type="button" id="reject'.$item['request_id'].'" onclick="rejectRequest("'.$item["request_id"].'") hidden>Accepted</button><br/><br/><br/>';
    
    endforeach;}?>

    <br/>
    <br/>
    <br/>
    <br/>

</article>
</main>