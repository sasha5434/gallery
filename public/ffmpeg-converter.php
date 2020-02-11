<?php

define('DONTHACKME', true);
$rootPath = __DIR__ . '/..';
$vendorPath = $rootPath . '/vendor';
require_once 'core/config.php';
$link = mysqli_connect($config['mysqlHost'], $config['mysqlUser'], $config['mysqlPassword'], $config['mysqlBase']);
$result = mysqli_query($link, "SELECT * FROM queue WHERE percentage='0'");
if (!$result) {
    $content = 'Произошла ошибка подключения к серверу и БД, проверьте параметры полключения';
}
if (mysqli_num_rows($result) > 0) {
    if (!isset($argv[1])) {
        $myrow = mysqli_fetch_assoc($result);
        $file = $myrow['file'];
    } else {
        $file = $argv[1];
    }
    require $vendorPath . '/autoload.php';
    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open($config['siteDir'] . $config['tmpDir'] . $file . '.mp4');
    $video->filters()
            ->resize(new FFMpeg\Coordinate\Dimension($config['videoWidth'], $config['videoHeight']))
            ->synchronize();
    $format = new FFMpeg\Format\Video\X264();
    $format->on('progress', function ($video, $format, $percentage) use ($link, $file) {
        mysqli_query($link, "UPDATE queue SET percentage = '$percentage' WHERE queue.file = '$file'");
    });
    $format->setAudioCodec($config['audioCodec'])->setKiloBitrate($config['videoBitrate'])->setAudioChannels($config['audioChannels'])->setAudioKiloBitrate($config['audioBitrate']);
    $video->save($format, $config['siteDir'] . $config['uploadVideoDir'] . $file . '.mp4');
    unlink($config['siteDir'] . $config['tmpDir'] . $file . '.mp4');
    mysqli_query($link, "DELETE FROM queue WHERE queue.file =  '$file'");
}