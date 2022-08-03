<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dbh.gas.php';


# Create this central php file
# to provide stats and variables
# to be used in main index (stats column) and
# dedicated statistics page (with graphs) at
# gas.andresvensson.se/stats


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='includes/Chart.js'></script>
    
    <title>Stats</title>
</head>
<body style="background-color:#e2fcd4;">
<center>




<?php

#echo "<h1>Statistics for Kawasaki</h1>";

# GET STATS


# KAWASAKI
$DB = "kawasaki";
$sql = "SELECT * FROM $DB;";
$vechicle_data = get_sql_data($conn, $sql);
$sql = "SELECT * FROM $DB WHERE sparepart = 1;";
$vechicle_spareparts = get_sql_data($conn, $sql);

# VARS
$kawasaki_stats = array();
# money spent
$kawasaki_stats['money_total'] = round(array_sum($vechicle_data['cost']) -177.64);
$kawasaki_stats['money_spareparts'] = array_sum($vechicle_spareparts['cost']);
$kawasaki_stats['money_gas'] = round($kawasaki_stats['money_total'] - $kawasaki_stats['money_spareparts']);
# volume
$kawasaki_stats['litre_consumed'] = round(array_sum($vechicle_data['litre']) -7.71);
$kawasaki_stats['miles_driven'] = (end($vechicle_data['mileage']) -9940) /10;
# -2 ???!!!
$kawasaki_stats['refill_total'] = count($vechicle_data['litre']) -1;
$kawasaki_stats['time_bought'] = date_create('2022-04-23');
$datenow = date('Y-m-d H:i');
$kawasaki_stats['time_firstfill'] = date_diff($kawasaki_stats['time_bought'], new DateTime());
# average
$kawasaki_stats['consumption'] = round((array_sum($vechicle_data['litre']) -7.71) / ($kawasaki_stats['miles_driven']), 3);
$kawasaki_stats['latest_driven'] = (end($vechicle_data['mileage']) - ($vechicle_data['mileage'][$kawasaki_stats['refill_total']])) / 10;
$kawasaki_stats['consumption_latest'] = round(end($vechicle_data['litre']) / $kawasaki_stats['latest_driven'], 3);
$kawasaki_stats['cost_mile'] = round($kawasaki_stats['money_total'] / ($kawasaki_stats['miles_driven']), 3);
$kawasaki_stats['cost_mile_latest'] = round(end($vechicle_data['cost']) / $kawasaki_stats['latest_driven'], 3);


/* echo "<br><b>AVERAGE</b>";
echo "<br>Consumption: <b>".$kawasaki_stats['consumption']."</b> liter/mil";
echo "<br>Latest: <b>".$kawasaki_stats['consumption_latest']."</b> liter/mil";
echo "<br>Cost: <b>".$kawasaki_stats['cost_mile']."</b> kr/mil";
echo "<br>Latest: <b>".$kawasaki_stats['cost_mile_latest']."</b> kr/mil";
echo "<br>";
echo "<br><b>MONEY SPENT</b>";
echo "<br>Gas: <b>".$kawasaki_stats['money_gas']."</b> kr";
echo "<br>Spareparts: <b>".$kawasaki_stats['money_spareparts']."</b> kr";
echo "<br>Total: <b>".$kawasaki_stats['money_total']."</b> kr";
echo "<br>";
echo "<br><b>VOLUME</b>";
echo "<br>Gas consumed: <b>".$kawasaki_stats['litre_consumed']."</b> liter";
echo "<br>Miles driven: <b>".$kawasaki_stats['miles_driven']."</b> mil";
echo "<br>total refills: <b>".$kawasaki_stats['refill_total']."</b> times";
echo "<br>Time since first fill: <b>".$kawasaki_stats['time_firstfill']->format('%y years %a days')."</b>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>"; */
# ADD LATER?
# Gas price delta? graph?



#echo "<h1>Statistics for Bobber</h1>";

# BOBBER
$DB = "mc_bobber";
$sql = "SELECT * FROM $DB;";
$vechicle_data = get_sql_data($conn, $sql);
$sql = "SELECT * FROM $DB WHERE sparepart = 1;";
# blocked until I got spareparts registered
#$vechicle_spareparts = get_sql_data($conn, $sql);

# VARS
$bobber_stats = array();
# money spent
$bobber_stats['money_total'] = round(array_sum($vechicle_data['cost']) -257.85);
#$bobber_stats['money_total'] = array_sum($vechicle_spareparts['cost']);
# Avoid errors. No spareparts registered in database
$bobber_stats['money_spareparts'] = 1;
$bobber_stats['money_gas'] = round($bobber_stats['money_total'] - $bobber_stats['money_spareparts']);
# volume
$bobber_stats['litre_consumed'] = round(array_sum($vechicle_data['litre']) -12.14);
$bobber_stats['miles_driven'] = (end($vechicle_data['mileage']) -215738) /100;
$bobber_stats['refill_total'] = count($vechicle_data['litre']) -1;
$bought = date_create('2022-03-18');
$datenow = date('Y-m-d H:i');
$bobber_stats['time_firstfill'] = date_diff($bought, new DateTime());
# average
$bobber_stats['consumption'] = round((array_sum($vechicle_data['litre']) -12.14) / ($bobber_stats['miles_driven']), 3);
# is this correct?? Yes but km is wrong, pls divide with 100 (Compansate for 100 meters gauge?)
$latest_driven = (end($vechicle_data['mileage']) - ($vechicle_data['mileage'][$bobber_stats['refill_total'] -1])) / 100;
$bobber_stats['consumption_latest'] = round(end($vechicle_data['litre']) / $latest_driven, 3);
$bobber_stats['cost_mile'] = round($bobber_stats['money_gas'] / ($bobber_stats['miles_driven']), 3);
$bobber_stats['cost_mile_latest'] = round(end($vechicle_data['cost']) / $latest_driven, 3);

/* #echo "<br><b>AVERAGE</b>";
echo "<br>Consumption: <b>".$bobber_stats['consumption']."</b> liter/mil";
echo "<br>Latest: <b>".$bobber_stats['consumption_latest']."</b> liter/mil";
echo "<br>Cost: <b>".$bobber_stats['cost_mile']."</b> kr/mil";
echo "<br>Latest: <b>".$bobber_stats['cost_mile_latest']."</b> kr/mil";
echo "<br>";
echo "<br><b>MONEY SPENT</b>";
echo "<br>Gas: <b>".$bobber_stats['money_gas']."</b> kr";
echo "<br>Spareparts: <b>".$bobber_stats['money_spareparts']."</b> kr";
echo "<br>Total: <b>".$bobber_stats['money_total']."</b> kr";
echo "<br>";
echo "<br><b>VOLUME</b>";
echo "<br>Gas consumed: <b>".$bobber_stats['litre_consumed']."</b> liter";
echo "<br>Miles driven: <b>".$bobber_stats['miles_driven']."</b> mil";
echo "<br>total refills: <b>".$bobber_stats['refill_total']."</b> times";
echo "<br>Time since first fill: <b>".$bobber_stats['time_firstfill']->format('%y years %a days')."</b>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>"; */




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