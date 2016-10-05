<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['addDept']))
	{
		$deptname = $_POST['deptname'];
		$query = "INSERT INTO Department(Deptname) VALUES(?)";

		$statement = $db->prepare($query);

		$statement->bindParam(1,$deptname,PDO::PARAM_STR);

		$statement->execute();
	}
?>