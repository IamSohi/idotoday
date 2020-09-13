<div class="my-navbar color-pink fixed-top">

<div class="container">
<header>
<nav class="nav justify-content-center justify-content-lg-between justify-content-xs-start">
  


<a class="navbar-brand nav-item d-none d-lg-inline color-black" href='<?php echo base_url(); ?>index.php/home'>
<img src="<?php echo base_url();?>assets/images/didoIcon.png" alt="siteLogo"  height="35" class="d-inline-block align-bottom" alt="website logo">
idotoday</a>

<span class="nav-link d-flex justify-content-center">
<a class="nav-link color-black" href='<?php echo base_url(); ?>index.php/home'><h4 class="d-none d-lg-inline">Home</h4>
<i class="fa fa-home fa-2x d-inline d-lg-none" aria-hidden="true"></i>
</a>

<a class="nav-link color-black" href='<?php echo base_url(); ?>index.php/work'><h4 class="d-none d-lg-inline">Work</h4>
<i class="fa fa-globe fa-2x d-inline d-lg-none" aria-hidden="true"></i>
</a>
<a class="nav-link color-black" href='<?php echo base_url(); ?>index.php/people'><h4 class="d-none d-lg-inline">People</h4>
<i class="fa fa-users fa-2x d-inline d-lg-none" aria-hidden="true"></i>
</a>

<a class="nav-link color-black" href='<?php echo base_url(); ?>index.php/requests'><h4 class="d-none d-lg-inline">Requests</h4>
<i class="fa fa-bullhorn fa-2x d-inline d-lg-none" aria-hidden="true"></i>
</a>
</span>

<span class="d-none d-lg-flex">


<div class="dropdownn">
<span id="message_count" class="badge badge-secondary"  style="display: none;"></span>

<i class="nav-link fa fa-comment fa-2x" id="messageLink" aria-hidden="true"></i>

<div id="messageContainer">
<div id="messageTitle">message</div>
<div id="messageBody" class="message"></div>
<!-- <div id="messageFooter"><a href="#">See All</a></div> -->
</div>
</div>


<div class="dropdownn">
<span id="notification_count" class="badge badge-secondary"  style="display: none;"></span>

<i id="notificationLink" class="nav-link fa fa-bell fa-2x" aria-hidden="true"></i>
<div id="notificationContainer" class="popupContainer">
<div id="notificationTitle">Notifications</div>
<div id="notificationsBody" class="notifications"></div>
<div id="notificationFooter"><a href="#">See All</a></div>
</div>
</div>


  <div class="nav-item dropdownn">
  <a class="nav-link mt-1" href="javascript:dropItDown()"><div class="arrow-down"></div></a>
  <div id="myDropdownMenu" class="dropdown-content mt-4">
  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/resetpass">reset password</a>
  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/updateemail">update email</a>
  <a class="dropdown-item" href="">help</a>
  <a class="dropdown-item" href="">feedback</a>
  <a class="dropdown-item" href="javascript:logout()">logout</a>
  </div>
</div>
</span>

<span class="d-none d-sm-flex d-lg-none">
<a href="<?php echo base_url(); ?>index.php/user/messages">
<span id="message_count-md" class="badge badge-secondary" style="display: none;"></span>

<i class="nav-link fa fa-comment fa-2x  color-black" aria-hidden="true"></i>

</a>


<a href="<?php echo base_url(); ?>index.php/user/notifications">
<span id="notification_count-md" class="badge badge-secondary" style="display: none;"></span>

<i class="nav-link fa fa-bell fa-2x  color-black" aria-hidden="true"></i>
</a>

<div class="nav-item dropdownn">
<a class="nav-link" href="javascript:dropItDownM()"><div class="arrow-down"></div></a>
<div id="myDropdownMenuM" class="dropdown-content mt-3">
<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/resetpass">reset password</a>
<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/updateemail">update email</a>
<a class="dropdown-item" href="">help</a>
<a class="dropdown-item" href="">feedback</a>
<a class="dropdown-item" href="javascript:logout()">logout</a>
</div>
</div>
</span>

<span class="d-flex d-sm-none fixed-bottom justify-content-around bg-info">
<a href="<?php echo base_url(); ?>index.php/user/messages">
<span id="message_count-sm" class="badge badge-secondary" style="display: none;"></span>

<i class="nav-link  fa fa-comment fa-2x  color-black" aria-hidden="true"></i>

</a>

<a href="<?php echo base_url(); ?>index.php/user/notifications">
<span id="notification_count-sm" class="badge badge-secondary" style="display: none;"></span>
<i class="nav-link  fa fa-bell fa-2x  color-black" aria-hidden="true">
</i>
</a>

<div class="dropdownn">
<a href="javascript:dropItUp()">
  <i class="nav-link fa fa-bars fa-2x" id="scrollToTop" aria-hidden="true"></i>
</a>
<div id="myDropupMenu" class="dropup-content mb-5">
<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/resetpass">reset password</a>
<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user/settings/updateemail">update email</a>
<a class="dropdown-item" href="">help</a>
<a class="dropdown-item" href="">feedback</a>
<a class="dropdown-item" href="javascript:logout()">logout</a>
</div>
</div>
</span>

</nav>
</header>
</div>
</div>


<div class="container-fluid bg-light">