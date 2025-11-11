 
<?php 
require'config.php';



$stockselect = $_POST['stockselect'];
$proid = $_POST['prdid'];

$selectproduct=mysqli_query($conn,"SELECT * FROM product WHERE id='$proid' ");


while($data=mysqli_fetch_array($selectproduct))
{ 
    $size = explode(',', $data['size']);  
    $stock = explode(',', $data['stock']);  
    for($i=0; $i<=count($size); $i++)
        {
            if($size[$i]!='')
            {
                if($stockselect == $size[$i])
            $stockk =  $stock[$i];
            }
             
        }
}

echo $stockk;
?>