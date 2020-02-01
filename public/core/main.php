<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
$config['title'] .= " - Галлерея";
// Создаем подключение к серверу
$link = mysqli_connect($config['mysqlHost'], $config['mysqlUser'], $config['mysqlPassword'], $config['mysqlBase']);
// Получаем количество записей таблицы
$type = "all";
if (isset($_GET['type'])) {
	$type = $_GET['type'];
}
if ($type == "video") {
	$get_count = mysqli_query($link, "SELECT * FROM files WHERE type='video'");
}
elseif ($type == "image") {
	$get_count = mysqli_query($link, "SELECT * FROM files WHERE type='image'");
}
else {
	$get_count = mysqli_query($link, "SELECT * FROM files");
}
$count_records = mysqli_num_rows($get_count);
// Получаем количество страниц
// Делим количество записей на количество новостей на странице
// и округляем в большую сторону
$num_pages = ceil($count_records / $config['perPage']);
// Текущая страница из GET-параметра page
// Если параметр не определен, то текущая страница равна 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// Если текущая страница меньше единицы, то страница равна 1
if ($current_page < 1) {
	$current_page = 1;
}
// Если текущая страница больше общего количества страница, то
// текущая страница равна количеству страниц
elseif ($current_page > $num_pages) {
	$current_page = $num_pages;
}
// вычисляем первый оператор для LIMIT
$start_from = ($current_page - 1) * $config['perPage'];
// Запросы на выборку данных
if ($type == "video") {
	$result = mysqli_query($link, "SELECT * FROM files WHERE type='video' ORDER BY id DESC LIMIT $start_from, ".(int)$config['perPage']);
}
elseif ($type == "image") {
	$result = mysqli_query($link, "SELECT * FROM files WHERE type='image' ORDER BY id DESC LIMIT $start_from, ".(int)$config['perPage']);
}
else {
	$result = mysqli_query($link, "SELECT * FROM files ORDER BY id DESC LIMIT $start_from, ".(int)$config['perPage']);
}
if (!$result) {
	$content = "Произошла ошибка подключения к серверу и БД, проверьте параметры полключения";
}
// Если количество записей больше нуля
if (mysqli_num_rows($result) > 0) {
	// Записываем полученные данные в массив
	$myrow = mysqli_fetch_assoc($result);
	// В цикле выводим изображения на страницу
	do {
		$query = mysqli_query($link, "SELECT user_login FROM users WHERE user_id='" . $myrow['user_id'] . "' LIMIT 1");
		$data = mysqli_fetch_assoc($query);
		$parse->get_tpl(DESIGN_DIR . '/image_block.tpl');
		$parse->set_tpl('{link}', "/?do=view&amp;id=" . $myrow['id']);
		if ($myrow['type'] == "video") {
			$parse->set_tpl('{thumb}', $config['uploadVideoPrevThumbDir'] . $myrow['filename'] . ".jpg");
			$parse->set_tpl('{is_video}', "<div class='overley'></div>");
		}
		else {
			$parse->set_tpl('{thumb}', $config['thumbDir'] . $myrow['filename'] . ".jpg");
			$parse->set_tpl('{is_video}', " ");
		}
		$parse->set_tpl('{date}', $myrow['date']);
		$parse->set_tpl('{user}', $data['user_login']);
		$parse->set_tpl('{userlink}', "/?do=user&id=" . $myrow['user_id']);
		$parse->tpl_parse();
		$printimg .= $parse->template;
	} while ($myrow = mysqli_fetch_assoc($result));
	for ($page = 1;$page <= $num_pages;$page++) {
		if ($page == $current_page) {
			$pages .= $page . " ";
		}
		else {
			if ($type == "video") {
				$pages .= '<a href="/?type=video&page=' . $page . '">' . $page . '</a>' . " ";
			}
			elseif ($type == "image") {
				$pages .= '<a href="/?type=image&page=' . $page . '">' . $page . '</a>' . " ";
			}
			else {
				$pages .= '<a href="/?page=' . $page . '">' . $page . '</a>' . " ";
			}
		}
	}
	$parse->get_tpl(DESIGN_DIR . '/page.tpl');
	$parse->set_tpl('{pagecontent}', $printimg);
	$parse->set_tpl('{pages}', $pages);
	$parse->tpl_parse();
	$content = $parse->template;
}
else {
	// Собщение о пустой таблице
	$content = "<p>Информация по запросу не может быть извлечена, в таблице нет записей.</p>";
}
?>
