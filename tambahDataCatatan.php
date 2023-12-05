<?php
session_abort();

require_once 'koneksi.php';

$servername = "localhost";
$database = "dashboard_pondok";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulir Evaluasi Emosional
    $idEmosi = $_POST['idEmosi'];
    $idKognitif = $_POST['idKognitif'];
    $idPerilaku = $_POST['idPerilaku'];
    $idMedis = $_POST['idMedis'];
    $idKlien = $_POST['idKlien'];
    $idJadwal = $_POST['idJadwal'];
    $idPemantau = $_POST['idPemantau'];
    $catatanEvaluasi = $_POST['catatanEval'];
    $kategori = $_POST['kategori'];
    $skor = $_POST['skor'];
    $waktuCatat = $_POST['waktuCatat'];
    $obatDiminum = $_POST['obatDiminum'];
    $dosisObat = $_POST['dosisObat'];

    if (isset($_POST['evalEmosional'])) {
      $idEmosi = $_POST['idEmosi'];

      $sql = "INSERT INTO evalEmosional (idEmosi, idKlien, idJadwal, idPemantau, catatanEval, kategori, skor, waktuCatat)
              VALUES ('$idEmosi', '$idKlien', '$idJadwal', '$idPemantau', '$catatanEvaluasi', '$kategori', '$skor', '$waktuCatat')";
    } elseif (isset($_POST['evalKognitif'])) {
        $idMedis = $_POST['idKognitif'];

        $sql = "INSERT INTO evalKognitif (idKognitif, idKlien, idJadwal, idPemantau, catatanEval, kategori, skor, waktuCatat)
                VALUES ('$idKognitif', '$idKlien', '$idJadwal', '$idPemantau', '$catatanEvaluasi', '$kategori', '$skor', '$waktuCatat')";
    }
    if (isset($_POST['evalPerilaku'])) {
      $idEmosi = $_POST['idPerilaku'];

      $sql = "INSERT INTO evalPerilaku (idPerilaku, idKlien, idJadwal, idPemantau, catatanEval, kategori, skor, waktuCatat)
              VALUES ('$idPerilaku', '$idKlien', '$idJadwal', '$idPemantau', '$catatanEvaluasi', '$kategori', '$skor', '$waktuCatat')";
    } elseif (isset($_POST['evalMedis'])) {
        $idMedis = $_POST['idMedis'];

        $sql = "INSERT INTO evalMedis (idMedis, idKlien, idJadwal, idPemantau, catatanEval, obatDiminum, dosisObat, kategori, skor, waktuCatat)
                VALUES ('$idMedis', '$idKlien', '$idJadwal', '$idPemantau', '$catatanEvaluasi', '$obatDiminum', '$dosisObat', '$kategori', '$skor', '$waktuCatat')";
    }

    if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // Simpan informasi yang diperlukan dalam session
        $_SESSION['lastInsertedId'] = $conn->insert_id;
    }
  
}

$conn->close();
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
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f1f1f1;
    }

    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }

    h1 {
      text-align: center;  
    }

    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    select,
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: orange;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    #prevBtn {
      background-color: orange;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;  
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #04AA6D;
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="catatanEval.php">Catatan Evaluasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Catatan Baru</li>
                        </ol>
                    </nav>
                <!-- isi konten -->
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <form id="regForm" action="">
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                <h1>Pengisian Form Evaluasi Emosional</h1>
                                  <h4>ID Emosi:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Emosi (angka)" oninput="this.className = ''" name="idEmosi"></p>
                                  <h4>ID Klien:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Klien (angka)" oninput="this.className = ''" name="idKlien"></p>
                                  <h4>ID Jadwal:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Jadwal (angka)" oninput="this.className = ''" name="idJadwal"></p>
                                  <h4>ID Pemantau:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Pemantau (angka)" oninput="this.className = ''" name="idPemantau"></p>
                                  <h4>Catatan Evaluasi:</h4>
                                  <p><textarea placeholder="Masukkan Catatan Evaluasi" oninput="this.className = ''" name="catatanEvaluasi"></textarea></p>
                                  <h4>Pilih Kategori:</h4>
                                  <p>
                                      <select placeholder="Kategori" oninput="this.className = ''" name="kategori">
                                          <option value="Salomo">Salomo</option>
                                          <option value="Victory">Victory</option>
                                          <option value="Istimewa">Istimewa</option>
                                      </select>
                                  </p>
                                  <h4>Skor Emosi:</h4>
                                  <p><input type="number" placeholder="Skor" oninput="this.className = ''" name="skor"></p>
                                  <h4>Waktu Catat:</h4>
                                  <p><input type="datetime-local" placeholder="Waktu Catat" oninput="this.className = ''" name="waktuCatat"></p>
                                </div>
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                <h1>Pengisian Form Evaluasi Kognitif</h1>
                                  <h4>ID Kognitif:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Emosi (angka)" oninput="this.className = ''" name="idEmosi"></p>
                                  <h4>ID Klien:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Klien (angka)" oninput="this.className = ''" name="idKlien"></p>
                                  <h4>ID Jadwal:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Jadwal (angka)" oninput="this.className = ''" name="idJadwal"></p>
                                  <h4>ID Pemantau:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Pemantau (angka)" oninput="this.className = ''" name="idPemantau"></p>
                                  <h4>Catatan Evaluasi:</h4>
                                  <p><textarea placeholder="Masukkan Catatan Evaluasi" oninput="this.className = ''" name="catatanEvaluasi"></textarea></p>
                                  <h4>Pilih Kategori:</h4>
                                  <p>
                                      <select placeholder="Kategori" oninput="this.className = ''" name="kategori">
                                          <option value="Salomo">Salomo</option>
                                          <option value="Victory">Victory</option>
                                          <option value="Istimewa">Istimewa</option>
                                      </select>
                                  </p>
                                  <h4>Skor Kognitif:</h4>
                                  <p><input type="number" placeholder="Skor" oninput="this.className = ''" name="skor"></p>
                                  <h4>Waktu Catat:</h4>
                                  <p><input type="datetime-local" placeholder="Waktu Catat" oninput="this.className = ''" name="waktuCatat"></p>
                                </div>
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                <h1>Pengisian Form Evaluasi Perilaku</h1>
                                  <h4>ID Perilaku:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Emosi (angka)" oninput="this.className = ''" name="idEmosi"></p>
                                  <h4>ID Klien:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Klien (angka)" oninput="this.className = ''" name="idKlien"></p>
                                  <h4>ID Jadwal:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Jadwal (angka)" oninput="this.className = ''" name="idJadwal"></p>
                                  <h4>ID Pemantau:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Pemantau (angka)" oninput="this.className = ''" name="idPemantau"></p>
                                  <h4>Catatan Evaluasi:</h4>
                                  <p><textarea placeholder="Masukkan Catatan Evaluasi" oninput="this.className = ''" name="catatanEvaluasi"></textarea></p>
                                  <h4>Pilih Kategori:</h4>
                                  <p>
                                      <select placeholder="Kategori" oninput="this.className = ''" name="kategori">
                                          <option value="Salomo">Salomo</option>
                                          <option value="Victory">Victory</option>
                                          <option value="Istimewa">Istimewa</option>
                                      </select>
                                  </p>
                                  <h4>Skor Perilaku:</h4>
                                  <p><input type="number" placeholder="Skor" oninput="this.className = ''" name="skor"></p>
                                  <h4>Waktu Catat:</h4>
                                  <p><input type="datetime-local" placeholder="Waktu Catat" oninput="this.className = ''" name="waktuCatat"></p>
                                </div>
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                <h1>Pengisian Form Evaluasi Medis</h1>
                                  <h4>ID Medis:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Emosi (angka)" oninput="this.className = ''" name="idEmosi"></p>
                                  <h4>ID Klien:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Klien (angka)" oninput="this.className = ''" name="idKlien"></p>
                                  <h4>ID Jadwal:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Jadwal (angka)" oninput="this.className = ''" name="idJadwal"></p>
                                  <h4>ID Pemantau:</h4>
                                  <p><input type="number" placeholder="Masukkan ID Pemantau (angka)" oninput="this.className = ''" name="idPemantau"></p>
                                  <h4>Dosis Obat:</h4>
                                  <p><input type="text" placeholder="Dosis obat seharusnya" oninput="this.className = ''" name="dosisObat"></p>
                                  <h4>Obat Diminum:</h4>
                                  <p><input type="text" placeholder="Obat yang diminum hari ini" oninput="this.className = ''" name="obatDiminum"></p>
                                  <h4>Catatan Evaluasi:</h4>
                                  <p><textarea placeholder="Masukkan Catatan Evaluasi" oninput="this.className = ''" name="catatanEvaluasi"></textarea></p>
                                  <h4>Pilih Kategori:</h4>
                                  <p>
                                      <select placeholder="Kategori" oninput="this.className = ''" name="kategori">
                                          <option value="Salomo">Salomo</option>
                                          <option value="Victory">Victory</option>
                                          <option value="Istimewa">Istimewa</option>
                                      </select>
                                  </p>
                                  <h4>Skor Medis:</h4>
                                  <p><input type="number" placeholder="Skor" oninput="this.className = ''" name="skor"></p>
                                  <h4>Waktu Catat:</h4>
                                  <p><input type="datetime-local" placeholder="Waktu Catat" oninput="this.className = ''" name="waktuCatat"></p>
                                </div>
                                <div style="overflow:auto;">
                                  <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                  </div>
                                </div>
                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px;">
                                  <span class="step"></span>
                                  <span class="step"></span>
                                  <span class="step"></span>
                                  <span class="step"></span>
                                </div>

                                <script>
                                    // Setelah DOM dimuat
                                    document.addEventListener('DOMContentLoaded', function () {
                                        <?php
                                        // Periksa apakah session lastInsertedId ada
                                        if (!empty($_SESSION['lastInsertedId'])) {
                                            // Isi kembali nilai formulir
                                            echo "document.getElementsByName('idMedis')[0].value = " . $_SESSION['lastInsertedId'] . ";";
                                            // Hapus session untuk mencegah pengisian ulang
                                            unset($_SESSION['lastInsertedId']);
                                        }
                                        ?>
                                    });
                                </script>
                              </form>

                              <script>
                              var currentTab = 0; // Current tab is set to be the first tab (0)
                              showTab(currentTab); // Display the current tab

                              function showTab(n) {
                                // This function will display the specified tab of the form...
                                var x = document.getElementsByClassName("tab");
                                x[n].style.display = "block";
                                //... and fix the Previous/Next buttons:
                                if (n == 0) {
                                  document.getElementById("prevBtn").style.display = "none";
                                } else {
                                  document.getElementById("prevBtn").style.display = "inline";
                                }
                                if (n == (x.length - 1)) {
                                  document.getElementById("nextBtn").innerHTML = "Submit";
                                } else {
                                  document.getElementById("nextBtn").innerHTML = "Next";
                                }
                                //... and run a function that will display the correct step indicator:
                                fixStepIndicator(n)
                              }

                              function nextPrev(n) {
                                // This function will figure out which tab to display
                                var x = document.getElementsByClassName("tab");
                                // Exit the function if any field in the current tab is invalid:
                                if (n == 1 && !validateForm()) return false;
                                // Hide the current tab:
                                x[currentTab].style.display = "none";
                                // Increase or decrease the current tab by 1:
                                currentTab = currentTab + n;
                                // if you have reached the end of the form...
                                if (currentTab >= x.length) {
                                  // ... the form gets submitted:
                                  document.getElementById("regForm").submit();
                                  return false;
                                }
                                // Otherwise, display the correct tab:
                                showTab(currentTab);
                              }

                              function validateForm() {
                                // This function deals with validation of the form fields
                                var x, y, i, valid = true;
                                x = document.getElementsByClassName("tab");
                                y = x[currentTab].getElementsByTagName("input");
                                // A loop that checks every input field in the current tab:
                                for (i = 0; i < y.length; i++) {
                                  // If a field is empty...
                                  if (y[i].value == "") {
                                    // add an "invalid" class to the field:
                                    y[i].className += " invalid";
                                    // and set the current valid status to false
                                    valid = false;
                                  }
                                }
                                // If the valid status is true, mark the step as finished and valid:
                                if (valid) {
                                  document.getElementsByClassName("step")[currentTab].className += " finish";
                                }
                                return valid; // return the valid status
                              }

                              function fixStepIndicator(n) {
                                // This function removes the "active" class of all steps...
                                var i, x = document.getElementsByClassName("step");
                                for (i = 0; i < x.length; i++) {
                                  x[i].className = x[i].className.replace(" active", "");
                                }
                                //... and adds the "active" class on the current step:
                                x[n].className += " active";
                              }
                              </script>
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