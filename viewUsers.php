<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['view']))
	{
		$query = "SELECT * from Person p 
		LEFT JOIN FacultyMember fm 
		on p.personid = fm.personid 
		where fm.facultyid is null";

		$query = "SELECT * from Person p 
		inner JOIN FacultyMember fm 
		on p.personid = fm.personid";


	}
?>