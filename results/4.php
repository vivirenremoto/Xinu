<?php

require_once '../funcions.php';
$url = 'http://search.msn.com/results.aspx?q=site%3A'.$site;
$v = open_external_url($url);

preg_match('/of ([0-9\,]+) results/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0). '</a>';

afegir_info(__FILE__,3,$txt,'Live','live');

echo $txt;

?>