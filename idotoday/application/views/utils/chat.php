

<!-- <ul> -->
<?php
if($messages !=null){

    foreach($messages as $item):
        if($item['user_id']==$_SESSION['uid']){

        echo '<div class="msj-rta macro mt-3">';
        echo '<div class="text float-right pr-1 pl-1"">';
        echo '<p class="col-form-label-lg">'.$item['message'].'</p>';
        echo '<p><small>'.$item['date_time'].'</small></p>';
        echo '</div>';
        echo '<div class="pr-2" style="padding:0px 0px 0px 10px !important">';
        echo '<a href="'.base_url().'index.php/home"><img class="rounded-circle" style="width:40px;" src="'.base_url().'uploads/profilePic'.$item['user_id'].'" /></a></div>';
        echo '</div>';

        }else{
            
            echo '<div class="msj macro mt-3">';
            echo '<div class="pr-2"><a href="'.base_url().'index.php/user/workstatus/person/'.$item['friend_id'].'"><img class="rounded-circle" style="width:40px;" src="'.base_url().'uploads/profilePic'.$item['friend_id'].'"/></a></div>';
            echo '<div class="text float-left pr-1 pl-1">';
            echo '<p class="col-form-label-lg">'.$item['message'].'</p>';
            echo '<p><small>'.$item['date_time'].'</small></p>';
            echo '</div>';
            echo '</div>';
        }



endforeach;}?>
