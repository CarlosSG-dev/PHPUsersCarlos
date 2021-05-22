<?php 
    require '../../utils/Functions.php';
    require '../../utils/Log.php';
    
    if(session_id() == '') session_start();
    $user = $_SESSION['user'];
    session_unset();
    session_destroy();

    $log = new Log("admin", 2);
    $log->write("Usuari Desconectat: " . $user['email'] . " - Dia: " . today() . " - Hora: " . now());

    header('Location: ../../admin.php');
    die();
  
?>