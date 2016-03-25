<?php
include_once("connect.php");
set_time_limit(0);

$textoResultado = "";
print_r("EUEE");
$sql = "SELECT * FROM consultas LIMIT 0, 3";
if ($result = $mysqli->query($sql)) {
	$numConsulta = 0;
	while ($res = $result->fetch_object()) {
		$sql = getSqlConsulta($res->title, $res->desc);

		$mysqliConsulta = new mysqli("localhost", "root", "", "ri");

		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		print_r($sql);
		print_r("<br/>");
		print_r("<br/>");
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
				$textoResultado .= $numConsulta	. " ppp Q0 ppp " . $key . " ppp " . $ind  . " ppp " . $value . " ppp " . "LUCAS_MARCOS";
				$textoResultado .= "<br/>";
				$ind++;
			}
			print_r($textoResultado);
		}
		$numConsulta++;
	}
}

function getSqlConsulta($title, $text) {
	return "SELECT id, nro, score FROM ( SELECT t.id, t.nro, MATCH(t.title, t.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($title) . "') as score from trabalho t UNION SELECT ta.id, ta.nro, MATCH(ta.title, ta.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($text) . "') as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";
}

/*$sql = "SELECT id, title, score FROM ( SELECT t.id, t.title, MATCH(t.title, t.text) AGAINST ('Carta-bomba para Kiesbauer') as score from trabalho t UNION SELECT ta.id, ta.title, MATCH(ta.title, ta.text) AGAINST ('Encontrar información sobre la explosión de una carta-bomba en el estudio de la presentadora del canal de televisión PRO7 Arabella Kiesbauer') as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";

			print_r($sql);
		if ($result = $mysqli->query($sql)) {
			$dados = array();
			while ($res = $result->fetch_object()) {
					if (count ($dados) > 99) {
						break;
					}
					if (in_array($res->id, $dados)) {
					} else {
						$dados[] = $res->id;
					}
			}
		}
		var_dump($dados);
*/
?>