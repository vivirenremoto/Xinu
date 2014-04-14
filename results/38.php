<?php

require_once '../funcions.php';
$url = 'http://www.alltheweb.com/search?q=link%3A' .$site;
$v = open_external_url($url);

preg_match('/\<span class\="ofSoMany"\>([0-9\,]+)\<\/span\>/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'AlltheWeb','alltheweb');
echo $txt;

?>