<?php

require_once "utils/Conexio.php";


class Databases {
  private static $conexio;
  private static $tables;

  public static function init() {
    self::$conexio = new Conexio();
    self::$tables = [];

    self::createUsers();

    self::initDatabases();
  }

  /* -------------------------------------------------------------------------- */
  /*                               TABLA USUARIOS                               */
  /* -------------------------------------------------------------------------- */
  public static function createUsers() {
    $users = new \stdClass();
    $users->table_name = "usuarios";
    $users->columns = new \stdClass();

    $users->columns->id = ["int:9", "primary", "auto_increment"];
    $users->columns->nombre = ["varchar:255"];
    $users->columns->apellidos = ["varchar:255"];
    $users->columns->email = ["varchar:255", "unique"];
    $users->columns->pass = ["varchar:255"];
    $users->columns->type = ["varchar:255"];
    $users->columns->date = ["varchar:255"];
    $users->columns->profileimg = ["varchar:255", "default:default_profile.png"];
    $users->columns->isAdmin = ["tinyint:1", "default:0"];

    self::$tables[] = $users;
  }

  /* -------------------------------------------------------------------------- */
  /*                               INICIALIZACION                               */
  /* -------------------------------------------------------------------------- */
  public static function initDatabases() {
    self::$conexio = new Conexio();
    self::$conexio->conectar();

    foreach (self::$tables as $key => $table) {
      $sql_creation = "CREATE TABLE IF NOT EXISTS $table->table_name (";
      foreach ($table->columns as $key => $value) {
        $data_type = explode(":", $table->columns->{$key}[0]);
        $col = "$key {$data_type[0]}({$data_type[1]}) NOT NULL";
      
        if (in_array("unique", $table->columns->{$key})) $col .= " UNIQUE";
        if (in_array("primary", $table->columns->{$key})) $col .= " PRIMARY KEY";
        if (in_array("auto_increment", $table->columns->{$key})) $col .= " AUTO_INCREMENT";
      
        foreach ($value as $arg) {
          if (str_starts_with($arg, 'default')) {
            $default_value = explode(":", $arg)[1];
            $col .= " DEFAULT " . (is_numeric($default_value) ? "{$default_value}" : "'{$default_value}'");
          }
        }

        $col .= ", ";
        $sql_creation .= $col;
      }
      $sql_creation = substr($sql_creation, 0, strlen($sql_creation) - 2);
      $sql_creation .= ")";
      
      $result = self::$conexio->query($sql_creation);
      // echo $result;
    }

    $date = (new \DateTime())->format('Y-m-d H:i:s');
    $password = password_hash("admin", PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios(nombre, apellidos, email, type, date, pass, isAdmin) VALUES ('admin', '', 'admin@admin.com', 'normal', '{$date}', '{$password}', 1)";
    self::$conexio->query($sql);
    
    self::$conexio->desconectar();

  }

}
