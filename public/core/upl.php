<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
if ($user_login == "NOT LOGIN") {
	echo "Сначала авторизуйтесь на сайте! <br />";
}
else {
	if (isset($_GET['method'])) {
		$method = $_GET['method'];
		switch ($method) {
			case "image":
				set_time_limit(120);
				// Создаем подключение к серверу
				$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
				// Вытаскиваем необходимые данные
				$file = $_POST['value'];
				$name = $_POST['name'];
				// Получаем расширение файла
				$getMime = explode('.', $name);
				$mime = end($getMime);
				// проверка типа файла
				$valid_types = array(
					"gif",
					"jpg",
					"jpeg",
					"png",
					"GIF",
					"JPG",
					"JPEG",
					"PNG"
				);
				if (in_array($mime, $valid_types)) {
					// Выделим данные
					$data = explode(',', $file);
					// Декодируем данные, закодированные алгоритмом MIME base64
					$encodedData = str_replace(' ', '+', $data[1]);
					$decodedData = base64_decode($encodedData);
					// Вы можете использовать данное имя файла, или создать произвольное имя.
					// Мы будем создавать произвольное имя!
					$randomName = substr_replace(sha1(microtime(true)) , '', 12);
					// будущее имя файла
					$target_name = $randomName . ".jpg";
					// Создаем изображение на сервере во временной папке
					if (file_put_contents($tmpdir . $randomName, $decodedData)) {
						// обрабаатываем файл во временной папке и создаём миниатюру
						$put_file = $tmpdir . $randomName;
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
							$dimg = imagecreatetruecolor($nw, $nh);
							$wm = $w / $nw;
							$hm = $h / $nh;
							$h_height = $nh / 2;
							$w_height = $nw / 2;
							if ($w > $h) {
								$adjusted_width = $w / $hm;
								$half_width = $adjusted_width / 2;
								$int_width = $half_width - $w_height;
								imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
							}
							elseif (($w < $h) || ($w == $h)) {
								$adjusted_height = $h / $wm;
								$half_height = $adjusted_height / 2;
								$int_height = $half_height - $h_height;
								imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
							}
							else {
								imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
							}
							// Записываем данные изображения в БД и если получилось, записываем картинку и миниатюру в папку загрузки
							if (mysqli_query($link, "INSERT INTO files SET date = NOW(), user_id = '$user_id', filename = '$randomName', type = 'image'")) {
								imagejpeg($dimg, $thumbdir . $target_name, 100);
								imagejpeg($simg, $uploaddir . $target_name, 100);
								echo "Загружен успешно: <a href='" . $uploaddir . $target_name . "'>" . $name . "</a><br />";
								// освобождаем память
								imagedestroy($dimg);
								imagedestroy($simg);
							}
							else {
								echo "Не удалось загрузить файл <font color='red'>" . $name . "</font>! MySQL error!!!<br />";
								imagedestroy($dimg);
								imagedestroy($simg);
							}
						}
						else {
							echo "Ошибка обработки изображения. Убедитесь, что файл <font color='red'>" . $name . "</font> не поврежден!<br />";
						}
						//удаляем временный файл
						unlink($tmpdir . $randomName);
					}
					else {
						echo "Ошибка загрузки файла. Убедитесь, что файл " . $name . " не поврежден!<br />";
					}
				}
				else {
					echo 'Попытка загрузки запрещённого файла <font color="red">' . $name . '</font>! Можно загружать только jpg, png и gif!<br />';
				}
			break;
			case "video":
				$randomName = substr_replace(sha1(microtime(true)) , '', 12);
				$target_name_vid = $randomName . ".mp4";
				$target_name_prev = $randomName . ".jpg";
				// Проверяем загружен ли файл
				if (is_uploaded_file($_FILES["video"]["tmp_name"])) {
					$name = $_FILES["video"]["name"];
					// Получаем расширение файла
					$getMime = explode('.', $name);
					$mime = end($getMime);
					// проферка типаа файла
					$valid_types = array(
						"mp4",
						"MP4",
						"avi",
						"AVI",
						"mkv",
						"MKV",
						"wmv",
						"WMV"
					);
					if (in_array($mime, $valid_types)) {
						require $vendorPath . '/autoload.php';
						move_uploaded_file($_FILES["video"]["tmp_name"], $tmpdir . $target_name_vid);
						$ffmpeg = FFMpeg\FFMpeg::create();
						$video = $ffmpeg->open($sitedir . $tmpdir . $target_name_vid);
						$video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(13))
							->save($tmpdir . "frame.jpg");
						$put_file = $tmpdir . "frame.jpg";
						if ($size = getimagesize($put_file)) {
							$w = $size[0]; // Ширина изображения
							$h = $size[1]; // Высота изображения
							$stype = $size[2];
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
							$dimg = imagecreatetruecolor($nw, $nh);
							$wm = $w / $nw;
							$hm = $h / $nh;
							$h_height = $nh / 2;
							$w_height = $nw / 2;
							if ($w > $h) {
								$adjusted_width = $w / $hm;
								$half_width = $adjusted_width / 2;
								$int_width = $half_width - $w_height;
								imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
							}
							elseif (($w < $h) || ($w == $h)) {
								$adjusted_height = $h / $wm;
								$half_height = $adjusted_height / 2;
								$int_height = $half_height - $h_height;
								imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
							}
							else {
								imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
							}
							if (mysqli_query($link, "INSERT INTO files SET date = NOW(), user_id = '$user_id', filename = '$randomName', type = 'video'")) {
								//rename($tmpdir . $target_name_vid, $upload_video_dir . $target_name_vid);
								mysqli_query($link, "INSERT INTO queue SET file = '$randomName', percentage = '0'");
								imagejpeg($dimg, $upload_video_prev_thumb_dir . $target_name_prev, 100);
								imagejpeg($simg, $upload_video_prev_dir . $target_name_prev, 100);
								shell_exec('php ' . $sitedir . 'ffmpeg-converter.php ' . $randomName . ' > /dev/null &');
								imagedestroy($dimg);
								imagedestroy($simg);
								unlink($sitedir . $tmpdir . "frame.jpg");								
								echo "<!-- %@" . $randomName . "@% -->Успешная загрузка видео - " . $_FILES["video"]["name"] . "<br/>Поставлено в очередь на обработку.";
							}
							else {
								echo "Не удалось загрузить файл <font color='red'>" . $_FILES["video"]["name"] . "</font>! MySQL error!!!<br />";
								imagedestroy($dimg);
								imagedestroy($simg);
							}
						}
						else {
							echo "Ошибка обработки изображения миниатюры!<br />";
						}

					}
					else {

						echo "Попытка загрузки запрещённого файла! Можно загружать только видео в формате mp4!<br />";
					}
				}
				else {
					echo "Ошибка загрузки видео файла - возможно он не выбран";
				}
			break;
			case "status":
				if (isset($_GET['file'])) {
					$file = $_GET['file'];
					// Создаем подключение к серверу
					$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
					$myrow = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM queue WHERE file = '$file'"));
					if ($percentage = $myrow['percentage']) {
						echo $percentage;
					}
					else {
						echo "100";
					}
				}
			break;
		}
	}
}
?>
