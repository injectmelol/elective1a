<?php
	include_once 'dbconfig.php';
	$query = "SELECT * FROM GROUPS where groupid <> 1";
	$statement = $db->prepare($query);
	$statement->execute();

	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	print_r($result);
	if(isset($_POST['register']))
	{
		$query = "SELECT username FROM users WHERE username ='".$_POST['username']."';";
		$statement = $db->prepare($query);
		$statement->execute();
		$row = $statement->rowCount();
		if ($row > 0)
		{
			echo "nana na nga username";
		}
		else
		{
			if($_POST['password'] === $_POST['password2'])
			{
				$username = $_POST['username'];
				$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
				$id = $_POST['groups'];
				$query = "INSERT INTO users (username,password)
				VALUES (:username,:password);";

				$statement = $db->prepare($query);
				$statement->bindParam(":username",$username,PDO::PARAM_STR);
				$statement->bindParam(":password",$password,PDO::PARAM_STR);

				$statement->execute();

				$query = "INSERT INTO usergroups(userid,groupid)
				VALUES (:userid, :groupid);";
				$uid = $db->lastInsertId();
				$statement = $db->prepare($query);
				$statement->bindParam(":userid",$uid,PDO::PARAM_INT);
				$statement->bindParam(":groupid",$id,PDO::PARAM_INT);

				$statement->execute();
				echo "ok na";
			}
			else
			{
				echo "wa nagka dimao ang password";
			}
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CATFIS | Register</title>
		<link rel="stylesheet" type="text/css" href="styles/register.css">
	</head>
	<body>
		<header>
			<h1>CATFIS</h1>
		</header>
		<section>
			<article>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<h1>Create a CATFIS account</h1>
	   			<select name="groups" id = "dept" required="">
	        		<option hidden disabled="" selected="">Select Group</option>
	        		<?php
	        		foreach($result as $option)
	        		{
	        			echo "<option value = ".$option['groupId'].">".$option['groupName']."</option>";
	        		}
	        		?>
	   		   </select><br>
				<input type="text" name="username" placeholder="Username" required="required"><br>
				<input type="password" name="password" placeholder="Password" required="required"><br>
				<input type="password" name="password2" placeholder="Confirm Password" required="required"><br>
				<input type="submit" name="register" value="Register">
				</form>
				<p>Already have an account?<a href="login.php"><u>Login Here</u></a>
			</article>
		</section>
	</body>

</html>	