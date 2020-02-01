<?php
if (!defined('DONTHACKME')) {
	die('Dont hack me!');
}
$config = array (
  'mysqlHost' => 'localhost',
  'mysqlUser' => 'dbUser',
  'mysqlPassword' => 'dbPass',
  'mysqlBase' => 'dbBase',
  'adminLogin' => 'Admin',
  'title' => 'Test site',
  'perPage' => '12',
  'thumbWidth' => '320',
  'thumbHeight' => '180',
  'videoWidth' => '1280',
  'videoHeight' => '720',
  'videoBitrate' => '1536',
  'audioChannels' => '2',
  'audioBitrate' => '128',
  'audioCodec' => 'libmp3lame',
  'siteDir' => '/srv/www/example.com/public/',
  'tmpDir' => 'upload/tmp/',
  'uploadDir' => 'upload/images/',
  'thumbDir' => 'upload/images/thumb/',
  'uploadVideoDir' => 'upload/video/',
  'uploadVideoPrevDir' => 'upload/video/prev/',
  'uploadVideoPrevThumbDir' => 'upload/video/prev/thumb/',
  'reSiteKey' => 'keyFromGoogle!!!!!!!!!!!!!',
  'reSecretKey' => 'keyFromGoogle!!!!!!!!!!!!!',
);
?>
