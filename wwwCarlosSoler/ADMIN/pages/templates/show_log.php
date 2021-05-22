<div class="log">
<?php
    $email = $user['email'];
    $log = new Log("admin", 1);
    $lines = $log->read();
    foreach(array_reverse($lines) as $line) {
      //if (preg_match("/$email/i", $line)) {
        echo "<p>" . $line . "</p>";
      //}
    }
?>
</div>
<div class="title">
    <a href="admin.php">Ocultar Log</a>
</div>