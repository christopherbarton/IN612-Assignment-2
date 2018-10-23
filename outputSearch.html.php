<!-- This file proccess _POST and creates a pdo MYSQL query to display a table of data-->
<!doctype html>
<html>
	<head>
		<title>Search Result</title>
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
        
    ?>
<div class="flex-container">
	<img src="photos/rioOlympics.png" class="img-rounded" alt="">
	
	<div class="container">
	<h2 class="text-center">Results</h2>
</div>

<div class="flex-container">
<?php
// Setup viriables  
$selectCountry = "";
$selectName="";
$selectLast="";
$selectSport="";
$count = 0;

/*function that setsup values for the WHERE clause in the select query
* the first value that the user selects will include the WHERE statement 
* but subsequent SELECTS will include the AND statement
*/
try
    {
        /*  echo "selectName " . "$selectName". "<br>"; echo "selectLast " . "$selectLast". "<br>"; echo "selectSport " . "$selectSport". "<br>"; 
        echo "selectCountry " . "$selectCountry". "<br>";*/ //Debugging
        
        foreach($_POST as $field => $value)
        {
            /*echo"field " . "$field" . "<br>";
            echo "value " . "$value" . "<br>";*/ // debugging
            if ($value!= -1){
            switch ($field) {
                case 'list1':
                    if ($count>0) {
                        $selectCountry = "AND countryName = '$value'";
                    }
                    else {
                        $selectCountry = "WHERE countryName = '$value'";   
                    }
                    break;
                case 'list2':
                    if ($count>0) {
                        $selectName = "AND firstName = '$value'";  
                    }
                    else {
                        $selectName = "WHERE firstName = '$value'";   
                    }
                    break;
                case 'list3':
                    if ($count>0) {
                        $selectLast = "AND lastName = '$value'";  
                    }
                    else {
                        $selectLast = "WHERE lastName = '$value'";   
                    }
                    break;
                case 'list4':
                    if ($count>0) {
                        $selectSport = "AND sportName = '$value'"; 
                     }
                    else {
                        $selectSport = "WHERE sportName = '$value'";   
                    }
                    break;
                default:
                    break;
                }
                $count++;
            }
        }
        /* Debugging
        echo "selectName " . "$selectName". "<br>";
        echo "selectLast " . "$selectLast". "<br>";
        echo "selectSport " . "$selectSport". "<br>";
        echo "selectCountry " . "$selectCountry". "<br>";
        */

       //Create MYSQL query for search      
       $selectString ="SELECT
         medalists.firstName AS first, medalists.lastName AS last, sport.sportName AS sport, country.countryName AS country,country.flagImage AS flagImage, medalists.image
        FROM 
        medalists
                JOIN sport ON sport.sportId=medalists.sportId
                JOIN  country ON country.countryId=medalists.countryId
                " . "$selectCountry"
                  . "$selectName" 
                  . "$selectLast" 
                  . "$selectSport";

      //  echo "selectString " . "$selectString". "<br>"; debugging
         $MedalistSportCountry = $pdo->query($selectString); 
      // echo "Load Query done<br/>"; debugging
    }

catch (PDOException $e)
    {
        $error = 'Select statement error';
        include 'error.html.php';
        exit();
    }
?>
<!-- generate html table from MYSQL query  -->
<div class="flex-container">
    <div class="table-wrapper-scroll-y">
		<table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>	
                    <th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">sport</th><th scope="col">Country</th><th scope="col"></th>
                </tr>
            </thead>
                <tbody>
                    <?php
                    foreach ($MedalistSportCountry as $row) 
                    {
                        echo("
                            <tr>
                            <td>$row[first]</td>
                            <td>$row[last]</td>
                            <td>$row[sport]</td>
                            <td>$row[country]<br/><img src='$row[flagImage]' alt='' class='rounded-top img-thumbnail' width='70' height='70'></td>
                            <td><img src='photos/$row[image]' alt='Image not found' class='rounded-top img-thumbnail' width='100' height='100'></td>
                            </tr>
                            ");
                    }
                    ?>
                    <td><a class="btn btn-danger" href="deleteAthlete.php?id=1" role="button" onclick="return  confirm('Are you sure you want to delete this/these Records')">Delete Records</a></td>
                </tbody>
        </table>
    </div> 
</div>
<div class="footer">
    <div class="flex-container">
        <input type='submit' class="btn btn-primary" name='back' value='Back to main page'>
</div>
</body>
<?php 
// Create session data for the deleteAthete.php file
$_SESSION["selectCountry"]=$selectCountry;
$_SESSION["selectName"]=$selectName;
$_SESSION["selectLast"]=$selectLast;
$_SESSION["selectSport"]=$selectSport;
?>