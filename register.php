<?php 
	include 'header.php';
	$data = $_POST;
	if(isset($data['do_register'])){ //нажатие кнопки "регистрация"
		$errors = array(); //создание массива куда будут записываться ошибки
		if (trim($data['login']) == '') { //проверка на пустые строки
			$errors[] = 'Введите логин!';
		}
		if ($data['password'] == '') {
			$errors[] = 'Введите пароль!';
		}
		if ($data['password_2'] != $data['password']) {
			$errors[] = 'Пароли не совпадают!';
		}
		if (trim($data['number']) == '') {
			$errors[] = 'Введите мобильный номер!';
		}
		if (trim($data['email']) == '') {
			$errors[] = 'Введите электронную почту!';
		}
		if (R::count('users',"login = ? OR email = ?", array($data['login'], $data['email'])) > 0 ) {
			$errors[] = "Такой логин или email уже зарегистрирован!";
		}

		if (empty($errors)) {
			date_default_timezone_set('Asia/Almaty');
			$user = R::dispense('users'); //проверка на наличие таблицы users. Если нет, то создаст
			$user->login = $data['login'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			$user->number = $data['number'];
			$user->email = $data['email'];
			$user->city = $data['city'];
			$user->register_date = date("F j, Y, G:i a");
			R::store($user); //запись данных в таблицу из $user
			$logtext = "Зарегистрирован новый пользователь ".$data['login'];
			addLog($logtext);
			header('Location: login.php');
		}else{
			echo "<div style='color:red; text-align:center;font-weight:bold; font-size:16px; margin-top:30px;'>".array_shift($errors)."</div>";
			}
	 }	
?>	
	<style type="text/css">
		.form{
			padding: 50px 40%;
		}
		.elem{
			padding-top: 20px;
		}
		.input_title{
		    font-size: 20px;
		    font-weight: bold;
		}
		.input{
			padding: 5px;
			border-radius: 10px;
			border: 1px solid;
			width: 280px;
		}
		button{
			font-size: 20px;
			border-radius: 5px;
			font-weight: bold;
		}
	</style>
	<div class="wrap">
		<div class="form">
			<form action="register.php" method="POST">
				<p class="elem">
					<p class="input_title">
						Введите логин:
					</p>
					<input class="input" type="text" name="login" minlength="4" maxlength="16" value="<?php echo @$data['login'] ?>">
				</p>
				<p class="elem">
					<p class="input_title">
						Введите пароль:
					</p>
					<input class="input" type="password" name="password" minlength="5" maxlength="30" value="<?php echo @$data['password'] ?>"> 
				</p>
				<p class="elem">
					<p class="input_title">
						Введите еще раз пароль:
					</p>
					<input class="input" type="password" name="password_2" minlength="5" maxlength="30" value="<?php echo @$data['password_2'] ?>">
				</p>
				<p class="elem">
					<p class="input_title">
						Ваш город:
					</p>
					<select name="city" class="input">
							<option>Астана</option>
							<option>Алматы</option>
							<option>Караганда</option>
							<option>Шымкент</option>
					</select>
				</p>
				<p class="elem">
					<p class="input_title">
						Ваш мобильный телефон:
					</p>
					<input class="input" type="number" name="number" minlength="11" value="<?php echo @$data['number'] ?>">
				</p>
				<p class="elem">
					<p class="input_title">
						Ваш e-mail:
					</p>
					<input class="input" type="email" name="email" value="<?php echo @$data['email'] ?>">
				</p>
				<p class="elem">
					<button type="submit" name="do_register">Зарегистрироваться</button>
				</p>
			</form>
		</div>
	</div>
<?php 
	include 'footer.php';
?>