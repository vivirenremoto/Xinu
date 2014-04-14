<?php

require_once '../funcions.php';
$url = 'http://clusty.com/search?query=link%3A' .$site;
$v = open_external_url($url);

preg_match('/Top \<span class\="intronum"\>([0-9\,]+)<\/span>/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.( ($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'Clusty','clusty');
echo $txt;

?>