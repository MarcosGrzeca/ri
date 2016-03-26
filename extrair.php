<?php
echo "Extraindo arquivos";

header('Content-Type: text/html; charset=utf-8');
require_once('FirePHPCore/fb.php');
include_once("connect.php");
error_reporting(E_ERROR);
require_once 'stemmer/stemmer-es1.0/stemm_es.php';


FB::info("COMECEI");							

$needle = "<DOC>";
$needleFim = "</DOC>";

$arquivos = scandir("efe95/efe95");

set_time_limit(0);

foreach ($arquivos as $key => $arquivo) {
	/*print_r($arquivo);
	if ($arquivo != "efe19950219.sgml") {
		continue;
	}*/
	if ($arquivo != "." && $arquivo != "..") {
		echo "<br/>Extraindo arquivo " . $arquivo . "<br/>";
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

		foreach ($inicios as $key2 => $pos) {
			$documento = substr($html, $inicios[$key2], $fins[$key2] - $inicios[$key2] + strlen($needleFim));
			inserirDocumento($documento);
		}
	}
}

/*
$documento = '<DOC>
<DOCNO>EFE19950101-00001</DOCNO>
<DOCID>EFE19950101-00001</DOCID>
<DATE>19950101</DATE>
<TIME>01.02</TIME>
<SCATE>POX</SCATE>
<FICHEROS>95F.JPG</FICHEROS>
<DESTINO>MUN EXG ICX</DESTINO>
<CATEGORY>POLITICA</CATEGORY>
<CLAVE>DP7038</CLAVE>
<NUM>233</NUM>
<PRIORIDAD>U</PRIORIDAD>
<TITLE>   RUSIA-CHECHENIA
           TROPAS RUSAS DICEN HABER TOMADO CONTROL EDIFICIOS GROZNI
</TITLE>
<TEXT>    Moscú, 1 ene (EFE).-La capital de la separatista república de
 Chechenia, Grozni, entró en la vispera del Nuevo Año en un cruento
 ataque lanzado por las tropas rusas con artillería que dejo en llamas
 a numeroso edificios de la ciudad, entre ellos el Parlamento y el
 Palacio Presidencial.
    Según un comunicado difundido por la agencia Interfax, las fuerzas
 rusas han tomado la estación de ferrocarriles, así como varios
 edificios administrativos del centro de la ciudad, y prosiguen con su
 labor de desarmar a las "formaciones ilegales" chechenes, para
 restablecer el orden constitucional ebn la república, según el
 gobierno.
    El Gobierno ha señalado que las tropas rusas toman medidas para
 apagar el incendio que se provocó en la planta de petróleo situada en
 la capital con el riesgo de una catastrofe ecológica, después de ser
 alcanzada por varios proyectiles, y en donde se encuentra un deposito
 miles de toneladas de amoníaco, un producto químico altamente tóxico.
    La Nochevieja, sin embargo, ha sido tranquila, a pesar de los
 disparos de francotiradores de ambos bandos, y las dos partes
 comienzan a disminuir su actividad bélica.
    El presidente chechén, Yojar Dudáyev, según Interfaz, se encuentra
 en un refugio subterraneo presuntamente situado bajo el Palacio
 Presidemcial, desde donde se dirigió a sus seguidores para insistir
 en que " el puebo chechén ya ha ganado una gran victoria moral".EFE
    mrc/PL


 01/01/01-02/95



</TEXT>
</DOC>';


inserirDocumento($documento);
*/
function inserirDocumento($documento) {
	inserirRegistro(searchTag("DOCNO", $documento), 
					searchTag("DOCID", $documento), 
					searchTag("DATE", $documento), 
					searchTag("TIME", $documento), 
					searchTag("SCATE", $documento), 
					searchTag("FICHEROS", $documento), 
					searchTag("DESTINO", $documento), 
					searchTag("CATEGORY", $documento), 
					searchTag("CLAVE", $documento), 
					searchTag("NUM", $documento), 
					searchTag("PRIORIDAD", $documento), 
					searchTag("TITLE", $documento), 
					searchTag("TEXT", $documento));
}

function searchTag($tagName, $texto) {

	$posIni = strpos($texto, "<" . $tagName . ">");
	if ($posIni >= 0) {
		$posFim = strpos($texto, "</" . $tagName . ">");
		$posIni += strlen("<" . $tagName . ">");
		return substr($texto, $posIni, $posFim - $posIni);
	} else {
		return null;
	}

}

function inserirRegistro($docNro, $docId, $data, $tempo, $scate, $ficheiros, $destino, $categoria, $clave, $num, $prioridade, $title, $text) {
/*	$mysqli = new mysqli("localhost", "root", "", "ri3");

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$mysqli->query("set names 'utf8'");
*/
	$title = converteEncodingTexto(trim($title));
	$text = converteEncodingTexto(trim($text));
	
	$part1 = explode(' ', $title);
	$part2 = explode(' ', $text);

	$title_stemm = "";
	/*foreach ($part1 as $key => $value) {
		if ($title_stemm != "") {
			$title_stemm .= " ";
		}
		$title_stemm .= stemm_es::stemm($value);
	}
*/
	$text_stemm = "";
	/*foreach ($part2 as $key => $value) {
		if ($text_stemm != "") {
			$text_stemm .= " ";
		}
		$text_stemm .= stemm_es::stemm($value);
	}*/

	$sql = "INSERT INTO `trabalho` (`nro`, `ident`, `data`, `TIME`, `SCATE`, `FICHEROS`, `DESTINO`, `CATEGORY`, `CLAVE`, `NUM`, `PRIORIDAD`, `TITLE`, `TEXT`, `title_stemmer`, `text_stemmer`) VALUES ('" . $GLOBALS["mysqli"]->real_escape_string($docNro) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($docId) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($data) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($tempo) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($scate) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($ficheiros) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($destino) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($categoria) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($clave) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($num) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($prioridade) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($title) . "', 
						'" . $GLOBALS["mysqli"]->real_escape_string($text) . "',
						'" . converteEncodingTexto(trim($GLOBALS["mysqli"]->real_escape_string($title_stemm))) . "', 
						'" . converteEncodingTexto(trim($GLOBALS["mysqli"]->real_escape_string($text_stemm))) . "' 
						)";
						$GLOBALS["mysqli"]->query($sql);
}

function printbr($texto) {
	print_r("<br/><br/>");
	print_r($texto);
	print_r("<br/><br/>");

}

function converteEncodingTexto($value) {
	$encoding[0] = "UTF-8";
	$encoding[1] = "Windows-1252";
	$encoding[2] = "ISO-8859-1";
	$encoding[3] = "ISO-8859-15";
	$encoding[4] = "Windows-1251";
	
	$temp = array();
	if (mb_detect_encoding($value, $encoding) != "UTF-8") {
		$value = utf8_encode($value);
	}
	if (! check_utf8($value)) {
		$value = utf8_encode($value);
	}
	return $value;
}

function check_utf8($str) {
    $len = strlen($str);
    for($i = 0; $i < $len; $i++){
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c > 247)) return false;
            elseif ($c > 239) $bytes = 4;
            elseif ($c > 223) $bytes = 3;
            elseif ($c > 191) $bytes = 2;
            else return false;
            if (($i + $bytes) > $len) return false;
            while ($bytes > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) return false;
                $bytes--;
            }
        }
    }
    return true;
} // end of check_utf8

print_r("FIMMMMMMMMMMMMMMMM");
?>
