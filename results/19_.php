<?php

require_once '../funcions.php';



function open_external_url2($url, $method = 'curl')
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
//ini_set('user_agent', 'my_agent_signature');
		$file = fopen($url, 'r');
		if($file){
	       while(!feof($file)) {
	           $data = $data . @fgets($file, 4096);
	       }
	       fclose ($file);
		}
	}
	return $data;
}





$url = 'http://del.icio.us/url/2ac9d1d0b3c37e9902d3bb2d40e134e0';
$v = open_external_url2($url);

echo $url."<hr>";

echo $v;

preg_match('/this url has been saved by ([0-9\,]+) people/si', $v, $r);

$txt = '<a href="'.$url.'" target="_blank">'.(($r[1]) ? quitarPuntos($r[1]) : 0).'</a>';
afegir_info(__FILE__,6,$txt,'del.icio.us','delicious');
echo $txt;

?>