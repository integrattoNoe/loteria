<?php

require "conexion.php";
if(isset($_POST["opcion"])){

	$op = $_POST["opcion"];
	switch ($op) {
		case 'getPartidasHoy':
			getPartidasHoy();
			break;
		case 'getProximasPartidas':
			getProximasPartidas();
			break;
		case 'getSuperPartidas':
			getSuperPartidas();
			break;
	}
}


function getPartidasHoy(){
	$conn = PDOConnection::getConnection();
	$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') = CURDATE() AND (Game_type != 'Super' OR Game_type IS NULL) AND Status = 'Pendiente' ORDER BY Game_date ASC";
	$response = exeQuery($sql,$conn,true);
	$conn = null;
	responder($response);
	
}

function getProximasPartidas(){
	$conn = PDOConnection::getConnection();
	//$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') > CURDATE() AND (Game_type != 'Super' OR Game_type IS NULL) ORDER BY Game_date ASC";
	$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') > CURDATE() AND (Game_type != 'Super' OR Game_type IS NULL) and Status = 'Pendiente' ORDER BY Game_date ASC";
	$response = exeQuery($sql,$conn,true);
	$conn = null;
	responder($response);
}

function getSuperPartidas(){
	$conn = PDOConnection::getConnection();
	$sql = "SELECT * FROM games WHERE Game_type = 'Super' and Status = 'Pendiente' AND DATE_FORMAT(Game_date,'%Y/%m/%d') > CURDATE() ORDER BY Game_date ASC";
	$response = exeQuery($sql,$conn,true);
	$conn = null;
	responder($response);
	
}

?>