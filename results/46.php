<?php

require_once '../funcions.php';
$url='http://data.alexa.com/data?cli=10&dat=snbamz&url='.$site;
$v = open_external_url($url);

preg_match('/OWNER NAME\="([A-Za-z0-9\- .]+)"/si', $v, $r);

$url='http://www.alexa.com/data/details/main?q='.$site.'&url='.$site.'/';

$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? $r[1] : TXT_NO_DISPONIBLE). '</a>';
afegir_info(__FILE__,8,$txt,TXT_AUTHOR,'persona');
echo $txt;

?>