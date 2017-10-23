<?php

/* 
#######	Config ############
line bot Message2Order
*/

$access_token = 'd60OWyK4zeSC9zmA9H/qSFQ/42MFixasGHIFcWtToOTgY+DhNly2tOksBsNCLTJIMs7C89ue1SUoxpY16K5GrTGo1kTXBTXZqPKdyTautrl2IYWFOP0sUAETOQgJkWdz70UT24PAA9jPHUPPUcq7nwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

//postgres config
$connStr = "host=ec2-54-204-41-80.compute-1.amazonaws.com port=5432 dbname=ddtqgibulmg329 user=xcouzcymallahy password=8110ad5d0c0f0f169502f0f61ce449a2704cbacc4f8d71b0aecf325701bca515";

echo "config success";
?>