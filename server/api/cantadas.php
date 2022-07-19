<?php

require "conexion.php";
if(isset($_POST["opcion"])){
	$op = $_POST["opcion"];
	switch ($op) {
		case "proximas":
			getProximas();
			break;
		case "pasados":
			getPasados();
			break;
	}
}

function getProximas(){
	$sql = "SELECT * FROM games WHERE Status = 'Activo' OR Status = 'Pendiente' ORDER BY Game_date ASC LIMIT 8";
	$conn = PDOConnection::getConnection();
	$response = exeQuery($sql,$conn,true);
	responder($response);
}

function getPasados(){
	$sql = "SELECT * FROM games WHERE Status = 'Finalizado' ORDER BY Game_date ASC LIMIT 8";
	$conn = PDOConnection::getConnection();
	$response = exeQuery($sql,$conn,true);
	responder($response);
}


?>