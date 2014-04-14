<?php

require_once '../funcions.php';
$url = 'http://www.bloglines.com/search?q=http%3a%2f%2f' . $site.'&t=f';
$v = open_external_url($url);

preg_match("/of\n  ([0-9\,]+)\n feeds/si", $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';

afegir_info(__FILE__,7,$txt,TXT_FEED_BLOGLINES,'bloglines');
echo $txt;

?>