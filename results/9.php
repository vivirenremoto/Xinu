<?php

require_once '../funcions.php';
$url = 'http://validator.w3.org/check?uri=http://'.$site;
$v = open_external_url($url);

$txt = $txt2 = '<a href="'.$url.'" target="_blank">';

if(eregi('This Page Is Valid XHTML',$v))$txt = $txt2 .= TXT_OK_VALID;
else{
	$errors = substr_count($v,'message');
	if(preg_match('/Failed validation, ([0-9\,]+) errors/si', $v, $r)){
		$errors = ($r[1]) ? str_replace(',', '', $r[1]) : '0';
		if($errors>0){
			$txt.= '<img src="http://www.viciao2k3.net/services/xinu/img/alert.gif" align="absmiddle"><font color="red"> '.$errors.' '.TXT_ERRORS.'</font>, ';
			$txt2.= '<span class="errors">'.$errors.' '.TXT_ERRORS.'</span>, ';
		}
	}
	$txt .= TXT_KO_VALID;
	$txt2 .= TXT_KO_VALID;
}

$txt .= '</a>';
$txt2 .= '</a>';

afegir_info(__FILE__,5,$txt,'XHTML','w3c');
echo $txt2;

?>
