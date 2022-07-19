<?php

require "conexion.php";

if (isset($_POST["opcion"])) {
	$op = $_POST["opcion"];
	switch ($op) {
		case "getTarjetas":
			getTarjetas();
			break;
		case "getSuerte":
			getSuerte();
			break;
	}
}



function getTarjetas()
{
	if (isset($_POST["game"])) {
		$game = $_POST["game"];
		$inicio = isset($_POST["inicio"]) ? $_POST["inicio"] : 0;
		//$final = isset($_POST["final"]) ? $_POST["final"] : 9;
		$final = 12;
		$sql = "SELECT GC.ID, GC.Status,";
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
		$sql .= "WHERE GC.idGame = " . $game . " AND GC.Status = 'Pendiente' OR GC.Status = 'Activo' AND games.Status = 'Activo' GROUP BY GC.ID ORDER BY GC.ID LIMIT " . $inicio . ", " . $final;
		//echo $sql;
		$conn = PDOConnection::getConnection();
		$response = exeQuery($sql, $conn, true);

		$sql = "SELECT * FROM games WHERE ID = " . $game;
		$extra = exeQuery($sql, $conn, true);
		if ($extra["code"] == 200)
			$response["infoGame"] = $extra["data"];
		else
			$response["infoGame"] = $extra["msg"];

		$sql = "SELECT COUNT(ID) as Total FROM Game_cards WHERE idGame = " . $game . " AND (Status = 'Activo' OR Status = 'Pendiente')";
		$totales = exeQuery($sql, $conn, false);
		if ($totales["code"] == 200)
			$response["totalTarjetas"] = $totales["data"];
		else
			$response["totalTarjetas"] = $totales["msg"];
		responder($response);
	}
}

function getSuerte()
{
	if (isset($_POST["game"])) {
		/*$game = $_POST["game"];
		$sql = "SELECT GC.ID, GC.Status,";
		for($i = 1; $i <= 16; $i++){
			$sql .= "GROUP_CONCAT(DISTINCT CONCAT(i".$i.".Item,';',i".$i.".URL_image) ORDER BY i".$i.".ID ASC SEPARATOR '|') AS Item".$i;
			if($i < 16)
				$sql .= ", \n";
		}
		$sql .= "\nFROM Game_cards AS GC\n";
		for($i = 1; $i <= 16; $i++){
			$sql .= "INNER JOIN game_items AS i".$i." ON GC.Item".$i." = i".$i.".ID\n";
		}
		$sql .= "INNER JOIN games ON GC.idGame = games.ID\n";
		$sql .= "WHERE GC.idGame = ".$game." AND GC.Status = 'Activo' AND games.Status = 'Activo' OR games.Status = 'Pendiente' GROUP BY GC.ID ORDER BY RAND() LIMIT 1";
		//echo $sql;*/
		$game = $_POST["game"];
		$inicio = isset($_POST["inicio"]) ? $_POST["inicio"] : 0;
		$final = isset($_POST["final"]) ? $_POST["final"] : 9;
		$sql = "SELECT GC.ID, GC.Status,";
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
		$sql .= "WHERE GC.idGame = " . $game . " AND GC.Status = 'Pendiente' OR GC.Status = 'Activo' AND games.Status = 'Activo' GROUP BY GC.ID ORDER BY RAND() LIMIT 1";
		$conn = PDOConnection::getConnection();
		$response = exeQuery($sql, $conn, true);
		$sql = "SELECT * FROM games WHERE ID = " . $game;
		$extra = exeQuery($sql, $conn, true);
		if ($extra["code"] == 200)
			$response["infoGame"] = $extra["data"];
		else
			$response["infoGame"] = $extra["msg"];
		responder($response);
	}
}
