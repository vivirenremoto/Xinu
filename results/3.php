<?php

require_once '../funcions.php';
$url = 'http://siteexplorer.search.yahoo.com/search?p='.$site.'&bwm=i';
$v = open_external_url($url);

preg_match('/of about \<strong\>([0-9\,]+)/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0). '</a>';

afegir_info(__FILE__,3,$txt,'Yahoo','yahoo');
echo $txt;

?>