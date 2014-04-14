<?php

require_once '../funcions.php';
$url = 'http://www.webcrawler.com/webcrawler/ws/results/Web/links!3A' . str_replace('.','!FE',str_replace('%','!',$site))."/1/417/TopNavigation/Relevance/zoom=off/_iceUrlFlag=7?_IceUrl=true";
$v = open_external_url($url);

preg_match('/of ([0-9\,]+)/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'Webcrawler','none');
echo $txt;

?>