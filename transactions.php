<?php

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['transaction_id'];

  $query = "DELETE FROM transaction_items WHERE transaction_id = $id";
  mysqli_query($conn, $query);

  $query = "DELETE FROM transactions WHERE id = $id";
  mysqli_query($conn, $query);

  header('Location: ./transactions.php');
  exit();
}

$query = 'SELECT transactions.id as t_id, transactions.purchased_at as t_purchased_at, transactions.total as t_total, customers.name as c_name FROM transactions, customers WHERE transactions.customer_id = customers.id';
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
      <h1 class="fs-2">Transactions</h1>
      <a href="./transaction-add.php" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Customer</th>
          <th scope="col">Purchased at</th>
          <th scope="col">Total</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($transactions as $transaction) : ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $transaction['c_name'] ?></td>
            <td><?= date('j M Y', strtotime($transaction['t_purchased_at'])) ?></td>
            <td><?= $transaction['t_total'] ?></td>
            <td class="d-flex gap-1">
              <a href="./transaction.php?id=<?= $transaction['t_id'] ?>" class="btn btn-sm btn-outline-primary">Details</a>
              <form action="" method="post">
                <input type="hidden" name="transaction_id" value="<?= $transaction['t_id'] ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>