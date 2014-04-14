<?php

require_once '../funcions.php';
$url = 'http://del.icio.us/url/check?url=' . $site .'&submit=check%20url';


/*
$v = open_external_url($url,'fopen');

preg_match('/this url has been saved by ([0-9\,]+) people/si', $v, $r);

*/

$r[1] = 0;

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,6,$txt,'del.icio.us','delicious');
echo $txt;

?>