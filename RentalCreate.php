<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $rentalID = isset($_POST['rentalID']) && !empty($_POST['rentalID']) && $_POST['rentalID'] != 'auto' ? $_POST['rentalID'] : NULL;
    $locDate = isset($_POST['locDate']) ? $_POST['locDate'] : '';
    $sDate = isset($_POST['sDate']) ? $_POST['sDate'] : '';
    $eDate = isset($_POST['eDate']) ? $_POST['eDate'] : '';
    $rentalType = isset($_POST['rentalType']) ? $_POST['rentalType'] : '';
    $immat = isset($_POST['immat']) ? $_POST['immat'] : '';
    $idClient = isset($_POST['idClient']) ? $_POST['idClient'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO rental VALUES (?, ?, ?, ?, ? ,? ,?);');
    $stmt->execute([$rentalID, $locDate, $sDate, $eDate, $rentalType,$immat,$idClient]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Rental')?>

<div class="content update">
  <h2> Insert New Rental</h2>
  <form action="RentalCreate.php" method="POST">
    <label for="rentalID">Rental ID</label>
    <input type="text" name="rentalID" placeholder="For exemple: 000001" id="rentalID">

    <label for="locDate">Locaction Date :</label>
    <input type="date" name="locDate"  id="locDate">

    <label for="sDate">Starting Date</label>
    <input type="date" name="sDate"  id="sDate">

    <label for="eDate">Ending Date : </label>
    <input type="date" name="eDate"  id="eDate">

    <label for="rentalType">Type of the rental </label>
    <input type="text" name="rentalType" placeholder="WD / ND" id="rentalType">

    <label for="immat">Immat of the car </label>
    <input type="text" name="immat" placeholder="000009" id="immat">

    <label for="idClient">Client ID</label>
    <input type="text" name="idClient" placeholder="000009" id="idClient">

    

    <input type="submit" value="Insert a new Rental">

  </form>

  <?php if ($msg): ?>
  <p><?=$msg?></p>
  <?php endif; ?>

</div>

<?=template_footer()?>