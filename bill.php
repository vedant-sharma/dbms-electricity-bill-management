  <?php
session_start();
if(!isset($_SESSION["user"]))
{
	header('location:admin.php');
	die();
}

	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Payment Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="awesome/css/font-awesome.min.css" type="text/css">
<script src="js/jquery-3.2.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css style-sheets/bill.css" type="text/css">
<style>
body {
	margin: 0;
	padding: 0;
	//backgrounD:#d9D9D9;
}
.nav {
	padding: 10px;
	width: 97%;
	//border-left: 1px solid red;
	//border-right: 1px solid red;
	margin: 0 auto;
}
.outer.nav ul {
	list-style-type: none;
	padding: 0;
	margin: 0;
}
#current {
	background-color: #4CAF50;
}
#logout
{
	background-color:#C9C805;font-weight:bolder;}
.nav ul li {
	display: inline-block;
	width: 13.7%;
	padding: 4px;
	box-sizing: border-box;
	text-align: center;
	color: white;
	background: red;
	font-variant: small-caps;
	font-size: 15px;
}
.nav ul li:hover
{
background-color: #4CAF50;
}
 .frm input[type=text], .frm input[type=email]
 {
	 padding:10px;
	 width:50%;
	 text-align:center;
	// font-variant:small-caps;
	 font-weight:600;
	border-radius:3px; 
	 margin:10px;
	}
	.frm input[type=email]
	{margin-bottom:28px;}
	.frm input[type=submit]
	{
		padding:12px;
		width:17%;
		font-size:17px;
		margin-left:133px;
		font-weight:bolder;
		text-align:center;
		box-shadow:7px 7px 20px grey;
		font-variant:small-caps;
		border-radius:7px;}
		.frm
		{
			position:relative;
			top:130px;
			width:50%;
			left:540px;
		}
		
	

</style>

</head>

<body>
<?php
$msg='';
$test='';
include("connect.php");

if(isset($_POST['submit']))
{
	 $nm=$_POST['fname'];
	$mail=$_POST['email'];


$sql="SELECT * FROM `customers`WHERE `email`='$mail' AND `name`='$nm'";
 $in=mysql_query($sql);
 $tst=mysql_num_rows($in);
if($tst==0)
{
	$msg='<div class="alert alert-danger" style="font-size:17px;padding:20px;text-align:center;"><strong> NOT FOUND-! </strong> Please enter the correct name or email </div>';
	?>
   <script>
        function Redirect() {
             window.location="bill.php";
            }
			//SELECT `meter_num` FROM `customers`WHERE EXISTS(SELECT * FROM `customers`WHERE `email`="ved@122" AND `name`="ved")
			//https://stackoverflow.com/questions/2679865/return-a-value-if-no-rows-are-found-sql
			//https://stackoverflow.com/questions/27906811/php-and-sql-login-user-not-found
			//https://www.youtube.com/watch?v=kGGy4eGFEsg
			
       setTimeout('Redirect()', 2000);
</script>
<?php
}
else
{
		$msg='<div class="alert alert-success" style="font-size:17px;padding:20px;text-align:center;"><strong> SUCCESS-! </strong> Proceeding for Bill payment </div>';
		while($rows=mysql_fetch_array($in))
		{
			$test=$rows['meter_num'];
		}
             
?>
  <script>
        function Redirect() {
             window.location="pay1.php?id=<?=$test?>";
            }
       setTimeout('Redirect()', 2000);
</script>
<?php } }?>

<div class="container-fluid">
<?php echo $msg; ?>
<div class="outer">
<div class="nav">
  <ul>
    <a href="main.php" target="_self"><li >Add Customer </li></a>
    <a href="view_cust.php" target="_self"><li >View Customer </li></a>
    <a href="edit_cust.php" target="_self"><li> Edit Customer </li></a>
   <a href="bill.php" target="_self"><li id="current"> Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
   <a href="last_bill.php" taget="_self"><li > Last Payment Details </li></a>
    <a href="logout.php" target="_self"><li id="logout"> logout </li></a>
  </ul>
  </div><hr style="border:0.5px solid #ABA5A5;">
  
  <div class="frm">
  
  <form method="post" action="#">
  <input type="text" name="fname" placeholder="--- Enter your Name ---" required><br>
  <input type="email" name="email" placeholder="--- Enter your E-Mail ---" required><br>
  <input type="submit" name="submit" value="Search" class="btn btn-info">
  
  
  </form>
  </div>
  
  </div>
  </div>
  
  

</body>
</html>