<?php
require 'config.php'; // Include your database connection

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT * FROM area WHERE PostOfficeName LIKE '%$search%' OR Pincode LIKE '%$search%' LIMIT 10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="dropdown-item" data-address="'.$row['PostOfficeName'].'" 
                  data-pincode="'.$row['Pincode'].'" 
                  data-city="'.$row['City'].'" 
                  data-district="'.$row['District'].'" 
                  data-state="'.$row['State'].'">
                  '.$row['PostOfficeName'].' ('.$row['Pincode'].')
                  </div>';
        }
    } else {
        echo '<div class="dropdown-item">No results found</div>';
    }
}
?>
