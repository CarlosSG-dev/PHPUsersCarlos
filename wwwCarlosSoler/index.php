<?php
   if(session_id() == '') session_start();
   $ruta = __FILE__;
   
  /*  $host = explode(":", $_SERVER['HTTP_HOST'])[0];
   $admin = $host . ":" . $_SESSION['admin_port'];

   require "utils/Databases.php";
   Databases::init(); */
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="CSS/estil.css" />
    <link rel="stylesheet" href="CSS/styles.css">
    
   
    <link rel="shortcut icon" type="image/x-icon" href="IMG/phpThumb_generated_thumbnail.ico" />
    <script type="text/javascript" src="JavaScript/menuDesplegable.js"></script>
</head>
<header>
    <h1>Inici Hosting Carlos Soler</h1>
</header>
<body>
    <div id="pagina">
        
         
        <main>
            <table id="tabla1">

                <caption>Usuari Registrat</caption>
                <th id="imagenPuerta" rowspan="1"><a href="registrat.php"><img src="IMG/nextpng.com.png"></img></a>
            </table>
            <table id="tabla2">
                
                <caption>Administració</caption>
                <th id="imagenCal" rowspan="1"><a href="http://localhost:5000/ADMIN/admin.php"><img src="IMG/admin.png"></a></img>
                </a>
            </table>
            <table id="tabla3">

                <caption>Registra't ara</caption>
                <th id="imagen" rowspan="1"><a href="registre.php"><img src="IMG/pngguru.com.png" /></img></a>

            </table>

            



        </main>
    </div>

</body>
<footer>
    <p>IES Lluís Simarro</p>
    <p>DAW</p>
    <p>Curs 20/21</p>

</footer>