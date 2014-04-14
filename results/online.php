<?php

		$fp = @fopen('http://'.$_GET['url'], 'r');
		if ($fp){











$t_cookie = explode('|',$_COOKIE['dragable_rss_boxes']);
$t_columnes = explode(';',$t_cookie[4]);


for($i=0;$i<count($t_columnes);$i++){



$t_files = explode(',',$t_columnes[$i]);



for($j=0;$j<count($t_files);$j++){




	$t_info = explode('-',$t_files[$j]);
	if($t_info[1]){

$taula_final[]=$t_info[0];


}

}


}





if($taula_final){
	session_start();
	$_SESSION['infocols'] = array();
	foreach ($taula_final as $fila){
		$_SESSION['infocols'][$fila] = array();
	
	}
}




























echo 1;
}

?>