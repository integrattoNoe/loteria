<?php
$cookieExp = time() + 3600 * 24 * 365;
//$loginExp = time() + 3600;

require "conexion.php";

if (isset($_POST["opcion"])) {
	switch ($_POST["opcion"]) {
		case "guardarDatos":
			guardar_datos_envio();
			break;
		case "guardar_pago":
			guardar_pago();
			break;
	}
}


function guardar_datos_envio()
{
	global $cookieExp;
	global $loginExp;
	try {
		$conn = PDOConnection::getConnection();
		$sql = "UPDATE clients SET First_name = :nombre, Last_name = :apellidos, Phone = :telefono, Address1 = :adress1, Address2 = :adress2, Zip_code = :cp, Location = '', City = :ciudad, State = :estado, Country = :pais, Updated_at = :fecha
				WHERE ID = :id";
		$d = time();
		$fecha = date("Y-m-d H:i:s", $d);
		$stm = $conn->prepare($sql);
		$stm->bindParam(":nombre", $_POST["nombre"]);
		$stm->bindParam(":apellidos", $_POST["apellido"]);
		$stm->bindParam(":adress1", $_POST["direccion1"]);
		$stm->bindParam(":adress2", $_POST["direccion2"]);
		$stm->bindParam(":ciudad", $_POST["ciudad"]);
		$stm->bindParam(":pais", $_POST["pais"]);
		$stm->bindParam(":estado", $_POST["estado"]);
		$stm->bindParam(":cp", $_POST["cp"]);
		$stm->bindParam(":telefono", $_POST["telefono"]);
		$stm->bindParam(":fecha", $fecha);
		$tmp = json_decode($_COOKIE["lotto_lg"], true);
		$email = $tmp["u"];
		$id = $tmp["id"];
		$stm->bindParam(":id", $id);
		$respuesta["sql"] = $stm;
		$result = false;
		$result = $stm->execute();
		if ($result)
			$respuesta["code"] = 200;
		else {
			$respuesta["code"] = 400;
			$respuesta["msg"] = "Error al guardar los datos";
		}
		$respuesta["productos"] = validarTarjetas($id);
	} catch (Exception $e) {
		$respuesta["code"] = 500;
		$respuesta["msg"] = $e->getMessage();
	}

	responder($respuesta);
}

function validarTarjetas($idCliente)
{
	$avyna_cart = isset($_COOKIE["lotto_cart"]);
	$respuesta = array();
	$productos = array();
	$invalidos = array();
	$subtotal = 0.0;
	$cantidad = 0;
	$algunoInvalido = false;
	$arrayIdsGames = array();
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
				if ($resp["GameStatus"] == "Activo" || $resp["GameStatus"] == "Pendiente") {
					if ($resp["GameCardStatus"] == "Pendiente" || $resp["GameCardStatus"] == "Activo" || $resp["GameCardStatus"] == "Apartado" || $resp["idClient"] == $idCliente) {
						//if($resultados[$v["idGame"]] <= 2){
						$cantidad += $v["qty"];
						$resp["valido"] = true;
						$resp["total"] = $v["qty"] * $resp["Card_price"];
						$subtotal += floatval($v["qty"] * $resp["Card_price"]);
						array_push($productos, $resp);
						/*}else{
							$resp["valido"] = false;
							$algunoInvalido = true;
							$resp["Motivo"] = "No puedes tener más de 2 tarjetas de un mismo sorteo.";
							array_push($invalidos, $resp);
						}*/
					} else {

						$resp["valido"] = false;
						$algunoInvalido = true;
						$resp["Motivo"] = "Tarjeta inválida, no disponible.";
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

		$respuesta["qty"] = $cantidad;
		$respuesta["itemsCart"] = $productos;
		$respuesta["algunoInvalido"] = $algunoInvalido;
		$respuesta["invalidos"] = $invalidos;
		//$subtotal = floatval($subtotal/1.16);
		$respuesta["subtotal"] = number_format($subtotal, 2, '.', ',');

		if ($algunoInvalido) {
			$respuesta["code"] = 400;
		} else {
			//$respuesta["code"] = 200;
			/*update de tarjeytas a apartadas*/
			try {
				$sql = "UPDATE Game_cards SET Status = 'Apartado',idClient = :idCliente WHERE ID = :id";
				$todoOk = true;
				$conn = PDOConnection::getConnection();
				foreach ($productos as $key => $value) {
					$stm1 = $conn->prepare($sql);
					$stm1->bindParam(":id", $value["ID"]);
					$stm1->bindParam(":idCliente", $idCliente);
					$result3 = $stm1->execute();
					if (!$result3)
						$todoOk = false;
				}
				if (!$todoOk) {
					$respuesta["code"] = 400;
					$respuesta["msg"] = "Error al actualizar status de las tarjetas";
				} else {
					$respuesta["code"] = 200;
				}
			} catch (Exception $e) {
				$respuesta["code"] = 500;
				$respuesta["msg"] = $e->getMessage();
			}
		}
	}
	$conn = null;
	return $respuesta;
}

function guardar_pago()
{
	$tmp = json_decode($_COOKIE["lotto_lg"], true);
	$email = $tmp["u"];
	$idCliente = $tmp["id"];

	$tarjetas = validarTarjetas($idCliente);
	if ($tarjetas["algunoInvalido"] == false) {
		//
		if ($_POST["Status"] == "COMPLETED") {
			try {
				$d = time();
				$fecha = date("Y-m-d H:i:s", $d);
				$conn = PDOConnection::getConnection();
				$sql = "INSERT INTO payments SET idClient = :idCliente, Pay_date = :fecha, Pay_amount = :total, Order_num = :orden, Pay_num = :numeroPago, Gateway = :gateway, Status = :status";
				$stm = $conn->prepare($sql);
				$stm->bindParam(":idCliente", $idCliente);
				$stm->bindParam(":fecha", $fecha);
				$stm->bindParam(":total", $tarjetas["subtotal"]);
				$stm->bindParam(":orden", $_POST["Order_num"]);
				$stm->bindParam(":numeroPago", $_POST["Pay_num"]);
				$stm->bindParam(":gateway", $_POST["Gateway"]);
				$stm->bindParam(":status", $_POST["Status"]);
				$result3 = $stm->execute();
				if ($result3) {
					$idPago = $conn->lastInsertId();
					$sql = "UPDATE Game_cards SET Status = 'Vendido', idClient = :idCliente, Sale_date = :fecha, idPayment = :idPago WHERE ID = :id";
					$productos = $tarjetas["itemsCart"];
					$todoOk = true;
					foreach ($productos as $key => $value) {
						$stm1 = $conn->prepare($sql);
						$stm1->bindParam(":id", $value["ID"]);
						$stm1->bindParam(":idCliente", $idCliente);
						$stm1->bindParam(":fecha", $fecha);
						$stm1->bindParam(":idPago", $idPago);

						$result3 = $stm1->execute();
						if (!$result3)
							$todoOk = false;
					}
					if (!$todoOk) {
						$respuesta["code"] = 400;
						$respuesta["msg"] = "Error al actualizar status de las tarjetas";
					} else {
						$respuesta["code"] = 200;
					}
				}
			} catch (Exception $e) {
				$respuesta["code"] = 500;
				$respuesta["msg"] = $e->getMessage();
			}
		}
	} else {
	}

	$conn = null;
	responder($respuesta);
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
