<?php

require_once 'Conexio.php';

class DataManager {
  private $route;
  private $folder;
  private $table;
  private static $conexion; 

  public function __construct($table, $parent){
      $this->folder = str_repeat("../", $parent) . "backup";
      $this->route = $this->folder . "/backup_{$table}_" . (new \DateTime())->format('Ymd_His') . ".txt";
      $this->table = $table;

      if (!file_exists($this->folder)) {
          mkdir($this->folder, 0777);
      } 
  }

  function backup() {
    $conexion = new Conexio();
    $conexion->conectar();

    $sql = "SELECT * FROM {$this->table}";
    $result = $conexion->query($sql);

    $keys_added = false;
    try {
      foreach ($result as $row) {
        $file = fopen($this->route, "a+");
        if (!$keys_added) {
          fwrite($file, $this->transposeHeader($row) . "\n");
          $keys_added = true; 
        }
        fwrite($file, $this->transpose($row) . "\n");
      }
      fclose($file);
      $conexion->desconectar();
      return true;
    } catch (Exception $e) {
      error_log($e);
      return false;
    }
  }

  function restore() {
      error_log("[RESTORE] ACTION NOT IMPLEMENTED YET");
  }

  function transpose($row) {
    return implode("::", $row);
  }

  function transposeHeader($row) {
    $keys = [];
    foreach ($row as $key => $value) $keys[] = $key;
    return implode("::", $keys);
  }
}