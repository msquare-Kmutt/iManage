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
		$sql = "SELECT  COUNT(*) AS count, userFirstName FROM userInformation WHERE userID = '" . $userID . "'";
		$result = mysqli_query($con, $sql);
		$out = $result->fetch_array(MYSQLI_ASSOC);
		if($out['count'] == "1")
		{
			echo $out['userFirstName'];
		}
		else
		{
			header("Location: Index.html");
			echo "false";
		}
	}
	mysqli_close($con);
?>