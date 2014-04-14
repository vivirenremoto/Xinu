<?php

if(!empty($_COOKIE['dragable_rss_boxes']))list($lang) = explode('|',$_COOKIE['dragable_rss_boxes']);
else $lang = 'ES';
$dir = 'lang/'.$lang.'.php';
require_once($dir);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Xinu - <?php echo TXT_WHO_LINK;?></title>
	<meta http-equiv="content-language" content="ES" />
	<meta name="robots" content="noindex/nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/simple.css" media="screen"/>
</head>
<body>
<a href="http://www.viciao2k3.net/services/xinu/" title="Xinu"><img src="http://www.viciao2k3.net/services/xinu/img/xinu_log.gif" alt="xinu" /></a>
<?php
//<a href="http://www.technorati.com/search/http://www.viciao2k3.net/services/xinu/?partner=wordpress">More &raquo;</a>
require_once 'lib/rss/rss_fetch.inc';

$rss = fetch_rss('http://feeds.technorati.com/cosmos/rss/?url=http://www.viciao2k3.net/services/xinu/&partner=wordpress');
if ( isset($rss->items) && 1 < count($rss->items) ) {
?>
<h3><?php echo TXT_WHO_LINK;?></h3>
<ol>
<?php
//$rss->items = $rss->items ; array_slice($rss->items, 0, 10 );
foreach ($rss->items as $item ) {


preg_match("/^(http:\/\/)?([^\/]+)/i",
    $item['link'], $matches);
$host = $matches[2];

$host = eregi_replace('www\.','',$host);


?>
	<li><?php echo $host;?> &rarr; <a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></li>
<?php } ?>
</ol>
<?php
}
?>
</body>
</html>