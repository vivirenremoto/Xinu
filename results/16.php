<?php

require_once '../funcions.php';
$v = open_external_url($direccio_completa);

$tam=strlen($v);
$tamanyhtml = ByteSize($tam);

$rating = round(((81920*10)/$tam),2);

$txt1 = $tamanyhtml;

$txt21 .= $txt1 . ferMissatge($rating,'<font color="red">'.TXT_DIAG_SIZE_KO1.'</font> ('.TXT_DIAG_SIZE_KO2.' 80 KB)');
$txt1 .= ferMissatge($rating,'<font color="red">'.TXT_DIAG_SIZE_KO1.'</font> ('.TXT_DIAG_SIZE_KO2.' 80 KB)','',1);

afegir_info(__FILE__,1,$txt1,TXT_HTML_SIZE);

//////////////////////////////////////////////////////////////////////

$v2 = ereg_replace("(\r\n|\r)", "\n", $v);

if(eregi('image\/x\-icon',$v2)){
	$i=0;
	$TROBAT=FALSE;
	$t=explode("\n",$v2);
	while(!$TROBAT && $i<count($t)){
		$TROBAT = eregi('image\/x\-icon',$t[$i]);
		if(!$TROBAT)$i++;
	}
preg_match("/href=\"(.*)\" /si", $t[$i], $r);

$r[1] = eregi_replace("^\/",'',$r[1]);


if(!eregi('^http:\/\/',$r[1]))$r[1]=$direccio_completa.'/'.$r[1];
	$txt3 = '<img src="'.$r[1].'">';
	$rating=10;
}else{
	$txt3 = TXT_NOFAVICON;
	$rating=0;
}

$txt23 .= $txt3 . ferMissatge($rating,TXT_DIAG_FAVICON);
$txt3 .= ferMissatge($rating,TXT_DIAG_FAVICON,'',1);

afegir_info(__FILE__,1,$txt3,'Favicon');

//////////////////////////////////////////////////////////////////////



$v = strtoupper($v);

$nh1=substr_count($v, '<H1>');
$nh2=substr_count($v, '<H2>');
$nh3=substr_count($v, '<H3>');
$nh4=substr_count($v, '<H4>');
$nh5=substr_count($v, '<H5>');
$nh6=substr_count($v, '<H6>');
$nbold=substr_count($v, '<B>');
$nbold+=substr_count($v, '<STRONG>');
$nitalic=substr_count($v, '<I>');
$nitalic+=substr_count($v, '<ITALIC>');
$nunderline=substr_count($v, '<UNDERLINE>');
$nunderline+=substr_count($v, '<U>');
$nlinks=substr_count($v, '<A');
$nimg=substr_count($v, '<IMG');
$nscript=substr_count($v, '<SCRIPT');
$ntable=substr_count($v, '<TABLE');
$ndiv=substr_count($v, '<DIV');

$txt2 = $txt22 = '&lt;H1&gt; ('.$nh1.')<br />&lt;H2&gt; ('.$nh2.')<br />&lt;H3&gt; ('.$nh3.')<br />&lt;H4&gt; ('.$nh4.')<br />&lt;H5&gt; ('.$nh5.')<br />&lt;H6&gt; ('.$nh6.')<br />&lt;B&gt;/&lt;STRONG&gt; ('.$nbold.')<br />&lt;I&gt;/&lt;ITALIC&gt; ('.$nitalic.')<br />&lt;U&gt;/&lt;UNDERLINE&gt; ('.$nunderline.')<br />&lt;IMG&gt; ('.$nimg.')<br />&lt;A&gt; ('.$nlinks.')<br />&lt;SCRIPT&gt; ('.$nscript.')<br />&lt;TABLE&gt; ('.$ntable.')<br />&lt;DIV&gt; ('.$ndiv.')';

afegir_info(__FILE__,1,$txt2,TXT_HTML_TAGS);

//////////////////////////////////////////////////////////////////////


















echo "document.getElementById('i_16').innerHTML='$txt21';";
echo "document.getElementById('i_17').innerHTML='$txt22';";
echo "document.getElementById('i_18').innerHTML='$txt23';";
?>