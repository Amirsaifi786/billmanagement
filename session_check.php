<?php
session_start();
if($_SESSION['user_id']!='')
{
	   $user_id=$_SESSION['user_id'];
}
 // else
// {
// 	header('location:logout.php');
// 	die();
// }
?>