<?php
require_once 'koneksi.php';

// Inisialisasi variabel
$idPemantau = $namaPemantau = $jkPemantau = $tempatLahirPemantau = $tglLahirPemantau = $peranPemantau = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $idPemantau = $_POST['idPemantau'];
    $namaPemantau = $_POST['namaPemantau'];
    $jkPemantau = $_POST['jkPemantau'];
    $tempatLahirPemantau = $_POST['tempatPemantau'];
    $tglLahirPemantau = $_POST['tglPemantau'];
    $peranPemantau = $_POST['peran'];

    // Validasi input
    if (empty($idPemantau) || empty($namaPemantau) || empty($jkPemantau) || empty($tempatLahirPemantau) || empty($tglLahirPemantau) || empty($peranPemantau)) {
        $error = "Semua kolom harus diisi!";
    } else {
        // Lakukan operasi INSERT ke database
        $query = "INSERT INTO datapemantau (idPemantau, namaPemantau, jkPemantau, tempatPemantau, tglPemantau, peran) 
          VALUES ('$idPemantau', '$namaPemantau', '$jkPemantau', '$tempatLahirPemantau', '$tglLahirPemantau', '$peranPemantau')";

        if (mysqli_query($conn, $query)) {
            header("Location: datapemantau.php"); // Redirect ke halaman datapemantau setelah berhasil
            exit();
        } else {
            $error = "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
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

        button a {
            text-decoration: none;
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dataPemantau.php">Data Pemantau</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Pemantau</li>
                        </ol>
                    </nav>
                <!-- isi konten -->
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                    <<h5 class="card-title">Tambah Data Pemantau</h5>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">ID Pemantau</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="idPemantau" value="<?php echo $idPemantau; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">Nama Pemantau</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="namaPemantau" value="<?php echo $namaPemantau; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">Jenis Kelamin</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="jkPemantau" required>
                                                <option value="Perempuan" <?php if ($jkPemantau == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                <option value="Laki-laki" <?php if ($jkPemantau == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">Tempat Lahir</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="tempatPemantau" value="<?php echo $tempatLahirPemantau; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">Tanggal Lahir</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" name="tglPemantau" value="<?php echo $tglLahirPemantau; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 align-items-center">
                                        <label class="col-md-2">Peran</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="peran" required>
                                                <option value="pembina" <?php if ($peranPemantau == 'pembina') echo 'selected'; ?>>Pembina</option>
                                                <option value="psikoklinis" <?php if ($peranPemantau == 'psikoklinis') echo 'selected'; ?>>Psikolog Klinis</option>
                                                <option value="psikososial" <?php if ($peranPemantau == 'psikososial') echo 'selected'; ?>>Psikososial</option>
                                                <option value="asisten_medis" <?php if ($peranPemantau == 'asisten_medis') echo 'selected'; ?>>Asisten Medis</option>
                                                <option value="" <?php if (empty($peranPemantau)) echo 'selected'; ?>>Select Peran</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn-primary" style="background-color: orange; border-color:orange;">Tambah Data Pemantau</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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


</body>

</html>