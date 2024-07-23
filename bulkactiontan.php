<?php
include("backInc.php");   

header("Content-Type: application/json");

$parameterdata = file_get_contents('php://input');
$inputData = json_decode($parameterdata);

MISuploadlogger('Hit inside bulk action');

MISuploadlogger("Parameter Json \n".$inputData);

	die;

				 
	

?>