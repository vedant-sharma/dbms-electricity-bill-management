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
<title>Our Customers</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="awesome/css/font-awesome.min.css" type="text/css">
<script src="js/jquery-3.2.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css style-sheets/view_cust.css" type="text/css">
<link rel="stylesheet" href="css/animate.css" type="text/css">
<style>
#logout
{
	background-color:#C9C805;font-weight:bolder;}
</style>


</head>

<body>
<div class="container-fluid">
<div class="outer">
<div class="nav">
  <ul>
    <a href="main.php" target="_self"><li >Add Customer </li></a>
    <a href="view_cust.php" target="_self"><li id="current">View Customer </li></a>
    <a href="edit_cust.php" target="_self"><li> Edit Customer </li></a>
    <a href="bill.php" target="_self"><li> Bill Payment</li></a>
  <a href="status.php" taget="_self"> <li > Status of Bills </li></a>
        <a href="last_bill.php" taget="_self"><li> Last Payment Details </li></a>
    <a href="logout.php" target="_self"><li id="logout"> logout </li></a>
  </ul>
  </div>
  </div>
  </div>
   <?php
$msg='';
include("connect.php");


?>
<table width="90%" border="1">
  <tbody>
    <tr class="wow fadeInLeftBig" data-wow-delay="0.2s">
      <th width="9%" scope="col">First Name</th>
      <th width="7%" scope="col">Middle Name</th>
      <th width="9%" scope="col">Surame</th>
      <th width="16%" scope="col">Address</th>
      <th width="6%" scope="col">City</th>
      <th width="5%" scope="col">State</th>
      <th width="13%" scope="col">Email</th>
      <th width="11%" scope="col">Contact Number</th>
      <th width="10%" scope="col">Customer Type</th>
      <th width="14%" scope="col">Meter Number</th>
    </tr>
    <?php
	$sql="select * from `customers` ";
	$in=mysql_query($sql);
	while($row=mysql_fetch_array($in))
{
?>
	
   <tr data-wow-delay="0.5s" class="wow fadeInDown">
      <td><?=$row["name"]?></td>
      <td><?=$row["midname"]?></td>
      <td><?=$row["surname"]?></td>
      <td><?=$row["adress"]?></td>
      <td><?=$row["city"]?></td>
      <td><?=$row["state"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["phnnum"]?></td>
      <td><?=$row["cust_type"]?></td>
      <td><?=$row["meter_num"]?></td>
    </tr><?php
}
 
  ?>
   </tbody>
</table>
</body>
 <script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>
</html>