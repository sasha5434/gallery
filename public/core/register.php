<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}
$errors = ' ';
// Страница регистрации нового пользователя
if ($user_login == 'NOT LOGIN') {
	// Соединямся с БД
	$link = mysqli_connect($config['mysqlHost'], $config['mysqlUser'], $config['mysqlPassword'], $config['mysqlBase']);
	if (isset($_POST['submit'])) {
		$err = [];
		// проверям логин
		if (!preg_match('/^([a-zA-Z0-9])+([a-z0-9])$/is', $_POST['login'])) {
			$err[] = 'Логин может состоять только из букв английского алфавита и цифр';
		}
		if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 10) {
			$err[] = 'Логин должен быть не меньше 3-х символов и не больше 10';
		}
		if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['email'])) {
			$err[] = 'Email введён не корректно';
		}
		if (strlen($_POST['email']) < 5 or strlen($_POST['email']) > 35) {
			$err[] = 'Email должен быть не меньше 5-ти символов и не больше 35';
		}
		if (strlen($_POST['password']) < 5 or strlen($_POST['password']) > 30) {
			$err[] = 'Пароль должен быть не меньше 5-ти символов и не больше 30';
		}
		if ($_POST['password'] != $_POST['password2']) {
			$err[] = 'Пароли не совпадают';
		}
		if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['password'])) {
			$err[] = 'Пароль может состоять только из букв английского алфавита и цифр';
		}
		/*СОЗДАЕМ ФУНКЦИЮ КОТОРАЯ ДЕЛАЕТ ЗАПРОС НА GOOGLE СЕРВИС*/
		function getCaptcha($SecretKey, $reSecretKey) {
			$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$reSecretKey}&response={$SecretKey}");
			$Return = json_decode($Response);
			return $Return;
		}
		/*ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ*/
		$Return = getCaptcha($_POST['g-recaptcha-response'], $config['reSecretKey']);
		/*ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД*/
		if ($Return->success == true && $Return->score > 0.5) {
		}
		else {
			$err[] = 'You are Robot';
		}
		// проверяем, не сущестует ли пользователя с таким именем
		$user_login = mysqli_real_escape_string($link, $_POST['login']);
		$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='$user_login'");
		if (mysqli_num_rows($query) > 0) {
			$err[] = 'Пользователь с таким логином уже существует в базе данных';
		}
		// проверяем, не сущестует ли пользователя с таким Email
		$user_email = mysqli_real_escape_string($link, $_POST['email']);
		$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_email='$user_email'");
		if (mysqli_num_rows($query) > 0) {
			$err[] = 'Пользователь с таким Email уже существует в базе данных';
		}
		// Если нет ошибок, то добавляем в БД нового пользователя
		if (count($err) == 0) {
			$errors = ' ';
			// Убераем лишние пробелы и делаем двойное хеширование
			$password = md5(md5(trim($_POST['password'])));
			if(mysqli_query($link, "INSERT INTO users SET user_login='$user_login', user_password='$password', user_reg_email='$user_email', user_email='$user_email'")) {
				header("Location: /?do=login");
				exit();
			}
			else {
				$errors = '<b>MySQL error!</b><br />';
			}

		}
		else {
			$errors = '<b>При регистрации произошли следующие ошибки:</b><br />';
			foreach ($err AS $error) {
				$errors .= "$error <br />";
			}
		}
	}
	$parse->get_tpl(DESIGN_DIR . '/reg.tpl');
	$parse->set_tpl('{errors}', $errors);
	$parse->set_tpl('{reSiteKey}', $config['reSiteKey']);
	$parse->tpl_parse();
	$content = $parse->template;
}
else {
	header('Location: /');
}
?>
