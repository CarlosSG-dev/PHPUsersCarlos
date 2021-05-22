<?php 
  require_once '../utils/Conexio.php';
  $conexion = new Conexio();
  $conexion->conectar();
?>
<main id="admin">
  <div class="title">
      <p>Hola, <?= $user['email'] ?> <a href="processos/processLogout.php">Log Out</a></p>
  </div>
  <div class="title" >
    <p>Usuaris Hosting</p>
  </div>


  <table class="table table-hover container">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Apellidos</th>
        <th>E-mail</th>
        <th>Tipus de compte</th>
        <th>Data de creació</th>
        <th>Es Admin</th>
        <th>Acció</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql = "SELECT * FROM usuarios";
        $results = $conexion->query($sql);

        foreach($results as $result) {
      ?>
      <tr>
        <td><?= $result['id'] ?></td>
        <td><?= $result['nombre'] ?></td>
        <td><?= $result['apellidos'] ?></td>
        <td><?= $result['email'] ?></td>
        <td><?= $result['type'] ?></td>
        <td><?= $result['date'] ?></td>
        <td><?= $result['isAdmin'] == 1 ? 'SI' : 'NO' ?></td>
        <td>
          <div class="icon edit" onclick="edit(<?= $result['id'] ?>)"></div>
          <div class="icon delete" onclick="remove(<?= $result['id'] ?>)"></div>
        </td>
      </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="8">
          <div style="display:flex;align-items:center;justify-content:center">
            <div style="display:flex;align-items:center;">
              <div class="icon adduser"></div>
              <a href="?action=new">Anyadir usuari</a>
            </div>
            <div style="display:flex;align-items:center;padding:0 1em">
              <div class="icon backup"></div>
              <a href="?action=backup&table=usuarios">Fer backup d'usuaris</a>
            </div>
            <div style="display:flex;align-items:center;">
              <div class="icon logicon"></div>
              <a href="?action=show_log">Visualitzar el Log</a>
            </div>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
</main>
<script>
  function edit(id) {
    window.location.href = `?action=update&id=${id}`;
  }

  function remove(id) {
    let res = confirm(`Vols eliminar l'usuari amb id: ${id}?`);
    if (res) window.location.href = `?action=delete&id=${id}`;
  }
</script>
<?php
 $conexion->desconectar();
?>