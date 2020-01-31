<?php
if (!defined('DONTHACKME')) {
	die("Dont hack me!");
}
if ($user_login == $config['adminLogin']) {

	if (isset($_POST['submit'])) {
	$config['mysqlHost'] = $_POST['mysqlHost'];
	$config['mysqlUser'] = $_POST['mysqlUser'];
	$config['mysqlPassword'] = $_POST['mysqlPassword'];
	$config['mysqlBase'] = $_POST['mysqlBase'];
	$config['adminLogin'] = $_POST['adminLogin'];
	$config['title'] = $_POST['title'];
	$config['perPage'] = $_POST['perPage'];
	$config['thumbWidth'] = $_POST['thumbWidth'];
	$config['thumbHeight'] = $_POST['thumbHeight'];
	$config['videoWidth'] = $_POST['videoWidth'];
	$config['videoHeight'] = $_POST['videoHeight'];
	$config['videoBitrate'] = $_POST['videoBitrate'];
	$config['audioChannels'] = $_POST['audioChannels'];
	$config['audioBitrate'] = $_POST['audioBitrate'];
	$config['audioCodec'] = $_POST['audioCodec'];
	$config['siteDir'] = $_POST['siteDir'];
	$config['tmpDir'] = $_POST['tmpDir'];
	$config['uploadDir'] = $_POST['uploadDir'];
	$config['thumbDir'] = $_POST['thumbDir'];
	$config['uploadVideoDir'] = $_POST['uploadVideoDir'];
	$config['uploadVideoPrevDir'] = $_POST['uploadVideoPrevDir'];
	$config['uploadVideoPrevThumbDir'] = $_POST['uploadVideoPrevThumbDir'];
	$config['reSiteKey'] = $_POST['reSiteKey'];
	$config['reSecretKey'] = $_POST['reSecretKey'];
	function writeConfig($config = array()) {
	    $arrayAsString = var_export($config, true);
	    $string = "<?php\n";
	    $string .= "if (!defined('DONTHACKME')) {\n";
	    $string .= "	die(\"Dont hack me!\");\n";
		$string .= "}\n";
	    $string .= "\$config = $arrayAsString;\n";
	    $string .= "?>\n";
	    file_put_contents(CORE_DIR . '/config.php', $string);
	}
	$write = writeConfig($config);
	$content = "<h2>Конфигурация сохранена!</h2>";
}
else {
	$parse->get_tpl(DESIGN_DIR . '/config.tpl');
	$parse->set_tpl('{mysqlHost}',$config['mysqlHost']);
	$parse->set_tpl('{mysqlUser}',$config['mysqlUser']);
	$parse->set_tpl('{mysqlPassword}',$config['mysqlPassword']);
	$parse->set_tpl('{mysqlBase}',$config['mysqlBase']);
	$parse->set_tpl('{adminLogin}',$config['adminLogin']);
	$parse->set_tpl('{title}',$config['title']);
	$parse->set_tpl('{perPage}',$config['perPage']);
	$parse->set_tpl('{thumbWidth}',$config['thumbWidth']);
	$parse->set_tpl('{thumbHeight}',$config['thumbHeight']);
	$parse->set_tpl('{videoWidth}',$config['videoWidth']);
	$parse->set_tpl('{videoHeight}',$config['videoHeight']);
	$parse->set_tpl('{videoBitrate}',$config['videoBitrate']);
	$parse->set_tpl('{audioChannels}',$config['audioChannels']);
	$parse->set_tpl('{audioBitrate}',$config['audioBitrate']);
	$parse->set_tpl('{audioCodec}',$config['audioCodec']);
	$parse->set_tpl('{siteDir}',$config['siteDir']);
	$parse->set_tpl('{tmpDir}',$config['tmpDir']);
	$parse->set_tpl('{uploadDir}',$config['uploadDir']);
	$parse->set_tpl('{thumbDir}',$config['thumbDir']);
	$parse->set_tpl('{uploadVideoDir}',$config['uploadVideoDir']);
	$parse->set_tpl('{uploadVideoPrevDir}',$config['uploadVideoPrevDir']);
	$parse->set_tpl('{uploadVideoPrevThumbDir}',$config['uploadVideoPrevThumbDir']);
	$parse->set_tpl('{reSiteKey}',$config['reSiteKey']);
	$parse->set_tpl('{reSecretKey}',$config['reSecretKey']);
	$parse->tpl_parse();
	$content = $parse->template;
}

}
else {
	$content = "<br /> <div style=\"font-size: 24px;\">Вы не админ! Вы не вошли или вашего логина нет в конфиге.</div> <br />";

}
?>