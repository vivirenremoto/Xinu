<?php

require_once '../funcions.php';
$v = open_external_url($direccio_completa);
$v = ereg_replace("(\r\n|\r)", "\n", $v);

if(eregi('image\/x\-icon',$v)){
	$i=0;
	$TROBAT=FALSE;
	$t=explode("\n",$v);
	while(!$TROBAT && $i<count($t)){
		$TROBAT = eregi('image\/x\-icon',$t[$i]);
		if(!$TROBAT)$i++;
	}
preg_match("/href=\"(.*)\" /si", $t[$i], $r);

$r[1] = eregi_replace("^\/",'',$r[1]);


if(!eregi('^http:\/\/',$r[1]))$r[1]=$direccio_completa.'/'.$r[1];
	$txt = '<img src="'.$r[1].'">';
	$rating=10;
}else{
	$txt = TXT_NOFAVICON;
	$rating=0;
}

$txt2 .= $txt . ferMissatge($rating,TXT_DIAG_FAVICON);
$txt .= ferMissatge($rating,TXT_DIAG_FAVICON,'',1);

afegir_info(__FILE__,1,$txt,'Favicon');
echo $txt2;

?>