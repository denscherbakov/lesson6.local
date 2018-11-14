<?php

//Функция проверяет данные пользователя
function checkUser($login, $password){
	$userData = require_once __DIR__ . '/userdata.php';

	return $login === $userData['login'] && $password === $userData['pass'];
}

//Функция сохраняет данные в файл
function saveData($data, $filePath){
	return file_put_contents($filePath, $data, FILE_APPEND);
}

//Функция возвращает строку для записи в файл
function prepareLog($firstNumber, $secondNumber, $operation, $result, $user){
	return $user . ', ' . $firstNumber . ' ' . $operation . ' ' . $secondNumber . ' = ' . $result . PHP_EOL;
}

//Функция возвращает путь до файла
function getFilePath(){
	return __DIR__ . '/calc.log';
}

//Функция для подсчета результата
function calculate($firstNumber, $secondNumber, $operation){
	define("EPS", 1e-05);

	$result = null;

	switch ($operation) {
		case '+':
			$result = $firstNumber + $secondNumber;
			break;
		case '-':
			$result = $firstNumber - $secondNumber;
			break;
		case '*':
			$result = $firstNumber * $secondNumber;
			break;
		case '/' :
			if (abs($secondNumber) > EPS) {
				$result = $firstNumber / $secondNumber;
			} else {
				$result = 'Делить на ноль нельзя.';
			}
			break;
	}

	return $result;
}