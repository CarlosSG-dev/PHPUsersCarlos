<div>
    <div class="title green">
        <p>Usuari Registrat</p>
    </div>
    <div class="title">
        <p>Hola, <?= $user['email'] ?> <a href="./processos/procesaLogout.php">Log Out</a></p>
    </div>

    <div class="userdata">
        <ul>
            <li>Nom: <?= $user['nombre'] ?></li>
            <li>Apellidos: <?= $user['apellidos'] ?></li>
            <li>Correu: <?= $user['email'] ?></li>
            <li>Tipus de compte: <?= $user['type'] ?></li>
        </ul>
    </div>
    <div class="title">
        <a href="registrat.php?accion=modificar">Modificar les dades</a>
        <a href="./processos/procesaBaixa.php">Donar-se de baixa</a>
        <a href="registrat.php?accion=vorerLogin">Vorer Login</a>
    </div>
</div>