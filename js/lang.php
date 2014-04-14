<?php
if(!empty($_GET['lang'])){
	$dir = '../lang/'.strtoupper($_GET['lang']).'.php';
	if(!file_exists($dir))$lang = 'ES';
	else $lang = strtoupper($_GET['lang']);
}

$dir = '../lang/'.$lang.'.php';
require_once($dir);
?>
		lang='<?php echo $lang;?>';
		TXT_AUTHOR = '<?php echo TXT_AUTHOR;?>';
		TXT_REQUIRE = '<?php echo TXT_REQUIRE;?>';
		TXT_BROKEN_URL = '<?php echo TXT_BROKEN_URL;?>';
		TXT_BOOKMARKS = '<?php echo TXT_BOOKMARKS;?>';
		TXT_VALIDATE = '<?php echo TXT_VALIDATION;?>';
		TXT_FEED = '<?php echo TXT_SINDICATE;?>';
		TXT_BACKLINKS = '<?php echo TXT_BACKLINKS;?>';
		TXT_DIAGNOSTIC = '<?php echo TXT_DIAGNOSTIC;?>';
		TXT_DOMAIN = '<?php echo TXT_DOMAIN;?>';
		TXT_RANK = '<?php echo TXT_RANK;?>';
		TXT_P_INDEX = '<?php echo TXT_PINDEXED;?>';
		TXT_IMG_GOOGLE = '<?php echo TXT_IMG_GOOGLE;?>';
		TXT_URL = '<?php echo TXT_URL;?>';
		TXT_TITLE = '<?php echo TXT_TITLE;?>';
		TXT_KEYWORDS = '<?php echo TXT_KEYWORDS;?>';
		TXT_DESCR = '<?php echo TXT_DESCR;?>';
		TXT_HTML_SIZE = '<?php echo TXT_HTML_SIZE;?>';
		TXT_HTML_TAGS = '<?php echo TXT_HTML_TAGS;?>';
		TXT_FEED_PEOPLE = '<?php echo TXT_FEED_PEOPLE;?>';
		TXT_FEED_VISITS = '<?php echo TXT_FEED_VISITS;?>';
		TXT_FEED_BLOGLINES = '<?php echo TXT_FEED_BLOGLINES;?>';
		TXT_COUNTRY = '<?php echo TXT_COUNTRY;?>';
		TXT_ONLINE = '<?php echo TXT_ONLINE;?>';
		TXT_PHOTO = '<?php echo TXT_SCREENSHOT;?>';