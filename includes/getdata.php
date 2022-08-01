<?php include 'dbh.weather.php';



function getdata_new($conn_read, $sql, $data_name, $data) {
    $result = mysqli_query($conn_read, $sql);
    $resultCheck = mysqli_num_rows($result);
    $data_name = $data_name;
    if ($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $timeStamp = date("Y-m-d H:i", strtotime($row['time_stamp']));
            $new_data[$timeStamp] = array(
                // "time_stamp" => date("Y-m-d H:i", strtotime($row['time_stamp'])),
                "temperature" => $row['temperature'],
                "humidity" => $row['humidity']
            );
        }
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
    }
    return $new_data;
}



function getdata($conn_read, $sql, $data_name, $data) {
    $result = mysqli_query($conn_read, $sql);
    $resultCheck = mysqli_num_rows($result);
    $data_name = $data_name;
    if ($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$data_name]['time_stamp'][] = date("Y-m-d H:i", strtotime($row['time_stamp']));
            $data[$data_name]['temperature'][] = $row['temperature'];
            $data[$data_name]['humidity'][] = $row['humidity'];
        }
        return $data;
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
    }
}


# TODO make an autoarray depending on query result
function getdata_EXAMPLE($conn_read, $sql) {
    $result = mysqli_query($conn_read, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        # create an array that I can call with $row['time_stamp'] for example
        $row = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $time_stamp[] = $row['time_stamp'];
            $shorted_time[] = date("H:i", strtotime($row['time_stamp']));
            $temperature[] = $row['temperature'];
            $humidity[] = $row['humidity'];
            $value_id[] = $row['value_id'];
        }
        #echo "<br>Number of elements in time_stamp:" . count($time_stamp);
        return [$time_stamp, $shorted_time, $temperature, $humidity, $value_id];
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
    }
}

# TODO make an autoarray depending on query result
function getdata_test3($conn_read, $sql, $data_name, $data) {
    $result = mysqli_query($conn_read, $sql);
    $resultCheck = mysqli_num_rows($result);
    $data_name = $data_name;
    if ($resultCheck > 0) {
        # create an array that I can call with $row['time_stamp'] for example
        $row = mysqli_fetch_assoc($result);
        //$data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            # mind the missing []
            /////$DBtemp = array($row['time_stamp'] => $row['temperature']);
            /////$DBhumid[] = array($row['time_stamp'] => $row['humidity']);
            //$DBtemp = array($row['time_stamp'] => $row['temperature']);
            //$DBhumid[] = array($row['time_stamp'] => $row['humidity']);
            $data[$data_name]['time_stamp'][] = $row['time_stamp'];
            $data[$data_name]['temperature'][] = $row['temperature'];
            $data[$data_name]['humidity'][] = $row['humidity'];
        }
        #echo "<br>Number of elements in time_stamp:" . count($time_stamp);
        return $data;
    } else {
        echo "Could not get values from database" . mysqli_connect_error();
    }
}