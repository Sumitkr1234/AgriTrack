<?php
$temp = $_GET['temp'];
$humidity = $_GET['humidity'];
$rainfall = $_GET['rainfall'];

// Full path to python + script
$command = "python C:\\xampp\\htdocs\\CropMaster\\ml\\predict.py $temp $humidity $rainfall";

// Execute
$output = shell_exec($command);

// Return JSON
echo json_encode(["crop" => trim($output)]);
?>