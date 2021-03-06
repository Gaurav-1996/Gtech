<!DOCTYPE html>

<?php 
ob_start();
session_start();

include 'dbconnection.php';

	if($_SESSION['role']=='')
	{
	header("Refresh:0;URL=logout.php");
	}
	?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
		
		<link rel="shortcut icon" href="assets/images/favicon_1.ico">
		
		<title>Add Users</title>
		
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
		function getbrands(Cat_id)
	{
		
		
		if(Cat_id != "")
		{
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'brandsforitems='+Cat_id,
				success:function(data)
				{
					
						$('#brands').html(data);
				}
				
			
			});
		}
		else
		{
			
				$('#brands').html('<option value="">Select Category First</option>');
		}
		
	}	
	
	function getcode1(Cat_id)
	{
		//alert('33');
		
		if(Cat_id != "")
		{
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'code1catid='+Cat_id,
				success:function(data)
				{
					
						$('#code1').html(data);
				}
				
			
			});
		}
		else
		{
			
				$('#code1').html('<option value="">Select Category First</option>');
		}
		
	}	
	
	function getcode2(Cat_id)
	{
		
		
		if(Cat_id != "")
		{
			
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'code2catid='+Cat_id,
				success:function(data)
				{
					
						$('#code2').html(data);
				}
				
			
			});
		}
		else
		{
			
				$('#code2').html('<option value="">Select Category First</option>');
		}
		
	}	
	
	function getcode3(Cat_id)
	{
		
		
		if(Cat_id != "")
		{
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'code3catid='+Cat_id,
				success:function(data)
				{
					
						$('#code3').html(data);
				}
				
			
			});
		}
		else
		{
			
				$('#code3').html('<option value="">Select Category First</option>');
		}
		
	}	
	
		</script>
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
									$updatingcontactperson ="";
										$updatingmobile ="";
										$updatingemail ="";
										$updatingaddress ="";
										$updatingvendorname ="";
										$updatingvendorid="";
									
														
									if(isset($_GET["vendorid"]))
									{
										$updatingvendorid=$_GET["vendorid"];				
														
														
		$sql="SELECT * from vendors where vendorid='$updatingvendorid'";
		
//echo $sql;
		
		$r_s=mysqli_query($connect,$sql)or die(mysqli_error($connect));
														
														while($updatedata=mysqli_fetch_assoc($r_s))
														{
														
														$updatingcontactperson =$updatedata["contactperson"];
										$updatingmobile =$updatedata["mobile"];
										$updatingemail =$updatedata["email"];
										$updatingaddress =$updatedata["address"];
										$updatingvendorname =$updatedata["vendorname"];
										
									
														
														}
									}
									
																	if($updatingvendorid!="")
																	{ 
																	echo 'Update Users Detail';
																	}
																	else
																		echo 'Add Users Detail';
																	?>
									
									
									
									
									</strong></center>
									</div>
									<div class="panel-body">
										<div class="card-box">
										<form action="vendors.php" method="post" id="myform" data-parsley-validate novalidate enctype="multipart/form-data">							   
												
												
											
												<div class="row">
												<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">First Name</label>
																<div class="col-sm-8">
																<input  name="firm" type="text" class="form-control"  placeholder="Enter Name" tab="1" value="<?php if($updatingvendorname!="") echo $updatingvendorname; else echo ""; ?>" />
																</div>
															</div>
														</div>
													</div>
													
											<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Last Name</label>
															<div class="col-sm-8">																	
																	<input  name="contactperson" type="text" class="form-control"  placeholder="Enter Contact " tab="1" value="<?php if($updatingcontactperson!="") echo $updatingcontactperson; else echo ""; ?>" />		<?php 
																	if($updatingvendorid!="")
																	{
																		echo '<input type="text" hidden name="updatingvendorid" value="'.$updatingvendorid.'">';
																		
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
											
											
											</div>
												<br>
											
											<div class="row">
												<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Mobile</label>
															<div class="col-sm-8">																	
																	<input  name="mobile" type="text" class="form-control"  placeholder="Enter Mobile" tab="1" value="<?php if($updatingmobile!="") echo $updatingmobile; else echo ""; ?>" />																	
																</div>
															</div>
														</div>
													</div>
														<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">e-mail</label>
															<div class="col-sm-8">																	
																	<input  name="email" type="text" class="form-control"  placeholder="Enter e-mail" tab="1" value="<?php if($updatingemail!="") echo $updatingemail; else echo ""; ?>" />																	
																</div>
															</div>
														</div>
													</div>
													
													
											</div><br>
											
											
											<div class="row">
												<div class="col-lg-12 col-sm-12">														
														<div class="form-group">
															
																<label class="col-sm-2 control-label">&nbsp;&nbsp;Address</label>
																<div class="col-sm-10">																	
																	<input  name="address" type="text" class="form-control"  placeholder="Enter Address" tab="1" value="<?php if($updatingaddress!="") echo $updatingaddress; else echo ""; ?>" />
																</div>
															</div>
														</div>
													</div>
														
													
													
											</div><br>
											

													<div class="row">
														<div class="col-lg-12">
															
																<center>
																
																<?php
																if($updatingvendorid!="")
																	{ 
																	echo '<button type="submit" id="sa_update" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="sa_update" onclick="return focus();"><span class="ladda-label">Update Users Detail</span><span class="ladda-spinner"></span></button>';
																	echo '<button type="submit" id="sa_delete" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="sa_delete" onclick="return focus();"><span class="ladda-label">Deactivate Users Detail</span><span class="ladda-spinner"></span></button>';
																	}
																	else
																	echo '<button type="submit" id="sa_success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="sa_success" onclick="return focus();"><span class="ladda-label">Add User Detail</span><span class="ladda-spinner"></span></button>';		
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
									include 'dbconnection.php';
									if(isset($_POST['sa_success']))
									{
										
										$contactperson =$_POST["contactperson"];
										$mobile =$_POST["mobile"];
										$email =$_POST["email"];
										$address =$_POST["address"];
										$firm =$_POST["firm"];
										
										
										
										
										
$q_p="SELECT * from  vendors where vendorname='$firm' ";
$r_s=mysqli_query($connect,$q_p)or die(mysqli_error($connect));
$found=false;
while($row_s=mysqli_fetch_assoc($r_s))
{
	$found=true;
}
				if($found==false)
				{					

									  	 $str="Insert into  vendors(vendorname,contactperson,address,mobile,email) values ('$firm','$contactperson','$address','$mobile','$email')";
									  	 $str1="Insert into  login_details(Id,Password,Role) values ('$mobile','$contactperson','user')";
										$result=	mysqli_query($connect,$str);
										$result1=	mysqli_query($connect,$str1);
										if ($result==1 && $result1==1)
											{
											echo '<script type="text/javascript">swal("Details Added Successfully","","success");</script>';
											}
										}
										else
										{
										echo '<script type="text/javascript">swal("Details Already Exists, Please Change The Name Of Firm.","","Sorry");</script>';
										}
}
									
									if(isset($_POST['sa_update']))
									{
										
										$contactperson =$_POST["contactperson"];
										$mobile =$_POST["mobile"];
										$email =$_POST["email"];
										$address =$_POST["address"];
										$vendorname =$_POST["firm"];
										$vendorid=$_POST["updatingvendorid"];



  $str="update vendors  set activestatus='Y', contactperson='$contactperson', mobile='$mobile',email='$email',address='$address',vendorname='$vendorname' where vendorid='$vendorid' ";


$result=	mysqli_query($connect,$str);
if ($result==1)
{
	echo '<script type="text/javascript">swal("Details Updated Successfully","","success");</script>';
									
										//header("Location:stockbalanceedit.php");
								
											
											}

										
}
									
									if(isset($_POST['sa_delete']))
									{
										$vendorid=$_POST["updatingvendorid"];
																
										
								
									  	 $str="update  vendors  set activestatus='N' where vendorid='$vendorid'";
										
										$result=	mysqli_query($connect,$str);
										if ($result==1)
											{
											echo '<script type="text/javascript">swal("Details deactivated Successfully","","success");</script>';
											}
										
									}
								?>
							</div>
						
					<div class="content">
								<div class="container">
									
			                        <div class="panel">
									 	<div class="panel panel-border panel-custom">
											<div class="panel-heading">
												<center><h1   class="panel-title"><strong>All Users</strong></h1></center>
												</div>
												<div class="panel-body">
													<div class="card-box">
														<form action="vendors.php" method="post" id="myform" data-parsley-validate novalidate>
															<table  id="datatable" class="table table-striped table-bordered tablesaw m-b-0" data-tablesaw-mode="columntoggle">
													<thead>
														<tr>
															<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">S.No.</th>
															
															<th >Userid</th>
															<th > First Name</th>
															<th>Last Name</th>
															<th >Mobile</th>
															<th >e-mail</th>
															<th>Address</th>
															
															
														</tr>
													</thead>
													<tbody>
													<?php
														 $q_p="SELECT * from vendors order by vendorname";
														$r_s=mysqli_query($connect,$q_p)or die(mysqli_error($connect));
														$p=1;				
														while($row_s=mysqli_fetch_assoc($r_s))
														{
													?>
													<form method="POST" action="vendors.php">
														<tr 
														<?php if ($row_s['activestatus']=='N') echo 'style="color:Red;"';
														?>>
															<th scope="row"><?php echo $p++; ?></th>
															
														
															<td><?php echo $row_s['vendorid']; ?></td>
															
															<td><a href="vendors.php?vendorid=<?php echo $row_s['vendorid']; ?>"><?php echo $row_s['vendorname']; ?></td>
															<td><?php echo $row_s['contactperson']; ?></td>
															<td><?php echo $row_s['mobile']; ?></td>
															<td><?php echo $row_s['email']; ?></td>
															<td><?php echo $row_s['address']; ?></td>
															
															
														</tr>
														</form>
													<?php
														}
													?>
													</tbody>
												</table>
														</form>
													</div>
												</div>
										</div>
									</div>
								</div>s
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
        $('#datatable').dataTable();
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
			<script type="text/javascript">
			
				$( document ).ready(function() {
                        $("input:text:visible:first").focus();
                        $("#myinputbox").focus();
                        
                    
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!
                        var yyyy = today.getFullYear();
                         if(dd<10){
                                dd='0'+dd
                            } 
                            if(mm<10){
                                mm='0'+mm
                            } 

                        today = yyyy+'-'+mm+'-'+dd;
                        document.getElementById("date1").setAttribute("value", today);
                        });
               
				function add_attrib(m,y)
				{
					
					var x=document.getElementById("myTable").rows.length;
					var table = document.getElementById("myTable");
					var row = table.insertRow(x);
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var cell5 = row.insertCell(4);
					var cell6 = row.insertCell(5);
				
					cell1.innerHTML = m+'.'+x;
					cell2.innerHTML = '<input id="myinputtext'+x+'" type="text" name="specs[]" class="form-control" required>';
					cell3.innerHTML = '<input type="number" name="pcs[]" class="form-control" required>';
					cell4.innerHTML = '<input type="text" name="smt[]" class="smt form-control smt" required>';
					cell5.innerHTML = '<input type="text" name="flow[]" class="flow form-control" required>';
					cell6.innerHTML = '<button type="button" class="fa fa-trash btn btn-danger" onclick="delete_row(\''+m+'\','+y+');"></button>';
                    
					row.setAttribute('id','rem'+y);
					var add=document.getElementById('add').setAttribute("value",parseInt(y)+1);
                    focus(x);
					return false;
				}
               function focus(x){
                   
                   var input = document.getElementById("myinputtext"+x).focus();
                   
               }
               function delete_row(m1,x)
				{
					var row=document.getElementById('rem'+x);
					var m=row.rowIndex;
					if(confirm("Sure To Delete!"))
					{
						document.getElementById("myTable").deleteRow(m);
						var x=document.getElementById("myTable").rows.length;
						for(var i=1;i<x;i++)
						{
							document.getElementById("myTable").rows[i].cells.item(0).innerHTML=m1+'.'+i;
						}
					}
				}
				function validate(m){
							var flow=document.getElementsByClassName("flow");
							var smt=document.getElementsByClassName("smt");
							var size=smt.length;
							for(var i=0;i<size;i++)
							{
								val=smt[i].value;
								var floatRegex = /^-?\d+(?:[.,]\d*?)?$/;
								if (!floatRegex.test(val)){
									swal("Invalid","Please Enter a decimal value for SQMT","warning");
									smt[i].focus();
									return false;
								}
								val = parseFloat(val);
								if (isNaN(val)){
									swal("Invalid","Please Enter a decimal value for SQMT","warning");
									return false;
								}
								if(/aa/i.test(flow[i].value)||/bb/i.test(flow[i].value)||/cc/i.test(flow[i].value)||/dd/i.test(flow[i].value)||/ee/i.test(flow[i].value)||/ff/i.test(flow[i].value)||/hh/i.test(flow[i].value)||/gg/i.test(flow[i].value))  
								{  
									swal("Incorrect","Please Check Flow String","warning");  
									return false;  
								} 
								var letters = /^[A-Ha-h]+$/;
								if(!flow[i].value.match(letters))  
								{  
									swal("Incorrect","Please Check Flow String","warning");  
									return false;  
								}  
								 
							}
							return true;
						}
			</script>
		</body>
	</html>					
	