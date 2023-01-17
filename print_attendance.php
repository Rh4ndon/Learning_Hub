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
						
							<a id="print" onclick="window.print()"  class="btn btn-success"><i class="icon-print"></i> Print Records</a>
						</div>
						<?php include('attendance_students_breadcrums.php'); ?>
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
								
								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
						
								
								
									<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
							
										<thead>
										        <tr>
												<th>Name</th>
												<th>Section</th>
												<th>Gender</th>
												<th>Date</th>
												</tr>
												
										</thead>
										<tbody>
											
										<?php
											if (isset($_POST['submit'])){
												include('dbcon.php');
												$from=date('Y-m-d',strtotime($_POST['from']));
												$to=date('Y-m-d',strtotime($_POST['to']));
												//MySQLi Procedural
												//$oquery=mysqli_query($conn,"select * from `login` where login_date between '$from' and '$to'");
												//while($orow=mysqli_fetch_array($oquery)){
												/*	?>
												<tr>
													<td><?php echo $orow['logid']?></td>
													<td><?php echo $orow['username']?></td>
													<td><?php echo $orow['login_date']?></td>
													</tr>
												<?php */
												//}
				
												//MySQLi Object-oriented
												$oquery=$conn->query("select * from `attendance` where class_id = '$get_id' and dateofat between '$from' and '$to'");
												while($orow = $oquery->fetch_array()){
										?>                          
										<tr>
									
										 <td><?php echo $orow['name']; ?></td>
                                         <td><?php  echo $orow['section']; ?></td>
										 <td><?php echo $orow['gender']; ?></td>
										<td><?php echo $orow['dateofat']; ?></td>
                                </tr>
								<?php 
				}
			}
		?>
                         
					
						   
                              
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
						<form method="POST">
						<div class="col mb-3">
                        <label>From: </label><input type="date" name="from" class="form-control" required placeholder="Date">
                        </div>
						<div class="col mb-3">
						<label>To: </label><input type="date" name="to" class="form-control" required placeholder="Date">
                        </div>
                        <div class="col mb-3">
                            <input type="submit" value="submit" name="submit" class="btn btn-primary">
                        </div>
						</form>
								
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
		<!-- To not include form in printing -->
		<style type="text/css" media="print">
 		form {
          display:none;
        }
		</style>
    </body>
</html>