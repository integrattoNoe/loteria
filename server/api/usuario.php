<?php

require "conexion.php";
if(isset($_POST["opcion"])){
	$op = $_POST["opcion"];
	switch ($op) {
		case 'datos_usuario':
			get_datos_usuario();
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
    case "actualizar_datos":
      actualizar_datos();
      break;
    case "updPass":
      updPass();
      break;
    case "getTarjetas":
      getTarjetas();
      break;
    case "getTarjetasByGame":
      getTarjetasByGame();
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


function get_datos_usuario(){
  global $loginExp;
  if(isset($_COOKIE["lotto_lg"])){
    $tmp = json_decode( $_COOKIE["lotto_lg"], true );
     $email = $tmp["u"];
    try {
      $conn = PDOConnection::getConnection();
      $sql = "SELECT * FROM clients WHERE email = :correo LIMIT 1";
      //global $secreto;
      $stm = $conn->prepare($sql);
      $stm->bindParam(":correo",$email);
      $stm->execute();
      $num = $stm->rowCount();
      if($num > 0){
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $response["code"]=200;
        $response["usuario"] = $row;
        $tmp = array(
          "u"=>$row["email"],
          "id"=>$row["ID"]
        );
        setcookie("lotto_lg",json_encode($tmp),$loginExp,"/");
      }
    } catch (Exception $e) {
      $response["code"]=500;
      $response["msg"]="Error en el servidor: ".$e->getMessage();
    }
  }else if(isset($_COOKIE["ech_lg_tmp"])){
    $response["usuario"] = json_decode( $_COOKIE["ech_lg_tmp"], true );
    $response["tmp"] = true;
    $response["code"]=200;
  }else{
    $response["code"]=400;
    $response["msg"]="No ha iniciado sesión";
  }
  if(isset($_COOKIE["idV"]))
    $response["idV"] = $_COOKIE["idV"];
  else
    $response["idV"] = "";
  if(isset($_COOKIE["idVM"]))
    $response["idVM"] = $_COOKIE["idVM"];
  else
    $response["idVM"] = "";
  $conn = null;
  responder($response);
}


function actualizar_datos(){
  try {
    $conn = PDOConnection::getConnection();
    $sql = "UPDATE clients SET First_name = :nombre, Last_name = :apellidos, Phone = :telefono, Address1 = :adress1, Address2 = :adress2, Zip_code = :cp, Location = '', City = :ciudad, State = :estado, Country = :pais, Updated_at = :fecha
      WHERE ID = :id";
    $d = time();
    $fecha = date("Y-m-d H:i:s", $d);
    $stm = $conn->prepare($sql);
    $stm->bindParam(":nombre",$_POST["nombre"]);
    $stm->bindParam(":apellidos",$_POST["apellido"]);
    $stm->bindParam(":adress1",$_POST["direccion1"]);
    $stm->bindParam(":adress2",$_POST["direccion2"]);
    $stm->bindParam(":ciudad",$_POST["ciudad"]);
    $stm->bindParam(":pais",$_POST["pais"]);
    $stm->bindParam(":estado",$_POST["estado"]);
    $stm->bindParam(":cp",$_POST["cp"]);
    $stm->bindParam(":telefono",$_POST["telefono"]);
    $stm->bindParam(":fecha",$fecha);
    $tmp = json_decode( $_COOKIE["lotto_lg"], true );
    $email = $tmp["u"];
    $id = $tmp["id"];
    $stm->bindParam(":id",$id);
    $respuesta["sql"] = $stm;
    $result = false;
    $result = $stm->execute();
    if($result)
      $respuesta["code"] = 200;
    else{
      $respuesta["code"] = 400;
      $respuesta["msg"] = "Error al guardar los datos";
    }

  } catch (Exception $e) {
    $respuesta["code"] = 500;
    $respuesta["msg"] = $e->getMessage();
  }
  $conn = null;
  responder($respuesta);
}

function updPass(){
  try {
    $conn = PDOConnection::getConnection();
    $sql = "UPDATE clients SET password = :pass, Updated_at = :fecha
      WHERE ID = :id";
    $d = time();
    $fecha = date("Y-m-d H:i:s", $d);
    $stm = $conn->prepare($sql);
    $stm->bindParam(":pass",$_POST["pass"]);
    $stm->bindParam(":fecha",$fecha);
    $tmp = json_decode( $_COOKIE["lotto_lg"], true );
    $email = $tmp["u"];
    $id = $tmp["id"];
    $stm->bindParam(":id",$id);
    $respuesta["sql"] = $stm;
    $result = false;
    $result = $stm->execute();
    if($result)
      $respuesta["code"] = 200;
    else{
      $respuesta["code"] = 400;
      $respuesta["msg"] = "Error al actualizar la contraseña, intente más tarde.";
    }

  } catch (Exception $e) {
    $respuesta["code"] = 500;
    $respuesta["msg"] = $e->getMessage();
  }
  $conn = null;
  responder($respuesta);
}

function getTarjetas(){
  try {
    $tmp = json_decode( $_COOKIE["lotto_lg"], true );
    $email = $tmp["u"];
    $idCliente = $tmp["id"];
    $conn = PDOConnection::getConnection();
    $sql = "SELECT GC.ID, GC.idGame, GC.Status as GameCardStatus, games.Card_price, games.Status as GameStatus, games.Game_name, GC.idClient, DATE_FORMAT(GC.Sale_date,'%d/%m/%Y') AS fechaCompra , ";
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
    $sql .= "WHERE GC.idClient = ".$idCliente." AND GC.Status != 'Apartado' GROUP BY GC.ID ORDER BY GC.ID";
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
  responder($response);
}

function getTarjetasByGame(){
  try {
    $tmp = json_decode( $_COOKIE["lotto_lg"], true );
    $email = $tmp["u"];
    $idCliente = $tmp["id"];
    $idGame = $_POST["idGame"];
    $conn = PDOConnection::getConnection();
    $sql = "SELECT GC.ID, GC.idGame, GC.Status as GameCardStatus, games.Card_price, games.Status as GameStatus, games.Game_name, GC.idClient, ";
    for($i = 1; $i <= 16; $i++){
      $sql .= "GROUP_CONCAT(DISTINCT CONCAT(i".$i.".Item,';',i".$i.".URL_image,';',i".$i.".ID) ORDER BY i".$i.".ID ASC SEPARATOR '|') AS Item".$i;
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
  responder($response);
}

?>