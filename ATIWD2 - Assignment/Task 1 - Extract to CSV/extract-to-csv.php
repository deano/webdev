<?php
/**
 *@author Deane Sales
 * 
 *This file will extract the air-quality-data-2004-2019.csv file into MULTIPLE .csv files
 */

//set PHP flags to run large file
@date_default_timezone_set("GMT");

ini_set('memory_limit', '512MB');
ini_set('max_execution_time', '300');
ini_set('auto_detect_line_endings', TRUE);

$st = microtime(true);

$csvInputPath = fopen("/Applications/XAMPP/xamppfiles/htdocs/ATIWD2 - Assignment/Files/air-quality-data-2004-2019.csv", "r") or die("Unable to open file!");

$stations = [
    '188', '203', '206', '209', '213', '215',
    '228', '270', '271', '375', '395', '452',
    '447', '459', '463', '481', '500', '501'
];

$header = 'siteID,ts,nox,no2,no,pm10,nvpm10,vpm10,nvpm2.5,pm2.5,vpm2.5,co,o3,so2,loc,lat,long';

//open files for writing
foreach ($stations as $stationNum) {
    // dynamic variable name (variable variables)
    ${'data_' . $stationNum} = fopen("data_$stationNum.csv", "w") or die("Unable to open data_$stationNum.csv!");
    // write the header line
    fwrite(${'data_' . $stationNum}, $header);     
}
//skips the header of the input, 1st line
fgets($csvInputPath);           

while ($data = fgets($csvInputPath)) {
    //split the line to make an array
    $arr = explode(";", $data);                     

    $nox = $arr[1];
    $co = $arr[11];
    
    // skips if nox and co are empty
    if (empty($nox) && empty($co)) {                
        continue;
    }

    //get lat and long 
    [$lat, $long] = explode(",", $arr[18]);

    //convert to UNIX timestamp
    $datetime = explode("+", $arr[0])[0];
    
    // reformat the string to datetime format
    $datetime = str_replace("T", " ", $datetime);   
    $ts = strtotime($datetime);

    //array with all neccessary columns
    $essential = array_merge([$arr[4], $ts], array_slice($arr, 1, 3), 
                            array_slice($arr, 5, 9), [$arr[17], $lat, $long]);

    $write_str = implode(",", $essential );

    // WRITES RECORDS INTO FILES
    fwrite(${'data_' . $arr[4]}, "\n" . $write_str);
}

foreach ($stations as $stationNum) {
    fclose(${'data_' . $stationNum});
}

echo microtime(true) - $st;

?>