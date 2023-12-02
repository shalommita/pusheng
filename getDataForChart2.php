<?php

include 'koneksi.php';

$chartType = $_GET['chartType'];

if (isset($_GET['namaKlien'])) {

    $namaKlien = $_GET['namaKlien'];

    $sql2 = "SELECT DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted2, ROUND(AVG(a.skor)) AS averageScore FROM $chartType a INNER JOIN dataklien b ON a.idKlien = b.idKlien WHERE a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27' GROUP BY DATE_FORMAT(a.waktuCatat, '%d/%m') ORDER BY a.waktuCatat";

    $result2 = mysqli_query($conn, $sql2);

    $data4 = array();

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $data4[] = array(
                'tanggal' => $row['waktuCatatFormatted2'],
                'score' => $row['averageScore'],
            );
        }
    }

    $sql3 = "SELECT b.namaKlien, DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted2, a.skor,a.kategori, a.catatanEval
    FROM $chartType a
    INNER JOIN dataklien b ON a.idKlien = b.idKlien
    WHERE b.namaKlien = '$namaKlien' AND a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27'
    ORDER BY a.waktuCatat";

    $result3 = mysqli_query($conn, $sql3);

    $data3 = array();

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $data3[] = array(
                'tanggal' => $row['waktuCatatFormatted2'],
                'score' => $row['skor'],
                'kategori' => $row['kategori'],
                'eval' => $row['catatanEval'],
            );
        }
    }

    $combinedData = array(
        'graph' => $data3,
        'dashedgraph' => $data4,
    );

    // Kembalikan data dalam satu panggilan json_encode
    echo json_encode($combinedData);

} else {
    $sql2 = "SELECT DATE_FORMAT(a.waktuCatat, '%d/%m') AS waktuCatatFormatted2, ROUND(AVG(a.skor)) AS averageScore FROM $chartType a INNER JOIN dataklien b ON a.idKlien = b.idKlien WHERE a.waktuCatat BETWEEN '2023-10-29' AND '2023-11-27' GROUP BY DATE_FORMAT(a.waktuCatat, '%d/%m') ORDER BY a.waktuCatat";

    $result2 = mysqli_query($conn, $sql2);

    $data4 = array();

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $data4[] = array(
                'tanggal' => $row['waktuCatatFormatted2'],
                'score' => $row['averageScore'],
            );
        }
    }

    $combinedData = array(
        'dashedgraph' => $data4,
    );

    // Kembalikan data dalam satu panggilan json_encode
    echo json_encode($combinedData);
}
