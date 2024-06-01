<?php 

require '../config/connection.php';



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>



    <?php include 'sidebar.php'; ?>


    <div class="p-4 sm:ml-64 bg-gray-500 ">
        <div class="p-4 ">

            <div class="max-w-xlg w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                            </svg>
                        </div>
                        <div>
                            <?php 
                                $result2 = mysqli_query($conn,"SELECT COUNT(DISTINCT customer_id) as jumlah_customer,SUM(total) as total_pendapatan  FROM transactions ts");
                                $pendapatan = mysqli_fetch_assoc($result2);
                            ?>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1"> 
                                <?= $pendapatan['total_pendapatan']; ?>
                            <h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"> 
                                Customer yang melakukan transaksi : <?= $pendapatan['jumlah_customer'] ?>
                            </p>
                        </div>
                    </div>
                    <!-- date -->

                    <div class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>
                    </div>

                </div>



                <div id="column-chart">
                    <canvas class="w-140" id="myChart"></canvas>
                </div>
                

                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mb-4">
                    <div class="flex justify-between items-center pt-5">
                        <div class="relative overflow-x-auto  shadow-md sm:rounded-lg">
                            <table class="w-full text-sm  text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                      
                                
                                        
                                        <th scope="col" class="px-6 py-3">
                                            Purchased at
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = mysqli_query($conn,'SELECT CAST(ts.purchased_at as DATE)as tanggalTtransaksi , SUM(ts.total) as tTrans FROM transactions ts GROUP BY tanggalTtransaksi ');
                                        $tanggal = [];
                                        $total_penjualan = [];
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $tanggal[] = $row['tanggalTtransaksi'];
                                            $total_penjualan[] = $row['tTrans'];
                                        }
                                        
                                    
                                    ?>  

                                    <?php foreach ($result as $row_result): ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    
                                        <td class="px-6 py-4">
                                            <?= $row_result['tanggalTtransaksi'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                        <?= $row_result['tTrans'] ?>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    
                    <div class="flex justify-between items-center pt-5">
                    <button id="cetakTombol" onclick="window.print()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Print</button>
                        <a href="#" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Download
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script>
        var label_data = <?= json_encode($tanggal) ?>;
        var total = <?= json_encode($total_penjualan) ?>;
        var data = {
            labels: label_data,
            datasets: [{
                label: "Penjualan",
                data: total,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [

                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        var ctx =
            document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: options
        });


        
      
    </script>
</body>

</html>