<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$group_nameError = null;
		$group_descError = null;
		
		
		$group_name = $_POST['group_name'];
		$group_desc = $_POST['group_desc'];
		
		$valid = true;
		if (empty($group_name)) {
			$group_nameError = 'Please enter group name';
			$valid = false;
		}
		
		if (empty($group_desc)) {
			$group_descError = 'Please enter group desc';
			$valid = false;
		} 
		
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO student_group(group_name, group_desc) VALUES (?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($group_name,$group_desc));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/style.css" rel="stylesheet">
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
			<h3>Create a Student Group:</h3>
		</div>
		<div class="register">
			<form action="create_group.php" method="post">
				<table>
					<tr>	
						<td>Group Name:</td>
						<td><input name="group_name" type="text"  placeholder="group name" value="<?php echo !empty($group_name)?$group_name:'';?>">
						<?php if (!empty($group_nameError)): ?>
							<span class="erros_color"><?php echo $group_nameError;?></span>
						<?php endif; ?></td>
					<tr>
					<tr>	
						<td>Group Description:</td>
						<td><input name="group_desc" type="text" placeholder="group desc" value="<?php echo !empty($group_desc)?$group_desc:'';?>">
						<?php if (!empty($group_descError)): ?>
							<span class="erros_color"><?php echo $group_descError;?></span>
						<?php endif;?></td>
					</tr>
					<tr>
						<td></td>
						<td>
						  <button type="submit" >Create</button>
						  <button><a href="index.php" >Back</a></button>
						</td>  
					</tr>
				</table>	
			</form>
		</div>
    </div> 
  </body>
</html>