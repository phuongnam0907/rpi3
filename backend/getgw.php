<?php
include("config.php");
 
//if everything is fine
 
//creating an array for storing the data 
$heroes = array(); 
 
//this is our sql query 
/*if(@is_null($_GET['id']) || $_GET['id'] == '') $sql = "SELECT * FROM data ORDER BY Time ASC;";
else $sql = "SELECT * FROM data WHERE ID=". $_GET['id'] ." ORDER BY Time ASC;";*/

$sql = "SELECT DISTINCT Gateway, Node FROM sensor ORDER BY Gateway ASC;";

//$sql = "SELECT * FROM sensor ORDER BY id ASC;";

//creating an statment with the query
$stmt = $conn->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($Gateway, $Node);
 
//looping through all the records
while($stmt->fetch()){
 
 //pushing fetched data in an array 
 $temp = [
 'Gateway'=>$Gateway, 
 'Node'=>$Node
 ];
 
 //pushing the array inside the hero array 
 array_push($heroes, $temp);
}
 
//displaying the data in json format 
echo json_encode($heroes);

mysqli_close($conn);
?>
