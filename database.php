<?php
$appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$connStr = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515 options='--application_name=$appName'";

//simple check
$conn = pg_connect($connStr);
/*
$result = pg_query($conn, "select * from public.order_message ");
while ($row = pg_fetch_row($result)) {
  echo "ssss ".$row[0];
}*/
$x1 = pg_escape_string('test');
$x2 = pg_escape_string('test');
$query = "INSERT INTO public.order_message (customer, order) VALUES ('$x1','$x2')";
$result = pg_query($conn, $query);
if($result != null){
  echo "success";
}
pg_close($conn);
?>
