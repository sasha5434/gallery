<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
// база данных
$mysql_host = "localhost";
$mysql_user = "mysql-user";
$mysql_password = "mysql-pass";
$mysql_base = "base";

// заголовок сайта
$title = "SiteName";

// количество блоков на странице
$per_page = "12";

// загрузка файлов
$sitedir = "/srv/www/aniplay.tk/public/";
$tmpdir = "upload/tmp/";
$uploaddir = "upload/images/";
$thumbdir = "upload/images/thumb/";
$upload_video_dir = "upload/video/";
$upload_video_prev_dir = "upload/video/prev/";
$upload_video_prev_thumb_dir = "upload/video/prev/thumb/";
$nw = 320; // Ширина миниатюр
$nh = 180; // Высота миниатюр
$videoWidth = "1280";
$videoHeight = "720";
$videoBitrate = "1536";
$audioChannels = "2";
$audioBitrate = "128";
$audioCodec = "libmp3lame";

//Google ReCAPTCHA v3
$reSiteKey = "!!!!!!!!!!!!!!!!!!!";
$reSecretKey = "!!!!!!!!!!!!!!!!!!";
?>
