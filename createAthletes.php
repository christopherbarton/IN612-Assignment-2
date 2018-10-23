<?php
//Establish connection to he network

try
    {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $userMS, $passwordMS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');

       //echo "Connected<br/>"; // Debugging
    }

catch (PDOException $e)
    {
        $error = 'Connection to database failed';
        include 'error.html.php';
        exit();
    }

try
    {   
       /* 
       * Creat medalist table if it does not extst
       * If it does this file will do nothing
       * 
       * Check if medalists table exists, does not check for other tables,
       * if they already exsist they will get dropped and recreated
       */
      
      if (tableExists($pdo,'medalists')==FALSE)
        {
                
        $dropQuery = "DROP TABLE IF EXISTS sport";
            $pdo->exec($dropQuery);

            $createQuery="CREATE TABLE sport
            (
                sportId INT(6) NOT NULL AUTO_INCREMENT,
                sportName      VARCHAR(50) NOT NULL,
                PRIMARY KEY(sportId)           
            )";

            $pdo->exec($createQuery);

        //echo "Create sport database done<br/>"; // Debugging

        // Create country table

        $dropQuery = "DROP TABLE IF EXISTS country";
            $pdo->exec($dropQuery);

            $createQuery="CREATE TABLE country
            (
                countryId       INT(6) NOT NULL AUTO_INCREMENT,
                countryName     VARCHAR(50) NOT NULL,
                population      INT(12) NOT NULL,
                flagImage       VARCHAR(50) NOT NULL,
                PRIMARY KEY(countryId)           
            )";

            $pdo->exec($createQuery);

        //echo "Create country database done<br/>"; // Debugging

        // create table it it does not exist
        $createQuery="CREATE TABLE medalists
        (
            medalistId INT(6)   NOT NULL AUTO_INCREMENT,
            firstName           VARCHAR(20) NOT NULL,
            lastName            VARCHAR(20) NOT NULL,
            gender              VARCHAR(20) NOT NULL,
            image               VARCHAR(50),
            sportId             INT(6) NOT NULL,
            countryID           INT(6) NOT NULL,
            FOREIGN KEY (sportId) REFERENCES sport(sportId),       
            FOREIGN KEY (countryId) REFERENCES country(countryId),
            
            PRIMARY KEY(medalistId)           
        )";
        $pdo->exec($createQuery);
        // echo "Create medalists database done<br/>"; // Debugging
    // Create event table
            inputData($pdo);      
            }
            else{
            // echo "No tables to create"; // used for debugging
            }
        }
    catch (PDOException $e)
        {
            $error='Creating the table failed';
            include 'error.html.php';
            exit();
        }

    //Reading csv file and INSERTing data into table
    function inputData($pdo)  {
    try
        {   
                // Insert sport data using prepared tables
            $insertQuery = "INSERT into sport(sportId,sportName) VALUES(:sportId,:sportName)";
            $stmt2 = $pdo->prepare($insertQuery);
            $stmt2->bindParam(':sportId',$sportId);
            $stmt2->bindParam(':sportName',$sportName);
            
            $file = fopen("sports.csv","r");
            while(! feof($file))
                {  
                $myArray= fgetcsv($file);
                $sportId= $myArray[0];
                $sportName= $myArray[1];
                $stmt2->execute();
                }
            fclose($file);

        //echo "Create country database done<br/>"; // Debugging

         // Insert country data using prepared tables
        $insertQuery = "INSERT into country(countryId,countryName,population,flagImage) VALUES(:countryId,:countryName,:population,:flagImage)";
        $stmt2 = $pdo->prepare($insertQuery);
        $stmt2->bindParam(':countryId',$countryId);
        $stmt2->bindParam(':countryName',$countryName);
        $stmt2->bindParam(':population',$population);
        $stmt2->bindParam(':flagImage',$flagImage);

        
        $file = fopen("countries.csv","r");
        while(! feof($file))
            {  
            $myArray = fgetcsv($file);
            $countryId = $myArray[0];
            $countryName = $myArray[1];
            $population = rand(0,10000000);
            $flagImage = "flags/"."$countryName".".png";
            $stmt2->execute();
            //echo '<pre>'; print_r($population); echo '</pre>'; // Debugging
            //echo '<pre>'; print_r($flagImage); echo '</pre>';// Debugging
            }
            
        fclose($file);

        //echo "Create country database done<br/>"; //Debugging

            //Insert medalist Data usig a prepared table
            $insertQuery = "INSERT into medalists(firstName,lastName,gender,image,sportID,countryID) VALUES(:firstName,:lastName,:gender,:image,:sportID,:countryID)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->bindParam(':firstName',$firstName);
            $stmt->bindParam(':lastName',$lastName);
            $stmt->bindParam(':gender',$gender);
            $stmt->bindParam(':image',$image);
            $stmt->bindParam(':sportID',$sportID);
            $stmt->bindParam(':countryID',$countryID);
    
            $file = fopen("medalists.csv","r");
            
            while(! feof($file))
                {  
                $myArray= fgetcsv($file);
                $firstName=$myArray[0];
                $lastName= $myArray[1];
                $gender= $myArray[2];
                $image= $myArray[3].".jpg";
                $sportID=$myArray[5];
                $countryID=$myArray[4];
                $stmt->execute();
                //echo '<pre>'; print_r($myArray); echo '</pre>'; // Debugging
                //echo $countryID;
                }
            fclose($file);

            echo "Create medalists database done<br/>";
        }
    catch (PDOException $e)
        {
            $error='Creating the table failed';
            include 'error.html.php';
            exit();

        }
}

    /**
 * Check if a table exists in the current database.
 *
 * @param PDO $pdo PDO instance connected to a database.
 * @param string $table Table to search for.
 * @return bool TRUE if table exists, FALSE if no table found.
 */
function tableExists($pdo,$table)  {

    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
}
