<?php
	include './database.php';
	$data = GetOrderToExcel();
	$file_ending = "xls";
	$filename = "export_order"; 
	//header info for browser
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	/*******Start of Formatting for Excel*******/   
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character
	//start of printing column names as names of MySQL fields
	print("\n");    
	//end of printing column names  
	//start while loop to get data
    $schema_insert = "";
    for($i=0; $i<count($data);$i++)
    {
    	if($i%2 == 0){
    		$schema_insert.= "$data[$i]"."\n";
    	}else{
    		$schema_insert.= "$data[$i]".$sep;
    	}
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
?>