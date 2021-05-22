<?php
    /* require '../Utils/Funcions.php'; */
    require '../Utils/Conexio.php';
    require '../Utils/Login.php';
    session_start();
    $user = $_SESSION['user'];
    $id = $user['id'];

    $conexion = new Conexio();
    $conexion->conectar();

    $resultado = $conexion->query("DELETE FROM usuarios WHERE id = '$id'");

    if ($resultado) {
        $log = new Login("usuarios", 2);
        $log->write("Usuari donat de baixa: " . $user['email'] /* . " - Dia: " . today() . " - Hora: " . now() */);
    }

    $conexion->desconectar();

    header('Location: procesaLogout.php');
    die;
