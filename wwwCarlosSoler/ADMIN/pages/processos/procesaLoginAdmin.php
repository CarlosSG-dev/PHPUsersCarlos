<?php 
    require_once '../../Utils/Functions.php'; 
    require_once '../../utils/Conexio.php';
    require_once '../../utils/Log.php';
    session_start();

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conexio = new Conexio();
    $conexio->conectar();

    $resultat = $conexio->query("SELECT * FROM usuarios WHERE email LIKE '$email' AND isAdmin = 1 LIMIT 0, 1");

    $conexio->desconectar();
    if ($resultat->num_rows < 1) {
        header('Location: ../admin.php?error=Usuari inexistent o sense permisos');
        die();
    }

    $user = NULL;

    foreach ($resultat as $usuari) {
        if (password_verify($pass, $usuari['pass'])) {
            $user = $usuari;
        }
    }

    if ($user == NULL) {
        header('Location: ../admin.php?error=Contrasenya incorrecta');
        die();
    }

    $user['isAdmin'] = $user['isAdmin'] == 1 ? true : false;
    $_SESSION['user'] = $user;
    
    $log = new Log("admin", 2);
    $log->write("Usuari Administrador Conectat: " . $user['email'] . " - Dia: " . today() . " - Hora: " . now());

    header('Location: ../admin.php?success=' . $user['name']);
    die();
?>