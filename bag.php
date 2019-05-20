<?php 
	include 'header.php';
	if (isset($_SESSION['logged_user'])) { //проверяем авторизован ли пользователь
		$products=R::getAll('select products.name, bag.id, products.manufacturer, products.price, bag.amount, bag.to_pay from bag, products where bag.product = products.id and bag.client="'.$_SESSION['logged_user']->id.'"'); // выгружаем все продукты из таблицы корзины
	}else{
		header('Location: login.php');
	}
	$remove=$_POST;
	if (isset($remove['delete'])) { //удаление товара из корзины
		R::exec('delete from bag where client = "'.$_SESSION['logged_user']->id.'" AND id = "'.$remove['prodId'].'"');
		echo "<meta http-equiv='refresh' content='0'>"; //обновление страницы после удаления товара
	}
	if (isset($_POST['doOrder'])) {
			$bag = R::getAll('select * from bag where client = "'.$_SESSION['logged_user']->id.'"'); //копируем товары с корзины
			date_default_timezone_set('Asia/Almaty');
			foreach ($bag as $row) {
			$order = R::dispense('orders');
			$order->client = $_SESSION['logged_user']->id; //заполнение данных в таблицу
			$order->product = $row['product'];
			$order->amount = $row['amount'];
			$order->to_pay = $row['to_pay'];
			$order->order_date = date("F j, Y, G:i a");
			R::store($order);
			}
			$logtext = "Оформлен новый заказ пользователем ".$_SESSION['logged_user']->login;
			addLog($logtext);
			R::exec('delete from bag where client = "'.$_SESSION['logged_user']->id.'"'); //удаление товаров из корзины после оформления заказа
			echo "<meta http-equiv='refresh' content='0'>";
	}
	?>
	<div class="wrap">
		<div class="empty">
			<div class="flex">
				<b class="width">Товар</b>
				<b class="width">Производитель</b>
				<b class="width">Количество</b>
				<b class="width">Цена</b>
				<b class="width">Сумма</b>
			</div>
				<?php 
					if (count($products)>0) { //проверяется пуста ли корзина
					foreach($products as $row){ //динамическая выкладка товаров
	   				echo 
	   				"<form method='POST'> 
	   					<input type='hidden' value='".$row['id']."' name='prodId'>
						<div class='flex'>
							<div class='width'>".$row['name']."</div>
							<div class='width'>".$row['manufacturer']."</div>
							<div class='width'>".$row['amount']."</div>
							<div class='width'>".$row['price']." KZT</div>
							<div class='width'>".$row['to_pay']." KZT</div>
							<div><button name='delete' type='submit'>Удалить</button></div>
						</div>
	   				</form>";
						}
					echo "<form method='POST'>
							<button type='submit' name='doOrder' onclick='order()'>Оформить заказ</button>
						  </form>";
					}else{
						echo "<div style='text-align:center;font-weight:bold; font-size:16px; margin-top:30px;'>Ваша корзина пуста!</div>";
					}
					
				?>
		</div>
	</div>
	<?php
	include 'footer.php';
?>