<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'includes/gas_stats.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="styles.css">
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
                        <img src="images/signal-2021-10-09-140344.jpeg" alt="Audi A3" style="width:600px;height:375px;" />
                    </a>

                </td>
                <td>

                    <a href="mc_bobber.php">
                        <img src="images/signal-2021-10-09-140539.jpeg" alt="MC Bobber" style="width:600px;height:375px;" />
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
                    echo "<br>Total cost: " . round(array_sum($audi_data[0]['cost']) - 687.9) . " kr";
                    # total cost spareparts....
                    echo "<br>Total cost for spareparts: " . round(array_sum($audi_spareparts[0]['cost'])) . " kr";
                    # total cost for gas (presented in price/mil)
                    $tot_mileage = (end($audi_data[0]['mileage']) - 254575);
                    echo "<br>Total cost for gas: " . round((array_sum($audi_gas[0]['cost']) - 687.9) / $tot_mileage * 10) . " kr/mil";
                    # Kilometers since vehicle purchase
                    echo "<br>Total distance: " . $tot_mileage . " km";
                    # Gas quantity
                    echo "<br>Total gas quantity: " . round((array_sum($audi_gas[0]['litre']) - 41.59)) . " litre";
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
                    echo "<br>Total cost: " . round(array_sum($audi_data[0]['cost']) - 687.9) . " kr";
                    # total cost spareparts....
                    echo "<br>Total cost for spareparts: " . round(array_sum($audi_spareparts[0]['cost'])) . " kr";
                    # total cost for gas (presented in price/mil)
                    $tot_mileage = (end($audi_data[0]['mileage']) - 254575);
                    echo "<br>Total cost for gas: " . round((array_sum($audi_gas[0]['cost']) - 687.9) / $tot_mileage * 10) . " kr/mil";
                    # Kilometers since vehicle purchase
                    echo "<br>Total distance: " . $tot_mileage . " km";
                    # Gas quantity
                    echo "<br>Total gas quantity: " . round((array_sum($audi_gas[0]['litre']) - 41.59)) . " litre";
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


        <?php

        # PRINT SQL DATA?
        #echo "<br><br><br>audi_data";
        #pre_r($audi_data);
        #pre_r($audi_entries);


        # DATA FOR CHART
        # - chart is on hold. Too hard to calculate data and MC database has no entries (bound for errors..)

        # TimeLine (refill dates)
        $TL_dates = $audi_data[0]['refill_date'];
        $label_time_stamp = json_encode($TL_dates);
        #echo "TIMELINE?:".$label_time_stamp;

        # Data set (liter/mil)
        # Not finnished..
        #foreach($TL_dates as $x)
        #$tot_mileage = (end($audi_data[0]['mileage']) - 254575);
        #echo "<br>Total cost for gas: ".round((array_sum($audi_gas[0]['cost']) - 687.9) / $tot_mileage * 10)." kr/mil";

        #$ds_audi = json_encode($audi_data[0]['refill_date']);

        ?>

        <!--


<div class="chart-container" style="margin: auto; position: relative; height:80vh; width:80vw">
    <canvas id="gasChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('gasChart').getContext('2d');

    var labels = <?php echo $label_time_stamp; ?>

    var ds_audi = <?php echo $ds_audi; ?>

    var ds_temp_datarum = <?php echo $ds_temp_datarum; ?>

    var ds_temp_sovrum = <?php echo $ds_temp_sovrum; ?>

    var ds_temp_kitchen = <?php echo $ds_temp_kitchen; ?>

    var graph_title_count = <?php echo $graph_title_count ?>

    var tempChart = new Chart(ctx, {
        type:'line',
        data:{
            labels: labels,
            datasets:[{
                label:'Outside_Audi',
                data: ds_audi,
                spanGaps: true,
                fill: false,
                borderColor: '#0000FF',
                backgroundColor:'#0000FF',
                borderWidth: 1
            },
            {
                label:'Datarum',
                data: ds_temp_datarum,
                spanGaps: true,
                fill: false,
                borderColor: '#FF0000',
                backgroundColor:'#FF0000',
                borderWidth: 1
            },
            {
                label:'Sovrum',
                data: ds_temp_sovrum,
                spanGaps: true,
                fill: false,
                borderColor: '#00FF00',
                backgroundColor:'#00FF00',
                borderWidth: 1
            },
            {
                label:'Kitchen',
                data: ds_temp_kitchen,
                spanGaps: true,
                fill: false,
                borderColor: '#ffff00',
                backgroundColor:'#ffff00',
                borderWidth: 1
            }]
        },
        options:{
            title:{
                display: true,
                text: "Timeline of 4 x " + graph_title_count + " temperatures (24h)"
            },
            responsive:true,
            maintainAspectRatio: false,
            layout: {
                padding: 10
            }
        }
    });
</script>

-->


        <br>
        <form>
            <input type="button" onclick="window.location.href='db_entries.php';" value="Database entries" />
        </form>

    </center>

</body>

</html>