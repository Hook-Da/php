<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Polindrome</title>
</head>
<?php 
	if(isset($_POST['poly'])){
		$str = mb_strtolower($_POST['poly']);
		$str = preg_replace('/[\s+()_,-.-\/]/', '', $str);
		$newString = '';
		for($i = mb_strlen($str); $i >= 0; $i--)
		{
			$newString .= mb_substr($str,$i,1);
		}
  		echo $str === $newString ? 'polindrome':'not polindrome'; 
	}
?>
<body>
	<form action="3.php" method="post">
	<label>Текст:</label>
	<input type="text" name="poly">
	<button>Submit</button>
	</form>
</body>
</html>
