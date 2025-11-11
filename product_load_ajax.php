<?php
require'config.php';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 30;  // Number of products to show per page
$offset = ($page - 1) * $limit;

// SQL query to select random products where status = '1' (active)
$query = "SELECT * FROM product WHERE status = '1' LIMIT $limit OFFSET $offset";

// Execute the query
$result = $conn->query($query);

// Check if there are products to return
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
<div class="col-lg-3 col-md-6 col-6">
        <a href="product-details.php?idpro=<?php echo base64_encode($row['id']); ?>&cat=<?php echo $_GET['cat']; ?>">
            <div class="product-item products">
                <div class="product-thumb">
                    <?php
                    $image = explode(",", $row['image']);
                    $img = trim($image[0]);
                    if (!empty($img) && file_exists("admin/image/$img")) {
                        echo '<img src="admin/image/' . $img . '" alt="product thumb">';
                    } else {
                        echo '<div style="padding:30px;text-align:center;">Zero</div>';
                    }

                    $saveamount = $row['mrp'] - $row['sellprice'];
                    $countper = $saveamount / $row['mrp'];
                    $lastpercent = $countper * 100;
                    ?>
                    <div class="ribbon">
                        <span>Flat <?php echo ceil($lastpercent); ?>% Off</span>
                    </div>
                </div>
                <div class="product-content">
                    <div class="name">
                        <h2>
                            <?php
                            $f = $row['name'];
                            echo (strlen($f) > 22) ? substr($f, 0, 22) . "..." : $f;
                            ?>
                        </h2>
                    </div>
                    <div class="price">
                        <div>
                            <span class="sale">&#8377; <?php echo $row['sellprice']; ?>.00</span>
                            <span class="real">&#8377; <?php echo $row['mrp']; ?>.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>    <?php
    }
} else {
    echo "";  // No products to load
}

// Close the connection
$conn->close();

?>