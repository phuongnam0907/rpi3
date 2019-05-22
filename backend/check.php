<?php
include("config.php");
$heroes = array(); 

$sql = "SELECT * FROM nodelink;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($no, $ip, $gateway, $dad, $son);
while($stmt->fetch()){
 $temp = [
 	'No'=>$no,
 	'ip'=>$ip,
	'gateway'=>$gateway, 
	'dad'=>$dad,
	'son'=>$son
	];
 
	array_push($heroes, $temp);
}
$ab = array();

for ($i = 0; $i < count($heroes); $i++){
	$isSon = 1;
	$sqlp="";
	for ($j = 0; $j < count($heroes) ; $j++) { 
		if ($heroes[$i]['ip'] == $heroes[$j]['dad']) {
			//echo $heroes[$i]['ip']." ";
			$isSon = 0;
			$j = count($heroes) - 1;
		}
	}
	if (($heroes[$i]['son'] == 1) && ($isSon == 1)) {
		$sqlp = "UPDATE nodelink SET son=0 WHERE No=".$heroes[$i]['No'].";";
		array_push($ab, $sqlp);
	} else if (($heroes[$i]['son'] == 0) && ($isSon == 0)) {
		$sqlp = "UPDATE nodelink SET son=1 WHERE No=".$heroes[$i]['No'].";";
		array_push($ab, $sqlp);
	}
	
}
$sq = "";
for ($k=0; $k < count($ab) ; $k++) { 
	$stmt = $conn->prepare($ab[$k]);
	$stmt->execute();
}

//echo "count: ".count($ab)."<br>";
mysqli_close($conn);
?>
