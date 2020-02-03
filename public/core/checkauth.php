<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}
// Скрипт проверки
// Соединямся с БД
$link = mysqli_connect($config['mysqlHost'], $config['mysqlUser'], $config['mysqlPassword'], $config['mysqlBase']);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
	$query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
	$userdata = mysqli_fetch_assoc($query);
	if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR']) and ($userdata['user_ip'] !== '0'))) {
		setcookie('id', '', time() - 3600 * 24 * 30 * 12, '/');
		setcookie('hash', '', time() - 3600 * 24 * 30 * 12, '/');
		$echoLogin = "{$lang['Action-1']} <a href=\"/?do=login\">{$lang['CheckAuth-2']}</a>";
		$isLoged = '0';
		$user_id = 'NOT LOGIN';
		$user_login = 'NOT LOGIN';
	}
	else {
		$user_id = $userdata['user_id'];
		$user_login = $userdata['user_login'];
		$echoLogin = "{$lang['CheckAuth-3']}, <a href=\"/?do=user&id=$user_id\">$user_login</a>.";
		$isLoged = '1';
	}
}
else {
	$user_id = 'NOT LOGIN';
	$user_login = 'NOT LOGIN';
	$echoLogin = "{$lang['CheckAuth-4']}! <a href=\"/?do=login\">{$lang['CheckAuth-5']}</a> | <a href=\"/?do=reg\">{$lang['CheckAuth-6']}</a>";
	$isLoged = '0';
}
?>