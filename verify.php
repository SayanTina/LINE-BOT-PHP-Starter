<?php
$access_token = 'c6PwuacjH6iwxhzpfzerZJMqpm3B3GZVxxNkmlygPKjodNlhfGcx7rSnrw+BhSvLMs7C89ue1SUoxpY16K5GrTGo1kTXBTXZqPKdyTautrmD0ZXOkolhCSIZjVq3h+OKA24HCODBYaxBKv5HG58uAQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;