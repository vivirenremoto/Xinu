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
	<title>Xinu - <?php echo TXT_SLOGAN;?></title>
	<meta http-equiv="content-language" content="ES" />
	<meta name="robots" content="index,follow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo TXT_SLOGAN;?>" />
	<link rel="stylesheet" href="css/dragable-boxes.css" type="text/css" />
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="js/lang.php?lang=<?php echo $lang;?>"></script>
	<script type="text/javascript" src="js/general.js"></script>
</head>
<body>
<div id="header">
<div id="logo">
<form action="javascript:;" onsubmit="statsTot();">
<label for="url"><b><?php echo TXT_URL;?>:</b> (<?php echo TXT_TRY;?>)<br />
<input id="url" size="27" /> <input type="submit" value="Go" /> <span id="loading">&nbsp;</span><a href="results/pdf.php" id="btn_dpdf" class="down_pdf" title="<?php echo TXT_PDF_INF;?>" style="display:none;" rel="nofollow">&nbsp;</a></label><br /><br />
<label for="sel_tot"><input id="sel_tot" type="checkbox" onclick="mostrartodo(this);" checked="checked" /> <b><?php echo TXT_ELEMENTS;?>:</b></label><br />
<label for="chk_7"><input id="chk_7" type="checkbox" onclick="mostrarCaixa(7);" checked="checked" /> <?php echo TXT_SINDICATE;?></label><br />
<label for="chk_5"><input id="chk_5" type="checkbox" onclick="mostrarCaixa(5);" checked="checked" /> <?php echo TXT_VALIDATION;?></label><br />
<label for="chk_6"><input id="chk_6" type="checkbox" onclick="mostrarCaixa(6);" checked="checked" /> <?php echo TXT_BOOKMARKS;?></label><br />
<label for="chk_4"><input id="chk_4" type="checkbox" onclick="mostrarCaixa(4);" checked="checked" /> <?php echo TXT_RANK;?></label><br />
<label for="chk_2"><input id="chk_2" type="checkbox" onclick="mostrarCaixa(2);" checked="checked" /> <?php echo TXT_BACKLINKS;?></label><br />
<label for="chk_3"><input id="chk_3" type="checkbox" onclick="mostrarCaixa(3);" checked="checked" /> <?php echo TXT_PINDEXED;?></label><br />
<label for="chk_1"><input id="chk_1" type="checkbox" onclick="mostrarCaixa(1);" checked="checked" /> <?php echo TXT_DIAGNOSTIC;?></label><br />
<label for="chk_8"><input id="chk_8" type="checkbox" onclick="mostrarCaixa(8);" checked="checked" /> <?php echo TXT_DOMAIN;?></label><br />
<label for="chk_9"><input id="chk_9" type="checkbox" onclick="mostrarCaixa(9);" checked="checked" /> <?php echo TXT_SCREENSHOT;?></label><br /><br />
<label for="autorun"><input id="autorun" type="checkbox" onclick="saveCookies();" /> <?php echo TXT_AUTORUN;?></label><br />
<label for="avisar"><input id="avisar" type="checkbox" onclick="saveCookies();" /> <?php echo TXT_ALERT;?></label>
</form><br /><br />
<!--<a href="http://www.viciao2k3.net/?p=64&amp;akst_action=share-this" title="E-mail this, post to del.icio.us, etc." id="akst_link_64" class="akst_share_link" rel="nofollow"><?php echo TXT_SHARE;?></a> | -->

<?php echo TXT_INF;?>: <a href="credits.php"><?php echo TXT_CREDITS;?></a> | <a href="links.php"><?php echo TXT_WHO_LINK;?></a> | <a href="changelog.php"><?php echo TXT_CHANGES;?></a><br />
<?php echo TXT_HEL;?>: <a href="support.php">Translations, Bugs, Ideas</a>

<br /><br />

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=gafeman%40gmail%2ecom&item_name=P%c3%a1game%20un%20caf%c3%a9&no_shipping=1&cn=Comentarios%20%28opcional%29&tax=0&currency_code=EUR&lc=ES&bn=PP%2dDonationsBF&charset=UTF%2d8" target="_blank"><b><?php echo TXT_SPONSOR;?></b></a> | <a href="donations.php"><?php echo TXT_LIST_DONATIONS;?></a><br />
<?php echo TXT_DONATION;?>

<br /><br /><b><?php echo TXT_LANG;?>:</b><br /><a href="?lang=uk" title="English"><img src="img/flag_uk.gif" alt="English" /></a> <a href="?lang=es" title="Espa&ntilde;ol"><img src="img/flag_es.gif" hspace="5" alt="Espa&ntilde;ol" /></a>

<br /><br />
<script type="text/javascript"><!--
google_ad_client = "pub-5761668907205159";
google_ad_width = 120;
google_ad_height = 90;
google_ad_format = "120x90_0ads_al";
google_ad_channel = "";
google_color_border = "efefef";
google_color_bg = "efefef";
google_color_link = "000000";
google_color_text = "FFFFFF";
google_color_url = "FF0033";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br /><br />
<a rel="license" href="http://creativecommons.org/licenses/by/2.5/es/">
<img alt="Creative Commons License" style="border-width:0" src="http://creativecommons.org/images/public/somerights20.png" />
</a>
<br />
<span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/Text" property="dc:title" rel="dc:type">xinu</span> by 
<a xmlns:cc="http://creativecommons.org/ns#" href="http://www.viciao2k3.net/" property="cc:attributionName" rel="cc:attributionURL">miquel camps orteza</a> is licensed under a 
<a rel="license" href="http://creativecommons.org/licenses/by/2.5/es/">Creative Commons Atribuci&oacute;n 2.5 Espa&ntilde;a License</a>.
<br />Based on a work at 
<a xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://www.viciao2k3.net/services/xinu" rel="dc:source">www.viciao2k3.net</a>.
</div>
</div>
<div id="mainContainer">
<font color="red"><?php echo TXT_INFO_TOP; ?></font>
<div id="slogan"><?php echo TXT_SLOGAN;?></div>
<div id="floatingBoxParentContainer" style="display:none;"></div>
</div>
<div id="div_so"></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">_uacct = "UA-1914564-3";urchinTracker();</script>
<script type="text/javascript">if(document.getElementById('autorun').checked)addLoadEvent(statsTot);</script>
</body>
</html>