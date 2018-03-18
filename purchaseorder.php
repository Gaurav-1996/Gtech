<!DOCTYPE html>

<?php session_start();
$ggg='';

	if($_SESSION['role']=='')
	{
	header("Refresh:0;URL=logout.php");
	}
	$poidtoupdate="";
	if(isset($_GET["poid"]))
	{
		$poidtoupdate=$_GET["poid"];
	}
	?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
		
		<link rel="shortcut icon" href="assets/images/favicon_1.ico">
		
		<title>Purchase Orders</title>
		
		
		
		
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
																	if(isset($_GET['poid']))
																	{ 
																	echo 'Edit Purchase Order';
																	}
																	else
																		echo 'Create Purchase Order';
																	?>
									
									
									
									</strong></center
									></div>
									<div class="panel-body">
										<div class="card-box">
										<form  method="post" id="myform" >							   
												
												<?php 
												if(isset($_GET['poid']))
																	{ 
														?>		
												<div class="row">
												
												<div class="col-lg-6 col-sm-6">														
														<div class="form-group">
															<div class="col-lg-12">
																
																
																<div class="col-sm-8">
																	<input  name="poid" type="hidden" class="form-control"  
																	<?php 
																	if(isset($_GET['poid']))
																	{ 
																	echo 'value="'.$_GET['poid'].'" readonly';
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
													
						<table id="rowtable">
                          <tr style="border-bottom: 1px solid ;">
                            <th colspan="14" style="margin-left:100%;"><input type="button" value="+" id="add" ></th>
                        </tr>
                        <tbody class="detail">
                            <tr>
                                
                              
                  				
								<td><span style="width:90px;"><b>1. Item Name</b></span><select id="itemid" name="itemid[]" tab="2" class="selectpicker qqqq"  data-live-search="true"  data-style="btn-white" style="width:80px;" onchange="getunit(this.value);fetchexistingqty(this.value);"  required>
									<option value="">Select Item</option></select></td>
								 
								 <td><span style="width:90px;"><b>In Stock Qty</b></span><input type="text"  style="width:90px;" class="form-control instockqty" id="instockqty" name="instockqty[]" readonly></td>
								<td><span style="width:90px;"><b>Qty</b></span><input type="text"  style="width:90px;" class="form-control quantity" id="quantity" name="quantity[]" required></td>
								<td><span style="width:90px;"><b>Unit</b></span><input type="text" class="form-control unit" id="unit" name="unit[]" style="width:90px;font-size:100%;" readonly></td>
								                                
								<td><span style="width:90px;"><b>Price</b></span><input type="text" class="form-control price" style="font-size:15px;width:90px;" id="price" name="price[]" style="display:none !important;"  required ></td>
								
								  <td><span style="width:90px;"><b>Discount Rate %</b></span><input type="text" class="form-control discount" style="width:90px;" id="discount" name="discount[]" value="0" required></td>
								  <td><span style="width:90px;"><b>Discount Price</b></span><input type="text" class="form-control discountprice" style="width:90px;" id="discountprice" name="discountprice[]" required readonly></td>
								  <td><span style="width:90px;"><b>Cost After Discount</b></span><input type="text" style="width:90px;" class="form-control costafterdiscount" id="costafterdiscount" name="costafterdiscount[]" required readonly></td>
								  <td><span style="width:90px;"><b>Tax Rate</b></span><input type="text" class="form-control taxrate" id="taxrate" style="width:90px;" name="taxrate[]" required ></td>
								<td><span style="width:90px;"><b>Amount</b></span><input type="text" class="form-control amount" id="amount" style="width:90px;" name="amount[]" required readonly><input type="text" hidden class="beforetax" id="beforetax" name="beforetax[]"  ></td>
								
								
								<td><span style="width:90px;"><b>Department(s)</b></span><input type="text" class="form-control department" id="department" style="width:90px;" name="department[]" required></td>
								
								
                                <td><a href="#" class="remove"><br>Delete</td>
</tr>
</tbody>
<tfoot>
<th></th>

<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th style="text-align:left;" class="totalbeforetax">0<b></b></th>

<th style="text-align:right;" class="total">0<b></b></th>
</tfoot>

</table>
			<br>
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
																<label class="col-sm-4 control-label">PO FOR</label>
																<div class="col-sm-8">
																	<select class="selectpicker"  data-live-search="true"  data-style="btn-white" id="pofor" name="pofor"  >	
																			      
																																			
																	<option value='KIET' selected>KIET</option> 
																	<option value='TBI'>TBI</option> 
																		</select>
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
																
																<label class="col-sm-4 control-label">PODate</label>
																<div class="col-sm-8">
																	<input type="date" name="PODate" tab="2" class="form-control" required <?php if(isset($_POST['PODate'])==true){ echo 'value="'.$_POST['PODate'].'" readonly';} else echo 'value="'.date('Y-m-d').'"';?> />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">GST</label>
																<div class="col-sm-8">
																	<input type="text" name="taxterms" tab="2" class="form-control" value="Included" placeholder="Enter the Tax Terms" />
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
																
																<label class="col-sm-4 control-label">Warranty if Any</label>
																<div class="col-sm-8">
																	<input type="text" name="warranty" tab="2" class="form-control"  placeholder="Enter warranty if any" />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Freight</label>
																<div class="col-sm-8">
																	
																		<select  class="selectpicker"  data-live-search="true"  data-style="btn-white" id="freight" name="freight">	
																			      
																	<?php
																	include 'dbconnection.php';
																	$str="SELECT * from  freights order by freight";
					
																	$r_s=mysqli_query($connect,$str)or die(mysqli_error($connect));
																	
																	while($row_s=mysqli_fetch_assoc($r_s))
																		{
																	?>
					
																	<option  value="<?php echo $row_s['freight'];?>" <?php
																			if($row_s['selected']=="Y")
																				echo "selected";
																	?>><?php echo $row_s['freight']; ?></option>
																	<?php
																	}
																	?>
																	<option value='NONE'>NONE</option> 
																		</select>
																	
																	
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
																
																<label class="col-sm-4 control-label">TermsOfDelivery</label>
																<div class="col-sm-8">
																	<input type="text" name="TermsOfDelivery" tab="2" class="form-control"  placeholder="Enter Terms Of Delivery" value="Within 10 days">
																	
																</div>
															</div>
														</div>
													</div>
													
												<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Remark</label>
																<div class="col-sm-8">
																	<input type="text" name="remark" tab="2" class="form-control"  placeholder="Enter the Remark" <?php if(isset($_POST['remark'])==true){ echo 'value="'.$_POST['remark'].'" readonly';} ?> />
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
																
																<label class="col-sm-4 control-label">Terms of Payment</label>
																<div class="col-sm-8">
																	<input type="text" name="termsofpayment" tab="2" class="form-control"  placeholder="Enter Terms Of Payment" value="By Cheque"  />
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																<label class="col-sm-4 control-label">PO Items Type</label>
																<div class="col-sm-8">
																	<select class="selectpicker"  data-live-search="true"  data-style="btn-white" id="itemstype" name="itemstype"  >	
																			      
																																			
																	<option value='OTHER' selected>OTHER</option> 
																	<option value='SOFTWARE'>SOFTWARE</option> 
																		</select>
																</div>
																
															</div>
														</div>
													</div>
												
											</div>
											<br>
<div class="row">
							
												<div class="col-lg-12 col-sm-12">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-2 control-label">Matter for Quotation</label>
																<div class="col-sm-10">
				<textarea name="quotationmatter" tab="2" class="form-control"  placeholder="Matter Of Payment" >With reference to your quotation by telephonic on dated <?php 
			$date = Date('Y-m-d');
$newdate = strtotime ( '-2 day' , strtotime ( $date ) ) ;
$newdate = date ( 'j-m-Y' , $newdate );
 
echo $newdate;

			
				?>, we are pleased to place an order of the following material on the terms and conditions mentioned below- </textarea>
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
																
																<label class="col-sm-4 control-label">Quotation Number</label>
																<div class="col-sm-8">
																	<input type="text" name="quotationno" tab="2" class="form-control" multiline placeholder="Enter Quotation no"  />
																</div>
															</div>
														</div>
													</div>
												<div class="col-lg-6 col-sm-6">
														<div class="form-group">
															<div class="col-lg-12">
																
																<label class="col-sm-4 control-label">Quotation Date</label>
																<div class="col-sm-8">
																	<input type="date" name="quotationdate"  id="quotationdate" tab="2" class="form-control"    />
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
																	echo '<button type="submit" id="sa-success" class="ladda-button btn btn-default btn-rounded " data-style="expand-left" name="submit_add" onclick="return focus();"><span class="ladda-label">Save Purchase Order</span><span class="ladda-spinner"></span></button>';		
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
										$vendorid  =$_POST["VendorId"];										
										$PODate  =$_POST["PODate"];
										$pofor  =$_POST["pofor"];
										$taxterms  =$_POST["taxterms"];
									$warranty =$_POST["warranty"];
										$freight  =$_POST["freight"];
										$TermsOfDelivery  =$_POST["TermsOfDelivery"];
										$remark  =$_POST["remark"];
										$termsofpayment  =$_POST["termsofpayment"];
										$quotationmatter  =$_POST["quotationmatter"];
										$quotationno  =$_POST["quotationno"];
										$quotationdate  =$_POST["quotationdate"];
										
										$itemstype=$_POST["itemstype"];
										
										$uid=$_SESSION['userid'];
										$RecTimeStamp=Date("Y/m/d H:i:s a");
										$lastvalue=0;
										$prefix="";
										$str="Select prefix,lastvalue from initials where reftype='PO".$pofor."'";
										$r_s=mysqli_query($connect,$str);
										while($row_s=mysqli_fetch_assoc($r_s))
										{
											$prefix=$row_s["prefix"];
											$lastvalue=$row_s["lastvalue"];
										}				
										$n=1;
										while($n!=0)
										{
										$poid=$prefix.$lastvalue;
										
										echo $str="Select * from pomaster where poid='$poid'";
										$r_s=mysqli_query($connect,$str);
										$n=mysqli_num_rows($r_s);
										if($n!=0)
											$lastvalue=$lastvalue+1;
										}
										$result=0;
										if($n==0)
										{
										  $str="Insert into pomaster(poid,itemstype, freight, pofor, vendorid, podate, madeby, rectimestamp, potype, tax, payment, delivery,warranty,quotationmatter,quotationno";
										  if($quotationdate!='')
										   $str.=",quotationdate";
										   $str.=") values ";
										 $str=$str."('$poid','$itemstype', '$freight', '$pofor', '$vendorid', '$PODate', '$uid', '$RecTimeStamp', 'MANUAL', '$taxterms', '$termsofpayment', '$TermsOfDelivery','$warranty','$quotationmatter','$quotationno'";
										 if($quotationdate!='')
										   $str.=",'$quotationdate'";
										  $str.=")";
									echo $str;
										$result=	mysqli_query($connect,$str);
										}
										
										$result2=0;
										if ($result==1)
											{
											$str123 = "";
											
		
		$str="INSERT INTO podetail (poid, itemid,  qty, mrp, cost, RecTimeStamp, discountper,discountamt,costafterdiscount, deptforwithoutreq, currentstatus, taxper) VALUES ";
		
		for($i = 0; $i<count($_POST['price']); $i++)
		{
			
				$str123.="('".$poid."',";
				$str123.="'".$_POST['itemid'][$i]."',";
				$str123.="'".$_POST['quantity'][$i]."',";
				$str123.="'".$_POST['price'][$i]."',";
				$str123.="'".$_POST['amount'][$i]."',";
				$str123.="'$RecTimeStamp',";
				$str123.="'".$_POST['discount'][$i]."',";
				$str123.="'".$_POST['discountprice'][$i]."',";
				$str123.="'".$_POST['costafterdiscount'][$i]."',";
				
				
				//dept
				$str123.="'".$_POST['department'][$i]."',";
				$str123.="'NOT',";
				$str123.="'".$_POST['taxrate'][$i]."'";
				$str123.=")";
																						
			if($i == (count($_POST['price'])-1))
			{
			}
			else
				$str123.=",";
		}
		 $str=  $str.$str123;
		 
		 echo $str;
		 
		$result2=	mysqli_query($connect,$str);
	}
	

		
	
		
											
											if ($result2==1)
											{
												$lastvalue=$lastvalue+1;
												$str="Update initials set lastvalue='$lastvalue' where reftype='PO".$pofor."'";
										$r_s=mysqli_query($connect,$str);
										
												
											echo '<script type="text/javascript">swal("Details Added Successfully","","success");</script>';
											
											}
										else
										{
											$str="Delete from pomaster where poid='$poid'";
										$r_s=mysqli_query($connect,$str);
										$str="Delete from podetail where poid='$poid'";
										$r_s=mysqli_query($connect,$str);
											echo '<script type="text/javascript">swal("Details Not Added Successfully","","sorry");</script>';
										}
										
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
		<!-- Examples -->
			<script src="assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
			<script src="assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script> 
			<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
			<script src="assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
			<script src="assets/plugins/tiny-editable/numeric-input-example.js"></script>
	
			<!-- jsgris table js -->			
			<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
				<!--Script for Paging Shashank-->
			<script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
			
		</body>
	</html>					
	<script type="text/javascript">

	
$(function()
{
	fetch_items();
	//fetchdepartments();
$('#add').click(function()
{
addnewrow();
fetch_items();
//fetchdepartments();
});
$('body').delegate('.remove','click',function()
{
	var n=($('.detail tr').length-0)+1;
	$(this).parent().parent().remove();
});

$('body').delegate('.quantity,.price,.discount,.discountprice,.taxrate,.amount,.costafterdiscount,.beforetax,.aftertax','change',function()

{

var tr=$(this).parent().parent();

var taxrating=tr.find('.taxrate').val();
var qty=tr.find('.quantity').val();
var price=tr.find('.price').val();
var dis=tr.find('.discount').val();

var taxedprice=0;

if(qty=='')
qty=0;
if(price=='')
price=0;
if(dis=='')
dis=0;

var amt =0;

		discountpricing=price-(price *dis)/100;
		amt=qty*discountpricing;
		amt=amt.toFixed(2);
		tr.find('.costafterdiscount').val(amt);
		
		var beforetax=qty*price;
		//var taxval= price*taxrating/100;
		//taxval=taxval.toFixed(2);
		//var taxvalprice=price.toFixed(2)+taxval.toFixed(2);
		//var aftertax=taxvalprice.toFixed(2)*qty;
		taxedprice=discountpricing + (discountpricing*taxrating)/100;
		amt= qty *taxedprice;
		amt=amt.toFixed(2);
		beforetax=beforetax.toFixed(2);
tr.find('.amount').val(amt);
tr.find('.discountprice').val(discountpricing);
tr.find('.beforetax').val(beforetax);
//tr.find('.aftertax').val(aftertax);
total();
totalbeforetax();
totalaftertax();
});
});


function totalaftertax()
{
	
var t=0;
$('.aftertax').each(function(i,e)
{
var amt =$(this).val()-0;
t+=amt;
});
$('.totalaftertax').html('After Tax:' +t);
}

function totalbeforetax()
{
	
var t=0;
$('.beforetax').each(function(i,e)
{
var amt =$(this).val()-0;
t+=amt;
});
$('.totalbeforetax').html('Before Tax:' +t);
}



function total()
{
	
var t=0;
$('.amount').each(function(i,e)
{
var amt =$(this).val()-0;
t+=amt;
});
$('.total').html('Total Amount:' +t);
}


function addnewrow()
{

var n=($('.detail tr').length-0)+1;
var tr = '<tr>'+

'<td><span style="width:90px;"><b>'+n+'.Item Name</b></span><select class="selectpicker qqqq"  data-live-search="true"  data-style="btn-white" style="width:80px;" id="itemid'+n+'"   name="itemid[]"  required onchange="getunit(this.value);fetchexistingqty(this.value);"></select></td>'+
'<td><span style="width:90px;"><b>In Stock Qty</b></span><input type="text"  style="width:90px;" class="form-control instockqty" id="instockqty'+n+'" name="instockqty[]" readonly></td>'+
'<td><span style="width:90px;"><b>Qty</b></span><input type="text" class="form-control quantity" style="width:90px;" id="quantity'+n+'" name="quantity[]" required></td>'+ 
'<td><span style="width:90px;"><b>Unit</b></span><input type="text" class="form-control unit" id="unit'+n+'" name="unit[]" style="width:90px;font-size:100%;" readonly></td>'+
'<td><span style="width:90px;"><b>Price</b></span><input type="text" class="form-control price"  style="font-size:15px;width:90px;" id="price'+n+'" name="price[]" required ></td>'+
'<td><span style="width:90px;"><b>Discount Rate %</b></span><input type="text" style="width:90px;" class="form-control discount" id="discount'+n+'" name="discount[]" required value="0"></td>'+
'<td><span style="width:90px;"><b>Discount Price</b></span><input type="text" style="width:90px;" class="form-control discountprice" id="discountprice'+n+'" name="discountprice[]" required readonly></td>'+
'<td><span style="width:90px;"><b>Cost After Discount</b></span><input type="text" style="width:90px;" class="form-control costafterdiscount" id="costafterdiscount'+n+'" name="costafterdiscount[]" required readonly></td>'+
'<td><span style="width:90px;"><b>Tax Rate</b></span><input type="text" style="width:90px;" class="form-control taxrate" id="taxrate'+n+'" name="taxrate[]" required ></td>'+
'<td><span style="width:90px;"><b>Amount</b></span><input type="text" style="width:90px;" class="form-control amount" id="amount'+n+'" name="amount[]" required readonly><input type="text" hidden class="beforetax" id="beforetax'+n+'" name="beforetax[]"  ></td>'+

'<td><span style="width:90px;"><b>Department(s)</b></span><input type="text" class="form-control department" id="department'+n+'" style="width:90px;" name="department[]" required></td>'+
'<td><a href="#" class="remove">Delete</td>'+

  

'</tr>';
$('.detail').append(tr);
//ddl_state_change(state_id);

//Get_Brand();


}
$('.selectpicker').trigger('change');
function fetch_items()
	{
	//alert('22');
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
						$('#itemid'+n).selectpicker('refresh');
						
					}
					else
					{
						$('#itemid').html(data);
						$('#itemid').selectpicker('refresh');
						
					}
				}
				
			
			});
	
	}
	function fetchexistingqty(itemid)
	{
	//alert(thicknessval);
		var n =($('.detail tr').length-0);
		
			
			
			$.ajax({
				type:'post',
				url:'ajaxkips.php',
				data:'findexistingqty='+itemid,
				success:function(data)
				{
					
					if(n>1)
					{
						$('#instockqty'+n).val(data);
						
					}
					else
					{
						$('#instockqty').val(data);
						
					}
				}
				
			
			});
	
	}
	
	
	
function fetchdepartments()
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
						$('#department'+n).html(data);
						
					}
					else
					{
						$('#department').html(data);
						
					}
				}
				
			
			});
	
		
	
			
	
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
						$('#taxrate'+n).val(allvalues[2]);
						$('#discount'+n).val(allvalues[3]);
					}
					else
					{
						$('#unit').val(allvalues[0]);
						$('#price').val(allvalues[1]);
						$('#taxrate').val(allvalues[2]);
						$('#discount').val(allvalues[3]);
					}
				}
				
			
			});
	
	}


	
	function GetPaymentterms(vendorId)
	{
		
		var n =($('.detail tr').length-0);
		

			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'paymentterms='+vendorId,
				success:function(data)
				{
					$('#paymentterm').html(data);
				}
				
			
			});
	
			
		
	}	
	
	function get_vendors()
	{
		var selectedcatsall = $('#selectedcats').val();
		$.ajax({
				type:'post',
				url:'ajax.php',
				data:'forgettingvendors='+selectedcatsall,
				success:function(data)
				{
					
						$('#VendorId').html(data);
				}
				
			
			});
	
			
		
	}	
	
	
	
	function GetTaxRate(togettaxrate)
	{
		
		var n =($('.detail tr').length-0);
		
			//var thickarr= thicknessval.split("^");
			
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:'togettaxrate='+togettaxrate,
				success:function(data)
				{
					var allvalues= data.split("^");
					if(n>1)
					{
						$('#taxrate'+n).val(allvalues[0]);
						$('#price'+n).val(allvalues[1]);
						$('#discount'+n).val(allvalues[2]);
					}
					else
						{
							$('#taxrate').val(allvalues[0]);
							$('#price').val(allvalues[1]);
							$('#discount').val(allvalues[2]);
						}
				}
				
			
			});
	
		
	
		
	}	
	
</script>
		