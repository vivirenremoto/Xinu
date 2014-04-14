<?php

require_once '../funcions.php';
$urlrss = urlRSS($_GET['url']);

$url = 'http://validator.w3.org/feed/check.cgi?url='. urlencode($urlrss);

$txt = $txt2 = '<a href="'.$url.'" target="_blank">';

if(!empty($urlrss)){

$v = open_external_url($url);



if(!eregi('An error occurred while',$v)){
	if(eregi('This is a valid RSS feed',$v))$txt = $txt2 .= TXT_OK_VALID.'</a>';
	else{
		$errors = substr_count($v,'message');
		if($errors>0){
			$txt.= '<img src="http://www.viciao2k3.net/services/xinu/img/alert.gif" align="absmiddle"><font color="red"> '.$errors.' '.TXT_ERRORS.'</font>, ';
			$txt2.= '<span class="errors">'.$errors.' '.TXT_ERRORS.'</span>, ';
		}
		$txt .= TXT_KO_VALID;
		$txt2 .= TXT_KO_VALID;
	}
}else{
	$txt .= TXT_NO_RSS;
	$txt2 .= TXT_NO_RSS;
}


}else{
	$txt .= TXT_NO_RSS;
	$txt2 .= TXT_NO_RSS;
}

$txt .= '</a>';
$txt2 .= '</a>';

afegir_info(__FILE__,5,$txt,'RSS','rss-icon');
echo $txt2;

?>