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

echo "config success";
?>