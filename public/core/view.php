<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
$title .= " - Галлерея";
// Создаем подключение к серверу
$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
// Получаем количество записей таблицы
$get_count = mysqli_query($link, "SELECT * FROM files");
if ($get_count) {
	$count_records = mysqli_num_rows($get_count);
	// Текущий id из GET-параметра id
	$view_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
	$result = mysqli_query($link, "SELECT * FROM files WHERE id=$view_id");
	if ($result) {
		// Если количество записей больше нуля
		if ($count_records > 0) {
			$myrow = mysqli_fetch_assoc($result);
			$query = mysqli_query($link, "SELECT user_login FROM users WHERE user_id='" . $myrow['user_id'] . "' LIMIT 1");
			$data = mysqli_fetch_assoc($query);

			if ($myrow['type'] == "video") {
				$parse->get_tpl(DESIGN_DIR . '/video.tpl');
				$parse->set_tpl('{link}', $upload_video_dir . $myrow['filename'] . ".mp4");
				$parse->set_tpl('{prev}', $upload_video_prev_dir . $myrow['filename'] . ".jpg");
				$parse->set_tpl('{thumb}', $upload_video_prev_thumb_dir . $myrow['filename'] . ".jpg");
				$parse->set_tpl('{date}', $myrow['date']);
				$parse->set_tpl('{user}', $data['user_login']);
				$parse->set_tpl('{userlink}', "/?do=user&id=" . $myrow['user_id']);

				$parse->tpl_parse();
				$content = $parse->template;
			}
			else {
				$parse->get_tpl(DESIGN_DIR . '/view.tpl');
				$parse->set_tpl('{link}', $uploaddir . $myrow['filename'] . ".jpg");
				$parse->set_tpl('{img}', $uploaddir . $myrow['filename'] . ".jpg");
				$parse->set_tpl('{date}', $myrow['date']);
				$parse->set_tpl('{user}', $data['user_login']);
				$parse->set_tpl('{userlink}', "/?do=user&id=" . $myrow['user_id']);
				$parse->tpl_parse();
				$content = $parse->template;
			}
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
?>
