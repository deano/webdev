<?php
/**
 *@author Deane Sales
 * 
 *This file will normalize the .csv files which was extracted into multiple .csv files from the air-quality-data-2004-2019.csv to .xml, which is then later used for maps and charts visualisation.
 */

$st = microtime(true);

$stations = [
    '203', '206', '188', '209', '213', '215',
    '228', '270', '271', '375', '395', '452',
    '447', '459', '463', '481', '500', '501'
];

//Loops through each station file
foreach ($stations as $stationNum) {
    $file = fopen("/Applications/XAMPP/xamppfiles/htdocs/ATIWD2 - Assignment/Files/data_$stationNum.csv", "r") or die("Unable to open data_$stationNum.csv!");
   
    //skips the header of the input
    fgets($file);                                  

    $xml = new XMLWriter();
    $xml->openUri("data_" . $stationNum . '.xml');
    $xml->startDocument('1.0', 'UTF-8');
    $xml->setIndent(true);
    
    //gets the first line of datato get geocode and name
    $firstRec = fgets($file);     
    
    //data string into an array
    $stationInfo = explode(',', $firstRec);         

    //if theres no data, get geocode and name from original csv file
    if (count($stationInfo) == 1) {                 
        [$name, $geocode] = getNameGeo($stationNum);
    } 
    //else get id, name, and geocode 
    else {
        $name = $stationInfo[14];
        $geocode = $stationInfo[15] . ',' . trim($stationInfo[16]);
    }
    //open <station > tag
    $xml->startElement('station');    
    
    // write the attributes
    $xml->writeAttribute('id', $stationNum);        
    $xml->writeAttribute('name', $name);
    $xml->writeAttribute('geocode', $geocode);

    //move pointer back to start of file
    rewind($file);     
    
    // skip first header line again
    fgets($file);                                  

    //loop through data lines 
    while ($rec = fgets($file)) {
        $recArr = explode(",", $rec);

        //ignore empty records or records that dont have nox and no2 readings
        if (count($recArr) == 1 || ($recArr[2] == '' & $recArr[3] == ''))
            continue;
        
        // open <rec>
        $xml->startElement('rec'); 
        
        // add ts and pollutants attribute
        $xml->writeAttribute('ts', $recArr[1]);
        $xml->writeAttribute('nox', $recArr[2]);
        $xml->writeAttribute('no', $recArr[4]);
        $xml->writeAttribute('no2', $recArr[3]);
        
        // close </rec>
        $xml->endElement();                         
    }
    // close </station> tag
    $xml->fullEndElement();                         
    $xml->flush();
    fclose($file);
    
    //removes the last new line
    removeLastNewLine($stationNum);                 
}
//this function gets a station name and geocode from the csv file = air-quality-data-2004-2019.csv (used for station 481)
function getNameGeo($stationID) {
    $in_file = fopen("/Applications/XAMPP/xamppfiles/htdocs/ATIWD2 - Assignment/Files/air-quality-data-2004-2019.csv", "r") or die("Unable to open file!");
    while ($data = fgets($in_file)) {
        
        // explode the line into array
        $arr = explode(";", $data);                 

        // if a line with stationID is found
        if ($arr[4] == $stationID) { 
            
            // set $name and geocode
            $name = $arr[17];                       
            $geocode = $arr[18];
            break;
        }
    }
    fclose($in_file);

    return [$name, $geocode];
}
//function to remove last new line
function removeLastNewLine($stationID) {
    $file = fopen('data_' . $stationID . '.xml', 'r+') or die("can't open: $php_errormsg");
    //place the pointer just before the '>' of the station tag
    fseek($file, -2, SEEK_END);     
    // overwrite 2 bytes with a '>' and a space 
    fwrite($file, '> ');                    
    fclose($file);    
}
echo microtime(true) - $st;