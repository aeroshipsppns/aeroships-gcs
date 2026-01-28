<?php
header('Content-Type: application/json');

// Folder tempat kedua foto disimpan
$baseDir = __DIR__ . '/aero_ftp/uploads/';
$baseUrl = 'aero_ftp/uploads/';

// Nama file fix (yang dikirim dari kapal / FTP)
$files = [
    'mangrove' => 'foto_box_hijau_zed.jpg',
    'fish'     => 'foto_bawah_air_biru.jpg'
];

$result = ['ok' => true];

foreach ($files as $key => $name) {
    $path = $baseDir . $name;

    if (file_exists($path)) {
        $result[$key] = [
            'exists' => true,
            'file'   => $name,
            'url'    => $baseUrl . $name,
            'mtime'  => filemtime($path) // waktu terakhir file diubah
        ];
    } else {
        $result[$key] = [
            'exists' => false
        ];
    }
}

echo json_encode($result);
