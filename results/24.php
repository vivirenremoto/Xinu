<?php

require_once '../funcions.php';
$url = 'http://tec.fresqui.com/search/node/' . $site;
$v = open_external_url($url);

$txt = '<a href="'.$url.'" target="_blank">';

if(!eregi('search-info',$v))$txt .= 0;
else{
	$file_pattern = '/"Go to page ([0-9]+)"/i';
	if(preg_match_all ($file_pattern, $v, $matches)){
		$ultimapag = $matches[1][count($matches[0])-1];
		$url = 'http://tec.fresqui.com/search/node/' .$site .'?page='.$ultimapag;
		$v = open_external_url($url,'fopen');
		$nnoticies =  ( ($ultimapag-1) * 9   ) + substr_count($v,'search-info');
		$txt .= quitarPuntos($nnoticies);
	}else{
		//nomes hi ha una pagina
		$nnoticies =  substr_count($v,'news-details');
		$txt .= quitarPuntos($nnoticies);
	}
}

$txt .= '</a>';
afegir_info(__FILE__,6,$txt,'Fresqui','fresqui');
echo $txt;

?>