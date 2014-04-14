<?php

require_once '../funcions.php';
$url = 'http://meneame.net/search/' .$site;
$v = open_external_url($url);

$txt = '<a href="'.$url.'" target="_blank">';

if(!eregi('news-details',$v))$txt .= 0;
else{
	$file_pattern = '/"?page=([0-9]+)"/i';
	if(preg_match_all ($file_pattern, $v, $matches)){
		$ultimapag = $matches[1][count($matches[0])-1];
		$url = 'http://meneame.net/search/' .$site .'?page='.$ultimapag;
		$v = open_external_url($url,'fopen');
		$nnoticies =  ( ($ultimapag-1) * 20   ) + substr_count($v,'news-details');
		$txt .= quitarPuntos($nnoticies);
	}else{
		//nomes hi ha una pagina
		$nnoticies =  substr_count($v,'news-details');
		$txt .= quitarPuntos($nnoticies);
	}
}

$txt .= '</a>';
afegir_info(__FILE__,6,$txt,'Meneame','meneame');
echo $txt;

?>