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
		
		<title>Items Inventory(IN)</title>
		
		
		
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <script src="assets/js/modernizr.min.js"></script>
	
		<style type="text/css">
		 #rowtable{
			 width:100%;
		margin-top:-20px;
		 }
		 #rowtable td, th{
			 display:block;
			 float:left;
			 width:180px;
			 padding: 1px;
			  padding-top:20px;
		 }
		 #rowtable tr{
			
		 border-bottom: 10px solid ;
		
		 }
		 
		
		</style>

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
									<?php 
																	
																		echo 'Stock Updation';
																	?>
									
									
									
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
														 <div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Vendor</label>
																<div class="col-sm-8">
																	
																	<select name="VendorId" id="VendorId" tab="2" class="selectpicker"  data-live-search="true"  data-style="btn-white"  required >								
																																																
																	<option value=''>Choose One</option> 
																	<?php
																	include 'dbconnection.php';
																	$str="SELECT * from  vendors order by vendorname";
					
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	
																	while($row_s=mysqli_fetch_assoc($r_s))
																		{
																	?>
					
																	<option  value="<?php echo $row_s['vendorid']; ?>"><?php echo $row_s['vendorname']; ?></option>
																	<?php
																	}
																	?>
																	<option value='NONE'>NONE</option> 
                                                </select>
																	
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
												
											
											
											
													
													
													<br>
													
													 <table id="rowtable" >
                        
                        <tbody class="detail">
                            <tr >
                                 

								<td><span style="width:90px;"><b>Item Name</b></span><select class="form-control qqqq" style="width:90px;" id="itemid" name="itemid[]" onclick="getexisting(this.value);getunit(this.value);"  required><option value="">Select</option></select></td>
								 
								 <td><span style="width:90px;"><b>Existing Qty</b></span> <input type="text" class="form-control equantity" id="equantity" name="equantity[]" style="width:90px;font-size:100%;" readonly></td>
								 
								<td><span style="width:90px;"><b>In Qty</b></span> <input type="text" class="form-control quantity" id="quantity" name="quantity[]" style="width:90px;" required></td>
								<td><span style="width:90px;"><b>Reject Qty</b></span> <input type="number" class="form-control rquantity" id="rquantity'+n+'" name="rquantity[]" value="0" style="width:90px;font-size:100%;"></td>
								<td><span style="width:90px;"><b>Unit</b></span> <input type="text" class="form-control unit" id="unit" name="unit[]" style="width:90px;" readonly></td>
								<td><span style="width:90px;"><b>Price</b></span> <input type="text" class="form-control price" id="price" name="price[]" style="width:90px;font-size:100%;" required></td>
								<td><span style="width:90px;"><b>Total Amount</b></span><input type="text" class="form-control totalamt" id="totalamt" name="totalamt[]" style="width:90px;font-size:100%;"></td>
								<td><span style="width:90px;"><b>Remark</b></span><input type="text" class="form-control itemremark" id="itemremark" name="itemremark[]" style="width:90px;font-size:100%;" required></td>							
                              
                                <td><a href="#" class="remove"><br>Delete</td>
</tr>
</tbody>
<tr style="border-bottom: 1px solid ;">
                           
                            <th colspan="15" style="margin-left:100%;"><input type="button" value="+" id="add" ></th>
                        </tr>

</table>
			<br>
									<hr>
												<br>
												<div class="row">
											
													
														<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
															</div>
														</div>
													</div>
													
												
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															
														</div>
													</div>
													
											</div>
											
											<br>
												<div class="row">
											
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
															</div>
														</div>
													</div>
													
											</div>
											
											<br>
												<div class="row">
											
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
															</div>
														</div>
													</div>
													
											</div>
										<br>
										
											<div class="row">
														 <div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																
                                                </select>
																	
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
																//if(isset($_POST['POID'])==true)
																	//{ 
																	//'echo '<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_delete" onclick="return focus();"><span class="ladda-label">Delete Purchase Order</span><span class="ladda-spinner"></span></button>';
																	//}
																	//else
																	echo '<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_add" onclick="return focus();"><span class="ladda-label">Update Stock</span><span class="ladda-spinner"></span></button>';		
																	//?>
																
																
																
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
									if(isset($_POST['submit_add']))
									{
										
										//$Categories =$_POST["Categories"];
										$VendorId  =$_POST["VendorId"];
										$i=0;
										
										$RecTimeStamp=date('Y/m/d H:i:s a');
										$drivername="";//$_POST["drivername"];
										$vehicleno=$_POST["vehicleno"];
										$gateentryno=$_POST["gateentryno"];
										$arrivaltime=$_POST["arrivaltime"];
										$challanno=$_POST["challanno"];
										$challandate=$_POST["challandate"];
										//$remark=$_POST["remark"];
										$receivingperson=$_POST["receivingperson"];
										$mrno=$_POST["mrno"];
										$mrprefix=$_POST["mrprefix"];
										$deptid=$_POST["deptid"];
										echo $mrprefix=  $mrprefix.$mrno;
								
		
		for($i = 0; $i<count($_POST['quantity']); $i++)
		{
			
			 
								//0: thickness, 1: thickness unit, 2: catid, 3: Code1					
									
									$inqty=$_POST['quantity'][$i];
									$itemid=$_POST['itemid'][$i];

$unit=$_POST['unit'][$i];
$price=$_POST['price'][$i];
$rquantity=$_POST['rquantity'][$i];
$totalamt=$_POST['totalamt'][$i];
$itemremark=$_POST['itemremark'][$i];

									if($inqty>0)
									{										
									 $str1="select  balanceqty from inventory where transno=(select max(transno) from inventory where itemid='$itemid')";
									$op=mysqli_query($connect,$str1);
									 $opqty=0;
									 
									 while($row_s=mysqli_fetch_assoc($op))
									 {
									  $opqty=$row_s['balanceqty'];
									 // if($reorderqty=='')
									  //$reorderqty=$row_s['reorderqty'];
									 }
									 $balanceqty1=$opqty+$inqty;
									
									$str1="INSERT INTO inventory (itemid, opqty, inqty, outqty,rejectqty, ";
									$str1=$str1." balanceqty, transdate, transdes, rectimestamp,challanno,dateofchallan, vendorid, drivername, vehicleno, ";
									$str1=$str1." gateentryno, arrivaltime, mrno,newmrp, totalamountprice,remark,receivingperson,deptid) VALUES ( ";
									$str1=$str1."'$itemid',  ";
									$str1=$str1." '$opqty', '$inqty', '0', '$rquantity','$balanceqty1', '$RecTimeStamp', 'IN', '$RecTimeStamp',";
									$str1=$str1."'$challanno','$challandate', '$VendorId', '$drivername', '$vehicleno', '$gateentryno', '$arrivaltime',";
									$str1=$str1."'$mrprefix','$price', '$totalamt','$itemremark','$receivingperson','$deptid')";
									 $str1;
									mysqli_query($connect,$str1);
									
									}
									
								}
								
								$str2="update initials set lastvalue='".$mrno."'";
									mysqli_query($connect,$str2);						
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
	fetch_items();
	
$('#add').click(function()
{
addnewrow();
fetch_items();

});
$('body').delegate('.remove','click',function()
{
	var n=($('.detail tr').length-0)+1;
	$(this).parent().parent().remove();
});

$('body').delegate('.quantity,.unit,.totalamt,.price,.equantity','change',function()
{

var tr=$(this).parent().parent();

var quantity=tr.find('.quantity').val();
//var taxrate=tr.find('.taxrate').val();

var price=tr.find('.price').val();

var totalprice=0;

	
	totalprice=(quantity*price);// + (quantity*price)*taxrate/100;
	totalprice=totalprice.toFixed(2);


tr.find('.totalamt').val(totalprice);
});
});


function addnewrow()
{

var n=($('.detail tr').length-0)+1;
var tr = '<tr>'+


'<td><span style="width:90px;"><b>Item Name</b></span><select class="form-control qqqq" id="itemid'+n+'"  style="width:90px;"  onclick="getexisting(this.value);getunit(this.value);"   name="itemid[]"  required></select></td>'+
'<td><span style="width:90px;"><b>Existing Qty</b></span> <input type="text" class="form-control equantity" id="equantity'+n+'" name="equantity[]" style="width:90px;font-size:100%;" readonly></td>'+
'<td><span style="width:90px;"><b>In Qty</b></span> <input type="number" class="form-control quantity" id="quantity'+n+'" name="quantity[]" style="width:90px;" required></td>'+
'<td><span style="width:90px;"><b>Reject Qty</b></span> <input type="number" class="form-control rquantity" id="rquantity'+n+'" value="0" name="rquantity[]" style="width:90px;font-size:100%;"></td>'+
'<td><span style="width:90px;"><b>Unit</b></span><input type="text" class="form-control unit" id="unit'+n+'" name="unit[]" style="width:90px;font-size:100%;" readonly></td>'+
'<td><span style="width:90px;"><b>Price</b></span><input type="number" class="form-control price" id="price'+n+'" name="price[]" style="width:90px;font-size:100%;" required></td>'+
'<td><span style="width:90px;"><b>Total Cost</b></span><input type="text" class="form-control totalamt" id="totalamt'+n+'" name="totalamt[]" style="width:90px;font-size:100%;" required></td>'+
'<td><span style="width:90px;"><b>Remark</b></span><input type="text" class="form-control itemremark" id="itemremark'+n+'" name="itemremark[]" style="width:90px;font-size:100%;" required></td>'+
'<td><a href="#" class="remove"><br>Delete</td>'+

'</tr>';


$('.detail').append(tr);


}


	
	
	
	
	
	
	
	function getunit(itemid)
	{
				
		var n =($('.detail tr').length-0);
					
			$.ajax({
				type:'post',
				url:'ajaxkips.php',
				data:'fetchitemunit='+itemid,
				success:function(data)
				{
					
						var allvalues= data.split("^");
						
					
					if(n>1)
					{						
						$('#unit'+n).val(allvalues[0]);
						$('#price'+n).val(allvalues[1]);
						//$('#taxrate'+n).val(allvalues[2]);
					}
					else
					{
						$('#unit').val(allvalues[0]);
						$('#price').val(allvalues[1]);
						//$('#taxrate').val(allvalues[2]);
					}
				}
				
			
			});
	
	}

	

	
	function fetch_items()
	{
	//alert(thicknessval);
		var n =($('.detail tr').length-0);
		
			
			
			$.ajax({
				type:'post',
				url:'ajaxkips.php',
				data:'fetchallitems=11',
				success:function(data)
				{
					
					if(n>1)
					{
						$('#itemid'+n).html(data);
						
					}
					else
					{
						$('#itemid').html(data);
						
					}
				}
				
			
			});
	
		
	
		
	}	
	
	
	function getexisting(itemid)
	{
		
		var n =($('.detail tr').length-0);
		
					
			$.ajax({
				type:'post',
				url:'ajaxkips.php',
				data:'findexistingqty='+itemid,
				success:function(data)
				{
					
					if(n>1)
					{
						
						$('#equantity'+n).val(data);
						
					}
					else
						{
							
							$('#equantity').val(data);
							
						}
				}
				
			
			});
	
		
	
		
	}	
	
	
</script>

