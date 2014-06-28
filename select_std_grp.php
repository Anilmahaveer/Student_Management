<?php 
   $selectedstudent_id = mysql_real_escape_string($_POST["selectedstudentid"]);
   $selectgroup_id = mysql_real_escape_string($_POST["selectgroupid"]);
	
	echo "<br>";
	include 'database.php';
	$pdo = Database::connect();
	$sql = 'SELECT * FROM std_grp_link ';
	$valid1 = 0;
	foreach ($pdo->query($sql) as $row) {
	$student_id = $row['student_id']; 
	$group_id = $row['group_id'];
	
	
	if(($selectedstudent_id == $student_id) && ($selectgroup_id == $group_id))
	{
		$valid1 = 1;
	}
	
	}
	if($valid1 ==1)
	{
		echo "<font color='red'>";
		echo "He is already there in this group!!";
		echo "</font>";
	}
	else
	{
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO std_grp_link (student_id,group_id) values(?, ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($selectedstudent_id,$selectgroup_id));
	Database::disconnect();
	echo "<font color='green'>";
	echo "Successfully inserted in to groups!!";
	echo "</font>";		
	}
	Database::disconnect();
?>