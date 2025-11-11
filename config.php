<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
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
define('API_KEY', 'bcd6b7cb-d4b0-4378-ab23-4437bafb1a2d');

// Function to check the API key in the request header
if (!function_exists('checkApiKey')) {

function checkApiKey() {
    // Get all the headers
    $headers = getallheaders();
    
    // Check if the API-Key exists in the headers
    if (isset($headers['API-Key'])) {
        // Compare it with the predefined key
        if ($headers['API-Key'] === API_KEY) {
            return true;
        }
    }
    
    // If no API key is provided or the key is invalid, return false
    return false;
}
}
if (!function_exists('logResponse')) {
function logResponse($data, $logDir = 'logs') {
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $currentHour = date('Y-m-d_H');
    $logFile = $logDir . DIRECTORY_SEPARATOR . "response_log_" . $currentHour . '.json';

    if (!file_exists($logFile)) {
        file_put_contents($logFile, json_encode([]));
    }

    $logs = json_decode(file_get_contents($logFile), true);

    if (!is_array($logs)) {
        $logs = [];
    }

    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'response'  => $data
    ];

    $logs[] = $logEntry;

    file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT));
}
}
if (!function_exists('getAllHeaders')) {
function getAllHeaders() {
    if (function_exists('getallheaders')) {
        // Apache environment
        return getallheaders();
    } else {
        // Non-Apache environment (e.g., nginx)
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                // Remove the "HTTP_" prefix and replace underscores with dashes
                $headerName = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))));
                $headers[$headerName] = $value;
            }
        }
        return $headers;
    }
}
}
if (!function_exists('getClientIP')) {
function getClientIP() {

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    }

    if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return 'Unknown IP';
}
}

?>