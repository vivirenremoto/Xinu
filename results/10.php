<?php

require_once '../funcions.php';
$url = 'http://jigsaw.w3.org/css-validator/validator?uri='.$site;
$v = open_external_url($url);

$txt = $txt2 = '<a href="'.$url.'" target="_blank">';

if(eregi('Congratulations! No Error Found',$v))$txt = $txt2 .= TXT_OK_VALID;
else if(eregi('No style sheet found',$v))$txt = $txt2 .= TXT_NO_CSS;
else{
	$errors = substr_count($v,'linenumber');
	$cadena= '';
		if($errors>0){
			$txt.= '<img src="http://www.viciao2k3.net/services/xinu/img/alert.gif" align="absmiddle"><font color="red"> '.$errors.' '.TXT_ERRORS.'</font>, ';
			$txt2.= '<span class="errors">'.$errors.' '.TXT_ERRORS.'</span>, ';
		}
	$txt .= TXT_KO_VALID;
	$txt2 .= TXT_KO_VALID;
}

$txt .= '</a>';
$txt2 .= '</a>';

afegir_info(__FILE__,5,$txt,'XHTML','w3c');
echo $txt2;

?>