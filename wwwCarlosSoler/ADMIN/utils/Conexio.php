<?php
  class Conexio {
    private $servidor;
    private $usuario;
    private $contraseña;
    private $basedatos;
    private $opened;
    public $conexion;

    public function __construct(){
      $this->servidor = "localhost";
      $this->usuario = "root";
      $this->contraseña = "";
      $this->basedatos = "2daw20_daw";
      $this->opened = false;
    }

    function conectar(){
      $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->basedatos);
      if (!$this->conexion) {
        echo "Error: No s'ha pogut conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
      }
      $this->query("SET NAMES utf8");
      $this->opened = true;
    }

    function desconectar(){
      try {
        if ($this->opened) $this->conexion->close();
        $this->opened = false;
      } catch (\Exepction $e) {
        error_log("La conexió ja està tancada");
      }
    }

    function query($sql, $multi = false) {
      
      return $multi 
        ? mysqli_multi_query($this->conexion, $sql) 
        : mysqli_query($this->conexion, $sql);
    }

  }
?>
