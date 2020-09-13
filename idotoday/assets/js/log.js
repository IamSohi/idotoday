// localStorage.loggedIn=false;
// alert('logged: '+localStorage.loggedIn);

if(location.pathname=='/idoo/index.php/regist/login' && localStorage.loggedIn=='true'){

    alert('logged: '+localStorage.loggedInWith);
    
    

    if(localStorage.loggedInWith=='Facebook'){
        // alert('logging in with facebook'+localStorage.fbUserId);
        

        $.ajax({
            type:'POST',
            url: '/idoo/index.php/regist/login/loginwithfacebook',
        data:{fbUserId:localStorage.fbUserId},
        success:function(result){
            
            var myObj=JSON.parse(result);
    
            if(myObj.result=='success'){
                localStorage.loggedInWith='Facebook';
                
                localStorage.loggedIn=true;
                localStorage.uid=myObj.uid;
                localStorage.uName=myObj.uName;
    
                window.location.assign("/idoo/index.php/home");
    
            }
        }
        });

    }else if(localStorage.loggedInWith=='Google'){
        // alert('logging in with google');
        
        $.ajax({
            type:'POST',
            url: '/idoo/index.php/regist/login/loginwithgoogle',
        data:{googleSub:localStorage.googleSubject},
        success:function(result){
            
            var myObj=JSON.parse(result);
            // alert(myObj.result);
    
            if(myObj.result=='success'){
                localStorage.loggedInWith='Google';
                
                localStorage.loggedIn=true;
                localStorage.uid=myObj.uid;
                localStorage.uName=myObj.uName;
    
                window.location.assign("/idoo/index.php/home");
    
            }
        }
        });

    }else if(localStorage.loggedInWith=='direct'){
        // alert('logging in with ido');
        

    $.ajax({
        type:'POST',
        url: '/idoo/index.php/regist/login/loggedin',
    data:{email:localStorage.uEmail,pwd:localStorage.upass},
    success:function(result){
        // alert(result);
        
        var myObj=JSON.parse(result);
        
    // localStorage.uEmail=uemail;
    // localStorage.upass=upass;
                                

        if(myObj.result=='success'){
            
            localStorage.loggedInWith='direct';
            

            localStorage.loggedIn=true;
            localStorage.uid=myObj.uid;
            localStorage.uName=myObj.uName;

            window.location.assign("/idoo/index.php/home");

        }
    }
    });
}
    
}


    

function statusChangeCallback(response) {
    // console.log(!localStorage.loggedIn && response.status === 'connected');
    // alert(response.status);
    if (response.status === 'connected') {
        console.log(response.authResponse.accessToken);
        FB.api('/me',{fields:'id,name,email,first_name,last_name,gender,verified'}
        ,function(response) {
            // console.log(JSON.stringify(response));
            if (!response || response.error) {
                alert('Error occured');
            }else{
                
            var myObj=JSON.stringify(response);
            console.log(myObj);
            $.ajax({
                type:"POST",
                url:"/idoo/index.php/regist/signup/signupwithfacebook",
                data:{data:myObj},
                success:function(result){
                    var myObj=JSON.parse(result);
                    alert(myObj.result);
                    
                    switch(myObj.result){
                        
                        case "success":
                        localStorage.loggedInWith='Facebook';
                        localStorage.fbUserId=myObj.fbUserId;
                        
                            localStorage.loggedIn=true;
                            localStorage.uid=myObj.uid;
                            localStorage.uName=myObj.uName;
                        alert('success'+localStorage.loggedIn+'  '+localStorage.uid+'  '+localStorage.uName);
            
            
                            // window.location.assign("/idoo/index.php/home");
                            window.location.assign("/idoo/index.php/home");
                            
                        break;
                        case "error":
                        alert("some error has occured.");
                        break;
            
            
                    }   

    
    
                },
                error:function(error){
                    alert('Something went wrong: '+error);
    
                }
            });
            }
        });
    }else if (localStorage.loggedIn=='false'){
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }else{
        alert('you are already logged in.');
    }
}

function loginWithGoogle(resp){
                
            var myJson=JSON.stringify(resp);
            // console.log(myObj);
            $.ajax({
                type:"POST",
                url:"/idoo/index.php/regist/signup/signupwithgoogle",
                data:{data:myJson},
                success:function(result){
                    var myObj=JSON.parse(result);
                    alert(myObj.result);
                    
                    switch(myObj.result){
                        
                        case "success":
                            localStorage.loggedIn=true;
                        
                            localStorage.loggedInWith='Google';
                            localStorage.uid=myObj.uid;
                            localStorage.uName=myObj.uName;
                        alert('success'+localStorage.loggedIn+'  '+localStorage.uid+'  '+localStorage.uName);
            
            
                            // window.location.assign("/idoo/index.php/home");
                            window.location.assign("/idoo/index.php/home");
                            
                        break;
            
            
                        case "error":
                        alert("some error has occured.");
                        break;
            
            
                    }   

    
    
                },
                error:function(error){
                    alert('Something went wrong: '+error);
    
                }
            });
            
       
    
}


      


      
    
      // This function is called when someone finishes with the Login
      // Button.  See the onlogin handler attached to it in the sample
      // code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
            
        // FB.login(function(response){
        // alert('smkc');
        statusChangeCallback(response);
        // Handle the response object, like in statusChangeCallback() in our demo
        // code.
    });
}

    
$(document).ready(function(){

    if(localStorage.loggedOut){
        localStorage.loggedOut=true;
    }


    if(localStorage.googleEmail!=null){
        // alert(localStorage.googleUserName);
        
        $("#googleUser").html('Last time you logged in as <b>'+localStorage.googleUserName+'.</b><br/>Please sign in with Google Account <b>'+localStorage.googleEmail+'</b> to access your profile.');
    }
    
if(localStorage.uEmail){
    $('#lo_em_id').val(localStorage.uEmail);
    $('#lo_em_pwd').val(localStorage.upass);
}
});



$(document).on('click', '#lo_su_bt', function(){

    alert('log');



    var uemail=$('#lo_em_id').val();
    var upass=$('#lo_em_pwd').val();

    $('#lo_fo').ajaxSubmit({
    success:function(result){
        
        var myObj=JSON.parse(result);
        alert(myObj.result);
        
    localStorage.uEmail=uemail;
    localStorage.upass=upass;
                                

        switch(myObj.result){

            
            case "success":
            localStorage.loggedInWith='direct';

            localStorage.loggedIn=true;
            localStorage.uid=myObj.uid;
            localStorage.uName=myObj.uName;
            alert('success'+localStorage.loggedIn+'  '+localStorage.uid+'  '+localStorage.uName);

            window.location.assign("/idoo/index.php/home");

            break;
            case "not_valid":

            $('#lo_fo_valid').html(myObj.validationError);
            break;
            case "wrong_password":
            
            $('#lo_fo_valid').html("You have entered wrong password");
            break;

            case "email_not_exist":
            $('#lo_fo_valid').html("The email id you entered does not exists");
            break;


        }  
    },
    error:function(error){
        alert('error occured: '+error);
    }
    });

});

function logout(){
// alert('kjkn');
    $.ajax({url: '/idoo/index.php/regist/logout', 
    
    success: function(){
        // myRequests();
        localStorage.loggedIn=false;
        localStorage.loggedOut=true;

        if(localStorage.loggedInWith=='Facebook'){

        window.fbAsyncInit = function() {
            FB.init({
              appId      : '676747455859800',
              cookie     : true,  // enable cookies to allow the server to access 
                                  // the session
              xfbml      : true,  // parse social plugins on this page
              version    : 'v2.8' // use graph api version 2.8
            });
        
            FB.getLoginStatus(function(response) {
                alert(response.status);
                if (response.status === 'connected') {
                    
                
            FB.logout(function(response) {
                // Person is now logged out
             });
            }
              });
            };
          
            // Load the SDK asynchronously
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }
       
        window.location.assign("/idoo/index.php/regist/login");


        
        
        

    },
    error:function(error){
        alert('error occured: '+error);
    }
});

}

$(document).on('click', '#si_su_bt', function(){
alert('sign');
    localStorage.uEmail=$('#si_em_id').val();
    localStorage.upass=$('#si_em_pwd').val();

$("#si_fo").ajaxSubmit({
    success:function(result){
        
        var myObj=JSON.parse(result);
                                alert(myObj.result);

        switch(myObj.result){
            case "success":
            localStorage.loggedInWith='direct';
            
                localStorage.loggedIn=true;
                localStorage.uid=myObj.uid;
                localStorage.uName=myObj.uName;
            alert('success'+localStorage.loggedIn+'  '+localStorage.uid+'  '+localStorage.uName);


                // window.location.assign("/idoo/index.php/home");
                window.location.assign("/idoo/index.php/message");
                
                break;

            case "not_valid":
            $('#si_fo_valid').html(myObj.validationError);
            break;

            case "fail":
            $('#si_fo_valid').html("Error inserting your data. Please try again.");
            break;


        }   
    },
    error:function(error){
        alert('error occured: '+error);
    }
});
});

$(document).on('click', '#update_email_btn', function(){
    
    $("#updateEmailForm").ajaxSubmit({
        success:function(result){
            $('#update_email_btn').html('Updated');
            
            var myObj=JSON.parse(result);
                                    alert(myObj.result);
    
            switch(myObj.result){
                case "success":

                localStorage.uEmail=myObj.email;
                
                    // window.location.assign("/idoo/index.php/home");
                    window.location.assign("/idoo/index.php/message");
                    
                    break;
    
                case "not_valid":
                $('#up_em_valid').html(myObj.validationError);
                break;
    
    
            }   
        },
        error:function(error){
            alert('error occured: '+error);
        }
    });
    });

    $(document).on('click', '#reset_Pass_btn', function(){
        
        $("#resetPasswordForm").ajaxSubmit({
            beforeSubmit:function(){
                alert('jncjd');

            },
            success:function(result){
                $('#reset_Pass_btn').html('Done');
                
                var myObj=JSON.parse(result);
                                        alert(myObj.result);
        
                switch(myObj.result){
                    case "success":
                    alert(myObj.pwd);
                    
    
                    localStorage.upass=myObj.pwd;
                    
                        // window.location.assign("/idoo/index.php/home");
                        window.location.assign("/idoo/index.php/message");
                        
                        break;
        
                    case "not_valid":
                    $('#up_em_valid').html(myObj.validationError);
                    break;
        
        
                }   
            },
            error:function(error){
                alert('error occured: '+error);
            }
        });
        });
    
    