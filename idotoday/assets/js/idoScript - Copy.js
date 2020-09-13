

$(document).ready(function() {
$(document).on('change', '#fileinput', function(){
// $('#preview').hide();
$("#picform").ajaxForm({
    target:'#previewa'
}).submit();
});


$(document).on('click', '#aboutSubmit', function(){
// $('#preview').hide();
$("#aboutform").ajaxForm({
    success:function(){
        $('#aboutSubmit').val('Submitted');
    }
});
});
$("#aboutform").change(function(){
   $('#aboutSubmit').val('Submit');
});

$('#request').change(function(){
    $('#submitRequest').val('Request');
    $('#updateRequest').val('Update');

});

$(document).on('click', '#submitRequest', function(){

    // var category=$("select[name='category']").val();
    // var toWhom=$("select[name='toWhom']").val();
    // var currency=$("select[name='currency']").val();
    // alert(category);

// $('#preview').hide();
$("#request").ajaxForm({
    // target:'#urequests',

    
    success:function(result){
        
        // document.getElementById('request').reset();
        // alert(result.filter('#notValid'));
        // alert(result);
        // alert(result);
        

        // var html=result;
        // alert(result);
        alert($(result).find("#notValid").text());
        if($(result).find("#notValid").text()=='NotValid'){
        $('#requestForm').html(result);
        // $('#request').show();
        // $("select[name='category']").val(category);
        // $("select[name='toWhom']").val(toWhom);
        // $("select[name='currency']").val(currency);

    }else{ 
        $('#requestForm').hide();
                    $('#urequests').html(result);

            document.getElementById('request').reset();

            $('#submitRequest').val('Send');



        }
        





        // myRequests();
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
});

$(document).on('click', '#updateRequest', function(){

    
    // var category=$("select[name='category']").val();
    // var toWhom=$("select[name='toWhom']").val();
    // var currency=$("select[name='currency']").val();

        // alert(category);

// $('#preview').hide();
$("#request").ajaxForm({
    // target:'#requestForm',
    url: '../user/requests/updaterequest',
    success:function(result){
        

        if($(result).find("#notValid").text()=='NotValid'){
        $('#requestForm').html(result);

    //     $('#request').show();
    //     $('#submitRequest').hide();
    // $('#updateRequest').show();
    // $('#newRequest').show();
    //     $("select[name='category']").val(category);
    //     $("select[name='toWhom']").val(toWhom);
    //     $("select[name='currency']").val(currency);

    }else{
                $('#requestForm').hide();

        $('#updateRequest').val('Updated');
        // myRequests();
        var id=$("input[name='request_id']").val();

        $('#urequest'+id).html($("input[name='request']").val());
    $('#ucategory'+id).html($("select[name='category']").val());
    $('#udescription'+id).html($("input[name='description']").val());
    $('#uplace'+id).html($("input[name='place']").val());
    $('#utoWhom'+id).html($("select[name='toWhom']").val());
    if($("input[name='bounty']").val()==null){
        $('#ubounty'+id).html('No');
        $('#ucurrency'+id).html('');

    }else{
    $('#ubounty'+id).html($("input[name='bounty']").val());
    $('#ucurrency'+id).html($("select[name='currency']").val());
    // alert($("select[name='currency']").val());
    }
        // document.getElementById('request').reset();
    }
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
});

$(document).on('click', '#updateProfession', function(){
// $('#preview').hide();
$("#professionsForm").ajaxForm({
    // target:'myRequests',
    url: '../user/professions/updateprofession',
    success:function(){
        $('#updateProfession').val('Updated');
        // myRequests();
        var id=$("input[name='profession_id']").val();

        $('#u_profession'+id).html($("input[name='profession']").val());
    $('#u_p_category'+id).html($("select[name='category']").val());
    $('#u_p_description'+id).html($("input[name='description']").val());
    $('#u_p_place'+id).html($("input[name='workplace']").val());
    if($("input[name='price']").val()==null){
        $('#u_p_price'+id).html('No');

    }else{
    $('#u_p_price'+id).html($("input[name='price']").val());
    $('#u_p_currency'+id).html($("select[name='currency']").val());
    $('#u_p_tscale'+id).html($("select[name='timescale']").val());

    }
        // document.getElementById('request').reset();
    }
});
});




$(document).on('click', '#updateWorkstatus', function(){
// $('#preview').hide();
$("#workstatusForm").ajaxForm({
    success:function(){
        $('#updateWorkstatus').val('Updated');
    }
});
});

$("#workstatusForm").change(function(){
   $('#updateWorkstatus').val('Update');
});


$(document).on('click', '#addProfession', function(){
// $('#preview').hide();
$("#professionsForm").ajaxForm({
    target:'#uprofessions',
    success:function(){
        $('#addProfession').val('Added');
        document.getElementById('professionsForm').reset();
    }
});

});


});


function acceptRequest(id){
    // $(".hh").html("UnConnect");

    $.ajax({
url: '../requests/accept/'+id,
});

$('#accept'+id).hide();
$('#reject'+id).show();

}

function rejectRequest(id){
    // $(".hh").html("UnConnect");
    $.ajax({
url: "../requests/reject/"+id,

});
$('#accept'+id).show();
$('#reject'+id).hide();

}

function askForHelp(){
    myRequests();
    if($('#request').is(":visible")){
        
        
    $('#request').hide();
    }else{
    $('#request').show();
    }
}


function updateRequest(id){
    $('#request').show();
    $("input[name='request_id']").val(id);
    $("input[name='request']").val($('#urequest'+id).html());
    $("select[name='category']").val($('#ucategory'+id).html());
    $("input[name='description']").val($('#udescription'+id).html());
    $("input[name='place']").val($('#uplace'+id).html());
    $("select[name='toWhom']").val($('#utoWhom'+id).html());
    if($('#ubounty'+id).html()=='No'){
        $("input[name='bounty']").val(null);
    $("select[name='currency']").val(null);

    }else{
    $("input[name='bounty']").val($('#ubounty'+id).html());
    $("select[name='currency']").val($('#ucurrency'+id).html());
    }
    $('#submitRequest').hide();
    $('#updateRequest').show();
    $('#newRequest').show();


}

function newRequestbtn(){
    document.getElementById('request').reset();
    $('#submitRequest').show();
    $('#updateRequest').hide();
    $('#newRequest').hide();


}

function deleteRequest(id){
    $.ajax({url: '../user/requests/deleterequest/'+id, success: function(result){
        alert('Request Deleted');
        // myRequests();
    $('#request_div_'+id).hide();
    
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

}

function updateProfession(id){

    $("input[name='profession_id']").val(id);
    $("input[name='profession']").val($('#u_profession'+id).html());
    $("select[name='category']").val($('#u_p_category'+id).html());
    $("input[name='description']").val($('#u_p_description'+id).html());
    $("input[name='workplace']").val($('#u_p_place'+id).html());
    if($('#u_p_price'+id).html()=='No'){
        $("input[name='price']").val(null);
    $("select[name='currency']").val(null);
    $("select[name='timescale']").val(null);

    }else{
    $("input[name='price']").val($('#u_p_price'+id).html());
    $("select[name='currency']").val($('#u_p_currency'+id).html());
    $("select[name='timescale']").val($('#u_p_tscale'+id).html());

    }
    $('#addProfession').hide();
    $('#updateProfession').show();
    $('#newProfession').show();

}

function newProfession(){
    document.getElementById('professionsForm').reset();
        
    $('#addProfession').show();
    $('#updateProfession').hide();
    $('#newProfession').hide();


}

function deleteProfession(){

}



function requestsForMe(){

    $.ajax({url: '../user/requests/requestsforu', success: function(result){
        $("#urequests").html(result);
        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#requestsForMe').show();
    // $('#myRequests').hide();
    // $('#acceptedRequests').hide();
}
function myRequests(){
// alert("clik");
    $.ajax({url: '../user/requests/urequests',dataType:'html', success: function(result){
        $("#urequests").html(result);
                

    },
    error:function(error){
        alert('error occured: '+error);
    }

});
    // $('#urequests').load('../user/requests/urequests',function(response, status,xhr){
    //         if (status == "success"){
    //             alert('don');
    //         }else{
    //             alert('not');
    //         }
    //         if(status == "error"){
    //         alert("Error: " + xhr.status + ": " + xhr.statusText);}
    //         alert('gre');
    // });
    // $('#requestsForMe').hide();
    // $('#myRequests').show();
    // $('#acceptedRequests').hide();
}
function acceptedRequests(){

    $.ajax({url: '../user/requests/acceptedrequests', success: function(result){
        $("#urequests").html(result);
        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

    // $('#requestsForMe').hide();
    // $('#myRequests').hide();
    // $('#acceptedRequests').show();
    
}


function requestAroundMe(){

  

    $.ajax({url: 'requests/requestsaroundu', success: function(result){
        $("#gRequests").html(result);

    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#requestAroundMe').show();
    // $('#rewardedRequests').hide();
    // $('#professionalRequests').hide();
    // $('#requestCategories').hide();

}
function rewardedRequests(){
    $.ajax({url: 'requests/rewardedrequests', success: function(result){
        $("#gRequests").html(result);

    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#requestAroundMe').hide();
    // $('#rewardedRequests').show();
    // $('#professionalRequests').hide();
    // $('#requestCategories').hide();

}
function requestsCategory(){
    $.ajax({url: 'requests/requestsCategory', success: function(result){
        $("#gRequests").html(result);
        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#requestAroundMe').hide();
    // $('#rewardedRequests').hide();
    // $('#professionalRequests').hide();
    // $('#requestCategories').show();
}
function professionalRequests(){
    $.ajax({url: 'requests/professionalRequests', success: function(result){
        $("#gRequests").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#requestAroundMe').hide();
    // $('#rewardedRequests').hide();
    // $('#professionalRequests').show();
    // $('#requestCategories').hide();

}

function people(){
    $.ajax({url: 'people/gpeople', success: function(result){
        $("#people").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#people').show();
    // $('#professionals').hide();
}
function professionals(){

    $.ajax({url: 'people/professionals', success: function(result){
        $("#people").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

    // $('#people').hide();
    // $('#professionals').show();
}

function workStatuses(){
    $.ajax({url: 'work/workstatuses', success: function(result){
        $("#work").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

    // $('#workStatus').show();
    // $('#workAroundMe').hide();
    // $('#professions').hide();
    // $('#categories').hide();
}
function workAroundMe(){
    $.ajax({url: 'work/workaroundu', success: function(result){
        $("#work").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#workStatus').hide();
    // $('#workAroundMe').show();
    // $('#professions').hide();
    // $('#categories').hide();
}
function professions(){

    $.ajax({url: 'work/professions', success: function(result){
        $("#work").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
    // $('#workStatus').hide();
    // $('#workAroundMe').hide();
    // $('#professions').show();
    // $('#categories').hide();
}
function workCategory(){
    $.ajax({url: 'work/workcategory', success: function(result){
        $("#work").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

    // $('#workStatus').hide();
    // $('#workAroundMe').hide();
    // $('#professions').hide();
    // $('#categories').show();
}



function postReview(){
    if($('#review').is(":visible")){
        
    $('#review').hide();
    }else{
    $('#review').show();
    }
}

function connect(id){
    // $(".hh").html("UnConnect");

       $.ajax({
url: "people/connect/"+id,

});

$('#connect'+id).hide();
$('#unconnect'+id).show();
}

function unConnect(id){
    // $(".hh").html("UnConnect");

       $.ajax({
url: "people/unConnect/"+id,

});

$('#connect'+id).show();
$('#unconnect'+id).hide();
}






// $(document).ready(

//     function connect(uid,urll){
        

//         // var uid=$(this).getAttribute("id");

//         // $.ajax({
//         //     url:'/index.php/people/connect/1000007'
            
//         // });

//     //     $.post("/people/connect/1000007",null, function (data) {  
//     //        alert(data);  
//     //    });

//        $.ajax({
// async: false,
// cache: false,
// type: "POST",
// url: "@(Url.Action('people', 'connect'))",
// data: { 'id':'1000007'},
// success: function (data) {
// }
// });

        
//         $(".hh").html("UnConnect");

        

//     }




// );
