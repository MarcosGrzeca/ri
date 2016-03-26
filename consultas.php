<?php
include_once("connect.php");
include_once("utils.php");

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

function inserirRegistro($num, $title, $doc) {
	$sql = "INSERT INTO `consultas` (`num`, `title`, `desc`) VALUES (
						'" . $GLOBALS["mysqli"]->real_escape_string($num) . "', 
						'" . converteEncodingTexto(trim($GLOBALS["mysqli"]->real_escape_string($title))) . "', 
						'" . converteEncodingTexto(trim($GLOBALS["mysqli"]->real_escape_string($doc))) . "')";

	$GLOBALS["mysqli"]->query($sql);
}
?>