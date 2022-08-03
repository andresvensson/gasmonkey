<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#include_once '../includes/dbh.gas.php';
# can include this when I rename vars/arrays
include_once '../stats/numbers.php';


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

#phpinfo();

echo "<h1>Statistics for Kawasaki</h1>";
echo "<br><b>AVERAGE</b>";
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
echo "<br>";
# ADD LATER?
# Gas price delta? graph?

# Print array
#pre_r($mc_data);


echo "<h1>Statistics for Bobber</h1>";

echo "<br><b>AVERAGE</b>";
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
echo "<br>";







?>

<br><br>

<br>



</center>


</body>
</html>