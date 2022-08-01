<?php


// Start timeline at nearest last 15 minutes
function round_time($target_time) {
    $rounded_time = date('Y-m-d H:i');
    $min = date('i', strtotime($target_time));
    if ($min < 14) $rounded_time = date('Y-m-d H:00');
    elseif ($min > 14 and $min < 29) $rounded_time = date('Y-m-d H:15');
    elseif ($min > 29 and $min < 44) $rounded_time = date('Y-m-d H:30');
    elseif ($min > 44) $rounded_time = date('Y-m-d H:45');

    $rounded_time = date('Y-m-d H:i', strtotime($rounded_time));
    return $rounded_time;
    // It rounds the minutes but sets and outputs other time to recent. Do I need to modify so it sustain input date?
    // also when minutes is = 44 it do not round it..  
    //$first = date('Y-m-d H:i',strtotime('-24 hours',strtotime($latest)));
}


// Create a static timeline 
function create_set($old, $new, $data) {
    // make sure variables a equal formatted for comparison
    $old = date('Y-m-d H:i', strtotime($old));
    $new = date('Y-m-d H:i', strtotime($new));

    $data['timeline']['timeline'][] = date('H:i',strtotime($old));
    $data['timeline']['entries'][] = $old;
    while ($old < $new) {
        $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
        
        $data['timeline']['timeline'][] = date('H:i',strtotime($old));
        $data['timeline']['entries'][] = $old;
    }
    return $data;
}


// Fill in the blanks in dataset
function adjust_dataset($TL_set, $data, $data_name) {
    for ($i=0; $i < sizeof($TL_set); $i++) { 
        while (!array_key_exists($TL_set[$i], $data)) {
            $data[$TL_set[$i]] = array("temperature" => null, "humidity" => null);
        }
    }
    return $data;
}


// Create temp and humid array for Chart
function create_valuelist($TL_set, $old, $data) {
    //$temp_array[] = $data[$old]['temperature'];
    //$humid_array = $data[$old]['humidity'];
    $temp_array = array();
    $humid_array = array();
    for ($i=0; $i < sizeof($TL_set); $i++) {
        $temp_array[] = $data[$old]['temperature'];
        $humid_array[] = $data[$old]['humidity'];
        $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
    }
    return [$temp_array, $humid_array];
}


// DEV. Create temp and humid array for Chart
function create_valuelist11($TL_set, $old, $data) {
    //$temp_array[] = $data[$old]['temperature'];
    //$humid_array = $data[$old]['humidity'];
    $temp_array = array();
    $humid_array = array();
    for ($i=0; $i < sizeof($TL_set); $i++) {
        if (var_dump(array_key_exists($old, $data))) {
            echo $old;
            $temp_array[] = $data[$old]['temperature'];
            $humid_array[] = $data[$old]['humidity'];
            $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
        } else {
            echo "<br>Error.. val: $old";
            $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
        }
    }
    return [$temp_array, $humid_array];
}


// DEV. Create temp and humid array for Chart
function create_valuelist11111($TL_set, $old, $data) {
    //$temp_array[] = $data[$old]['temperature'];
    //$humid_array = $data[$old]['humidity'];
    for ($i=0; $i < sizeof($TL_set); $i++) {
        if (array_key_exists($data[$old], $TL_set)) {
            $temp_array[] = $data[$old]['temperature'];
            $humid_array[] = $data[$old]['humidity'];
            $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
        } else {
            echo "<br>Error..";
            $old = date('Y-m-d H:i',strtotime('+15 minutes',strtotime($old)));
        }
    }
    return [$temp_array, $humid_array];
}



// Make a standard date formatting
function format_date($input) {
    $formatted = date('Y-m-d H:i', strtotime($input));
    return $formatted;
}


// Nice way to print datasets/arrays
function pre_r($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}



?>