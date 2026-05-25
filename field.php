<?php
include_once 'includes/lang.php';
require_once 'includes/map/helpers.php';
require_once 'includes/map/FieldRepository.php';

$id = (int) ($_GET['id'] ?? 0);
$repo = new FieldRepository();
$field = $repo->getFieldById($id);
$history = $field ? $repo->getCropHistory($id) : [];

$region = $field ? mapRegionBySlug($field['region_slug'] ?? '') : null;

$page_title = $field ? $field['name'] : t('plot_not_found');
$page_head = mapLeafletAssets() . '<link rel="stylesheet" href="assets/css/agro-map.css?v=' . time() . '">';
$body_class = 'agro-dashboard-page';

$statusLabels = [
    'ru' => ['good' => 'Норма', 'attention' => 'Внимание', 'critical' => 'Критично'],
    'ky' => ['good' => 'Жакшы', 'attention' => 'Көңүл буруу', 'critical' => 'Критикалык'],
    'en' => ['good' => 'Good', 'attention' => 'Attention', 'critical' => 'Critical'],
];
$lang = currentLang();
$statusMap = $statusLabels[$lang] ?? $statusLabels['ru'];

include 'includes/header.php';
?>

<main id="main-content" class="agro-dashboard">
    <div class="container">
        <nav class="agro-breadcrumb mb-4">
            <a href="maps.php?lang=<?php echo currentLang(); ?>"><?php echo t('back_to_map'); ?></a>
            <?php if ($region): ?>
                <span class="mx-2 opacity-50">/</span>
                <a href="regions/<?php echo htmlspecialchars($region['slug']); ?>.php?lang=<?php echo currentLang(); ?>">
                    <?php echo htmlspecialchars(mapRegionLocalized($region, 'name')); ?>
                </a>
            <?php endif; ?>
            <?php if ($field): ?>
                <span class="mx-2 opacity-50">/</span>
                <span><?php echo htmlspecialchars($field['name']); ?></span>
            <?php endif; ?>
        </nav>

        <?php if (!$field): ?>
            <div class="agro-card text-center py-5">
                <span class="fs-1 d-block mb-3">⚠️</span>
                <h2><?php echo t('plot_not_found'); ?></h2>
                <p class="opacity-75"><?php echo t('plot_not_found_desc'); ?></p>
            </div>
        <?php else: ?>
            <div class="mb-4 d-flex flex-wrap justify-content-between align-items-end gap-3">
                <div>
                    <span class="section-tag"><?php echo t('maps_info_title'); ?></span>
                    <h1 class="section-title-premium mb-2"><?php echo htmlspecialchars($field['name']); ?></h1>
                    <span class="agro-status agro-status-<?php echo htmlspecialchars($field['status'] ?? 'good'); ?>">
                        <?php echo htmlspecialchars($statusMap[$field['status']] ?? $field['status']); ?>
                    </span>
                </div>
                <?php if ($region): ?>
                    <a href="regions/<?php echo htmlspecialchars($region['slug']); ?>.php?lang=<?php echo currentLang(); ?>&field=<?php echo (int) $field['id']; ?>" class="agro-btn agro-btn-ghost">
                        &larr; <?php echo t('agro_back_region_map'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="agro-field-detail-grid">
                <div class="agro-card">
                    <div id="field-mini-map" style="height:360px;border-radius:14px;overflow:hidden"></div>
                </div>
                <div class="agro-card agro-card-accent" style="--region-accent: <?php echo htmlspecialchars($field['color'] ?? '#c9a227'); ?>">
                    <h2 class="h5 mb-4"><?php echo t('agro_field_details'); ?></h2>
                    <dl class="row mb-0" style="font-size:0.95rem">
                        <dt class="col-5 opacity-50"><?php echo t('agro_label_culture'); ?></dt>
                        <dd class="col-7"><?php echo htmlspecialchars($field['culture']); ?></dd>
                        <dt class="col-5 opacity-50"><?php echo t('agro_total_ha'); ?></dt>
                        <dd class="col-7"><?php echo htmlspecialchars($field['hectares']); ?> га</dd>
                        <dt class="col-5 opacity-50"><?php echo t('agro_label_moisture'); ?></dt>
                        <dd class="col-7"><?php echo $field['moisture'] !== null ? htmlspecialchars($field['moisture']) . '%' : '—'; ?></dd>
                        <dt class="col-5 opacity-50"><?php echo t('agro_label_year'); ?></dt>
                        <dd class="col-7"><?php echo (int) $field['year']; ?></dd>
                        <?php if ($region): ?>
                        <dt class="col-5 opacity-50"><?php echo t('maps_info_address_label'); ?></dt>
                        <dd class="col-7"><?php echo htmlspecialchars(mapRegionLocalized($region, 'address')); ?></dd>
                        <?php endif; ?>
                    </dl>
                </div>
            </div>

            <div class="agro-card mt-4">
                <h2 class="h5 mb-4"><?php echo t('agro_crop_history'); ?></h2>
                <?php if (empty($history)): ?>
                    <p class="opacity-50 mb-0"><?php echo t('agro_no_history'); ?></p>
                <?php else: ?>
                    <table class="agro-history-table">
                        <thead>
                            <tr>
                                <th><?php echo t('agro_label_year'); ?></th>
                                <th><?php echo t('agro_label_culture'); ?></th>
                                <th><?php echo t('agro_label_yield'); ?></th>
                                <th><?php echo t('agro_label_notes'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($history as $row): ?>
                                <tr>
                                    <td><?php echo (int) $row['year']; ?></td>
                                    <td><?php echo htmlspecialchars($row['culture']); ?></td>
                                    <td><?php echo $row['yield_tons'] !== null ? htmlspecialchars($row['yield_tons']) . ' т' : '—'; ?></td>
                                    <td><?php echo htmlspecialchars($row['notes'] ?? ''); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php if ($field && !empty($field['coordinates'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const coords = <?php echo json_encode($field['coordinates'], JSON_UNESCAPED_UNICODE); ?>;
    const color = <?php echo json_encode($field['color'] ?? '#c9a227'); ?>;
    const map = L.map('field-mini-map', { zoomControl: true }).setView(coords[0], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    const latlngs = coords.map(c => [c[0], c[1]]);
    const poly = L.polygon(latlngs, { color: '#fff', weight: 2, fillColor: color, fillOpacity: 0.5 }).addTo(map);
    map.fitBounds(poly.getBounds().pad(0.2));
});
</script>
<?php endif; ?>
<script src="assets/js/agro-field-map.js" defer></script>

<?php include 'includes/footer.php'; ?>
