<?php
 
 
function Connect()
{
 $dbhost = "192.168.1.120";
 $dbuser = "miguelle";
 $dbpass = "miguelle";
 $dbname = "login";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 
 return $conn;
	
}
 
?>
