<?php
session_start();
?>
<html>
<head><title> Home </title>
<link rel = "stylesheet" href = "jquery-ui.css">
</head>
<body>
<h1><?php echo $_SESSION['username']; ?></h1>
<div>
	<form action = "register.php" method = "get">
		<input type ="submit" value = "Add User">
	</form>
	<form action = "viewUsers.php" method = "get">
		<input type ="submit" value = "View Faculty">
	</form>
		<input type = "button" id = "showDialog" value = "Update Information">
	<div id = "dialog" title ="Update Information">
	<form id = "UI-form" action = "updateinfo.php" method = "post">
		First Name</br><input type = "text" name = "lname" required>
		M.I<input type = "text" name = "mi" required>
		Last Name<input type = "text" name = "fname" required></br>
		Title</br><input type = "text" name = "title" required></br>
				<input type="submit" name="basicupdate" value="Update Basic Information ">
	</form>
	<form action = "updateinfo.php" method = "post">
	SSN <input type = "text" name = "ssn" required></br>
	HomeStreetAddress <input type = "text" name = "homestreetadd" required></br>
	HomeCity <input type = "text" name = "homecity" required></br>
	HomeZip	<input type = "text" name = "homezip" required></br>
	HomePhone <input type = "text" name = "homephone" required></br>
	DayTimePhone <input type = "text" name = "daytime" required> </br>
	AdjunctHireDate <input type = "date" name = "adjunct" required></br>
	FullTimeHireDat <input type = "date" name = "fulltime" required></br>
	RetireDate <input type = "date" name = "retire" required></br>
	emailAddress <input type = "text" name = "email" required> </br>
	DOB <input type = "date" name = "dob" required></br>
				<input type="submit" name="facultyupdate" value="Update Faculty Information ">
	</form>
	</div>
</div>
<script src = "jquery-2.2.3.min.js"></script>
<script src = "jquery-ui.min.js"></script>
<script type = "text/javascript">
 (function()
 {
 	$("#dialog").dialog({
			autoOpen: false,
			modal: true,
			height: 500,
			width: 500,
			resizable: false,
			buttons: {
				"Confirm": function()
				{

					$(this).dialog('close');
				},
				"Cancel": function()
				{
					$(this).dialog('close');
				}
			}
	});


	$("#showDialog").on('click', function()
	{
		$('#UI-form').trigger("reset")
		$("#dialog").dialog('open');
	});
 	$("#date").datepicker();	
 }())
</script>
</body>
</html