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

		
		if(isset($_POST['mrno'])&&!empty($_POST['mrno']))
		{
			
			$mrno=$_POST['mrno'];
			
 $str="Select distinct mrno, vendorname,vendors.contactperson,address,mobile,email, vehicleno,challanno,gateentryno,dateofchallan,arrivaltime FROM inventory JOIN vendors ON inventory.vendorid = vendors.vendorid where mrno='$mrno' limit 1";
			
			$strtoprint='<table  style="width:100%;border-collapse: collapse;">';
			
			//echo $str;
	
			$r_s=mysql_query($str);
																	
			while($row_s=mysql_fetch_assoc($r_s))
			{
				//echo "shashank1";
	$strtoprint=$strtoprint.'<tr><td style="width:95px;vertical-align:top;border-collapse: collapse;"><img width="140px" height="120px" src="images/KIET.jpg"';
				
				$strtoprint=$strtoprint.'></td>';
				//if($row_s['pofor']=="KIET")
				//{
				$strtoprint=$strtoprint.'<td  style="border-collapse: collapse;text-align:center"><span style="font-size:26px;"><b>KIET GROUP OF INSTITUTIONS, GHAZIABAD</b></span><br>13 KM STONE, GHAZIABAD-MEERUT ROAD, GHAZIABAD - 201206(U.P.)<br><br><br></td></tr>';
				//}
				//if($row_s['pofor']=="TBI")
				//{
				//$strtoprint=$strtoprint.'<td  style="border-collapse: collapse;text-align:center"><span style="font-size:21px;"><b>Technology Business Incubator - KIET</b></span><br>(Promoted by: National Science & Technology Entrepreneurship Development Board)<br>Ministry of Science & Technology, Govt. of India, New Delhi - 110033<br><br><br></td></tr>';
				//}
				
	$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:center" colspan="4"><span style="font-size:21px;"><b><u>Material Receipt Form</u></b></span></td></tr>';	

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left" colspan="2"><span style="font-size:14px;"><b>Material Receipt No.: </b></span>';
$strtoprint=$strtoprint.$row_s['mrno'];
$strtoprint=$strtoprint.'</td></tr>';	

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left" colspan="2"><span style="font-size:14px;"><b>Name of Supplier: </b></span>';
$strtoprint=$strtoprint.$row_s['vendorname'];
$strtoprint=$strtoprint.'</td></tr>';

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left" colspan="2"><span style="font-size:14px;"><b>Vehicle No.: </b></span>';
$strtoprint=$strtoprint.$row_s['vehicleno'];
$strtoprint=$strtoprint.'</td><td style="vertical-align:top;border-collapse: collapse;text-align:right" colspan="2"><span style="font-size:14px;"><b>Date: </b></span>';

$dd=explode("-",$row_s['dateofchallan']);
	$strtoprint=$strtoprint.$dd[2].'-'.$dd[1].'-'.$dd[0];
$strtoprint=$strtoprint.'</td></tr>';

$strtoprint=$strtoprint.'<tr><td style="vertical-align:top;border-collapse: collapse;text-align:left" colspan="2"><span style="font-size:14px;"><b>Gate Entry No.: </b></span>';
$strtoprint=$strtoprint.$row_s['gateentryno'];
$strtoprint=$strtoprint.'</td><td style="vertical-align:top;border-collapse: collapse;text-align:right" colspan="2"><span style="font-size:14px;"><b>Arrival Time: </b></span>'.$row_s['arrivaltime'].'</td></tr></table>';


	$strtoprint=$strtoprint.'<br><br>';
	$strtoprint.='<table class="table table-bordered table-hover" style="width:100%;border: 1px solid black;border-collapse: collapse;">';
	
$strtoprint=$strtoprint.'<tr><td style="border: 1px solid black;border-collapse: collapse;" >SNO</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;width:200px;" >Description of Material</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;" >Unit</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">Received<br>Qty</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">Accepted<br>Qty</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">Rejected<br>Qty</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;" >Value</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;" >Stock Ledger No</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;" >Remark</td>';

$strtoprint=$strtoprint.'</tr>';
		


 $str="SELECT distinct inventory.itemid, inqty, rejectqty,newmrp, itemname,unit,description,contactperson,receivingperson,deptid,remark, totalamountprice from inventory join itemdetail on inventory.itemid=itemdetail.itemid where mrno='$mrno'";
					
$rs=mysql_query($str);
$sino=0;	
	$dept="";
$receivingperson="";
	
while($rows=mysql_fetch_assoc($rs))
{
	$sino=$sino+1;
$strtoprint=$strtoprint.'<tr ><td style="border: 1px solid black;border-collapse: collapse;height:100%;" >'.$sino.'</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;width:200px;">';
 $strtoprint=$strtoprint.$rows['itemname'];
if ($rows['description']!='') 
{
$strtoprint=$strtoprint.'<br>('.$rows['description'].')';
}
$strtoprint=$strtoprint.'</td>';
$strtoprint=$strtoprint.'<td style="border: 1px solid black;border-collapse: collapse;">'.$rows['unit'].'</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">'.$rows['inqty'].'</td>';
$strtoprint=$strtoprint.'<td   style="border: 1px solid black;border-collapse: collapse;">'.$rows['inqty'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['rejectqty'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['totalamountprice'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">KIET/P/0'.$rows['itemid'].'</td>';
$strtoprint=$strtoprint.'<td  style="border: 1px solid black;border-collapse: collapse;">'.$rows['remark'].'</td>';
$strtoprint=$strtoprint.'</tr>';					
	
	$dept=$rows['deptid'];
$receivingperson=$rows['receivingperson'];
			}
		
		
			$strtoprint=$strtoprint.'</table>';	
			
	
		

		$strtoprint.='<div id="ContainerDiv">
    <div id="InnerContainer">
        <div id="TheBelowDiv">';
		$strtoprint=$strtoprint.'<table style="width:100%"><tr><td style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td></tr><tr><td style="text-align:center;"><b>Received By</b></td><td  style="text-align:center;"><b>Inspected by</b></td><td  style="text-align:center;"><b>Approved By</b></td></tr>
		
		<tr><td style="text-align:center;"><b>Issue/Forwarding/Details<br>Deaprtment/Area</b></td><td  style="text-align:center;"><b>Person Receiving</b></td><td  style="text-align:center;">&nbsp;</td></tr>
		
		<tr><td style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;">&nbsp;</td></tr>
		<tr><td style="text-align:center;"><b>'.$dept.'</b></td><td  style="text-align:center;"><b>'.$receivingperson.'</b></td><td  style="text-align:center;">&nbsp;</td></tr>
		<tr><td style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;"><img src="images/line.jpg"></td><td  style="text-align:center;">&nbsp;</td></tr>
		
		
		</table></div></div></div>';
		
			
			
			
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