<?php
session_start();
include("../config.php");
$current_name = $_SESSION["current_name"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];

$query = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
if(mysqli_num_rows(mysqli_query($con,$query))==0){
    header('location:../index.php');
}
// Logout 
if(isset($_POST["logout"])) 
{ 
    session_destroy();
    header('location:../index.php');
} 

$active_number = $_SESSION["active_number"];
$active1 = "";
$active2 = "";
$active3 = "";
$active4 = "";
$active5 = "";
switch($active_number){
  case 1:
    $active1 = "class='active_nav'";
    break;
  case 2:
    $active2 = "class='active_nav'";
    break;
  case 3:
    $active3 = "class='active_nav'";
    break;
  case 4:
    $active4 = "class='active_nav'";
    break;
  case 5:
    $active5 = "class='active_nav'";
    break;
}

$part_top ="
<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='icon' href='logo.png'/>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <!-- Font Awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css' />
    <link rel='stylesheet' href='styles/style.css'>
    <link rel='stylesheet' href='../common.css'>";
$part_nav="
<title>$current_name (Self Tracker)</title>
</head>
<body>
<div class='container-fluid nav_bar fixed-top'>
    <div class='logo'>Self Tracker</div>
    <div class='nav_links'>
          <label class='menu_icon' for='menu-toggle'>
              <i class='fas fa-bars'></i>
          </label>
          <input type='checkbox' id='menu-toggle' />
          <div class='navs'>
              <a href='today.php' $active1 >Today</a>
              <a href='categories.php' $active2 >Categories</a>
              <a href='subjects.php' $active3 >Subjects</a>
              <a href='activity.php' $active5 >Activity</a>
              <a href='index.php' $active4 >Profile</a>
              <a href='#' id='logout'>Log Out</a>
          </div>
    </div>
</div>
<div style='margin-top:80px'>  
<!-- Jquery -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous' referrerpolicy='no-referrer'></script>";
$part_footer="</div>
<script>
window.onload = function() {
	if(!window.location.hash) {
		window.location = window.location + '#1';
		window.location.reload();
	}
}
$('#logout').click(function (e) {
  e.preventDefault();
  let logout = 1;
$.ajax({
  type: 'POST',
  data: { logout: logout },
  url:'checkUser.php',
  success: function (data) {
    window.location.reload();
  },
});
});
</script>
<script type='text/javascript'>
// To restrict form resubmission
  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href ); 
   }
</script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
  </body>
</html>
";
?>