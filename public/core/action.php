<?php

if (!defined('DONTHACKME')) {
    die('Dont hack me!');
}
if ($user_login == 'NOT LOGIN') {
    echo "{$lang['Action-1']} <br />";
} else {
    if (isset($_GET['step'])) {
        if (isset($_GET['id'])) {
            $fileId = $_GET['id'];
            $result = mysqli_query($link, "SELECT * FROM files WHERE id=$fileId");
            $count_records = mysqli_num_rows($result);
            if ($count_records > 0) {
                $myrow = mysqli_fetch_assoc($result);
                $query = mysqli_query($link, "SELECT user_login FROM users WHERE user_id='" . $myrow['user_id'] . "' LIMIT 1");
                $data = mysqli_fetch_assoc($query);
                if ($user_login == $data['user_login'] or $user_login == $config['adminLogin']) {
                    $step = $_GET['step'];
                    $fileName = $myrow['filename'];
                    switch ($step) {
                        case 'remove':
                            if ($myrow['type'] == 'image') {
                                mysqli_query($link, "DELETE FROM files WHERE files.id = '$fileId'");
                                unlink($config['uploadDir'] . $fileName . '.jpg');
                                unlink($config['thumbDir'] . $fileName . '.jpg');
                                header("Location: /");
                            } else if ($myrow['type'] == 'video') {
                                mysqli_query($link, "DELETE FROM files WHERE files.id = '$fileId'");
                                unlink($config['uploadVideoDir'] . $fileName . '.mp4');
                                unlink($config['uploadVideoPrevDir'] . $fileName . '.jpg');
                                unlink($config['uploadVideoPrevThumbDir'] . $fileName . '.jpg');
                                header("Location: /");
                            }
                            break;

                        case 'preview':
                            if (isset($_GET['seconds'])) {
                                $seconds = $_GET['seconds'];
                                require $vendorPath . '/autoload.php';
                                $ffmpeg = FFMpeg\FFMpeg::create();
                                $video = $ffmpeg->open($config['siteDir'] . $config['uploadVideoDir'] . $fileName . '.mp4');
                                $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($seconds))->save($config['tmpDir'] . "{$fileName}.jpg");
                                $put_file = $config['tmpDir'] . "{$fileName}.jpg";
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
                                    $dimg = imagecreatetruecolor($config['thumbWidth'], $config['thumbHeight']);
                                    $wm = $w / $config['thumbWidth'];
                                    $hm = $h / $config['thumbHeight'];
                                    $h_height = $config['thumbHeight'] / 2;
                                    $w_height = $config['thumbWidth'] / 2;
                                    if ($w > $h) {
                                        $adjusted_width = $w / $hm;
                                        $half_width = $adjusted_width / 2;
                                        $int_width = $half_width - $w_height;
                                        imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $config['thumbHeight'], $w, $h);
                                    } elseif (($w < $h) || ($w == $h)) {
                                        $adjusted_height = $h / $wm;
                                        $half_height = $adjusted_height / 2;
                                        $int_height = $half_height - $h_height;
                                        imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $config['thumbWidth'], $adjusted_height, $w, $h);
                                    } else {
                                        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $config['thumbWidth'], $config['thumbHeight'], $w, $h);
                                    }
                                    unlink($config['uploadVideoPrevDir'] . $fileName . '.jpg');
                                    unlink($config['uploadVideoPrevThumbDir'] . $fileName . '.jpg');
                                    imagejpeg($dimg, $config['uploadVideoPrevThumbDir'] . $fileName . '.jpg', 100);
                                    imagejpeg($simg, $config['uploadVideoPrevDir'] . $fileName . '.jpg', 100);
                                    imagedestroy($dimg);
                                    imagedestroy($simg);
                                    unlink($config['tmpDir'] . "{$fileName}.jpg");
                                    $redicet = $_SERVER['HTTP_REFERER'];
                                    header("Location: $redicet");
                                } else {
                                    echo $lang['Action-2'];
                                }
                            } else {
                                echo $lang['Action-3'];
                            }
                            break;
                    }
                } else {
                    echo $lang['Action-4'];
                }
            } else {
                echo $lang['Action-5'];
            }
        } else {
            echo $lang['Action-6'];
        }
    } else {
        echo $lang['Action-7'];
    }
}