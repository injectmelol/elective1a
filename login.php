<?php
	include_once 'dbconfig.php';
	session_start();
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT userName,password,U.userid,groupid FROM users as U
		INNER JOIN usergroups as G
		on U.userid = G.userid 		 
		WHERE username='".$username."';";
		$statement = $db->prepare($query);
		$statement->execute();
		$rowCount = $statement->rowCount();
		if($rowCount > 0)
		{	
			$result = $statement->fetch(PDO::FETCH_ASSOC);

			if(password_verify($password,$result['password']))
			{
			echo $result['userName'];
			echo $result['groupid'];	
			$_SESSION['username'] = $result['userName'];
			$_SESSION['id'] = $result['userid'];
			echo $_SESSION['username'];
			header("Location: home.php");
			}
			else
			{
				echo "sayop pass";
			}
		}
		else
		{
			echo "wala ni siya na user";
		}


	}



?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CATFIS | Login</title>
		<link rel="stylesheet" type="text/css" href="styles/login.css">
	</head>
	<body>
		<header>
			<h1>CATFIS</h1>
		</header>
		<section>
			<article>
				<h1>Sign in to your CATFIS ACCOUNT</h1>
				<form action="" method="POST">
				<input type="text" name="username" placeholder="Username" required="required"><br>
				<input type="password" name="password" placeholder="Password" required="required"><br>
				<input type="submit" name="login" value="Login">
				</form>
				<p>Don't have an account yet?<a href="register.php"><u>Register Here</u></a>
			</article>
		</section>
	</body>

</html>	