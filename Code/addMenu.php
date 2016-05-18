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
			$menuID1 = $con->query("SELECT MAX(menuID) AS fd FROM menu WHERE restaurantID ='".$rest["restaurantID"]."'");
			$menuID2 = "F";
			while($rs = $menuID1->fetch_array(MYSQLI_ASSOC))
			{
				$methodID2 = intval(substr($rs["fd"], 1)) + 1;
				$methodID3 = (string)$methodID2;
				
				$size = strlen ($methodID3);	
				if( $size == 1 )
				{
					$menuID2 = $menuID2 . "000" . $methodID3;	
				}
				else if($size == 2)
				{
					$menuID2 = $menuID2 . "00" . $methodID3;	
				}
				else if($size == 3)
				{
					$menuID2 = $menuID2 . "0" . $methodID3;	
				}
				else
				{
					$menuID2 = $menuID2 . $methodID3;
				}
			}

			$menuName 		= mysqli_real_escape_string($con, $_GET['menuName']); 
			$price			= mysqli_real_escape_string($con, $_GET['price']);
			$description	= mysqli_real_escape_string($con, $_GET['description']);
			
			$sql = "INSERT INTO menu(restaurantID, menuID, menuName, menuPrice, menuDetail, statusMenu) VALUES('".$rest["restaurantID"]."','".$menuID2."','".$menuName."','".$price."','".$description."','1')";


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