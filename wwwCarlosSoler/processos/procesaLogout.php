<?php 
   /*  require '../Utils/Functions.php'; */
    require '../Utils/Login.php';
    session_start();
    $user = $_SESSION['user'];
    session_unset();
    session_destroy();

    $log = new Login("usuaris", 2);
    $log->write("Usuari Desconectat: " . $user['email'] /* . " - Dia: " . today() . " - Hora: " . now() */);

    header('Location: ../index.php');
    die();
  
?>