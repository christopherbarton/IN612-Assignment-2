<?php

include 'connect.inc.php'; // Log into Maria database
if (isset($_POST['addAthlete']))
    {
        include 'addAthlete.html.php';
       // echo "<pre>"; print_r($_POST) ;  echo "</pre>";
    } 
elseif (isset($_POST['addCountry']))
    {
        include 'addCountry.html.php';
       // echo "<pre>"; print_r($_POST) ;  echo "</pre>";
    }    
elseif (isset($_POST['search']))
    {
        include 'createAthletes.php'; // create database if it does not exist
        include 'searchPage.html.php';
         //  echo "<pre>"; print_r($_POST) ;  echo "</pre>";

    }  
elseif (isset($_POST['searchResult']))
    {
        include 'outputSearch.html.php';
       // echo "<pre>"; print_r($_POST) ;  echo "hello </pre>";
    }  
elseif (isset($_POST['submitCountry']))
    {
        include 'outputAddCountry.html.php';
     //  echo "<pre>"; print_r($_POST) ;  echo "</pre>";
    }     
elseif (isset($_POST['submitAthlete']))
    {
        include 'outputAddAthlete.html.php';
     //  echo "<pre>"; print_r($_POST) ;  echo "</pre>";
    }         

    //hasnt yet been submitted, display the form
else
    {
        include 'createAthletes.php'; // create database if it does not exist
        include 'mainPage.html.php';
        //  echo "<pre>"; print_r($_POST) ;  echo "</pre>";

    }
      //echo "<pre>"; print_r($_POST) ;  echo "</pre>";
?>        
	