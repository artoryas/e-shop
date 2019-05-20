<?php 
include 'header.php';
	$ram=R::getAll('select * from products where type="ram"');
	$data = $_POST;
	if (isset($data['addToBag'])) {
		$message = array();
		if (isset($_SESSION['logged_user'])) {
			if (R::count('bag',"client = ? AND product = ?", array($_SESSION['logged_user']->id,$data['prodId'])) > 0 ) {
				$message[] = "Товар уже добавлен в корзину!";
			}else{
				$bag = R::dispense('bag');
				$bag->client = $_SESSION['logged_user']->id;
				$bag->product = $data['prodId'];
				$bag->amount = $data['amount'];
				$bag->toPay = $data['amount'] * $data['price'];
				R::store($bag);
				$message[] = "Товар успешно добавлен в вашу корзину!";
			}
	}else{
		header('Location: login.php');
	}
}
	?>
	<div class="wrap">
		<?php if (!empty($message)) {
					echo "<div style='color:green; text-align:center;font-weight:bold; font-size:16px; margin-top:30px;'>".array_shift($message)."</div>";
				} ?>
		<div class="main">
			<?php 
				foreach($ram as $row){
   				echo "
   				<div class='product'>
   				<form method='POST'>
   						<input type='hidden' name='prodId' value='".$row['id']."'>
						<img class='product__img' src='./img/".$row['img']."'>
						<div class='product__title'>".$row['name']."</div>
						<div class='product__specs'>
							<p style='width:300px; margin-bottom:10px;'><b>Производитель: </b>".$row['manufacturer']."</p>
							<p><b>Цена: </b>".$row['price']." KZT</p>
						</div>
						<input type='hidden' value='".$row['price']."' name='price'>
						<div class='amount'><b>Количество: </b><input type='number' name='amount' class='num' value='1' min='1' style='width:100px;'></div>
						<button type='submit' name='addToBag' class='button'>В корзину</button>";
		    		if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->moder == 1) {
				echo "<button type='submit' name='deleteFromDB'>Удалить</button>";}
		    	echo "</form></div>";
			}
			?>
		</div>	
	</div>
<?php
include 'footer.php';
?>