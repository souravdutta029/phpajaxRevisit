<?php 

	$student_Id = $_POST['id'];

	$conn = mysqli_connect("localhost","root","","phpajax") or die("Connection Failed");

	$sql  = "DELETE FROM students WHERE id = {$student_Id}";
	
	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo 0;
	}

?>