<?php
require_once '../funcions.php';
$ip = @gethostbyname($host);

$ciutatip = eregi_replace('\(unknown city\)|\(unknown city\?\)|\(unknown country\?\)',TXT_NO_DISPONIBLE,open_external_url('http://api.hostip.info/get_html.php?ip='.$ip));

$pais = substr($ciutatip, (strpos($ciutatip,':')+2), ((strpos($ciutatip,'(')-1)-(strpos($ciutatip,':')+2)));
$pais = addslashes(strtoupper(substr($pais,0,1)).strtolower(substr($pais,1,strlen($pais))));
$sigles = substr($ciutatip, (strpos($ciutatip,'(')+1), 2);
$ciutat = substr($ciutatip, (strpos($ciutatip,')')+8), strlen($ciutatip));
$ciutat = addslashes(strtoupper(substr($ciutat,0,1)).strtolower(substr($ciutat,1,strlen($ciutat))));

$googlemaps=str_replace(' ','%20',$pais)."%2C".str_replace(' ','%20',$ciutat);

if(($ciutat==TXT_NO_DISPONIBLE && $pais==TXT_NO_DISPONIBLE)||(empty($ciutat) && empty($pais)))$f=TXT_NO_DISPONIBLE;
else{
	$lloc = '';
	if($ciutat!=TXT_NO_DISPONIBLE)$lloc .=$ciutat;
	if($ciutat!=TXT_NO_DISPONIBLE && $pais!=TXT_NO_DISPONIBLE) $lloc .=', ';
	if($pais!=TXT_NO_DISPONIBLE)$lloc .=$pais;
	$f='<a href="http://maps.google.com/maps?near='.$lloc.'" target="_blank">'.$lloc.'</a>';
}


$txt = '<img src="http://api.hostip.info/flag.php?ip='.$ip.'" border="1" width="20" height="15" align="absmiddle" /> '.$f;
afegir_info(__FILE__,8,$txt,TXT_COUNTRY,'world');
echo $txt;

?>