<style type="text/css">
	  #ContainerDiv {
  margin: auto;
  position: fixed;
  margin: auto;
  left: 0;
  bottom: 0;
  width: 100%;
}

#InnerContainer {
  width: 100%;
}

#TheBelowDiv {
  font-size: 18pt;
  font-family: Tahoma;
  text-align: center;
  color: white;
} 
	  </style>

<?php 
//$con = mysql_connect('10.0.0.12','root','jayERP@357$') or die(mysql_error());
	include 'dbconnection2.php';

		
		if(isset($_POST['POID'])&&!empty($_POST['POID']))
		{
			
			$poid=$_POST['POID'];
			
$str="Select distinct poid, vendorname, contactperson, address, mobile, email, freight, pofor, podate, tax, payment, delivery, warranty, quotationmatter, quotationno, quotationdate,itemstype FROM pomaster JOIN vendors ON pomaster.vendorid = vendors.vendorid where poid='$poid'";
			
			$strtoprint='<table  style="width:100%;border-collapse: collapse;">';
			
			//echo $str;
	
			$r_s=mysql_query($str);
																	
			while($row_s=mysql_fetch_assoc($r_s))
			{
	$strtoprint=$strtoprint.'<tr><td style="width:95px;vertical-align:top;border-collapse: collapse;"><img width="140px" height="120px" src="images/'.$row_s['pofor'].'.jpg"';
				
				$strtoprint=$strtoprint.'></td>';
				if($row_s['pofor']=="KIET")
				{
				$strtoprint=$strtoprint.'<td  style="border-collapse: collapse;text-align:center"><span style="font-size:26px;"><b>KIET GROUP OF INSTITUTIONS, GHAZIABAD</b></span><br>13 KM STONE, GHAZIABAD-MEERUT ROAD, GHAZIABAD - 201206(U.P.)<br><br><br></td></tr>';
				}
				if($row_s['pofor']=="TBI")
				{
				$strtoprint=$strtoprint.'<td  style="border-collapse: collapse;text-align:center"><span style="font-size:26px;"><b>Technology Business Incubator - KIET</b></span><br>(Promoted by: National Science & Technology Entrepreneurship Development Board)<br>Ministry of Science & Technology, Govt. of India, New Delhi - 110033<br><br><br></td></tr>';
				}
				
	$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:center" colspan="2"><span style="font-size:21px;"><b><u>PURCHASE ORDER</u></b></span></td></tr>';	

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left"><span style="font-size:14px;"><b>To,</b></span><br>';
$strtoprint=$strtoprint.$row_s['vendorname'].'<br>'.$row_s['address'];
$strtoprint=$strtoprint.'</td><td style="vertical-align:top;border-collapse: collapse;text-align:right"><b>SL No: </b>'.$row_s['poid'].'<br><b>Date: </b>';

$dd=explode("-",$row_s['podate']);
$strtoprint=$strtoprint.$dd[2].'-'.$dd[1].'-'.$dd[0].'</td></tr>';	

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left" colspan="2"><br>';
if($row_s['quotationmatter']!="")
	$strtoprint=$strtoprint.$row_s['quotationmatter'];
else
{
	$strtoprint=$strtoprint.'With reference to your quotation number '.$row_s['quotationno'].' Dated ';
	//$strtoprint=$strtoprint.$row_s['quotationdate'];
	$dd=explode("-",$row_s['quotationdate']);
	$strtoprint=$strtoprint.$dd[2].'-'.$dd[1].'-'.$dd[0];
	$strtoprint=$strtoprint.' we are pleased to place an order for the following material on the terms and conditions mentioned overleaf.';
}
$strtoprint=$strtoprint.'</td></tr></table>';
	$strtoprint=$strtoprint.'<br><br>';
	$strtoprint.='<table class="table table-bordered table-hover" style="width:100%;border: 1px solid black;border-collapse: collapse;">';
	
$strtoprint=$strtoprint.'<tr><td style="border: 1px solid black;border-collapse: collapse;">SNO</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;width:200px;">';
if($row_s['itemstype']=="OTHER")
$strtoprint=$strtoprint.'Description of Material'; 
else
	$strtoprint=$strtoprint.'Description of Software'; 
$strtoprint=$strtoprint.'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">Unit</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">Quantity</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">Unit Price</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;">Discount%</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;">Tax%</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">Total</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;">Department</td>';
$strtoprint=$strtoprint.'</tr>';
		

 $str="SELECT podetail.itemid,qty,mrp,cost,discountper,discountamt,costafterdiscount,deptforwithoutreq,taxper,itemname,unit,description from podetail join itemdetail on podetail.itemid= itemdetail.itemid where poid='$poid'";
					
$rs=mysql_query($str);
$sino=0;	
$totalamount=0;	$totaldiscountprice=0;															
while($rows=mysql_fetch_assoc($rs))
{
	$sino=$sino+1;
$strtoprint=$strtoprint.'<tr><td style="border: 1px solid black;border-collapse: collapse;height:100%;">'.$sino.'</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;width:200px;">';
 $strtoprint=$strtoprint.$rows['itemname'];
if ($rows['description']!='') 
{
$strtoprint=$strtoprint.'<br>('.$rows['description'].')';
}
$strtoprint=$strtoprint.'</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;">'.$rows['unit'].'</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">'.$rows['qty'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['mrp'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['discountper'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['taxper'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['cost'].'</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">'.$rows['deptforwithoutreq'].'</td>';
$strtoprint=$strtoprint.'</tr>';					
	$totalamount=$totalamount+$rows['cost'];
	
			}
		//price/sqr,discount%,discountprice,tax rate,amount	
			$strtoprint=$strtoprint.'<tr><td  colspan="5">&nbsp;</td>';
$strtoprint=$strtoprint.'<td  colspan="2">Grand Total</td>';
$strtoprint=$strtoprint.'<td >'.$totalamount.'</td>';
$strtoprint=$strtoprint.'<td  >&nbsp;</td>';

$strtoprint=$strtoprint.'</tr>';	
			$strtoprint=$strtoprint.'</table>';	
			
	
			$strtoprint.='<div id="ContainerDiv">
    <div id="InnerContainer">
        <div id="TheBelowDiv"><table  style="width:100%;border-collapse: collapse;">';
			$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left;">Please acknowledge the receipt and ensure delivery on time.<br><br>
			Term & Condition:-<br><ol>
<li>All disputes are subject to Ghaziabad jurisdiction only.</li>
<li>Inspection shell be carrying out at our premise and goods not as per specification, shall be rejected.</li>
<li>Rejected material shall be collected by the vendors with in 7 days falling which the same shall be &nbsp;&nbsp;&nbsp;&nbsp;despetched to you at your cost and risk.</li>
<li>No responsibility shall be taken for the rejected material during storage at our end.</li>
<li>All material shall accompany proper test certificate/warranty cards/operation manual etc wherever applicable(supply will not be considered complete without S. No. 5)</li>
</ol><br>
<b>Taxes:</b> '.$row_s['tax'].'<br><b>Freight:</b> '.$row_s['freight'].'<br><b>Delivery:</b> '.$row_s['delivery'].'<br><b>Payment: </b>'.$row_s['payment'].'<br><b>Gaurantee/Warranty, if any:</b> '.$row_s['warranty'].'</td></tr></table>';

		$strtoprint=$strtoprint.'<br><br><br>';
		$strtoprint=$strtoprint.'<table style="width:100%"><tr><td style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td></tr><tr><td style="text-align:center;"><b>Prepared by</b></td><td  style="text-align:center;"><b>Checked by</b></td><td  style="text-align:center;"><b>Authorized Signatory</b></td></tr></table></div></div></div>';
		
			
			
			
			echo $strtoprint;
		}
		}
		
	function displaywords($number)
	{
		$finaloutput="";
   $no = (int)floor($number);
   $point = (int)round(($number - $no) * 100);
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;


     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);


  $points = ($point) ?
    "" . $words[floor($point / 10) * 10] . " " . 
          $words[$point = $point % 10] : ''; 

  if($points != ''){        
  $finaloutput=$finaloutput. $result . "Rupees  and " . $points . " Paise Only";
} else {

    $finaloutput=$finaloutput. $result . "Rupees Only";
}
return $finaloutput;
}	
?>