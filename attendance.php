<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<?php
	@include 'dbcon.php';

	 if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
		$section = mysqli_real_escape_string($conn, $_POST['section']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $dateofat = mysqli_real_escape_string($conn, $_POST['dateofat']);
		$class_id = mysqli_real_escape_string($conn, $_POST['class_id']);

        $select = " SELECT * FROM attendance WHERE name = '$name' && section = '$section' && gender = '$gender' && dateofat = '$dateofat' && class_id = '$class_id'";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
        	$error[] = 'Your attendance is already recorded';
        }else {
        	$insert = "INSERT INTO attendance(name,section,gender,dateofat,class_id) VALUES ('$name','$section','$gender','$dateofat','$class_id')";

        	mysqli_query($conn, $insert);
            header('location:attendance.php?id='.$get_id);
        }
	 };
?>


<body>
	<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('attendance_student_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
								<!-- breadcrumb -->
									<?php $class_query = mysqli_query($conn,"select * from teacher_class
									LEFT JOIN class ON class.class_id = teacher_class.class_id
									LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
									where teacher_class_id = '$get_id'")or die(mysqli_error());
									$class_row = mysqli_fetch_array($class_query);
									?>
												
									<ul class="breadcrumb">
										<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
										<li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
										<li><a href="#">School Year: <?php echo $class_row['school_year']; ?></a> <span class="divider">/</span></li>
										<li><a href="#"><b>Class Attendance</b></a></li>
									</ul>
									<!-- end breadcrumb -->



	<!-- block -->								
	<div id="block_bg" class="block">
        <div class="navbar navbar-inner block-header">
				<div id="" class="muted pull-left"><h4> Attendance</h4></div>
			</div>
                
				<div class="block-content collapse in">
						<div class="span12">
					
    					<form action="" method="post">
    					<?php
                            if(isset($error)){
                                foreach($error as $error){
                                    echo '<span class="text-warning">'.$error.'</span>';
                                }
                            }
                        ?>


						<div class="col mb-3">
                            <input type="text" name="name" class="form-control" required placeholder="Student Name">
                        </div>
						<div class="col mb-3">
							<select  name="section" class="form-control" required placeholder="Section">
                                             	<option></option>
											<?php
											$cys_query = mysqli_query($conn,"select * from class order by class_name");
											while($cys_row = mysqli_fetch_array($cys_query)){
											
											?>
											<option value="<?php echo $cys_row['class_name']; ?>"><?php echo $cys_row['class_name']; ?></option>
											<?php } ?>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <input type="text" name="gender" class="form-control" required placeholder="Gender">
                        </div>
                        <div class="col mb-3">
                            <input type="date" name="dateofat" class="form-control" required placeholder="Date">
                        </div>
                        <div class="col mb-3">
                            <input type="submit" value="submit" name="submit" class="btn btn-primary">
                        </div>
						
                        <input type="hidden" name="class_id" value="<?php echo $get_id; ?>">



    					</form>
						</div>
						</div>
				</div>
	</div>	
	<!-- block -->	

	<div id="block_bg" class="block">
        <div class="navbar navbar-inner block-header">
				<div id="" class="muted pull-left"><h4> List of Attendance</h4></div>
			</div>
            <div class="block-content collapse in">
            <div class="span12">
		
    			<table class="table table-primary ">
    				<thead>
						
						<th>Name</th>
						<th>Year & Section</th>
						<th>Gender</th>
						<th>Date</th>
					</thead>
					<tbody>
						<?php
										$query = mysqli_query($conn,"select * FROM attendance where class_id = '$get_id' ")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['id'];
										
									?>  
							<tr>
								
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['section']; ?></td>
								<td><?php echo $row['gender']; ?></td>
								<td><?php echo $row['dateofat']; ?></td>

							</tr>
						<?php
							}
						?>
					</tbody>
    			</table>
			</div>
			</div>

    		
	

<!-- block -->





		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
		<?php include('class_calendar_script.php'); ?>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>