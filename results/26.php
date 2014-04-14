<?php

require_once '../funcions.php';
$urlrss = urlRSS($direccio_completa);

if(!empty($urlrss)){
	$url = 'http://api.feedburner.com/awareness/1.0/GetFeedData?uri=' . $urlrss;
	$v = open_external_url($url);
	if(!eregi('stat\=\"fail\"',$v)){
		preg_match('/circulation\=\"([0-9\.]+)\"/si', $v, $r);
		$txt1 = quitarPuntos($r[1]);


		preg_match('/hits\=\"([0-9\.]+)\"/si', $v, $r);
		$txt2 = quitarPuntos($r[1]);


	}else $txt1 =$txt2 = TXT_FEEDBURNER;
}else $txt1 =$txt2 = TXT_NO_RSS;




afegir_info(__FILE__,7,$txt1,TXT_FEED_PEOPLE,'heart');
afegir_info(__FILE__,7,$txt2,TXT_FEED_VISITS,'persona');


//document.getelement
echo "document.getElementById('i_26').innerHTML='$txt1';";
echo "document.getElementById('i_27').innerHTML='$txt2';";

?>