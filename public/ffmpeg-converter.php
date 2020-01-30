<?php
define ( 'DONTHACKME', true );
$rootPath = __DIR__ . '/..';
$vendorPath = $rootPath . '/vendor';
require_once 'core/config.php';
$link = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_base");
$result = mysqli_query($link, "SELECT * FROM queue WHERE percentage='0'");
if (!$result) {
    $content = "Произошла ошибка подключения к серверу и БД, проверьте параметры полключения";
}
if (mysqli_num_rows($result) > 0)
{
    if (!isset($argv[1])) {
        $myrow = mysqli_fetch_assoc($result);
        $file = $myrow['file'];
    }
    else {
        $file = $argv[1];
    }
    require $vendorPath . '/autoload.php';
    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open($sitedir . $tmpdir . $file . ".mp4");
    $video->filters()
        ->resize(new FFMpeg\Coordinate\Dimension($videoWidth, $videoHeight))
        ->synchronize();
    $format = new FFMpeg\Format\Video\X264();
    $format->on('progress', function ($video, $format, $percentage) use ($link, $file)
    {
        mysqli_query($link, "UPDATE queue SET percentage = '$percentage' WHERE queue.file = '$file'");
    });
    $format->setAudioCodec($audioCodec)->setKiloBitrate($videoBitrate)->setAudioChannels($audioChannels)->setAudioKiloBitrate($audioBitrate);
    $video->save($format, $sitedir . $upload_video_dir . $file . ".mp4");
    unlink($sitedir . $tmpdir . $file . ".mp4");
    mysqli_query($link, "DELETE FROM queue WHERE queue.file =  '$file'");
}
?>