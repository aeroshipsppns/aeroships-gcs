<?php
header('Content-Type: application/json');

// Folder relatif dari file ini
$baseDir = __DIR__ . '/aero_ftp/uploads/';

// Daftar file yang mau dihapus
$targetFiles = [
    'foto_box_hijau_zed.jpg',
    'foto_bawah_air_biru.jpg'
];

$result = [
    'ok'      => true,
    'baseDir' => $baseDir,
    'deleted' => [],
    'missing' => [],
    'errors'  => []
];

// Cek foldernya dulu
if (!is_dir($baseDir)) {
    $result['ok'] = false;
    $result['errors'][] = 'Directory not found: ' . $baseDir;
    echo json_encode($result);
    exit;
}

foreach ($targetFiles as $name) {
    $fullPath = $baseDir . $name;

    if (!file_exists($fullPath)) {
        $result['missing'][] = $name;
        continue;
    }

    if (@unlink($fullPath)) {
        $result['deleted'][] = $name;
    } else {
        $result['ok'] = false;
        $result['errors'][] = 'Failed to delete: ' . $name;
    }
}

echo json_encode($result);
