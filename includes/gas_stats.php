<?php include 'dbh.gas.php';


# This file provide stats for main index page.

# tables:
# mc_bobber
# audi
# test_audi

# "data" = for statistics, "entries" = for time series


## AUDI STATS ##
$DB = "audi";

$sql = "SELECT * FROM $DB;";
$audi_data = get_sql_data($conn, $sql);
#echo "audi_data:<br>";
#pre_r($audi_data);

# list
$audi_entries = array();
$audi_entries = getdata_entries($conn, $sql, $audi_entries);
#pre_r($audi_entries);

# Audi spareparts
$sql = "SELECT * FROM $DB WHERE sparepart = 1";
$audi_spareparts = get_sql_data($conn, $sql);

# list
$audi_sparepart_entries = array();
$audi_sparepart_entries = getdata_entries($conn, $sql, $audi_entries);
#pre_r($audi_sparepart_entries);

# Audi EXCEPT spareparts
$sql = "SELECT * FROM $DB WHERE sparepart = 0";
$audi_gas = get_sql_data($conn, $sql);



## KAWASAKI STATS ##
$DB = "kawasaki";

$sql = "SELECT * FROM $DB;";
$kawasaki_data = get_sql_data($conn, $sql);

# list
$kawasaki_entries = array();
$kawasaki_entries = getdata_entries($conn, $sql, $kawasaki_entries);
#pre_r($audi_entries);

# Kawasaki spareparts
$sql = "SELECT * FROM $DB WHERE sparepart = 1";
$kawasaki_spareparts = get_sql_data($conn, $sql);

# list
$kawasaki_sparepart_entries = array();
$kawasaki_sparepart_entries = getdata_entries($conn, $sql, $kawasaki_entries);
#pre_r($audi_sparepart_entries);

# Kawasaki EXCEPT SPAREPARTS
$sql = "SELECT * FROM $DB WHERE sparepart = 0";
$kawasaki_gas = get_sql_data($conn, $sql);



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





# Get data with date headline. Every entry has the date and then data for that date. Good for charts and list.
function getdata_entries($conn, $sql, $data)
{
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_data = [];
        $db_entry = $row['refill_date'];
        $new_data[$db_entry] = array(
            // "time_stamp" => date("Y-m-d H:i", strtotime($row['time_stamp'])),
            "value_id" => $row['value_id'],
            "refill_date" => $row['refill_date'],
            "mileage" => $row['mileage'],
            "cost" => $row['cost'],
            "sparepart" => $row['sparepart'],
            "litre" => $row['litre'],
            "name" => $row['name'],
            "comment" => $row['comment']
        );
        while ($row = mysqli_fetch_assoc($result)) {
            $db_entry = $row['refill_date'];
            $new_data[$db_entry] = array(
                // "time_stamp" => date("Y-m-d H:i", strtotime($row['time_stamp'])),
                "value_id" => $row['value_id'],
                "refill_date" => $row['refill_date'],
                "mileage" => $row['mileage'],
                "cost" => $row['cost'],
                "sparepart" => $row['sparepart'],
                "litre" => $row['litre'],
                "name" => $row['name'],
                "comment" => $row['comment']
            );
        }
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
    }
    return $new_data;
}




// Nice way to print datasets/arrays
function pre_r($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
