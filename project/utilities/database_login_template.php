<?php
/* Make a copy! Do not edit or delete this template file! */
$server = '';
$username = '';
$password = '';
$database = 'myxtaomy_**'; /* enter proper project code */

try{
	$conn_login = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
?>
