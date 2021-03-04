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
</head>
<body>
<?php
include("connect.php");
$units=$_POST['units'];
$month=$_POST['month'];
$metnum=$_POST['metnum'];
$cgst=$_POST['cgst'];
$amount=$_POST['amount'];

$sql="INSERT INTO `$month` (`id`, `meter_num`, `units`, `sgst`, `cgst`, `amount`, `status`) VALUES (NULL, '$metnum', '$units', '$cgst', '$cgst', '$amount', '')";

$inn=mysql_query($sql);

if($inn==1)
{?>
<script>
alert("YOU have SUCCESSFULLY PAID the BILL Of ***  <?=$month?>  *** CLICK OK to see STATUS ");
</script>

          	 <script>
        function Redirect() {
             window.location="status1.php?id=<?=$metnum?>";
            }
       setTimeout('Redirect()', 800);
</script>
			

<?php
 }
 else
 { ?>
	 <script>
alert("YOUR BILL was NOT GRANTED for the MONTH of ***  <?=$month?>  ");
</script>

          	 <script>
        function Redirect() {
             window.location="bill.php";
            }
       setTimeout('Redirect()', 800);
</script>
 <?php }
?>
</body>
</html>