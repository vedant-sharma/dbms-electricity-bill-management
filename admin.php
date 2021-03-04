<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="awesome/css/font-awesome.min.css" type="text/css">
<script src="js/jquery-3.2.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body {
	padding: 0;
	margin: 0;
	//background-color: grey;
	background-image:url(images/10120_hi-res.jpg);
	background-size:cover;
	background-position:center;
	background-repeat:no-repeat;
	  
}
div.adm {
	text-align: center;
	position: relative;
	top: 120px;
 //border:2px solid grey;
	padding: 2px;
}
input[type=text], input[type=password] {
	width: 30%;
	height: 45px;
	padding: 2px;
	margin: 10px;
	border-radius: 5px;
	border: 2px solid white;
	font-size: 16px;
	text-align: center;
	font-weight: bold;
	font-variant: small-caps;
	background:#F1F1F1;
	font-color:inherit;
}
input[type=submit] {
	padding: 5px;
	height: 42px;
	font-size: 18px;
	font-variant: small-caps;
	font-style: inherit;
	border-radius: 12px;
	border: 3px solid white;
	margin-top: 20px;
	text-decoration:blink;
	width: 12%;
	color: white;
	background:inherit;
	opacity: 0.7;
	font-weight: bold;
}
//input[type=text]:hover, input[type=password]:hover {
	border: 2px solid white;
}
input[type=submit]:hover {
	opacity: 1.0;
}
section.top {
	margin-top: 30px;
 //border:2px solid grey;
	text-align: center;
}
section.top i {
	color: white;
	font-size: 1200%;
}

section.top span {
	color: white;
	font-variant: small-caps;
	font-size: 270%;
	margin-top: 50px;
	font-weight: bold;
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
}
</style>
</head>

<body>

  <?php
$msg='';
include("connect.php");

if(isset($_POST["admsub"]))
{
$user=$_POST["adm"];
$pass=$_POST["admpass"];


$sql=mysql_query("select * from `admin` where `user`='vedant#123' ");
while($row=mysql_fetch_array($sql))
{
if(($row["pass"]==$pass)&&($user=="vedant#123"))
{ 
// Session Starts
session_start();
$_SESSION["user"]=true;
//session code ends

$msg='<div class="alert alert-success" style="font-size:17px;padding:20px;text-align:center;"><strong> SUCCESS-! </strong> You are now being logged in </div>';  
?>
  <script>
        function Redirect() {
             window.location="main.php";
            }
       setTimeout('Redirect()', 2000);
</script>
  <?php
}
else
{
	$msg='<div class="alert alert-danger" style="font-size:17px;padding:20px;text-align:center;"> <strong> FAILURE-! </strong> Invalid Username or password </div>'; 
?>
  <script>
        function Redirect() {
			
             window.location="admin.php";
            }
       setTimeout('Redirect()', 2700);
</script>
  <?php
}
}
}
?>
<div class="container-fluid">
  <?=$msg?>
  
  <section class="top">
    <td><i class="fa fa-user" aria-hidden="true" ></i></td>
    <br>
    <span> kesco Co.</span> </section>
  <div class="adm">
    <form action="#" method="post" >
      <input type="text" name="adm" placeholder="Username" required>
      <br>
      <input type="password" name="admpass" placeholder="password" required>
      <br>
      <input type="submit" name="admsub" value="Login" >
    </form>
  </div>
</div>
</body>
</html>
