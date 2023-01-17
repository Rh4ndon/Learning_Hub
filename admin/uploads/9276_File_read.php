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

$query = "SELECT * FROM `hospitals`";
$res = mysqli_query($dbc,"SELECT * FROM `hospitals`");
$row = mysqli_fetch_array($res);



if(mysqli_query($dbc, $query)){


} 
else{
echo "ERROR: Could not able to execute". $query." ". mysqli_error($dbc);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <title>Document</title>
</head>
<body>
<section>Available Rooms and Total Rooms</h2>
<div class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
  <thead>
  <tr>
    <th>ID.</th>
    <th>Name</th>
    <th>Available Rooms</th>
    <th>Occupied</th>
    <th>Total Rooms</th>
  </tr>
  </thead>
<tbody>
<?php
while($data = mysqli_fetch_array($res))
{
?>
  <tr>
    <td><?php echo $data['ID']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['Vacant']; ?></td>
    <td><?php echo $data['Occupied']; ?></td>
    <td><?php echo $data['Total']; ?></td>
  </tr>	
<?php
}
?>
</tbody>
</table>
</div>
</section>
</body>
</html>



<php
mysqli_close($dbc);
?>