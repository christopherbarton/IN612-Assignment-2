<?php
include 'connect.inc.php'; 

try
    {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $userMS, $passwordMS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');

       //echo "Connected<br/>";
    }

catch (PDOException $e)
    {
        $error = 'Connection to database failed';
        include 'error.html.php';
        exit();
    }

    try
    {   
        session_start();
    // Setup variables from _POST
    $addFirstName=$_SESSION["addFirstName"];
    $addLastName=$_SESSION["addLastName"];
    $addGender=$_SESSION["addGender"];
    $addImage=$_SESSION["addImage"];
    $addSport=$_SESSION["addSport"]; // Name of the sport
    $addCountry=$_SESSION["addCountry"]; // Name of the country

    //Setup other variables 
    $addSportId=0;
    $addCountryId=0;

    // Get sportID from database using SportName and asign to addSportId variable
    $addSportQuery= "SELECT sportId FROM sport WHERE sportName = \"$addSport\" ";
    $stmt  = $pdo->prepare($addSportQuery);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $addSportId=$row['sportId'];
    // echo $addSportId . "<br>"; // debugging

     // Get countryId from database using the CountryName and asign to addcCountryId variable
    $addCountryQuery= "SELECT countryId FROM country WHERE countryName = \"$addCountry\" ";
    $stmt  = $pdo->prepare($addCountryQuery);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $addCountryId=$row['countryId'];
    // echo $addCountryId. "<br>"; //Debugging
    // echo "image : " .$addImage. "<br>"; //Debugging
    // echo $addGender. "<br>"; //Debugging

    // Generate and execute a PDO query using the above variables
    $insertQuery = "INSERT into medalists(firstName,lastName,gender,image,sportId,countryID) VALUES(:firstName,:lastName,:gender,:image,:sportId,:countryID)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':firstName',$addFirstName);
    $stmt->bindParam(':lastName',$addLastName);
    $stmt->bindParam(':gender',$addGender);
    $stmt->bindParam(':image',$addImage);
    $stmt->bindParam(':sportId',$addSportId);
    $stmt->bindParam(':countryID',$addCountryId);
    $stmt->execute();
    }

    
catch (PDOException $e)
    {
        $error='Inserting new athlete into table failed';
        include 'error.html.php';
        exit();
    }
  
?>