<?php

require_once '../funcions.php';
$metatagarray = get_meta_tags( $direccio_completa );
$keywords = addslashes($metatagarray[ 'keywords' ]);

if(!empty($keywords)){
	if(eregi(',',$keywords)){
		$ntags=count(explode(',',$keywords));
		if(!eregi(', ',$keywords))$keywords=str_replace(',',', ',$keywords);
	}else $ntags=count(explode(' ',$keywords));
}else{
	$keywords='';
	$ntags=0;
}

$keywords=ereg_replace("(\r\n|\n|\r)", '',$keywords);

$rating=(($ntags*10)/30);

$txt1 = '';

if(!empty($keywords))$txt1 .= $keywords.'<br />';
$txt1 .= $ntags.' '.TXT_DIAG_WORD;

$txt21 .= $txt1 . ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(30-$ntags).' '.TXT_DIAG_WORDS.')');
$txt1 .= ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(30-$ntags).' '.TXT_DIAG_WORDS.')','',1);

afegir_info(__FILE__,1,$txt1,TXT_KEYWORDS);

/////////////////////////////////////////////////////////////////////


$description = addslashes($metatagarray[ 'description' ]);

if(!empty($description))$nparaules2=nparaules(explode(' ',$description));
else{
	$description='';
	$nparaules2=0;
}

$description=ereg_replace("(\r\n|\n|\r)", '',$description);

$rating=(($nparaules2*10)/30);

$txt2 = '';

if(!empty($description))$txt2 .= stripslashes($description).'<br />';
$txt2 .= $nparaules2.' '.TXT_DIAG_WORD;

$txt22 .= $txt2 . ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(30-$nparaules2).' '.TXT_DIAG_WORDS.')');
$txt2 .= ferMissatge($rating,'('.TXT_DIAG_CAN_PUT.' '.(30-$nparaules2).' '.TXT_DIAG_WORDS.')','',1);

afegir_info(__FILE__,1,$txt2,TXT_DESCR);

















echo "document.getElementById('i_14').innerHTML='$txt21';";
echo "document.getElementById('i_15').innerHTML='$txt22';";
?>