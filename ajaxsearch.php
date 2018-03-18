<?php 
//$con = mysql_connect('10.0.0.12','root','jayERP@357$') or die(mysql_error());
	include 'dbconnection2.php';
//Ajax call for state where values are going to be fetch by country_id
/*
	if(isset($_POST['country_id'])&&!empty($_POST['country_id']))
		{
			$query = mysql_query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");
			$rowCount= mysql_num_rows($query);
			if($rowCount>0)
				{
					echo '<option value="">Select State</option>';
					while($row=mysql_fetch_object($query))
						{
							echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
						}
				}
			else
				{
					echo '<option value"">State Not Available</option>';
				}
		}
*/



//Ajax call for city where values are going to be fetch by state_id



	if(isset($_POST['forgettingvendors'])&&!empty($_POST['forgettingvendors']))
		{
			//$forgettingvendors=$_POST['forgettingvendors'];
			
			$catidforthick=$_POST['forgettingvendors'];
			$catidforthickness=explode(",",$catidforthick);
			$str="";
for($ii=0;$ii<count($catidforthickness);$ii++)
{
	if($catidforthickness[$ii]!="")
	{
		if($str!="")
			$str=$str." or ";
		$str=$str." Category like '%{".$catidforthickness[$ii]."}%'";
	}
}
			
			
			echo $query=mysql_query("Select distinct VendorId,VendorName from vendors where  $str  ");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->VendorId.'">'.$row->VendorName.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
//Ajax call for city where values are going to be fetch by state_id



	if(isset($_POST['state_id'])&&!empty($_POST['state_id']))
		{
			
			
			echo $query=mysql_query("SELECT * FROM  ItemsDetail WHERE Category =".$_POST['state_id']." AND ActiveStatus= 'Y' ORDER BY ItemName ASC");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->ItemId.'">'.$row->ItemName.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
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
			
			
			$query=mysql_query("select distinct itemsdetail.thickness,itemsdetail.catid from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  where itemsdetail.catid in ($allcatids) and thickness!='' order by itemsdetail.thickness");
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
				$query=mysql_query("select distinct itemsdetail.thickness,itemsdetail.catid from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  where thickness!='' order by itemsdetail.thickness");
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
					
		}
		
		//Ajax call for Brands

	if(isset($_POST['thicknesspobrands'])&&!empty($_POST['thicknesspobrands']))
		{
			//$catidforBrands=$_POST['thicknesspobrands'];
						$thicknessforcode1=$_POST['thicknesspobrands'];
			$thicknesarr=explode("^", $_POST['thicknesspobrands']);
			
			
			echo $query=mysql_query("SELECT BrandId,BrandName,brands.CatId,catName from brands join categories on brands.CatId=categories.catId and brands.CatId='$thicknesarr[2]' and BrandName!='' order by BrandName");
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
		
		
		//Ajax call for Brands based on Not Now items.

	if(isset($_POST['brandsbasedonCode1'])&&!empty($_POST['brandsbasedonCode1']))
		{
			
						$thicknessforcode1=$_POST['brandsbasedonCode1'];
			$thicknesarr=explode("^", $_POST['brandsbasedonCode1']);
			
			
			
			
			$sql="SELECT BrandId,BrandName from brands where BrandId in (Select distinct brand from itemsdetail where code1='$thicknesarr[3]') and BrandName!='' order by BrandName";
			
			 $query=mysql_query($sql);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						// echo '<option value="">Select Item</option>';
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
		
		
		
			//Ajax call for Brands for itemdetails

	if(isset($_POST['brandsforitems'])&&!empty(brandsforitems))
		{
			//$catidforBrands=$_POST['thicknesspobrands'];
						$thicknessforcode1=$_POST['brandsforitems'];
			
			
			
			echo $query=mysql_query("SELECT BrandId,BrandName from brands where brands.CatId='$thicknessforcode1' order by BrandName");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->BrandId.'">'.$row->BrandName.'</option>';
							}
							echo '<option value="NOT NOW">NOT NOW</option>';
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
		//Ajax call for godams

	if(isset($_POST['idforgodam'])&&!empty($_POST['idforgodam']))
		{
			 $query1=mysql_query("SELECT distinct godam from godams order by godam");
			$rowCount1=mysql_num_rows($query1);
				if($rowCount1>0)
					{
						echo '<option value="">Select</option>';
						echo '<option value="NONE">NONE</option>';						
						while($row1=mysql_fetch_object($query1))
							{
								echo '<option value="'.$row1->godam1.'">'.$row1->godam1.'</option>';
							}
					}
				else
					{
						echo '<option value="NONE">NONE</option>';						
					}
		}
		
		
		//Ajax call for Brands to stock out

	if(isset($_POST['thicknessbrandsout'])&&!empty($_POST['thicknessbrandsout']))
		{
			
						$thicknessforcode1=$_POST['thicknessbrandsout'];
			$thicknesarr=explode("^", $_POST['thicknessbrandsout']);
			
			
			echo $query=mysql_query("SELECT BrandId,BrandName,brands.CatId,catName from brands join categories on brands.CatId=categories.catId and brands.CatId='$thicknesarr[2]' and BrandName!='' order by BrandName");
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
						echo '<option value"">Item Not Available</option>';
					}
		}
		//Ajax call for fetch Code1 for PO

	if(isset($_POST['thicknessforcode1'])&&!empty($_POST['thicknessforcode1']))
		{
			$thicknessforcode1=$_POST['thicknessforcode1'];
			$thicknesarr=explode("^", $_POST['thicknessforcode1']);
			
			
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
		
		//Ajax call for fetch Code1 for PO

	if(isset($_POST['thicknessforcodetoout'])&&!empty($_POST['thicknessforcodetoout']))
		{
			 $thicknessforcode1=$_POST['thicknessforcodetoout'];
			$thicknesarr=explode("^", $_POST['thicknessforcodetoout']);
			
			
			 $query=mysql_query("select distinct itemsdetail.code1 as coding, code1s.Code1 as codingname from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id   where itemsdetail.thickness='$thicknesarr[0]' and  itemsdetail.catid='$thicknesarr[2]' order by code1s.Code1");
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
		//Ajax call for fetch Code2 for PO

	if(isset($_POST['thicknessforcode2'])&&!empty($_POST['thicknessforcode2']))
		{
			$thicknessforcode2=$_POST['thicknessforcode2'];
			$thicknesarr=explode("^", $_POST['thicknessforcode2']);
			
			
			echo $query=mysql_query("select distinct itemsdetail.code2 as coding, code2s.Code2 as codingname from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  join code2s on itemsdetail.code2=code2s.Code2Id  join code3s on itemsdetail.code3=code3s.Code3Id where itemsdetail.thickness='$thicknesarr[0]' and  itemsdetail.catid='$thicknesarr[2]'  and itemsdetail.code1='$thicknesarr[3]' order by code2s.Code2");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$thicknessforcode2.'^'.$row->coding.'">'.$row->codingname.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
		//Ajax call for fetch Code3 for PO

	if(isset($_POST['thicknessforcode3'])&&!empty($_POST['thicknessforcode3']))
		{
			$thicknessforcode3=$_POST['thicknessforcode3'];
			$thicknesarr=explode("^", $_POST['thicknessforcode3']);
			
			
			echo $query=mysql_query("select distinct itemsdetail.code3 as coding, code3s.Code3 as codingname from itemsdetail  join code1s on itemsdetail.code1=code1s.Code1Id  join code2s on itemsdetail.code2=code2s.Code2Id  join code3s on itemsdetail.code3=code3s.Code3Id where itemsdetail.thickness='$thicknesarr[0]' and itemsdetail.catid='$thicknesarr[2]'  and itemsdetail.code1='$thicknesarr[3]'  and itemsdetail.code2='$thicknesarr[4]' order by code2s.Code2");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$thicknessforcode3.'^'.$row->coding.'^qq">'.$row->codingname.'</option>';
							}
					}
				else
					{
						echo '<option value"">Item Not Available</option>';
					}
		}
		
		//To Get TaxRate
		if(isset($_POST['togettaxrate'])&&!empty($_POST['togettaxrate']))
		{
			
			$thicknesarr=explode("^", $_POST['togettaxrate']);
			
			
			 $query=mysql_query("select distinct taxrate,price,discountrate from itemsdetail   where thickness='$thicknesarr[0]' and catid='$thicknesarr[2]'  and code1='$thicknesarr[3]' ");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						
						while($row=mysql_fetch_object($query))
							{
								echo $row->taxrate.'^'.$row->price.'^'.$row->discountrate;
							}
					}
				else
					{
						echo '0^0^0';
					}
		}
			//To Get Payment Terms
		if(isset($_POST['paymentterms'])&&!empty($_POST['paymentterms']))
		{
			
			$paymentterms= $_POST['paymentterms'];
			
			
			 $query=mysql_query("select * from paymentterms where paymentid in (Select paymenttermid from vendors where VendorId='$paymentterms')");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Payment Terms</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->paymentterm.'">'.$row->paymentterm.'</option>';
							}
					}
				else
					{
						echo '<option value="">Terms Not Available</option>';
					}
		}
		//Ajax call for code1 

	if(isset($_POST['code1Add'])&&!empty($_POST['code1Add']))
		{
			
			
			 $query=mysql_query("SELECT * FROM  Code1s ORDER BY Code1");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Code1</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->Code1.'">'.$row->Code1.'</option>';
							}
					}
				else
					{
						echo '<option value="">Code1 Not Available</option>';
					}
		}
		
		//Ajax call for code2 

	if(isset($_POST['code2Add'])&&!empty($_POST['code2Add']))
		{
			
			
			echo $query=mysql_query("SELECT * FROM  Code2s ORDER BY Code2");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Code2</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->Code2.'">'.$row->Code2.'</option>';
							}
					}
				else
					{
						echo '<option value="">Code2 Not Available</option>';
					}
		}
		
		//Ajax call for Unit1 

	if(isset($_POST['unit1'])&&!empty($_POST['unit1']))
		{
			
			if($_POST['unit1']=="NONE")
			{
			echo $query=mysql_query("SELECT * FROM  units ORDER BY unitName");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->unitName.'">'.$row->unitName.'</option>';
							}
					}
				else
					{
						echo '<option value="">NA</option>';
					}
			}
			else
			{
				//echo '<option value="">Select</option>';
				echo '<option value="sqrmtr">SqrMtr</option>';
				//echo '<option value="sqrft">SqrFt</option>';
			}
		}
		//Ajax call for Widths 

	if(isset($_POST['widths11'])&&!empty($_POST['widths11']))
		{
			$widths11=$_POST['widths11'];
			
			echo $query=mysql_query("SELECT * FROM  widths ORDER BY width");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$widths11.'^'.$row->width.'">'.$row->width.'</option>';
							}
					}
				else
					{
						echo '<option value="'.$widths11.'^NA">NA</option>';
					}
		}
		
	
	//Ajax call for Widths based on brands

	if(isset($_POST['widthsafterbrand'])&&!empty($_POST['widthsafterbrand']))
		{
			$widthsafterbrand=$_POST['widthsafterbrand'];
			
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
						echo '<option value="">NA</option>';
					}
		}
		
	
		
//Ajax call for data to be fetch by city_id

	if(isset($_POST['city_id'])&&!empty($_POST['city_id']))
		{
			$sq = "SELECT Price FROM  Itemsdetail WHERE ItemId=".$_POST['city_id'];
			$query=mysql_query($sq);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						$row=mysql_fetch_object($query); 
							{
								echo $row->Price;
							}
					}				
		}
		
		
		if(isset($_POST['code2catid'])&&!empty($_POST['code2catid']))
		{
			$id=$_POST['code2catid'];
			
			echo $query=mysql_query("Select *  from code2s where catid = '$id'");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Code2</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->Code2Id.'">'.$row->Code2.'</option>';
							}
					}
				else
					{
						echo '<option value="">No Code2 Avaailable.</option>';
					}
		}

if(isset($_POST['PreviousPOPriceValue'])&&!empty($_POST['PreviousPOPriceValue']))
		{
			$allId=$_POST['PreviousPOPriceValue'];
		$allIds=explode('^',$allId);
			
			  $query=mysql_query("SELECT price FROM  podetail where  poid in (select max(poid) from podetail where thickness='$allIds[0]' and 
catid='$allIds[2]' and  code1='$allIds[3]' and brandid='$allIds[4]' and width1='$allIds[5]' and length1='$allIds[6]') and thickness='$allIds[0]' and 
catid='$allIds[2]' and  code1='$allIds[3]' and brandid='$allIds[4]' and width1='$allIds[5]' and length1='$allIds[6]' ");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						
						while($row=mysql_fetch_object($query))
							{
								echo $row->price;
							}
					}
				else
					{
					echo '0';
					}
		}
		
		
			//Ajax call for Lengths 



	if(isset($_POST['lengths11'])&&!empty($_POST['lengths11']))
		{
			$lengths11=$_POST['lengths11'];
			
			echo $query=mysql_query("SELECT * FROM  lengths ORDER BY length");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$lengths11.'^'.$row->length.'">'.$row->length.'</option>';
							}
					}
				else
					{
						echo '<option value="'.$lengths11.'NA">NA</option>';
					}
		}
		
		
		//Ajax call for Lengths for stock out

	if(isset($_POST['lengthsstockout'])&&!empty($_POST['lengthsstockout']))
		{
			
			$lengthsstockout=$_POST['lengthsstockout'];
			
			echo $query=mysql_query("SELECT * FROM  lengths ORDER BY length");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Length</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$lengthsstockout.'^'.$row->length.'">'.$row->length.'</option>';
							}
					}
				else
					{
						echo '<option value="">Lengths Not Available</option>';
					}
		}
		
		//Ajax call for Existing Qty of items

	if(isset($_POST['togetexistingqty'])&&!empty($_POST['togetexistingqty']))
		{
			
			$togetexistingqty=$_POST['togetexistingqty'];
			$txtdata=explode('^',$togetexistingqty);
			
			$str1="select totalqty from inventory where transno=(select max(transno) from inventory where catid='$txtdata[2]' and thickness='$txtdata[0]' and code1='$txtdata[3]' and brandid='$txtdata[4]' and width1='$txtdata[5]' and length1='$txtdata[6]')";
									
			
			 $query=mysql_query($str1);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{						
						while($row=mysql_fetch_object($query))
							{
								echo $row->totalqty;
							}
					}
				else
					{
						echo '0';
					}
		}
		
			//Ajax call for Existing Price of items

	if(isset($_POST['togetexistingprice'])&&!empty($_POST['togetexistingprice']))
		{
			
			$togetexistingqty=$_POST['togetexistingprice'];
			$txtdata=explode('^',$togetexistingqty);
			
			$str1="select newmrp from inventory where transno=(select max(transno) from inventory where catid='$txtdata[2]' and thickness='$txtdata[0]' and code1='$txtdata[3]' and brandid='$txtdata[4]' and width1='$txtdata[5]' and length1='$txtdata[6]')";
									
			
			 $query=mysql_query($str1);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{						
						while($row=mysql_fetch_object($query))
							{
								echo trim($row->newmrp);
							}
					}
				else
					{
						echo '0';
					}
		}
		
		//Ajax call for Existing Qty unit of items

	if(isset($_POST['unittosctockout'])&&!empty($_POST['unittosctockout']))
		{
			
			$togetexistingqty=$_POST['unittosctockout'];
			$txtdata=explode('^',$togetexistingqty);
			
			$str1="select unit from inventory where transno=(select max(transno) from inventory where catid='$txtdata[2]' and thickness='$txtdata[0]' and code1='$txtdata[3]' and brandid='$txtdata[4]' and width1='$txtdata[5]' and length1='$txtdata[6]')";
									
			
			 $query=mysql_query($str1);
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{						
						while($row=mysql_fetch_object($query))
							{
								echo trim($row->unit);
							}
					}
				else
					{
						echo 'NONE';
					}
		}
		
		
		if(isset($_POST['code1catid'])&&!empty($_POST['code1catid']))
		{
			$id=$_POST['code1catid'];
			
			 $query=mysql_query("Select *  from code1s where catid = '$id'");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Item Name</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->Code1Id.'">'.$row->Code1.'</option>';
							}
					}
				else
					{
						echo '<option value="">No Item Name Avaailable.</option>';
					}
		}
		
		if(isset($_POST['code3catid'])&&!empty($_POST['code3catid']))
		{
			$id=$_POST['code3catid'];
			
			 $query=mysql_query("Select *  from code3s where catid = '$id'");
			$rowCount=mysql_num_rows($query);
				if($rowCount>0)
					{
						echo '<option value="">Select Group2</option>';
						while($row=mysql_fetch_object($query))
							{
								echo '<option value="'.$row->Code3Id.'">'.$row->Code3.'</option>';
							}
					}
				else
					{
						echo '<option value="">No Group2 Avaailable.</option>';
					}
		}
?>












