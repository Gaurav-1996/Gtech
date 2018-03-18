<?php 
//$con = mysql_connect('10.0.0.12','root','jayERP@357$') or die(mysql_error());
	include 'dbconnection2.php';
	
		if(isset($_POST['fetchallitems'])&&!empty($_POST['fetchallitems']))
		{
			
			
			 $query=mysql_query("SELECT itemid, itemname, itemcatid, unit, rate, taxrate, description, company, categories.category,itemdetail.activestatus FROM itemdetail join categories on itemcatid=categoryid order by categories.category,itemname");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->itemid.'">'.$row->itemname.'->'.$row->category.': ('.$row->description.', '.$row->company.')</option>';
							}
					}
				else
					{
						echo '<option value="">No Item Available.</option>';
					}
		}
		
		if(isset($_POST['fetchalldepartments'])&&!empty($_POST['fetchalldepartments']))
		{
			
			
			 $query=mysql_query("SELECT itemid, itemname, itemcatid, unit, rate, taxrate, description, company, categories.category,itemdetail.activestatus FROM itemdetail join categories on itemcatid=categoryid order by categories.category,itemname");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->itemid.'">'.$row->itemname.'->'.$row->category.': ('.$row->description.', '.$row->company.')</option>';
							}
					}
				else
					{
						echo '<option value="">No Item Available.</option>';
					}
		}
		
			if(isset($_POST['fetchitemunit'])&&!empty($_POST['fetchitemunit']))
		{
			$itemid=$_POST['fetchitemunit'];
			
			 $query=mysql_query("SELECT unit,rate,taxrate,discountrate FROM itemdetail where itemid='$itemid'");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						
						while($row=mysql_fetch_object($query))
							{
								echo $row->unit.'^'.$row->rate.'^'.$row->taxrate.'^'.$row->discountrate;
							}
					}
				else
					{
						echo 'NONE';
					}
		}
		
				if(isset($_POST['findexistingqty'])&&!empty($_POST['findexistingqty']))
		{
			
			$itemid=$_POST['findexistingqty'];
			 $query=mysql_query("select  balanceqty from inventory where transno=(select max(transno) from inventory where itemid='$itemid')");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						
						while($row=mysql_fetch_object($query))
							{
								echo $row->balanceqty;
							}
					}
				else
					{
						echo '0';
					}
					
		}
		
?>












