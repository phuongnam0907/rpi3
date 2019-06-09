<?php
	echo "
	//******* NOTE *******// <br>
	<===> Table name reset:<br>
	../rpi3/backend/node.php?table=___	<br>
	1. sensor <br>
	1. nodelink <br>
	//********************//<br><hr><br>
	";

include("config.php");

if ((@$_GET['table'] !== "sensor") && @$_GET['table'] !== "nodelink") echo "Reset TABLE ' ".$_GET['table']." ' failed!!!!";
else {
	$sql = "DROP TABLE ".$_GET['table'].";";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	$sqla = "CREATE TABLE ".$_GET['table']." (
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Gateway varchar(50) DEFAULT NULL,
	Node varchar(50) DEFAULT NULL,
	phValue float UNSIGNED NOT NULL,
	tempValue float UNSIGNED NOT NULL,
	liqValue float UNSIGNED NOT NULL,
	doValue float UNSIGNED NOT NULL,
	tdsValue int(10) UNSIGNED NOT NULL,
	orpValue float UNSIGNED NOT NULL,
	time int(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	$sqlb = "CREATE TABLE ".$_GET['table']." (
	No int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ip varchar(50) DEFAULT NULL,
	gateway varchar(50) DEFAULT NULL,
	dad varchar(50) DEFAULT NULL,
	son tinyint(1) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


	if (@$_GET['table'] == "sensor") $sss = $sqla;
	else if (@$_GET['table'] == "nodelink") $sss = $sqlb;
	else $sss="";

	if ($conn->query($sss) === TRUE) {
    		echo "Table ".$_GET['table']." reset successfully";
	} else {
    		echo "Error creating table: " . $conn->error;
	}
}
mysqli_close($conn);
?>
