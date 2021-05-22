<div>
    <div class="form">
        <form action="?action=<?= $action == "update" ? "update" : "new" ?>" method="post" enctype="multipart/form-data">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mb-3">
              <?= $_GET['error'] ?>
            </div>
            <?php } ?>
            <div class="form-group d-none">
                <label for="name">Id</label>
                <input type="text" name="id" id="id" readonly value="<?= isset($id) ? $id : "0" ?>">
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" required value="<?= isset($userTemplate['nombre']) ? $userTemplate['nombre'] : "" ?>">
            </div>

            <div class="form-group">
                <label for="surname">Cognoms</label>
                <input type="text" name="surname" id="surname" required value="<?= isset($userTemplate['apellidos']) ? $userTemplate['apellidos'] : "" ?>">
            </div>

            <div class="form-group">
                <label for="email">Correu</label>
                <input type="email" name="email" id="email" <?= $action == "update" ? "readonly" : "" ?> value="<?= isset($userTemplate['email']) ? $userTemplate['email'] : "" ?>">
            </div>
            
            <div class="form-group">
                <label for="type">Tipus de compte</label>
                <select name="type" id="type">
                    <option <?= (isset($userTemplate["type"]) ? $userTemplate["type"] : "normal") == "normal" ? "selected" : "" ?> value="normal">Normal</option>
                    <option <?= (isset($userTemplate["type"]) ? $userTemplate["type"] : "normal") == "premium" ? "selected" : "" ?> value="premium">Premium</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="re-password">Repetir Contrasenya</label>
                <input type="password" name="re-password" id="re-password">
            </div>

            <div class="form-group">
                <label for="isAdmin">Admin</label>
                <input type="checkbox" name="isAdmin" id="isAdmin" <?= (isset($userTemplate["isAdmin"]) ? $userTemplate["isAdmin"] : 0 == 1) ? "checked" : "" ?>>
            </div>
            <div class="form-group">
                <label for="profile-image">Foto de perfil</label>
                <!-- <input id="delete-image" type="submit" name="delete-image" value="Eliminar" /> -->
                <input id="profile-image" type="file" name="profile-image" value="" />
            </div>
            <div class="form-group">
                <div 
                  class="profile-box"
                  style="background: url('<?= isset($userTemplate['profileimg']) ? $userTemplate['profileimg'] : "" ?>') no-repeat center center;"
                ></div>
            </div>

            <div class="form-group">
                <input type="button" value="Cancelar" onclick="window.location.href = './admin.php'">
                <input type="submit" value="<?= $action == "update" ? "Modificar" : "Añadir" ?>">
            </div>
        </form>
    </div>
</div>