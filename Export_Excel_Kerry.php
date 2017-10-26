<?php
	include './database.php';
	$data = GetOrderToExcel();
	$filename = "export_order_kerry.xls";
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
			    for($i=0; $i < count($data);$i++)
			    {
						$arr = explode("\n",$data[$i]);
						$arr3 = explode(" ",$arr[3]);
						$arr4 = explode(" ",$arr[4]);
						$index=0;
						foreach($arr4 as $val){
								preg_match('/[^\d]+/', $val, $textMatch);
								preg_match('/\d+/', $val, $numMatch);

								$text = $textMatch[0];
								$num = $numMatch[0];

								if(!empty($text) && !empty($num)){
									$name_product[$index] = $text;
									$amount_product[$index] = $num;
									$index++;
								}
						}?>
			    	<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $arr[0]; ?></td>
							<td><?php echo $arr[1]; ?></td>
							<td></td>
							<td><?php echo $arr[2]; ?></td>
							<td>
							<?php
							for($j=0;$j < count($arr3)-1;$j++){
								echo $arr3[$j]." ";
							}
							echo "***";
							for($j=0;$j < $index;$j++){
								echo $name_product[$j].$amount_product[$j];
							}
							echo "***";
							?></td>
							<td><?php echo end($arr3); ?></td>
							<td><?php echo end($arr); ?></td>
						</tr>
			    <?php }
			?>
    	</table>
    </body>
</html>
