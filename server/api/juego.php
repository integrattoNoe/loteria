<?php
require "conexion.php";
if(isset($_POST["opcion"])){
	$op = $_POST["opcion"];
	switch ($op) {
		case 'cantadas':
			getCantadas();
			break;
		case "gameInfo":
			getGameInfo();
			break;
		case "validarFrijoles":
			validarFrijoles();
			break;
		default:
			# code...
			break;
	}
}else{
	/*$respuesta["code"] = 400;
	$respuesta["msg"] = "No se recibió opción";
	responder($respuesta);*/
}


function getCantadas(){
	try {
		$conn = PDOConnection::getConnection();
		$idGame = $_POST["idGame"];
		$sql = "SELECT game_items.* FROM game_items INNER JOIN game_given_cards ON game_given_cards.idGame_item = game_items.ID WHERE game_given_cards.idGame = ".$idGame." ORDER BY game_given_cards.Given_date DESC";
		$stm = $conn->prepare($sql);
		$stm->execute();
		$num = $stm->rowCount();
		if($num > 0){
		  $response["tarjetas"] = $stm->fetchAll();
		  $response["code"] = 200;  
		}else{
		  $response["code"] = 400;
		  $response["msg"] = "No hay cartas cantadas";
		}
	} catch (Exception $e) {
		$response["code"] = 500;
		$response["msg"] = $e->getMessage();
	}
	$conn = null;
	responder($response);
}

function getGameInfo(){
	try {
		$sql = "SELECT * FROM games WHERE ID = :idGame AND Status = 'Activo'";
		$conn = PDOConnection::getConnection();
		$stm = $conn->prepare($sql);
		$stm->bindParam(":idGame",$_POST["idGame"]);
		$stm->execute();
		$num = $stm->rowCount();
		if($num > 0){
		    $response["code"] = 200;
		    $response["data"] = $stm->fetch(PDO::FETCH_ASSOC);
		}else{
		  	$response["code"] = 400;
		  	$response["msg"] = "Problema al obtener la información del juego";
		}
	} catch (Exception $e) {
		$response["code"] = 500;
		$response["msg"] = $e->getMessage();
	}
	responder($response);
}


function validarFrijoles(){
	$Rtarjetas = getMisTarjetas($_POST["idGame"]);
	$Rcantadas = getCantadas2($_POST["idGame"]);
	$arrayCartas = array();
	$data = array();
	$contadorFrijoles = 0;
	if($Rtarjetas["code"] == 200 && $Rcantadas["code"] == 200){
		$respuesta["code"] = 200;
		$tarjetas = $Rtarjetas["tarjetas"];
		$cantadas = $Rcantadas["cartas"];
		foreach ($tarjetas as $id => $tarjeta) {
			$contadorFrijoles = 0;
			$arrayCartas = array();
			for($i = 1; $i<=16; $i++){
				array_push($arrayCartas, $tarjeta["Item".$i]);
			}
			//echo "TARJETA: ".$tarjeta["ID"]."\n\n";
			$respuesta["idTarjeta"] = $tarjeta["ID"];
			//var_dump($arrayCartas);
			//echo "\n\n";
			foreach ($cantadas as $idCantada => $cantada) {
				if(in_array($cantada["ID"], $arrayCartas))
					$contadorFrijoles++;
			}
			//echo "CONTADOR FRIJOLES: ".$contadorFrijoles."\n\n";
			//echo "\n\n\n\n";
			$resp = array("idTarjeta"=>$tarjeta["ID"],"contadorFrijoles"=>$contadorFrijoles);
			array_push($data, $resp);
			
		}
		$respuesta["data"] = $data;
	}else{
		$respuesta["code"] = 400;
		$respuesta["msg"] = "";
	}
	responder($respuesta);
}


function getMisTarjetas($idJuego){
	try {
	  $tmp = json_decode( $_COOKIE["lotto_lg"], true );
	  $email = $tmp["u"];
	  $idCliente = $tmp["id"];
	  $idGame = $idJuego;
	  $conn = PDOConnection::getConnection();
	  $sql = "SELECT GC.ID, GC.idGame, GC.Status as GameCardStatus, games.Card_price, games.Status as GameStatus, games.Game_name, GC.idClient, ";
	  for($i = 1; $i <= 16; $i++){
	    $sql .= "Item".$i;
	    if($i < 16)
	      $sql .= ", \n";
	  }
	  $sql .= "\nFROM Game_cards AS GC\n";
	  for($i = 1; $i <= 16; $i++){
	    $sql .= "INNER JOIN game_items AS i".$i." ON GC.Item".$i." = i".$i.".ID\n";
	  }
	  $sql .= "INNER JOIN games ON GC.idGame = games.ID\n";
	  $sql .= "WHERE GC.idClient = ".$idCliente." AND games.ID = ".$idGame." GROUP BY GC.ID ORDER BY GC.ID";
	  $stm = $conn->prepare($sql);
	  $stm->execute();
	  $num = $stm->rowCount();
	  if($num > 0){
	    $response["tarjetas"] = $stm->fetchAll();
	    $response["code"] = 200;  
	  }else{
	    $response["code"] = 400;
	    $response["msg"] = "No tienes tarjetas :(";
	  }
	  
	} catch (Exception $e) {
	  $response["code"] = 500;
	  $response["msg"] = $e->getMessage();
	}
	$conn = null;
	return $response;
}

function getCantadas2($idJuego){
	try {
		$conn = PDOConnection::getConnection();
		$idGame = $idJuego;
		$sql = "SELECT game_items.* FROM game_items INNER JOIN game_given_cards ON game_given_cards.idGame_item = game_items.ID WHERE game_given_cards.idGame = ".$idGame." ORDER BY game_given_cards.Given_date DESC";
		$stm = $conn->prepare($sql);
		$stm->execute();
		$num = $stm->rowCount();
		if($num > 0){
		  $response["cartas"] = $stm->fetchAll();
		  $response["code"] = 200;  
		}else{
		  $response["code"] = 400;
		  $response["msg"] = "No hay cartas cantadas";
		}
	} catch (Exception $e) {
		$response["code"] = 500;
		$response["msg"] = $e->getMessage();
	}
	$conn = null;
	return $response;
}

?>