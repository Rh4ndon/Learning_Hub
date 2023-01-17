<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('exam_sidebar_teacher.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					    <!-- breadcrumb -->	
									<ul class="breadcrumb">
										<?php
										$school_year_query = mysqli_query($conn,"select * from school_year order by school_year DESC")or die(mysqli_error());
										$school_year_query_row = mysqli_fetch_array($school_year_query);
										$school_year = $school_year_query_row['school_year'];
										?>
											<li><a href="#"><b>My Class</b></a><span class="divider">/</span></li>
										<li><a href="#">School Year: <?php echo $school_year_query_row['school_year']; ?></a><span class="divider">/</span></li>
										<li><a href="#"><b>Exam</b></a></li>
									</ul>
						 <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<div class="pull-right">
									<a href="teacher_exam.php" class="btn btn-info"><i class="icon-arrow-left"></i> Back</a>
									</div>
								<?php
								$query = mysqli_query($conn,"select * from exam where exam_id = '$get_id'")or die(mysqli_error());
								$row  = mysqli_fetch_array($query);
								
								?>
									    <form class="form-horizontal" method="post">
										<div class="control-group">
											<label class="control-label" for="inputEmail">Exam Title</label>
											<div class="controls">
											<input type="hidden" name="exam_id" value="<?php echo $row['exam_id']; ?>" id="inputEmail" placeholder="Exam Title">
											<input type="text" name="exam_title" value="<?php echo $row['exam_title']; ?>" id="inputEmail" placeholder="Exam Title">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputPassword">Exam Description</label>
											<div class="controls">
											<input type="text" value="<?php echo $row['exam_description']; ?>" class="span8" name="description" id="inputPassword" placeholder="Exam Description" required>
											</div>
										</div>										
										<div class="control-group">
										<div class="controls">										
										<button name="save" type="submit" class="btn btn-success"><i class="icon-save"></i> Save</button>
										</div>
										</div>
										</form>									
										<?php
										if (isset($_POST['save'])){
										$exam_id = $_POST['exam_id'];
										$exam_title = $_POST['exam_title'];
										$description = $_POST['description'];
										mysqli_query($conn,"update exam set exam_title = '$exam_title',exam_description = '$description' where exam_id = '$exam_id'")or die(mysqli_error());
										?>
										<script>
										window.location = 'teacher_exam.php';
										</script>
										<?php
										}
										?>							
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>