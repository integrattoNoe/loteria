<?php

require "conexion.php";

getSorteos();

function getSorteos(){
	$sql = "SELECT * FROM games WHERE Status = 'Activo' OR Status = 'Pendiente'";
	$conn = PDOConnection::getConnection();
	$response = exeQuery($sql,$conn,true);
	if($response["code"] == 200){
		for($i = 0; $i < count($response["data"]); $i++){
			$sql = "SELECT COUNT(ID) AS Total FROM Game_cards WHERE idGame = ".$response['data'][$i]['ID']." AND idClient > 0";
			$tmp = exeQuery($sql,$conn,true);
			if($tmp["code"] == 200)
				$response["data"][$i]["Contador"] = $tmp["data"][0]["Total"];
		}
	}
	responder($response);
}



?>