<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
//  default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Prepare the SQL statement and get records from our contacts table
$stmt = $pdo->prepare('SELECT * FROM car ORDER BY immat ');
$stmt->execute();
// Fetch the records so we can display them in our template.
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of cars
$num_cars = $pdo->query('SELECT COUNT(*) FROM car')->fetchColumn();
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?=template_header('Car')?>

<div class="content read">  <Center> 
  <h2> Cars Catalogue </h2>

  <table>
    <thead>
      <tr>
        <td>#</td>
        <td>Brand </td>
        <td>Model</td>
        <td>Price per one day</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cars as $car): ?>
      <tr>
        <td><?=$car['immat']?></td>
        <td><?=$car['brand']?></td>
        <td><?=$car['model']?></td>
        <td><?=$car['priceByDay']?></td>
        <td class="actions">
          <a href="CarUpdate.php?immat=<?=$car['immat']?>" class="edit" ><i class="fas fa-pen fa-xs"></i></a>
          <a href="CarDelete.php?immat=<?=$car['immat']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="CarCreate.php" class="create-contact">Insert New Car</a>
  <a href="CarRetrieve.php" class="create-contact">Retrieve based on the model </a>
  <a href="CarRetrieve.php" class="create-contact">Retrieve based on the model with stored procedure </a> 

</div>

<?=template_footer()?>