<?php

require_once '../funcions.php';
$v = open_external_url($direccio_completa);

$start = '<title>';
$end = '<\/title>';
    

preg_match( '/'.$start.'(.*)'.$end.'/si', $v, $match );
$title = addslashes($match[ 1 ]);
$title=ereg_replace("(\r\n|\n|\r)", '',$title);



if(!empty($title)){
	if(eregi('[<][/]title[>]',$title))$title=substr($title,0,strpos(strtoupper($title),'</TITLE>'));
    $nparaules1=nparaules(explode(' ',$title));
}else{
	$title='';
	$nparaules1=0;
}

$rating=(($nparaules1*10)/10);

$txt = stripslashes($title).'<br />'.$nparaules1.' '.TXT_DIAG_WORD;

$txt2 .= $txt . ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(10-$nparaules1).' '.TXT_DIAG_WORDS.')');
$txt .= ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(10-$nparaules1).' '.TXT_DIAG_WORDS.')','',1);

afegir_info(__FILE__,1,$txt,TXT_TITLE);
echo $txt2;

?>