<?php
include_once 'includes/lang.php';
require_once 'includes/map/helpers.php';

$page_title = t('page_title_maps');
$page_head = '<link rel="stylesheet" href="assets/css/agro-map.css?v=' . time() . '">'
    . '<script src="assets/js/maps-country.js?v=' . time() . '" defer></script>';
$body_class = 'agro-dashboard-page';

$pathsFile = 'data/kyrgyzstan_regions.json';
if (!file_exists($pathsFile)) {
    $pathsFile = 'scratch/extracted_paths.json';
}
$paths_json = file_exists($pathsFile) ? file_get_contents($pathsFile) : '';
$paths_data = !empty($paths_json) ? json_decode($paths_json, true) : [];

$mapConfig = mapConfig();
$regionsJs = [];
foreach ($mapConfig['regions'] as $slug => $r) {
    $iso = $r['iso'];
    $id = str_replace('-', '', $iso);
    $regionsJs[$id] = [
        'id' => $id,
        'slug' => $slug,
        'iso' => $iso,
        'color' => $r['color'],
        'title' => $r['name_ru'],
        'title_ky' => $r['name_ky'],
        'title_en' => $r['name_en'],
        'address' => $r['address_ru'],
        'address_ky' => $r['address_ky'],
        'address_en' => $r['address_en'],
        'crops' => $r['crops_ru'],
        'crops_ky' => $r['crops_ky'],
        'crops_en' => $r['crops_en'],
        'extra' => $r['extra_ru'],
        'extra_ky' => $r['extra_ky'],
        'extra_en' => $r['extra_en'],
    ];
}

include 'includes/header.php';
?>

<main id="main-content" class="agro-dashboard">
    <div class="container">
        <div class="mb-5 text-center">
            <span class="section-tag"><?php echo t('nav_maps'); ?></span>
            <h1 class="section-title-premium mb-3"><?php echo t('maps_title'); ?></h1>
            <p class="section-subtitle-premium mx-auto" style="max-width: 760px;"><?php echo t('maps_text'); ?></p>
        </div>

        <div class="agro-layout mb-5">
            <div class="agro-map-panel">
                <div class="agro-country-svg-wrap map-wrapper w-100">
                    <svg viewBox="0 0 800 392" width="100%" height="auto" class="kyrgyzstan-svg-map" role="img" aria-label="<?php echo htmlspecialchars(t('maps_title')); ?>">
                        <?php if (!empty($paths_data)): ?>
                            <?php foreach ($paths_data as $region):
                                $iso = $region['iso'] ?? '';
                                $id = str_replace('-', '', $iso);
                                $classSlug = strtolower($id);
                            ?>
                                <path d="<?php echo htmlspecialchars($region['d']); ?>"
                                      id="path-<?php echo $classSlug; ?>"
                                      data-id="<?php echo htmlspecialchars($id); ?>"
                                      data-iso="<?php echo htmlspecialchars($iso); ?>"
                                      class="region-path region-<?php echo $classSlug; ?>" />
                            <?php endforeach; ?>
                        <?php else: ?>
                            <text x="400" y="200" text-anchor="middle" fill="#666"><?php echo t('agro_map_load_error'); ?></text>
                        <?php endif; ?>
                    </svg>
                    <div id="map-tooltip" class="agro-map-tooltip">
                        <h4 id="tooltip-title"></h4>
                        <p id="tooltip-crops"></p>
                    </div>
                </div>
            </div>

            <aside class="agro-sidebar">
                <div id="region-info-panel" class="agro-card agro-card-accent h-100 d-flex flex-column">
                    <div class="flex-grow-1">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <span class="section-tag mb-0" style="font-size:10px"><?php echo t('maps_info_title'); ?></span>
                            <span id="region-badge-crop" class="badge d-none text-white px-3 py-2 text-uppercase fw-bold" style="font-size:10px"></span>
                        </div>

                        <div id="region-info-content" style="display:none">
                            <h3 id="region-info-title" class="h4 mb-4 fw-bold"></h3>
                            <div class="mb-4">
                                <p class="small fw-bold text-uppercase mb-1" style="opacity:0.5;letter-spacing:0.05em"><?php echo t('maps_info_address_label'); ?></p>
                                <p id="region-info-address" class="mb-0 d-flex gap-2"><span>📍</span><span class="address-text"></span></p>
                            </div>
                            <div class="mb-4">
                                <p class="small fw-bold text-uppercase mb-1" style="opacity:0.5;letter-spacing:0.05em"><?php echo t('maps_info_crops_label'); ?></p>
                                <p id="region-info-crops" class="mb-0 d-flex gap-2"><span>🌾</span><span class="crops-text"></span></p>
                            </div>
                            <div class="pt-3 border-top" style="border-color:rgba(255,255,255,0.08)!important">
                                <p class="small fw-bold text-uppercase mb-1" style="opacity:0.5;letter-spacing:0.05em"><?php echo t('maps_info_description_label'); ?></p>
                                <p id="region-info-extra" class="small mb-0" style="line-height:1.7;opacity:0.8"></p>
                            </div>
                        </div>

                        <div id="region-info-placeholder" class="agro-placeholder">
                            <div class="agro-placeholder-icon">🗺️</div>
                            <p class="mb-0"><?php echo t('maps_info_placeholder'); ?></p>
                            <p class="small mt-2 mb-0" style="opacity:0.5"><?php echo t('agro_dblclick_hint'); ?></p>
                        </div>
                    </div>

                    <div id="region-info-action" class="mt-4" style="display:none">
                        <a id="region-info-link" href="#" class="agro-btn agro-btn-primary w-100"><?php echo t('agro_open_region_map'); ?> &rarr;</a>
                    </div>
                </div>

                <div class="agro-card">
                    <h3 class="h6 mb-3 text-uppercase" style="letter-spacing:0.06em;opacity:0.55"><?php echo t('agro_quick_regions'); ?></h3>
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach ($mapConfig['regions'] as $slug => $r): ?>
                            <a href="regions/<?php echo $slug; ?>.php?lang=<?php echo currentLang(); ?>" class="agro-filter-chip text-decoration-none">
                                <?php echo htmlspecialchars(mapRegionLocalized($r, 'name')); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="agro-card h-100">
                    <h3 class="h5 mb-4"><?php echo t('maps_addresses_title'); ?></h3>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="opacity:0.85">
                        <li class="d-flex gap-2"><span>📍</span><span><?php echo t('maps_address_1'); ?></span></li>
                        <li class="d-flex gap-2"><span>📍</span><span><?php echo t('maps_address_2'); ?></span></li>
                        <li class="d-flex gap-2"><span>📍</span><span><?php echo t('maps_address_3'); ?></span></li>
                        <li class="d-flex gap-2"><span>📍</span><span><?php echo t('maps_address_4'); ?></span></li>
                        <li class="d-flex gap-2"><span>📍</span><span><?php echo t('maps_address_5'); ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="agro-card h-100">
                    <h3 class="h5 mb-4"><?php echo t('maps_legend_title'); ?></h3>
                    <p class="mb-4" style="opacity:0.7"><?php echo t('maps_description_1'); ?></p>
                    <div class="row g-3">
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#2a9d8f"></span>
                            <span class="small"><?php echo t('maps_legend_beet'); ?> (<?php echo t('agro_region_chuy'); ?>)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#e76f51"></span>
                            <span class="small"><?php echo t('maps_legend_grain'); ?> (<?php echo t('agro_region_osh'); ?>)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#e9c46a"></span>
                            <span class="small"><?php echo t('maps_legend_cotton'); ?> (<?php echo t('agro_region_batken'); ?>)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#f4a261"></span>
                            <span class="small"><?php echo t('maps_legend_vegetables'); ?> (<?php echo t('agro_region_jalal'); ?>)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#4ea8de"></span>
                            <span class="small"><?php echo t('maps_legend_seed'); ?> (<?php echo t('agro_region_naryn'); ?>)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="width:16px;height:16px;border-radius:4px;background:#1e5e3a"></span>
                            <span class="small"><?php echo t('agro_region_issyk'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
window.AGRO_COUNTRY_CONFIG = <?php echo json_encode([
    'lang' => currentLang(),
    'basePath' => '',
    'regions' => $regionsJs,
], JSON_UNESCAPED_UNICODE); ?>;
</script>

<?php include 'includes/footer.php'; ?>
