<?php   
		
		//$con = mysql_connect('10.0.0.47','root','vin@ITSS!') or die(mysql_error());
$con = mysql_connect('localhost','root','') or die(mysql_error());
if($con)
{
	mysql_select_db('final',$con);
	//mysql_select_db('abc',$con);
}

		
    ?>    
