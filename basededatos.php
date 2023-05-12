<?php

/**
 * Operaciones con la base de datos
 * @author Felipe Hommen Mansilla
 */
class basededatos
{
    /**
     * @var object
     * Objeto conexión a la base de datos
     */
  private $conn;
  /**
   * Constructor de la clase.
   * Crea la conexión con la bse de datos
   */
  public function __construct()
  {

    $config = parse_ini_file('./config.ini');
    try {
      $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
      $dsn = 'mysql:host=' . $config['server'] . ';dbname=' . $config['base'];
      $this->conn = new PDO($dsn, $config['user'], $config['pass'], $opc);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  /**
   * Método privado que ejecuta una consulta construida en otro método
   * @param string $sql consulta SQL que se quiere ejecutar
   * 
   * @return [mixed] resultado de la consulta
   */
  private function ejecutaConsulta($sql)
  {
    try {
      $resultado = null;
      if (isset($this->conn)) $resultado = $this->conn->query($sql);
      return $resultado;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  /**
   * Comprueba que la contraseña dada coincide con la del usuario dado, para propósito de login
   * @param mixed $usuario nombre de usuario
   * @param mixed $clave contraaseña
   * 
   * @return array array con los datos del usuario si la contraseña es correcta
   */
  public function compruebaUsuario($usuario, $clave)
  {
    $sql = 'SELECT * FROM usuarios WHERE ((usu ="' . $usuario . '") AND (pass ="' . $clave . '")) LIMIT 1';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Devuelve un array con los datos de todos los usuarios
   * @return array array de filas con los datos de todos los usuarios
   */
  public function getUsuarios()
  {
    $sql = 'SELECT * FROM usuarios';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Devuelve un array con los datos de todos los puertos
   * @return array array de filas con los datos de todos los puertos
   */
  public function getPuertos()
  {
    $sql = 'SELECT * FROM puertos';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Devuelve un array con los datos de todas las redes
   * @return array array de filas con los datos de todas las redes
   */
  public function getRedes()
  {
    $sql = 'SELECT * FROM redes';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->FetchAll();
      return $datos;
    }
  }

  /**
   * Devuelve un array con los datos de lasdescripciones de todas las redes
   * @return array array de filas con los datos de las descripciones de todas las redes
   */
  public function getRedesD()
  {
    $sql = 'SELECT * FROM redesd';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Devuelve los datos de una red
   * @param mixed $codred código de la red
   * 
   * @return array array con los campos de la red pedida
   */
  public function getUnaRed($codred)
  {
    $sql = 'SELECT * FROM redesd WHERE codred="' . $codred . '" LIMIT 1';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Devuelve un array con todos los números de switch existentes
   * @return array array con todos los números de switch existentes
   */
  public function getNswitch()
  {
    $sql = 'SELECT DISTINCT ns FROM puertos ORDER BY ns';
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->FetchAll();
      return $datos;
    }
  }

  /**
   * Devuelve los datos de todos los puertos conectados al switch dado
   * @param mixed $sw número de switch
   * 
   * @return array array de filas con los datos de todos los puertos conectados al switch dado
   */
  public function getswitch($sw)
  {
    $sql = "SELECT * FROM puertos WHERE ns='$sw' ORDER BY cod";
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->FetchAll();
      return $datos;
    }
  }

  /**
   * Devuelve el primer switch de la tabla
   * @return string nombre del primer switch 
   */
  public function getPrimerSwitch()
  {
    $sql = "SELECT ns FROM puertos order by cod LIMIT 1";
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) {
      $datos = $resultado->Fetch();
      return $datos;
    }
  }

  /**
   * Crea un switch con el nombre y número de puertos especificado
   * @param string $nombre nombre del switch
   * @param int $puertos número de puertos
   * @return void
   * 
   */
  public function creaSwitches($nombre, $puertos)
  {
    $sql = "INSERT INTO puertos (`ns`, `np`, `desc`) VALUES ";

    for ($i = 1; $i <= $puertos; $i++) {
      $longitud = strlen((string)$puertos);
      $ns = 'P' . str_pad($i, $longitud, '0', STR_PAD_LEFT);
      $sql = $sql . "('$nombre', '$ns', ''), ";
    }

    $sql = substr($sql, 0, -2);
    $this->ejecutaConsulta($sql);
  }

  /**
   * Modifica la descripción de un puerto
   * @param string $cod código del puerto
   * @param string $descripcion descripcioón del puerto
   * @return void
   * 
   */
  public function modificaPuerto($cod, $descripcion)
  {
    $sql = "UPDATE puertos SET `desc`='$descripcion' where cod='$cod'";
    $this->ejecutaConsulta($sql);
  }
}
