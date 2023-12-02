<?php
require_once 'koneksi.php';

// Query untuk mengambil data frekuensi konflik
$query = "SELECT tanggalPencatatan, COUNT(DISTINCT kegiatan) as frekuensi FROM rekapkonflik GROUP BY tanggalPencatatan";

$result = $conn->query($query);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'x' => date('d/m', strtotime($row['tanggalPencatatan'])),
            'y' => (int)$row['frekuensi'],
        ];
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
