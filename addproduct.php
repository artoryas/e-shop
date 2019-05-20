<?php 
require 'header.php';

	$add=$_POST;
		if (isset($add['addProduct'])) {
			$errors = array();
			if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
				$errors[] = 'Загрузите фотографию продукта!';
			}	
			if (empty($add['name']) || empty($add['manufacturer']) || empty($add['price'])) {
				$errors[] = 'Заполните все поля!';
				}
			// if ($_FILES['image']['size'] > 2000000){    если есть ограничения по размеру
			// 	$errors[] = 'Файл превышает 2 мб';
			// }
			if (empty($errors)) {
					$filename = $_FILES['image']['name'];
					$file_tmp = $_FILES['image']['tmp_name'];
					$file_type = $_FILES['image']['type'];

					$temp = explode(".", $_FILES["image"]["name"]);
					$newfilename = $add['name'] . '.' . end($temp);

					move_uploaded_file($file_tmp, "./img/".$newfilename);

					$product = R::dispense('products'); //проверка на наличие таблицы users. Если нет, то создаст
					$product->name = $add['name'];
					$product->manufacturer = $add['manufacturer'];
					$product->price = $add['price'];
					$product->type = $add['type'];
					$product->img = $newfilename;
					R::store($product);
			}else{
				echo "<div style='color:red; text-align:center;font-weight:bold; font-size:16px; margin-top:30px;'>".array_shift($errors)."</div>";
			}
		}
			
?>
<div class="wrap">
	<form method="POST" enctype="multipart/form-data">
		<label>Название товара</label>
		<input type="text" name="name">
		<br>
		<label>Производитель</label>
		<input type="text" name="manufacturer">
		<br>
		<label>Тип</label>
		<select name="type">
			<option value="videocard">Видеокарта</option>
			<option value="cpu">Процессор</option>
			<option value="ram">Оперативная память</option>
			<option value="hdd">Жесткий диск</option>
			<option value="motherboard">Материнская плата</option>
			<option value="case">Кейс</option>
		</select>
		<br>
		<label>Цена</label>
		<input type="number" name="price">
		<br>
		<label>Фото</label>
		<input type="file" name="image">
		<button type="submit" name="addProduct">Add product</button>
	</form>
</div>
<?php
require 'footer.php'
?>