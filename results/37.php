<?php

require_once '../funcions.php';
$url = 'http://www.altavista.com/web/results?q=link%3A' .$site;
$v = open_external_url($url);

preg_match('/found ([0-9\,]+) results/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0). '</a>';
afegir_info(__FILE__,2,$txt,'Altavista','altavista');
echo $txt;

?>