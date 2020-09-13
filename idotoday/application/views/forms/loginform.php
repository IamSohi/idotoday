
<script>

window.fbAsyncInit = function() {
    FB.init({
      appId      : '676747455859800',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // alert(localStorage.loggedInWith+'   '+localStorage.loggedOut);

    // alert(localStorage.loggedInWith == 'Facebook'  && localStorage.loggedOut!='true');

    if(localStorage.loggedInWith == 'Facebook'  && localStorage.loggedOut!='true'){
      checkLoginState();
    }



    };

    
  
    // Load the SDK asynchronously
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<h2>Login</h2>
<div id='lo_fo_valid'></div>
<?php echo form_open('regist/login/logitin','id="lo_fo"');
if($this->session->has_userdata('login_msg')){echo '<p>'.$this->session->flashdata('login_msg').'</p>';}?>

<input type='text' name='token' hidden value='<?php if(isset($_SESSION["login_token"]))echo $_SESSION["login_token"];?>'>
<input type='email' id='lo_em_id' name='email' placeholder='Email' value='<?php if(isset($email)){echo $email;}?>'>
<input type='password' id='lo_em_pwd' name='pwd' placeholder='Password'>

</form>
<button  id='lo_su_bt' name='submit' value='Login'>Login</button>

<a href="<?php echo base_url(); ?>index.php/regist/login/forgetpassword">forget password?</a>
<br/>
<br/>
<div id="my-signin2"></div>
<div id="googleUser"></div>

<br/><br/>
<div class="fb-login-button" scope="user_friends,public_profile,email" onlogin="checkLoginState()" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="false" data-use-continue-as="true"></div>
<div id="status"></div>


<br><br/>


<script>

function onSuccess(googleUser) {
      if (localStorage.loggedIn=='false') {

      
      if(googleUser.hasGrantedScopes('openid profile email')){
        gapi.load('client',function(){
        gapi.client.request({
      'path': 'https://www.googleapis.com/plus/v1/people/me/openIdConnect',
         }).then(function(response){

              console.log(response.result);
              localStorage.googleEmail=response.result.email;
              localStorage.googleUserName=response.result.name;
              localStorage.googleSubject=response.result.sub;

              // alert(localStorage.googleEmail+'    '+response.result.email);


              loginWithGoogle(response.result);
         }, function(reason) {
              console.log('Error: ' + reason.result.error.message);
         });
      });
        
      }else{
        googleUser.grant({
          scope:'openid profile email'
        }).then(function(googleUser){
          
        })
      }
          console.log('token: '+googleUser.getAuthResponse().id_token);

    }else{
      alert('you are already logged in.');
    }
}
    function onFailure(error) {
      console.log(error);
    }

    function signOut() {
        gapi.load('auth2', function() {
            gapi.auth2.init({
                client_id: '97722442173-b7jud47osk85v5lf2k420svnjoaasdfm.apps.googleusercontent.com'
    
            });
            var auth2 = gapi.auth2.getAuthInstance();
            alert('loggining out google'+auth2.isSignedIn.get());

        auth2.signOut().then(function () {
          console.log('User signed out.');
        });


  
});
        
  }
    function renderButton() {
       
      gapi.signin2.render('my-signin2', {
        'scope': 'openid profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });

    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
