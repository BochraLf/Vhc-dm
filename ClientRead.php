<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$stmt = $pdo->prepare('SELECT * FROM `client`ORDER BY idClient ');
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_clients = $pdo->query('SELECT COUNT(*) FROM client')->fetchColumn();
?>

<?=template_header('Client')?>

<div class="content read"> <CENTER>
  <h2>Client Register</h2>
  <table>
    <thead>
      <tr>
        <td>#</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Phone</td>
        <td>Street</td>
        <td>City</td>
        <td>Job</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($clients as $client): ?>
      <tr>
        <td><?=$client['idClient']?></td>
        <td><?=$client['fName']?></td>
        <td><?=$client['lName']?></td>
        <td><?=$client['phone']?></td>
        <td><?=$client['street']?></td>
        <td><?=$client['city']?></td>
        <td><?=$client['job']?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="ClientCreate.php" class="create-contact">Insert New Client</a>


</div>

<?=template_footer()?>