<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once dirname(__DIR__) . '/includes/map/FieldRepository.php';

$region = trim($_GET['region'] ?? '');
$culture = trim($_GET['culture'] ?? '') ?: null;
$search = trim($_GET['search'] ?? '') ?: null;
$enterpriseId = isset($_GET['enterprise_id']) && $_GET['enterprise_id'] !== '' ? (int)$_GET['enterprise_id'] : null;

if ($region === '') {
    http_response_code(400);
    echo json_encode(['error' => 'region required']);
    exit;
}

$repo = new FieldRepository();
$fields = $repo->getFieldsByRegion($region, $culture, $search, $enterpriseId);
$stats = $repo->getRegionStats($region, $enterpriseId);

echo json_encode([
    'region' => $region,
    'source' => $repo->isUsingDatabase() ? 'database' : 'seed',
    'stats' => $stats,
    'fields' => $fields,
], JSON_UNESCAPED_UNICODE);
