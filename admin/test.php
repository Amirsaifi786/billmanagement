<?php
require'config.php';
$selectdata=mysqli_query($conn,"SELECT * FROM product WHERE status='1' ORDER BY id DESC LIMIT 1  ");
while($row = mysqli_fetch_array($selectdata))
{
   $array = unserialize($row["size"]);
   print_r($array['Size'][0]);
}
   ?>