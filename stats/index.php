<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dbh.gas.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='includes/Chart.js'></script>
    
    <title>Stats Kawasaki</title>
</head>
<body style="background-color:#e2fcd4;">
<center>

<?php

#phpinfo();

echo "<h1>Statistics for Kawasaki</h1>";
#echo "<h2>Statistics for Kawasaki</h2>";
#echo "<h3>Statistics for Kawasaki</h3>";
#echo "<h4>Statistics for Kawasaki</h4>";

# GET STATS

# Kawasaki
$DB = "kawasaki";
$sql = "SELECT * FROM $DB;";
$mc_data = get_sql_data($conn, $sql);
$sql = "SELECT * FROM $DB WHERE sparepart = 1;";
$mc_spareparts = get_sql_data($conn, $sql);

# VARS
# money spent
$m1 = round(array_sum($mc_data['cost']) -177.64);
$m3 = array_sum($mc_spareparts['cost']);
$m2 = round($m1 - $m3);
# volume
$v1 = round(array_sum($mc_data['litre']) -7.71);
$v2 = (end($mc_data['mileage']) -9940) /10;
# -2 ???!!!
$v3 = count($mc_data['litre']) -1;
$bought = date_create('2022-04-23');
$datenow = date('Y-m-d H:i');
$v4 = date_diff($bought, new DateTime());
# average
$a1 = round((array_sum($mc_data['litre']) -7.71) / ($v2), 3);
$latest_driven = (end($mc_data['mileage']) - ($mc_data['mileage'][$v3])) / 10;
$a2 = round(end($mc_data['litre']) / $latest_driven, 3);
$a3 = round($m1 / ($v2), 3);
$a4 = round(end($mc_data['cost']) / $latest_driven, 3);

echo "<br><b>AVERAGE</b>";
echo "<br>Consumption: <b>".$a1."</b> liter/mil";
echo "<br>Latest: <b>".$a2."</b> liter/mil";
echo "<br>Cost: <b>".$a3."</b> kr/mil";
echo "<br>Latest: <b>".$a4."</b> kr/mil";
echo "<br>";
echo "<br><b>MONEY SPENT</b>";
echo "<br>Gas: <b>".$m2."</b> kr";
echo "<br>Spareparts: <b>".$m3."</b> kr";
echo "<br>Total: <b>".$m1."</b> kr";
echo "<br>";
echo "<br><b>VOLUME</b>";
echo "<br>Gas consumed: <b>".$v1."</b> liter";
echo "<br>Miles driven: <b>".$v2."</b> mil";
echo "<br>total refills: <b>".$v3."</b> times";
echo "<br>Time since first fill: <b>".$v4->format('%y years %a days')."</b>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
# ADD LATER?
# Gas price delta? graph?

# Print array
#pre_r($mc_data);


echo "<h1>Statistics for Bobber</h1>";

# Bobber
$DB = "mc_bobber";
$sql = "SELECT * FROM $DB;";
$mc_data = get_sql_data($conn, $sql);
$sql = "SELECT * FROM $DB WHERE sparepart = 1;";
# blocked until I got spareparts registered
#$mc_spareparts = get_sql_data($conn, $sql);

# VARS
# money spent
$m3 = round(array_sum($mc_data['cost']) -257.85);
#$m3 = array_sum($mc_spareparts['cost']);
# Avoid errors. No spareparts registered in database
$m2 = 1;
$m1 = round($m3 - $m2);
# volume
$v1 = round(array_sum($mc_data['litre']) -12.14);
$v2 = (end($mc_data['mileage']) -215738) /100;
$v3 = count($mc_data['litre']) -1;
$bought = date_create('2022-03-18');
$datenow = date('Y-m-d H:i');
$v4 = date_diff($bought, new DateTime());
# average
$a1 = round((array_sum($mc_data['litre']) -12.14) / ($v2), 3);
# is this correct?? Yes but km is wrong, pls divide with 100 (Compansate for 100 meters gauge?)
$latest_driven = (end($mc_data['mileage']) - ($mc_data['mileage'][$v3 -1])) / 100;
$a2 = round(end($mc_data['litre']) / $latest_driven, 3);
$a3 = round($m1 / ($v2), 3);
$a4 = round(end($mc_data['cost']) / $latest_driven, 3);

echo "<br><b>AVERAGE</b>";
echo "<br>Consumption: <b>".$a1."</b> liter/mil";
echo "<br>Latest: <b>".$a2."</b> liter/mil";
echo "<br>Cost: <b>".$a3."</b> kr/mil";
echo "<br>Latest: <b>".$a4."</b> kr/mil";
echo "<br>";
echo "<br><b>MONEY SPENT</b>";
echo "<br>Gas: <b>".$m1."</b> kr";
echo "<br>Spareparts: <b>".$m2."</b> kr";
echo "<br>Total: <b>".$m3."</b> kr";
echo "<br>";
echo "<br><b>VOLUME</b>";
echo "<br>Gas consumed: <b>".$v1."</b> liter";
echo "<br>Miles driven: <b>".$v2."</b> mil";
echo "<br>total refills: <b>".$v3."</b> times";
echo "<br>Time since first fill: <b>".$v4->format('%y years %a days')."</b>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";




# Print array
#pre_r($mc_data);

# Functions

# Get data with specific sql and return non specific array, example: audi_gas[0]['value_id']. Easy to sum for statistis
function get_sql_data($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        # create an array that I can call with $row['time_stamp'] for example
        $row = mysqli_fetch_assoc($result);

        $data['value_id'][] = $row['value_id'];
        $data['time_stamp'][] = $row['time_stamp'];
        $data['refill_date'][] = $row['refill_date'];
        $data['mileage'][] = $row['mileage'];
        $data['cost'][] = $row['cost'];
        $data['sparepart'][] = $row['sparepart'];
        # in case of null:
        if ($row['litre'] > 0) {
            $data['litre'][] = $row['litre'];
        }
        if ($row['name'] > 0) {
            $data['name'][] = $row['name'];
        }
        if ($row['comment'] > 0) {
            $data['comment'][] = $row['comment'];
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $data['value_id'][] = $row['value_id'];
            $data['time_stamp'][] = $row['time_stamp'];
            $data['refill_date'][] = $row['refill_date'];
            $data['mileage'][] = $row['mileage'];
            $data['cost'][] = $row['cost'];
            $data['sparepart'][] = $row['sparepart'];

            if ($row['litre'] > 0) {
                $data['litre'][] = $row['litre'];
            }
            if ($row['name'] > 0) {
                $data['name'][] = $row['name'];
            }
            if ($row['comment'] > 0) {
                $data['comment'][] = $row['comment'];
            }
        }
        #echo "<br>Number of elements in time_stamp:" . count($time_stamp);
        return $data;
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
        $data = 0;
        return $data;
    }
}


// Nice way to print datasets/arrays
function pre_r($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}




?>

<br><br>

<br>



</center>


</body>
</html>