<?php

function ConnectStatus(){
	$dbconn = pg_connect($connStr);
	$stat = pg_connection_status($dbconn);
	if ($stat === PGSQL_CONNECTION_OK){
		echo 'Connection status ok';
		$result = false;
	} else {
		echo 'Connection status bad';
		$result = true;
	}
	return $result;
}

function AddOrder($messageOrder){
	if(ConnectionStatus()) return;
	$m1 = pg_escape_string($messageOrder[0]);
	$m2 = pg_escape_string($messageOrder[1]);
	$query = "INSERT INTO public.order_message VALUES ('$x1','$x2')";
	$result = pg_query($conn, $query);
	if($result != null){
	  echo "success";
	}
	pg_close($conn);
}

function GetOrderAll(){
	if(ConnectionStatus()) return;
	$result = pg_query($conn, "select * from public.order_message ");
	$i=1;
	while ($row = pg_fetch_row($result)) {
		$message .= "No.".$i;
	    $message .= "\nCustomer:\n".$row[0];
	    $message .= "\nOrder:\n".$row[1]."\n\n";
	}
	pg_close($conn);
	return $message;
}
?>
