<!DOCTYPE html>

<?php session_start();
	if($_SESSION['role']=='')
	{
	header("Refresh:0;URL=logout.php");
	}
	include 'dbconnection.php';
	?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
		
		<link rel="shortcut icon" href="assets/images/favicon_1.ico">
		
		<title>Company</title>
		
		<!-- Plugin Css-->
		
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		
        <script src="assets/js/modernizr.min.js"></script>
		  <script type="text/javascript">
		function ExportToExcel()
		{
			var htmltable= document.getElementById('datatable');
			var html = htmltable.outerHTML;
			window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
		}
	</script>
	</head>
	
	<body class="fixed-left">
		
		<!-- Begin page -->
		<div id="wrapper">
			
            <!-- Top Bar Start -->
           <?php include('header.php');?>
            <!-- Top Bar End -->
			
			
            <!-- ========== Left Sidebar Start ========== -->
			
            <?php include('leftpanel.php');?>
			<!-- Left Sidebar End -->
			
			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">
						
                        <div class="panel">
						 	<div class="panel panel-border panel-custom">
								<div class="panel-heading">
									<center><h1   class="panel-title"><strong>
									<?php 
																	if(isset($_GET['category'])==true)
																	{ 
																	echo 'Delete Company';
																	}
																	else
																		echo 'Add Company';
																	?>
									
									
									
									</strong></center>
									</div>
									<div class="panel-body">
										<div class="card-box">
										<form action="departments.php" method="post" id="myform" data-parsley-validate novalidate>							   
												
												
												
												<div class="row">
												
																						
												<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Companies</label>
																<div class="col-sm-8">
																	<input  name="code1" type="text" class="form-control" required placeholder="Enter Company" tab="1" <?php if(isset($_GET['category'])==true){ echo 'value="'.$_GET['category'].'" readonly';} ?> />
																</div>
															</div>
														</div>
													</div>
															
													
											</div>
												<br>
												
													<div class="row">
														<div class="col-lg-12">
															
																<center>
																
																<?php
																if(isset($_GET['category'])==true)
																	{ 
																	echo '<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_delete" onclick="return focus();"><span class="ladda-label">Delete Company</span><span class="ladda-spinner"></span></button>';
																	}
																	else
																	echo '<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_add" onclick="return focus();"><span class="ladda-label">Add Company</span><span class="ladda-spinner"></span></button>';		
																	?>
																
																
																
																</center>
														
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
									
									if(isset($_POST['submit_add']))
									{
										
										$code1 =$_POST["code1"];
									
										
										
										
										
										$q_p="Select * from  departments where deptname='$code1'";
														$r_s=mysqli_query($connect,$q_p)or die(mysqli_error($connect));
														$found=false;
														while($row_s=mysqli_fetch_assoc($r_s))
														{
															$found=true;
														}
														
										if($found==false)
										{
										 $str="Insert into departments(deptname) values ('$code1')";
										$result=	mysqli_query($connect,$str);
										if ($result==1)
											{
											echo '<script type="text/javascript">swal("Details Added Successfully","","success");</script>';
											}
										}
										else
										{
										echo '<script type="text/javascript">swal("Details Already Exists, Please Change department.","","Sorry");</script>';
										}
									}

									if(isset($_POST['submit_delete']))
									{
										
										
										$code1 =$_POST["code1"];
										
										
									$q_p="Delete from departments where deptname ='$code1'";
														$r_s=mysqli_query($connect,$q_p)or die(mysqli_error($connect));
													
														
														
										if($r_s==1)
										{
																		
											echo '<script type="text/javascript">swal("Details Deleted Successfully","","success");</script>';
											
										}
										else
										{
										echo '<script type="text/javascript">swal("Deleting is not being possibile at this time.","","Sorry");</script>';
										}
									}
									
								?>
							</div>
						
					
					
					<div class="content">
								<div class="container">
									
			                        <div class="panel">
									 	<div class="panel panel-border panel-custom">
											<div class="panel-heading">
												<center><h1   class="panel-title"><strong>All Companies</strong></h1></center>
												</div>
												<div class="panel-body">
													<div class="card-box">
														<form action="departments.php" method="post" id="myform" data-parsley-validate novalidate>
															<table  id="datatable" class="table table-striped table-bordered tablesaw m-b-0" data-tablesaw-mode="columntoggle">
													<thead>
														<tr>
															<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">S.No.</th>
															<th >Companies</th>
															
															
														</tr>
													</thead>
													<tbody>
													<?php
														$q_p="Select * from departments order by deptname";
														$r_s=mysqli_query($connect,$q_p)or die(mysqli_error($connect));
														$p=1;				
														while($row_s=mysqli_fetch_assoc($r_s))
														{
													?>
													<form method="POST" action="departments.php">
														<tr>
															<th scope="row"><?php echo $p++; ?></th>
															
															<td><a href="departments.php?category=<?php echo $row_s['deptname']; ?>"><?php echo $row_s['deptname']; ?></a></td>	
																																		
															
														</tr>
														</form>
													<?php
														}
													?>
													</tbody>
												</table>
												<div class="row">
												<input type="button" class="btn btn-success" value="Export To Excel" onClick="ExportToExcel();">
							</div>
														</form>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
							
							</div>
					</div>
					
					<footer class="footer">
						© 2016. All rights reserved.
					</footer>
					
				</div>
				
			</div>
			
			<script>
				var resizefunc = [];
			</script>
			
			<!-- jQuery  -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/detect.js"></script>
			<script src="assets/js/fastclick.js"></script>
			<script src="assets/js/jquery.slimscroll.js"></script>
			<script src="assets/js/jquery.blockUI.js"></script>
			<script src="assets/js/waves.js"></script>
			<script src="assets/js/wow.min.js"></script>
			<script src="assets/js/jquery.nicescroll.js"></script>
			<script src="assets/js/jquery.scrollTo.min.js"></script>			
			<script src="assets/js/jquery.core.js"></script>
			<script src="assets/js/jquery.app.js"></script>
			
			<!-- Examples -->
			<script src="assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
			<script src="assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script> 
			<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
			<script src="assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
			<script src="assets/plugins/tiny-editable/numeric-input-example.js"></script>
	
			<!-- jsgris table js -->			
			<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
			<!--Script for Paging Shashank-->
			
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>
$('.modalLink').click(function(){
    var id=$(this).attr('data-detail-id');
	//alert("hi");
	//alert(id);
	
    $.ajax({url:"someone.php?ID="+id,cache:false,success:function(result){
        $(".modal-body").html(result);
    }});
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable({"pageLength": 100});
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>
<!-- Script End for Paging Shashank-->
		</body>
	</html>					