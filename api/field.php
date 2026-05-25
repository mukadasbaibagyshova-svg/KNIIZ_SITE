<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once dirname(__DIR__) . '/includes/map/FieldRepository.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'id required']);
    exit;
}

$repo = new FieldRepository();
$field = $repo->getFieldById($id);

if (!$field) {
    http_response_code(404);
    echo json_encode(['error' => 'not found']);
    exit;
}

$field['history'] = $repo->getCropHistory($id);

echo json_encode([
    'source' => $repo->isUsingDatabase() ? 'database' : 'seed',
    'field' => $field,
], JSON_UNESCAPED_UNICODE);
