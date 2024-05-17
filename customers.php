<?php

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $query = "DELETE FROM customers WHERE id = $id";
  mysqli_query($conn, $query);

  if (mysqli_affected_rows($conn) == 1) {
    header('Location: ./customers.php');
    exit();
  }
}

$query = 'SELECT * FROM `customers`';
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
      <h1 class="fs-2">Customers</h1>
      <a href="./customer-add.php" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($customers as $customer) : ?>
          <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><?= $customer['name'] ?></td>
            <td><?= $customer['phone'] ?></td>
            <td><?= $customer['address'] ?></td>
            <td class="d-flex gap-1">
              <a href="./customer-edit.php?id=<?= $customer['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $customer['id'] ?>">
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