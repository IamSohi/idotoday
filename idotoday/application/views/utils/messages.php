
<div>
<?php
if($messages !=null){
    foreach($messages as $item):
        if(isset($SmallScreenChat)){

        
echo '<div>';
echo '<a href="'.base_url().'index.php/user/messages/chat/'.$item['user_id'].'">';
echo $item['firstName'].' '.$item['lastName'].'<br/>';

echo $item['message'];
echo '</a></div>';
echo '<span>'.$item['date_time'].'</span>';
        }else{
            
$fName="'".$item['firstName']." ".$item['lastName']."'";
echo '<div>';
echo '<a href="javascript:openMessagePopup('.$item['user_id'].','.$item['friend_id'].','.$fName.')">';
echo $item['firstName'].' '.$item['lastName'].'<br/>';

echo $item['message'];
echo '</a></div>';
echo '<span>'.$item['date_time'].'</span>';
        }


endforeach;}?>
</div>