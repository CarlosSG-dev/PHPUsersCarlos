<?php
  class Conexio {
    private $servidor;
    private $usuario;
    private $contraseña;
    private $basedatos;
    public $conexion;

    public function __construct(){
      $this->servidor = "localhost";
      $this->usuario = "root";
      $this->contraseña = "";
      $this->basedatos = "2daw20_daw";
    }

    function conectar(){
      $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->basedatos) or die ("Error al conectar a la BDD");
      $this->query("SET NAMES utf8");
      
    }

    function desconectar(){
      $this->conexion->close();
    }

    function query($sql, $multi = false) {
      return $multi 
        ? mysqli_multi_query($this->conexion, $sql) 
        : mysqli_query($this->conexion, $sql);
    }

  }
?>