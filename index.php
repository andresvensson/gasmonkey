<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#include_once 'includes/gas_stats.php';
include_once 'stats/numbers.php';

# THIS IS NEW?

# 2021-11-07, When MC season starts I have to adjust timeline and add MC in graph. Adjust statistics as well..
# 2022-08-01, well vaccation happend..

# Ideas for statistics column
# Consumption, Totals, days since last fill
# remove spareparts separate table. Maybe add history 
#



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" href="/images/gas_icon.png">
    <script src='includes/Chart.js'></script>

    <title>GAS</title>
</head>

<body style="background-color:#e2fcd4;">
    <center>

        <br><br>
        <h1>Click on vehicle to add refill data</h1>


        <style>
            th {
                text-align: left;
            }
        </style>


        <hr>
        </hr>
        <table>
            <tr>
                <td>

                    <a href="audi.php">
                        <img src="images/signal-2021-10-09-140344.jpeg" alt="Audi A3" style="max-width:100%;height:auto;" />
                    </a>

                </td>
                <td>
                    <b>Audi A3 FSI -05:</b><br><br>

                    <?php
                    # AUDI STATS

                    echo "Consumption: <b>".$audi_stats['consumption']."</b> liter/mil<br>";
                    echo "Latest: <b>".$audi_stats['consumption_latest']."</b> liter/mil<br>";
                    echo "<br><u>Total</u><br>";
                    echo $audi_stats['refill_total']." refills<br>";
                    echo $audi_stats['litre_consumed']." liter<br>";
                    echo $audi_stats['miles_driven']." mil distance<br>";
                    echo $audi_stats['money_total']." kr, gas + parts<br>";
                    echo $audi_stats['time_firstfill']->format('%y years %a days')." since first fill</b>";


                    # Spare parts - table (used it with gas_stats.php)
                    /* echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($audi_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>"; */
                    ?>
                </td>
            </tr>
        </table>

        <hr></hr>

        <table>
            <tr>
                <td>

                    <a href="mc_atas.php">
                        <img src="images/ATAS.png" alt="Africa Twin" style="max-width:100%;height:auto;" />
                    </a>

                </td>
                <td>
                    <b>Africa Twin Adventure Sports -20:</b><br><br>

                    <?php
                    # ATAS STATS

                    echo "Consumption: <b>".$atas_stats['consumption']."</b> liter/mil<br>";
                    echo "Latest: <b>".$atas_stats['consumption_latest']."</b> liter/mil<br>";
                    echo "<br><u>Total</u><br>";
                    echo $atas_stats['refill_total']." refills<br>";
                    echo $atas_stats['litre_consumed']." liter<br>";
                    echo $atas_stats['miles_driven']." mil distance<br>";
                    echo $atas_stats['money_total']." kr, gas + parts<br>";
                    echo $atas_stats['time_firstfill']->format('%y years %a days')." since first fill</b>";


                    # Spare parts - table
                    /* echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($kawasaki_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>"; */
                    ?>
                </td>
            </tr>
        </table>

        <hr></hr>

        <table>
            <tr>
                <td>

                    <a href="mc_kawasaki.php">
                        <img src="images/kawa.png" alt="MC Kawasaki" style="max-width:100%;height:auto;" />
                    </a>

                </td>
                <td>
                    <b>Kawasaki ER-6f -09:</b><br><br>

                    <?php
                    # KAWASAKI STATS

                    echo "Consumption: <b>".$kawasaki_stats['consumption']."</b> liter/mil<br>";
                    echo "Latest: <b>".$kawasaki_stats['consumption_latest']."</b> liter/mil<br>";
                    echo "<br><u>Total</u><br>";
                    echo $kawasaki_stats['refill_total']." refills<br>";
                    echo $kawasaki_stats['litre_consumed']." liter<br>";
                    echo $kawasaki_stats['miles_driven']." mil distance<br>";
                    echo $kawasaki_stats['money_total']." kr, gas + parts<br>";
                    echo $kawasaki_stats['time_firstfill']->format('%y years %a days')." since first fill</b>";


                    # Spare parts - table
                    /* echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($kawasaki_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>"; */
                    ?>
                </td>
            </tr>
        </table>

        <hr></hr>

        <table>
            <tr>
                <td>

                    <a href="mc_bobber.php">
                        <img src="images/signal-2021-10-09-140539.jpeg" alt="MC Bobber" style="max-width:100%;height:auto;" />
                    </a>

                </td>
                <td>
                    <b>Yamaha XV750 Special -82:</b><br>

                    <?php
                    # BOBBER STATS

                    echo "Consumption: <b>".$bobber_stats['consumption']."</b> liter/mil<br>";
                    echo "Latest: <b>".$bobber_stats['consumption_latest']."</b> liter/mil<br>";
                    echo "<br><u>Total</u><br>";
                    echo $bobber_stats['refill_total']." refills<br>";
                    echo $bobber_stats['litre_consumed']." liter<br>";
                    echo $bobber_stats['miles_driven']." mil distance<br>";
                    echo $bobber_stats['money_total']." kr, gas + parts<br>";
                    echo $bobber_stats['time_firstfill']->format('%y years %a days')." since first fill</b>";

                    # Spare parts - table
                    /* echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($audi_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>"; */
                    ?>
                </td>
            </tr>
        </table>

        <hr></hr>





        



        <br>
        <form>
            <input type="button" onclick="window.location.href='db_entries.php';" value="Database entries" />
            <input type="button" onclick="window.location.href='stats/';" value="Statistics" />
        </form>
        <br>

    </center>

</body>

</html>
