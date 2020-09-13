
$(document).ready(function()
{
    getNotificationNumber();
    // notificationLink();
    



$(document).on('click', '#notificationLink',function()
{
    $("#messageContainer").hide();
    $("#myDropdownMenu").removeClass("show");
    // $(".dropdown-content").hide();
    
    // $("#optionsDrop").hide();
    // if (e.classList.contains('mHdrop')) {
    // e.classList.remove("mHdrop");
    // }
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");

$.ajax({url: '/idoo/index.php/user/notifications/getusernotification', success: function(result){
    $("#notificationsBody").html(result);

    $.ajax({url: '/idoo/index.php/user/notifications/setnotificationviewed', success: function(result){
    },
    error:function(error){
        alert('error occured: '+error);
    }
});


},
error:function(error){
    alert('error occured: '+error);
}
});


return false;
});

//Document Click hiding the popup 
$(document).click(function()
{
$("#notificationContainer").hide();
});


});

function getNotificationNumber(){
    $.ajax({url: '/idoo/index.php/user/notifications/getusernotificationnumber', success: function(result){
        if(result!=0){
            
            $("#notification_count-md").show();
            $("#notification_count-md").html(result);
            $("#notification_count-sm").show();
            $("#notification_count-sm").html(result);
            $("#notification_count").show();
            $("#notification_count").html(result);
            
        }
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
}

