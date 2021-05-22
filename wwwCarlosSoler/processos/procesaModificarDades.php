<?php 
    /* require '../../utils/Functions.php'; */
    require '../Utils/Conexio.php';
    require '../Utils/Login.php';
    session_start();

    $ruta = __FILE__;
    $email = $_SESSION['user']['email'];

    $name = !empty($_POST['name']) ? $_POST['name'] : 'error: Sin nombre';
    $surname = !empty($_POST['surname']) ? $_POST['surname'] : 'error: Sin apellidos';
    $password = !empty($_POST['password']) ? $_POST['password'] : 'error: Sin contraseña';
    $re_password = !empty($_POST['re-password']) ? $_POST['re-password'] : 'error: Sin contraseña';
    $type = !empty($_POST['type']) ? $_POST['type'] : 'normal';

    if ($password != $re_password) {
        header('Location: ../registrat.php?accion=modificar&error=Les contrasenyes no coincideixen');
        die;
    }

    $conexion = new Conexio();
    $conexion->conectar();

    $change_password = "";
/* 
    if (!startsWith($password, 'error: No has introduit una contrasenya')) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $change_password = ", password='" . $hash_password . "'";
    }  */

    if ($change_password != "" && strlen($password) < 7) {
        header('Location: ../registrat.php?accion=modificar&error=Las contrasenya ha de ser major a 6 caracters');
        die;
    }

    $resultado = $conexion->query("UPDATE usuarios SET nombre='$name', apellidos='$surname', type='$type' " . $change_password . "  WHERE email='$email'");

    if ($resultado) {
        $log = new Login("usuarios", 2);
        $log->write("Usuario Modificado: " . $_SESSION['user']['email'] /* . " - Dia: " . today() . " - Hora: " . now() */);
    }

    $conexion->desconectar();

    $_SESSION['user']['nombre'] = $name;
    $_SESSION['user']['apellidos'] = $surname;
    $_SESSION['user']['type'] = $type;
    $_SESSION['user']['pass'] = $hash_password;


    header('Location: ../registrat.php?success=Dades modificades correctament');
    die;
    
?>