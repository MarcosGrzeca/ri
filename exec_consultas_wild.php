<?php
include_once("connect.php");
require_once("stemmer/stemmer-es1.0/stemm_es.php");
require_once("utils.php");

$textoResultado = "";
$sql = "SELECT * FROM consultas";
if ($result = $mysqli->query($sql)) {
	$numConsulta = 0;
	while ($res = $result->fetch_object()) {
			FB::info($res);
		$numCons = clearNumber($res->num);
		$sql = getSqlConsulta($res->title, $res->desc);
		FB::log($sql);
		$mysqliConsulta = new mysqli("localhost", "root", SENHA, BD);

		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		FB::log($sql);
		$mysqliConsulta->query("set names 'utf8'");
		if ($resultConsulta = $mysqliConsulta->query($sql)) {
			$dados = array();
			while ($res = $resultConsulta->fetch_object()) {
				if (count ($dados) > 99) {
					break;
				}
				if (!isset($dados[$res->nro])) {
					$dados[$res->nro] = $res->score;
				}
			}
			$ind = 0;
			foreach ($dados as $key => $value) {
				$textoResultado .= $numCons	. "\tQ0\t" . $key . "\t" . $ind  . "\t" . $value . "\t" . "LUCAS_MARCOS" . "\r\n";
				$ind++;
			}
		}
		$numConsulta++;
	}
}

FB::info($textoResultado);
$myFile = "resultado_wild.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $textoResultado);
fclose($fh);

print_r("Acesse o arquivo " . $myFile);

function getSqlConsulta($title, $text) {
	$title = aplicarStemmingWildCard($title, true);
	$text = aplicarStemmingWildCard($text, true);
	$mode = " IN NATURAL LANGUAGE MODE";
	return "SELECT id, nro, score FROM ( SELECT t.id, t.nro, MATCH(t.TITLE, t.TEXT) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($title) . "'" . $mode . ") as score from trabalho t UNION SELECT ta.id, ta.nro, MATCH(ta.TITLE, ta.TEXT) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($text) . "'" . $mode . ") as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";
}
/*
search_modifier: {
       IN NATURAL LANGUAGE MODE
     | IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION
     | IN BOOLEAN MODE
     | WITH QUERY EXPANSION
  }
 */
?>