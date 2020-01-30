<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
// Скрипт проверки
// Соединямся с БД
$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
	$query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
	$userdata = mysqli_fetch_assoc($query);
	if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR']) and ($userdata['user_ip'] !== "0"))) {
		setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
		setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/");
		$echoLogin = "Авторизация сброшена! <a href='/?do=login'>Вход</a>";
		$isLoged = "0";
		$user_id = "NOT LOGIN";
		$user_login = "NOT LOGIN";
	}
	else {
		$user_id = $userdata['user_id'];
		$user_login = $userdata['user_login'];
		$echoLogin = "Привет, <a href='/?do=user&id=" . $user_id . "'>" . $user_login . "</a>.";
		$isLoged = "1";
	}
}
else {
	$user_id = "NOT LOGIN";
	$user_login = "NOT LOGIN";
	$echoLogin = "Войдите! <a href='/?do=login'>Вход</a> | <a href='/?do=reg'>Регистрация</a>";
	$isLoged = "0";
}
?>
