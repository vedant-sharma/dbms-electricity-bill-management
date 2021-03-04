<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>control menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="awesome/css/font-awesome.min.css" type="text/css">
<script src="js/jquery-3.2.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css style-sheets/edit.css" type="text/css">
<style>
<style>
body {
	margin: 0;
	padding: 0;
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
.frm{
	
	width:58%;
	position:relative;
	//top:20px;
	left:420px;
	//border:1px solid red;
	padding:3px;}
	.one{}
	.one input[type=text]{
		width:25%;
		margin:0 8px;
		text-align:center;padding:7px;
		font-variant:small-caps;
		border-radius:6px;
		font-weight:500;
		}
			
	.two input[type=text]{
		width:30%;
		margin:0 250px;
		font-weight:500;
		text-align:center;padding:7px;
		font-variant:small-caps;
		//font-weight:bold;
		border-radius:6px;
		}
		.three,.four,.two
		{
			margin-top:55px;}
			.five{margin-top:75px;}
			
		#n31{
			//font-weight:bold;
			font-weight:500;
		width:30%;
		margin:0 10px;
		text-align:center;
		font-variant:small-caps;
		padding:7px;
		border-radius:6px;
		}
		#n3 {width:20%;
		margin:0 290px;
		text-align:center;
		font-variant:small-caps;
		border-radius:6px;
		font-weight:500;
		padding:7px;
		}
		.four input[type=text]
		{
			
		width:37%;
		padding:7px;
		margin:0 8px;
		text-align:center;
		font-variant:small-caps;
		border-radius:6px;
		font-weight:500;
		}
#logout
{
	background-color:#C9C805;font-weight:bolder;}
	.five input[type=submit]
		{width:26%;
		margin:0 175px;
		text-align:center;
		font-variant:small-caps;
		border-radius:10px;
		color:white;
		font-weight:500;
		padding:12px;
		opacity:1.0;}
</style>
<body>
<?php
$msg='';
include("connect.php");

if(isset($_POST['submit']))
{
     $idd=$_POST['upid'];
	$name=$_POST['name'];
	$midname=$_POST['midname'];
	$surname=$_POST['surname'];
	$phnnum=$_POST['phnnum'];
	$email=$_POST['email'];
	 $address=$_POST['address'];
 	$city=$_POST['city'];
	 $state=$_POST['state'];
	 $cust_type=$_POST['cust_type'];
	 
$sqll="UPDATE `customers` SET `name`='".$name."',`midname`='".$midname."',`surname`='".$surname."',`phnnum`='".$phnnum."',`email`='".$email."',`adress`='".$address."',`city`='".$city."',`state`='".$state."',`cust_type`='".$cust_type."' WHERE `meter_num`='".$idd."'";
	
 $inn=mysql_query($sqll);
 if($inn==1)
 {
	$msg='<div class="alert alert-success" style="font-size:17px;padding:20px;text-align:center;margin-top:0px;"><strong> SUCCESS.!</strong> Customer Records Updated successfully</div>'; 
?>
<script>
function Redirect()
{
	window.location="view_cust.php";
}
setTimeout('Redirect()',2500);
</script>
<?php
}
else
{
	$msg='<div class="alert alert-danger> <strong> FAILURE-! </strong> Customer not added Try Again</div>';
}
}
?>
<div class="container-fluid">
<?php echo $msg; ?>
<div class="outer">
<div class="nav">
  <ul>
    <a href="main.php" target="_self">
    <li >Add Customer </li>
    </a>
    <a href="view_cust.php" target="_self"><li>View Customer </li></a>
    <a href="edit_cust.php" target="_self"><li id="current" > Edit Customer </li></a>
   <a href="bill.php" target="_self"><li > Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
    <a href="last_bill.php" taget="_self"><li> Last Payment Details </li></a>
    <a href="logout.php" target="_self" ><li id="logout"> logout </li></a>
  </ul>
  <?php
  $id=$_GET["id"];
  $sql="select * from `customers` where `meter_num`='$id' ";
   $in=mysql_query($sql);
  while($row=mysql_fetch_array($in))
  {
  
  ?>
  <form action="#" method="post">
  <div class="frm">
    <div class="one"><hr style="border:0.3px solid grey;width:65%;position:relative;right:150px;">
      <input type="text" name="name" id="n1" value="<?=$row['name']?>" placeholder="*Name" ><br>

      <input type="text" name="midname" id="n1" placeholder="middle  name" value="<?=$row['midname']?>">
<br>
      <input type="text" name="surname" id="n1" placeholder="*Surname" value="<?=$row['surname']?>" required>
    </div>
    <div class="two">
      <input type="text" name="phnnum" id="n2" placeholder="*Contact Number" value="<?=$row['phnnum']?>"required><br>

      <input type="text" name="email" id="n2" placeholder="*E-mail Address" value="<?=$row['email']?>" required>
    </div>
    <div class="three">
      <input type="text" name="address" id="n31" placeholder="*Adress" value="<?=$row['adress']?>" required><br>

      <input type="text" name="city" id="n3" placeholder="*City" value="<?=$row['city']?>" required>
<br>
      <input type="text" name="state" id="n3" placeholder="State" value="<?=$row['state']?>">
    </div>
    <div class="four">
      <input type="text" name="cust_type" id="n4" placeholder="*Customer Type(Domestic or Commercial)" value="<?=$row['cust_type']?>" required>
    </div>
    <div class="five">
      <input type="submit" name="submit" value="Update Customer Records" class="btn btn-info">
      <input type="hidden" name="upid" value="<?=$id?>">
    </div>
  </div>
  </form>
  <?php }
  ?>
</div>
</div>
</body>
</html>