<?php
require_once 'stemmer/stemmer-es1.0/stemm_es.php';
include_once("connect.php");
require_once("utils.php");

error_reporting(E_ERROR);

$sql = "SELECT * FROM trabalho WHERE title_stemmer = ''";

if ($result = $mysqli->query($sql)) {
	$dados = array();
	while ($res = $result->fetch_object()) {
		$part1 = split(' ', $res->TITLE);
		$part2 = split(' ', $res->TEXT);

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

		// print_r($res->TEXT);
		// print_r("<br/>");
		// print_r("<br/>");
		// print_r($text_stemm);
		// print_r("<br/>");
		// print_r("<br/>");


	$sql = "UPDATE `trabalho` SET title_stemmer = '" . converteEncodingTexto(trim($mysqli->real_escape_string($title_stemm))) . "', text_stemmer = '" . converteEncodingTexto(trim($mysqli->real_escape_string($text_stemm))) . "' WHERE id = ". $res->id;
	$mysqli->query($sql);
	}
}
?>