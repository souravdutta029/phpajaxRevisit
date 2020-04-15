<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert | Data</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="styles.css">

</head>
<body>
	<div class="addheader">
		<h1>Add Records With PHP and Ajax</h1>
		<div id="search-box">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
	</div>
	<div class="formclass">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<form id="add-form">
			<label>First Name: </label>	
			<input type="text" id="first-name" autocomplete="off">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<label>Last Name: </label>	
			<input type="text" id="last-name" autocomplete="off">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			<input type="submit" id="savebtn" value="Save" class="btn btn-secondary">
		</form>
	</div>
	<table id="main" class="table table-bordered table-striped">
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
	
	<div id="error-message"></div>
	<div id="success-message"></div>
	<div id="modal">
		<div id="modal-form">
			<h2>Edit Form</h2>
			<table cellpadding="10px", width="100%">
				<!-- <tr>
					<td>First Name</td>
					<td><input type="text" id="edit-fname"></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><input type="text" id="edit-lname"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" id="edit-submit" value="Update"></td>
				</tr>	 -->			
			</table>
			<div id="close-btn">X</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script>
		$(document).ready(function(){
			// Load Table Records
			function loadTable(){
				$.ajax({
					url  	: "ajax-load.php",
					type 	: "POST", 
					success : function(data){
						$('#table-data').html(data);
					}
				});
			}

			loadTable();  // Load Table Records on Page Load

			// Insert New Records
			$('#savebtn').on("click", function(e){
				e.preventDefault();
				var fname = $("#first-name").val();
				var lname = $("#last-name").val();
				if(fname == "" || lname == ""){
					$('#error-message').html('All fields are required.').slideDown();
					$('#success-message').slideUp();
				}else{
					$.ajax({
					url		: 'ajax-insert.php',
					type	: 'POST',
					data	: {first_name:fname, last_name:lname},
					success : function(data){
						if(data == 1){
							loadTable();
							$('#add-form').trigger('reset');
							$('#success-message').html('Data Inserted Successfully.').slideDown();
							$('#error-message').slideUp();
						}else{
							$('#error-message').html('No Records Passed.').slideDown();
							$('#success-message').slideUp();
						}						
					}
				});
				}

			});

			// Delete Records
			$(document).on("click",".delete-btn", function(){
				if(confirm("Are you sure, You want to Delete it ???")){
					var studentId = $(this).data("id");
					var element = this;

					$.ajax({
						url     : 'ajax-delete.php',
						type    : 'POST',
						data    : {id : studentId},
						success : function(data){
							if(data == 1){
								$(element).closest('tr').fadeOut();
								$('#success-message').html('Data Deleted.').slideDown();
								$('#error-message').slideUp();
							}else{
								$('#error-message').html('Something Went Wrong.').slideDown();
								$('#success-message').slideUp();
							}
						}

					});
				}
			});

			// Show Modal Box
			$(document).on("click",".edit-btn", function(){
				$('#modal').show();
				var studentId = $(this).data('eid');

				$.ajax({
					url 	: 'ajax-edit.php',
					type	: 'POST',
					data	: {id : studentId},
					success : function(data){
						$('#modal-form table').html(data);
					}
				});
			});

			// Hide Modal Box
			$('#close-btn').on("click", function(){
				$('#modal').hide();
			});

			// Update Records
			$(document).on("click","#edit-submit", function(){
		        var stuId = $("#edit-id").val();
		        var fname = $("#edit-fname").val();
		        var lname = $("#edit-lname").val();

		        if(fname == "" || lname == ""){
		        	$('#error-message').html('All fields are required.').slideDown();
					$('#success-message').slideUp();
		        }else{
		        	$.ajax({
			          url: "ajax-update.php",
			          type : "POST",
			          data : {sid: stuId, first_name: fname, last_name: lname},
			          success: function(data) {
							if(data == 1){
					        $("#modal").hide();
					        loadTable();
					        }			          	

		        		}
		        	})
		        }
		    });

		    // Live Search
		    $('#search').on("keyup", function(){
		    	var searchTerm = $(this).val();

		    	$.ajax({
		    		url 	: "ajax-live-search.php",
		    		type 	: "POST",
		    		data 	: {search : searchTerm},
		    		success : function(data){
		    			$('#table-data').html(data);
		    		}
		    	});
		    });

		    // Pagination

		    function loadTable(page){
		    	$.ajax({
		    		url : "ajax-pagination.php",
		    		type : "POST",
		    		data : {page_no : page},
		    		success : function(data){
		    			$('#table-data').html(data);
		    		}
		    	});
		    }
		    loadTable();
			
			// Pagination code
			$(document).on("click", "#pagination a", function(e){
				e.preventDefault();
				var page_id = $(this).attr('id');

				loadTable(page_id);
			});

		});
	</script>
</body>
</html>