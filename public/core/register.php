<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
$errors = " ";
// Страница регистрации нового пользователя
if ($user_login == "NOT LOGIN") {
	// Соединямся с БД
	$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
	if (isset($_POST['submit'])) {
		$err = [];
		// проверям логин
		if (!preg_match('/^([a-zA-Z0-9])+([a-z0-9])$/is', $_POST['login'])) {
			$err[] = "Логин может состоять только из букв английского алфавита и цифр";
		}
		if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 10) {
			$err[] = "Логин должен быть не меньше 3-х символов и не больше 10";
		}
		if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['email'])) {
			$err[] = "Email введён не корректно";
		}
		if (strlen($_POST['email']) < 5 or strlen($_POST['email']) > 35) {
			$err[] = "Email должен быть не меньше 5-ти символов и не больше 35";
		}
		if (strlen($_POST['password']) < 5 or strlen($_POST['password']) > 30) {
			$err[] = "Пароль должен быть не меньше 5-ти символов и не больше 30";
		}
		if ($_POST['password'] != $_POST['password2']) {
			$err[] = "Пароли не совпадают";
		}
		if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['password'])) {
			$err[] = "Пароль может состоять только из букв английского алфавита и цифр";
		}
		// проверяем, не сущестует ли пользователя с таким именем
		$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "'");
		if (mysqli_num_rows($query) > 0) {
			$err[] = "Пользователь с таким логином уже существует в базе данных";
		}
		// проверяем, не сущестует ли пользователя с таким Email
		$query = mysqli_query($link, "SELECT user_id FROM users WHERE user_email='" . mysqli_real_escape_string($link, $_POST['email']) . "'");
		if (mysqli_num_rows($query) > 0) {
			$err[] = "Пользователь с таким Email уже существует в базе данных";
		}
		// Если нет ошибок, то добавляем в БД нового пользователя
		if (count($err) == 0) {
			$errors = " ";
			$login = $_POST['login'];
			$email = $_POST['email'];
			// Убераем лишние пробелы и делаем двойное хеширование
			$password = md5(md5(trim($_POST['password'])));
			mysqli_query($link, "INSERT INTO users SET user_login='" . $login . "', user_password='" . $password . "', user_reg_email='" . $email . "', user_email='" . $email . "', user_reg_date=  NOW()");
			header("Location: /?do=login");
			exit();
		}
		else {
			$errors = "<b>При регистрации произошли следующие ошибки:</b><br />";
			foreach ($err AS $error) {
				$errors .= $error . "<br />";
			}
		}
	}
	$parse->get_tpl(DESIGN_DIR . '/reg.tpl');
	$parse->set_tpl('{errors}', $errors);
	$parse->tpl_parse();
	$content = $parse->template;
}
else {
	header('Location: /');
}
?>
