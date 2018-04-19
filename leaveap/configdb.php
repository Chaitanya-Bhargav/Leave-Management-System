<?php
	$server="localhost";
	$database="meshteam";
	$username="root";
	$password="";
	try{
	$conn=new PDO("mysql:host=$server;dbname=$database",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected Succesfully";
	}
	catch(PDOException $e)
    {
    echo $e->getMessage();
	
    }
?>