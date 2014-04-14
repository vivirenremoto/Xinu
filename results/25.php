<?php

require_once '../funcions.php';
$url = 'http://clipmarks.com/search/'.$site.'/';
$v = open_external_url($url);

preg_match('/\<b\>([0-9]+)\<\/b\> clipmarks found/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,6,$txt,'Clipmarks','clipmarks');
echo $txt;

?>