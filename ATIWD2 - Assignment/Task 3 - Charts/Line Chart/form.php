<?php
/**
 *@author Deane Sales 
 */
extract($_POST);

if (isset($drawChart)) {
    $sttIds = $_POST['station'];
    $pollutant = $_POST['pollutant'];
    $date = $_POST['date'];
} else {
    $sttIds = [203, 206, 215, 270, 375, 452];
    $pollutant = 'no';
    $date = '2015-01-01';
}


function selected($isStation, $value)
{
    global $sttIds, $pollutant;
    if ($isStation) {
        foreach($sttIds as $id) {
            if ($id == $value) {
                print("selected");
            }
        }
    }
    else {
        return ($pollutant == $value) ? print("selected") : "";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Line Chart Visualisation</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../styles.css" />
    <script>
        function validateStations() {
            var stationSelect = document.getElementById('station');
            var optionCount = 0;
            
            for (var i = 0; i < stationSelect.length; i++) {
                if (stationSelect[i].selected) {
                    optionCount++;
                }
            }
            if (optionCount != 6) {
                alert("You need to choose 6 stations")
                return false
            }
            return true;
        }
    </script>
</head> 
    
<body>
    <div id="chart_div" style="width: 1000px; height: 500px; "></div>

    <form onsubmit="return validateStations()" method="POST" action="<?php print $_SERVER['PHP_SELF']; ?>">
        <div class="InputItem">
            <label for="station[]" style="vertical-align: top">Select 6 Stations (Hold CTRL or CMD): </label>
            <select name="station[]" id="station" multiple>
                <option value="203" <?php selected(true, 203); ?>>203: Brislington Depot</option>
                <option value="206" <?php selected(true, 206); ?>>206: Rupert Street</option>
                <option value="215" <?php selected(true, 215); ?>>215: Parson Street School</option>
                <option value="270" <?php selected(true, 270); ?>>270: Wells Road</option>
                <option value="375" <?php selected(true, 375); ?>>375: Newfoundland Road Police Station</option>
                <option value="452" <?php selected(true, 452); ?>>452: AURN St Pauls</option>
                <option value="463" <?php selected(true, 463); ?>>463: Fishponds Road</option>
                <option value="500" <?php selected(true, 500); ?>>500: Temple Way</option>
                <option value="501" <?php selected(true, 501); ?>>501: Colston Avenue</option>
            </select>
        </div>
        
        <div class="InputItem">
            <label for="pollutant">Select Pollutant: </label>
            <select name="pollutant" id="pollutant">
                <option value="no"  <?php selected(false, 'no'); ?>>NO</option>
                <option value="nox" <?php selected(false, 'nox'); ?>>NOX</option>
                <option value="no2" <?php selected(false, 'no2'); ?>>NO2</option>
            </select>
        </div>

        <div class="InputItem">
            <label for="date">Choose a date: </label>
            <input type="date" name="date" min="2015-01-01" max="2019-12-31" value=<?php print($date); ?>>
        </div>
        <div class="SubmitBtn">
            <button name="drawChart">Submit</button>
        </div>
    </form>

</body>

</html>