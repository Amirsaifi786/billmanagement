<?php
// Read raw POST data
$data = file_get_contents("php://input");
// Parse the form-urlencoded data into an array
parse_str($data, $parsedData);
// Convert JSON response to an array if data is JSON
if (empty($parsedData) && !empty($data)) {
    $parsedData = json_decode($data, true);
}
// print_r($parsedData);
file_put_contents("payres.txt", json_encode($parsedData, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);
echo json_encode($parsedData, true);

?>
