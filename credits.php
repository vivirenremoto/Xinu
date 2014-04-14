<?php

if(!empty($_COOKIE['dragable_rss_boxes']))list($lang) = explode('|',$_COOKIE['dragable_rss_boxes']);
else $lang = 'ES';
$dir = 'lang/'.$lang.'.php';
require_once($dir);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Xinu - <?php echo TXT_CREDITS;?></title>
	<meta http-equiv="content-language" content="ES" />
	<meta name="robots" content="noindex/nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/simple.css" media="screen"/>
	<style type="text/css">a{text-decoration:underline;}</style>
</head>
<body>
<a href="http://www.viciao2k3.net/services/xinu/" title="Xinu"><img src="http://www.viciao2k3.net/services/xinu/img/xinu_log.gif" alt="xinu" /></a>
<h3><?php echo TXT_CREDITS;?></h3>
<ul>
	<li><?php echo TXT_AUTHOR2;?> <a href="http://www.viciao2k3.net/" target="_blank">Miquel Camps Orteza</a></li>
	<li><?php echo TXT_BASE;?> <a href="http://www.dhtmlgoodies.com/" target="_blank">Alf Magne Kalleland</a></li>
	<li><?php echo TXT_FICONS;?> <a href="http://www.famfamfam.com/" target="_blank">Mark James</a></li>
</ul>
<h3><?php echo TXT_API;?></h3>
<ul>
	<li><a href="http://www.hostip.info/" target="_blank">IP Address Lookup</a></li>
	<li><a href="http://technorati.com/developers/api/" target="_blank">Technorati</a></li>
	<li><a href="http://www.snap.com/about/shots_central.php" target="_blank">Snap Shots</a></li>
	<li><a href="http://www.feedburner.com/fb/a/developers;jsessionid=57356342F70FDBD861AA7EB08B5F8D6E.app3" target="_blank">FeedBurner</a></li>
</ul>

<h3><?php echo TXT_CODES;?></h3>
<ul>
	<li>Pagerank Lookup <?php echo TXT_BYA;?> <a href="http://www.hm2k.com/" target="_blank">HM2K</a></li>
	<li>HTML to PDF <?php echo TXT_BYA;?> <a href="http://www.phpclasses.org/browse/package/2905.html" target="_blank">Harish Chauhan</a></li>
	<li>PACKER <?php echo TXT_BYA;?> <a href="http://dean.edwards.name/packer/" target="_blank">Dean Edwards</a></li>
</ul>


<h3><?php echo TXT_TRANSLATORS;?></h3>
<ul>
	<!--<li>Français <?php echo TXT_BYA;?> X</li>-->
	<li>English <?php echo TXT_BYA;?> <a href="http://www.google.es/translate_t?hl=es" target="_blank">Google Translator</a></li>

</ul>


<h3><?php echo TXT_BRAIN;?></h3>
<ul>
	<li><font color="red">soon in new update</font><br />I think it would be better if the PDF were laid out in a two-column grid though.<BR/><a href="http://www.chnorton.com.au/" target="_blank">Chris Norton</a></li>

</ul>

<h3><?php echo TXT_THANKS;?></h3>
<ul>
	<li><?php echo TXT_THANKS2;?></li>
</ul>


</body>
</html>