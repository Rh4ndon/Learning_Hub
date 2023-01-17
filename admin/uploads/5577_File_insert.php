<?php

$dbc = mysqli_connect("localhost", "id18495861_admin", "JH_9I-G{Z\<h9^To", "id18495861_hospitalrooms");
if(!$dbc) {
die("DATABASE CONNECTION FAILED:" .mysqli_error($dbc));
exit();
}
$db = "id18495861_hospitalrooms";
$dbs = mysqli_select_db($dbc, $db);
if(!$dbs) {
die("DATABASE SELECTION FAILED:" .mysqli_error($dbc));
exit();
}
$ID = mysqli_real_escape_string($dbc, $_GET['ID']);
$Name = mysqli_real_escape_string($dbc, $_GET['Name']);
$Vacant = mysqli_real_escape_string($dbc, $_GET['Vacant']);
$Occupied = mysqli_real_escape_string($dbc, $_GET['Occupied']);
$Total = mysqli_real_escape_string($dbc, $_GET['Total']);
$query = "INSERT INTO hospitals(ID, Name, Vacant, Occupied, Total) VALUES ('$ID', '$Name', '$Vacant', '$Occupied', '$Total')";
if(mysqli_query($dbc, $query)){
echo "Records added successfully";
} 
else{
echo "ERROR: Could not able to execute". $query." ". mysqli_error($dbc);
}
mysqli_close($dbc);
?>