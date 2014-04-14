<?php

require_once '../funcions.php';

require('../lib/html2pdf/html_to_pdf.inc.php');







session_start();


$codihtml = '<style>a img{border:0px;}a{color:#d96d0d;}body{font-size:0.7em;font-family:\'Trebuchet MS\',\'Lucida Sans Unicode\',\'Arial\',sans-serif;}</style><center><table border="0" width="288">';


foreach ($_SESSION['infocols'] as $key => $fila){


//fer switch del titol
switch($key){
	case 1:
	$titol = TXT_DIAGNOSTIC;
	break;
	case 2:
	$titol = TXT_BACKLINKS;
	break;
	case 3:
	$titol = TXT_PINDEXED;
	break;
	case 4:
	$titol = TXT_RANK;
	break;
	case 5:
	$titol = TXT_VALIDATION;
	break;
	case 6:
	$titol = TXT_BOOKMARKS;
	break;
	case 7:
	$titol = TXT_SINDICATE;
	break;
	case 8:
	$titol = TXT_DOMAIN;
	break;
	case 9:
	$titol = TXT_SCREENSHOT;
	break;
}


$codihtml .= '<tr><td align="center"><b>'.$titol.'</b></td><tr><td><table border="0" width="100%">';


if($key==9){

	$codihtml .= '<td align=center>'.$fila.'</td>';

}else if($key==1){

	foreach ($fila as $key2 =>  $fila2){
		$codihtml .= '<tr><td style="border-bottom:1px #D6D6D6 solid;"><b>'.$fila2['tag'].'</b><br />'.$fila2['info']."</td></tr>";
	}

}else{

	foreach ($fila as $key2 =>  $fila2){
		$codihtml .= '<tr><td style="border-bottom:1px #D6D6D6 solid;"><img src="http://www.viciao2k3.net/services/xinu/img/'.$fila2['img'].'" align="absmiddle"> '.$fila2['tag'].'</td><td align="right" style="border-bottom:1px #D6D6D6 solid;">'.$fila2['info']."</td></tr>";
	}

}

$codihtml .= '</table><br /></td></tr>';








}


$codihtml .= '</table></center>';

//echo $codihtml;


$htmltopdf = new HTML_TO_PDF();
$htmltopdf->downloadFile('informe_'.Date('d-m-Y').'.pdf');
$result = $htmltopdf->convertHTML(  $codihtml );
if($result==false)echo $htmltopdf->error();


/*echo '<pre>';
print_r( $_SESSION['infocols'] );
echo '</pre>';*/


?>