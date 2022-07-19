<?php

require "conexion.php";
if (isset($_POST["opcion"])) {
	$op = $_POST["opcion"];
	switch ($op) {
		case "getCartas":
			getCartas();
			break;
		case "validar":
			validarTarjeta();
			break;
	}
}

function getCartas()
{
	$sql = "SELECT * FROM game_items WHERE Status = 'Activo' ORDER BY ID DESC";
	$conn = PDOConnection::getConnection();
	$response = exeQuery($sql, $conn, true);
	responder($response);
}

function validarTarjeta()
{
	$sql = "SELECT * FROM Game_cards WHERE idGame = :idGame AND CHECKSUM = :checksum";
	$conn = PDOConnection::getConnection();
	$stm = $conn->prepare($sql);
	$stm->bindParam(":idGame", $_POST["idG"]);
	$stm->bindParam(":checksum", $_POST["checksum"]);
	$stm->execute();
	$num = $stm->rowCount();
	if ($num > 0) {
		$response["code"] = 400;
		$response["msg"] = "Esta tarjeta ya existe, prueba cambiando algunas cartas";
		responder($response);
	} else {
		$arrayIdsGames = array();
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		//print_r($carrito);
		foreach ($carrito as $key => $value) {
			array_push($arrayIdsGames, intval($value["idGame"]));
		}
		$resultados = array_count_values($arrayIdsGames);
		//print_r($resultados);
		if (isset($resultados[$_POST["idG"]])) {
			/*if($resultados[$_POST["idG"]] >= 2){
				$response["code"] = 400;
				$response["msg"] = "No puedes agregar más de 2 tarjetas para un sorteo";
				responder($response);
			}else{*/
			guardarTarjeta();
			//}
		} else {
			guardarTarjeta();
		}
	}
}

function guardarTarjeta()
{
	try {
		$sql = "INSERT INTO Game_cards SET idGame = :idGame,Status = 'Apartado',idClient = 2,Item1 = :item1,Item2 = :item2,Item3 = :item3,Item4 = :item4,Item5 = :item5,Item6 = :item6,Item7 = :item7,Item8 = :item8,Item9 = :item9,Item10 = :item10,Item11 = :item11,Item12 = :item12,Item13 = :item13,Item14 = :item14,Item15 = :item15,Item16 = :item16,Checksum = :checksum, Created_by = 1,Created_at = :fecha";
		$d = time();
		$fecha = date("Y-m-d H:i:s", $d);
		$conn = PDOConnection::getConnection();
		$stm = $conn->prepare($sql);
		$stm->bindParam(":idGame", $_POST["idG"]);
		$stm->bindParam(":item1", $_POST["items"][0]);
		$stm->bindParam(":item2", $_POST["items"][1]);
		$stm->bindParam(":item3", $_POST["items"][2]);
		$stm->bindParam(":item4", $_POST["items"][3]);
		$stm->bindParam(":item5", $_POST["items"][4]);
		$stm->bindParam(":item6", $_POST["items"][5]);
		$stm->bindParam(":item7", $_POST["items"][6]);
		$stm->bindParam(":item8", $_POST["items"][7]);
		$stm->bindParam(":item9", $_POST["items"][8]);
		$stm->bindParam(":item10", $_POST["items"][9]);
		$stm->bindParam(":item11", $_POST["items"][10]);
		$stm->bindParam(":item12", $_POST["items"][11]);
		$stm->bindParam(":item13", $_POST["items"][12]);
		$stm->bindParam(":item14", $_POST["items"][13]);
		$stm->bindParam(":item15", $_POST["items"][14]);
		$stm->bindParam(":item16", $_POST["items"][15]);
		$stm->bindParam(":checksum", $_POST["checksum"]);
		$stm->bindParam(":fecha", $fecha);
		$result = $stm->execute();
		if ($result) {
			$lastID = $conn->lastInsertId();
			add_to_cart($lastID, 1, $_POST["idG"]);
		} else {
			$respuesta["code"] = 400;
			$respuesta["msg"] = "Error al guardar la tarjeta, intente más tarde";
			responder($respuesta);
		}
	} catch (Exception $e) {
		$respuesta["code"] = 500;
		$respuesta["msg"] = $e->getMessage();
		responder($respuesta);
	}
}
$cookieExp = time() + 3600 * 24 * 365;
function add_to_cart($idTarjeta, $cantidad, $idGame)
{
	global $cookieExp;
	$arrayIdsGames = array();
	if (isset($_COOKIE["lotto_cart"])) {
		/*ya hay un carrito, hay que hacer algo para actualizar productos, etc*/
		$carrito = json_decode($_COOKIE["lotto_cart"], true);
		$esNuevo = true;
		foreach ($carrito as $key => $value) {
			array_push($arrayIdsGames, intval($value["idGame"]));
			if ($idTarjeta == $value["p"]) {
				$esNuevo = false;

				$respuesta["code"] = 400;
				$respuesta["msg"] = "Ya agregaste esta tarjeta a tu carrito";
			}
		}
		if ($esNuevo) {
			/*validar si no hay mas de 2 tarjetas de ese sorteo*/
			$resultados = array_count_values($arrayIdsGames);
			if (isset($resultados[$idGame])) {
				/*if($resultados[$idGame] >= 2){
					$respuesta["code"] = 400;
					$respuesta["msg"] = "No puedes agregar más de 2 tarjetas para un sorteo";
				}else{*/
				$temp = array("p" => $idTarjeta, "qty" => $cantidad, "idGame" => $idGame);
				array_push($carrito, $temp);
				setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
				$respuesta["cart"] = $carrito;
				$respuesta["cantidad"] = $cantidad;
				$respuesta["code"] = 200;
				//}
			} else {
				$temp = array("p" => $idTarjeta, "qty" => $cantidad, "idGame" => $idGame);
				array_push($carrito, $temp);
				setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
				$respuesta["cart"] = $carrito;
				$respuesta["cantidad"] = $cantidad;
				$respuesta["code"] = 200;
			}
		}
	} else {
		$carrito = array();
		$temp = array("p" => $idTarjeta, "qty" => $cantidad, "idGame" => $idGame);
		array_push($carrito, $temp);
		setcookie("lotto_cart", json_encode($carrito), $cookieExp, "/");
		$respuesta["cart"] = $carrito;
		$respuesta["cantidad"] = $_POST["cantidad"];
		$respuesta["code"] = 200;
	}



	responder($respuesta);
}
