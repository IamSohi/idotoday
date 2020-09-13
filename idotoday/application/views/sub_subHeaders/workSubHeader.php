

<?php if(isset($searching)){

    echo '<div class="col-sm-8">';

}else{?>

<div class="col-sm-8">
<div class="row justify-content-around mt-3">
<nav>

<a class="btn-link mr-2" href='javascript:workStatuses()'>WorkStatus</a>
<span>|</span>
<a class="btn-link ml-2" href='javascript:professions()'>Professions</a>

</nav>
</div>

<?php }?>
