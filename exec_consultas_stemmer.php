<?php
include_once("connect.php");
require_once("stemmer/stemmer-es1.0/stemm_es.php");
require_once("utils.php");

/*FB::info(aplicarStemming("Por Jorge Ruíz Lardizábal     Varsovia, 1 ene (EFE).- Los polacos despidieron el Año Viejo como  millonarios, aunque pobres, pero por culpa de la operación e  introducción del Nuevo Zloty, igual a 10.000 de los antiguos,recibieron a 1995 ya sólo como pobres de solemnidad.   La medida, puramente técnica, busca la eliminación de 	lacontabilidad de las cifras astronómicas generadas por la terribleinflación de los primeros años del cambio económico, pero lossicólogos creen que, al ver adelgazar sus carteras, antes llenas debilletes, muchos se sentirán aún más pobre de lo que son.   Desde que terminó la segunda guerra mundial el zloty polacosiempre fue una moneda débil y hasta 1990 totalmente inservible fueradel país.   Hoy ya tiene plena convertibilidad interna y desde el 1 de enerotambién convertibilidad externa parcial, porque los polacos pueden ira sus bancos y pagar directamente en esa moneda compras hechas en elextranjero.   Los sociólogos piensan que el Nuevo Zloty hará sentirse muyorgullosos a muchos polacos, porque verán en él una moneda, por supoder adquisitivo, mucho más parecida al dólar que siempre gozó desingular estima en el país.   Hubo periodos en los el zloty perdía valor a diario y el dólarfuncionnaba como la primera moneda del país, porque todas lastransacciones importantes se hacían en la moneda norteamericana.   A partir de hoy el dólar costará a los polacos no 24.500 zlotys,como en 1994, sino apenas 2,50 zlotys lo que, según los sicólogos,aumentará la confianza en él.   El cambio de la moneda ha tenido varias consecuencias más, como esla transformación del monedero en el objeto más regalado por SanNicolás.   Las monedas pequeñas desaparecieron en Polonia hace siete años,por culpa de la inflación, y los monederos se covirtieron en objetostotalmente inútiles.   El Nuevo Zloty ha resucitado las monedas de metal y también lafracción del zloty, el grosz, que por culpa de la inflacióndesapareció ya a fines de los años setenta.   Según los sicólogos, la reaparición del grosz útil, de lacalderilla que servirá para comprar muchas cosas, será acogida por lapoblación como un abaratamiento de la vida.   Cuando el diario que costaba 6.000 zlotys, cuesta solo 60groszys, se impone la sensación, aunque falsa, de que es algo muchomás barato, dicen los especialistas.   Según ellos los polacos no solamente tendrán el problema detraducir los precios en zlotys antiguos a Nuevos Zlotys, sino quetambién tendrán que aprender a respetar el valor del dinero y nodejarse llevar por la idea de que la calderilla no vale nada.   Las monedas tendrán faciales de 1, 2, 5, 10, 20, y 50 groszys y de1, 2 y 5 zlotys. Las menores estarán confeccionadas de latón, lasintermedias de una aleación de cobre y niquel y las dos de más valorde bronce y una aleación de cobre y niquel.   Los faciales de los billetes serán de 10, 20, 50, 100 y 200 zlotysy estarán protegidos con todas las medidas de seguridad conocidaspara impedir su falsificación.   Jamás tuve una Noche Vieja tan horrenda, contó a EFE ElzbietaAdamczak, jefa de sección en el Banco Universal de Crédito y hay quecreerle, porque como otros cien mil empleados de la banca polacaestuvo trabajando hasta las 21.00 del 31 de diciembre preparando laoperación.   No menos horrible fue el San Silvestre de los comerciantes, porquela ley les obligó a comenzar el año con todas las mercancías dotadasde precios dobles, en zlotys antiguos y nuevos.   La ley prevé que los polacos convivirán dos años con la monedadoble, pero son muchos los que dicen que será poco tiempo parasuperar los viejos hábitos y recuerdan que muchos franceses, queconocieron una operación similar, aún diez años después de ella,seguían calculando los precios en francos viejos.EFE.   rlz/ha 01/01/08-21/95"));
die;*/

$textoResultado = "";
$sql = "SELECT * FROM consultas";
if ($result = $mysqli->query($sql)) {
	$numConsulta = 0;
	while ($res = $result->fetch_object()) {
		$sql = getSqlConsulta($res->title, $res->desc);
		$mysqliConsulta = new mysqli("localhost", "root", SENHA, BD);

		continue;
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
				$textoResultado .= $numConsulta	. "\tQ0\t" . $key . "\t" . $ind  . "\t" . $value . "\t" . "LUCAS_MARCOS" . "\r\n";
				$ind++;
			}
		}
		$numConsulta++;
	}
}

FB::info($textoResultado);
$myFile = "resultado_stemmer.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $textoResultado);
fclose($fh);

print_r("Acesse o arquivo " . $myFile);

function getSqlConsulta($title, $text) {
	$mode = " IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION";
	return "SELECT id, nro, score FROM ( SELECT t.id, t.nro, MATCH(t.title_stemmer, t.text_stemmer) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($title) . "'" . $mode . ") as score from trabalho t UNION SELECT ta.id, ta.nro, MATCH(ta.title_stemmer, ta.text_stemmer) AGAINST ('" . $GLOBALS["mysqli"]->real_escape_string($text) . "'" . $mode . ") as score from trabalho ta ORDER by 3 desc LIMIT 0, 200 ) as t";
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