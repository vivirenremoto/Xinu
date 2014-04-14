<?php

function ferMissatge($rating,$nota1,$nota2='',$op=''){

$rating=round($rating,2);
if($rating>10)$rating=10;
else if($rating<0)$rating=0;

if($rating<5)$img='ko';
else $img='ok';


$msg = '<br />';

if(empty($op))$msg .= '<span class="'.$img.'"> '.$rating.'</span> ';
else $msg .= '<img src="http://www.viciao2k3.net/services/xinu/img/'.$img.'.gif" align="absmiddle"> <b>'.$rating.'</b> ';



if($rating<10)$msg.=$nota1;
else $msg.=$nota2;

return $msg;
}

function format_number ($number='', $divchar = '.', $divat = 3) {
			$decimals = '';
			$formatted = '';
			if (strstr($number, '.')) {
				$pieces = explode('.', $number);
				$number = $pieces[0];
				$decimals = '.' . $pieces[1];
			} else {
				$number = (string) $number;
			}
			if (strlen($number) <= $divat)
				return $number;
				$j = 0;
			for ($i = strlen($number) - 1; $i >= 0; $i--) {
				if ($j == $divat) {
					$formatted = $divchar . $formatted;
					$j = 0;
				}
				$formatted = $number[$i] . $formatted;
				$j++;
			}
			return $formatted . $decimals;
		}

function open_external_url($url, $method = 'curl')
{
	$data = '';
	if(strtolower($method) == 'curl')
	{
		$ch = curl_init($url);
		ob_start();
		curl_exec($ch);
		curl_close($ch);
		$data = ob_get_contents();
		ob_end_clean();
	}
	else if(strtolower($method) == 'fopen')
	{

//digg patch
ini_set('user_agent', 'my_agent_signature');
		$file = @fopen($url, 'r');
		if($file){
	       while(!feof($file)) {
	           $data = $data . @fgets($file, 4096);
	       }
	       fclose ($file);
		}
	}







if(eregi('301 Moved Permanently',$data)){




preg_match("/HREF=\"(.*)\"/si", $data, $r);



return open_external_url($r[1], $method);




}else return $data;




}

function quitarPuntos($str){
return format_number (eregi_replace('\.|\,','',$str));
}

function nparaules($t){
$contador=0;

for($i=0;$i<count($t);$i++){

if(strlen($t[$i])>=3)$contador++;

}
return $contador;
}


function ByteSize($file_size) {
    if ($file_size >= 1099511627776) $show_filesize = number_format(($file_size / 1099511627776),2) . " TB";
    elseif ($file_size >= 1073741824) $show_filesize = number_format(($file_size / 1073741824),2) . " GB";
    elseif ($file_size >= 1048576) $show_filesize = number_format(($file_size / 1048576),2) . " MB";
    elseif ($file_size >= 1024)  $show_filesize = number_format(($file_size / 1024),2) . " KB";
    elseif ($file_size > 0) $show_filesize = $file_size . " bytes";
    elseif ($file_size == 0) $show_filesize = "0 bytes";
    return $show_filesize;
}


function urlRSS($url){



$v = open_external_url($url);


$v = ereg_replace("(\r\n|\r)", "\n", $v);


if(eregi('application\/rss\+xml',$v)){

	$i=0;
	$TROBAT=FALSE;
	$t=explode("\n",$v);
	
	while(!$TROBAT && $i<count($t)){
	
	$TROBAT = eregi('application\/rss\+xml',$t[$i]);
	
	if(!$TROBAT)$i++;

}


preg_match("/href=\"(.*)\" /si", $t[$i], $r);



if(!eregi('^http:\/\/',$r[1]))$r[1]=basename($_GET['url'])."/".$r[1];

return $r[1];

}else return '';


}







preg_match("/^(http:\/\/)?([^\/]+)/i",$_GET['url'], $matches);
$host = eregi_replace('www\.','',$matches[2]);


$direccio=eregi_replace('http\:\/\/','',$_GET['url']);
$direccio_completa = 'http://'.$direccio;
$direccio_curta  = eregi_replace('www\.','',$direccio);
$site = urlencode($_GET['url']);

/*
// get last two segments of host name
preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);

$_GET['url']=$matches[0];
*/





if(!empty($_GET['lang'])){
	$dir = '../lang/'.strtoupper($_GET['lang']).'.php';
	$lang = (!file_exists($dir)) ? 'ES' : strtoupper($_GET['lang']);
}else $lang='ES';

$dir = '../lang/'.$lang.'.php';
require_once($dir);




function afegir_info($f,$nt,$txt,$tag,$img=''){
	session_start();
	$nominfo = eregi_replace('\.php','',basename($f));
	if(empty($img))$_SESSION['infocols'][$nt][$nominfo] = array('tag'=>$tag,'info'=>$txt);
	else $_SESSION['infocols'][$nt][$nominfo] = array('tag'=>$tag,'info'=>$txt,'img'=>$img.'.gif');
}


function afegir_foto($img){
	session_start();
	$_SESSION['infocols'][9] = $img;
	echo $txt;
}
?>