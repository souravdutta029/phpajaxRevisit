<?php

	$student_id = $_POST['id'];

	$conn = mysqli_connect("localhost","root","","phpajax") or die("Connection Failed");

	$sql  = "SELECT * FROM students WHERE id = {$student_id}";
	$result = mysqli_query($conn, $sql) or die('SQL Query Failed');
	$output = "";

	if(mysqli_num_rows($result) > 0 ){
		
		while($row = mysqli_fetch_assoc($result)){
				$output .= "<tr>
							<td>First Name</td>
							<td><input type='text' id='edit-fname' value='{$row["first_name"]}'></td>
								<input type='hidden' id='edit-id' value='{$row["id"]}'>
				      	  </tr>
							<tr>
								<td>Last Name</td>
								<td><input type='text' id='edit-lname' value='{$row["last_name"]}'></td>
							</tr>
							<tr>
								<td></td>
								<td><input type='submit' id='edit-submit' value='Update'></td>
							</tr>";
			}
		
		mysqli_close($conn);

		echo $output;
				  
	}else{
		echo "<h2>No Records Found.</h2>";
	} 

?>