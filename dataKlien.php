<?php
require_once 'koneksi.php';

$klienId = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['klien']) && $_GET['klien']) {
    // Get the selected client ID
    $selectedKlien = $_GET['klien'];

    // Prepare a SQL query to fetch the client details
    $query = "SELECT * FROM dataKlien WHERE idKlien = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedKlien);
    $stmt->execute();

    // Fetch the data of the selected client
    $result = $stmt->get_result();
    $clientData = $result->fetch_assoc();

    $klienId = $_GET['klien'];
}

// Check if a search query is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    // Modify the SQL query to include the search condition
    $query = "SELECT * FROM dataklien WHERE namaKlien LIKE ? OR noRM LIKE ? OR noKTP LIKE ?";
    $stmt = $conn->prepare($query);
    $likeParam = "%$search%";
    $stmt->bind_param("sss", $likeParam, $likeParam, $likeParam);
    $stmt->execute();

    $searchResult = $stmt->get_result();
} else {
    // Default query without search condition
    $query = "SELECT * FROM dataklien";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $searchResult = $stmt->get_result();
}

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



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

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
                            <a class="nav-link" href="catatanEval.php">
                                Catatan Harian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dataKlien.php">
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
                                <input type="text" name="search" placeholder="Cari Data Klien">
                                <button type="submit" style="background-color: orange;">Cari</button>
                            </form>
                        </div>
                        <div class="button-edit">
                            <button style="background-color: orange;" type="button" onclick="window.location.href='tambahDataKlien.php'">Tambah Data</button>
                            <button style="background-color: orange;" type="button" onclick="myPrint('myform')" value="print">Cetak Data Klien</button>
                            <button style="background-color: orange;" type="button" onclick="tableToExcel()">Excel</button>
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
                    <table class="table" id="myform">
                        <thead>
                            <tr>
                            <th>No. RM</th>
                            <th>No. KTP</th>
                            <th>Nama Klien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Tanggal Masuk</th>
                            <th>Kondisi Awal</th>
                            <th>Foto Klien</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($searchResult->num_rows > 0) {
                                while ($row = $searchResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["noRM"] . "</td>";
                                    echo "<td>" . $row["noKTP"] . "</td>";
                                    echo "<td>" . $row["namaKlien"] . "</td>";
                                    echo "<td>" . $row["jkKlien"] . "</td>";
                                    echo "<td>" . $row["tempatLahirKlien"] . "</td>";
                                    echo "<td>" . date('d/m/Y', strtotime($row["tglLahirKlien"])) . "</td>";
                                    echo "<td>" . $row["alamat"] . "</td>";
                                    echo "<td>" . date('d/m/Y', strtotime($row["tglMasuk"])) . "</td>";

                                    // Kondisi Awal
                                    echo "<td>";
                                    if (isset($row["kondisiAwl"])) {
                                        echo $row["kondisiAwl"];
                                    } else {
                                        echo "Tidak ada data";
                                    }
                                    echo "</td>";

                                    // Foto Klien
                                    echo "<td>";
                                    if (isset($row["fotoKlien"])) {
                                        echo "<img src='data:image/jpeg;base64," . base64_encode($row["fotoKlien"]) . "' alt='Foto Klien' width='100px' height='100px'>";
                                    } else {
                                        echo "Tidak ada data";
                                    }
                                    echo "</td>";

                                    echo "<td>" . $row["status"] . "</td>";

                                    // Action dengan tombol edit (icon)
                                    echo "<td>";
                                    if (isset($row["idKlien"])) {
                                        echo "<a href='editKlien.php?id=" . $row["idKlien"] . "' class='btn btn-primary'><i class='bi bi-pencil'></i></a>";
                                        echo "<a href='cetakPdf.php?id=" . $row["idKlien"] . "' class='btn btn-secondary'><i class='bi bi-file-text'></i></a>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='12'>Tidak ada data klien yang tersedia.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
        function myPrint(myform){
            var printdata = document.getElementById(myform);
            newwin=window.open("");
            newwin.document.write(printdata.outerHTML);
            newwin.print();
            newwin.close();
        }
    </script>

</body>

</html>