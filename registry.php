<?php
header("Content-Type: application/json; charset=UTF-8");
$requestUri = $_SERVER['REQUEST_URI'];

if (preg_match('/\/api\/registry\/([a-zA-Z0-9\-_]+)/', $requestUri, $matches)) {
    $serviceName = $matches[1];
    $jsonData = file_get_contents('services.json');
    $registry = json_decode($jsonData, true);

    $targetService = null;
    foreach ($registry['services'] as $service) {
        if ($service['name'] === $serviceName) {
            $targetService = $service;
            break;
        }
    }

    if ($targetService) {
        http_response_code(200);
        echo json_encode([
            "success" => true,
            "data" => $targetService
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "message" => "Service dengan nama '$serviceName' tidak ditemukan di registry."
        ]);
    }
} else {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "message" => "Endpoint registry tidak valid."
    ]);
}
?>