<?php

$PiData = shell_exec("cat /home/pi/PiData/PiData.txt");
$PiData = explode("\n", $PiData);
unset($PiData[10]);

$i = 0;

foreach($PiData as $data) {
    $PiKey = "";
    switch ($i) {
        case 0:
            $PiKey = "cpu_temperature";
            break;
        case 1:
            $PiKey = "cpu_percent_usage";
            break;
        case 2:
            $PiKey = "ram_total";
            break;
        case 3:
            $PiKey = "ram_used";
            break;
        case 4:
            $PiKey = "ram_free";
            break;
        case 5:
            $PiKey = "ram_percent_usage";
            break;
        case 6:
            $PiKey = "disk_total";
            break;
        case 7:
            $PiKey = "disk_used";
            break;
        case 8:
            $PiKey = "disk_free";
            break;
        case 9:
            $PiKey = "disk_percent_usage";
            break;
    }
    $PiInfo[$PiKey] = $data;
    $i++;
}

$PiInfo["cpu_temperature"] = substr($PiInfo["cpu_temperature"], 0, -2);
$PiInfo["cpu_temperature"] = substr($PiInfo["cpu_temperature"], 5);  

echo json_encode($PiInfo);


?>
