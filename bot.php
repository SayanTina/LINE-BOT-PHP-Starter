<?php
include './config.php';
include './database.php';
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back

			switch($text){
				case "all order":
					$splitdata = "get all\n";
					$splitdata .= getAll();
					break;
				case "Excel":
					$splitdata = "Excel file";
					$splitdata .= export_excel();
					break;
				default:
					$splitdata = "another case\n";
					$splitdata .= splitmessage($text);
					break;
			}

			$messages = [
				'type' => 'text',
				'text' => $splitdata
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
function splitmessage($messageIn){
	$result = explode("!",$messageIn);
	$message = "ADD\n--Customer--\n".$result[0]."\n--Order--\n".$result[1]."\n";
	$message .= AddOrder($result);
	return $message;
}
function getAll(){
	$result = GetOrderAll();
	return $result;
}
function export_excel(){  
	return "\nhttps://message2order.herokuapp.com/Export_Excel.php";
}
echo "OK";
?>