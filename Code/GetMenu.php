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
			$menu = $con->query("SELECT menuID, menuName, menuPrice, menuDetail FROM menu WHERE restaurantID ='".$rest["restaurantID"]."'");
			$out = "[";
			while($rs = $menu->fetch_array(MYSQLI_ASSOC))
			{
			    if ($out != "[")
			    {
			    	$out .= ",";
			    }
			    $out .= '{"menuID":"' . $rs["menuID"] . '",';
				$out .= '"menuName":"' . $rs["menuName"] . '",';
				$out .= '"menuPrice":"' . $rs["menuPrice"] . '",';
				$out .= '"menuDetail":"' . $rs["menuDetail"] . '"}';
			}
			$out .= "]";
			echo $out;
		}
		else
		{
			echo "false";
		}		
	}
	mysqli_close($con);
?>