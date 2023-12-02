<?php

include 'koneksi.php';

$namaKlien = $_GET['namaKlien'];

$sql1 = "SELECT b.namaKlien, DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted1, a.skor, a.kategori, a.catatanEval
FROM evalemosional a
INNER JOIN dataklien b ON a.idKlien = b.idKlien
WHERE b.namaKlien = '$namaKlien' AND a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27'
ORDER BY a.waktuCatat";

$result1 = mysqli_query($conn, $sql1);

$data1 = array();

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = array(
            'tanggal' => $row['waktuCatatFormatted1'],
            'emosionalScore' => $row['skor'],
            'kategori' => $row['kategori'],
            'eval' => $row['catatanEval'],
        );
    }
}

$sql2 = "SELECT b.namaKlien, DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted2, a.skor, a.kategori, a.catatanEval
FROM evalkognitif a
INNER JOIN dataklien b ON a.idKlien = b.idKlien
WHERE b.namaKlien = '$namaKlien' AND a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27'
ORDER BY a.waktuCatat";

$result2 = mysqli_query($conn, $sql2);

$data2 = array();

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $data2[] = array(
            'tanggal' => $row['waktuCatatFormatted2'],
            'kognitifScore' => $row['skor'],
            'kategori' => $row['kategori'],
            'eval' => $row['catatanEval'],
        );
    }
}

$sql3 = "SELECT b.namaKlien, DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted3, a.skor, a.kategori, a.catatanEval
FROM evalperilaku a
INNER JOIN dataklien b ON a.idKlien = b.idKlien
WHERE b.namaKlien = '$namaKlien' AND a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27'
ORDER BY a.waktuCatat";

$result3 = mysqli_query($conn, $sql3);

$data3 = array();

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $data3[] = array(
            'tanggal' => $row['waktuCatatFormatted3'],
            'perilakuScore' => $row['skor'],
            'kategori' => $row['kategori'],
            'eval' => $row['catatanEval'],
        );
    }
}

$sql4 = "SELECT b.namaKlien, DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted4, a.skor, a.kategori, a.catatanEval
FROM evalmedis a
INNER JOIN dataklien b ON a.idKlien = b.idKlien
WHERE b.namaKlien = '$namaKlien' AND a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27'
ORDER BY a.waktuCatat";

$result4 = mysqli_query($conn, $sql4);

$data4 = array();

if ($result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        $data4[] = array(
            'tanggal' => $row['waktuCatatFormatted4'],
            'medisScore' => $row['skor'],
            'kategori' => $row['kategori'],
            'eval' => $row['catatanEval'],
        );
    }
}

// Gabungkan dua set data menjadi satu array
$combinedData = array(
    'emosional' => $data1,
    'kognitif' => $data2,
    'perilaku' => $data3,
    'medis' => $data4,
);

// Kembalikan data dalam satu panggilan json_encode
echo json_encode($combinedData);