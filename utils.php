<?php

function searchTag($tagName, $texto) {
    $posIni = strpos($texto, "<" . $tagName . ">");
    if ($posIni >= 0) {
        $posFim = strpos($texto, "</" . $tagName . ">");
        $posIni += strlen("<" . $tagName . ">");
        return trim(substr($texto, $posIni, $posFim - $posIni));
    } else {
        return null;
    }
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

function aplicarStemming($frase) {
    $part1 = explode(' ', $frase);
    $stemming = "";
    foreach ($part1 as $key => $value) {
        if ($stemming != "") {
            $stemming .= " ";
        }
        $stemming .= stemm_es::stemm($value);
    }
    return converteEncodingTexto($stemming);
}
?>