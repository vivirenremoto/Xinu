<?php

require_once '../funcions.php';
$url = 'http://data.alexa.com/data?cli=10&dat=snbamz&url='.$site;
$v = open_external_url($url);

preg_match('/\<LINKSIN NUM\="([0-9]+)"\/\>/si', $v, $r);
$url='http://www.alexa.com/data/details/traffic_details?url='.$site;

$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'Alexa','alexa');
echo $txt;

?>