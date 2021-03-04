<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>logout</title>
</head>

<body>
<?php
session_start();

session_unset();
header('location:admin.php');
?>
</body>
</html>