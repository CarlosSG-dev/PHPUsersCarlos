<div>
    <div class="title green">
        <p>Usuari registrat</p>
    </div>

    <div class="form">
        <form action="./processos/procesaModificarDades.php" method="post">
            <div class="form-group">
                <label for="email">Correu</label>
                <input type="email" name="email" id="email" readonly value="<?= $user['email'] ?>">
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="name" name="name" id="name" required value="<?= $user['nombre'] ?>">
            </div>

            <div class="form-group">
                <label for="surname">Apellidos</label>
                <input type="surname" name="surname" id="surname" required value="<?= $user['apellidos'] ?>">
            </div>

            <div class="form-group">
                <label for="type">Tipus de compte</label>
                <select name="type" id="type">
                    <option <?= $user["type"] == "normal" ? "selected" : "" ?> value="normal">Normal</option>
                    <option <?= $user["type"] == "premium" ? "selected" : "" ?> value="premium">Premium</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="re-password">Repetir Contrasenya</label>
                <input type="re-password" name="re-password" id="re-password">
            </div>

            <div class="form-group">
                <input type="submit" value="Modificar">
            </div>
        </form>
    </div>
    <div class="title">
        <a href="registrat.php">Cancelar</a>
    </div>
</div>