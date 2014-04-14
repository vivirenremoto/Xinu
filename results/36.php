<?php

require_once '../funcions.php';
$url = 'http://buscador.lycos.es/cgi-bin/pursuit?query=linkdomain%3A' .$site;
$v = open_external_url($url);

preg_match('/Internet de  ([0-9\.]+)\<\/div\>/si', $v, $r);
$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,2,$txt,'Lycos','lycos');
echo $txt;

?>