<?php

require "conexion.php";
if(isset($_POST["opcion"])){
	$op = $_POST["opcion"];
	switch ($op) {
		case "getBannerHome":
			getBannerHome();
			break;
	}
}

function getBannerHome(){
	$sql = "SELECT * FROM banner_home";
	$conn = PDOConnection::getConnection();
	$response = exeQuery($sql,$conn,true);
	responder($response);
}

?>