<?php

function AddOrder($messageOrder){
	$dbconn = pg_connect($connStr);
	$m1 = pg_escape_string($messageOrder[0]);
	$m2 = pg_escape_string($messageOrder[1]);
	$query = "INSERT INTO public.order_message VALUES ('$x1','$x2')";
	$result = pg_query($dbconn, $query);
	if($result != null){
	  echo "success";
	}
	pg_close($dbconn);
}

function GetOrderAll(){
	$dbconn = pg_connect($connStr);
	$result = pg_query($dbconn, "select * from public.order_message ");
	$i=1;
	while ($row = pg_fetch_row($result)) {
		$message .= "No.".$i;
	    $message .= "\nCustomer:\n".$row[0];
	    $message .= "\nOrder:\n".$row[1]."\n\n";
	}
	pg_close($dbconn);
	return $message;
}
?>
