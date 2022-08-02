<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'includes/gas_stats.php';

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
                    <b>Audi statistics:</b><br>

                    <?php
                    # AUDI STATS

                    # total cost
                    echo "Total cost: " . round(array_sum($audi_data['cost']) - 687.9) . " kr";
                    # total cost spareparts....
                    echo "<br>Total cost for spareparts: " . round(array_sum($audi_spareparts['cost'])) . " kr";
                    # total cost for gas (presented in price/mil)
                    $tot_mileage = (end($audi_data['mileage']) - 254575);
                    echo "<br>Total cost for gas: " . round((array_sum($audi_gas['cost']) - 687.9) / $tot_mileage * 10) . " kr/mil";
                    # Kilometers since vehicle purchase
                    echo "<br>Total distance: " . $tot_mileage . " km";
                    # Gas quantity
                    echo "<br>Total gas quantity: " . round((array_sum($audi_gas['litre']) - 41.59)) . " litre";
                    # Spare parts - table
                    echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($audi_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>";
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
                    <b>Kawasaki Statistics:</b><br>

                    <?php
                    # KAWASAKI STATS

                    # total cost
                    echo "Total cost: " . round(array_sum($kawasaki_data['cost']) - 177.64) . " kr";
                    # total cost spareparts....
                    echo "<br>Total cost for spareparts: " . round(array_sum($kawasaki_spareparts['cost'])) . " kr";
                    # total cost for gas (presented in price/mil)
                    $tot_mileage = (end($kawasaki_data['mileage']) - 9940);
                    echo "<br>Total cost for gas: " . round((array_sum($kawasaki_gas['cost']) - 177.64) / $tot_mileage * 10) . " kr/mil";
                    # Kilometers since vehicle purchase
                    echo "<br>Total distance: " . $tot_mileage . " km";
                    # Gas quantity
                    echo "<br>Total gas quantity: " . round((array_sum($kawasaki_gas['litre']) - 7.71)) . " litre";
                    # Spare parts - table
                    echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($kawasaki_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>";
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
                    <b>Bobber Statistics:</b><br>

                    <?php
                    # AUDI STATS

                    # total cost
                    echo "Total cost: " . round(array_sum($audi_data['cost']) - 687.9) . " kr";
                    # total cost spareparts....
                    echo "<br>Total cost for spareparts: " . round(array_sum($audi_spareparts['cost'])) . " kr";
                    # total cost for gas (presented in price/mil)
                    $tot_mileage = (end($audi_data['mileage']) - 254575);
                    echo "<br>Total cost for gas: " . round((array_sum($audi_gas['cost']) - 687.9) / $tot_mileage * 10) . " kr/mil";
                    # Kilometers since vehicle purchase
                    echo "<br>Total distance: " . $tot_mileage . " km";
                    # Gas quantity
                    echo "<br>Total gas quantity: " . round((array_sum($audi_gas['litre']) - 41.59)) . " litre";
                    # Spare parts - table
                    echo "<br><br><table><tr><th>Latest Spare Parts</th></tr><tr><th>Date</th><th>Name</th><th>Cost</th></tr>";
                    foreach ($audi_sparepart_entries as $val) {
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . " kr</td></tr>";
                    }
                    echo "</table>";
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
