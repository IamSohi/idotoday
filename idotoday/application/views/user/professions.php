
<div class="col-sm-8">

<main title='professions' id='uprofessions'>

<?php
if($result!=null){
   foreach($result as $item):?>

    <div id='profession_div_<?php echo $item['profession_id']?>'>

      
   <div class="row mt-3 border rounded border-info"><div class="col-12">
   <div class="row justify-content-between bg-info pt-2 pb-2 rounded">
   <div class="col-9 align-self-center">

   <?php
    
    echo '<span id="u_profession'.$item['profession_id'].'">'.$item['profession'].'</span></div>';

    echo '<a class="mr-2" href="'.base_url().'index.php/people/search/profession/'.$item['profession_id'].'"><i class="input-group-addon fa fa-users" aria-hidden="true"></i></a>';

    echo '</div>';
    
    echo '<div class="row justify-content-between pt-2 pr-1 pl-1 bg-light rounded">';
    if(isset($item['amount_charge']) && isset($item['amount_charge'])=='depends on requirements'){
    echo '<span class="card-subtitle text-muted" id="u_p_price'.$item['profession_id'].'">depends on requirements</span>';
    }else{
    echo '<span class="card-subtitle text-muted" id="u_p_price'.$item['profession_id'].'">'.$item['amount_charge'].'</span>';
    echo '<span class="card-subtitle text-muted" id="u_p_currency'.$item['profession_id'].'">'.$item['currency'].'</span>';
    echo '<span class="card-subtitle text-muted"> per </span>';
    echo '<span class="card-subtitle text-muted" id="u_p_tscale'.$item['profession_id'].'">'.$item['charge_scale'].'</span>';
    }

    echo '<span class="card-subtitle text-muted">'.$item['date_time'].'</span>';
    echo '</div>';
    
    
    echo '<p class="card-text more pt-3" id="u_p_description'.$item['profession_id'].'">'.$item['description'].'</p>';

    echo '<div class="row justify-content-between pr-2 pl-2 pt-1 pb-1 bg-light rounded">';    
    
    echo '<a href="'.base_url().'index.php/find/place/search/'.$item['work_place'].'/profession"><span id="u_p_place'.$item['profession_id'].'">'.$item['work_place'].'</span></a>';
    echo '<a href="'.base_url().'index.php/find/category/search/'.$item['category'].'/profession"><span id="u_p_category'.$item['profession_id'].'">'.$item['category'].'</span></a>';
    echo '</div>';
    
    if($item['user_id']==$_SESSION['uid']){

        echo '<div class="row justify-content-center pt-1 pb-1 rounded">';        
            
        echo '<button  class="btn col-5 btn-info mr-2" type="button" id="update_profession'.$item['profession_id'].'" onclick="updateProfession('.$item["profession_id"].')">Update</button>
        <button class="btn col-5 btn-info mr-2" type="button" id="delete_profession'.$item['profession_id'].'" onclick="deleteProfession('.$item["profession_id"].')" >Delete</button>';
        
        echo '</div>';
        
}



?>
</div>
</div>
</div>
</div>
   
   
 

 
   


<?php endforeach;}else{
    echo '<span>No Profession To Show</span>';

}
?>


</main>
</div>