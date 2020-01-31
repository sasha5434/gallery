<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
$config['title'] .= " - Загрузка файлов";
if ($user_login == "NOT LOGIN") {
	$content = "<br /> <font size='5'>Cначала авторизуйтесь на сайте!</font> <br />";
}
else {
	$method = "image";
	if (isset($_GET['method'])) {
		$method = $_GET['method'];
	}
	if ($method == "video") {
		$parse->get_tpl(DESIGN_DIR . '/upload_video.tpl');
		$parse->tpl_parse();
		$content = $parse->template;
	}
	else {
		$parse->get_tpl(DESIGN_DIR . '/upload.tpl');
		$parse->tpl_parse();
		$content = $parse->template;
	}
}
?>
