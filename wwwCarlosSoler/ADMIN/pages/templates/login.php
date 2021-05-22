<?php
    require_once '../utils/Log.php';
    if(session_id() == '') session_start();
    $ruta = __FILE__;


    $user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
    $error = isset($_GET['error']) ? $_GET['error'] : NULL;
    $success = isset($_GET['success']) ? $_GET['success'] : NULL;
    $accion = isset($_GET['accion']) ? $_GET['accion'] : NULL;

    $msg = NULL;

    if ($error != NULL && $error != '') {
        $msg = array("text" => $error, "color" => "red");
    }

    if ($success != NULL && $success != '') {
        $msg = array("text" => $success, "color" => "green");
    }

?>
<main>
  <div class="title">
    <p>Administració: <?= $user != NULL ? 'Datos' : 'Login' ?></p>
  </div>
  <div id="login">
    <form action="processos/procesaLoginAdmin.php" method="POST">
      <?= $error ?>

      <div class="form-group">
          <label for="email">Correu</label>
          <input type="email" name="email" id="email" required>
      </div>

      <div class="form-group">
          <label for="password">Contrasenya</label>
          <input type="password" name="password" id="password" required>
      </div>

      <div class="form-group">
          <input type="submit" value="Entrar">
      </div>
    </form>
  </div>
  <div class="title">
    <a href="http://<?= $main ?>">Tornar a l'inici</a>
  </div>
</main>