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
   <a href="bill.php" target="_self"><li id="current"> Bill Payment</li></a>
    <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
    <a href="last_bill.php" taget="_self"><li > Last Payment Details </li></a>
    <a href="logout.php" target="_self" ><li id="logout"> logout </li></a>
  </ul>
  </div><hr style="border:0.5px solid #ABA5A5;">
  <?php
  include("connect.php");
  $amount='';  //amount not including taxes
  $tamount='';  //amount including taxes
   $units=$_GET['units'];
   $month=$_GET['month'];
  $metnum=$_GET['metnum'];
  $sql="select * from `customers` where `meter_num`='$metnum' ";
  $in=mysql_query($sql);
  while($rows=mysql_fetch_array($in))
  {
	   $custype=$rows['cust_type'];
	   if($custype=="commercial")
	   {
		   if($units>500)
		   { $amount= (((300*8.25)+(200*11.25)+(($units-500)*13.25))+250);
		   }
		   if(($units<=500)&&($units>300))
		   {$amount=((300*8.25)+(($units-300)*11.25));
		   }
		   if($units<=300)
		   {$amount=(300*8.25);
		   }
		}
		else
		{
		   if($units>500)
		   { $amount= (((300*5.50)+(200*8.50)+(($units-500)*10.50))+250);
		   }
		   if(($units<=500)&&($units>300))
		   {$amount=((300*5.50)+(($units-300)*8.50));
		   }
		   if($units<=300)
		   {$amount=(300*5.50);
		   }
		}//end of else
		$sgst=(($amount*9)/100);
		$cgst=$sgst;
		$tamount=((2*$cgst)+$amount);
	  
 
  
  ?>
  <div class="bill">
  <table border="1">
  <tr>
  <td colspan="2"> <span>meter number -<br></span><?=$metnum;?>  </td> 
  <td> <span>month-</span><br><?=$month;?></td>
  </tr>
 
   <tr>
  <td> <span>name- </span><br><?php echo $rows['name']; echo ' ';echo $rows['midname'];echo ' ';echo $rows['surname'];?></td>
  <td> <span>email-</span><br><?=$rows['email'];?> </td>
  <td><span>phone number-</span><br><?=$rows['phnnum'];?></td>
  </tr>
  
   <tr>
   <td colspan="2"><span>customer type -</span></td>
   <td> <?=$rows['cust_type'];?></td>
   </tr>
   
   <tr>
   <td><span>address-</span><br><?=$rows['adress'];?></td>
   <td><span>city-</span><br><?=$rows['city'];?></td>
   <td><span>state-</span><br><?=$rows['state'];?></td>
   </tr>
   
   <tr>
   <td colspan="3"><span>---  BILL DETAILS  ---</span></td>
   </tr>
   
   <tr>
   <td><span>unit consumed -</span><br><?=$units?> units</td>
   <td><span>state-gst(sgst) -</span><br>₹<?=$sgst;?></td>
   <td><span>center-gst(cgst) -</span><br>₹<?=$cgst?></td>
   </tr>
   
   <tr>
   <td colspan="1"><span>meter charges -</span><br> ₹250</td>
   <td colspan="2"> <span style="color:red;">TOTAL BILL AMOUNT - ₹<?=$tamount?></span></td>
   </tr>
  </table>
  <br>

  </div>
  <div style="text-align:center;">  
  <form action="pay4.php" method="post">
  <input type="submit" name="submit" value="PAY BILL" class="btn btn-success" >
 
 <input type="hidden" name="units" value="<?=$units?>">
  <input type="hidden" name="month" value="<?=$month?>">
   <input type="hidden" name="metnum" value="<?=$metnum?>">
   <input type="hidden" name="cgst" value="<?=$cgst?>">
   <input type="hidden" name="amount" value="<?=$tamount?>">
  </form>
   <?php }//end of while ?>
  </div>
 
  </div>
  </div>
</body>
</html>