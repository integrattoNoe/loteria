<?php
date_default_timezone_set('America/Mexico_City');

/**
 * Class PDO Connection
 */


class PDOConnection
{
  private function __construct()
  {
  }
  /**
   * This function create a database connection
   * @return Object database connection
   */
  public static function getConnection()
  {
    /** @var String hostname */
    $host = "laloteriamexicana.com.mx";
    /** @var String database username */
    $user = "elotto_admin";
    /** @var String database password */
    $pass = "loteriaAdmin1!";
    /** @var String database name */
    $name = "e_lotto";

    $dsn = "mysql:host=$host;dbname=$name;charset=utf8";
    try {
      // Create a new PDO connection
      $connection = new PDO($dsn, $user, $pass);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // Return the connection
      return $connection;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}



function exeQuery($query, $conn, $all)
{
  $response = null;
  try {
    //$sql = "SELECT Correo FROM salones WHERE ID = $idSalon";
    $stm = $conn->prepare($query);
    $stm->execute();
    $num = $stm->rowCount();
    if ($num > 0) {
      if ($all) {
        $response["code"] = 200;
        $response["data"] = $stm->fetchAll();
      } else {
        $response["code"] = 200;
        $response["data"] = $stm->fetch(PDO::FETCH_ASSOC);
      }
    } else {
      $response["code"] = 400;
      $response["msg"] = "No hay resultados";
    }
  } catch (Exception $e) {
    $response["code"] = 500;
    $response["msg"] = $e->getMessage();
  }
  return $response;
}

function responder($respuesta)
{
  header('Content-type: application/json');
  echo json_encode($respuesta);
}