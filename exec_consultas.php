<?php
include_once("connect.php");
set_time_limit(0);

$textoResultado = "";
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
				//FB::info($numConsulta);	
				//$textoResultado .= $numConsulta	. " ppp Q0 ppp " . $key . " ppp " . $ind  . " ppp " . $value . " ppp " . "LUCAS_MARCOS";
				//$textoResultado .= "<br/>";
				$textoResultado .= $numConsulta	. "\tQ0\t" . $key . "\t" . $ind  . "\t" . $value . "\t" . "LUCAS_MARCOS" . "\r\n";
				$ind++;
			}
			//print_r($textoResultado);
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
	return "SELECT id, nro, score FROM ( SELECT t.id, t.nro, MATCH(t.title, t.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($title) . "') as score from trabalho t UNION SELECT ta.id, ta.nro, MATCH(ta.title, ta.text) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($text) . "') as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";
}
?>