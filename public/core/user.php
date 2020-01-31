<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
// Создаем подключение к серверу
$link = mysqli_connect($config['mysqlHost'], $config['mysqlUser'], $config['mysqlPassword'], $config['mysqlBase']);
// Получаем количество записей таблицы
$get_count = mysqli_query($link, "SELECT * FROM users");
if ($get_count) {
	$count_records = mysqli_num_rows($get_count);
	// Текущий id из GET-параметра id
	// Если параметр не определен, то текущая страница равна 1
	$view_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
	// Если текущая страница меньше единицы, то страница равна 1
	if ($view_id < 1) {
		$view_id = 1;
	}
	elseif ($view_id > $count_records) {
		$view_id = $count_records;
	}
	$result = mysqli_query($link, "SELECT * FROM users WHERE user_id=$view_id");
	if ($result) {
		// Если количество записей больше нуля
		if ($count_records > 0) {
			$myrow = mysqli_fetch_assoc($result);
			$parse->get_tpl(DESIGN_DIR . '/user.tpl');
			$parse->set_tpl('{id}', $myrow['user_id']);
			$parse->set_tpl('{login}', $myrow['user_login']);
			$parse->set_tpl('{email}', $myrow['user_email']);
			$parse->set_tpl('{regdate}', $myrow['user_reg_date']);
			$parse->tpl_parse();
			$content = $parse->template;
		}
		else {
			// Собщение о пустой таблице
			$content = "<p>Информация по запросу не может быть извлечена, в таблице нет записей.</p>";
		}
	}
	else {
		$content = "MySQL error!!! (2)";
	}
}
else {
	$content = "MySQL error!!! (1)";
}
$config['title'] .= " - Просмотр профиля пользователя " . $myrow['user_login'];
?>
