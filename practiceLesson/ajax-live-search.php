<?php

	$search = $_POST['search'];

	$conn = mysqli_connect("localhost","root","","phpajax") or die("Connection Failed");

	$sql  = "SELECT * FROM students WHERE first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%'";
	$result = mysqli_query($conn, $sql) or die('SQL Query Failed');
	$output = "";

	if(mysqli_num_rows($result) > 0 ){
		$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
					<tr>
						<th width="60px">Id</th>
						<th>Name</th>
						<th width="90px">Edit</th>
						<th width="90px">Delete</th>
					</tr>';

					while($row = mysqli_fetch_assoc($result)){
						$output .= "<tr>
										<td align='center'>{$row["id"]}</td>
										<td>{$row["first_name"]} {$row["last_name"]}</td>
										<td align='center'><button Class='edit-btn btn btn-success' data-eid='{$row["id"]}'>Edit</button></td>
										<td align='center'><button Class='delete-btn btn btn-danger' data-id='{$row["id"]}'>Delete</button></td>
									</tr>";	
					}
		$output .= "</table>";
		mysqli_close($conn);

		echo $output;
				  
	}else{
		echo "<h2>No Records Found.</h2>";
	} 

?>