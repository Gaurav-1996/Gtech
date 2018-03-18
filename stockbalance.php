<!DOCTYPE html>

<?php session_start();
	$ggg='';
	
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
		
		<title>Stock Balance</title>
		
		
		
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/tablesaw/css/tablesaw.css" rel="stylesheet" type="text/css" />
		
		
		
        <script src="assets/js/modernizr.min.js"></script>
		
		<script type="text/javascript">
			function getmultiplecats()
			{
				var str='';
				for (i=0;i<Categories.length;i++) { 
					if(Categories[i].selected){
						str +=Categories[i].value + ","; 
					}
				} 
				document.getElementById("selectedcats").value= str;
				return true;
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
										Item Wise Current Stock 
										
									</strong></center
									></div>
									
									
									
									<div class="panel-body">
										<div class="card-box">
											<form  method="post" id="myform" >							   
												
												<?php 
													if(isset($_POST['POID'])==true)
													{ 
													?>		
													<div class="row">
														
														<div class="col-lg-6 col-sm-6">														
															<div class="form-group">
																<div class="col-lg-12">
																	
																	
																	<div class="col-sm-8">
																		<input  name="POID" type="hidden" class="form-control"  
																		<?php 
																			if(isset($_POST['POID'])==true)
																			{ 
																				echo 'value="'.$_POST['POID'].'" readonly';
																			}
																			
																		?> />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<?php 
														
													}
												?>	
												
												
												
												
												
												
												<div class="row">
													
													<div class="form-group">
														
														<table id="datatable" class="table table-bordered table-hover tablesaw m-b-0" data-tablesaw-mode="columntoggle">
															<thead>
																<tr>
																	
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><b>SNO</b></th> 
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><b>Category</b></th> 
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><b>Item Name</b></th> 
																	
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><b>Balance<br>Qty</b></th> 
																	
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><b>Unit</b></th> 
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"><b>Price/Unit</b></th>
																	
																	<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"><b>Total Amt</b></th>
																</tr></thead>
																<tfoot><tr id="test">
																	
																	<th><b>SNO</b></th> <th><b>Category</b></th> <th><b>Item Name</b></th>  <th><b>Balance<br>Qty</b></th> 
																	<th><b>Unit</b></th> <th><b>Price</b></th><th><b>Total Amt</b></th>
																</tr></tfoot><tbody>
																<?php
																	include 'dbconnection.php';
																	$str="SELECT transno, inventory.itemid,categoryid, opqty, inqty, outqty, rejectqty, balanceqty, transdate, transdes, challanno, dateofchallan, vendorid, deptid, drivername, vehicleno, gateentryno, arrivaltime, mrno, newmrp, ledgerno, rejectremark, contactperson, deptnameformr, rectimestamp, totalamountprice, remark,category,itemname,unit,description FROM inventory join itemdetail on inventory.itemid=itemdetail.itemid join categories on itemcatid=categoryid where transno in ( select tno from (SELECT itemid, max(transno) as tno FROM inventory group by itemid ) as maxtno) ";
																	
																	//if(isset($_SESSION["whereforinventory"]))
																	//$str=$str." and ".$_SESSION["whereforinventory"];
																	
																	//$str=$str." order by categories.catName, thickness, code1s.Code1, width1, //brands.BrandName, length1";
																	//echo $str;
																	
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	$i=0;
																	while($row_s=mysqli_fetch_assoc($r_s))
																	{
																		$itemid=$row_s["itemid"];
																		$i++;
																	?>
																	
																	<tr>
																		
																		<td><?php  echo $i; ?></td> <td><?php echo $row_s['category']; ?></td> 
																		
																		<td><?php 
																				
																				echo $row_s['itemname'];
																				
																				
																			?></td> 
																		
																			<td><?php echo $row_s['balanceqty']; ?></td>
																			
																			<td><?php echo $row_s['unit']; ?></td> 
																			
																			<!--Price/mm or Price/unit-->
																			<td>
																				<?php echo $row_s['newmrp']; ?>
																				
																			</td> 
																			
																			<!--Total Amt-->
																			<td><?php 
																					
																					echo round($row_s['newmrp']*$row_s['balanceqty'],0);
																				
																			?></td>
																	</tr>
																	
																	<?php
																	}
																?>
																</tbody>
																
																
														</table>
														<!--<br>
														<center>
															<button type="submit" id="btnupdate" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="btnupdate" ><span class="ladda-label">Update</span><span class="ladda-spinner"></span></button>
														</center>-->
													</div>
													
													
													
													
												</div>
												<br>
												
												
												<?php
													if(isset($_POST["btnupdate"]))
													{
														$chk=$_POST["chk"];
														if(count($chk)>0)
														{
															for($si=0;$si<count($chk);$si++)
															{
																
																$chknumber=$chk[$si];
																
																$idd="oldreorder".$chknumber;
																$iddn="newreorder".$chknumber;
																
																$idoldmrp="oldmrp".$chknumber;
																$idnewmrp="newmrp".$chknumber;
																
																$allid="allids".$chknumber;
																$oldvalue=$_POST[$idd];
																$newvalue=$_POST[$iddn];
																
																$oldmrpvalue=$_POST[$idoldmrp];
																$newmrpvalue=$_POST[$idnewmrp];
																
																
																$allids=$_POST[$allid];
																
																if(($newvalue!=$oldvalue)|| ($newmrpvalue!=$oldmrpvalue) )
																
																{
																	//echo $chk[$si]."with ".$oldvalue. " to ".$newvalue." mmm: ".$allids."<br>";
																	$txtdata=explode("^",$allids);
																	//$itemid=$row_s["catid"].'^'.$row_s["thickness"].'^'.$row_s["code1"].'^'.$row_s["brandid"].'^'.$row_s["width1"].'^'.$row_s["length1"];
																	//					0						1					2					3						4					5
																	$str1="select max(transno) as maxtransno from inventory where catid='$txtdata[0]' and thickness='$txtdata[1]'  and code1='$txtdata[2]' and brandid='$txtdata[3]' and width1='$txtdata[4]' and length1='$txtdata[5]'";
																	
																	$result=mysqli_query($connect,$str1);													
																	$maxtransno=$result->fetch_object()->maxtransno;
																	
																	$str1="update inventory set reorderqty='$newvalue', newmrp='$newmrpvalue' where transno='$maxtransno'";
																	$result=mysqli_query($connect,$str1);		
																	
																}
																
																
															}
															echo '<meta http-equiv="refresh" content="1" />';
															echo '<script type="text/javascript">swal("Inventory Updated Successfully","","success");</script>';
														}
														else
														{
															// this refreshes current page after 5 seconds.
															//header( "refresh:5;" );
															
															// OR send to a new URL like this
															//header( "refresh:5; url=http://solidlystated.com" );
															echo '<script type="text/javascript">swal("Nothing to Update","","sorry");</script>';
														}
													}
													
												?>
												
												
												
												
												
												
												<br>
												
												
												
												
												
												
											</form>
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
		
				<script src="assets/pages/datatables.init.js"></script>
				<script src="assets/plugins/tablesaw/js/tablesaw.js"></script>
				<script src="assets/plugins/tablesaw/js/tablesaw-init.js"></script>

		<!-- jsgris table js -->			
		<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
		<script type="text/javascript">
			
			$(document).ready(function () {
				$('#datatable').DataTable( {"pageLength": 100,
					initComplete: function () {
						this.api().columns().every( function () {
							var column = this;
							var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);
								
								column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
							} );
							
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							} );
						} );
					}
				} );
				//$('#datatable').dataTable({ "pageLength": 100});
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
				var row = $('#test');
				row.insertBefore($("table tr:first"));
			});
		</script>
	</body>
</html>					



