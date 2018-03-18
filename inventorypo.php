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
		
		<title>View Purchase Orders</title>
		
		
		
		
	  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<!-- For Drop Down Designing with filter-->
	<link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	
      
		<script type="text/javascript">
function printPage(id)
{
  
   html= document.getElementById(id).innerHTML;

   

   var printWin = window.open('','','left=50,top=50,width=50,height=50,toolbar=0,scrollbars=0,status  =0');
   printWin.document.write(html);
   printWin.document.close();
   printWin.focus();
   printWin.print();
   printWin.close();
}
</script>
<style type="text/css">
		 #rowtable{
			 width:100%;
		margin-top:-20px;
		 }
		 #rowtable td, th{
			 display:block;
			 float:left;
			 width:120px;
			 padding: 1px;
			  padding-top:20px;
			  padding-bottom:20px;
		 }
		 #rowtable tr{
			
		 border-bottom: 10px solid ;
		 
		
		 }
		 
		
		</style>
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
																	
																	echo 'Inventory Based on Purchase Order';
																	
																	?>
									
									
									
									</strong></center
									></div>
									<div class="panel-body">
										<div class="card-box">
										<form  method="post" id="myform" >							   
												
												
					
															
                                                           <div class="row">
											
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Select PO</label>
																<div class="col-sm-8">
																	  <select name="poid" id="poid" tab="2" class="selectpicker"  data-live-search="true"  data-style="btn-white" onchange="getdataofpo(this.value);"  required >								
																	                                                <option value = " " >Select PO</option> 																															
																	
																	
																	<?php
																	include 'dbconnection.php';
											$str="Select distinct poid, vendorname FROM pomaster JOIN vendors ON pomaster.vendorid = vendors.vendorid  where poid in(Select poid from podetail where currentstatus='NOT') order by poid desc";;
																	
																	

					
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	
																	while($row_s=mysqli_fetch_assoc($r_s))
																		{
																	?>
																	<option  value="<?php echo $row_s['poid']; ?>"><?php echo $row_s['poid']."(".$row_s['vendorname'].")"; ?></option>
																	<?php
																	}
																	?>
																	</select>
																</div>
															</div>
														</div>
													</div>
													
												
													
											</div>
                                                   
													
													
													<br>
													<div id="podiv"  name="podiv">
													</div>
												<hr>
												<br>
												<div class="row">
											
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Driver Name </label>
																<div class="col-sm-8">
																	<input type="text" name="drivername" tab="2" class="form-control" placeholder="Enter Driver Name" />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Vehicle No</label>
																<div class="col-sm-8">
																	<input type="text" name="vehicleno" tab="2" class="form-control" placeholder="Enter Vehicle No" />
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
																
																<label class="col-sm-4 control-label">Gate Entry No</label>
																<div class="col-sm-8">
																	<input type="text" name="gateentryno" tab="2" class="form-control"  placeholder="Enter Gate Entry No"/>
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Arrival Date</label>
																<div class="col-sm-8">
																	<input type="date" name="arrivaltime" tab="2" class="form-control" value="<?php echo date('Y-m-d'); ?>" required />
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
																
																<label class="col-sm-4 control-label">Challan/Bill No</label>
																<div class="col-sm-8">
																	<input type="text" name="challanno" tab="2" class="form-control"  placeholder="Enter Challan/Bill No." />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Challan/Bill Date</label>
																<div class="col-sm-8">
																	<input type="date" name="challandate" tab="2" class="form-control" value="<?php echo date('Y-m-d'); ?>" required />
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
																
																<label class="col-sm-4 control-label">Remark</label>
																<div class="col-sm-8">
																<input type="text" name="remark" tab="2" class="form-control"  placeholder="Enter Remark" />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																<?php
																	$str="SELECT prefix, lastvalue from  initials where reftype='MR'";
					
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	$prefix="";
																	$lastvalue=0;
																	while($row_s=mysqli_fetch_assoc($r_s))
																		{
																			$prefix=$row_s["prefix"];
																			$lastvalue=$row_s["lastvalue"];
																		}
																	
																	?>
																
																<label class="col-sm-4 control-label">MR No(<?php echo $prefix; ?>)</label>
																<input type="text" name="mrprefix" value="<?php echo $prefix; ?>" hidden>
																<div class="col-sm-8">
																	<input type="number" name="mrno" tab="2" class="form-control" value="<?php echo $lastvalue; ?>"  />
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
																
																<label class="col-sm-4 control-label">Receiving Person</label>
																<div class="col-sm-8">
																<input type="text" name="receivingperson" tab="2" class="form-control"  placeholder="Enter Receiving Person" />
																</div>
															</div>
														</div>
													</div>
													</div>
													<br>
			<div class="row"><div class="col-lg-12"><center>
					<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_add" onclick="return focus();"><span class="ladda-label">Save Data</span><span class="ladda-spinner"></span></button>
			</center></div></div>									
													
																							
													
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
									include 'dbconnection.php';
								if(isset($_POST['submit_add']))
									{
										$i=0;
										$podetailstr=array();
										$RecTimeStamp=date('Y/m/d H:i:s a');
										
										$drivername=$_POST["drivername"];
										$vehicleno=$_POST["vehicleno"];
										$gateentryno=$_POST["gateentryno"];
										$arrivaltime=$_POST["arrivaltime"];
										$challanno=$_POST["challanno"];
										$challandate=$_POST["challandate"];
										$remark=$_POST["remark"];
										$receivingperson=$_POST["receivingperson"];
										$mrno=$_POST["mrno"];
										$mrprefix=$_POST["mrprefix"];
										echo $mrprefix=  $mrprefix.$mrno;
										
								for($i = 0; $i<count($_POST['txtdata']); $i++)
								{
									$txtdata=explode("^",$_POST['txtdata'][$i]);
									

									$inqty=$_POST['txtinqty'][$i];
									$backqty=$_POST['txtbackqty'][$i];
									$newmrp=$_POST['txtprice'][$i];
									$remark=$_POST['remark'][$i];
									$receivedqty=$_POST['receivedqty'][$i];
									$totalamt=$inqty*$newmrp;
									$itemstatus="";
									if($inqty>0 || $backqty>0)
									{
										if($inqty>0)
										{											
									 $str1="select  balanceqty from inventory where transno=(select max(transno) from inventory where itemid='$txtdata[1]')";
									$op=mysqli_query($connect,$str1);
									 $opqty=0;
									 while($row_s=mysqli_fetch_assoc($op))
									 {
									  $opqty=$row_s['balanceqty'];
									   
									 }
									 $totalqty1=$opqty+$inqty;
	$str1="INSERT INTO inventory (itemid, opqty, inqty, outqty,rejectqty, ";
									$str1=$str1." balanceqty, transdate, transdes, rectimestamp,challanno,dateofchallan, vendorid, drivername, vehicleno, ";
									$str1=$str1." gateentryno, arrivaltime, mrno,newmrp, totalamountprice,remark,poid,receivingperson,receivedqty) VALUES ( ";
									$str1=$str1."'$txtdata[1]',  ";
									$str1=$str1." '$opqty', '$inqty', '0', '$backqty','$totalqty1', '$RecTimeStamp', 'PO IN', '$RecTimeStamp',";
									$str1=$str1."'$challanno','$challandate', '$txtdata[2]', '$drivername', '$vehicleno', '$gateentryno', '$arrivaltime',";
									$str1=$str1."'$mrprefix','$newmrp', '$totalamt','$remark','$txtdata[0]','$receivingperson','$receivedqty')";
									
									echo $str1;
									mysqli_query($connect,$str1);
									$itemstatus="IN";
										}
										
										if($backqty>0)
										{
											if($itemstatus!="")
												$itemstatus=$itemstatus.",BACK";
											else
												$itemstatus="BACK";											
										}
									
									$podetailstr[]="update podetail set currentstatus='$itemstatus',inqty='$inqty', returnedqty='$backqty', transdate='$RecTimeStamp' where poid='$txtdata[0]' and itemid='$txtdata[1]'";
									}
									//else
									//{
										
									//}
									
									
			
								}
								//print_r ($podetailstr);
								for($j=0;$j<count($podetailstr);$j++)
								{
									echo $podetailstr[$j];
								mysqli_query($connect,$podetailstr[$j]);
								}
								
											echo '<script type="text/javascript">swal("Inventory Updated Successfully","","success");</script>';
										
								
									}
									
									?>
								
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
	
				<!--Script for drop down  Shashank-->
			<script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
			
		</body>
	</html>					

<script type="text/javascript">
$(function()
{
	
	
$('body').delegate('.txtdata,.receivedqty,.txtinqty,.txtprice,.txtbackqty','change',function()
{
	
var tr=$(this).parent().parent();

var receivedqty=tr.find('.receivedqty').val();
var txtinqty=tr.find('.txtinqty').val();
var txtbackqty=receivedqty-txtinqty;


tr.find('.txtbackqty').val(txtbackqty);

});
});




function getdataofpo(poid)
	{
		//var selectedcatsall = $('#selectedcats').val();
		$.ajax({
				type:'post',
				url:'getpodata.php',
				data:'forgettingpodetail='+poid,
				success:function(data)
				{
					
						$('#podiv').html(data);
				}
				
			
			});
	
			
		
	}	
</script>