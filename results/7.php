<?php

require_once '../funcions.php';
$url = 'http://data.alexa.com/data?cli=10&dat=snbamz&url='.$host;
$v = open_external_url($url);

preg_match('/\<popularity url\="(.*)" TEXT\="([0-9]+)"\/\>/si', $v, $r);

$url = 'http://www.alexa.com/data/details/traffic_details?url='.$direccio;

$txt = '<a href="'.$url.'" target="_blank">';

if(!eregi(eregi_replace('www\.','',$_GET['url']),$r[1]))$txt .= TXT_NO;
else $txt .= ($r[2]) ? ''.quitarPuntos($r[2]) : TXT_NO;
$txt .= '</a>';

afegir_info(__FILE__,4,$txt,'Alexa','alexa');
echo $txt;

?>