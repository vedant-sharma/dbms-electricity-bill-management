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
	select
	{width:27%;
	font-variant:small-caps;
	text-align:center;
	font-weight:bolder;
	font-size:20px;
	box-shadow:4px 4px 20px grey;
	//border:2px solid;
	padding:8px;
	color:#787878;
	border-radius:10px;}
	.slct
	{
		width:51%;
		padding:5px;
		//border:1px solid black;
		margin:0 auto;
		text-align:center;}
		script alert
		{color:red;}
	.info{width:100%;padding:2px;}
	.info table{width:90%;}
     .info table th{text-align:center;padding:2px;font-size:17.5px;font-variant:small-caps;color:#D78686;}
	 .status{width:100%;padding:10px;}
	 .status table{width:60%;margin:0 auto;}
	 .status table th{text-align:center;padding:2px;font-size:17.5px;font-variant:small-caps; color:grey;}
	 .status table td{text-align:center;padding:7px;font-size:17.5px;font-variant:small-caps;color:#D78686;font-weight:bold;}
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
   <a href="bill.php" target="_self"><li > Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li id="current" > Status of Bills </li></a>
    <a href="last_bill.php" taget="_self"><li > Last Payment Details </li></a>
    <a href="logout.php" target="_self" ><li id="logout"> logout </li></a>
  </ul>
  </div><hr style="border:0.5px solid #ABA5A5;">
  
  <?php
  
  include("connect.php");
  $msg='';
  $status="disabled";
  $metnum=$_GET['id'];
  
  $arr=array("january","february","march","april","may","june","july","august","september","october","november","december");
  $count=0;
  
  $sqll="select * from `customers` where `meter_num`='$metnum' ";
   $inn=mysql_query($sqll);
   while($rows=mysql_fetch_array($inn))
   {
   ?>
   <div class="info">
   <table>
   <tr>
   <th><span style="font-size:15px;color:grey;font-variant:small-caps;">NAME : </span><?=$rows['name'];?></th>
   <th><span style="font-size:15px;color:grey;font-variant:small-caps;">CUSTOMER TYPE : </span><?=$rows['cust_type'];?></th>
   <th><span style="font-size:15px;color:grey;font-variant:small-caps;">ADDRESS : </span><?=$rows['adress']?></th>
   </tr>
   </table>
   </div>  
   <?php 
   }
    ?>
  <hr>

   <div class="status">
  <table>
  <tr>
  <th> month</th>
  <th> status </th>
  <th> amount </th>
  </tr>
  <?php while($count<=10)
  {
  $sql="select * from `$arr[$count]` where `meter_num`='$metnum' ";
   $in=mysql_query($sql);
  ?>
  
   
  <?php $cnt=mysql_num_rows($in);
   
   if($cnt==1)
   { 
   while($rowss=mysql_fetch_array($in))
   {
	   ?>
   <tr>
   <td><?=$arr[$count]?></td>
   <td><button class="btn btn-success" > PAID </button>
       <button class="btn btn-danger" <?=$status?>> UNPAID </button> </td>
    <td> ₹<?=$rowss['amount'];?> </td>
   </tr>
	   
   <?php 
   }
   }//end of if
   else
   { ?>
   <tr>
   <td><?=$arr[$count];?></td>
   <td><button class="btn btn-success" <?=$status?>> PAID </button>
       <button class="btn btn-danger" > UNPAID </button> </td>
   <td>---</td>
   </tr>
   
                        
   
   <?php 
   }//end of else
   
   $count++;
  } ?>
  </table>
  </div>   <!--- end of div class equals status contain table --->  <!--- end of div class equals table --->  <!--- end of div class equals table ---> 
   
 
  
  
  </div>
  </div>
</body>
</html>