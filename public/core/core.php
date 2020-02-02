<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}
@include (CORE_DIR . '/config.php');

@include (CORE_DIR . '/checkauth.php');

@include (CORE_DIR . '/design.php');

$printcontent = '1';
if (isset($_GET['do'])) {
	$do = $_GET['do'];
	switch ($do) {
		case 'reg':
			include CORE_DIR . '/register.php';
			$printcontent = '1';
		break;

		case 'login':
			include CORE_DIR . '/login.php';
			$printcontent = '1';
		break;

		case 'upl':
			include CORE_DIR . '/upl.php';
			$printcontent = '0';
		break;

		case 'upload':
			include CORE_DIR . '/upload.php';
			$printcontent = '1';
		break;

		case 'main':
			include CORE_DIR . '/main.php';
			$printcontent = '1';
		break;

		case 'view':
			include CORE_DIR . '/view.php';
			$printcontent = '1';
		break;

		case 'user':
			include CORE_DIR . '/user.php';
			$printcontent = '1';
		break;

		case 'config':
			include CORE_DIR . '/configure.php';
			$printcontent = '1';
		break;
		
		case 'action':
			include CORE_DIR . '/action.php';
			$printcontent = '0';
		break;

	}
}
else {
	$printcontent = '1';
	@include (CORE_DIR . '/main.php');
}
// выводим шаблон, только когда он нужен
if ($printcontent == '1') {
	if ($user_login == $config['adminLogin']) {
		$admLink = '<li> <a href="/?do=config">Настройка сайта</a> </li>';
	}
	else {
		$admLink = ' ';
	}
	// не выводим шаблон, когда он не нужен
	// считываем данные из шаблона
	$parse->get_tpl(DESIGN_DIR . '/main.tpl');
	// заменяем переменные из шаблона на полученные данные
	$parse->set_tpl('{title}', $config['title']);
	$parse->set_tpl('{content}', $content);
	$parse->set_tpl('{login}', $echoLogin);
	$parse->set_tpl('{admLink}', $admLink);
	$parse->tpl_parse(); // Собираем страничку
	echo $parse->template; // Выводим страничку
	
}
?>
