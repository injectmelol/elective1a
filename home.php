<?php
	include_once 'dbconfig.php';
	session_start();
	
	$query = "SELECT personid from Person where userid = ?";

	$statement = $db->prepare($query);

	$id = $_SESSION['id'];

	$statement->bindParam(1,$id,PDO::PARAM_INT);
	$statement->execute();

	$result = $statement->fetch(PDO::FETCH_ASSOC);

	$personid = $result['personid'];

	echo $personid;

	$query = "SELECT * FROM Department";

	$statement = $db->prepare($query);
	$statement->execute();

	$deptresult = $statement->fetchAll(PDO::FETCH_ASSOC);

	$query = "SELECT * FROM PublicationType";

	$statement = $db->prepare($query);
	$statement->execute();

	$pubtyperesult = $statement->fetchAll(PDO::FETCH_ASSOC);

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
	<input type = "button" id = "showDeptDialog" value = "Make a Department">
	<div id = "deptDialog" title ="Department">
	<form action = "department.php" method = "post">
			Department Name</br><input type = "text" name = "deptname" required>
			<input type ="submit" name = "addDept" value = "Add Department">
	</form>
	</div>

	<input type = "button" id = "showJobsDialog" value = "Add a Job">
	<div id = "jobDialog" title ="Job">
	<form action = "job.php" method = "post">
			Job Type</br><input type = "text" name = "jobtype" required>
			<input type ="submit" name = "addJob" value = "Add Job">
	</form>
	</div>

	<input type = "button" id = "showGrantDialog" value = "Add a Grant/Award">
	<div id = "grantDialog" title ="Grants/Awards">
	<form action = "grant.php" method = "post">
			Grant Title</br><input type = "text" name = "title" required><br>
			Grant Description</br><input type = "text" name = "desc" required><br>
			Sponsor</br><input type = "text" name = "sponsor" required><br>	
			<input type="radio" name="grant" value="A" checked> Award<br>
 			<input type="radio" name="grant" value="G"> Grant<br>
			<input type ="submit" name = "addGrant" value = "Add Grant/Award">
	</form>
	</div>

	<input type = "button" id = "showPubDialog" value = "Add Publication">
	<div id = "publicationDialog" title ="Make a Publication">
	<form action = "publication.php" method = "post">
			Publication Title</br><input type = "text" name = "pubtitle" required><br>
			Article or Chapter Title</br><input type = "text" name = "article/chapter" required><br>
			Vol and Page Citation</br><input type = "text" name = "volandpage" required><br>	
			Publisher Name</br><input type = "text" name = "pubname" required><br>
			Publication Location</br><input type = "text" name = "publocation" required><br>
			Publication Hyperlink</br><input type = "text" name = "publink" required><br>	
			Publication Status</br><input type = "text" name = "pubstatus" required="" ired><br>
			Citation Date</br><input type = "text" name = "citation" required><br>
			Patent Application Date </br><input type = "date" name = "patentdate" required><br>	
			Patent Number</br><input type = "text" name = "patentnum" required><br>	
   			<select name="type" required="">
        		<option hidden disabled="" selected="">Select Publicaton Type</option>
        		<?php
        		foreach($pubtyperesult as $option)
        		{
        			echo "<option value = ".$option['PublicationTypeID'].">".$option['PublicationTypeDesc']."</option>";
        		}
    			?>
   		   </select><br> 
			<input type ="submit" name = "addPublication" value = "Add Publication">
	</form>
	</div>

	<input type = "button" id = "showCourseDialog" value = "Add Course">
	<div id = "courseDialog" title ="Add a Course">
	<form action = "course.php" method = "post">
			CatalogNumber</br><input type = "text" name = "catnumber" required><br>
			Course Name</br><input type = "text" name = "cname" required><br>
			Course Level</br><input type = "text" name = "clevel" required><br>	
			Course Credits</br><input type = "text" name = "ccredits" required><br>
			Course Subject</br><input type = "text" name = "csubj" required><br>	
   			<select name= "dept" required="">
        		<option hidden disabled="" selected="">Select Department</option>
        		<?php
        		foreach($deptresult as $option)
        		{
        			echo $option['DeptID'];
        			echo "<option value = ".$option['DeptID'].">".$option['DeptName']."</option>";
        		}
        		?>
   		    </select><br>			
			<input type ="submit" name = "addCourse" value = "Add Course">
	</form>
	</div>

	<form action = "viewUsers.php" method = "get">
		<input type ="submit" name = "view" value = "View Faculty Repository">
	</form>

	<input type = "button" id = "showInfoDialog" value = "Update Information">
	<div id = "infoDialog" title ="Update Information">
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
 	$("#infoDialog").dialog({
			autoOpen: false,
			modal: true,
			height: 100,	
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
	$("#showInfoDialog").on('click', function()
	{
		$("#infoDialog").dialog('open');
	});


 	$("#deptDialog").dialog({
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
	$("#showDeptDialog").on('click', function()
	{
		$("#deptDialog").dialog('open');
	});


 	$("#jobDialog").dialog({
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
	$("#showJobsDialog").on('click', function()
	{
		$("#jobDialog").dialog('open');
	});


 	$("#grantDialog").dialog({
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
	$("#showGrantDialog").on('click', function()
	{
		$("#grantDialog").dialog('open');
	});


 	$("#courseDialog").dialog({
			autoOpen: false,
			modal: true,
			height: 500,
			width: 1000,
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


	$("#showCourseDialog").on('click', function()
	{
		$("#courseDialog").dialog('open');
	});

 	$("#publicationDialog").dialog({
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
	$("#showPubDialog").on('click', function()
	{
		$("#publicationDialog").dialog('open');
	});


 }())
</script>
</body>
</html