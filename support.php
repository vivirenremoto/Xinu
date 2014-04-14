<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Xinu - Support</title>
	<meta http-equiv="content-language" content="ES" />
	<meta name="robots" content="noindex/nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/simple.css" media="screen"/>
	<style type="text/css">a{text-decoration:underline;}</style>
	<script type="text/javascript">
		function altlinies(obj,min){
			var linies = obj.value.split(/\n/).length;
			var caracters = obj.value.length;
			var columnes = obj.cols;
			if(columnes<caracters)linies += (caracters/columnes)+1;
		
			if(min<linies)obj.rows=linies;
			else obj.rows=min;
		}
	</script>
</head>
<body>


<a href="http://www.viciao2k3.net/services/xinu/" title="Xinu"><img src="http://www.viciao2k3.net/services/xinu/img/xinu_log.gif" alt="xinu" /></a>



<?php


if(isset($_POST['message'])){


$de= "alert@xinu.es";
$para = "your@email.com";
$asunto= "translations,bugs,ideas";


$mensaje = $_POST['message'].'<br><br>Nombre: '.$_POST['name'].'<br><br>E-mail: '.$_POST['email'];



$cabecera = "From: Xinu support<" . $de . ">\n";
$cabecera .= "MIME-Version: 1.0\n";
$cabecera .= "Content-Type: text/html; charset=iso-8859-1\n";
$cabecera .= "Content-Transfer-Encoding: 8bit\n";

$cuerpo =$mensaje;
mail($para,stripslashes($asunto),stripslashes($cuerpo),$cabecera);





die('<h2>Thank you very much</h2>');



}else{




?>






<h3>Translations</h3>

Now, I cannot give you money or fame, but I can give you the thanks and include your name and your website in the credits page<br />

<a href="http://viciao2k3.net/services/xinu/downloads/UK.rar">Download English translation file</a>, when finish send it to <a href="mailto:gafeman@gmail.com?subject=translations">gafeman@gmail.com</a>


<br />
<h3>Bugs</h3>

Yes there are a lot of them, but I can't find it all
if you have found some , report it
<br />
<h3>Ideas</h3>

if you think that there is something it can improve (user interfice, more options, more professional SEO diagnosis, etc), i will hear you
<br />
<h3>Contact me</h3>
<form action="support.php" method="post">
<input name="name" size="50" /> Name<br />
<input name="email" size="50" /> E-mail<br />
<textarea cols=100 name="message" rows=10 onkeyup="altlinies(this,10);"></textarea><br />
<input type=submit>
</form>

<?php }?>

</body>
</html>