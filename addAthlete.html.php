<!doctype html>
<!-- form to add an athlet to a database-->
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
    <link rel='stylesheet' type='text/css' href='style.php'>
</head>
<body >
<!-- Create a PDO object  -->
<?php
        $self = htmlentities($_SERVER['PHP_SELF']);
        echo "<form action = '$self' method='POST'> ";
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
?>
<div class="flex-container">
	<img src="photos/rioOlympics.png" class="img-rounded" alt="">
	<div class="container">
	<h2 class="text-center">Add Athlete</h2>
</div>
<form class="was-validated">
<!--Generate country dataset   -->
<?php
    //Create query for dropdown selections
        $query = 'SELECT DISTINCT countryName AS Country
        FROM country
                ORDER BY countryName';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>
<!--Creates the dropdown so that the user can select a country from the database 
    also includes a button for the user to be able to add a country to the database-->
<div class="form-group">
    <label for="countryName">Country (select or add one):</label>'
    <select name="list1" class="form-control custom-select browser-default" class="selectpicker" id="countryName" required>
        <option value="">Please Select</option>
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
  echo '<option value="' . $row['Country'] .'">' . $row['Country'] .'</option>';
        }
        ?>
    </select>
    <br>
    <input type='submit' class="btn btn-info" name='addCountry' value='Add Country'>
</div>
<?php
    //Create Query for sport dropdown selections
        $query = 'SELECT DISTINCT sportName
        FROM sport
                ORDER BY sportName';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>
 <!--Dropdown for Sport select-->
<!--Creates the dropdown so that the user can select a sport from the database -->
<div class="form-group">
    <label for="sportName">Sport (select one):</label>'
    <select name="list2" class="form-control custom-select browser-default" class="selectpicker" id="sportName" required>
        <option value="">Please Select</option>
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
  echo '<option value="' . $row['sportName'] .'">' . $row['sportName'] .'</option>';
        }
        ?>
    </select>
</div>
<!--Container to hold the text fields-->
<div class="flex-container">  
    <div class="input-group-prepend">
    <!--First name Text box input-->
        <span class="input-group-text" id="firstName">First Name</span>
    </div>
 
    <input type="text" class="form-control" id="firstName" name="firstName" required>
      <div class="input-group-prepend">
      <!--Last name Text box input-->
        <span class="input-group-text" id="lastName">Last Name</span>
    </div>
    <input type="text" class="form-control" id="lastName" name="lastName" required>
</div>
 
<!--Gender Dropdown for the user to select-->
 <div class="form-group">
  <label for="gender">Gender (select one):</label>
    <select name="list3" class="form-control custom-select browser-default" id="gender" required>
      <option value="">Please Select</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
 </div>

<!--Container to hold the file -->
<div class="flex-container"> 
  <div class="input-group-prepend">
      <span class="input-group-text" id="image">Image URL</span>
  </div>
      <input type="file" class="form-control" id="image" name="image" required> <!-- type file to search for files -->
</div>
 <!--submit button to create an athlete, loads the outPutaddAthlete.php file -->
  <div class="flex-container">
  <input type='submit' class="btn btn-warning" name='submitAthlete' value='Submit Athlete'>
</div>

</form>

<div class="footer">
    <div class="flex-container">
        <input type='submit' class="btn btn-primary" name='back' value='Back to main page'>
    </div>
</div>
</body>
