<?php

require_once '../funcions.php';
$url = 'http://www.digg.com/search?s=' . $site .'&submit=Search&section=news&type=url&area=all&sort=new';
$v = open_external_url($url,'fopen');

$txt = '<a href="'.$url.'" target="_blank">';

if(eregi('No results Found',$v))$txt .= 0;
else{
	$file_pattern = '/"Go to page ([0-9]+)"/i';
	if(preg_match_all ($file_pattern, $v, $matches)){
		$ultimapag = $matches[1][count($matches[0])-1];
		$url = 'http://digg.com/search/page'.$ultimapag.'?s=' .$site .'&area=all&type=url&search-buried=0&sort=new&section=news';
		$v = open_external_url($url,'fopen');
		$nnoticies =  ( ($ultimapag-1) * 15   ) + substr_count($v,'news-body');
		$txt .= quitarPuntos($nnoticies);
	}else{
		$nnoticies =  substr_count($v,'news-body');
		$txt .= quitarPuntos($nnoticies);
	}
}

$txt .= '</a>';
afegir_info(__FILE__,6,$txt,'Digg','digg_icon');
echo $txt;

?>