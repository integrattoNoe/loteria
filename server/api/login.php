<?php
require "conexion.php";
if(isset($_POST["opcion"])){
	$op = $_POST["opcion"];
	switch ($op) {
		case 'login':
			login();
			break;
		case 'registro':
			registrar();
			break;
		case 'sesion':
			sesion_activa();
			break;
		case 'recuperar':
			recuperar_pass();
			break;
		case 'salir':
			salir();
			break;
		default:
			# code...
			break;
	}
}else{
	$respuesta["code"] = 400;
	$respuesta["msg"] = "No se recibió opción";
	responder($respuesta);
}


//$loginExp = time() + 3600;

function login(){
	global $loginExp;
	$conn = PDOConnection::getConnection();
	if(isset($_POST["login-form-password"],$_POST["login-form-email"])){
		try {
			$existeUsuario = existe_usuario($_POST["login-form-email"], $conn);
			if($existeUsuario){
				$sql = "SELECT * FROM clients WHERE email = :correo AND password = :pass LIMIT 1";
				//global $secreto;
				$stm = $conn->prepare($sql);
				$stm->bindParam(":correo",$_POST["login-form-email"]);
				$stm->bindParam(":pass",$_POST["login-form-password"]);
				$stm->execute();
				$num = $stm->rowCount();
				if($num > 0){// ya existe ese ticket
					$row = $stm->fetch(PDO::FETCH_ASSOC);
					extract($row);
					$response["code"]=200;
					/*$d = time();
					$fecha = date("Y-m-d", $d);*/
					$tmp = array(
						"u"=>$row["email"],
						"id"=>$row["ID"]
					);
					setcookie("lotto_lg",json_encode($tmp),$loginExp,"/");

				}else{
					$response["code"]=400;
					$response["msg"]="Usuario y contraseña incorrectos";
				}
			}else{
				$response["code"]=400;
				$response["msg"]="Este correo no está registrado, crea una cuenta para acceder.";
			}

			
		} catch (Exception $e) {
			$response["code"]=500;
			$response["msg"]="Error en el servidor: ".$e->getMessage();
		}
	}else{
		$response["code"]=400;
		$response["msg"]="No se enviaron datos";
	}
	responder($response);
}

function registrar(){
	try {
		global $loginExp;
		$conn = PDOConnection::getConnection();

		$sql = 'SELECT * FROM clients WHERE email = :email';
		$stm = $conn->prepare($sql);
		$stm->bindParam(":email",$_POST["register-form-email"]);
		$stm->execute();
		$num = $stm->rowCount();
		if($num > 0){
			$respuesta["code"] = 400;
			$respuesta["msg"] = "Este correo ya está registrado, inicia sesión para ingresar";
		}else{
			$sql = "INSERT INTO clients SET First_name = :nombre, Last_name = :apellido, Phone = :telefono, email = :correo, password = :pass, Status = 'Activo', Created_at = :fecha";
			$stm = $conn->prepare($sql);
			$stm->bindParam(":correo",$_POST["register-form-email"]);
			//$passEnc = openssl_encrypt($_POST["password"], "AES-128-ECB", $secreto);
			$stm->bindParam(":pass",$_POST["register-form-password"]);
			$stm->bindParam(":apellido",$_POST["register-form-apellido"]);
			$stm->bindParam(":nombre",$_POST["register-form-nombre"]);
			$stm->bindParam(":telefono",$_POST["register-form-telefono"]);
			$d = time();
			$fecha = date("Y-m-d H:i:s", $d);
			$stm->bindParam(":fecha",$fecha);
			/*$stm->bindParam(":des",$descuento);*/
			$respuesta["sql"] = $stm;
			$result = false;
			$result = $stm->execute();
			if($result){
				$respuesta["code"] = 200;
				$tmp = array(
					"u"=>$_POST["register-form-email"],
					"id"=> $conn->lastInsertId()
				);
				//setcookie("ech_lg_tmp",json_encode($temp),$loginExp,"/");
				setcookie("lotto_lg",json_encode($tmp),$loginExp,"/");
			}else{
				$respuesta["code"] = 400;			
				$respuesta["msg"] = "Error al guardar al cliente";
			}
		}
	} catch (Exception $e) {
		$respuesta["code"] = 500;
		$respuesta["msg"] = "Error en el servidor: \n".$e->getMessage();
	}
	responder($respuesta);
}

function existe_usuario($email, $conexion){
	try {
		$sql = 'SELECT * FROM clients WHERE email = :email';
		$stm = $conexion->prepare($sql);
		$stm->bindParam(":email",$email);
		$stm->execute();
		$num = $stm->rowCount();
		return $num > 0;
	} catch (Exception $e) {}
	return false;
}

function sesion_activa(){
	if(isset($_COOKIE["lotto_lg"])){
		$tmp = json_decode( $_COOKIE["lotto_lg"], true );
		$sql = "SELECT * FROM clients WHERE ID = ".$tmp["id"];
		$conn = PDOConnection::getConnection();
		$response = exeQuery($sql,$conn,true);
		$conn = null;
	}else
		$response["code"] = 400;
	responder($response);
}

function salir(){
	if(isset($_COOKIE["lotto_lg"])){
		setcookie("lotto_lg","",time()-3600,"/");
	  	unset($_COOKIE["lotto_lg"]);
	}

	$response["code"] = 200;
	responder($response);
}

function recuperar_pass(){
	try {
		$conn = PDOConnection::getConnection();
		$sql = "SELECT * FROM clients WHERE email = :correo LIMIT 1";
		$stm = $conn->prepare($sql);
		$stm->bindParam(":correo",$_POST["email"]);
		$stm->execute();
		$num = $stm->rowCount();

		if($num > 0){
			$row = $stm->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$to = $_POST["email"];
			$subject = "Recuperación de contraseña";
			$message = "
			<html>
			<head>
			<title>Contraseña sitio Loteria</title>
			</head>
			<body>
			<p><strong>Correo: </strong>".$_POST["email"]."</p>
			<p><strong>Contraseña: </strong>".$row['password']."</p>
			</body>
			</html>
			";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			//$headers .= 'From: <noreply@loteria.com>' . "\r\n";
			$headers .= 'From: <noe@integratto.com.mx>' . "\r\n";
			//$headers .= 'Cc: myboss@example.com' . "\r\n";

			$resp = mail($to,$subject,$message,$headers);
			if($resp)
				$response["code"] = 200;
			else{
				$response["code"] = 400;
				$response["msg"] = "Error al enviar el correo, intente más tarde";
			}
		}else{
			$response["code"] = 400;
			$response["msg"] = "Este correo no ha sido registrado";
		}
	} catch (Exception $e) {
		$response["code"] = 500;
		$response["msg"] = "Error: ".$e->getMessage();
	}
	
	responder($response);
}


?>