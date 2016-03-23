<?php
require_once 'stemmer/stemmer-es1.0/stemm_es.php';
include_once("connect.php");

error_reporting(E_ERROR);

$sql = "SELECT * FROM TRABALHO WHERE title_stemmer = '' ORDER by id desc  LIMIT 0, 1";

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

		print_r($res->TEXT);
		print_r("<br/>");
		print_r("<br/>");
		print_r($text_stemm);
		print_r("<br/>");
		print_r("<br/>");
	}
}
?>