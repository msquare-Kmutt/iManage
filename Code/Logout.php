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
		session_destroy();
		header("Location: index.html");
	}
	mysqli_close($con);
?>
