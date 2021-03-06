<?php
/**
 *@author Deane Sales 
 */
require 'form.php';

// get user input from form.php
$year = intval($year);
$id = $sttId;
$hour = intval($hour);

$reader = new XMLReader();
$sums = [];
$results = array_fill(0, 12, 'NaN');    // a 12-item array initialized with NaN values
$h24 = 24 * 3600;                       // 24 hours in unix time


// array contains start of 13 months at $hour in timestamp (Jan 1st-> Dec 1st of $year, and Jan 1st of next year)
$monthsUnix = [];
foreach (range(1, 13) as $m) {
    array_push($monthsUnix, getTimestamp($year, $m, $hour));
}


if (!$reader->open("/Applications/XAMPP/xamppfiles/htdocs/ATIWD2 - Assignment/Files/data_" . $id . ".xml")) {
    die("Failed to open file");
}

// arrays of 12 elements initialised to 0
$sums = array_fill(0, 12, 0);
$counts = array_fill(0, 12, 0);

// loop through <rec>
while ($reader->read()) {
    if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'rec') {
        $ts = intval($reader->getAttribute('ts'));

        foreach (range(0, 11) as $m) {
            if ($ts >= $monthsUnix[$m] && $ts < $monthsUnix[$m + 1]) {
                // if 'ts-monthUnix[m]' is divisible by 'h24', then it is at $hour of some day in the month
                if (($ts - $monthsUnix[$m]) % $h24 === 0) {
                    $reading = $reader->getAttribute('no');
                    // only add into arrays if there is a reading (not an empty string)
                    if ($reading) {
                        $sums[$m] += floatval($reading);
                        $counts[$m]++;
                    }
                    break;
                }
            }
        }
    }
}

$reader->close();

$averages = [];
// calculate averages
foreach ($sums as $index => $sum) {
    if ($counts[$index] != 0)
        array_push($averages, number_format($sum / $counts[$index], 2));
    else
        array_push($averages, 'NaN');
}

// get unix time
function getTimestamp($year, $month, $hour)
{
    $d = DateTime::createFromFormat("d-m-Y H:i:s", "01-{$month}-{$year} {$hour}:00:00", new DateTimeZone('GMT'));
    return $d->getTimestamp();
}

?>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    let averages = JSON.parse('<?php echo json_encode($averages); ?>');

    // setTimeOut for google libraries to load
    setTimeout(() => {
        if (google.visualization != undefined) {
            google.charts.setOnLoadCallback(drawChart());
        }
    }, 600)


    const drawChart = () => {
        // map averages to array of array contains [month, average] then add a header
        let chartData = averages.map((avg, index) => [index + 1, (avg === "NaN") ? NaN : parseFloat(avg)]);
        chartData.unshift(['Month', 'Average Concentration (??g/m??)']);

        let data = google.visualization.arrayToDataTable(chartData);

        var options = {
            title: 'Monthly average NO concentration at <?php echo $hour; ?>.00 hours in the year ' +
                '<?php echo $year; ?> measured by station <?php echo $sttId; ?>; measured in ??g/m??',
            hAxis: {
                title: 'Month',
                minValue: 1,
                maxValue: 12,
                gridlines: {
                    count: 6
                }
            },
            vAxis: {
                title: 'Concentration (??g/m??)',
            },
            legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>