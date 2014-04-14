<?php

require_once '../funcions.php';
$url = 'http://busca.orange.es/search?buscar=links%3A' .$site;
$v = open_external_url($url);

preg_match('/\<span class\="gris2"\>\<strong\>([0-9\,]+)/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'Orange','orange');
echo $txt;

?>