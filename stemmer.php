<?php
require_once("stemmer/stemmer-es1.0/stemm_es.php");
include_once("connect.php");
require_once("utils.php");

error_reporting(E_ERROR);

$myFile = "teste.txt";
$fh = fopen($myFile, 'a') or die("can't open file");

$sql = "SELECT * FROM trabalho WHERE title_stemmer = '' AND text_stemmer = '' LIMIT 0,1000;";

if ($result = $mysqli->query($sql)) {
	$dados = array();
	while ($res = $result->fetch_object()) {
		$part1 = explode(' ', $res->TITLE);
		$part2 = explode(' ', $res->TEXT);

		$title_stemm = "";
		foreach ($part1 as $key => $value) {
			if ($title_stemm != "") {
				$title_stemm .= " ";
			}
			$title_stemm .= stemm_es::stemm($value);
		}

		$text_stemm = "";
		foreach ($part2 as $key => $value) {
			if ($text_stemm != "") {
				$text_stemm .= " ";
			}
			$text_stemm .= stemm_es::stemm($value);
		}

	$sql = "UPDATE `trabalho` SET title_stemmer = '" . converteEncodingTexto(trim($mysqli->real_escape_string($title_stemm))) . "', text_stemmer = '" . converteEncodingTexto(trim($mysqli->real_escape_string($text_stemm))) . "' WHERE id = ". $res->id . ";";
	$mysqli->query($sql);
	/*print_r($sql);
	print_r("<br/><br/>");
	fwrite($fh, $sql);*/
	}
}
fclose($fh);
?>