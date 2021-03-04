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
  $metnum=$_GET['id'];
  
  
  $sql="select * from `customers` where `meter_num`='$metnum' ";
   $in=mysql_query($sql);
   while($row=mysql_fetch_array($in))
   {
  $alertname=$row['name'];
  
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
  
  <span style="font-size:23px;font-weight:bolder;color:#4391E4"> ---CHOOSE THE MONTH OF WHICH YOU WANT TO PAY THE BILL--- </span>
  <br><br><br>
<form action="#" method="post" >
<select name="month">
<option value="january"> January </option>
<option value="february"> February </option>
<option value="march" > March </option>
<option value="april"> April </option>
<option value="may" > May </option>
<option value="june" > June </option>
<option value="july" > July </option>
<option value="august" > August </option>
<option value="september" > September </option>
<option value="october" selected> October  </option>
<option value="november" > November </option>
</select>
<br><br><br><br>
<input type="hidden" name="metnum" value="<?=$metnum?>">
<input type="submit" name="submit"  class="btn btn-warning" >

</form>
   </div>
  </div>
  
 <?php
 if(isset($_POST['submit']))
 {
	$arr=array("january","february","march","april","may","june","july","august","september","october","november","december"); 
	$month=$_POST['month'];
	
	if($month=="january")
	{ 
    	 $ssql="select * from `$month` where `meter_num`='$metnum' ";
	 $iin=mysql_query($ssql);
	 $ccnt=mysql_num_rows($iin);
	 
	 if($ccnt==1)
	 {?>
     <script>
	 alert(" Hii!! <?=$alertname?> YOU have ALREADY PAID the BILL of <?=$month?> .! ")
	 </script>
            	 <script>
				
        function Redirect() {
             window.location="pay1.php?id=<?=$metnum?>";
            }
       setTimeout('Redirect()', 500);
</script>
<?php }
      else { ?>
		 <script>
        function Redirect() {
             window.location="pay2.php?month=<?=$month?>&metnum=<?=$metnum?>";
            }
       setTimeout('Redirect()', 500);
</script>
     <?php 
	  }
	  } // end of if statement for MONTH == JANUARY
	  
	 else // Parent else 
	 {
		 $count=1;
		 while($arr[$count]!=$month)
		 {
			 $count++;
	     }
	$arr[$count];
	 $metnum;
	 $sql="select * from `$month` where `meter_num`='$metnum' ";
	 $in=mysql_query($sql);
	 $cnt=mysql_num_rows($in);
	 
	 if($cnt==1)
	 {?>
     <script>
	 alert(" Hii!! <?=$alertname?> YOU have ALREADY PAID the BILL of <?=$month?> .! ")
	 </script>
            	 <script>
				
        function Redirect() {
             window.location="pay1.php?id=<?=$metnum?>";
            }
       setTimeout('Redirect()', 1000);
</script>
	 <?php 
	 } // END OF TESTING FOR --- THE BILL OF THE INPUTED MONTH IS PAID OR NOT
	 
	 else if($month=="february")
	 {
		 $sqlll="select * from `january` where `meter_num`='$metnum' ";	
		 $innn=mysql_query($sqlll);
		 $cnttt=mysql_num_rows($innn);
		 if($cnttt==0)
		 {?>
			     <script>
			 alert("Hii!! <?=$alertname?> your PREVIOUS MONTH PAYMENT'S ARE PENDING ..!!! please FULFIL them FIRST in order to PROCEED for <?=$month?>'s payment");
			 </script>
				 
            	 <script>
        function Redirect() {
             window.location="pay1.php?id=<?=$metnum?>";
            }
       setTimeout('Redirect()', 1000);
</script>
		 <?php 
		 }
		
		 else
		 {?>
               	 <script>
        function Redirect() {
             window.location="pay2.php?month=<?=$month?>&metnum=<?=$metnum?>";
            }
       setTimeout('Redirect()', 500);
</script>
			 
   <?php }
		 
	 }//   end of else if mon= february
	 
	 else
	 {      
			 while($count>=1)
			 {
			 $count--;
			  $mon=$arr[$count];
		 	 $sqll="select * from `$mon` where `meter_num`='$metnum' ";
			 $inn=mysql_query($sqll);
			 $cntt=mysql_num_rows($inn);
			 if($cntt==1){break;}
			 }
			 
			 $count++;
			 
			 if($month==$arr[$count])
			 {?>
             	 <script>
        function Redirect() {
             window.location="pay2.php?month=<?=$month?>&metnum=<?=$metnum?>";
            }
       setTimeout('Redirect()', 500);
</script>
				<?php
			 }
			 else
			 {?>
             
             <script>
			 alert("Hii!! <?=$alertname?> your PREVIOUS MONTH PAYMENT'S ARE PENDING ..!!! please FULFIL them FIRST in order to PROCEED for <?=$month?>'s payment ");
			 </script>
				 
            	 <script>
        function Redirect() {
             window.location="pay1.php?id=<?=$metnum?>";
            }
       setTimeout('Redirect()', 1000);
</script>
			<?php 
	 }//end of else
	 }// end of else 1)if moth is NOT FBRUARY 2)IF bill is NOT PAID for inpted month
	 } // end of else if MONTH is NOT JANUARY
	 } // end of is is set SUBMIT
	 ?>
    
    </div>
  </div>

</body>
</html>



