<?php 
	require 'database.php';
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( !empty($_POST)) {
		
		$id = $_POST['id'];
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM std_grp_link WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: groupdetails.php");
		
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
			<h3>Delete a Student From Group:</h3>
		</div>
		<div class="confirmation">	
			<form action="delete_from_grp.php" method="post">
			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
			  <p class="erros_color">Are you sure to delete ?</p>
			<div>
				  <button type="submit" >Yes</button>
				  <button><a class="btn" href="groupdetails.php">No</a></button>
			</div>
			</form>
		</div>		
    </div> 
  </body>
</html>