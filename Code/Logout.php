<?php
	include("Connect.php");

	$con = mysqli_connect($host, $username, $password, $databaseName);
	if (mysqli_connect_errno())
	{
		echo "false";
	}
	else
	{
		session_start();
		$userID = mysqli_real_escape_string($con, $_SESSION['username']);
		$userPassword = mysqli_real_escape_string($con, $_SESSION['userPassword']);
		$sql = "SELECT  COUNT(*) AS count, userFirstName FROM userInformation WHERE userID = '" . $userID . "'";
		$result = mysqli_query($con, $sql);
		$out = $result->fetch_array(MYSQLI_ASSOC);
		if($out['count'] == "1")
		{
			session_destroy();
			session_start();
			$_SESSION['log'] = 0;
			header("Location: index.html");
		}
		else
		{
			header("Location: index.html");
		}
		
	}
	mysqli_close($con);
?>
