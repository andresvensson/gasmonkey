<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src='includes/Chart.js'></script>
    
    <title>GAS</title>
</head>
<body style="background-color:#e2fcd4;">
<center>

<?php

include_once 'includes/dbh.gas.php';

#phpinfo();

echo "<h1>Thanks!</h1><br>";
echo "added values was:<br>";
echo '<pre>'; print_r($_POST); echo '</pre>';

        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }

        $db = $_POST['database'];
        #$refill_date = $_POST['refill_date'];
        $mileage = $_POST['mileage'];
        $cost = $_POST['cost'];
        $litre = $_POST['litre'];
        $sparepart = $_POST['sparepart'];
        $name = $_POST['name'];
        $comment = $_POST['comment'];


        $sql = "INSERT INTO $db (refill_date, mileage, cost, litre, sparepart, name, comment) VALUES ('{$_POST['refill_date']}','$mileage', 
            '$cost','$litre','$sparepart','$name','$comment')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully and you can now close this page."; 

        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);





?>

<br><br><br>

Go back?<br>
<form>
 <input type="button" onclick="window.location.href='index.php';" value="Main Page!" />
 <input type="button" onclick="window.location.href='db_entries.php';" value="Database entries" />
</form>

<br>

</center>


</body>
</html>