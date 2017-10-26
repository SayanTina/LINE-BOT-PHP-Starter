<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
$comment = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
}
function test_input($data) {
/*  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);*/
	echo "-------Data in-------\n".$data."\n-------Data in-------\n\n";
    
    echo "-------Out put-------\n";
	$arr = explode("\n",$data);
	echo "name: ".$arr[0].
	"\nTelephone: ".$arr[1].
	"\nAddress 1: ".$arr[2]."\n";

	$arr3 = explode(" ",$arr[3]);
	$count_arr3 = count($arr3);
	$i=0;
	echo "Address 2: ";
	foreach ($arr3 as $value) {
		if($i < $count_arr3-1){
			echo $value." ";
			$i++;
		}
	}
	echo "\nPost: ".$arr3[$count_arr3-1]."\n";

	$arr4 = explode(" ",$arr[4]);
	echo "Order: ";
	foreach($arr4 as $val){
	    preg_match('/[^\d]+/', $val, $textMatch);
	    preg_match('/\d+/', $val, $numMatch);

	    $text = $textMatch[0];
	    $num = $numMatch[0];
		
    	echo "name: ".$text;
    	echo " amount: ".$num." ";
	}
	
	echo "\nPrice: ".$arr[5]."\n";
  return $data;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
	<br><br>
  <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
<?php
echo $comment;
echo "<br>";
?>
