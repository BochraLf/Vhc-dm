<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Prepare the SQL statement and get records from our contacts table
$stmt = $pdo->prepare('SELECT * FROM `rental` ORDER BY rentalID ');
$stmt->execute();
// Fetch the records so we can display them in our template.
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of rentals
$num_rentals = $pdo->query('SELECT COUNT(*) FROM rental')->fetchColumn();
?>

<?=template_header('Rental')?>

<div class="content read">  <CENTER>
  <h2>Rentals History</h2>
  <table>
    <thead>
      <tr>
        <td>#</td>
        <td>Location date</td>
        <td>Start date</td>
        <td>End date</td>
        <td>Rental Type</td>
        <td>Immat of the car</td>
        <td>ID of the client</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rentals as $car): ?>
      <tr>
        <td><?=$car['rentalID']?></td>
        <td><?=$car['locDate']?></td>
        <td><?=$car['sDate']?></td>
        <td><?=$car['eDate']?></td>
        <td><?=$car['rentalType']?></td>
        <td><?=$car['immat']?></td>
        <td><?=$car['idClient']?></td>
        <td class="actions">
          <a href="RentalUpdate.php?rentalID=<?=$car['rentalID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
          <a href="RentalDelete.php?rentalID=<?=$car['rentalID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="RentalCreate.php" class="create-contact">Insert New Rental</a>


</div>

<?=template_footer()?>