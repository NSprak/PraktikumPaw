<?php

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];

  $query = "INSERT INTO products(name, price, qty) VALUES ('$name','$price','$qty')";
  mysqli_query($conn, $query);

  if (mysqli_affected_rows($conn) == 1) {
    header('Location: ./products.php');
    exit();
  }
}

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
    <div class="d-flex align-items-center justify-content-center mb-4">
      <h1 class="fs-2">Product Add</h1>
    </div>

    <form action="" method="post" class="w-50 mx-auto">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Price</label>
        <input type="number" class="form-control" id="exampleFormControlInput2" name="price" />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="exampleFormControlInput3" name="qty" />
      </div>
      <div class="mt-4">
        <a href="./products.php" class="btn btn-outline-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>