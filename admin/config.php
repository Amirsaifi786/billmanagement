<?php
session_start();
	$host="localhost";
	$user="root";
	$pass="";
	$dbname="purepixel";
		$conn = mysqli_connect($host, $user, $pass, $dbname);
		$con=$conn;	
		if(!$conn)

		{

			die("Failed to connect to MySQL: " . mysqli_connect_error());

		}

?>