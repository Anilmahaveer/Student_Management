<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		$nameError = null;
		$phone_numberError = null;
		$cityError = null;
		$branchError = null;
		
		
		// keep track post values
		$name = $_POST['name'];
		$phone_number = $_POST['phone_number'];
		$city = $_POST['city'];
		$branch = $_POST['branch'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($phone_number)) {
			$phone_numberError = 'Please enter phone number';
			$valid = false;
		} 
		
		if (empty($city)) {
			$cityError = 'Please enter city';
			$valid = false;
		}
		
		if (empty($branch)) {
			$branchError = 'Please enter branch';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE student set name = ?, phone_number = ?, city =?,  branch =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$phone_number,$city,$branch,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM student where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$phone_number = $data['phone_number'];
		$city = $data['city'];
		$branch = $data['branch'];
		Database::disconnect();
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
		<div class="sub_heading">
			<h3>update a Student Record</h3>
		</div>
		<div class="register">
			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
				<table>
					<tr>	
						<td>Name:</td>
						<td><input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
						<?php if (!empty($nameError)): ?>
							<span class="erros_color"><?php echo $nameError;?></span>
						<?php endif; ?></td>
					</tr>
					
					<tr>	
						<td>Phone Number:</td>
						<td><input name="phone_number" type="text" placeholder="phone number" value="<?php echo !empty($phone_number)?$phone_number:'';?>">
						<?php if (!empty($phone_numberError)): ?>
							<span class="erros_color"><?php echo $phone_numberError;?></span>
						<?php endif;?></td>
					</tr>
			  
					<tr>	
						<td>City:</td>
					<td><input name="city" type="text"  placeholder="city" value="<?php echo !empty($city)?$city:'';?>">
						<?php if (!empty($cityError)): ?>
							<span class="erros_color"><?php echo $cityError;?></span>
						<?php endif;?></td>
					</tr>
				
					<tr>	
						<td>Branch:</td>
					<td><input name="branch" type="text"  placeholder="branch" value="<?php echo !empty($branch)?$branch:'';?>">
						<?php if (!empty($branchError)): ?>
							<span class="erros_color"><?php echo $branchError;?></span>
						<?php endif;?></td>
					</td>	
					<tr>
						<td></td>
						<td>
						  <button type="submit" >Update</button>
						  <button><a href="index.php" >Back</a></button>
						</td>  
					</tr>
				</table>	
			</form>
		</div>			
    </div> 
  </body>
</html>