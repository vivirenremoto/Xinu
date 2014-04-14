<?php

require_once '../funcions.php';

$rating = round(((15*10)/strlen($direccio_curta)),2);

$txt = '<a href="http://'.$direccio_curta.'" target="_blank">'.$direccio_curta.'</a><br />'.strlen($direccio_curta). ' '.TXT_DIAG_CHARS;
$txt2 .= $txt . ferMissatge($rating,TXT_DIAG_URL_KO,TXT_DIAG_URL_OK);
$txt .= ferMissatge($rating,TXT_DIAG_URL_KO,TXT_DIAG_URL_OK,1);

afegir_info(__FILE__,1,$txt,TXT_URL);
echo $txt2;

?>