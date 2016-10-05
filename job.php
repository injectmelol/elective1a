<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['addJob']))
	{
		$job = $_POST['jobtype'];
		$query = "INSERT INTO Jobs(JobType) VALUES(?)";

		$statement = $db->prepare($query);

		$statement->bindParam(1,$job,PDO::PARAM_STR);

		$statement->execute();
	}
?>