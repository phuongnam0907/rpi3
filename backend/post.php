<?php
include_once 'config.php';
$content = file_get_contents('php://input');
$js = json_decode($content,true);

$str = "INSERT INTO sensor (Gateway, Node, phValue, tempValue, liqValue, doValue, tdsValue, orpValue, time) VALUES ";
foreach($js as $key=>$value){
	$ga = $value['Gateway'];
	$no = $value['Node'];
	$ph = $value['phValue'];
	$te = $value['tempValue'];
	$li = $value['liqValue'];
	$do = $value['doValue'];
	$td = $value['tdsValue'];
	$or = $value['orpValue'];
	$ti = $value['time'];
	
	$str .= "('$ga', '$no', $ph, $te, $li, $do, $td, $or, $ti);";
}

mysqli_query($conn,$str);
mysqli_close($conn);
?>