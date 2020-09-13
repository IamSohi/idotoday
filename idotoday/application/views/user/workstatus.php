<div class="col-sm-8">

<main>


<div class="row mt-3 border rounded border-info"><div class="col-12">
    <div class="row justify-content-between bg-info pt-2 pb-2 rounded">
    <div class="col-9 align-self-center">

<span><?php if(isset($user['workStatus']))echo $user['workStatus']; ?></span></div>
<?php
echo '<a class="mr-2" href="'.base_url().'index.php/people/search/workstatus/'.$user['id'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';
    echo '</div>';
    

    echo '<div class="row justify-content-between pt-2 pr-1 pl-1 bg-light rounded">';
    echo '<span class="card-subtitle text-muted">'.$user['feelings'].'</span>';
    echo '<span class="card-subtitle text-muted">'.$user['date_time'].'</span>';
    echo '</div>';
    if(isset($user['description'])){
        echo '<p class="card-text more pt-3">'.$user['description'].'</p>';
        
    }
    echo '<div class="row justify-content-between pr-2 pl-2 pt-1 pb-1 bg-light rounded">';

    echo '<a class="" href="'.base_url().'index.php/find/place/search/'.$user['place'].'/workstatus">'.$user['place'].'</a>';
    echo '<a class="" href="'.base_url().'index.php/find/category/search/'.$user['category'].'/workstatus">'.$user['category'].'</a>';

    echo '</div>';
    echo '</div>';

    echo '</div>';    


    ?>
</main>
</div>