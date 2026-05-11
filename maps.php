<?php
include_once 'includes/lang.php';
$page_title = t('page_title_maps');
$page_head = '<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />';
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2 class="section-title"><?php echo t('maps_title'); ?></h2>
        <p class="section-text"><?php echo t('maps_text'); ?></p>

        <div class="map-page">
            <div class="map-frame" id="kyrgyz-map"></div>
            <div class="map-legend">
                <h3><?php echo t('maps_legend_title'); ?></h3>
                <div class="legend-item"><span class="legend-color legend-beet"></span><?php echo t('maps_legend_beet'); ?></div>
                <div class="legend-item"><span class="legend-color legend-grain"></span><?php echo t('maps_legend_grain'); ?></div>
                <div class="legend-item"><span class="legend-color legend-cotton"></span><?php echo t('maps_legend_cotton'); ?></div>
                <div class="legend-item"><span class="legend-color legend-vegetables"></span><?php echo t('maps_legend_vegetables'); ?></div>
                <div class="legend-item"><span class="legend-color legend-seed"></span><?php echo t('maps_legend_seed'); ?></div>
            </div>
        </div>

        <div class="page-grid page-grid-2" style="margin-top: 40px;">
            <div>
                <h3><?php echo t('maps_addresses_title'); ?></h3>
                <ul class="card-list">
                    <li><?php echo t('maps_address_1'); ?></li>
                    <li><?php echo t('maps_address_2'); ?></li>
                    <li><?php echo t('maps_address_3'); ?></li>
                    <li><?php echo t('maps_address_4'); ?></li>
                    <li><?php echo t('maps_address_5'); ?></li>
                </ul>
            </div>
            <div>
                <h3><?php echo t('maps_legend_title'); ?></h3>
                <p class="section-text"><?php echo t('maps_description_1'); ?></p>
                <p class="section-text"><?php echo t('maps_description_2'); ?></p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('kyrgyz-map').setView([41.0, 74.8], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        const cropPoints = [
            { coords: [43.01, 74.59], label: '<?php echo addslashes(t('maps_address_1')); ?>', type: 'beet' },
            { coords: [40.51, 72.75], label: '<?php echo addslashes(t('maps_address_2')); ?>', type: 'grain' },
            { coords: [40.04, 72.82], label: '<?php echo addslashes(t('maps_address_3')); ?>', type: 'cotton' },
            { coords: [41.31, 73.62], label: '<?php echo addslashes(t('maps_address_4')); ?>', type: 'vegetables' },
            { coords: [41.43, 76.01], label: '<?php echo addslashes(t('maps_address_5')); ?>', type: 'seed' }
        ];

        const colorMap = {
            beet: '#d64545',
            grain: '#f6b93b',
            cotton: '#6a89cc',
            vegetables: '#38ada9',
            seed: '#7d5a50'
        };

        cropPoints.forEach(point => {
            L.circleMarker(point.coords, {
                radius: 11,
                fillColor: colorMap[point.type],
                color: '#ffffff',
                weight: 2,
                fillOpacity: 0.9
            }).addTo(map).bindPopup(`<strong>${point.label}</strong>`);
        });
    </script>
</main>

<?php include 'includes/footer.php'; ?>