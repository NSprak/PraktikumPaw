<?php

require_once __DIR__ . '/config.php';

if (!isset($_GET['id'])) {
  header('Location: ./transactions.php');
  exit();
}

$id = $_GET['id'];

$query = "SELECT *, customers.name as c_name, products.name as p_name, transaction_items.qty as ti_qty FROM transactions, transaction_items, customers, products WHERE transactions.id = $id AND customers.id = transactions.customer_id AND transaction_items.transaction_id = transactions.id AND products.id = transaction_items.product_id";
$result = mysqli_query($conn, $query);
$transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Praktikum PAW</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>

  <div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h1 class="fs-2">Transaction Details</h1>
    </div>

    <div class="mb-4">
      <div class="row">
        <div class="col">
          <div class="row mb-3">
            <label for="customer" class="col-sm-3 col-form-label">Customer:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" id="customer" value="<?= $transactions[0]['c_name'] ?>" readonly />
            </div>
          </div>
          <div class="row mb-3">
            <label for="purchased-at" class="col-sm-3 col-form-label">Purchased at:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" id="purchased-at" value="<?= date('j M Y', strtotime($transactions[0]['purchased_at'])) ?>" readonly />
            </div>
          </div>
        </div>
        <div class="col">
          <div class="row mb-3">
            <label for="total" class="col-sm-3 col-form-label">Total:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control-plaintext" id="total" value="<?= $transactions[0]['total'] ?>" readonly />
            </div>
          </div>
        </div>
      </div>
    </div>
    <table class="table table-striped table-bordered mb-4">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product</th>
          <th scope="col">Price</th>
          <th scope="col">Qty</th>
          <th scope="col">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($transactions as $transaction_item) : ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $transaction_item['p_name'] ?></td>
            <td><?= $transaction_item['price'] ?></td>
            <td><?= $transaction_item['ti_qty'] ?></td>
            <td><?= $transaction_item['subtotal'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="./transactions.php" class="btn btn-outline-secondary">Back</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>