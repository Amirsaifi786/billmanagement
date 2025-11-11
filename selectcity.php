<?php
require'config.php';
 

$doctor=$_POST['pincode'];

     $brfilterresult ="SELECT * FROM pincode WHERE `pincode`='$doctor' ";
 

$result = mysqli_query($conn,$brfilterresult);
 
 
if(mysqli_num_rows($result)>0)
	{
    	  $row=mysqli_fetch_array($result);
           
        	 $city =$row['City'];
        	 $state =$row['State']; 
         
	}
	else
	{
	      $error ="Delivery Not available..!"; 
	}
echo  json_encode( array(
    "City" => $city,
    "State" => $state, 
    "Error" => $error 
) );
 




?>