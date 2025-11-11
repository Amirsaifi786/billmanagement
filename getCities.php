<?php

require'config.php';
 
// Get state_id from the request
$state_id = intval($_GET['state_id'] ?? 0);

// Initialize an empty response
$response = "";

if ($state_id > 0) {
    // Fetch cities for the given state
    $sql = "SELECT id, city FROM cities WHERE state_id = $state_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Create option elements for each city
        while ($row = $result->fetch_assoc()) {
            $response .= '<option value="' . $row['city'] . '">' . $row['city'] . '</option>';
        }
    } else {
        $response = '<option value="">No cities found</option>';
    }
} else {
    $response = '<option value="">Invalid state selected</option>';
}

// Output the response
echo $response;

// Close the database connection
$conn->close();


?>