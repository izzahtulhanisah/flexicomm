﻿<!DOCTYPE html>

<?php
session_start();
//error_reporting(0);
if(!isset($_SESSION['manager_id'])){
header("location: manager_login.html");
}

$manager_idd = $_SESSION['manager_id'];

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>FlexiComm | Manager Home</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../../pages/examples/employee_home.php">Flexi<b>COMMUNICATOR</b></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                   
                    <!-- Notifications -->
                     <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
							
							 <?php
								$con=mysqli_connect("localhost","root","","task");

								if (mysqli_connect_errno())
								{
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								
								$sql  = '
										SELECT employee_id,task_status, COUNT(*) 
										 AS count
										 FROM task
										 WHERE task_status="delayed"
										 
										 ';
										 
										 $result=mysqli_query($con,$sql);
											if($result)
											{
												while($row=mysqli_fetch_assoc($result))
												{
													//echo $row['c'];
													
													echo '<span class="label-count">'.$row['count'].'</span>';
												}       
											}
							?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="../../pages/tables/manager_open_delay_task.php">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">date_range</i>
                                            </div>
                                            <div class="menu-info">
                                                
													<?php
														$con=mysqli_connect("localhost","root","","task");
														$t = "SELECT employee_id,task_status, COUNT(*) 
																	 AS count
																	 FROM task
																	 WHERE task_status='delayed'
																	 
																	 '";
														$result=mysqli_query($con,$sql);
														
														if($result)
														{
															while($row=mysqli_fetch_assoc($result))
															{
														echo '<h4>'; 
														 echo '
																 '.$row['count'].' delayed task
																';
																echo '<h4>';
														 }}
													?>
												
                                               <p>
                                                    <i class="material-icons">access_time</i> 
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                   
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
				
				<?php
							$con=mysqli_connect("localhost","root","","task");

							if (mysqli_connect_errno())
							  {
							  echo "Failed to connect to MySQL: " . mysqli_connect_error();
							  }
							$abc=$_SESSION['manager_id'];
							$sql = mysqli_query($con,"SELECT * FROM manager WHERE manager_id = '$abc'");
							$row = mysqli_fetch_array($sql);
							$manager_id=$row['manager_id'];
							$manager_name=$row['manager_name'];
							$manager_email=$row['manager_email'];
				?>
				
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $manager_name; ?></div>
                    <div class="email"><?php echo $manager_email; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="manager_update_profile.php"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="#changepass" data-toggle="modal"><i class="material-icons">create</i>Edit Password</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="manager_logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="../../pages/examples/manager_home.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
					
					<li>
                        <a href="../../pages/examples/manager_view_profile.php">
                            <i class="material-icons">person</i>
                            <span>Profile</span>
                        </a>
                    </li>
					
					<li>
                        <a href="../../pages/tables/manager_view_project_list.php">
                            <i class="material-icons">view_list</i>
                            <span>Projects</span>
                        </a>
                    </li>
					
                   <li>
                        <a href="../../pages/tables/manager_view_employee_task.php">
                            <i class="material-icons">date_range</i>
                            <span>Tasks</span>
                        </a>
                    </li>
					
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Employee</span>
                        </a>
                        <ul class="ml-menu">
							<li>
                                <a href="../../pages/tables/register_employee.php">Register Staff</a>
                            </li>
							<li>
                                <a href="../../pages/tables/register_manager.php">Register Manager</a>
                            </li>
                            <li>
                                <a href="../../pages/tables/manager_view_employee.php">Profiles Staff</a>
                            </li>
							 <li>
                                <a href="../../pages/tables/manager_view_manager.php">Profiles Manager</a>
                            </li>
                           
                        </ul>
                    </li>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    <a href="javascript:void(0);">Powered by <a href= "http://flexcility.com/"><img src="../../images/flexcility.png" alt="Flexcility Logo" width="100" height="20"> </a></a>.
                </div>
                <div class="version">
                    &copy; 2018 <b>Version: </b> 1.1
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan"  class="active">
                            <div class="cyan" ></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
	
        <!-- Coding dalam container -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
			
			 <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PROJECTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
							
							<?php

								$con=mysqli_connect("localhost","root","","task");

								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$sql = "SELECT count(project_id) AS total FROM project";
								$result = mysqli_query($con,$sql);
								$values=mysqli_fetch_assoc($result);
								$num_rows=$values['total'];
								echo '<div class="huge"> '.$num_rows.'</div>'
								?>
							
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">TASKS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							
							<?php
								$con=mysqli_connect("localhost","root","","task");
								
								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$sql2 = "SELECT count(task_id) AS total FROM task";
								$result2 = mysqli_query($con,$sql2);
								$values2=mysqli_fetch_assoc($result2);
								$num_rows=$values2['total'];
								echo '<div class="huge"> '.$num_rows.'</div>'
								?>
							
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">insert_invitation</i>
                        </div>
                        <div class="content">
                            <div class="text">DELAYED TASK</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">
							
							<?php
								$con=mysqli_connect("localhost","root","","task");
								
								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$sql3 = "SELECT count(task_id) AS total 
										FROM task 
										WHERE task_status = 'Delayed'" 
										;
								$result3 = mysqli_query($con,$sql3);
								$values3=mysqli_fetch_assoc($result3);
								$num_rows=$values3['total'];
								echo '<div class="huge"> '.$num_rows.'</div>'
							?>
							
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">STAFF</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">
							
							<?php
								$con=mysqli_connect("localhost","root","","task");
								
								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$sql4 = "SELECT count(employee_id) AS total 
										FROM employee 
										" 
										;
								$result4 = mysqli_query($con,$sql4);
								$values4=mysqli_fetch_assoc($result4);
								$num_rows=$values4['total'];
								echo '<div class="huge"> '.$num_rows.'</div>'
							?>
							
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
			
			
			
			<div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                                <h2>
                                HIGHLIGHTS
								<!--<button type="button" class="btn bg-teal waves-effect pull-right">
                                     <i class="material-icons">add_circle_outline</i>New Project -->
                       
								<a href = "new_highlight.php" class="btn btn-success pull-right"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>
                       
                                </button>
                            </h2>
                              
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th width= '15%'>Date</th>
                                            <th width= '50%'>Details</th>
                                            <th width= '15%'></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
									$conn=mysqli_connect("localhost","root","","task");

									if (mysqli_connect_errno())
									  {
									  echo "Failed to connect to MySQL: " . mysqli_connect_error();
									  }
									
									/*$sql2 = "UPDATE project  
										SET project_status =  
										CASE  
											 WHEN NOW() > project_due_date THEN 'Delayed' 
											 WHEN NOW() < project_due_date THEN 'In Progress'
										END ";
									$result2 = $conn -> query($sql2);*/
	
									$sql = "SELECT * from highlight";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										// output data of each row
										$x=1;
										while($row = $result->fetch_assoc()) {
											$id_highlight = $row['id_highlight'];
											$highlight_date = $row['highlight_date'];
											$highlight_message = $row['highlight_message'];
											$highlight_status = $row['highlight_status'];
											$manager_id = $row['manager_id'];
											
											
											if($highlight_status == 'Important'){
												$alert = "<div class='badge bg-red'>
												<strong>$highlight_status</strong> 
												</div>";
												
											}else if($highlight_status == 'All'){
												$alert = "<div class='badge bg-blue'>
												<strong>$highlight_status</strong> 
												</div>";
												
											}else if($highlight_status == 'Manager'){
												$alert = "<div class='badge bg-orange'>
												<strong>$highlight_status</strong> 
												</div>";
												
											}else if($highlight_status == 'Staff'){
												$alert = "<div class='badge bg-green'>
												<strong>$highlight_status</strong> 
												</div>";
												
											}else {
												$alert = "<div class='badge bg-cyan'>
												<strong>$highlight_status</strong> 
												</div>";	
												}
												
											
									?>
										<tr>
											<td><?php echo $highlight_date; ?></td>		
											<td><?php echo $highlight_message; ?></td>
											<td><?php echo $alert;?>
											</td>

									
											
									 <!-- Update Project List -->
										<div class="modal fade" id="defaultModal<?php echo $project_id; ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="defaultModalLabel">Update Project</h4>
													</div>
													<div class="modal-body">

														<form method="post" class="form-horizontal" role="form">
															<input type="hidden" name="edit_id" value="<?php echo $project_id; ?>">

														
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_name">Title</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" id="project_name" name="project_name" value="<?php echo $project_name; ?>" class="form-control" placeholder="Enter Project Title">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_description">Description</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" id="project_description" name="project_description" value="<?php echo $project_description; ?>" class="form-control" placeholder="Enter Project Description">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_date_created">Start Date</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="date" id="project_date_created" name="project_date_created" value="<?php echo $before30=date('Y-m-d', strtotime("$project_date_created")); ?>" class="form-control date" placeholder="Ex: 30/07/2018">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_due_date">End Date</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="date" id="project_due_date" name="project_due_date" value="<?php echo $before30=date('Y-m-d', strtotime("$project_due_date")); ?>" class="form-control">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="modal-footer">
																<button type="submit" class="btn btn-info waves-effect" name="update_project"><span class="glyphicon glyphicon-edit"></span>SAVE CHANGES</button>
																<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>CLOSE</button>
															</div>
														</form>													
													</div>
												</div>
											</div>
										</div>
										
										
									 <!-- Delete Project List -->
										<div class="modal fade" id="delete<?php echo $project_id; ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="defaultModalLabel">Delete Project</h4>
													</div>
													<div class="modal-body">

														<form method="post" class="form-horizontal" role="form">
															<input type="hidden" name="delete_id" value="<?php echo $project_id; ?>">
															
																<p><strong>Are you sure you want to delete <?php echo $project_name; ?> ?</strong></p>
															
															
															<div class="modal-footer">
																<button type="button" class="btn btn-info waves-effect" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>CLOSE</button>
																<button type="submit" class="btn btn-danger waves-effect" name="delete"><span class="glyphicon glyphicon-trash"></span>DELETE</button>
															</div>
														</form>													
													</div>
												</div>
											</div>
										</div>

									<!-- Complete Project List -->
										<div class="modal fade" id="complete<?php echo $project_id; ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="defaultModalLabel">Completed Project</h4>
													</div>
													<div class="modal-body">

														<form method="post" class="form-horizontal" role="form">
															<input type="hidden" name="edit_project_complete" value="<?php echo $project_id; ?>">
															
																<p><strong>Change status <?php echo $project_name; ?> to <font color = 'blue'>Completed</font>?</strong></p>
															
															
															<div class="modal-footer">
																<button type="button" class="btn btn-info waves-effect" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>Close</button>
																<button type="submit" class="btn btn-success waves-effect" name="complete"><span class="glyphicon glyphicon-ok"></span>Completed</button>
															</div>
														</form>													
													</div>
												</div>
											</div>
										</div>
									
									<?php
									$x++;}
									
									//Update Project
									if(isset($_POST['update_project'])){
										$edit_id = $_POST['edit_id'];
										$project_name = $_POST['project_name'];
										$project_description = $_POST['project_description'];
										$project_date_created = $_POST['project_date_created'];
										$project_due_date = $_POST['project_due_date'];
										$project_status = $_POST['project_status'];

										//$item_code = $_POST['item_code'];
										//$item_category = $_POST['item_category'];
										//$item_description = $_POST['item_description'];
										$sql = "UPDATE project SET 
											project_name='$project_name',
											project_description='$project_description',
											project_date_created='$project_date_created',
											project_due_date='$project_due_date',
											project_status='$project_status'
											WHERE project_id='$edit_id' ";
										if ($conn->query($sql) === TRUE) {
											echo '<script>window.location.href="manager_view_project_list.php"</script>';
										} else {
											echo "Error updating record: " . $conn->error;
										}
									}
									
									//Complete Project
									if(isset($_POST['complete'])){
										$edit_project_complete = $_POST['edit_project_complete'];
										$project_name = $_POST['project_name'];
										$project_description = $_POST['project_description'];
										$project_date_created = $_POST['project_date_created'];
										$project_due_date = $_POST['project_due_date'];
										$project_status = $_POST['project_status'];
										$sql = "UPDATE project SET 
											project_status='Completed'
											
										   WHERE project_id='$edit_project_complete' ";
										if ($conn->query($sql) === TRUE) {
											echo '<script>window.location.href="manager_view_project_list.php"</script>';
										} else {
											echo "Error updating record: " . $conn->error;
										}
									}


									if(isset($_POST['delete'])){
										// sql to delete a record
										$delete_id = $_POST['delete_id'];
										$sql = "DELETE FROM project WHERE project_id='$delete_id' ";
										if ($conn->query($sql) === TRUE) {
											echo '<script>window.location.href="manager_view_project_list.php"</script>';
											} else {
												echo "Error deleting record: " . $conn->error;
											}
										} 
									
								}
									?>
									
								<!-- Add New Highlights -->
								<div class="modal fade" id="addProject" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="defaultModalLabel">Post Announcement</h4>
											</div>
											<div class="modal-body">
														<form action = "manager_add_highlight.php" method="post" class="form-horizontal" role="form">
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="highlight_date">Message Title</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="date" name="highlight_date" class="form-control">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_description">Description</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																		<textarea name="project_description" cols="30" rows="5" class="form-control no-resize" placeholder="Enter Project Description" required></textarea>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_date_created">Start Date</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="date" name="project_date_created" class="form-control date">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="project_due_date">End Date</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="date" name="project_due_date" class="form-control">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="modal-footer">
																<button type="submit" class="btn btn-info waves-effect"><span class="glyphicon glyphicon-plus"></span>ADD NEW</button>
																<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>CLOSE</button>
															</div>
														</form>												
											</div>
											
										</div>
									</div>
								</div>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
              
            </div>
			
			<!-- Update Password -->
										<div class="modal fade" id="changepass" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="defaultModalLabel">Change Password</h4>
													</div>
													<div class="modal-body">

														<form method="post" class="form-horizontal" role="form">
															<input type="hidden" name="edit_id" value="<?php echo $manager_id; ?>">

														
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="manager_password">Current Password</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" id="manager_password" name="manager_password" value="" class="form-control" placeholder="Enter Current Password">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="password1">New Password</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" id="password1" name="password1" value="" class="form-control" placeholder="Enter New Password">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																	<label for="password2">Confirm Password</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																	<div class="form-group">
																		<div class="form-line">
																			<input type="text" id="password2" name="password2" value="" class="form-control" placeholder="Enter Confirm Password">
																		</div>
																	</div>
																</div>
															</div>
																<input type="hidden" name="manager_id" value="<?php echo $_SESSION['manager_id']; ?>"  />

															<div class="modal-footer">
																<button type="submit" class="btn btn-info waves-effect" name="update_password"><span class="glyphicon glyphicon-edit"></span>SAVE CHANGES</button>
																<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>CLOSE</button>
															</div>
															
														<?php

															if(isset($_POST['update_password'])){
																$host = "localhost";
																$user = "root";
																$pass = "";
																$db = "task";
																
																$manager_id = mysqli_real_escape_string($con,$_POST['manager_id']); 
																$password1 = mysqli_real_escape_string($con,$_POST['password1']);
																$password2 = mysqli_real_escape_string($con,$_POST['password2']);
																$manager_password = mysqli_real_escape_string($con,$_POST['manager_password']);
																
																$select = "SELECT * FROM manager WHERE manager_id = '$manager_id' ";						
																$result = $con->query($select);
																while($row = $result->fetch_assoc()){
																	$password = $row["manager_password"];
																}
																
																if($manager_password == $password){
																	if($password1===$password2){
																		$query = "UPDATE manager SET manager_id= '$manager_id', manager_password='$password1' WHERE  manager_id='$manager_id'  ";
																		$result = $con->query($query);
																	}
																	else{
																		echo "<script type = \"text/javascript\">
																					alert(\"Password Not Match\");
																					window.location = (\"manager_home.php\")
																				</script>";
																	}
																}
																else{
																	echo "<script type = \"text/javascript\">
																					alert(\"Wrong Password\");
																					window.location = (\"manager_home.php\")
																				</script>";
																}
															}
														?>
														
														</form>													
													</div>
												</div>
											</div>
										</div>
        </div>
    </section>
	        <!-- #END# Coding dalam container -->

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>