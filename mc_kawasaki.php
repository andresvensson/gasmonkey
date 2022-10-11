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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='includes/Chart.js'></script>
    
    <title>MC add stats</title>
</head>
<body style="background-color:#e2fcd4;">
<center>

<?php

#phpinfo();

echo "<h1>Add stats to Kawasaki!</h1>";

$datenow = date('Y-m-d H:i');

echo "<br>Time now: ".$datenow."<br><br>";

?>


<br><br>
<h1>Fill in and submit the form</h1>

<form action="submit.php" method="post">
    <input type="hidden" name="database" value="kawasaki"/>
    <label for="refill_date">Date: <input type="date" name="refill_date" value="<?php echo date('Y-m-d'); ?>"></label>
    <br><br>
    <label for="mileage">Mileage: <input type="number" name="mileage" min="20000" max="30000" step="1"></label>
    <br><br>
    <label for="cost">Cost: <input type="number" name="cost" min="1" max="50000" step="any"></label>
    <br><br>
    <label for="litre">Litre: <input type="number" name="litre" min="0" max="30" step="any"></label>
    <br><br>
    Spare part?   <label for="no">No<input type="radio" name="sparepart" value="0" checked="checked">
    <label for="yes">Yes<input type="radio" name="sparepart" value="1">
    <br><br>
    <label for="name">Name: <input type="text" name="name"></label>
    <br><br>
    <label for="comment">Comment: <input type="text" name="comment"></label>
    <br><br>
    <input type="submit">
    <br><br>
</form>


<br>
<form>
 <input type="button" onclick="window.location.href='index.php';" value="Main Page!" />
 <input type="button" onclick="window.location.href='db_entries.php';" value="Database entries" />
</form>

<br>


<br>
<img src="images/kawa.png" alt="Kawasaki" style="max-width:80%;height:auto;"/>




</center>


</body>
</html>