<?php

require_once '../funcions.php';
//$url = 'http://api.technorati.com/cosmos?key=86d13d68d7e9a7983e1ce5ed1606656f&url='.$site;
$url = 'http://www.technorati.com/blogs/'.$site.'?reactions';
$v = open_external_url($url);


if(!eregi('0 blog posts',$v)){



//preg_match('/([0-9\,]+)\<\/inboundlinks\>/si', $v, $r);
//$links =  ($r[1]) ? quitarPuntos($r[1]) : 0;

//preg_match('/([0-9\,]+)\<\/inboundblogs\>/si', $v, $r);
//$blogs =  ($r[1]) ? quitarPuntos($r[1]) : 0;

//$txt = '<a href="http://www.technorati.com/blogs/'.$site.'?reactions" target="_blank">'.$links.' '.TXT_LINKS.', '.$blogs. ' '.TXT_BLOGS.'</a>';




preg_match('/\<h1\>([0-9\,]+) blog reactions/si', $v, $r);
$blogs =  ($r[1]) ? quitarPuntos($r[1]) : 0;




}else $blogs =0;




$txt = '<a href="http://www.technorati.com/blogs/'.$site.'?reactions" target="_blank">'.$blogs. ' '.TXT_BLOGS.'</a>';




afegir_info(__FILE__,2,$txt,'Technorati','technorati');
echo $txt;

?>