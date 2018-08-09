<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Путешествия</title>
</head>
<body>
	<?php 
		if(trim($_POST['number']))
		{
			$y = is_integer(+$_POST['number']) ? $_POST['number']:null;
			if($y)
			{
				$country = $_POST['country'];
				$discount = $_POST['discount'] === NULL ? 0:0.05;
				$x = $country === 'Испания' ?0.15:($country === 'Италия' ? 0.1 : 0);
				$sum = (1+$x)*(1-$discount)*$y*400;
				echo $sum;
			}else return;
		}
	?>
<form action="2.php" method="post">
	<label>Страна:</label>
	<select name="country">
		<option>Испания</option>
		<option>Италия</option>
		<option>Турция</option>
	</select>
	<label>Количество дней:</label>
	<input type="text" name="number">
	<label>Скидка</label>
	<input type="checkbox" name="discount">
	<button>Заказать</button>
</form>
</body>
</html>