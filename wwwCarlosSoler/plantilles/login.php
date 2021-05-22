<div id="login">
    <form action="./processos/procesaRegistrat.php" method="POST">
        
            <?= $error ?>
    

        <div class="form-group">
            <label for="email">Correu</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contrasenya</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Entrar">
        </div>
    </form>
</div>