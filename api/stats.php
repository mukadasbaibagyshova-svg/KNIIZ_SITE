<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once dirname(__DIR__) . '/includes/map/FieldRepository.php';

$region = trim($_GET['region'] ?? '');
if ($region === '') {
    http_response_code(400);
    echo json_encode(['error' => 'region required']);
    exit;
}

$repo = new FieldRepository();
echo json_encode([
    'region' => $region,
    'stats' => $repo->getRegionStats($region),
], JSON_UNESCAPED_UNICODE);
