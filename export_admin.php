<?php
// Extract $staff_data from administration.php and save as JSON
$admin_file = __DIR__ . '/administration.php';
$content = file_get_contents($admin_file);

// We need to extract the $staff_data array. Best approach: include a temporary version.
// Instead, let's use the lang.php functions needed, then eval the array.

// Minimal stubs for the functions used in administration.php
function t($key, $default = '') { return $default ?: $key; }
function currentLang() { return 'ru'; }
$currentLang = 'ru';
$page_title = '';
$page_head = '';

// Extract the array definition
if (preg_match('/\$staff_data\s*=\s*(\[.*?\]);/s', $content, $m)) {
    // Evaluate the array
    eval('$staff_data = ' . $m[1] . ';');
    
    $json = json_encode($staff_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/database/administration.json', $json);
    echo "Exported " . count($staff_data) . " sections to database/administration.json\n";
} else {
    echo "ERROR: Could not find \$staff_data array\n";
}
