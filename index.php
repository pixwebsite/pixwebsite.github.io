<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<!-- <link rel="stylesheet" href="css/style.css" /> -->
<title>Login</title>
</head>
<body class="bg-orange">
<div class="wrapper">
<div  class="container bg-ffbd15">
<div class="main center">
<!-- start main -->
<?php
// ini source di file login.php
session_start();
require 'db.php';

if ( isset($_COOKIE['id']) ) {
  $id = $_COOKIE['id'];
  $result = mysqli_query($con, "SELECT * FROM users WHERE username='$id'");
  $ros = mysqli_fetch_assoc($result);
  if ($_COOKIE['id'] === $ros['username']) {
    $_SESSION['username'] = true;
  }
}

if(isset($_SESSION["username"])){
  header("Location: index.php");
  exit();
}

if (isset($_POST['username'])){
  
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	
  $query = "SELECT * FROM `users` WHERE username='$username'
             and password='$password'";
             
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
          $row = mysqli_fetch_assoc($result);
          $_SESSION['username'] = $username;
          
          if ( isset($_POST['remember']) ) {
            setcookie('id', $row['username'], time()+(7 * 24 * 60 * 60));
          }
          
          header("Location: index.php");
         } else {
         echo "<h2 class='heading'>Error</h2>
              <p class='info'>
              Username / Password salah!
              </p>
              <br>
              <a href='login.php' class='btn r-20px' onclick='history.back()'>Coba Lagi</a>
              ";
         }
}else{
?>
<h2 class="heading">Log In</h2>
<?php 
if(isset($_GET['pesan'])){
  if($_GET['pesan'] == "logout") {
		echo "<div class='popup'>
		      <div class='pesan' id='pesan'>Anda telah berhasil logout</div>
		      </div>";
  }
}
?>
<form class="form" action="" method="post" name="login">

<input type="email" name="username" placeholder="Username" autocomplete="off" required  autofocus/>
<input type="password" name="password" placeholder="Password" autocomplete="off" required />
<label class="checkbox-container">
  <span>Ingat Saya!</span>
  <input type="checkbox" name="remember">
  <span class="checkmark"></span>
</label>
<br>
<input class="btn btn-submit" name="submit" type="submit" value="Masuk" />
Atau
<a class="btn btn-signup" href='registration.php'>Daftar</a>

</form>
<?php } ?>

<!-- end main -->
</div>
</div>
</div>

</body>
<style>
/* group */
* {
  font-family: Poppins;
  outline: none;
  -webkit-tap-highlight-color: transparent;
  color: #444444;
  box-sizing: border-box;
}
body {
  display: flex;
}

.center {
  text-align: center;
}
.pesan,
.btn {
  font-size: 14px;
}
.heading {
  font-family: Poppins-Bold;
  text-transform: uppercase;
  color: #444444;
}
.form,
.btn {
  text-align: center;
}
.container,
input,
.pesan,
.btn {
  border-radius: 10px;
}
.delay-1 {
  animation-delay: 1s;
}
.delay-1-5 {
  animation-delay: 1.5s;
}
.delay-2 {
  animation-delay: 2s;
}
.delay-2-5 {
  animation-delay: 2.5s;
}
.delay-3 {
  animation-delay: 3s;
}
/* end group */



body div.wrapper {
  /* margin: 0 auto; */
  padding: 0 20px;
  margin: auto;
}
.container {
  max-width: 600px;
  padding: 20px;
  border-radius: 10px;
  /* margin: 30% auto; */
  animation: shadow 1s forwards;
}
.main {
  margin: 0 auto;
  padding: 0px 0px 20px;
  max-width: max-content;
  animation: opac 1s forwards;
  animation-delay: 1s;
  opacity: 0;
}

/* form */
.form {
  font-size: 14px;
}
.form input[type="email"],
.form input[type="password"] {
  border: 1px solid #ffbd15;
  padding: 10px 20px;
  width: 100%;
  font-size: 14px;
  animation: shadow2 1s forwards;
  /* animation-delay: 1s; */
}
.form input[type="email"]:valid,
.form input[type="password"]:valid {
  border: 1px solid #00d285;
} 


.form input,
.form .btn,
.form a {
  display: block;
  margin: 10px 0;
  text-decoration: none;
}

/* btn default */
.btn {
  padding: 8px 10px;
  width: 250px;
  margin: 10px auto !important;
  background: #ffbd15;
  /* background: linear-gradient(145deg, #ffca16, #e6aa13); */
  box-sizing: border-box;
  border: none;
  font-size: 14px;
  color: #fff;
  text-shadow: 0px 0px 1px 2px orange;
  font-weight: bold;
  text-transform: capitalize;
  animation: shadow2 1s forwards;
  /* animation-delay: 1s; */
}
.btn:active {
  background: linear-gradient(145deg, #e6aa13, #ffca16);
}

.popup {
  animation: popup .5s forwards;
  animation-delay: 0s;
}
.pesan {
  display: none;
  background: #ffd217;
  padding: 10px;
  border: 1px solid orange;
  animation: pesan .3s forwards;
  animation-delay: 5s;
}




/* color query */
.bg-orange {
  background: #ffbd15;
}
.bg-ffbd15 {
  background: #ffbd15;
}

/* Media animation */
@keyframes shadow {
  0% {
    box-shadow: 0px 0px 0px transparent;
  }
  100% {
    box-shadow:  12px 12px 24px #d9a112, 
               -12px -12px 24px #ffd918;
  }
}
@keyframes shadow2 {
  0% {
    box-shadow: 0px 0px 0px transparent;
  }
  100% {
    /* box-shadow:  5px 5px 5px #e3a813, 
             -5px -5px 5px #ffd217; */
    box-shadow:  5px 5px 10px #d9a112, 
             -5px -5px 10px #ffd918;
  }
}
@keyframes popup {
 0% {
   opacity: 0;
   padding: 0px 10px;
   margin: -30px auto 0;
   display: block;
   transform: scaleY(0);
 }
 100% {
   display: block;
   opacity: 1;
   transform: scaleY(1);
}
}
@keyframes pesan {
 0% {
   opacity: 1;
 }
 100% {
  opacity: 0;
  padding: 0px 10px;
  margin: -30px auto 0;
  display: none;
  transform: scaleY(0);
}
}
@keyframes opac {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
/* Media screen query */
@media screen and (min-width: 740px) {
  .form input[type="email"],
  .form input[type="password"],
  .form .btn,
  .form a.btn {
    width: 300px;
    box-sizing: border-box;
  }
}
/* Media Font Face Query */
@font-face {
  font-family: Poppins;
  src: url("../../fonts/Poppins-Regular.otf");
}
@font-face {
  font-family: Poppins-Bold;
  src: url("../../fonts/Poppins-ExtraBold.otf");
}


/* checkbox custom */
/* The checkbox-container */
.checkbox-container {
  display: block;
  position: relative;
  padding-left: 33px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 12px;
  color: #444444;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  text-align: left;
}

/* Hide the browsers default checkbox */
.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 1px;
  left: 10px;
  height: 15px;
  width: 15px;
  background-color: #eee;
  border-radius: 5px;
  animation: shadow2 1s forwards;
  /* animation-delay: 1s; */
}

/* On mouse-over, add a grey background color */
.checkbox-container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkbox-container input:checked ~ .checkmark {
  background-color: #00d285;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkbox-container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkbox-container .checkmark:after {
  left: 4.5px;
  top: 2.5px;
  width: 3px;
  height: 5.5px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

</style>
</html>
