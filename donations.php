<?php

if(!empty($_GET['lang'])){
	$dir = 'lang/'.strtoupper($_GET['lang']).'.php';
	if(!file_exists($dir))$lang = 'ES';
	else $lang = strtoupper($_GET['lang']);
}else{
	if(!empty($_COOKIE['dragable_rss_boxes']))list($lang) = explode('|',$_COOKIE['dragable_rss_boxes']);
	else $lang = 'ES';
}

$dir = 'lang/'.$lang.'.php';
require_once($dir);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Xinu - <?php echo TXT_LIST_DONATIONS;?></title>
	<meta http-equiv="content-language" content="ES" />
	<meta name="robots" content="noindex/nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/simple.css" media="screen"/>
	<style type="text/css">a{text-decoration:underline;}</style>
</head>
<body>
<a href="http://www.viciao2k3.net/services/xinu/" title="Xinu"><img src="http://www.viciao2k3.net/services/xinu/img/xinu_log.gif" alt="xinu" /></a>

<h3><?php echo TXT_LIST_DONATIONS;?></h3>
<?php echo TXT_THANKS3;?>
<ul>
	<li>17-07-2007 - <a href="http://hombrelobo.com" target="_blank">Hombrelobo.com</a> - 3,00 EUR</li>
	<li>17-07-2007 - <a href="http://www.uniondebloggershispanos.com/" target="_blank">Carmen</a> - 5,00 EUR</li>
</ul>
</body>
</html>