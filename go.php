<?php
/*
	Авторское право 
	URL: https://itsale.kz
	E-mail: alim.itsale@gmail.com
	Разработка: Шолоханов Алимжан 

    Защита от прямых ссылок.
*/
$ref=getenv('HTTP_REFERER');
$our=(!$ref or stripos($ref,getenv('HTTP_HOST'))!==false and stripos($ref,getenv('HTTP_HOST'))<14);
header('HTTP/1.1 301 Moved Permanently');
if($our and isset($_GET['int']) and strpos($_SERVER['QUERY_STRING'],'://')===false)
{
	$url=substr($_GET['int'],0,2000);
	$nurl='';
	$u_cnt=strlen($url);
	for($i=0;$i<$u_cnt;$i=$i+2)
		$nurl.=chr(hexdec(substr($url,$i,2)));
	header('Location: '.$nurl);
}
elseif($our and isset($_GET['gourl']))
{
	$url=urldecode($_GET['gourl']);

	if(filter_var($url,FILTER_VALIDATE_URL))
		header('Location: '.$url);
	else
		header('Location: index.php');
}
elseif($our and $_SERVER['QUERY_STRING'] and filter_var($_SERVER['QUERY_STRING'],FILTER_VALIDATE_URL))
	header('Location: '.$_SERVER['QUERY_STRING']);
else
	header('Location: index.php');
  ?>
