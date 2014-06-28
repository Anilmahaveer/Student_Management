<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
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
		<div class="sub_heading">
					<h3>Add students to group:</h3>
				</div>
		<div class="register">
				  <?php 
				   include 'database.php';
				   $pdo = Database::connect();
				   $sql = 'SELECT * FROM student ORDER BY id DESC';
				   echo "<form id='myForm' action='select_std_grp.php' method='post'>";
				   echo "<table >";
					echo '<tr>';
					echo "<td>";
					echo "Student Name:";
					echo "</td>";
					echo "<td>";
					echo "<select name='selectedstudentid' id='selectedstudentid'>";
					echo "<option value='volvo'>Select Name:</option>" ;
				   foreach ($pdo->query($sql) as $row) 
					{
					$name =	$row['name'];
					$student_id_student = $row['id'];
					echo "<option value='$student_id_student'>$name</option>";
					}
					echo "</select>";
					echo "</td>";
					echo '<tr>';
					echo "<td>";
					echo "Group Name:";
					echo "</td>";
					echo "<td>";
					echo "<select name='selectgroupid' id='selectgroupid'>";
					echo "<option value='volvo'>Select Name:</option>" ;
				   $sql = 'SELECT * FROM student_group ORDER BY id DESC';
				   foreach ($pdo->query($sql) as $row) {
					$group_name =	$row['group_name'];
					$group_id_group = $row['id'];
					echo "<option value='$group_id_group'>$group_name</option>";
				   }
				   
				   echo "</select>";
				   echo "</td>";
				   echo "</tr>";
				   echo "<tr>";
				   echo "<td></td>";
				   echo "<td align='right'>";
				   echo "<input type='submit' name='Add' id='sub'>";
				   echo "</td>";
				   echo "</tr>";
				   echo "</table>";
				   echo "</form>";
				   
				   Database::disconnect();
				  ?>
				  </tbody>
			</table>
			<div id='result'>
			</div>
		</div>		
	</body>	
</html>	