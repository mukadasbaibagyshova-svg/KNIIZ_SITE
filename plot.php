<?php
/**
 * Обратная совместимость: старые ссылки plot.php?id=KGN → regions/naryn.php
 */
include_once 'includes/lang.php';
require_once 'includes/map/helpers.php';

$id = $_GET['id'] ?? '';
$lang = currentLang();
$config = mapConfig();
$redirects = $config['legacy_plot_redirect'] ?? [];

if (isset($redirects[$id])) {
    header('Location: regions/' . $redirects[$id] . '.php?lang=' . urlencode($lang));
    exit;
}

header('Location: maps.php?lang=' . urlencode($lang));
exit;
