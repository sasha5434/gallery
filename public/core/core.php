<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}
@include (CORE_DIR . '/config.php');

if (isset($_POST['setlang'])) {
	setcookie("lang", $_POST['setlang']);
	if ($_POST['setlang'] == 'ru') {
		define('DESIGN_DIR', ROOT_DIR . '/design' . '/ru');
		@include (LANG_DIR . '/' . 'ru' . '.php');
	}
	else if ($_POST['setlang'] == 'en') {
		define('DESIGN_DIR', ROOT_DIR . '/design' . '/en');
		@include (LANG_DIR . '/' . 'en' . '.php');
	}
}
else if (isset($_COOKIE["lang"])) {
	if ($_COOKIE["lang"] == 'ru') {
		define('DESIGN_DIR', ROOT_DIR . '/design' . '/ru');
		@include (LANG_DIR . '/' . 'ru' . '.php');
	}
	else if ($_COOKIE["lang"] == 'en') {
		define('DESIGN_DIR', ROOT_DIR . '/design' . '/en');
		@include (LANG_DIR . '/' . 'en' . '.php');
	}
	else {
		define('DESIGN_DIR', ROOT_DIR . '/design' . '/' . $config['lang']);
		@include (LANG_DIR . '/' . $config['lang'] . '.php');
	}
}
else {
	define('DESIGN_DIR', ROOT_DIR . '/design' . '/' . $config['lang']);
	@include (LANG_DIR . '/' . $config['lang'] . '.php');
}

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
		$admLink = "<li> <a href=\"/?do=config\">{$lang['Core-1']}</a> </li>";
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