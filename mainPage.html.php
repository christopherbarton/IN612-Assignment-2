<!doctype html>
<html>
	<head>
	<title>Olympics</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><link rel='stylesheet' type='text/css' href='style.php'>

	</head>
<body >
<?php
    $self = htmlentities($_SERVER['PHP_SELF']);
		echo "<form action = '$self' method='POST'> ";
?>
<div class="flex-container">
	<img src="photos/rioOlympics.png" class="img-rounded" alt="">
	
	<div class="container">
	<h2 class="text-center">Olympics Database Maintanance</h2>
</div>
<br>
<div class="flex-container">
<input type='submit' class="btn btn-info" name='search' value='Search Database'>
</div>
<br>
<div class="flex-container">
<input type='submit' class="btn btn-warning" name='addAthlete' value='Add Athlete'>
</div>
<br>
<div class="flex-container">
<input type='submit' class="btn btn-primary" name='addCountry' value='Add Country'>
</div>
</body>