<?php
/**
 * Шаблон карты региона (подключается из naryn.php, chuy.php и т.д.)
 */
include_once dirname(__DIR__) . '/includes/lang.php';
require_once dirname(__DIR__) . '/includes/map/helpers.php';
require_once dirname(__DIR__) . '/includes/map/FieldRepository.php';

$slug = $_region_slug ?? ($_GET['region'] ?? '');
$region = mapRegionBySlug($slug);

if (!$region) {
    http_response_code(404);
    $page_title = t('plot_not_found');
    $page_head = mapAgroAssets();
    $body_class = 'agro-dashboard-page';
    include dirname(__DIR__) . '/includes/header.php';
    echo '<main class="agro-dashboard"><div class="container"><div class="agro-card"><p>' . htmlspecialchars(t('plot_not_found_desc')) . '</p><a href="../maps.php?lang=' . currentLang() . '" class="agro-btn agro-btn-ghost">' . t('back_to_map') . '</a></div></div></main>';
    include dirname(__DIR__) . '/includes/footer.php';
    exit;
}

$page_title = mapRegionLocalized($region, 'name');
$page_head = mapAgroAssets(true);
$body_class = 'agro-dashboard-page';

$cultureColors = mapConfig()['culture_colors'];
$cultureLabels = [
    'ru' => ['wheat' => 'Пшеница', 'barley' => 'Ячмень', 'potato' => 'Картофель', 'beet' => 'Свекла', 'cotton' => 'Хлопок', 'vegetables' => 'Овощи', 'corn' => 'Кукуруза', 'legumes' => 'Бобовые', 'seed' => 'Семена', 'other' => 'Прочее'],
    'ky' => ['wheat' => 'Буудай', 'barley' => 'Арпа', 'potato' => 'Картөшкө', 'beet' => 'Кызылча', 'cotton' => 'Пахта', 'vegetables' => 'Жашылчалар', 'corn' => 'Жүгөрү', 'legumes' => 'Буурчак', 'seed' => 'Үрөн', 'other' => 'Башка'],
    'en' => ['wheat' => 'Wheat', 'barley' => 'Barley', 'potato' => 'Potato', 'beet' => 'Beet', 'cotton' => 'Cotton', 'vegetables' => 'Vegetables', 'corn' => 'Corn', 'legumes' => 'Legumes', 'seed' => 'Seed', 'other' => 'Other'],
];
$lang = currentLang();
$labels = $cultureLabels[$lang] ?? $cultureLabels['ru'];

$statusLabels = [
    'ru' => ['good' => 'Норма', 'attention' => 'Внимание', 'critical' => 'Критично'],
    'ky' => ['good' => 'Жакшы', 'attention' => 'Көңүл буруу', 'critical' => 'Критикалык'],
    'en' => ['good' => 'Good', 'attention' => 'Attention', 'critical' => 'Critical'],
];

include dirname(__DIR__) . '/includes/header.php';
?>

<main id="main-content" class="agro-dashboard">
    <div class="container">
        <nav class="agro-breadcrumb mb-3" style="font-size:0.88rem">
            <a href="../maps.php?lang=<?php echo currentLang(); ?>"><?php echo t('back_to_map'); ?></a>
            <span class="mx-2 opacity-50">/</span>
            <span><?php echo htmlspecialchars(mapRegionLocalized($region, 'name')); ?></span>
        </nav>

        <div class="mb-4">
            <span class="section-tag"><?php echo t('agro_region_map'); ?></span>
            <h1 class="section-title-premium mb-2"><?php echo htmlspecialchars(mapRegionLocalized($region, 'name')); ?></h1>
            <p class="section-subtitle-premium mb-0"><?php echo htmlspecialchars(mapRegionLocalized($region, 'extra')); ?></p>
        </div>

        <div class="agro-layout">
            <div class="agro-map-panel">
                <div id="region-map"></div>
                <div class="agro-map-float-badges">
                    <div class="agro-float-badge" id="badge-moisture">💧 <span id="stat-avg-moisture">—</span></div>
                    <div class="agro-float-badge">📐 <span id="stat-total-ha">0</span> га</div>
                </div>
            </div>

            <aside class="agro-sidebar">
                <div class="agro-card agro-card-accent" style="--region-accent: <?php echo htmlspecialchars($region['color']); ?>">
                    <h2 class="h6 text-uppercase mb-3" style="letter-spacing:0.06em;opacity:0.55"><?php echo t('agro_stats'); ?></h2>
                    <div class="agro-stat-grid mb-3">
                        <div class="agro-stat">
                            <div class="agro-stat-value" id="stat-fields-count">0</div>
                            <div class="agro-stat-label"><?php echo t('agro_fields_count'); ?></div>
                        </div>
                        <div class="agro-stat">
                            <div class="agro-stat-value" id="stat-total-ha-side">—</div>
                            <div class="agro-stat-label"><?php echo t('agro_total_ha'); ?></div>
                        </div>
                    </div>
                    <div id="culture-bar-chart" class="agro-bar-chart"></div>
                </div>

                <div class="agro-card">
                    <input type="search" id="field-search" class="agro-search mb-3" placeholder="<?php echo t('agro_search_fields'); ?>">
                    <div class="agro-filters mb-3">
                        <button type="button" class="agro-filter-chip active" data-culture=""><?php echo t('agro_filter_all'); ?></button>
                        <?php foreach (array_keys($cultureColors) as $key): if ($key === 'other') continue; ?>
                            <button type="button" class="agro-filter-chip" data-culture="<?php echo $key; ?>"><?php echo htmlspecialchars($labels[$key] ?? $key); ?></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="agro-field-list" id="field-list"></div>
                </div>

                <div class="agro-card agro-card-accent" id="field-detail-card" style="--region-accent: <?php echo htmlspecialchars($region['color']); ?>">
                    <h2 class="h6 text-uppercase mb-3" style="letter-spacing:0.06em;opacity:0.55"><?php echo t('maps_info_title'); ?></h2>
                    <div id="field-detail-panel">
                        <div class="agro-placeholder">
                            <div class="agro-placeholder-icon">🌾</div>
                            <p><?php echo t('agro_select_field'); ?></p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<script>
window.AGRO_REGION_CONFIG = <?php echo json_encode([
    'lang' => currentLang(),
    'regionSlug' => $slug,
    'center' => [$region['center'][0], $region['center'][1]],
    'zoom' => (int) $region['zoom'],
    'accent' => $region['color'],
    'apiBase' => '../api/',
    'basePath' => '../',
    'cultureColors' => $cultureColors,
    'cultureLabels' => $labels,
    'statusLabels' => $statusLabels[$lang] ?? $statusLabels['ru'],
    'placeholderText' => t('agro_select_field'),
    'moreText' => t('maps_info_more'),
    'preselectFieldId' => (int) ($_GET['field'] ?? 0),
], JSON_UNESCAPED_UNICODE); ?>;
</script>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
