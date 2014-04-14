<?php

require_once '../funcions.php';
$url = 'http://www.mister-wong.es/search/?search_type=w&keywords='.$site.'&btn=buscar';
$v = open_external_url($url);

preg_match('/([0-9]+) marcadores/i', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,6,$txt,'Mister Wong','wong');
echo $txt;

?>