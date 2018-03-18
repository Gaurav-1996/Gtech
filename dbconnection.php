<?php   
	
		$user="root";
		//$host="10.0.0.47";		
		$host="localhost";		
		$Db="final";
		
		//$pass="vin@ITSS!";
		$pass="";
		
		$connect = mysqli_connect($host,$user,$pass,$Db) or die("error connecting");
		
    ?>    
