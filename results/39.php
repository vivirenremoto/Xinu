<?php

require_once '../funcions.php';
$url = 'http://www.ask.com/web?q=links%3A' .$site;
$v = open_external_url($url);

preg_match('/\<\/span\> of ([0-9\,]+)/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0). '</a>';
afegir_info(__FILE__,2,$txt,'Ask Jeeves','ask');
echo $txt;

?>