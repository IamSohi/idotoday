


$(document).ready(function() {
    if(location.pathname == "/idoo/index.php/user/workstatus"){
        $("select[name='category']").val($('#workstatus_category').html());
        $("select[name='feeling']").val($('#workstatus_feeling').html());
        
    }
    $("select[name='country_code']").val($('#user_country_code').html());
});


function workStatusesByPlace(place){
    $.ajax({
        url: '/idoo/index.php/find/place/workstatuses/'+place,

     success: function(result){
        $("#searchPlace").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
}

function professionsByPlace(place){
    $.ajax({
        url: '/idoo/index.php/find/place/professions/'+place,
        success: function(result){
            $("#searchPlace").html(result);
        
        },
        error:function(error){
            alert('error occured: '+error);
        }
    });

}
function requestsByPlace(place){
    $.ajax({
        url: '/idoo/index.php/find/place/requests/'+place,

     success: function(result){
        $("#searchPlace").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

}
function peopleByPlace(place){
    $.ajax({
        url: '/idoo/index.php/find/place/people/'+place,

     success: function(result){
        $("#searchPlace").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

}



function workStatusesByCategory(category){
    $.ajax({
        url: '/idoo/index.php/find/category/workstatuses/'+category,

     success: function(result){
        $("#searchCategory").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
}

function professionsByCategory(category){
    $.ajax({
        url: '/idoo/index.php/find/category/professions/'+category,
        success: function(result){
            $("#searchCategory").html(result);
        
        },
        error:function(error){
            alert('error occured: '+error);
        }
    });

}
function requestsByCategory(category){
    $.ajax({
        url: '/idoo/index.php/find/category/requests/'+category,

     success: function(result){
        $("#searchCategory").html(result);

        
    },
    error:function(error){
        alert('error occured: '+error);
    }
});

}
