<!-- This file accepts _POST data and then uses that data to delete a record from a MYSQL database-->
<?php
include 'connect.inc.php'; 
session_start();

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
    //generate varibles for use in the MYSQL query
    try
    {  
        $selectCountry=$_SESSION["selectCountry"];
        $selectName=$_SESSION["selectName"];
        $selectLast=$_SESSION["selectLast"];
        $selectSport=$_SESSION["selectSport"];

        $selectString ="DELETE medalists.*
                             FROM 
                                medalists
                                JOIN sport ON sport.sportId=medalists.sportId
                                JOIN  country ON country.countryId=medalists.countryId
                                        " . "$selectCountry"
                                        . "$selectName" 
                                        . "$selectLast" 
                                        . "$selectSport";

    $DeleteAthlete = $pdo->query($selectString); 
    
    // Alert that infomrs on how many rows were effected by the delete, does not work on 
    exec($selectString);
            $count = $DeleteAthlete->rowCount();
            $_SESSION["count"]=$count;
    phpAlert(   "Delete successfull. Number of rows effected " .$count  ); 
    
    }
    catch (PDOException $e)
    {
        $error='Delete failed';
        include 'error.html.php';
        exit();
    }
    // function for alert that informs on how many rows have been effected
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
         }

         header('Location: controller.php'); 
        
?>