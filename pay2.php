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
.left table
{
border:none;}
.left table th
{
	text-align:center;
	font-size:18px;
	padding:5px;
	border:none;
	font-variant:small-caps;
	color:#777575;}
	
	#t1{float:left;}
	#t2{float:right;}
	
	.left table td
	{//text-align:center;
	font-size:18px;
	padding:5px;
	border:none;
	color:#D78686;
	font-weight:bolder;
	font-variant:small-caps;}
	.right
	{
		clear:both;
		padding-top:40px;
		//border:1px solid black;
	}
	 input[type=submit]
		{
			
		width:20%;
		margin:0 175px;
		text-align:center;
		font-weight:bolder;
		font-variant:small-caps;
		border-radius:10px;
		font-weight:500;
		padding:8px;
		font-size:18px;
		opacity:1.0;
		box-shadow:8px 8px 20px grey;
		}
	input[type=number]
	{width:27%;
	font-variant:small-caps;
	text-align:center;
	font-weight:bolder;
	font-size:20px;
	box-shadow:4px 4px 20px grey;
	//border:2px solid;
	padding:8px;
	color:#787878;
	border-radius:5px;}
	.slct
	{
		width:51%;
		padding:5px;
		//border:1px solid black;
		margin:0 auto;
		text-align:center;}

</style>
</head>
<body>
<div class="container-fluid">
<div class="outer">
<div class="nav">
  <ul>
    <a href="main.php" target="_self"><li >Add Customer </li></a>
    <a href="view_cust.php" target="_self"><li >View Customer </li></a>
    <a href="edit_cust.php" target="_self"><li> Edit Customer </li></a>
   <a href="bill.php" target="_self"><li id="current"> Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
    <a href="last_bill.php" taget="_self"><li > Last Payment Details </li></a>
    <a href="logout.php" target="_self" ><li id="logout"> logout </li></a>
  </ul>
  </div><hr style="border:0.5px solid #ABA5A5;">
  
  <?php
  include("connect.php");
  $msg='';
  $metnum=$_GET['metnum'];
   $month=$_GET['month'];
  
  $sql="select * from `customers` where `meter_num`='$metnum' ";
   $in=mysql_query($sql);
   while($row=mysql_fetch_array($in))
   {
  
  
  ?>
  
  <div class="left">
  <table width="35%" height="145" border="1" id="t1">
  <tbody>
    <tr>
      <th width="39%" scope="row">name -</th>
      <td width="61%"><?php echo $row['name'];echo' ';echo $row['midname']; echo' '; echo $row['surname'];   ?></td>
    </tr>
    <tr>
      <th scope="row">email -</th>
      <td><?=$row['email'];?></td>
    </tr>
    <tr>
      <th scope="row">phone -</th>
      <td><?=$row['phnnum']; ?></td>
    </tr>
  </tbody>
</table>
<table width="34%" height="190" border="" id="t2">
  <tbody>
    <tr>
      <th width="39%" height="51" scope="row">address -</th>
      <td width="61%"><?=$row['adress']; ?></td>
    </tr>
    <tr>
      <th height="48" scope="row">city -</th>
      <td><?=$row['city'];?></td>
    </tr>
    <tr>
      <th height="49" scope="row">state -</th>
      <td><?=$row['state']; ?></td>
    </tr>
    <tr>
      <th height="51" scope="row">customer type -</th>
      <td><?=$row['cust_type']; } ?></td>
    </tr>
  </tbody>
</table>
  </div>
  
  <div class="right">
  <hr>

  
  <div class="slct">
   <span style="font-size:23px;font-weight:bolder;color:#4391E4"> ---ENTER THE NUMBER OF UNITS CONSUMED---</span><br><br><br>
   <form  action="#" method="post" id="my_form">
  <input type="number" name="units" min="1" placeholder="*Units" required><br><br>
  <span style="color:red;"> * ₹5.50 (Domestic unit charge)  ₹8.25 (Commercial unit charge) </span><br>
  <span style="color:red;"> * Above mentioned prices will be charged for upto 300 units </span><br>
  <span style="color:red;"> * For units>300,₹3 plus the specified charges and for units>500,₹5 plus the specified charges </span>
  <br><br>
  <input type="hidden" name="month" value="<?=$month?>">
 <input type="hidden" name="metnum" value="<?=$metnum?>">
<input type="submit"  name="submit"  class="btn btn-warning" >
 <?php
  if(isset($_POST['submit']))
  {
	  $units=$_POST['units'];
	  $month=$_POST['month'];
	  $metnum=$_POST['metnum'];
	  ?>
             	 <script>
        function Redirect() {
             window.location="pay3.php?month=<?=$month?>&metnum=<?=$metnum?>&units=<?=$units?>";
            }
       setTimeout('Redirect()', 800);
</script>
  <?php }
  ?>
</form>


  
</form>
   </div>
  </div>


  </div>
  </div>

</body>
</html>



