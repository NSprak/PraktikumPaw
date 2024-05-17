<?php

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $customer_id = $_POST['customer_id'];
  $product_ids = $_POST['product_ids'];
  $quantities = $_POST['quantities'];

  $current_timestamp = date('Y-m-d H:i:s');

  $query = "INSERT INTO transactions(customer_id, purchased_at, total) VALUES ('$customer_id','$current_timestamp','0')";
  mysqli_query($conn, $query);

  $transaction_id = mysqli_insert_id($conn);
  $total = 0;

  foreach ($product_ids as $key => $product_id) {
    $qty = $quantities[$key];

    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    $subtotal = $product['price'] * $qty;
    $total += $subtotal;

    $query = "INSERT INTO transaction_items(transaction_id, product_id, qty, subtotal) VALUES ('$transaction_id','$product_id','$qty','$subtotal')";
    mysqli_query($conn, $query);
  }

  $query = "UPDATE transactions SET total='$total' WHERE id = $transaction_id";
  mysqli_query($conn, $query);

  header('Location: ./transactions.php');
  exit();
}

$query = 'SELECT * FROM customers';
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = 'SELECT * FROM products';
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
      <h1 class="fs-2">Transaction Add</h1>
    </div>

    <form action="" method="post" class="w-50 mx-auto">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Customer</label>
        <select id="exampleFormControlInput1" class="form-select" aria-label="Default select example" name="customer_id">
          <option value="" disabled selected>--- Select customer ---</option>
          <?php foreach ($customers as $customer) : ?>
            <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="products">
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="exampleFormControlInput2" class="form-label">Product</label>
              <select id="exampleFormControlInput2" class="form-select" aria-label="Default select example" name="product_ids[]">
                <option value="" disabled selected>
                  --- Select product ---
                </option>
                <?php foreach ($products as $product) : ?>
                  <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col">
              <label for="exampleFormControlInput3" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="exampleFormControlInput3" name="quantities[]" />
            </div>
            <div class="col-auto align-self-end">
              <button type="button" class="btn btn-outline-danger remove-product" onclick="removeProduct(this)">
                X
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3 text-end">
        <button type="button" class="btn btn-outline-primary add-product">
          +
        </button>
      </div>
      <div class="mt-4">
        <a href="./transactions.php" class="btn btn-outline-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    const removeProduct = (e) => {
      e.parentElement.parentElement.parentElement.remove();
    };

    const products = document.querySelector(".products");
    const addBtn = document.querySelector(".add-product");
    let i = 4;

    addBtn.addEventListener("click", () => {
      const newProduct = document.createElement("div");
      newProduct.classList.add("mb-3");
      newProduct.innerHTML = `
            <div class="row">
              <div class="col">
                <label for="exampleFormControlInput${i}" class="form-label"
                  >Product</label
                >
                <select
                  id="exampleFormControlInput${i}"
                  class="form-select"
                  aria-label="Default select example"
                  name="product_ids[]"
                >
                  <option value="" disabled selected>
                    --- Select product ---
                  </option>
                  <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col">
                <label for="exampleFormControlInput${i + 1}" class="form-label"
                  >Quantity</label
                >
                <input
                  type="number"
                  class="form-control"
                  id="exampleFormControlInput${i + 1}"
                  name="quantities[]"
                />
              </div>
              <div class="col-auto align-self-end">
                <button
                  type="button"
                  class="btn btn-outline-danger remove-product"
                  onclick="removeProduct(this)"
                >
                  X
                </button>
              </div>
            </div>
        `;

      products.appendChild(newProduct);
      i += 2;
    });
  </script>
</body>

</html>