<?php

require_once '../funcions.php';
$url = 'http://search.live.com/results.aspx?q=link%3Ahttp%3a%2f%2f' . $site;
$v = open_external_url($url,'fopen');

preg_match('/of ([0-9\,]+) results/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0).  '</a>';
afegir_info(__FILE__,2,$txt,'Live','live');
echo $txt;

?>