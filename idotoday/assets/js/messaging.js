var ws=null;


$(document).ready(function(){

    
if(!localStorage.loggedIn){
    localStorage.loggedIn=false;
}

            // alert(sessionStorage.uid+'  '+sessionStorage.uName);


    // if(localStorage.openid){

    // localStorage.removeItem("openid");

    //     var fid =localStorage.openid;
        
    // // alert('Mess');
    //     localStorage.setItem("openid", fid);

    // register_popup(fid, 'ddddd');



    // }
// alert("cxmc");
//     var response=document.getElementByClassName("message");
// var message=document.getElementById("message");
// var sendbn=document.getElementById("send");


// if(!sessionStorage.conn){
// alert("connected "+sessionStorage.conn);
                ws = new WebSocket("ws://localhost:3000");
                sessionStorage.conn=true;
                                  

// }

               ws.onopen = function()
               {
                //    ws.uid=sessionStorage.uid;

                  // Web Socket is connected, send data using send()
        ws.send(JSON.stringify({'type':'uInfo','uid':localStorage.uid,'uName':localStorage.uName}));

                //   alert("connected "+sessionStorage.uid);
               };




               ws.onmessage = function (evt)
               {
                   var data=JSON.parse(evt.data);
                   if(data.type=='chat'){

                    register_popup(data.data.uid,'dds');

                       insertChat('friend', data.data.msg,data.data.uid);

                       

                   }else if(data.type=='Error'){
                       alert(data.message);

                   }else if(data.type=='status'){
                       if(data.status=='online'){

                        $('#status'+data.fid).css("color", "red");
                        alert(data.fid+' is online.');
                        
                       }else{
                        alert(data.fid+' is offline.');
                        
                       }
                   }
                  // var received_msg = evt.data;
                  // response.innerHTML=evt.data;
                //   alert("Message is received..."+evt.data);
               };

               ws.onclose = function()
               {
                ws.send(JSON.stringify({'type':'closed_alert','uid':localStorage.uid,'uName':localStorage.uName}));
                
                  // websocket is closed.
                //   alert("Connection is closed...");
               };

    $('#user_id').html(Math.floor((Math.random() * 100) + 1));

});

         function openMessagePopup(fid,uid,fName){
            // alert('Mess');
                // // localStorage.setItem("openid", fid);
                // var e=document.getElementById("mHoptions");
                // if (e.classList.contains('mHdrop')) {
                // e.classList.remove("mHdrop");
                // }
                
            register_popup(fid, fName);
        
        }

    // alert("Hello! I am an alert box!!");






            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };

            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;

            //arrays of popups ids
            var popups = [];
            var popupsRegistered = [];
            

            //this is used to close a popup
            function close_popup(id)
            {
                // for(var iii = 0; iii < popups.length; iii++)
                // {
                    // alert('closing.    '+id+'       '+popups+'     '+popups.includes(id));
                    
                    // if(popups.includes(id))
                    if(popups.includes(id))
                    {
                        // alert('closing.    '+popups);
                        Array.remove(popups, popups.indexOf(id));
                        // alert('popups   .'+popups);
                        
                        document.getElementById(id).style.display = "none";

                        calculate_popups();

                        // popups.push(id);
                        


                        return;
                    }
                // }
            }
             //calculate the total number of popups suitable and then populate the toatal_popups variable.
             function calculate_popups()
             {
                 var width = window.innerWidth;
                 if(width < 540)
                 {
                     total_popups = 0;
                 }
                 else
                 {
                     width = width - 200;
                     //320 is width of a single popup box
                     total_popups = parseInt(width/320);
                 }
 
                 display_popups();
 
             }
 
             //recalculate when window is loaded and also when window is resized.
             window.addEventListener("resize", calculate_popups);
             window.addEventListener("load", calculate_popups);
 
 

            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;

                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "flex";
                    }
                }

                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }

            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                ws.send(JSON.stringify({'type':'checkStatus','fid':id}));
                

                // for(var iii = 0; iii < popups.length; iii++)
                // {
                    //already registered. Bring it to front.
                    if(popupsRegistered.includes(id))
                    {
                        // alert('popups.includes');
                        Array.remove(popups, popups.indexOf(id));


                        popups.unshift(id);
                        
                        calculate_popups();
            //             $.ajax({url: '/idoo/index.php/user/messages/insertuserchat/'+id, success: function(result){
            //         $("#msg-area"+id).html(result);
            //     },
            //     error:function(error){
            //         alert('error occured: '+error);
            //     }
            // });
            var objDiv = document.getElementById("load_messages"+id);
            objDiv.scrollTop = objDiv.scrollHeight;


                        // return;
                    }else{
                // }
                // alert('popups.not.includes');
                

                var element = '<div class="popup-box chat-popup" style="display:flex;flex-direction: column;" id="'+ id +'">';
                element = element + '<div class="popup-head bg-info">';
                element = element + '<div class="popup-head-left">'+ name +'</div><i class="fa fa-heart ml-2" id="status'+id+'" style="color:gray;" aria-hidden="true"></i>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup('+ id +');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div>'+
                '<div class="load_messages" id="load_messages'+id+'"><div class="msg-area" id="msg-area'+id+'"></div></div><textarea id="message'+id+'" onkeydown="check_Key_pressed(event,this,'+id+')" rows="1"></textarea></div>';
                // 


                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;

                popups.unshift(id);
                popupsRegistered.unshift(id);                
                

                calculate_popups();

                document.getElementById(id).style.display = "flex";
                
                $.ajax({url: '/idoo/index.php/user/messages/insertuserchat/'+id, success: function(result){
                    $("#msg-area"+id).html(result);

                    var objDiv = document.getElementById("load_messages"+id);
                    objDiv.scrollTop = objDiv.scrollHeight;

                        // $(".msg-area").animate({ scrollTop: $(document).height() }, 1000);
                },
                error:function(error){
                    alert('error occured: '+error);
                }
            });
        }
        

            } 


            function sendSmallChat(id){
                var message=$('textarea#message'+id).val();
                insertChat("me", message,id);
                
                $('textarea#message'+id).val(null);
                sendMsg(id,message);
                // var objDiv = document.getElementById("load_messages_area"+id);
                // objDiv.scrollTop = objDiv.scrollHeight;
                // $(window).load(function() {
                    $('html, body').scrollTop($(document).height());
                    //   });

            }


            function check_Key_pressed(event,element,id){
                element.style.height = "5px";
                element.style.height = (element.scrollHeight)+"px";

                var objDiv = document.getElementById("load_messages"+id);
                objDiv.scrollTop = objDiv.scrollHeight;

                if (event.keyCode === 13 && !event.shiftKey) {
                    event.preventDefault();
                    var message=$('textarea#message'+id).val();
                    insertChat("me", message,id);
                    

                    $('textarea#message'+id).val(null);



                    sendMsg(id,message);
                        
                        

                }

            }
            

            function sendMsg(id,message){

                        ws.send(JSON.stringify({'type':'message','uid':localStorage.uid,'fid':id,'msg':message}));


    // alert(' '+id+' '+message);



                        // $('#load_messages'+id).html('<h5 style="float:right">'+message+'</h5>'+$('#load_messages'+id).html());
                        // element.val(null);
                    // }
// var message=document.getElementById("message");
// alert("insend");

        // ws.send(JSON.stringify({message:''+message.value}));
        // alert("send");
        // return true;

}

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

function insertChat(who, text,id){
    var control = "";
    var date = formatAMPM(new Date());

    if (who == "me"){
         

        control = '<div class="msj-rta macro mt-3">' +
        '<div class="text float-right pr-1 pl-1"">'+
        '<p class="col-form-label-lg">'+text+'</p>'+        
        '<p><small>'+date+'</small></p>'+
        '</div>'+
        '<div class="pr-2" style="padding:0px 0px 0px 10px !important">'+
        '<a href="http://'+location.hostname+'idoo/index.php/home"><img class="rounded-circle" style="width:40px;" src="http://'+location.hostname+'/idoo/uploads/profilePic'+localStorage.uid+'"/></a></div>'+
        '</div>';
    }else{
        control = '<div class="msj macro mt-3">' +
                        '<div class="pr-2"><a href="http://'+location.hostname+'index.php/user/workstatus/person/'+id+'"><img class="rounded-circle" style="width:40px;" src="http://'+location.hostname+'/idoo/uploads/profilePic'+id+'"/></a></div>'+
                        '<div class="text float-left pr-1 pl-1">'+
                        '<p class="col-form-label-lg">'+text+'</p>'+                        
                        '<p><small>'+date+'</small></p>'+
                            '</div>' +
                  '</div>';
    }

    $("#load_chat_messages"+id).append(control);
    $("#msg-area"+id).append(control);

    var objDiv = document.getElementById("load_messages"+id);
    if(objDiv){
        objDiv.scrollTop = objDiv.scrollHeight;
        
    }

}



// function scrollToTop(){
//     alert('sdmckldsc');
    
// }


function scrollToTop(){
        $('html, body').scrollTop(0);
        
    
}

$(document).ready(function()
{

    
    getMessageNumber();
    
    var patt=/[/idoo/index.php/user/messages/chat/][0-9]/;    
    if(patt.test(location.pathname)){
        $('html, body').scrollTop($(document).height());
        ws.send(JSON.stringify({'type':'checkStatus','fid':location.pathname.substr(location.pathname.lastIndexOf('/') + 1)}));
        
        
    }
    $(document).on('click', '#navbarDropdownMenuLink',function()
    {
        $('html, body').scrollTop(0);
        
    });
    


$(document).on('click', '#messageLink',function()
{
    $("#notificationContainer").hide();
    $("#myDropdownMenu").removeClass("show");
    
    // $("#optionsDrop").hide();
    // if (e.classList.contains('mHdrop')) {
    // e.classList.remove("mHdrop");
    // }
$("#messageContainer").fadeToggle(300);
$("#message_count").fadeOut("slow");
$.ajax({url: '/idoo/index.php/user/messages/getusermessage', success: function(result){
    $("#messageBody").html(result);

    $.ajax({url: '/idoo/index.php/user/messages/setmessageviewed', success: function(result){
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
$("#messageContainer").hide();
});


});

function getMessageNumber(){
    $.ajax({url: '/idoo/index.php/user/messages/getusermessagenumber', success: function(result){
        if(result!=0){
            
            $("#message_count-md").show();
            $("#message_count-md").html(result);
            $("#message_count-sm").show();
            $("#message_count-sm").html(result);
            $("#message_count").show();
            $("#message_count").html(result);
            
        }
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
}
