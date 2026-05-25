<?php

function mapConfig(): array
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    return $config;
}

function mapRegionBySlug(string $slug): ?array
{
    $regions = mapConfig()['regions'] ?? [];
    return $regions[$slug] ?? null;
}

function mapRegionLocalized(array $region, string $field): string
{
    $lang = function_exists('currentLang') ? currentLang() : 'ru';
    $key = $field . '_' . $lang;
    if (!empty($region[$key])) {
        return $region[$key];
    }
    return $region[$field . '_ru'] ?? '';
}

function mapCultureColor(string $cultureKey): string
{
    $colors = mapConfig()['culture_colors'] ?? [];
    $key = strtolower(preg_replace('/[^a-z0-9_]/', '', $cultureKey));
    return $colors[$key] ?? ($colors['other'] ?? '#64748b');
}

function mapLeafletAssets(): string
{
    return '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">' . "\n"
        . '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';
}

function mapAgroAssets(bool $regionJs = false): string
{
    $base = mapLeafletAssets();
    $base .= '<link rel="stylesheet" href="assets/css/agro-map.css?v=' . time() . '">';
    if ($regionJs) {
        $base .= '<script src="assets/js/agro-region-map.js?v=' . time() . '" defer></script>';
    } else {
        $base .= '<script src="assets/js/maps-country.js?v=' . time() . '" defer></script>';
    }
    return $base;
}

function mapBasePath(): string
{
  $script = $_SERVER['SCRIPT_NAME'] ?? '';
  if (strpos($script, '/regions/') !== false) {
    return '../';
  }
  return '';
}
