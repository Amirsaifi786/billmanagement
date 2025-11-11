<?php 
require'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Check if pincode is passed
if (isset($_GET['pin'])) {
    $pincode = $_GET['pin'];

    // Prepare the SQL query to fetch the location data based on pincode
    $sql = "SELECT city_name, state_name FROM locations WHERE pincode = '$pincode' LIMIT 1";
    $stmt = mysqli_query($conn,$sql);

    // Execute the query
    if ($stmt) {
        // Fetch the data
        $result = mysqli_fetch_assoc($stmt);

        // If data is found, return the city and state names
        if ($result) {
            echo json_encode([
                'city_name' => $result['city_name'],
                'state_name' => $result['state_name']
            ]);
        } else {
            // If no data is found for the pincode
            echo json_encode(['message' => 'City and State not found for the given pincode.']);
        }
    } else {
        // If the query execution failed
        echo json_encode(['message' => 'Error executing the query.']);
    }
} else {
    // If pincode is not provided in the request
    echo json_encode(['message' => 'Pincode is required.']);
}


?>