<?php

require_once '../funcions.php';
$url = 'http://www.technorati.com/blogs/'.$site.'?reactions';
$v = open_external_url($url);


if(!eregi('0 blog posts',$v)){


preg_match('/\<div class\="rank"\>Rank: ([0-9\,]+)/si', $v, $r);
$rank = (($r[1]) ? quitarPuntos($r[1]) : 0);

preg_match_all ('/Authority: ([0-9\,]+)/si', $v, $r);





$authority  = $r[1][count($r[1])-1];



}else{
	$rank = 0;
	$authority=0;
}



$txt = '<a href="http://www.technorati.com/blogs/'.$site.'?reactions" target="_blank">Authority: '.$authority.', Rank: '.$rank.'</a>';

afegir_info(__FILE__,4,$txt,'Technorati','technorati');
echo $txt;

?>