<?php
include_once("connect.php");

$myfile = fopen("Topicos.txt", "r") or die("Unable to open file!");
$html = fread($myfile,filesize("Topicos.txt"));
fclose($myfile);

$needle = "<top>";
$needleFim = "</top>";


$lastPos = 0;
$inicios = array();
$fins = array();
while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
    $inicios[] = $lastPos;
    $lastPos = $lastPos + strlen($needle);
}

$lastPos = 0;
while (($lastPos = strpos($html, $needleFim, $lastPos))!== false) {
    $fins[] = $lastPos;
    $lastPos = $lastPos + strlen($needleFim);
}

foreach ($inicios as $key2 => $pos) {
	$documento = substr($html, $inicios[$key2], $fins[$key2] - $inicios[$key2] + strlen($needleFim));
	inserirConsulta($documento);
	var_dump($documento);
	print_r("<br/>");

}	

function inserirConsulta($documento) {
	inserirRegistro(searchTag("num", $documento), 
					searchTag("ES-title", $documento), 
					searchTag("ES-desc", $documento));
}

function searchTag($tagName, $texto) {
	$posIni = strpos($texto, "<" . $tagName . ">");
	if ($posIni >= 0) {
		$posFim = strpos($texto, "</" . $tagName . ">");
		$posIni += strlen("<" . $tagName . ">");
		return trim(substr($texto, $posIni, $posFim - $posIni));
	} else {
		return null;
	}
}

function inserirRegistro($num, $title, $doc) {
	$sql = "INSERT INTO `consultas` (`num`, `title`, `desc`) VALUES (
						'" . $GLOBALS["mysqli"]->real_escape_string($num) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($title) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($doc) . "')";

	$GLOBALS["mysqli"]->query($sql);
}

?>