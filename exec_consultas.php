<?php
include_once("connect.php");
include_once("utils.php");

$textoResultado = "";
$sql = "SELECT * FROM consultas";
if ($result = $mysqli->query($sql)) {
	$numConsulta = 0;
	while ($res = $result->fetch_object()) {
		$numCons = clearNumber($res->num);
		$sql = getSqlConsulta($res->title, $res->desc);
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
				//$textoResultado .= $numConsulta	. " ppp Q0 ppp " . $key . " ppp " . $ind  . " ppp " . $value . " ppp " . "LUCAS_MARCOS";
				//$textoResultado .= "<br/>";
				$textoResultado .= $numCons . "\tQ0\t" . $key . "\t" . $ind  . "\t" . $value . "\t" . "LUCAS_MARCOS" . "\n";
				$ind++;
			}
		}
		$numConsulta++;
	}
}

FB::info($textoResultado);
$myFile = "resultado.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $textoResultado);
fclose($fh);

print_r("Acesse o arquivo " . $myFile);

function getSqlConsulta($title, $text) {
	$mode = " WITH QUERY EXPANSION";
	return "SELECT id, nro, score FROM ( SELECT t.id, t.nro, MATCH(t.title, t.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($title) . "'" . $mode . ") as score from trabalho t UNION SELECT ta.id, ta.nro, MATCH(ta.title, ta.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($text) . "'" . $mode . ") as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";
}
/*
search_modifier:
  {
       IN NATURAL LANGUAGE MODE
     | IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION
     | IN BOOLEAN MODE
     | WITH QUERY EXPANSION
  }
 */
?>