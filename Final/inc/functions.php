<?php
$rootUrl = '/~n02587091/2012WebCourse/Final';
require_once (__DIR__ . '/password.php');
function GetConnection()
{
	global $password;
	$conn = new mysqli('localhost','n02587091', $password, 'n02587091_db');
	return $conn;
}
function EscapeRow($row, $conn)
{
	$row2 = array();
	foreach ($row as $key => $value) {
		$row2[$key] = $conn->real_escape_string($value);
	}
	return $row2;
}

function curl_download($Url){ 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
