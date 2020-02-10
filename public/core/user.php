<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}

if (isset($_FILES['avatar']['tmp_name']) and isset($_GET['id'])) {
	$view_id = $_GET['id'];
	$result = mysqli_query($link, "SELECT * FROM users WHERE user_id=$view_id");
	if ($myrow = mysqli_fetch_assoc($result)) {
		if ($user_login == $myrow['user_login'] or $user_login == $config['adminLogin']) {
			// будущее имя файла
			$target_name = $myrow['user_login'] . '.jpg';
			$put_file = $_FILES['avatar']['tmp_name'];
			if ($size = getimagesize($put_file)) {
				$w = $size[0]; // Ширина изображения
				$h = $size[1]; // Высота изображения
				$stype = $size[2]; // Тип файла на всякий случай возьмём из переменной
				switch ($stype) {
					case '1':
						$simg = imagecreatefromgif($put_file);
					break;

					case '2':
						$simg = imagecreatefromjpeg($put_file);
					break;

					case '3':
						$simg = imagecreatefrompng($put_file);
					break;
				}
				$dimg = imagecreatetruecolor($config['avatarWidth'], $config['avatarHeight']);
				$wm = $w / $config['avatarWidth'];
				$hm = $h / $config['avatarHeight'];
				$h_height = $config['avatarHeight'] / 2;
				$w_height = $config['avatarWidth'] / 2;
				imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $config['avatarWidth'], $config['avatarHeight'], $w, $h);
				// Записываем данные изображения в БД и если получилось, записываем картинку и миниатюру в папку загрузки
				if (mysqli_query($link, "UPDATE users SET avatar = 'set' WHERE users.user_id = '$view_id'")) {
					imagejpeg($dimg, $config['avatarDir'] . $target_name, 100);
					$content = "{$lang['Upload-2']}<br />";
					// освобождаем память
					imagedestroy($dimg);
					imagedestroy($simg);
				}
				else {
					$content = "{$lang['Upload-3']} <font color=\"red\">$name</font>! {$lang['Upload-4']}!<br />";
					imagedestroy($dimg);
					imagedestroy($simg);
				}

			}
			else {
				$content = "{$lang['Upload-5']} <font color=\"red\">$name</font> {$lang['Upload-6']}!<br />";
			}
		}
		else {
			$content = "<br /> <div style=\"font-size: 24px;\">{$lang['Configure-2']}.</div> <br />";
		}
	}
	else {
		$content = "{$lang['Upload-4']}!<br />";
	}
	//удаляем временный файл
	unlink($put_file);
}
else {
	// Получаем количество записей таблицы
	$get_count = mysqli_query($link, "SELECT * FROM users");
	if ($get_count) {
		$count_records = mysqli_num_rows($get_count);
		// Текущий id из GET-параметра id
		// Если параметр не определен, то текущая страница равна 1
		$view_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
		// Если текущая страница меньше единицы то страница равна 1
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
				$get_count = mysqli_query($link, "SELECT * FROM files WHERE user_id='$view_id'");
				$count_records = mysqli_num_rows($get_count);
				$myrow = mysqli_fetch_assoc($result);
				if ($myrow['avatar'] == 'set') {
					$avatar = $config['avatarDir'] . $myrow['user_login'] . '.jpg';
				}
				else {
					$avatar = $config['avatarDir'] . '/default/avatar.jpg';
				}
				if ($user_login == $myrow['user_login'] or $user_login == $config['adminLogin']) {
					$hideUpload = ' ';
				}
				else {
					$hideUpload = 'style="visibility: hidden;"';
				}
				$parse->get_tpl(DESIGN_DIR . '/user.tpl');
				$parse->set_tpl('{id}', $myrow['user_id']);
				$parse->set_tpl('{login}', $myrow['user_login']);
				$parse->set_tpl('{email}', $myrow['user_email']);
				$parse->set_tpl('{regdate}', $myrow['user_reg_date']);
				$parse->set_tpl('{uploadCount}', $count_records);
				$parse->set_tpl('{avatar}', $avatar);
				$parse->set_tpl('{hideUpload}', $hideUpload);
				$parse->tpl_parse();
				$content = $parse->template;
			}
			else {
				// Собщение о пустой таблице
				$content = "<div style=\"font-size: 24px;\">{$lang['User-1']}.</div>";
			}
		}
		else {
			$content = $lang['User-2'];
		}
	}
	else {
		$content = $lang['User-2'];
	}
	$config['title'] .= " - {$lang['User-3']} " . $myrow['user_login'];
}