<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
$errors = " ";
$title .= " - Авторизация";
// Страница авторизации
// Функция для генерации случайной строки
function generateCode($length = 6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;
	while (strlen($code) < $length) {
		$code .= $chars[mt_rand(0, $clen) ];
	}
	return $code;
}
// Соединямся с БД
$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
if (isset($_POST['submit'])) {
	/*СОЗДАЕМ ФУНКЦИЮ КОТОРАЯ ДЕЛАЕТ ЗАПРОС НА GOOGLE СЕРВИС*/
	function getCaptcha($SecretKey, $reSecretKey) {
		$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $reSecretKey . "&response={$SecretKey}");
		$Return = json_decode($Response);
		return $Return;
	}
	/*ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ*/
	$Return = getCaptcha($_POST['g-recaptcha-response'], $reSecretKey);
	/*ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД*/
	if ($Return->success == true && $Return->score > 0.5) {
		// Вытаскиваем из БД запись, у которой логин равняеться введенному
		$query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
		$data = mysqli_fetch_assoc($query);
		// Сравниваем пароли
		if ($data['user_password'] === md5(md5($_POST['password']))) {
			// Генерируем случайное число и шифруем его
			$hash = md5(generateCode(10));
			// перевод ip в строку
			$insip = ", user_ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')";
			// Записываем в БД новый хеш авторизации и IP
			mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE user_id='" . $data['user_id'] . "'");
			// Ставим куки
			setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30);
			setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, null, null, null, true); // httponly !!!
			// Переадресовываем браузер на страницу проверки нашего скрипта
			$errors = " ";
			header("Location: /");
			exit();
		}
		else {
			$errors = "Вы ввели неправильный логин/пароль <br />";
		}
	}
	else {
		$errors = "You are Robot <br />";
	}
}
$parse->get_tpl(DESIGN_DIR . '/login.tpl');
$parse->set_tpl('{errors}', $errors);
$parse->set_tpl('{reSiteKey}', $reSiteKey);
$parse->tpl_parse();
$content = $parse->template;
?>
