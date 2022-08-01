<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src='includes/Chart.js'></script>
    
    <title>Gas Database</title>
</head>
<body style="background-color:#e2fcd4;">
<center>

<?php

#phpinfo();
// include pages
include_once 'includes/dbh.gas.php';

echo "<h1>Recent entries in database</h1>";

$datenow = date('Y-m-d H:i');

echo "<br>Time now: ".$datenow."<br><br>";

?>




<form>
 <input type="button" onclick="window.location.href='index.php';" value="Main Page!" />
 <input type="button" onclick="window.location.href='audi.php';" value="Audi refill" />
 <input type="button" onclick="window.location.href='mc_bobber.php';" value="MC refill" />
</form>

<br>
<br>

<?php
//PHP code..

// This is it!!! TODO: change DB and add a delete button and remove below tables
echo "<br><br>Stored data for Audi:" . "<br>";
echo "<table border='1'><tr>
    <th>Id</th><th>Time stamp</th><th>Refill date</th>
    <th>Mileage</th><th>Cost</th><th>Litre</th><th>Spare part</th>
    <th>Name</th><th>Comment</th><th>Action</th>";

    $sql = "SELECT * FROM audi;";
    $result = mysqli_query($conn, $sql);
    #$resultCheck = mysqli_num_rows($result);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<form action='includes/db.delete.php' method='post'>";
            echo "<tr><input type='hidden' name='value_id' value='" . $row['value_id'] . "'/>" . 
            "<input type='hidden' name='database' value='test_audi'/>";
            echo "<td>{$row['value_id']}</td><td>" . $row['time_stamp'] . "</td><td>" . $row['refill_date']
            . "</td><td>" . $row['mileage'] . "</td><td>" . $row['cost'] . "</td><td>" . $row['litre']
            . "</td><td>" . $row['sparepart'] . "</td><td>" . $row['name'] . "</td><td>" . $row['comment']
            . "</td><td>" . "<input type='submit' value='Delete'></td>";
            echo "</tr></form>";
        }
    }
    echo "</table>";



    echo "<br><br>Stored data for Kawasaki:" . "<br>";
    echo "<table border='1'><tr>
        <th>Id</th><th>Time stamp</th><th>Refill date</th>
        <th>Mileage</th><th>Cost</th><th>Litre</th><th>Spare part</th>
        <th>Name</th><th>Comment</th><th>Action</th>";
    
        $sql = "SELECT * FROM kawasaki;";
        $result = mysqli_query($conn, $sql);
        #$resultCheck = mysqli_num_rows($result);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form action='includes/db.delete.php' method='post'>";
                echo "<tr><input type='hidden' name='value_id' value='" . $row['value_id'] . "'/>" . 
                "<input type='hidden' name='database' value='test_audi'/>";
                echo "<td>{$row['value_id']}</td><td>" . $row['time_stamp'] . "</td><td>" . $row['refill_date']
                . "</td><td>" . $row['mileage'] . "</td><td>" . $row['cost'] . "</td><td>" . $row['litre']
                . "</td><td>" . $row['sparepart'] . "</td><td>" . $row['name'] . "</td><td>" . $row['comment']
                . "</td><td>" . "<input type='submit' value='Delete'></td>";
                echo "</tr></form>";
            }
        }
        echo "</table>";
    
    


echo "<br><br>Stored data for Bobber:" . "<br>";
echo "<table border='1'><tr>
    <th>Id</th><th>Time stamp</th><th>Refill date</th>
    <th>Mileage</th><th>Cost</th><th>Litre</th><th>Spare part</th>
    <th>Name</th><th>Comment</th><th>Action</th>";

    $sql = "SELECT * FROM mc_bobber;";
    $result = mysqli_query($conn, $sql);
    #$resultCheck = mysqli_num_rows($result);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<form action='includes/db.delete.php' method='post'>";
            echo "<tr><input type='hidden' name='value_id' value='" . $row['value_id'] . "'/>" . 
            "<input type='hidden' name='database' value='test_audi'/>";
            echo "<td>{$row['value_id']}</td><td>" . $row['time_stamp'] . "</td><td>" . $row['refill_date']
            . "</td><td>" . $row['mileage'] . "</td><td>" . $row['cost'] . "</td><td>" . $row['litre']
            . "</td><td>" . $row['sparepart'] . "</td><td>" . $row['name'] . "</td><td>" . $row['comment']
            . "</td><td>" . "<input type='submit' value='Delete'></td>";
            echo "</tr></form>";
        }
    }
    echo "</table>";



    echo "<br><br>Stored data for Test database:" . "<br>";
    echo "<table border='1'><tr>
        <th>Id</th><th>Time stamp</th><th>Refill date</th>
        <th>Mileage</th><th>Cost</th><th>Litre</th><th>Spare part</th>
        <th>Name</th><th>Comment</th><th>Action</th>";
    
        $sql = "SELECT * FROM test_audi;";
        $result = mysqli_query($conn, $sql);
        #$resultCheck = mysqli_num_rows($result);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<form action='includes/db.delete.php' method='post'>";
                echo "<tr><input type='hidden' name='value_id' value='" . $row['value_id'] . "'/>" . 
                "<input type='hidden' name='database' value='test_audi'/>";
                echo "<td>{$row['value_id']}</td><td>" . $row['time_stamp'] . "</td><td>" . $row['refill_date']
                . "</td><td>" . $row['mileage'] . "</td><td>" . $row['cost'] . "</td><td>" . $row['litre']
                . "</td><td>" . $row['sparepart'] . "</td><td>" . $row['name'] . "</td><td>" . $row['comment']
                . "</td><td>" . "<input type='submit' value='Delete'></td>";
                echo "</tr></form>";
            }
        }
        echo "</table>";


// can remove this..
#echo "<br><br><br>Stored data (different present method):" . "<br>";
#echo "<table border='1'><tr><th>Id</th><th>Refill date</th><th>Litre</th><th>Mileage</th><th>Cost</th><th>Comment</th></tr>";

#    $sql = "SELECT * FROM ranger;";
#    $result = mysqli_query($conn, $sql);
#    $resultCheck = mysqli_num_rows($result);
    
#    if ($resultCheck > 0) {
#        while ($row = mysqli_fetch_assoc($result)) {
#            echo "<tr>";
#            foreach ($row as $field => $value) {
#                echo "<td>" . $value . "</td>";
#            }
#            echo "</tr>";
            #echo "<tr><td>$row['refill_date']</td> . <td>$row['litre']</td> . <td>$row['mileage']</td> . <td>$row['cost']</td><br>";
#        }
        #echo "</tr>";
#    }
#    echo "</table>";


?>



<br><br>
<img src="images/db.jpeg" alt="Database" style="width:600px;height:375px;"/>



</center>

</body>
</html>