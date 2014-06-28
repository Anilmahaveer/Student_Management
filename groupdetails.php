<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
		<div class="header">
			<h3>Student Record:</h3>
		</div>
		<div class="menu">
		<table>
			<tr>
			<td><p>
				<form action="create.php">
					<button class="create_btn">Register Students</button>
				</form>
			</p></td>
			<td><p>
				<form action="create_group.php">
					<button class="create_btn">Create Group</button>
				</form>
			</p></td>
			<td><p>
				<form action="index.php">
					<button class="create_btn">Student details</button>
				</form>
			</p></td>
			<td><p>
				<form action="groupdetails.php">
					<button class="create_btn">Group details</button>
				</form>
			</p></td>
			<td><p>
				<form action="add_std_grp.php">
					<button class="create_btn">Add students to group:</button>
				</form>
			</p></td>
			</tr>
			</table>
		<div>	
		<div class="table">	
			<table class="imagetable" width="500px">
				  <thead>
					<tr>
					  <th>Student Name</th>
					  <th>Group Name</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
				   include 'database.php';
				   $pdo = Database::connect();
				   $sql = 'SELECT
									 student.name as student_name,
									 student_group.group_name as group_name, std_grp_link.id as id
								FROM 
									student  
								JOIN 
									std_grp_link 
								ON
									student.id = std_grp_link.student_id 
								JOIN
									student_group 
								ON
									std_grp_link.group_id = student_group.id
								GROUP BY std_grp_link.id';
				   foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. $row['student_name'] . '</td>';
							echo '<td>'. $row['group_name'] . '</td>';
					
							echo '<td width=250>';
							echo '<button><a class="btn btn-danger" href="delete_from_grp.php?id='.$row['id'].'">Delete</a></button>';
							echo '</td>';
							echo '</tr>';
				   }
				   Database::disconnect();
				  ?>
				  </tbody>
			</table>
		</div>	
    </div> 
  </body>
</html>