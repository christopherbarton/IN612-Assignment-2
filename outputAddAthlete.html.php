<!--This file Generates the variables needed to add an athlete to a databas and gets the User to confirm these details -->
<!doctype html>
<html>
	<head>
		<title>Add Athlete</title>
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
	<p><h1 class="text-center">Please confirm Athlete Details to be added</h1></p>
</div>

<div class="flex-container">
<?php
// create variables from _POST
$addFirstName = $_POST["firstName"];
$addLastName=$_POST["lastName"];
$addGender=$_POST["list3"];
$addImage=$_POST["image"];
$addSport=$_POST["list2"];
$addCountry=$_POST["list1"];

// Strip tags from fields

$addFirstName =cleanInput($addFirstName);
$addLastName=cleanInput($addLastName);
$addGender=cleanInput($addGender);
$addImage=cleanInput($addImage);
$addSport=cleanInput($addSport);
$addCountry=cleanInput($addCountry);

// echo $addFirstName,$addLastName,$addGender,$addImage,$addSport,$addCountry; // used for debugging


$fields = array("Country Name","Sport","First Name","Last Name","Gender","Image URL");
$count = 0;
?>

<div class="table-responsive">
<div class="flex-container">
<table class="table table-bordered table-striped">
            
<thead class="thead-dark">
    <tr>	
        <th>Field</th><th>Value</th>
    </tr>
</thead>
<tbody>
<?php

foreach($_POST as $field=>$value)
    {
    if ($field != 'submitAthlete')
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
$_SESSION["addFirstName"]=$addFirstName;
$_SESSION["addLastName"]=$addLastName;
$_SESSION["addGender"]=$addGender;
$_SESSION["addImage"]=$addImage;
$_SESSION["addSport"]=$addSport;
$_SESSION["addCountry"]=$addCountry;

function cleanInput($data)
{
    $data =trim($data);
    $data =stripslashes($data);
    $data =htmlspecialchars($data);
    return $data;
}

?>
<br>
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
function myFunction() {
    
        alert("Athlete has been added");
        <?php include 'insertAthlete.php'; ?>
}
</script>
</body>