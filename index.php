<?php

session_start();

require_once __DIR__ . '/functions.php';

$message = null;
$login = null;
$pass = null;

if (count($_POST) > 0){

	$login = $_POST['login'];
	$pass = $_POST['password'];

	if (checkUser($login, $pass) === true){

		$_SESSION['login'] = $login;
		$_SESSION['pass'] = $pass;

		header('Location: /home.php');
		exit();
	} else {
		$message = 'Введите верные данные!';
		session_destroy();
	}
}

if (isset($_SESSION['login']) && isset($_SESSION['pass'])){

	$login = $_SESSION['login'];
	$pass = $_SESSION['pass'];

	if (checkUser($login, $pass) === true){
		header('Location: /home.php');
		exit();
	}
}
?>

<html>
	<body>
		<p><?= $message; ?></p>
		<form action="/index.php" method="post">
			<p><input type="text" name="login" value="<?= $login; ?>"></p>
			<p><input type="password" name="password" value="<?= $pass; ?>"></p>
			<p><input type="submit" value="Войти"></p>
		</form>
	</body>
</html>

