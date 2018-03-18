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
		
		<title>Stock Inventory</title>
		
		
		
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		
     
		
        <script src="assets/js/modernizr.min.js"></script>
 <script type="text/javascript">
		function ExportToExcel()
		{
			var htmltable= document.getElementById('datatable');
			var html = htmltable.outerHTML;
			window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
		}
	</script>
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
									Item Wise Inventory
									
									
									
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
															 <table class="table table-bordered table-hover">
															
																<?php
																	include 'dbconnection.php';
		//$str="SELECT transno, inventory.itemid,categoryid, opqty, inqty, outqty, rejectqty, balanceqty, transdate, transdes, challanno, dateofchallan, vendorid, deptid, drivername, vehicleno, gateentryno, arrivaltime, mrno, newmrp, ledgerno, rejectremark, contactperson, deptnameformr, rectimestamp, totalamountprice, remark,category,itemname,unit,description FROM inventory join itemdetail on inventory.itemid=itemdetail.itemid join categories on itemcatid=categoryid";
		$str="SELECT transno, inventory.itemid,categoryid, opqty, inqty, outqty, rejectqty, balanceqty, transdate, transdes, challanno, dateofchallan, inventory.vendorid,vendorname, deptid, drivername, vehicleno, gateentryno, arrivaltime, mrno, newmrp, ledgerno, rejectremark, inventory.contactperson, deptnameformr, rectimestamp, totalamountprice, remark,category,itemname,unit,description FROM inventory join itemdetail on inventory.itemid=itemdetail.itemid join categories on itemcatid=categoryid left outer join vendors on inventory.vendorid=vendors.vendorid";
		$conditions="";
if(isset($_GET["categoryid"]))
{
	if($_GET["categoryid"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."categoryid='".$_GET["categoryid"]."'";
	}
}
if(isset($_GET["itemid"]))
{
	if($_GET["itemid"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."inventory.itemid='".$_GET["itemid"]."'";
	}
}

if(isset($_GET["department"]))
{
	if($_GET["department"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."inventory.deptid='".$_GET["department"]."'";
	}
}

if(isset($_GET["vendor"]))
{
	if($_GET["vendor"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."vendorid='".$_GET["vendor"]."'";
	}
}

if(isset($_GET["contactperson"]))
{
	if($_GET["contactperson"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."inventory.contactperson='".$_GET["contactperson"]."'";
	}
}

if((isset($_GET["fromdate"]))&&(isset($_GET["todate"])))
{
	if(($_GET["fromdate"]!="")&&($_GET["todate"]!=""))
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."transdate between '".$_GET["fromdate"]."' and '".$_GET["todate"]."'";
	}
	else if($_GET["fromdate"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."transdate >= '".$_GET["fromdate"]."'";
	}
}
else if(isset($_GET["fromdate"]))
{
	if($_GET["fromdate"]!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions."transdate >= '".$_GET["fromdate"]."'";
	}
}

$transactiontype="";

if(isset($_GET["in"]))
{
	if($_GET["in"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'IN'";
	}
}
if(isset($_GET["out"]))
{
	if($_GET["out"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'OUT'";
	}
}
if(isset($_GET["poin"]))
{
	if($_GET["poin"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'PO IN'";
	}
}
if(isset($_GET["back"]))
{
	if($_GET["back"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'BACK'";
	}
}
if(isset($_GET["damage"]))
{
	if($_GET["damage"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'DAMAGE'";
	}
}
if(isset($_GET["tovendor"]))
{
	if($_GET["tovendor"]=="yes")
	{
		if($transactiontype!="")
			$transactiontype = $transactiontype.", ";
		$transactiontype = $transactiontype."'TO VENDOR'";
	}
}


	if($transactiontype!="")
	{
		if($conditions!="")
			$conditions = $conditions." and ";
		$conditions = $conditions." transdes in (".$transactiontype.")";
	}

	
if($conditions!="")
	$str.=" where ".$conditions;



$str.=" order by category,itemname, rectimestamp";
																	//if(isset($_SESSION["whereforinventory"]))
																	//$str=$str.'where '.$_SESSION["whereforinventory"];
																	//$str=$str." order by categories.catName,  thickness, code1s.Code1, brands.BrandName, width1, length1, unit, transno";
																	//echo $str;
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	$i=0;
																	$oldheadings="";
																	$inventorycount=0;
																	while($row_s=mysqli_fetch_assoc($r_s))
																		{
																	?>
																	 
															 <?php 
															 $newheadings=$row_s['itemname'].$row_s['category'];
															
															if($oldheadings!=$newheadings)
															 {
																
															 $i++; 
															 echo '<tr><td colspan="12">'; 
															 echo $i.". <b>Category: </b>".$row_s['category']; 
															 echo " <b>Item Name:</b> ";
															
													echo $row_s['itemname'];
															 
															  echo '</td> </tr>';
															  $oldheadings=$row_s['itemname'].$row_s['category'];
															 $inventorycount=0;
															 ?>		
															<tr>
															<td><b>SNO</b></td><td><b>Trans Type</b></td><td><b>Trans Qty</b></td> <td><b>Balance<br>Qty</b></td> 
															<td><b>Unit</b></td>  <td><b>Price</b></td>
															<td><b>Total<br>Amount</b></td> <td><b>Trans Date</b></td>
															</tr>
															<?php
															 }
															 ?>
															<tr>
															<td><?php $inventorycount++; echo $inventorycount; ?></td>
															<!--
															<td><?php echo $row_s['opqty']; ?></td> 
															
															<td><?php echo $row_s['inqty']; ?></td> 
															<td><?php echo $row_s['outqty']; ?></td>-->
															<td><?php echo $row_s['transdes']; ?></td>
														<td><?php 
														if(($row_s['transdes']=="IN")||($row_s['transdes']=="PO IN")||($row_s['transdes']=="BACK"))
														echo $row_s['inqty'];
														else
														echo $row_s['outqty']; ?></td>
														
														
															<td><?php echo $row_s['balanceqty']; ?></td> 
															<td><?php echo $row_s['unit']; ?></td> 
															<!--Price/mm-->
															<td><?php echo $row_s['newmrp']; ?></td>
															
															<!--Total Amt-->
															<td><?php 
																	if(($row_s['transdes']=='IN')||($row_s['transdes']=='BACK'))
																		echo round($row_s['newmrp']*$row_s['inqty'],0);
																	else
																		echo round($row_s['newmrp']*$row_s['outqty'],0);
																
																	?></td>
															<td><?php 
															$allds=explode("-",$row_s['transdate']);
															echo  $allds[2]."-".$allds[1]."-".$allds[0];
															
															?></td> 
															<td><?php echo $row_s['vendorname']; ?></td>
															<td>
															<?php 
															if($row_s['transdes']=='IN')
															echo $row_s['challanno']; 
															else//if($row_s['transdes']=='OUT')
															echo $row_s['deptid'];
															?>
															</td>
															<td><?php 
															if($row_s['contactperson']!="")
															echo $row_s['contactperson']; ?></td>
															

															</tr>
															 
															 
																
					
																	<?php
																	}
																	?>
																

															</table>
															
													
														</div>
													
													
													
													
												</div>
												<br>
												
											
											
											
													
													
												
													
													
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
	
			<!-- jsgris table js -->			
			<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
			
		</body>
	</html>					
    
    <script src="js/jquery.reveal.js"></script>
   <!--Script for Paging Shashank-->
			<script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>



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
 
	
<?php $_SESSION["whereforinventory"]=null;?>