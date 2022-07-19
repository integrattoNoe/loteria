<?php
require "conexion.php";
if (isset($_POST["opcion"])) {

	$op = $_POST["opcion"];
	switch ($op) {
		case 'add':
			add_to_cart();
			break;
		case 'cart_bag':
			cart_data_ajax();
			break;
		case 'get_cart':
			get_cart();
			break;
		case 'remove_items':
			remove_items();
			break;
		case 'limpiar_carrito':
			limpiar_carrito();
			break;
		default:
			# code...
			break;
	}
} else {
	/*$respuesta["code"] = 400;
	$respuesta["msg"] = "No se recibió opción";
	responder($respuesta);*/
}

$cookieExp = time() + 3600 * 24 * 365;

function add_to_cart()
{
	global $cookieExp;
	$arrayIdsGames = array();
	if (isset($_POST["idTarjeta"], $_POST["cantidad"], $_POST["idGame"])) {
		if (isset($_COOKIE["lotto_cart"])) {
			/*ya hay un carrito, hay que hacer algo para actualizar productos, etc*/
			$carrito = json_decode($_COOKIE["lotto_cart"], true);
			$esNuevo = true;
			foreach ($carrito as $key => $value) {
				array_push($arrayIdsGames, intval($value["idGame"]));
				if ($_POST["idTarjeta"] == $value["p"]) {
					$esNuevo = false;
					$respuesta["code"] = 400;
					$respuesta["msg"] = "Ya agregaste este cartón a tu carrito";
				}
			}
			if ($esNuevo) {
				/*validar si no hay mas de 2 tarjetas de ese sorteo*/
				$resultados = array_count_values($arrayIdsGames);
				if (isset($resultados[$_POST["idGame"]])) {
					/*if($resultados[$_POST["idGame"]] >= 2){
						$respuesta["code"] = 400;
						$respuesta["msg"] = "No puedes agregar más de 2 cartones para un sorteo";
					}else{*/
					$temp = array("p" => $_POST["idTarjeta"], "qty" => $_POST["cantidad"], "idGame" => $_POST["idGame"]);
					array_push($carrito, $temp);
					setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
					$respuesta["cart"] = $carrito;
					$respuesta["cantidad"] = $_POST["cantidad"];
					$respuesta["code"] = 200;
					$respuesta["resultados"] = $resultados;
					//}
				} else {
					$temp = array("p" => $_POST["idTarjeta"], "qty" => $_POST["cantidad"], "idGame" => $_POST["idGame"]);
					array_push($carrito, $temp);
					setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
					$respuesta["cart"] = $carrito;
					$respuesta["cantidad"] = $_POST["cantidad"];
					$respuesta["code"] = 200;
					$respuesta["resultados"] = $resultados;
				}
			}
		} else {
			$carrito = array();
			$temp = array("p" => $_POST["idTarjeta"], "qty" => $_POST["cantidad"], "idGame" => $_POST["idGame"]);
			array_push($carrito, $temp);
			setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
			$respuesta["cart"] = $carrito;
			$respuesta["cantidad"] = $_POST["cantidad"];
			$respuesta["code"] = 200;
		}
	} else {
		$respuesta["code"] = 400;
		$respuesta["msg"] = "No se enviaron datos";
	}

	responder($respuesta);
}

function cart_data_ajax()
{
	$respuesta = array();
	$productos = array();
	$subtotal = 0.0;
	$cantidad = 0;
	$avyna_cart = isset($_COOKIE["lotto_cart"]);

	if ($avyna_cart) {
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		foreach ($carrito as $k => $v) {
			//$resp = findProd($v["p"],null);
			//if($resp){
			$cantidad += $v["qty"];

			/*$resp["total"] = $v["qty"] * $resp["precio"];
				$subtotal += floatval($v["qty"] * $resp["precio"]);
				array_push($productos, $resp);*/
			//}
		}
		$respuesta["code"] = 200;
		$respuesta["qty"] = $cantidad;
		//$respuesta["itemsCart"] = $productos;
		//$subtotal = floatval($subtotal/1.16);
		//$respuesta["subtotal"] = number_format($subtotal,2,'.',',');
	}/*else{
		$algun_carrito = false;
		//$respuesta["code"] = 400;
	}*/
	$productos = array();
	if ($avyna_cart) {
		$respuesta["code"] = 200;
		/*$sub = $avyna_cart ? $respuesta["subtotal"] : 0.0;
		$sub2 = $avyna_cart_oferta == true? floatval($respuesta["subtotal_oferta"]) : 0.0;
		$suma = $sub+$sub2;
		$respuesta["sub"] = $sub;
		$respuesta["sub2"] = $sub2;
		$respuesta["suma"] = $suma;
		$subtotal = floatval($suma/1.16);*/
		/*$subtotal = floatval($subtotal/1.16);
		$respuesta["subtotal"] = number_format($subtotal,2,'.',',');*/
	} else {
		$respuesta["code"] = 400;
		$respuesta["msg"] = "Tu carrito está vacio";
	}
	responder($respuesta);
}

function get_cart()
{
	$respuesta = array();
	$productos = array();
	$invalidos = array();
	$subtotal = 0.0;
	$cantidad = 0;
	$algunoInvalido = false;
	$arrayIdsGames = array();

	$avyna_cart = isset($_COOKIE["lotto_cart"]);
	if (isset($_COOKIE["lotto_lg"])) {
		$tmp = json_decode($_COOKIE["lotto_lg"], true);
		$email = $tmp["u"];
		$idCliente = $tmp["id"];
	} else
		$idCliente = null;


	if ($avyna_cart) {
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		foreach ($carrito as $key => $value) {
			array_push($arrayIdsGames, intval($value["idGame"]));
		}
		$resultados = array_count_values($arrayIdsGames);

		foreach ($carrito as $k => $v) {
			$resp = findCard($v["p"], null);
			if ($resp) {
				/*validar juego y tarjeta*/
				//print_r($resp);
				if ($resp["GameStatus"] == "Pendiente" || $resp["GameStatus"] == "Activo") {
					if ($resp["GameCardStatus"] == "Pendiente" || $resp["GameCardStatus"] == "Activo" || $resp["GameCardStatus"] == "Apartado" || $resp["idClient"] == $idCliente || $idCliente == null) {
						//if ($resultados[$v["idGame"]] <= 2) {
						$cantidad += $v["qty"];
						$resp["valido"] = true;
						$resp["total"] = $v["qty"] * $resp["Card_price"];
						$subtotal += floatval($v["qty"] * $resp["Card_price"]);
						array_push($productos, $resp);
						/*} else {
							$resp["valido"] = false;
							$algunoInvalido = true;
							$resp["Motivo"] = "No puedes tener más de 2 cartones de un mismo sorteo.";
							array_push($invalidos, $resp);
						}*/
					} else {
						$resp["valido"] = false;
						$algunoInvalido = true;
						$resp["Motivo"] = "Cartón inválido, no disponible.";
						array_push($invalidos, $resp);
					}
				} else {
					$resp["valido"] = false;
					$algunoInvalido = true;
					$resp["Motivo"] = "Juego innactivo";
					array_push($invalidos, $resp);
				}
			}
		}
		$respuesta["code"] = 200;
		$respuesta["qty"] = $cantidad;
		$respuesta["itemsCart"] = $productos;
		$respuesta["algunoInvalido"] = $algunoInvalido;
		$respuesta["invalidos"] = $invalidos;
		//$subtotal = floatval($subtotal/1.16);
		$respuesta["subtotal"] = number_format($subtotal, 2, '.', ',');
	}
	$productos = array();
	if ($avyna_cart) {
		$respuesta["code"] = 200;
	} else {
		$respuesta["code"] = 400;
		$respuesta["msg"] = "Tu carrito está vacío";
	}
	responder($respuesta);
}

function get_cart2()
{
	$respuesta = array();
	$productos = array();
	$invalidos = array();
	$subtotal = 0.0;
	$cantidad = 0;
	$algunoInvalido = false;
	$tmp = json_decode($_COOKIE["lotto_lg"], true);
	$email = $tmp["u"];
	$idCliente = $tmp["id"];

	$avyna_cart = isset($_COOKIE["lotto_cart"]);

	if ($avyna_cart) {
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		foreach ($carrito as $k => $v) {
			$resp = findCard($v["p"], null);
			if ($resp) {
				/*validar juego y tarjeta*/
				if ($resp["GameStatus"] == "Activo" || $resp["GameStatus"] == "Pendiente") {
					if ($resp["GameCardStatus"] == "Pendiente" || $resp["GameCardStatus"] == "Activo" || $resp["GameCardStatus"] == "Apartado" || $resp["idClient"] == $idCliente) {
						$cantidad += $v["qty"];
						$resp["valido"] = true;
						$resp["total"] = $v["qty"] * $resp["Card_price"];
						$subtotal += floatval($v["qty"] * $resp["Card_price"]);
						array_push($productos, $resp);
					} else {
						$resp["valido"] = false;
						$algunoInvalido = true;
						$resp["Motivo"] = "Cartón inválida, no disponible.";
						array_push($invalidos, $resp);
					}
				} else {
					$resp["valido"] = false;
					$algunoInvalido = true;
					$resp["Motivo"] = "Juego innactivo";
					array_push($invalidos, $resp);
				}
			}
		}
		$respuesta["code"] = 200;
		$respuesta["qty"] = $cantidad;
		$respuesta["itemsCart"] = $productos;
		$respuesta["algunoInvalido"] = $algunoInvalido;
		$respuesta["invalidos"] = $invalidos;
		//$subtotal = floatval($subtotal/1.16);
		//$respuesta["subtotal"] = number_format($subtotal, 2, '.', ',');
		$respuesta["subtotal"] = $subtotal;
	}
	$productos = array();
	if ($avyna_cart) {
		$respuesta["code"] = 200;
	} else
		$respuesta["code"] = 400;
	return ($respuesta);
}


function findCard($idP, $conn)
{
	$data = false;
	try {
		if ($conn == null)
			$conn = PDOConnection::getConnection();
		$sql = "SELECT GC.ID, GC.idGame, GC.Status as GameCardStatus, games.Card_price, games.Status as GameStatus, games.Game_name, GC.idClient, ";
		for ($i = 1; $i <= 16; $i++) {
			$sql .= "GROUP_CONCAT(DISTINCT CONCAT(i" . $i . ".Item,';',i" . $i . ".URL_image) ORDER BY i" . $i . ".ID ASC SEPARATOR '|') AS Item" . $i;
			if ($i < 16)
				$sql .= ", \n";
		}
		$sql .= "\nFROM Game_cards AS GC\n";
		for ($i = 1; $i <= 16; $i++) {
			$sql .= "INNER JOIN game_items AS i" . $i . " ON GC.Item" . $i . " = i" . $i . ".ID\n";
		}
		$sql .= "INNER JOIN games ON GC.idGame = games.ID\n";
		$sql .= "WHERE GC.ID = " . $idP . " GROUP BY GC.ID ORDER BY GC.ID LIMIT 1";
		$stm = $conn->prepare($sql);
		$stm->execute();
		$data = $stm->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		$data = false;
	}
	if ($conn != null)
		$conn = null;
	return $data;
}

function actualizarCarrito($tarjetas)
{
	global $cookieExp;
	if (isset($_COOKIE["lotto_cart"])) {
		echo "si";
	}
}

function remove_items()
{
	global $cookieExp;
	$avyna_cart = isset($_COOKIE["lotto_cart"]);
	if ($avyna_cart) {
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		$eliminar = $_POST["items"];
		foreach ($carrito as $key => $value) {
			foreach ($eliminar as $key2 => $value2) {
				if ($value2["id"] == $value["p"]) {
					unset($carrito[$key]);
				}
			}
		}
		if (count($carrito) > 0) {
			setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
			$respuesta["code"] = 200;
			//$respuesta["carrito_upd"] = $carrito;
		} else {
			setcookie("lotto_cart", "", $cookieExp * -1, "/");
			unset($_COOKIE["lotto_cart"]);
			$respuesta["code"] = 200;
			//$respuesta["carrito_upd"] = [];
		}
	} else {
		$respuesta["code"] = 200;
	}
	responder($respuesta);
}


function limpiar_carrito()
{
	global $cookieExp;
	if (isset($_COOKIE["lotto_cart"])) {
		setcookie("lotto_cart", "", $cookieExp * -1, "/");
		unset($_COOKIE["lotto_cart"]);
	}
	if (isset($_COOKIE["avyna_cart_oferta"])) {
		setcookie("avyna_cart_oferta", "", $cookieExp * -1, "/");
		unset($_COOKIE["avyna_cart_oferta"]);
	}
	if (isset($_COOKIE["oferta"])) {
		setcookie("oferta", "", $cookieExp * -1, "/");
		unset($_COOKIE["oferta"]);
	}
	if (isset($_COOKIE["idV"])) {
		setcookie("idV", "", $cookieExp * -1, "/");
		unset($_COOKIE["idV"]);
	}
	if (isset($_COOKIE["idVM"])) {
		setcookie("idVM", "", $cookieExp * -1, "/");
		unset($_COOKIE["idVM"]);
	}
	$respuesta["code"] = 200;
	responder($respuesta);
}
