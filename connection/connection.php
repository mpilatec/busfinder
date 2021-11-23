<?php
$conn  =  new mysqli("localhost","root","laytha");
	if(mysqli_connect_errno()){
		echo "Error ".$conn->error;
	}
	$db = $conn->select_db("busfinderdb");
	
	if(!$db){
		print "Error ".$conn->error;
	}
	
	?>