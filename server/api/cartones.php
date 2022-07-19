<?php

require "conexion.php";

getCartones();

function getCartones(){
	$response["hoy"] = get_partidaHoy();
	$response["proximas"] = get_proximasPartidas();
	responder($response);
}

function get_partidaHoy(){
	$conn = PDOConnection::getConnection();
	$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') = CURDATE() AND Status = 'Activo' ORDER BY Game_date ASC LIMIT 1";
	$response = exeQuery($sql,$conn,true);
	return $response;
	
}

function get_proximasPartidas(){
	$conn = PDOConnection::getConnection();
	$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') > CURDATE() ORDER BY Game_date ASC LIMIT 1";
	$response = exeQuery($sql,$conn,true);
	return $response;
}

function get_superPartida(){
	$conn = PDOConnection::getConnection();
	$sql = "SELECT * FROM games WHERE DATE_FORMAT(Game_date,'%Y/%m/%d') = CURDATE()";
	$response = exeQuery($sql,$conn,true);
	return $response;
}

?>