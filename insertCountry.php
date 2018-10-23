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
    $addCountryName=$_SESSION["addCountryName"];
    $addCountryPopulation=$_SESSION["addCountryPopulation"];
    $addCountryImage=$_SESSION["addCountryImage"];
    echo $addCountryImage;

    $insertQuery = "INSERT into country(countryName,population,flagImage) VALUES(:countryName,:population,:flagImage)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':countryName',$addCountryName);
    $stmt->bindParam(':population',$addCountryPopulation);
    $stmt->bindParam(':flagImage',$addCountryImage);
    $stmt->execute();
    }

    
catch (PDOException $e)
    {
        alert("Country has not been added");
        $error='Inserting into the table failed';
        include 'error.html.php';
        exit();

    }
  
?>