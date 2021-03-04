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
.bill{
	width:75%;
	margin:0 auto;
	padding:5px;
	border:1px soild black;}
table
{margin:0 auto;
width:70%;
padding:2px;
border:1px solid grey;
}
table td
{
	font-size:17px;
	
font-weight:bold;
text-align:center;
font-variant:small-caps;
	padding:17px;
color:black;
}
table td span
{color:#4391E4; font-weight:bolder;}
input[type=submit]{padding:15px;width:8%;border-radius:10px;font-weight:bold;}
</style>

<body>
<div class="container-fluid">
<div class="outer">
<div class="nav">
  <ul>
    <a href="main.php" target="_self"><li >Add Customer </li></a>
    <a href="view_cust.php" target="_self"><li >View Customer </li></a>
    <a href="edit_cust.php" target="_self"><li> Edit Customer </li></a>
   <a href="bill.php" target="_self"><li> Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
    <a href="last_bill.php" taget="_self"><li id="current"> Last Payment Details </li></a>
    <a href="logout.php" target="_self" ><li id="logout"> logout </li></a>
  </ul>
  </div><hr style="border:0.5px solid #ABA5A5;">
  <?php 
  include("connect.php");
  $metnum=$_GET['id'];
  $sql="SELECT * FROM `customers` WHERE `meter_num`='$metnum'";
 $in=mysql_query($sql);
 while($row=mysql_fetch_array($in))
 {
	 $name=$row['name'];
	 $midname=$row['midname'];
	 $surname=$row['surname'];
	 $phnnum=$row['phnnum'];
	 $email=$row['email'];
	 $cust_type=$row['cust_type'];
	 $adress=$row['adress'];
	 $city=$row['city'];
	 $state=$row['state'];
 }
  
  $arr=array("january","february","march","april","may","june","july","august","september","october","november","december");
  $count=10;
  
   while($count>=0)
	{
   $sqll="SELECT * FROM `$arr[$count]` WHERE `meter_num`='$metnum'";
   $inn=mysql_query($sqll);
   $cnt=mysql_num_rows($inn);
   
    if(($cnt==1))
   {
	   while($rows=mysql_fetch_array($inn))
	   {
		   $month=$arr[$count];
		   $units=$rows['units'];
		   $cgst=$rows['cgst'];
		   $tamount=$rows['amount'];
	   }
	   break;
	}
	
	if($count==0)
	{
		if($cnt==1)
		{
			while($rowss=mysql_fetch_array($inn))
			{
				$month=$arr[$count];
		   $units=$rows['units'];
		   $cgst=$rows['cgst'];
		   $tamount=$rows['tamount'];
			}
			break;
		}
		if($cnt==0)
		{ 
		$month='';
		   $units='';
		   $cgst='';
		   $tamount='';
		 ?>
        <script>
		alert(" Hii..!! <?=$name?> You HAVEN'T PAID any BILL till date, CLICK OK to get REDIRECTED to BILL PAYMENT ")
		</script>
        <script>
		function Redirect() {
             window.location="bill.php";
            }
       setTimeout('Redirect()', 800);
		</script>
  <?php }
		
	} 
	
	$count--;
	}//end of while 
  ?>
  
  
  <div class="bill">
  <table border="1">
  <tr>
  <td colspan="2"> <span>meter number -<br></span><?=$metnum;?>  </td> 
  <td> <span>month was-</span><br><?=$month;?></td>
  </tr>
 
   <tr>
  <td> <span>name- </span><br><?php echo $name; echo ' ';echo $midname;echo ' ';echo $surname;?></td>
  <td> <span>email-</span><br><?=$email;?> </td>
  <td><span>phone number-</span><br><?=$phnnum;?></td>
  </tr>
  
   <tr>
   <td colspan="2"><span>customer type -</span></td>
   <td> <?=$cust_type?></td>
   </tr>
   
   <tr>
   <td><span>address-</span><br><?=$adress;?></td>
   <td><span>city-</span><br><?=$city; ?></td>
   <td><span>state-</span><br><?=$state;?></td>
   </tr>
   
   <tr>
   <td colspan="3"><span>---  BILL DETAILS  ---</span></td>
   </tr>
   
   <tr>
   <td><span>unit consumed were -</span><br><?=$units?> units</td>
   <td><span>state-gst(sgst) -</span><br>₹<?=$cgst;?></td>
   <td><span>center-gst(cgst) -</span><br>₹<?=$cgst?></td>
   </tr>
   
   <tr>
   <td colspan="1"><span>meter charges -</span><br> ₹250</td>
   <td colspan="2"> <span style="color:red;">TOTAL BILL AMOUNT WAS - ₹<?=$tamount?></span></td>
   </tr>
  </table>
</body>
</html>