

<!-- <div> -->
<section id='workStatus'>

<?php if(isset($workStatuses)){
foreach($workStatuses as $item):
     
    
    echo '<div class="row mt-3 border rounded border-info"><div class="col-12">';
    echo '<div class="row justify-content-between bg-info pt-2 pb-2 rounded">';
    echo '<div class="col-9 align-self-center">';
    
    echo '<span>'.$item['workStatus'].'</span></div>';
    echo '<a class="mr-2" href="'.base_url().'index.php/people/search/workstatus/'.$item['id'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';
    echo '</div>';
    

    echo '<div class="row justify-content-between pt-2 pr-1 pl-1 bg-light rounded">';
    echo '<span class="card-subtitle text-muted">'.$item['feelings'].'</span>';
    echo '<span class="card-subtitle text-muted">'.$item['date_time'].'</span>';
    echo '</div>';
    
    echo '<p class="card-text more pt-3">'.$item['description'].'</p>';
    
    echo '<div class="row justify-content-between pr-2 pl-2 pt-1 pb-1 bg-light rounded">';
    
    echo '<a class="" href="'.base_url().'index.php/find/place/search/'.$item['place'].'/workstatus">'.$item['place'].'</a>';
    echo '<a class="" href="'.base_url().'index.php/find/category/search/'.$item['category'].'/workstatus">'.$item['category'].'</a>';

    echo '</div>';
    echo '</div>';

    echo '</div>';
    

endforeach;}?>


</section>
</main>
<?php if(isset($searching)){


}else{
    echo '</div></div></div>';
}?>