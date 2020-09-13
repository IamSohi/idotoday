
<div>
<?php
if($notifications !=null){
    foreach($notifications as $item):

echo '<div>';
if($item['type_of_notification']==1){
    echo '<a href="'.base_url().'index.php/users/profile/'.$item['sender_id'].'">';
    
}else{
    echo '<a href="'.base_url().'index.php/user/requests">';
    
}

echo $item['notification'];

echo '</a></div>';
echo '<span>'.$item['date_time'].'</span>';

endforeach;}?>
</div>