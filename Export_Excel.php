<?php
	include './database.php';
	$data = GetOrderToExcel();
	$filename = "export_order.xlsx"; 
	//header info for browser
	header('Content-type: application/excel');
	header('Content-Disposition: attachment; filename='.$filename);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $filename; ?></title>
        <style>
			table,th,td{
				border: 1px solid black;
				border-collapse:collapse;
				text-align:center;
			}
		</style>
    </head>
    <body>
    	<table>	
			<?php
			    for($i=0; $i<count($data);$i++)
			    {
			    	if($i%2 == 0){?>
			    	<tr>
			    		<td><?php echo "$data[$i]"; ?></td><?php
			    	}else{?>
			    		<td><?php echo "$data[$i]"; ?></td></tr><?php
			    	}
			    }
			?>
    	</table>
    </body>
</html>