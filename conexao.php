<?php

	$mysqli = new mysqli("localhost", "root", "", "ri");

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$mysqli->query("set names 'utf8'");


	$sql = "(SELECT id, title, MATCH(title, text) AGAINST ('Carta-bomba para Kiesbauer') as score from trabalho " . 
			"UNION " .
			"SELECT id, title, MATCH(title, text) AGAINST ('Encontrar información sobre la explosión de una carta-bomba en el estudio de la presentadora del canal de televisión PRO7 Arabella Kiesbauer') as score from trabalho " .
			"ORDER by score desc ".
			") " .
			"GROUP by 1 ". 
			"LIMIT 100"; 

	$sql = "SELECT id, title, score FROM ( SELECT t.id, t.title, MATCH(t.title, t.text) AGAINST ('Carta-bomba para Kiesbauer') as score from trabalho t UNION SELECT ta.id, ta.title, MATCH(ta.title, ta.text) AGAINST ('Encontrar información sobre la explosión de una carta-bomba en el estudio de la presentadora del canal de televisión PRO7 Arabella Kiesbauer') as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";

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
?>