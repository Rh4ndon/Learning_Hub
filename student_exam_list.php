<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('student_exam_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					    <!-- breadcrumb -->
										<?php $class_query = mysqli_query($conn,"select * from teacher_class
										LEFT JOIN class ON class.class_id = teacher_class.class_id
										LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
										where teacher_class_id = '$get_id'")or die(mysqli_error());
										$class_row = mysqli_fetch_array($class_query);
										$class_id = $class_row['class_id'];
										$school_year = $class_row['school_year'];
										?>
					     <ul class="breadcrumb">
							<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
							<li><a href="#">School Year: <?php echo $class_row['school_year']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><b>Practice Exam</b></a></li>
						</ul>
						 <!-- end breadcrumb -->
					 
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
							<?php 		$query = mysqli_query($conn,"select * FROM class_exam 
										LEFT JOIN exam on class_exam.exam_id = exam.exam_id
										where teacher_class_id = '$get_id'  ")or die(mysqli_error());
										$count = mysqli_num_rows($query);
							?>
                                <div id="" class="muted pull-right"><span class="badge badge-info"><?php echo $count; ?></span></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<form action="copy_file_student.php" method="post">
					
									<?php include('copy_to_backpack_modal.php'); ?>
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
										<thead>
										        <tr>
												<th>Exam Title</th>
												<th>Description</th>
												<th>Exam Time (In Minutes)</th>
												<th></th>
												</tr>
										</thead>
										<tbody>
                              		<?php
										$query = mysqli_query($conn,"select * FROM class_exam 
										LEFT JOIN exam on class_exam.exam_id = exam.exam_id
										where teacher_class_id = '$get_id'  order by class_exam_id DESC ")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['class_exam_id'];
										$exam_id  = $row['exam_id'];
										$exam_time  = $row['exam_time'];
									
										$query1 = mysqli_query($conn,"select * from student_class_exam where class_exam_id = '$id' and student_id = '$session_id'")or die(mysqli_error());
										$row1 = mysqli_fetch_array($query1);
										$grade = $row1['grade'];

									?>                              
										<tr>                     
										 <td><?php echo $row['exam_title']; ?></td>
                                         <td><?php  echo $row['exam_description']; ?></td>                                     
                                         <td><?php  echo $row['exam_time'] / 60; ?></td>                                     
                                         <td width="200">
										<?php if ($grade == ""){ ?>
											<a  data-placement="bottom" title="Take This Exam" id="<?php echo $id; ?>Download" href="take_test2.php<?php echo '?id='.$get_id ?>&<?php echo 'class_exam_id='.$id; ?>&<?php echo 'test=ok' ?>&<?php echo 'exam_id='.$exam_id; ?>&<?php echo 'exam_time='.$exam_time;	 ?>"><i class="icon-check icon-large"></i> Take This Exam</a>
										<?php }else{ ?>
										<b>Already Taken Score <?php echo $grade; ?></b>
										<?php } ?>
										</td>            
														<script type="text/javascript">
														$(document).ready(function(){
															$('#<?php echo $id; ?>Take This Exam').tooltip('show');
															$('#<?php echo $id; ?>Take This Exam').tooltip('hide');
														});
														</script>										 
										</tr>
						 <?php } ?>
										</tbody>
									</table>
									</form>
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