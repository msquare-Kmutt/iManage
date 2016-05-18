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
			$restID = $con->query("SELECT restaurantID FROM restaurantInformation WHERE ownerID = '" . $userID . "'");
			$rest = $restID->fetch_array(MYSQLI_ASSOC);
			$menuID = mysqli_real_escape_string($con, $_GET['menuID']);
			$sql = "DELETE FROM menu WHERE menuID ='". $menuID ."' AND restaurantID = '".$rest["restaurantID"]."'";
			if (mysqli_query($con, $sql))
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			echo "false";
		}		
	}
	mysqli_close($con);
?>
