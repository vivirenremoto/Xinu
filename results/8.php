<?php

require_once '../funcions.php';
$url = 'http://search.dmoz.org/cgi-bin/search?search=' .$site;
$v = open_external_url($url);

$txt = '<a href="'.$url.'" target="_blank">'.((preg_match('/\<center\>No \<b\>/si', $v, $r)) ? TXT_NO : TXT_YES).'</a>';

afegir_info(__FILE__,4,$txt,'DMOZ','dmoz');
echo $txt;

?>