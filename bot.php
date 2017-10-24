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
					createExcel(GetOrderToExcel());
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
function createExcel($data){
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	/** Include PHPExcel */
	require_once dirname(__FILE__) . './Classes/PHPExcel.php';

	// Create new PHPExcel object
	echo date('H:i:s') , " Create new PHPExcel object" , EOL;
	$objPHPExcel = new PHPExcel();

	// Set document properties
	echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("Sayan Tina")
								 ->setLastModifiedBy("Sayan Tina")
								 ->setTitle("PHPExcel Test Document")
								 ->setSubject("PHPExcel Test Document")
								 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
								 ->setKeywords("office PHPExcel php")
								 ->setCategory("Test result file");

	// Add some data
	echo date('H:i:s') , " Add some data" , EOL;
	$count = count($data);
	$row = 1;
	for($i = 0; $i < $count; $i++){
		if($i%2 == 0){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $data[$i]);
		}else{
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $data[$i]);
			$row++;
		}
	}

   // Rename worksheet
   echo date('H:i:s') , " Rename worksheet" , EOL;
   $objPHPExcel->getActiveSheet()->setTitle('Simple');


   // Set active sheet index to the first sheet, so Excel opens this as the first sheet
   $objPHPExcel->setActiveSheetIndex(0);


   // Save Excel 2007 file
   echo date('H:i:s') , " Write to Excel2007 format" , EOL;
   $callStartTime = microtime(true);

   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
   $callEndTime = microtime(true);
   $callTime = $callEndTime - $callStartTime

}
echo "OK";