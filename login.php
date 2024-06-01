<?php 
require 'config/connection.php';
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $pw = $_POST['password'];

    $users = mysqli_query($conn,"SELECT * FROM customers WHERE email = '$email' ");

    $user = mysqli_fetch_assoc($users);
    if ($user > 0){
        if($user['password'] == md5($pw) ){
            $_SESSION['login'] = $user['id'];
            echo "<script>
            alert('Berhasil Login');
            document.location.href = 'index.php';
            </script>";
        }else {
            echo "<script>
            alert('password tidak valid');
            document.location.href = 'login.php';
            </script>";
        }
        
    }else {
        echo "<script>
            alert('email yang anda masukkan tidak valid');
            document.location.href = 'login.php';
        </script>";
    }
   
}


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

        <div class="w-full p-40 dark: bg-gray-700 h-screen">
            <form method="POST" action=""  class="max-w-sm mx-auto">
              
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="your email"  />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                </div>
              
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    
      


</body>
</html>
