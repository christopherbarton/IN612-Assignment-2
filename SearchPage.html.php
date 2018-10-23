<!-- Form page that allows the user to select from dropdown data that is recorded in a MYSQL database-->
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
    <link rel='stylesheet' type='text/css' href='style.php'>
</head>
<body >

<?php
        $self = htmlentities($_SERVER['PHP_SELF']);
        echo "<form action = '$self' method='POST'> ";
        try
    {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $userMS, $passwordMS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');

       //echo "Connected<br/>"; // used for debugging
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
	<h2 class="text-center">Search Database</h2>
</div>
<?php
        //Query for dropdown selections
        $query = 'SELECT DISTINCT countryName AS Country
        FROM medalists,sport,country
            WHERE medalists.sportId=sport.sportId
            AND medalists.countryId=country.countryId
                ORDER BY countryName';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>

<!--Creates the dropdown so that the user can select a country from the database -->
<div class="form-group">
<label for="name">Select Country:</label>'
<select name="list1" class="form-control" class="selectpicker" id="name">
<option value='-1'>Please Select</option>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
echo '<option value="' . $row['Country'] .'">' . $row['Country'] .'</option>';
}
?>
</select>

<?php
//Query for dropdown selections
$query = 'SELECT DISTINCT medalists.firstName AS first
        FROM medalists,sport,country
            WHERE medalists.sportId=sport.sportId
            AND medalists.countryId=country.countryId
                ORDER BY medalists.firstName';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>
<!--Creates the dropdown so that the user can select a name from the database -->
<div class="form-group">
<label for="name">Select Name:</label>'
<select name="list2" class="form-control" class="selectpicker" id="name">
<option value='-1'>Please Select</option>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
echo '<option value="' . $row['first'] .'">' . $row['first'] .'</option>';
}
?>
</select>

<?php
//Query for dropdown selections
$query = 'SELECT DISTINCT medalists.lastName AS last
        FROM medalists,sport,country
            WHERE medalists.sportId=sport.sportId
            AND medalists.countryId=country.countryId
                ORDER BY medalists.lastName';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>
<!--Creates the dropdown so that the user can select a name from the database -->

<label for="last">Select Last Name:</label>
<select name="list3" class="form-control" class="selectpicker" id="last">
<option value='-1'>Please Select</option>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
echo '<option value="' . $row['last'] .'">' . $row['last'] .'</option>';
}
?>
</select>
<?php
//Query for dropdown selections
$query = 'SELECT DISTINCT sport.sportName as Sport
        FROM medalists,sport,country
            WHERE medalists.sportId=sport.sportId
            AND medalists.countryId=country.countryId
                ORDER BY sport.sportName
                ';
        $stmt  = $pdo->prepare($query);
        $stmt->execute();
?>
<!--Creates the dropdown so that the user can select a name from the database -->

<label for="Sport">Select Sport:</label>
<select name="list4" class="form-control" class="selectpicker" id="Sport">
<option value='-1'>Please Select</option>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
echo '<option value="' . $row['Sport'] .'">' . $row['Sport'] .'</option>';
}
?>
</select>

<div class="flex-container">
    <input type='submit' class="btn btn-warning" name='searchResult' value='search'>
</div>
<br>

<div class="footer">
    <div class="flex-container">
        <input type='submit' class="btn btn-primary" name='back' value='Back to main page'>
    </div>
</div>
</body>
