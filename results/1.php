<?php

require_once '../funcions.php';
$url = 'http://www.google.es/search?q=site%3A'.$site;
$v = open_external_url($url);

if(preg_match('/de aproximadamente \<b\>([0-9\.]+)\<\/b\>/si', $v, $r)){}
else preg_match('/de un total de \<b\>([0-9\.]+)\<\/b\>/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0). '</a>';

afegir_info(__FILE__,3,$txt,'Google','Google');
echo $txt;

?>