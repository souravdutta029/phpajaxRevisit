<?php

	$stu_id = $_POST["sid"];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];

	$conn = mysqli_connect("localhost","root","","phpajax") or die("Connection Failed");

	$sql  = "UPDATE students SET first_name = '{$first_name}', last_name = '{$last_name}' WHERE id = {$stu_id}";

	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo 0;
	}

?>