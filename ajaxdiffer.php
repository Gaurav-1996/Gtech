<?php 
//$con = mysql_connect('10.0.0.12','root','jayERP@357$') or die(mysql_error());
	include 'dbconnection2.php';

		//Ajax call for thicknesses

	if(isset($_POST['thicknesspo'])&&!empty($_POST['thicknesspo']))
		{
			$vendorid=$_POST['thicknesspo'];
			if($vendorid!="NONE")
			{
			$str="select distinct Category from vendors where VendorId='$vendorid'";
			$fetching=mysql_query($str);
			$rowCounting=mysql_num_rows($fetching);
				$allcatids='';
				if($rowCounting>0)
					{
						
						while($rowdata=mysql_fetch_object($fetching))
							{
								if($allcatids!='')
									$allcatids=$allcatids.',';
								$allcatids=$allcatids.$rowdata->Category;
							}
					}
			$allcatids=str_replace("{","",$allcatids);
			$allcatids=str_replace("}","",$allcatids);
			//$allcats=explode(",",$allcatids);
			
			
			
			//echo '<option value="'.$allcatids.'">'.$allcatids.'</option>';
			 $str="select distinct itemsdetail.thickness,itemsdetail.catid from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  where itemsdetail.catid in ($allcatids) and thickness!='' order by itemsdetail.thickness";
			
			$query=mysql_query($str);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								if(trim($row->thickness)=="NONE")
									echo '<option value="'.trim($row->thickness).'^NONE^'.$row->catid.'">'.$row->thickness.'</option>';
								else
								echo '<option value="'.trim($row->thickness).'^mm^'.$row->catid.'">'.$row->thickness.' mm</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
			}
			else
			{
				$query=mysql_query("select distinct itemsdetail.thickness from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  where thickness!='' order by itemsdetail.thickness");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								if(trim($row->thickness)=="NONE")
									echo '<option value="'.trim($row->thickness).'^NONE^shashankcatid">'.$row->thickness.'</option>';
								else
								echo '<option value="'.trim($row->thickness).'^mm^shashankcatid">'.$row->thickness.' mm</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
			}
					
		}
		

	//Ajax call for fetch Code1 for inventory

	if(isset($_POST['thicknessforcode1'])&&!empty($_POST['thicknessforcode1']))
		{
			$thicknessforcode1=$_POST['thicknessforcode1'];
			$thicknesarr=explode("^", $_POST['thicknessforcode1']);
			
			if($thicknesarr[2]!="shashankcatid")
			{
			echo $query=mysql_query("select distinct itemsdetail.code1 as coding, code1s.Code1 as codingname from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id   where itemsdetail.thickness='$thicknesarr[0]' and  itemsdetail.catid='$thicknesarr[2]' order by code1s.Code1");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$thicknessforcode1.'^'.$row->coding.'">'.$row->codingname.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
			}
			else
			{
				 $query=mysql_query("select distinct itemsdetail.code1 as coding, code1s.Code1 as codingname, itemsdetail.catid, categories.catName from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id join categories on itemsdetail.catid=categories.catId   where itemsdetail.thickness='$thicknesarr[0]'  order by code1s.Code1");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								//echo '<option value="'.$thicknessforcode1.'^'.$row->coding.'">'.$row->codingname.'('.$row->catName.')</option>';
								echo '<option value="'.$thicknesarr[0].'^'.$thicknesarr[1].'^'.$row->catid.'^'.$row->coding.'">'.$row->codingname.'('.$row->catName.')</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
			}
		}
		
		//Ajax call for Brands

	if(isset($_POST['thicknesspobrands'])&&!empty($_POST['thicknesspobrands']))
		{
			
						$thicknessforcode1=$_POST['thicknesspobrands'];
			$thicknesarr=explode("^", $_POST['thicknesspobrands']);
			
			
			echo $query=mysql_query("SELECT BrandId,BrandName from brands where CatId='$thicknesarr[2]' and BrandName!='' order by BrandName");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->BrandId.'">'.$row->BrandName.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
		
		
		//Ajax call for Brands

	if(isset($_POST['thicknesspobrandsforout'])&&!empty($_POST['thicknesspobrandsforout']))
		{
		
						$thicknessforcode1=$_POST['thicknesspobrandsforout'];
			$thicknesarr=explode("^", $_POST['thicknesspobrandsforout']);
			
			$sql="SELECT BrandId,BrandName from brands where BrandId in (Select distinct brand from itemsdetail where code1='$thicknesarr[3]') and BrandName!='' order by BrandName";
			
			echo $query=mysql_query($sql);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$thicknessforcode1.'^'.$row->BrandId.'">'.$row->BrandName.'</option>';
							}
					}
					else
				{
					
					$sql="SELECT BrandId,BrandName,brands.CatId,catName from brands join categories on brands.CatId=categories.catId and brands.CatId='$thicknesarr[2]' and BrandName!='' order by BrandName";
			
			 $query1=mysql_query($sql);
			$rowCount1=mysql_num_rows($query1);
				if($rowCount1>0)
					{
						echo '<option value="">Select Item</option>';
						while($row1=mysql_fetch_object($query1))
							{
								echo '<option value="'.$thicknessforcode1.'^'.$row1->BrandId.'">'.$row1->BrandName.'</option>';
							}
					}
					}
		}
		
			//Ajax call for Widths based on brands

	if(isset($_POST['widthsafterbrand'])&&!empty($_POST['widthsafterbrand']))
		{
			//5^mm^3^23^10//thickness^mm^catid^itemid^brandid	
				$widthsafterbrand=$_POST['widthsafterbrand'];
			//$thicknesarr=explode("^", $_POST['widthsafterbrand']);
			
			
			
			echo $query=mysql_query("SELECT * FROM  widths ORDER BY width");
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$widthsafterbrand.'^'.$row->width.'">'.$row->width.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
		//Ajax call for Widths based on brands

	if(isset($_POST['lengthsstockout'])&&!empty($_POST['lengthsstockout']))
		{
			
				$widthsafterbrand=$_POST['lengthsstockout'];
			
			
			
			
			echo $query=mysql_query("SELECT * FROM  lengths ORDER BY length");
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$widthsafterbrand.'^'.$row->length.'">'.$row->length.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
			if(isset($_POST['selectedlengthforgodam'])&&!empty($_POST['selectedlengthforgodam']))
		{
			//5^mm^3^23^10//thickness^mm^catid^itemid^brandid	
				$selectedlength=explode("^", $_POST['selectedlengthforgodam']);
				$alldata=$_POST['selectedlengthforgodam'];
			//$thicknesarr=explode("^", $_POST['widthsafterbrand']);
			
			echo $str="SELECT distinct godam FROM inventory where thickness='$selectedlength[0]' and catid='$selectedlength[2]' and code1='$selectedlength[3]' and brandid='$selectedlength[4]' and width1='$selectedlength[5]' and length1='$selectedlength[6]' ORDER BY godam";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$alldata.'^'.$row->godam.'">'.$row->godam.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
			if(isset($_POST['getnormalgodam'])&&!empty($_POST['getnormalgodam']))
		{
			
			
			echo $str="SELECT distinct godam FROM godams ORDER BY godam";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->godam.'">'.$row->godam.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
		
		if(isset($_POST['getnormalshelf'])&&!empty($_POST['getnormalshelf']))
		{
			
			
			echo $str="SELECT distinct shelf FROM shelfs ORDER BY shelf";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->shelf.'">'.$row->shelf.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
		if(isset($_POST['getnormalrack'])&&!empty($_POST['getnormalrack']))
		{
			
			
			echo $str="SELECT distinct rack FROM racks ORDER BY rack";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->rack.'">'.$row->rack.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		
		if(isset($_POST['selectedlengthforshelf'])&&!empty($_POST['selectedlengthforshelf']))
		{
			//5^mm^3^23^10//thickness^mm^catid^itemid^brandid	
				$selectedlength=explode("^", $_POST['selectedlengthforshelf']);
				$alldata=$_POST['selectedlengthforshelf'];
			//$thicknesarr=explode("^", $_POST['widthsafterbrand']);
			
			echo $str="SELECT distinct shelf FROM inventory where thickness='$selectedlength[0]' and catid='$selectedlength[2]' and code1='$selectedlength[3]' and brandid='$selectedlength[4]' and width1='$selectedlength[5]' and length1='$selectedlength[6]' and godam='$selectedlength[7]' ORDER BY shelf";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$alldata.'^'.$row->shelf.'">'.$row->shelf.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
		//selectedlengthforrack
		
			if(isset($_POST['selectedlengthforrack'])&&!empty($_POST['selectedlengthforrack']))
		{
			//5^mm^3^23^10//thickness^mm^catid^itemid^brandid	
				$selectedlength=explode("^", $_POST['selectedlengthforrack']);
				$alldata=$_POST['selectedlengthforrack'];
			//$thicknesarr=explode("^", $_POST['widthsafterbrand']);
			
			echo $str="SELECT distinct rack FROM inventory where thickness='$selectedlength[0]' and catid='$selectedlength[2]' and code1='$selectedlength[3]' and brandid='$selectedlength[4]' and width1='$selectedlength[5]' and length1='$selectedlength[6]' and godam='$selectedlength[7]' and shelf='$selectedlength[8]' ORDER BY rack";
			
			 $query=mysql_query($str);
			
			
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$alldata.'^'.$row->rack.'">'.$row->rack.'</option>';
							}
					}
				else
					{
						echo '<option value="">NONE</option>';
					}
		}
?>











