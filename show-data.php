<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Show | Data</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="styles.css">

</head>
<body>
	<table id="main" class="table">
		<tr>
			<td id="header">
				<h1>Ajax with PHP</h1>
			</td>
		</tr>
		<tr>
			<td id="table-load">
				<input type="button" id="load-button" value="Load Data" class="btn btn-primary">
			</td>
		</tr>
		<tr>
			<td id="table-data">
				<!-- <table border="1" width="100%" cellspacing="0" cellpadding="10px">
					<tr>
						<th>Id</th>
						<th>Name</th>
						<tr>
							<td align="center">1</td>
							<td>Sourav Dutta</td>
						</tr>
					</tr>					
				</table> -->
			</td>
		</tr>		
	</table>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script>
		// jQuery Code
		$(document).ready(function(){
			$('#load-button').on("click", function(e){
				$.ajax({
					url  	: "ajax-load.php",
					type 	: "POST", 
					success : function(data){
						$('#table-data').html(data);
					}
				});
			});
		});
	</script>
</body>
</html>