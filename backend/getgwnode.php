<?php
include("config.php");

$heroes = array(); 

$sql = "SELECT DISTINCT Gateway, Son FROM nodelink wHERE dad='' ORDER BY Gateway ASC;";

//$sql = "SELECT * FROM sensor ORDER BY id ASC;";

//creating an statment with the query
$stmt = $conn->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($gateway,$son);
 
//looping through all the records
while($stmt->fetch()){
 
 //pushing fetched data in an array 
 $temp = [
 'gateway'=>$gateway,
 'son'=>$son
 ];
 
 //pushing the array inside the hero array 
 array_push($heroes, $temp);
}
echo json_encode($heroes);
mysqli_close($conn);
?>

