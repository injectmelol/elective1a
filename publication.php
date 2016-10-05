<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['addPublication']))
	{

		$pubtitle = $_POST['pubtitle'];
		$articletitle = $_POST['article/chapter'];
		$volandpage = $_POST['volandpage'];
		$pubname = $_POST['pubname'];
		$publocation = $_POST['publocation'];
		$publink = $_POST['publink'];
		$pubstatus = $_POST['pubstatus'];
		$citation = $_POST['citation'];
		$patentdate = $_POST['patentdate'];
		$patentnum = $_POST['patentnum'];
		$type = $_POST['type'];
		$query = "INSERT INTO Publication(publicationtitle,articleorchaptertitle,volandpagecite,publishername,publicationlocation,
		publicationhyperlink,publicationstatus,citationdate,patentapplicationdate,patentnumber,publicationtypeid) 
		VALUES(?,?,?,?,?,?,?,?,?,?,?)";

		$statement = $db->prepare($query);

		$statement->bindParam(1,$pubtitle,PDO::PARAM_STR);
		$statement->bindParam(2,$articletitle,PDO::PARAM_STR);
		$statement->bindParam(3,$volandpage,PDO::PARAM_STR);
		$statement->bindParam(4,$pubname,PDO::PARAM_STR);
		$statement->bindParam(5,$publocation,PDO::PARAM_STR);
		$statement->bindParam(6,$publink,PDO::PARAM_STR);
		$statement->bindParam(7,$pubstatus,PDO::PARAM_STR);
		$statement->bindParam(8,$citation,PDO::PARAM_STR);
		$statement->bindParam(9,$patentdate,PDO::PARAM_STR);
		$statement->bindParam(10,$patentnum,PDO::PARAM_STR);
		$statement->bindParam(11,$type,PDO::PARAM_INT);

		$statement->execute();
	}
?>