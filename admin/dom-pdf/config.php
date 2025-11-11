<?php
session_start();
	$host="localhost";
	$user="webflowi_trailer";
	$pass="trailer123@";
	$dbname="webflowi_trailer";

		$conn = mysqli_connect($host, $user, $pass, $dbname);
		if(!$conn)
		{
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
?>