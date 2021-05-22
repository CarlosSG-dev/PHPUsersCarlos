<?php
    require_once '../utils/DataManager.php';
    require_once '../utils/Functions.php';
    require_once '../utils/Conexio.php';
    require_once '../utils/Log.php';

    $ruta = __FILE__;

    $conexion = new Conexio();
    $conexion->conectar();

    if(session_id() == '') session_start();
    $_SESSION['main_port'] = 80;
    $_SESSION['admin_port'] = 5000;

    $host = explode(":", $_SERVER['HTTP_HOST'])[0];
    $main = $host . ":" . $_SESSION['main_port'];

    $template = isset($_GET['page']) ? $_GET['page'] : "default";
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

    $action = isset($_GET['action']) ? $_GET['action'] : "default";
    $id = isset($_GET['id']) ? $_GET['id'] : "0";
    $table = isset($_GET['table']) ? $_GET['table'] : NULL;

   
    $features = ['normal' => [
        '5GB Espai al disc dur', 
        '3 Bases de dades',
        '1 Nom de domini'
    ], 'premium' => [
        '10GB Espai al disc dur',
        '5 Bases de dades',
        '2 Noms de domini'
    ]];

    if ($action == "delete" && $id != "0" && $_SERVER['REQUEST_METHOD'] === "GET") {
        $sql = "DELETE FROM usuarios WHERE id = {$id}";
        $result = $conexion->query($sql);

        $log = new Log("admin", 1);
        $log->write("[{$user['email']}] Usuari Eliminat: " . $email . " - Dia: " . today() . " - Hora: " . now());

        if ($result) {
            header("Location: ?success=Registre eliminat amb exit");
            die;
        } else {
            header("Location: ?error=Error al eliminar registre");
            die;
        }
    }

    
    if ($action == "update" && $_SERVER['REQUEST_METHOD'] === "POST") {
        $index = strpos($_SERVER['HTTP_REFERER'], "&error=");
        error_log(json_encode($index));
        if (!!$index)
            $referer = substr($_SERVER['HTTP_REFERER'], 0, $index);
        else 
            $referer = $_SERVER['HTTP_REFERER'];

        $name = !empty($_POST['name']) ? $_POST['name'] : 'Sin nombre';
        $surname = !empty($_POST['surname']) ? $_POST['surname'] : 'Sin apellidos';
        $email = !empty($_POST['email']) ? $_POST['email'] : '';
        $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
        $re_password = !empty($_POST['re-password']) ? $_POST['re-password'] : NULL;
        $type = !empty($_POST['type']) ? $_POST['type'] : 'normal';
        $isAdmin = !empty($_POST['isAdmin']) ? true : false;
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        
        $id = $id == "0" ? (isset($_POST['id']) ? $_POST['id'] : $id) : $id;

        if ($password != $re_password) {
            header("Location: ?error=Les contrasenyes no coincideixen");
            die();
        }

       

        if (isset($password)) $password = password_hash($password, PASSWORD_DEFAULT);
        $existent = $conexion->query("SELECT * FROM usuarios WHERE id LIKE '$id'");
        
        if ($existent->num_rows < 1) {
            $conexion->desconectar();
            header("Location: ?error=No s'ha trobat l'usuari");
            die();
        }

        

        if ($user['email'] == $email && $isAdmin != $user['isAdmin']) {
            header("Location: ?error=No es poden modificar els permisos de l'usuari");
            die();
        }

        if (!empty($_FILES['profile-image']['size'])) {
            try {
              $pathprofile = uploadImage($email);
            } catch (\Exception $e) {
              error_log("Location: {$referer}&error={$e->getMessage()}");
              header("Location: {$referer}&error={$e->getMessage()}");
              die;
            }
        }

        $sql = "UPDATE usuarios SET nombre = '{$name}', apellidos = '{$surname}', type = '{$type}', date = '{$date}', isAdmin = ";
        $sql .= $isAdmin ? 1 : 0;
        
        if (isset($password)) $sql .= ", pass = '{$password}'";
        if (isset($pathprofile)) $sql .= ", profileimg = '{$pathprofile}'";
        $sql .= " WHERE id LIKE {$id}";

        

        $result = $conexion->query($sql);
        
        if ($result) {
            $log = new Log("admin", 1);
            $log->write("[{$user['email']}] Usuari Modificat: " . $email . " - Dia: " . today() . " - Hora: " . now());
            $template = "default";
            header("Location: ?success=Registre actualitzat");
            die;
        } else {
            header("Location: ?error=Error al actualitzar el registre");
            die;
        }
    }

    if ($action == "new" && $_SERVER['REQUEST_METHOD'] === "POST") {
        $index = strpos($_SERVER['HTTP_REFERER'], "&error=");
        if (!!$index)
            $referer = substr($_SERVER['HTTP_REFERER'], 0, $index);
        else 
            $referer = $_SERVER['HTTP_REFERER'];


        $name = !empty($_POST['name']) ? $_POST['name'] : '';
        $surname = !empty($_POST['surname']) ? $_POST['surname'] : '';
        $email = !empty($_POST['email']) ? $_POST['email'] : '';
        $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
        $re_password = !empty($_POST['re-password']) ? $_POST['re-password'] : NULL;
        $type = !empty($_POST['type']) ? $_POST['type'] : 'normal';
        $isAdmin = !empty($_POST['isAdmin']) ? true : false;
        $date = (new \DateTime())->format('Y-m-d H:i:s');

    //Per a que funcione str_contains en versions de PHP menors de 8.0
        if (!function_exists('str_contains')) {
            function str_contains(string $haystack, string $needle): bool
            {
                return '' === $needle || false !== strpos($haystack, $needle);
            }
        }
        
        if ($email == '' || !str_contains($email, "@")) {
            header("Location: ?error=Email no vàlid");
            die();
        }

        if ($name == '') {
            header("Location: ?error=El nom no pot estar buit");
            die();
        }

        if ($password != $re_password) {
            header("Location: ?error=Les contrasenyes no coincideixen");
            die();
        }
        
        if (!empty($_FILES['profile-image']['size'])) {
            try {
              $pathprofile = uploadImage($email);
            } catch (\Exception $e) {
              header("Location: {$referer}&error={$e->getMessage()}");
              die;
            }
          }

        if (isset($password)) $password = password_hash($password, PASSWORD_DEFAULT);
        $existent = $conexion->query("SELECT * FROM usuarios WHERE email LIKE '$email'");
        
        if ($existent->num_rows > 0) {
            $conexion->desconectar();
            header("Location: ?error=Email existent");
            die();
        }

        $sql = "INSERT INTO usuarios (nombre, apellidos, email, type, date, pass, isAdmin".(isset($pathprofile) ? ", profileimg" : "").") VALUES ('{$name}', '{$surname}', '{$email}', '{$type}', '{$date}', '{$password}', " . ($isAdmin ? "1" : "0") . (isset($pathprofile) ? ", '{$pathprofile}'" : ""). ")";
       

        $result = $conexion->query($sql);
        
        if ($result) {
            $log = new Log("admin", 1);
            $log->write("[{$user['email']}] Usuari Creat: " . $email . " - Dia: " . today() . " - Hora: " . now());
            $template = "default";

            header("Location: ?success=Registre creat");
            die;
        } else {
            header("Location: ?error=Error al crear registre");
            die;
        }

    }

    if ($action == "backup" && $table != NULL) {
        $manager = new DataManager("usuarios", 1);
        if ($manager->backup()) {
            $log = new Log("admin", 1);
            $log->write("[{$user['email']}] Backup de {$table} - Dia: " . today() . " - Hora: " . now());
            $template = "default";
            header("Location: ?success=Backup realitzat amb exit");
            die;
        }

    }

    // $email = isset($_GET['email']) ? $_GET['email'] : NULL;
    // $email = $email == NULL ? $user['email'] : $email;
    
    
    function uploadImage($email) {
        $formats = ["png", "jpg", "gif", "jpeg"];

        $extension = explode(".",$_FILES['profile-image']['name']);
        $extension = $extension[sizeof($extension)-1];

        $rutaweb = "../../web/assets/img/profiles/";
        $ruta = "../assets/img/profiles/";
        $fileweb = "{$rutaweb}{$email}.{$extension}";
        $file = "{$ruta}{$email}.{$extension}";
        if ($_FILES['profile-image']['name'] == "") {
            throw new \Exception("No s'ha seleccionat cap imatge'.");
        } else {
            if (in_array($extension, $formats)) {
                if ($_FILES['profile-image']['size'] > 207200) {
                    throw new \Exception("L'arxiu pesa més de 200KB.");
                } else {
                    if ($_FILES['profile-image']['size'] == 0) {
                        throw new \Exception("L'arxiu està corrupte.");
                    } else {
                        foreach ($formats as $format) {
                            if (file_exists("../assets/img/profiles/{$email}.{$format}"))
                            unlink("../assets/img/profiles/{$email}.{$format}");
                        }
                        
                        move_uploaded_file($_FILES['profile-image']['tmp_name'], $file);
                        copy($file, $fileweb);
                        return $file;
                    }
                }
            } else {
                throw new \Exception("L'imatge no és de tipus: ' .jpg, .jpeg, .gif o .png.");
            }
        }

        return NULL;
    }

    function deleteImage($email) {
        foreach ($formats as $format) {
            if (file_exists("../assets/img/profiles/{$email}.{$format}"))
                unlink("../assets/img/profiles/{$email}.{$format}");
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/header.php'; ?>
        <?php 
            include $user != NULL
            ? 'includes/menu-admin.php' 
            : 'includes/menu.php';
        ?>

        <?php
            if ($action == "show_log" && $_SERVER['REQUEST_METHOD'] === "GET") $template = "log";
            if ($action == "update" && $_SERVER['REQUEST_METHOD'] === "GET") $template = "user";
            if ($action == "new" && $_SERVER['REQUEST_METHOD'] === "GET") $template = "new";

            switch ($template) {
                case "user":
                    $sql = "SELECT * FROM usuarios WHERE id = {$id}";
                    $userTemplate = $conexion->query($sql)->fetch_assoc();
                case "new":
                    include 'templates/modificarUsuario.php';
                    break;
                case "building":
                    include 'templates/building.php';
                    break;
                case "log":
                    include 'templates/show_log.php';
                    break;
                case "default":
                default:
                    include $user == NULL
                    ? 'templates/login.php'
                    : 'templates/home.php';
                    break;
            }

        ?>
        
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
<?php 
    $conexion->desconectar();
?>