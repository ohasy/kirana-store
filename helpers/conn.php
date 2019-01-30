<?php
// connect to database
$con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'],  $_ENV['DB_PASS'], $_ENV['DB_NAME']); //host,user,pass,db_name
// check for connection errors
if(mysqli_connect_errno())
	die(mysqli_connect_error());
// function to execute query and automatically check for errors
function query($sql){
	$result = mysqli_query($GLOBALS['con'], $sql);
	if(!$result){
		die(mysqli_error($GLOBALS['con']));
	}
	return $result;
}