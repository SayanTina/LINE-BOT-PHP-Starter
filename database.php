<?php
function AddOrder($messageOrder){
	$connStrs = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515";
	$dbconn = pg_connect($connStrs);
	$reval = "0";
	if($dbconn == null){
		$reval = "failed";
		return $reval;
	}
	$m1 = pg_escape_string($messageOrder[0]);
	$m2 = pg_escape_string($messageOrder[1]);
	$query = "INSERT INTO public.order_message VALUES ('$m1','$m2')";
	$result = pg_query($dbconn, $query);
	if($result != null){
	  $reval = "success";
	}
	pg_close($dbconn);
	return $reval;
}

function GetOrderAll(){
	$connStrs = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515";
	$dbconn = pg_connect($connStrs);
	$reval = "0";
	if($dbconn == null){
		$reval = "failed";
		return $reval;
	}
	$result = pg_query($dbconn, "SELECT * FROM public.order_message");
	$i=1;
	while ($row = pg_fetch_row($result)) {
		$message .= "No.".$i;
	    $message .= "\nCustomer:\n".$row[0];
	    $message .= "\nOrder:\n".$row[1]."\n\n";
	    $i++;
	}
	pg_close($dbconn);
	return $message;
}
/*function GetOrderToExcel(){
	$connStrs = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515";
	$dbconn = pg_connect($connStrs);
	$reval = "0";
	if($dbconn == null){
		$reval = "failed";
		return $reval;
	}
	$result = pg_query($dbconn, "SELECT * FROM public.order_message");
	$i=1;
	while ($row = pg_fetch_row($result)) {
		$message[$i-1] .= "No.".$i;
	    $message[$i-1] .= "\nCustomer:\n".$row[0];
	    $message[$i-1] .= "\nOrder:\n".$row[1]."\n\n";
	    $i++;
	}
	pg_close($dbconn);
	return $message;
}
*/
?>
