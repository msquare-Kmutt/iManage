<?php
	include("Connect.php");

	$con = mysqli_connect($host, $username, $password, $databaseName);
	if (mysqli_connect_errno())
	{
		echo "DB";
	}
	else
	{
		$userID = mysqli_real_escape_string($con, $_GET['username']);
		$userPassword = mysqli_real_escape_string($con, $_GET['password']);
		$sql = "SELECT COUNT(*) AS count FROM userInformation WHERE userID = '" . $userID. "'";
		$result = mysqli_query($con, $sql);
		$out = $result->fetch_array(MYSQLI_ASSOC);
		if($out['count'] == "1")
		{
			$sql = "SELECT password FROM userPassword WHERE userID = '" . $userID. "'";
			$result = mysqli_query($con, $sql);
			$out = $result->fetch_array(MYSQLI_ASSOC);
			if($out['password'] == $userPassword){
				echo "PASS";
				session_start();
				session_destroy();
				session_start();
				$_SESSION['log'] = 1;
				$_SESSION['username'] = $userID;
				$_SESSION['userPassword'] = $userPassword;
			}
			else
			{
				echo "fail";
			}	
		}
		else
		{
			echo "fail";
		}
	}
	mysqli_close($con);
?>