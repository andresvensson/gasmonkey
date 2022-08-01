<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'includes/gas_stats.php';

# 2021-11-07, When MC season starts I have to adjust timeline and add MC in graph. Adjust statistics as well..


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

        <?php

        #phpinfo();

        echo "<h1>Welcome to gas.andresvensson.se</h1>";

        $datenow = date('Y-m-d H:i');

        echo "<br>Time now: " . $datenow . "<br><br>";


        ?>


        <br><br>
        <h1>Click on vehicle to add a refill data</h1>


        <style>
            th {
                text-align: left;
            }
        </style>


        <table>
            <tr>
                <td>

                    <a href="audi.php">
                        <img src="images/signal-2021-10-09-140344.jpeg" alt="Audi A3" style="max-width:100%;height:auto;" />
                    </a>

                </td>
                <td>

                    <a href="mc_kawasaki.php">
                        <img src="images/kawa.png" alt="MC Kawasaki" style="max-width:100%;height:auto;" />
                    </a>

                </td>
            </tr>

            <tr>
                <th><br>Audi statistics:</th>
                <th><br>MC statistics:</th>
            </tr>

            <tr>
                <td>
                    <?php
                    # AUDI STATS

                    # total cost
                    echo "<br>Total cost: " . round(array_sum($audi_data['cost']) - 687.9) . " kr";
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
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . "</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </td>
                <td>
                    <?php

                    # MC STATS
                    # change below text and set DB = "mc_bobber" in /includes/gas_stats.php/
                    echo "No entries in DB yet. This will change when season starts.. <br>Audi entries displays for now..<br>";
                    # total cost
                    echo "<br>Total cost: " . round(array_sum($audi_data['cost']) - 687.9) . " kr";
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
                        echo "<tr><td>" . $val['refill_date'] . "</td><td>" . $val['name'] . "</td><td>" . $val['cost'] . "</td></tr>";
                    }
                    echo "</table>";

                    #echo "<br>MC stats goes here..";
                    ?></td>
            </tr>

        </table>
        <br>


        <?php


        # TimeLine (refill dates)
        # Remove first date
        $TL_dates = $audi_gas['refill_date'];
        array_shift($TL_dates);



        # loop Timeline (the refill dates) and get data
        foreach ($TL_dates as $key => $value) {
            if (isset($audi_gas['litre'][($key + 1)])) {
                $liters = $audi_gas['litre'][($key + 1)];
            }
            if (isset($audi_gas['mileage'][($key + 1)])) {
                $mileage = $audi_gas['mileage'][($key + 1)];

                if (array_key_exists($key, $audi_gas['mileage'])) {
                    $mile_adjuster = $audi_gas['mileage'][$key];
                } else {
                    $mile_adjuster = 254575;
                }

                $driven = $mileage - $mile_adjuster;
                # avoid division by 0
                if ($driven > 0) {
                    $l_m = $liters / ($driven / 10);
                    $liter_mile[] = $l_m;
                }
            }
        }



        $label_time_stamp = json_encode($TL_dates);
        $label_liter_mil = json_encode($liter_mile);

        ?>




        <div class="chart-container" style="margin: auto; position: relative; height:80vh; width:80vw">
            <canvas id="gasChart"></canvas>
        </div>

        <script>
            var ctx = document.getElementById('gasChart').getContext('2d');

            var labels = <?php echo $label_time_stamp; ?>

            var ds_audi = <?php echo $label_liter_mil; ?>

            var tempChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Audi',
                        data: ds_audi,
                        spanGaps: true,
                        fill: false,
                        borderColor: '#0000FF',
                        backgroundColor: '#0000FF',
                        borderWidth: 1
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Timeline for fuel consumption"
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: 10
                    }
                }
            });
        </script>



        <br>
        <form>
            <input type="button" onclick="window.location.href='db_entries.php';" value="Database entries" />
        </form>

    </center>

</body>

</html>
