<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['addCourse']))
	{
		$catnumber = $_POST['catnumber'];
		$cname = $_POST['cname'];
		$clevel = $_POST['clevel'];
		$ccredits = $_POST['ccredits'];
		$csubj = $_POST['csubj'];
		$deptid = $_POST['dept'];

		$query = "INSERT INTO Courses(deptid,catalognumber,coursename,courselevel,coursecredits,coursesubject) VALUES(?,?,?,?,?,?)";

		$statement = $db->prepare($query);

		$statement->bindParam(1,$deptid,PDO::PARAM_STR);
		$statement->bindParam(2,$catnumber,PDO::PARAM_STR);
		$statement->bindParam(3,$cname,PDO::PARAM_STR);
		$statement->bindParam(4,$clevel,PDO::PARAM_STR);
		$statement->bindParam(5,$ccredits,PDO::PARAM_STR);
		$statement->bindParam(6,$csubj,PDO::PARAM_STR);

		$statement->execute();
	}
?>	