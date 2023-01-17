<?php
include('dbcon.php');
if (isset($_POST['backup_delete'])){
$get_id=$_GET['id'];
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($conn,"DELETE FROM class_exam where class_exam_id='$id[$i]'")or die(mysqli_error());
}
?>
<script>
	window.location = "class_exam.php<?php echo '?id='.$get_id; ?>"
</script>
<?php
}
?>