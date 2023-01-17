<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<body>
<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('attendance_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
						<div class="pull-right">
							
							<a onclick="window.open('print_attendance.php<?php echo '?id='.$get_id; ?>')"  class="btn btn-success"><i class="icon-list"></i> Print Attendance Records</a>
						</div>
						<?php include('attendance_students_breadcrums.php'); ?>
								


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
						<th>Section</th>
						<th>Gender</th>
						<th>Date</th>
						<th>ACTION</th>
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

								<td> 
									<button class="btn-danger btn"> 
										<a class="text-decoration-none text-light" href="deleteattendance.php?id=<?php echo $row['id']; ?>" class="text-white"> Delete </a>  
									</button>
								</td>

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