<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['addGrant']))
	{

		$title = $_POST['title'];
		$description = $_POST['desc'];
		$sponsor = $_POST['sponsor'];
		$grantoraward = $_POST['grant'];
		$query = "INSERT INTO Grants(GrantTitle,GrantDescription,Awardsponsor,GrantorAward) VALUES(?,?,?,?)";

		$statement = $db->prepare($query);

		$statement->bindParam(1,$title,PDO::PARAM_STR);
		$statement->bindParam(2,$description,PDO::PARAM_STR);
		$statement->bindParam(3,$sponsor,PDO::PARAM_STR);
		$statement->bindParam(4,$grantoraward,PDO::PARAM_STR);

		$statement->execute();
	}
?>