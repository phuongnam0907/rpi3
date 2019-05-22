<?php
include("config.php");
 
//if everything is fine
 
//creating an array for storing the data 
$heroes = array(); 
 
//this is our sql query 
/*if(@is_null($_GET['id']) || $_GET['id'] == '') $sql = "SELECT * FROM data ORDER BY Time ASC;";
else $sql = "SELECT * FROM data WHERE ID=". $_GET['id'] ." ORDER BY Time ASC;";*/

if((@is_null($_GET['id']) || $_GET['id'] == '') && (@is_null($_GET['gw']) || $_GET['gw'] == '')) $sql = "SELECT * FROM sensor ORDER BY id ASC LIMIT 100;";
else if((@is_null($_GET['id']) || $_GET['id'] == '') && !(@is_null($_GET['gw']) || $_GET['gw'] == '')) $sql = "SELECT * FROM sensor WHERE Gateway=". $_GET['gw'] ." ORDER BY id ASC LIMIT 100;";
else if(!(@is_null($_GET['id']) || $_GET['id'] == '') && (@is_null($_GET['gw']) || $_GET['gw'] == '')) $sql = "SELECT * FROM sensor WHERE Node=". $_GET['id'] ." ORDER BY id ASC LIMIT 100;";
else $sql = "SELECT * FROM sensor WHERE Node=". $_GET['id'] ." AND Gateway = ". $_GET['gw'] ." ORDER BY id ASC LIMIT 100;";

//$sql = "SELECT * FROM sensor ORDER BY id ASC;";

//creating an statment with the query
$stmt = $conn->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($id, $Gateway, $Node, $phValue, $tempValue, $liqValue, $doValue, $tdsValue, $orpValue, $time);
 
//looping through all the records
while($stmt->fetch()){
 
 //pushing fetched data in an array 
 $temp = [
 'id'=>$id, 
 'Gateway'=>$Gateway, 
 'Node'=>$Node, 
 'phValue'=>$phValue, 
 'tempValue'=>$tempValue, 
 'liqValue'=>$liqValue, 
 'doValue'=>$doValue, 
 'tdsValue'=>$tdsValue, 
 'orpValue'=>$orpValue, 
 'time'=>$time
 ];
 
 //pushing the array inside the hero array 
 array_push($heroes, $temp);
}
 
//displaying the data in json format 
echo json_encode($heroes);

mysqli_close($conn);
?>
