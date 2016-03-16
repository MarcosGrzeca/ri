<?php
echo "Extraindo arquivos";

$needle = "<DOC>";
$needleFim = "</DOC>";


$arquivos = scandir("efe95/efe95");

foreach ($arquivos as $key => $arquivo) {
	if ($key > 4) {
		continue;
	}
	if ($arquivo != "." && $arquivo != "..") {
		$path = "efe95/efe95/" . $arquivo;
		$myfile = fopen($path, "r") or die("Unable to open file!");
		$html = fread($myfile,filesize($path));
		fclose($myfile);
		
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

		foreach ($inicios as $key => $pos) {
			if ($key > 0) {
				break;
			}
			printbr(substr($html, $inicios[$key], $fins[$key] - $inicios[$key] + strlen($needleFim)));
		}


		echo "<br/>Extraindo arquivo " . $arquivo . "<br/>";
		# code...

		
	}
}


function searchTag($tagName $texto) {
	
}
function printbr($texto) {
	print_r("<br/><br/>");
	print_r($texto);
	print_r("<br/><br/>");

}
?>