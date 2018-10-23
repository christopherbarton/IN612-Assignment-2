<!-- Form for user to be able to add an Athlete to a database  -->
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
	    <h2 class="text-center">Add country</h2>
    </div>

<fieldset>
<!--Country name text box -->
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="CountryName">Country Name</span>
  </div>
  <input type="text" class="form-control" id="countryName" name="CountryName"  required>

  <br>
  <!--Population text box -->
  <div class="input-group-prepend">
    <span class="input-group-text" id="Population">Population</span>
  </div>
  <input type="number" class="form-control" id="population" name="Population"  required>

  <br>  
  <!--Image file selector -->  
  <div class="input-group-prepend">
    <span class="input-group-text" id="imageName">Image Name( Place image in flags)</span>
  </div>
    <input type="file" class="form-control" id="imageName" name="ImageName"  required>
  </div>

  <br>
  <!--Submit Button -->
  <div class="flex-container">
  <input type='submit' class="btn btn-warning" name='submitCountry' value='Submit Country' required>
</div>
<br>
</fieldset>
<!--Footer button to navigat to main page -->
<div class="footer">
    <div class="flex-container">
        <input type='submit' class="btn btn-primary" name='back' value='Back to main page'>
    </div>
</div>
</body>