<?php 
	include 'header.php'; 
	$data = $_POST;
	$errors = array();
	if (isset($data['do_login'])) {
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ($user) {
			if(password_verify($data['password'], $user->password)){
				$_SESSION['logged_user'] = $user;
				header('Location: index.php');
			}else{
				$errors[] = 'Неправильный пароль';
			}
		}else{
			$errors[] = 'Такого пользователя не существует!';
		}
		if (!empty($errors)) {
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
		}
		button{
			font-size: 20px;
			border-radius: 5px;
			font-weight: bold;
		}
		#register{
			color: #333333;
			font-size: 16px;
		}
	</style>
	<div class="wrap">
		<div class="form">
			<form action="login.php" method="POST">
				<p class="elem">
					<p class="input_title">Логин:</p>
					<input type="text" name="login" class="input">
				</p>
				<p class="elem">
					<p class="input_title">Пароль:</p>
					<input type="password" name="password" class="input">
				</p>
				<p class="elem">
					<button type="submit" name="do_login">Войти</button>
				</p>
			</form>
			<a href="register.php" id="register">Нет аккаунта?</a>
		</div>
	</div>
<?php include 'footer.php'; ?>