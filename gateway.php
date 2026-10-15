<?php
header("Content-Type: application/json; charset=UTF-8");
$requestUri = $_SERVER['REQUEST_URI'];

// Contoh route melalui gateway untuk submission-service
if (strpos($requestUri, '/gateway/submissions') !== false) {
    // 1. Ambil data dari Registry Server (misal berjalan di port yang sama atau beda)
    $registryJson = file_get_contents('http://localhost:8005/registry.php/api/registry/submission-service');
    $registryData = json_decode($registryJson, true);

    if (!$registryData || !$registryData['success']) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Gagal mengambil data dari Registry."]);
        exit;
    }

    $service = $registryData['data'];
    $targetBaseUrl = "{$service['baseUrl']}:{$service['port']}";
    
    // Sesuaikan path tujuan ke submission service asli
    $subPath = str_replace('/gateway/submissions', '/index.php/api/submissions', $requestUri);
    $targetUrl = $targetBaseUrl . $subPath;

    // 2. Teruskan Request (Proxy) menggunakan cURL
    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']);

    // Jika metode POST, teruskan data POST dan file yang diunggah
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = $_POST;
        if (!empty($_FILES['file'])) {
            $postData['file'] = new CURLFile(
                $_FILES['file']['tmp_name'],
                $_FILES['file']['type'],
                $_FILES['file']['name']
            );
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    http_response_code($httpCode);
    echo $response;
} else {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Gateway route tidak ditemukan."]);
}
?>