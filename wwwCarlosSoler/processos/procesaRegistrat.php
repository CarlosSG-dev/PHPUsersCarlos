<?php 
  /*   require '../Utils/Functions.php'; */
    require '../Utils/Conexio.php';
    require '../Utils/Login.php';
    session_start();

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conexio = new Conexio();
    $conexio->conectar();

    $resultat = $conexio->query("SELECT * FROM usuarios WHERE email LIKE '$email' LIMIT 0, 1");

    $conexio->desconectar();
    if ($resultat->num_rows < 1) {
        header('Location: ../registrat.php?error=Usuari inexistent');
        die();
    }

    $user = NULL;

    foreach ($resultat as $usuari) {
        if (password_verify($pass, $usuari['pass'])) {
            $user = $usuari;
        }
    }

    if ($user == NULL) {
        header('Location: ../registrat.php?error=Contrasenya incorrecta');
        die();
    }

    $_SESSION['user'] = $user;
    
    $log = new Login("usuarios", 2);
    $log->write("Usuari Conectat: " . $user['email'] /* . " - Dia: " . today() . " - Hora: " . now() */);

    header('Location: ../registrat.php?success=' . $user['name']);
    die();
?>