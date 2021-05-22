<?php 
    require '../Utils/Funcions.php';
    require '../Utils/Conexio.php';
    require '../Utils/Login.php';
    
    $ruta = __FILE__;
    $name = !empty($_POST['nom']) ? $_POST['nom'] : 'No has introduit el nom';
    $surname = !empty($_POST['cognoms']) ? $_POST['cognoms'] : 'No has introduit el cognom';
    $email = !empty($_POST['email']) ? $_POST['email'] : 'No has introduit el correu';
    $password = !empty($_POST['password']) ? $_POST['password'] : 'No has introduit la contrasenya';
    $re_password = !empty($_POST['re-password']) ? $_POST['re-password'] : 'No has introduit la repetició de la contrasenya';
    $type = !empty($_POST['type']) ? $_POST['type'] : 'normal';
    $date = (new \DateTime())->format('Y-m-d H:i:s');
    $features = ['normal' => [
        '5GB de espai de disc dur', 
        '3 Bases de dades',
        '1 Nom de domini'
    ], 'premium' => [
        '10GB de espaci en disc dur',
        '5 Bases de dades',
        '2 Noms de domini'
    ]];
    
    if ($password != $re_password) {
        header("Location: ../registre.php?error=Les contrasenyes no coincideixen");
        die();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $conexio = new Conexio();
    $conexio->conectar();

    $existent = $conexio->query("SELECT * FROM usuarios WHERE email LIKE '$email'");
    
     if ($existent->num_rows > 0) {
        $conexio->desconectar();
        header("Location: ../registre.php?error=L'email ja existeix");
        die();
    } 
    
    $result = $conexio->query("INSERT INTO usuarios(nombre, apellidos, email, pass, type, date) VALUES ('$name','$surname','$email','$password','$type','$date')");
    
    if ($result) {
        $log = new Login("usuarios", 2);
        $log->write("Usuari Creat: " . $email /* . " - Dia: " . today() . " - Hora: " . now() */);
    }
    $conexio->desconectar();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre</title>
    <link rel="stylesheet" href="../CSS/estil.css">
</head>
<body>
    <div class="wrapper">
    <?php include '../includes/header.php'; ?>
        <main>
            <div class="title">
                <p>Registre del nou usuari</p>
            </div>
            <div class="subtitle">
                <h2>Dades enviades</h2>
            </div>
            <div id="data">
                <ul>
                    <li>Nom <?= $name ?></li>
                    <li>Cognoms: <?= $surname ?></li>
                    <li>Email: <?= $email ?></li>
                    <li>Constrasenya: <?= $password ?></li>
                    <li>Confirmació de Constrasenya: <?= $re_password ?></li>
                    <li>Tipus de compte <?= $type ?></li>
                </ul>
                <div>
                    <h1 class="margin-x">Benvingut</h1>
                </div>

                <div class="email-images">
                    <?php
                        $useremail = substr($email, 0, strpos($email, "@"));
                        $letters = str_split($useremail, 1);
                        $route = "../IMG/caracters/";

                        foreach ($letters as $letter) { 
                            $ext = is_numeric($letter)  ? ".png" : ".jpg"; 
                          $file = $route . $letter . $ext;                     
                            if (file_exists($file)) 
                                echo "<img src='" . $file . "' alt='" . $letter . "'/>";
                            else
                                echo "<span class='unknown-letter' style='font-size: 3em; color:blue'>" . $letter . "</span>";
                        }
                    ?>
                </div>

                <div>
                    <h3 class="margin-x">Compte <?= $type ?></h3>
                    <ul>
                        <?php 
                            foreach($features[$type] as $feature) {
                                echo "<li>" . $feature . "</li>";
                            }
                        ?>
                    </ul>
                    <div class="center">
                        <img id="bob"  src="../IMG/<?= $type == 'premium' ? 'type-premium.jpg' : 'type-normal.png' ?>" alt="Cuenta">
                    </div>
                </div>
                
            </div>
            </div>
            <div class="title">
                <a href="../index.php" id="tornar">Tornar a l'inici</a>
            </div>
        </main>
      
        
    </div>
    
</body>

</html>