<?php

session_start();
require_once __DIR__ . '/functions.php';

$a = null;
$b = null;
$operation = '+';
$result = null;

if (isset($_GET['logout'])){
	session_destroy();
	header('Location: /index.php');
	exit();
}

if (isset($_SESSION['login']) && isset($_SESSION['pass'])){

	$login = $_SESSION['login'];
	$pass = $_SESSION['pass'];

	if (checkUser($login, $pass) === false){
		header('Location: /index.php');
		exit();
	}
} else {
	header('Location: /index.php');
	exit();
}

if (count($_POST) > 0){
	$a = $_POST['a'];
	$b = $_POST['b'];
	$operation = $_POST['operation'];

	$result = calculate($a, $b, $operation);

	$outputData = prepareLog($a, $b, $operation, $result, $login);

	if (saveData($outputData, getFilePath()) === false){
		$result = 'Не удалось записать в файл.';
	}
}
?>

<html>
	<body>
		<a href="/home.php?logout">Logout</a>
		<form action="/home.php" method="post">
			<p><input type="text" name="a" value="<?= $a; ?>"></p>

			<select name="operation">
				<option <?php if ($operation === '+'):?> selected <?php endif;?> value="+">+</option>
				<option <?php if ($operation === '-'):?> selected <?php endif;?> value="-">-</option>
				<option <?php if ($operation === '*'):?> selected <?php endif;?> value="*">*</option>
				<option <?php if ($operation === '/'):?> selected <?php endif;?> value="/">/</option>
			</select>

			<p><input type="text" name="b" value="<?= $b; ?>"></p>
			<p><input type="submit" value="Calculate"></p>
		</form>

		<?= $result; ?>
	</body>
</html>