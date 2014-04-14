<?php

require_once '../funcions.php';
$ip = @gethostbyname($host);

$txt = '<a href="http://www.dnsstuff.com/tools/whois.ch?&ip='.$url.'" target="_blank">'.$ip.'</a>';
afegir_info(__FILE__,8,$txt,'IP','key');
echo $txt;

?>