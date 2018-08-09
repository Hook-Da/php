<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Polindrome</title>
</head>
<?php 
	if(isset($_POST['poly'])){
		$str = strtolower($_POST['poly']);
		$str = preg_replace('/[\s+()_,.-\/]/', '', $str);
		$half1 = ''; $half2 = '';
  		$l = strlen($str);
  	if($l%2==0)
  	{
  		$half1 = substr($str,0,0.5*$l);
  		$half2 = substr($str,0.5*$l);
  	}else{
  		$half1 = substr($str,0,(0.5*($l-1)));
  		$half2 = substr($str,0.5*($l+1));
  	}
  		$half1 = strrev($half1);
  		//echo $half1.' - '.$half2;
  		echo $half1 === $half2 ? 'polindrome':'not polindrome'; 
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