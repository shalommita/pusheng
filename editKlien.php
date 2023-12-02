<?php
require_once 'koneksi.php';

$noRM = $noKTP = $namaKlien = $jkKlien = $tempatLahirKlien = $tglLahirKlien = $alamat = $tglMasuk = $kondisiAwal = $status = '';
$error = '';

// Retrieve data for editing (GET request)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $dummy_id = $_GET['id'];
    $query = "SELECT * FROM dataklien WHERE idKlien = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $dummy_id); // Assuming 'id' is an integer, adjust if it's another type
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Assign retrieved data to variables
    $noRM = $row['noRM'];
    $noKTP = $row['noKTP'];
    $namaKlien = $row['namaKlien'];
    $jkKlien = $row['jkKlien'];
    $tempatLahirKlien = $row['tempatLahirKlien'];
    $tglLahirKlien = $row['tglLahirKlien'];
    $alamat = $row['alamat'];
    $tglMasuk = $row['tglMasuk'];
    $kondisiAwal = $row['kondisiAwl'];
    $status = $row['status'];
    // Uncomment if storing image data in the database
    // $fotoKlienContent = $row['fotoKlien'];
}

// Update data (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $noRM = $_POST['noRM'];
    $noKTP = $_POST['noKTP'];
    $namaKlien = $_POST['namaKlien'];
    $jkKlien = $_POST['jkKlien'];
    $tempatLahirKlien = $_POST['tempatLahirKlien'];
    $tglLahirKlien = $_POST['tglLahirKlien'];
    $alamat = $_POST['alamat'];
    $tglMasuk = $_POST['tglMasuk'];
    $kondisiAwal = $_POST['kondisiAwl'];
    $status = $_POST['status'];

    // Uncomment if handling photo data
    // $fotoKlien = $_FILES['fotoKlien']['tmp_name'];
    // $fotoKlienContent = file_get_contents($fotoKlien);

    // Update query
    $query = "UPDATE dataklien 
              SET noRM=?, noKTP=?, namaKlien=?, jkKlien=?, tempatLahirKlien=?, tglLahirKlien=?, alamat=?, tglMasuk=?, kondisiAwl=?, status=?
              WHERE idKlien=?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssi", $noRM, $noKTP, $namaKlien, $jkKlien, $tempatLahirKlien, $tglLahirKlien, $alamat, $tglMasuk, $kondisiAwal, $status, $dummy_id);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: dataKlien.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
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
    <title>Edit Data Klien</title>
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

    </style>

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
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
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
                            <a class="nav-link active" href="editKlien.php">
                                Edit Data Klien
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
                <!-- Main content -->
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dataKlien.php">Data Klien</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Klien</li>
                        </ol>
                    </nav>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card">
                                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h5 class="card-title">Edit Data Klien</h5>
                                        <!-- Form fields here -->
                                        <!-- No. RM Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">No. RM</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="noRM" value="<?php echo $noRM; ?>" required>
                                            </div>
                                        </div>

                                        <!-- No. KTP Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">No. KTP</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="noKTP" value="<?php echo $noKTP; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Nama Klien Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Nama Klien</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="namaKlien" value="<?php echo $namaKlien; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Jenis Kelamin Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Jenis Kelamin</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="jkKlien" required>
                                                    <option value="Perempuan" <?php if ($jkKlien == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                    <option value="Laki-laki" <?php if ($jkKlien == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Tempat Lahir Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Tempat Lahir</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="tempatLahirKlien" value="<?php echo $tempatLahirKlien; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Tanggal Lahir Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Tanggal Lahir</label>
                                            <div class="col-md-10">
                                                <input type="date" class="form-control" name="tglLahirKlien" value="<?php echo $tglLahirKlien; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Alamat Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Alamat</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Tanggal Masuk Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Tanggal Masuk</label>
                                            <div class="col-md-10">
                                                <input type="date" class="form-control" name="tglMasuk" value="<?php echo $tglMasuk; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Kondisi Awal Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Kondisi Awal</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="kondisiAwal" value="<?php echo $kondisiAwal; ?>">
                                            </div>
                                        </div>

                                        <!-- Foto Klien Field -->
                                        <!-- You can add your photo input field here -->

                                        <!-- Status Field -->
                                        <div class="form-group row mb-3 align-items-center">
                                            <label class="col-md-2">Status</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="status" required>
                                                    <option value="Aktif" <?php if ($status == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                                    <option value="Non Aktif" <?php if ($status == 'Non Aktif') echo 'selected'; ?>>Non Aktif</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Add other form fields here -->

                                    </div>
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn-primary" style="background-color: orange; border-color:orange;">Update Data Klien</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
