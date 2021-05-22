<?php
    $ruta = __FILE__;

    $error = isset($_GET['error']) ? $_GET['error'] : NULL;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="CSS/estil.css" />
    <link rel="shortcut icon" type="image/x-icon" href="IMG/phpThumb_generated_thumbnail.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
   
</head>
<header>
    <h1>Hosting Carlos Soler</h1>
</header>
<body>
    <div id="pagina">
    <?php include 'includes/menu.php'; ?>
        
        <main>
           


            <form id="formulari" method="POST" action="processos/procesaRegistre.php">
                
                <li>
                    <div id="errors">
                    <?= $error ?>
                    </div>
                </li>
                
                   
                <ul>
                    <li id="caja-nom">
                        <label for="nom"> Nom: </label>
                        <input type="text" id="registre-nom" name="nom" placeholder="Nom" />
                    </li>


                    <li id="caja-cognom">
                        <label for="cognoms"> Cognoms </label>
                        <input type="text" id="cognoms" name="cognoms" placeholder="Cognoms" />
                    </li>

                    <li id="caja-email">
                        <label for="email" class="form-label"> E-mail: </label>
                        <input type="text" id="email" name="email" placeholder="email@gmail.com" />
                    </li>

                    

                    <li id="caja-pass">
                        <label for="password"> Contrasenya:</label>

                        <input type="password" minlength="6" id="contrasena" name="password" />
                    </li>

                    <li id="caja-pass">
                            <label for="re-password">Confirma PSW</label>
                            <input type="password" name="re-password" id="re-password" pattern=".{8,}" required>
                        </li>


                    <li>
                        <label for="type">Tipus de compte</label>
                        <select name="type" id="type">
                            
                                <option value="premium">Premium</option>
                                <option value="normal">Normal</option>
                            
                        </select>
                    </li>


                    <br>

                    <li>
                        <input type="submit" value="Enviar"  />
                    </li>

                </ul>
            </form>


        </main>     

    </div>

</body>
<footer>
    <p>IES Lluís Simarro</p>
    <p>DAW</p>
    <p>Curs 20/21</p>

</footer>