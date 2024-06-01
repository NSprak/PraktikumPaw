<?php
require 'config/connection.php';
session_start();

if(isset($_SESSION['login'])){
    $id_user = $_SESSION['login'];
    echo $id_user;
}else {
        echo "<script>
            alert('anda harus login');
            document.location.href = 'login.php';
        </script>";
}


$product = mysqli_query($conn,'SELECT * FROM products');

$users = mysqli_query($conn, "SELECT * FROM customers WHERE id = $id_user");
$user = mysqli_fetch_assoc($users);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include 'partials/navbar.php' ?>
        <div class="w-full p-40">
            <div class="relative overflow-x-auto  shadow-md sm:rounded-lg">
                <table class="w-full text-sm  text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                qty
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($product as $row_product): ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $row_product['id']?>
                            </th>
                            <td class="px-6 py-4">
                            <?= $row_product['name']?>
                            </td>
                            <td class="px-6 py-4">
                            <?= $row_product['price']?>
                            </td>
                            <td class="px-6 py-4">
                            <?= $row_product['qty']?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    


</body>
</html>