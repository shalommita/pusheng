<?php
include 'koneksi.php';

// Number of records per page
$records_per_page = 10;

// Get current page from URL, default is page 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $records_per_page;

$sql = "SELECT
            CONCAT(a.waktuCatat, ' - ', 'Kognitif') AS waktuCatat,
            a.skor AS skor,
            a.kategori AS kategori,
            a.catatanEval AS catatanEval
        FROM evalkognitif a
        UNION
        SELECT
            CONCAT(b.waktuCatat, ' - ', 'Perilaku') AS waktuCatat,
            b.skor AS skor,
            b.kategori AS kategori,
            b.catatanEval AS catatanEval
        FROM evalperilaku b
        UNION
        SELECT
            CONCAT(c.waktuCatat, ' - ', 'Emosional') AS waktuCatat,
            c.skor AS skor,
            c.kategori AS kategori,
            c.catatanEval AS catatanEval
        FROM evalemosional c
        UNION
        SELECT
            CONCAT(d.waktuCatat, ' - ', 'Medis') AS waktuCatat,
            d.skor AS skor,
            d.kategori AS kategori,
            d.catatanEval AS catatanEval
        FROM evalmedis d
        ORDER BY waktuCatat DESC
        LIMIT $offset, $records_per_page";

$result = mysqli_query($conn, $sql);

// Fetch all the data to check the total number of rows
$all_data_query = "SELECT * FROM ({$sql}) AS temp";
$all_data_result = mysqli_query($conn, $all_data_query);
$total_records = mysqli_num_rows($all_data_result);

// Calculate total number of pages
$total_pages = ceil($total_records / $records_per_page);

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Pondok Pemulihan</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rqDRuBu40AqDpeiZm3pO58DJMCWeI3pbCkYbWEWt8bbKh1WLAqD58pD1K0FO5+Fw" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Button styling */
        button {
            cursor: pointer;
            padding: 0.5rem 1rem;
            margin: 0.2rem;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        /* @media print {
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                border-collapse: collapse;
            }

            .table th, table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table th {
                background-color: #FFE69B;
                font-weight: bold;
                text-align: center;
            }

            tbody {
                background-color: #FFFAF3;
                text-align: left;
            }
        } */

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .btnMenu button.on {
            background-color: #007bff;
            /* Warna latar belakang untuk tombol aktif */
            color: #fff;
            /* Warna teks untuk tombol aktif */
        }

        .graph {
            padding: 10px;
            flex: 1;
            /* Membuat setiap kolom memiliki fleksibilitas yang sama */
            border: 1px solid #ccc;
            /* (opsional) Menambahkan border untuk kejelasan */
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th, table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table th {
            background-color: #FFE69B;
            font-weight: bold;
            text-align: center;
        }

        tbody {
            background-color: #FFFAF3;
            text-align: left;
        }

        /* Hover effect */
        tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pondok Pemulihan</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="jadwal.php">
                                Jadwal Harian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="catatanEval.php">
                                Catatan Harian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dataKlien.php">
                                Data Klien
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dataPemantau.php">
                                Data Pemantau
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <br><br>
                <div class="container-fluid">
                <!-- isi konten -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <form method="GET" action="">
                                <input type="text" name="search" placeholder="Cari Jenis Evaluasi">
                                <button type="submit" style="background-color: orange;">Cari</button>
                            </form>
                        </div>
                        <div class="button-edit">
                            <button style="background-color: orange;" type="button" onclick="window.location.href='tambahDataCatatan.php'">Tambah Data</button>
                        </div>
                    </div>

                    <script type="text/javascript" src="dist/js/table2excel.js"></script>
                    <script>
                        function tableToExcel(){
                            var table2excel = new Table2Excel();
                            table2excel.export(document.querySelectorAll("table.table"));
                        }
                    </script>

                    <!-- =================Tabel=============== -->
                    <br>
                    <table class="table" id="myformPemantau">
                        <thead>
                            <tr>
                                <th>Waktu Catat - Jenis Evaluasi</th>
                                <th>Skor</th>
                                <th>Kategori</th>
                                <th>Catatan Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php

                            // Change this block of code where you display the date
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                // Convert the date format
                                $formattedDate = date('d/m/Y', strtotime($row['waktuCatat']));
                                echo '<td>' . $formattedDate . ' - ' . $row['kategori'] . '</td>';
                                echo '<td>' . $row['skor'] . '</td>';
                                echo '<td>' . $row['kategori'] . '</td>';
                                echo '<td>' . $row['catatanEval'] . '</td>';
                                echo '</tr>';
                            }
                            // if ($result) {
                            //     while ($row = mysqli_fetch_assoc($result)) {
                            //         echo '<tr>';
                            //         echo '<td>' . $row['waktuCatat'] . '</td>';
                            //         echo '<td>' . $row['skor'] . '</td>';
                            //         echo '<td>' . $row['kategori'] . '</td>';
                            //         echo '<td>' . $row['catatanEval'] . '</td>';
                            //         echo '</tr>';
                            //     }
                            // } else {
                            //     echo '<tr><td colspan="4">Error: ' . mysqli_error($conn) . '</td></tr>';
                            // }
                            ?>
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <ul class="pagination">
                        <?php
                        // Previous link
                        $prev_page = $page - 1;
                        if ($prev_page > 0) {
                            echo "<li class='page-item'><a class='page-link' href='catatanEval.php?page=$prev_page'>&laquo; Previous</a></li>";
                        }

                        // Page links
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='catatanEval.php?page=$i'>$i</a></li>";
                        }

                        // Next link
                        $next_page = $page + 1;
                        if ($next_page <= $total_pages) {
                            echo "<li class='page-item'><a class='page-link' href='catatanEval.php?page=$next_page'>Next &raquo;</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </main>
        </div>
    </div>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-o53vqJDzg1R6bD5b2XxRl5qmZz9p5ZWFrN1aCk4fFA4gIFBvcR5JNA2yo8hEAAJ3" crossorigin="anonymous"></script>

    <script>
        function myPrint(myformPemantau){
            var printdata = document.getElementById(myformPemantau);
            newwin=window.open("");
            newwin.document.write('<html><head><title>Cetak Data Pemantau</title></head><body>');
            newwin.document.write(printdata.outerHTML);
            newwin.document.write('</body></html>');
            newwin.print();
            newwin.close();
        }
    </script>

</body>

</html>