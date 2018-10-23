<!--File that reads data from the _POST and then  Displays it so that the user can confirm the details before add it to the database --> 
<!doctype html>
<html>
	<head>
		<title>Add Country</title>
		  <meta charset="UTF-8">
          
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
<link rel='stylesheet' type='text/css' href='style.php'>
</head>

<body >
<?php
        include 'connect.inc.php';
        include 'createAthletes.php';
        $self = htmlentities($_SERVER['PHP_SELF']);
        echo "<form action = '$self' method='POST'> ";
        session_start();
    ?>

<div class="flex-container">
	<img src="photos/rioOlympics.png" class="img-rounded" alt="">
	
	<div class="container">
	<p><h2 class="text-center">Please confirm Country Details to be added</h2></p>
</div>

<div class="flex-container">
<?php
// Setup variable from _POST
$addCountryName = $_POST["CountryName"];
$addCountryPopulation=$_POST["Population"];
$addCountryImage=$_POST["ImageName"];

$addCountryName = cleanInput($addCountryName);
$addCountryPopulation=cleanInput($addCountryPopulation);
$addCountryImage=cleanInput($addCountryImage);
// setup other varibles
$selectSport="";
$fields = array("Country Name","Population","Image Name");
$count = 0;
?>

<div class="table-responsive">
<div class="flex-container">
<table class="table table-bordered table-striped">

<!-- write data from the _POST in a table to the screen so that the user can confirm  -->
<thead class="thead-dark">
    <tr>	
        <th>Field</th><th>Value</th>
    </tr>
</thead>
<tbody>
<?php

foreach($_POST as $field=>$value)
    {
    if ($field != 'submitCountry') // Displays all _POSTs except submitCountry
        {
    
            echo("<tr>");
            echo("<td>$fields[$count]</td><td>$value</td>");
            echo("</tr>");
            $count ++;  
        }
    }
?>
</table>
<?php
$_SESSION["addCountryName"]=$addCountryName;
$_SESSION["addCountryPopulation"]=$addCountryPopulation;
$_SESSION["addCountryImage"]=$addCountryImage;

function cleanInput($data)
{
    $data =trim($data);
    $data =stripslashes($data);
    $data =htmlspecialchars($data);
    return $data;
}
?>
<br>
<!--confirmation button -->
  <div class="flex-container">
  <button onclick="myFunction()">Confirm</button>
</div>
<br>
</div>
</div>
<div class="footer">
    <div class="flex-container">
        <input type='submit' class="btn btn-primary" name='back' value='Back to main page'>
</div>

<script>
// function that redirects the page to the insertCountry.php file when the submit button is pressed
function myFunction() {
    <?php include 'insertCountry.php'; ?>
}
</script>
}
</script>
</body>