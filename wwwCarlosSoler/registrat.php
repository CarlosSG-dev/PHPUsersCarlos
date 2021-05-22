<?php
    require 'Utils/Login.php';
    session_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Admin</title>
    <link rel="stylesheet" href="CSS/estil.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/header.php'; ?>
        <?php include 'includes/menu.php'; ?>
        <main>
            <div class="title">
                <p>Usuari Registrat: <?= $user != NULL ? 'Dades' : 'Login' ?></p>
            </div>

            <?php 
                if ($msg != NULL) {
            ?>

            <div class="title <?= $msg['color'] ?>">
                <p><?= $msg['text'] ?></p>
            </div>

            <?php
                }
            ?>

            <?php 
                if ($accion == "modificar")
                    include 'plantilles/modificarDadesUsuari.php';
                elseif ($accion == "verlog")
                    include 'plantilles/vorerLogin.php';
                elseif ($user != NULL)
                    include 'plantilles/dadesUsuari.php';
                else    
                    include 'plantilles/login.php'; 
            ?>
            

            <div class="title">
                <a href="../index.php">Tornar a l'inici</a>
            </div>
        </main>
        <footer>
            <p>IES Lluís Simarro</p>
            <p>DAW</p>
            <p>Curs 20/21</p>

        </footer>
    </div>
</body>
</html>