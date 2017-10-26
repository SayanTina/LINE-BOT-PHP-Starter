<?php
function AddOrder($messageOrder){
	$connStrs = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515";
	$dbconn = pg_connect($connStrs);
	$reval = "0";
	if($dbconn == null){
		$reval = "failed";
		return $reval;
	}
	$result_check_message = CheckPatternMs($messageOrder); 
	if($result_check_message != "success"){
		return $result_check_message;
	}
	$query = "INSERT INTO public.order_message VALUES ('$messageOrder')";
	$result = pg_query($dbconn, $query);
	if($result != null){
	  $reval = "success";
	}
	pg_close($dbconn);
	return $reval;
}
function CheckPatternMs($data){
	/*
	--------- data in ----------
	name surname
	000-0000000
	address1
	address2 00000
	product0
	CostAll
	*/
	$arr = explode("\n",$data);
	$arr3 = explode(" ",$arr[3]);
	$arr4 = explode(" ",$arr[4]);
	$i=0;
	$message_return = "success";
	foreach($arr4 as $val){
	    preg_match('/[^\d]+/', $val, $textMatch);
	    preg_match('/\d+/', $val, $numMatch);

	    $text = $textMatch[0];
	    $num = $numMatch[0];
		
    	if(!empty($text) && !empty($num)){
    		$name_product[$i] = $text;
    		$amount_product[$i] = $num;
    		$i++;
    	}
	}
	if(empty(end($arr3))){
		$message_return = "Error post code";
	}
	if($i == 0){
		$message_return = "Error order".$i;
	}
	if(empty($arr[5])){
		$message_return = "Missing Cost all";
	}
	return $message_return;
}
?>

