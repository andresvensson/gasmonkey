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

include_once 'dbh.gas.php';
echo '<pre>'; print_r($_POST); echo '</pre>';


if($conn === false){
    die("ERROR: Could not connect. " 
        . mysqli_connect_error());
}

$db = $_POST['database'];
$value_id = $_POST['value_id'];

$sql = "DELETE FROM $db WHERE value_id=$value_id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
    
$conn->close();



echo "<h1>Removed!</h1>";

$datenow = date('Y-m-d H:i');

echo $datenow."<br><br>";

?>



<br>
<form>
 <input type="button" onclick="window.location.href='../index.php';" value="Main Page!" />
 <input type="button" onclick="window.location.href='../db_entries.php';" value="Database entries" />
</form>

<br>






</center>


</body>
</html>