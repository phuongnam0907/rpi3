<?php
	echo "
	//*********************************	NOTE ************************************// <br>
	<===> Add new node:<br>
	../rpi3/backend/node.php?method=addnew&gateway=___&id=___&dad=___	<br>
	<===> Delete exit node:<br>
	../rpi3/backend/node.php?method=delete&gateway=___&id=__ <br> 
	<===> Add new gateway:<br>
	../rpi3/backend/node.php?method=addgateway&gateway=___ <br>
	<===> Delete exit gateway:<br>
	../rpi3/backend/node.php?method=deletegateway&gateway=___ <br>
	<===> Update: NO CODE<br>
	../rpi3/backend/node.php?method=update <br>
	//***************************************************************************//<br><hr><br>
	";
	require_once "config.php";

	$heroes = array(); 
	$sql = "SELECT * FROM nodelink ORDER BY No ASC;";
	$stmt = $conn->prepare($sql);						 
	$stmt->execute();
	$stmt->bind_result($No, $ip, $gateway, $dad, $son);
	while($stmt->fetch()){
		$temp = [
			'No'=>$No,
			'gateway'=>$gateway,
			'ip'=>$ip,
			'dad'=>$dad,
			'son'=>$son
		];
		array_push($heroes, $temp);
	}
	$json = json_encode($heroes);

	if (@$_GET['method'] == "addnew") 
	{


		if ((@$_GET['gateway'] == "") || (@$_GET['id'] == "") || (@$_GET['dad'] == "")) 
		{
			echo "Missing some parameters!";
		} else {
			$isOK = 0;
			for ($i=0; $i < count($heroes) ; $i++) { 
				if ($_GET['gateway'] == $heroes[$i]['gateway']) {
					$isOK = 1;
					$i = count($heroes) - 1;
				}
			}
			if ($isOK == 1) {
				for ($i=0; $i < count($heroes) ; $i++) { 
					if (($_GET['gateway'] === $heroes[$i]['gateway']) && ($_GET['id'] !== $_GET['dad'])  && ($_GET['dad'] === $heroes[$i]['ip'])) {
						$isOK = 0;
					}
				}
				if ($isOK == 0) {
					for ($i=0; $i < count($heroes) ; $i++) { 
						if ($_GET['id'] === $heroes[$i]['ip']) {
							$isOK = 1;
						}
					}
				}
				
				if ($isOK == 0) {
					echo "Adding new node ID = ".@$_GET['id']." by: ".@$_GET['method']."!";
					$sqla = "INSERT INTO nodelink (No, ip, gateway, dad, son) VALUES ('".(count($heroes)+1)."','".$_GET['id']."','".$_GET['gateway']."','".$_GET['dad']."','0');";
					//echo $sqla;
					$stmt = $conn->prepare($sqla);						 
					$stmt->execute();
					require_once "check.php";
				} else echo "Error adding new node.";
			} else echo "Error adding new node - Wrong gateway.";
		}



	} else if (@$_GET['method'] == "delete") 
	{


		if ((@$_GET['gateway'] == "") || (@$_GET['id'] == "")) 
		{
			echo "Missing some parameters!";
		} else if ($_GET['gateway'] === $_GET['id']) {
			echo "Cannot delete gateway";
		} else {
			$isOK = 0;
			for ($i=0; $i < count($heroes); $i++) { 
				if ($_GET['gateway'] === $heroes[$i]['gateway']) {
					$isOK = 1;
					$i = count($heroes) - 1;
				}
			}
			if ($isOK == 1) {
				$isOK = 0;
				$index = -1;
				$dad = "";
				for ($i=0; $i < count($heroes); $i++) { 
					if (($_GET['id'] === $heroes[$i]['ip']) && ($_GET['gateway'] === $heroes[$i]['gateway'])) {
						$isOK = 1;
						$index = $i;
						$dad = $heroes[$i]['dad'];
						$i = count($heroes) - 1;
					}
				}
				if (($isOK == 1) && ($index != -1)) {
					echo "Deleting exit node ID = ".@$_GET['id']." at index = ".$index." by: ".@$_GET['method']."!";
					$sqla = "DELETE FROM nodelink WHERE No=".($index+1).";";
					// echo $sqla."<br>";
					$stmt = $conn->prepare($sqla);						 
					$stmt->execute();
					$sqlu = "UPDATE nodelink SET dad=".$dad." WHERE dad=".$_GET['id'].";";
					// echo $sqlu."<br>";
					$stmt = $conn->prepare($sqlu);						 
					$stmt->execute();
					for ($i=($index+1); $i <= count($heroes); $i++) { 
						$sqlp = "UPDATE nodelink SET No=".($i-1)." WHERE No=".$i.";";
						$stmt = $conn->prepare($sqlp);						 
						$stmt->execute();
					}
					require_once "check.php";
				} else echo "Node deleting isn't exit or in different gateway.";
			} else echo "Error delete node - Wrong gateway.";
		}
		





	} else if (@$_GET['method'] == "update") 
	{


		echo "Error page...";


		// if (@$_GET['id'] == "")
		// {
		// 	echo "Updating exit node by: ".@$_GET['method']."!";
		// } else echo "Updating exit node ID = ".@$_GET['id']." by: ".@$_GET['method']."!";
		




	} else if (@$_GET['method'] == "addgateway") {
		if (@$_GET['gateway'] == ""){
			echo "Missing GATEWAY parameter!";
		} else {
			$isOK = 1;
			for ($i=0; $i < count($heroes); $i++) { 
				if ($_GET['gateway'] === $heroes[$i]['gateway']) {
					$isOK = 0;
					$i = count($heroes) - 1;
				}
			}
			if ($isOK == 1) {
				$sqla = "INSERT INTO nodelink (No, ip, gateway, dad, son) VALUES ('".(count($heroes)+1)."','".$_GET['gateway']."','".$_GET['gateway']."','','0');";
				echo "Insert gateway no.".$_GET['gateway'];
				$stmt = $conn->prepare($sqla);						 
				$stmt->execute();
				require_once "check.php";
			} else echo "Gateway is exit. Error!";
		}


	} else if (@$_GET['method'] == "deletegateway") {
		if (@$_GET['gateway'] == ""){
			echo "Missing GATEWAY parameter!";
		} else {
			$isOK = 0;
			for ($i=0; $i < count($heroes); $i++) { 
				if ($_GET['gateway'] === $heroes[$i]['gateway']) {
					$isOK = 1;
					$i = count($heroes) - 1;
				}
			}
			if ($isOK == 1) {
				$sqla = "DELETE FROM nodelink WHERE gateway=".$_GET['gateway'].";";
				$stmt = $conn->prepare($sqla);						 
				$stmt->execute();

				$abcd = array(); 
				$sqld = "SELECT * FROM nodelink ORDER BY No ASC;";
				$stmt = $conn->prepare($sqld);						 
				$stmt->execute();
				$stmt->bind_result($No, $ip, $gateway, $dad, $son);
				while($stmt->fetch()){
					$temp = [
						'No'=>$No,
						'gateway'=>$gateway,
						'ip'=>$ip,
						'dad'=>$dad,
						'son'=>$son
					];
					array_push($abcd, $temp);
				}

				echo "Count: ".count($abcd);

				for ($i=0; $i < count($abcd); $i++) { 
					$sqlu = "UPDATE nodelink SET No=".($i+1)." WHERE ip=".$abcd[$i]['ip'].";";
					//echo $sqlu."<br>";
					$stmt = $conn->prepare($sqlu);						 
					$stmt->execute();
				}

				require_once "check.php";
			} else echo "Not exit gateway ".$_GET['gateway']."!";
		} 
	} else {
		echo "NULL: ".@$_GET['method']."!";
	}

	@mysqli_close($conn);
?>