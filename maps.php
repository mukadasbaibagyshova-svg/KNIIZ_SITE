<?php
include_once 'includes/lang.php';
$page_title = t('page_title_maps');
$page_head = ''; // Leaflet files removed as we are using native SVG
include 'includes/header.php';

// Read geographic paths for regions
$paths_json = file_get_contents('scratch/extracted_paths.json');
$paths_data = json_decode($paths_json, true);
?>

<main class="py-5 bg-light" style="min-height: 85vh; position: relative;">
    <div class="container">
        <!-- Header Section -->
        <div class="mb-5 text-center">
            <span class="section-tag"><?php echo t('nav_maps'); ?></span>
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('maps_title'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t('maps_text'); ?></p>
        </div>

        <!-- Interactive Map Layout (Two columns on desktop) -->
        <div class="row g-4 mb-5">
            <!-- Left Column: Map -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 24px; position: relative; min-height: 450px; display: flex; align-items: center; justify-content: center;">
                    <div class="map-wrapper w-100">
                        <svg viewBox="0 0 800 392" width="100%" height="auto" class="kyrgyzstan-svg-map">
                            <?php if (!empty($paths_data)): ?>
                                <?php foreach ($paths_data as $region): 
                                    $iso = $region['iso'];
                                    $id = str_replace('-', '', $iso); // KG-Y -> KGY
                                ?>
                                    <path d="<?php echo $region['d']; ?>" 
                                          id="path-<?php echo strtolower($id); ?>" 
                                          data-id="<?php echo $id; ?>"
                                          data-iso="<?php echo $iso; ?>"
                                          class="region-path region-<?php echo strtolower($id); ?>" />
                                <?php endforeach; ?>
                            <?php else: ?>
                                <text x="400" y="200" text-anchor="middle" fill="#ccc">Error loading map paths</text>
                            <?php endif; ?>
                        </svg>
                    </div>

                    <!-- Custom Mouse-Following Tooltip -->
                    <div id="map-tooltip" style="position: absolute; display: none; background: rgba(7, 37, 19, 0.95); backdrop-filter: var(--glass-blur); color: white; padding: 12px 18px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 10px 30px rgba(0,0,0,0.3); z-index: 100; pointer-events: none; transition: opacity 0.15s ease;">
                        <h4 id="tooltip-title" style="margin: 0 0 6px 0; font-size: 14px; font-weight: 700; color: var(--accent-color); font-family: var(--font-headings);"></h4>
                        <p id="tooltip-crops" style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.85); font-family: var(--font-text);"></p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Details Panel -->
            <div class="col-lg-4">
                <div id="region-info-panel" class="card border-0 shadow-sm p-4 bg-white h-100 d-flex flex-column justify-content-between" style="border-radius: 24px; transition: border-color 0.3s ease; border-left: 6px solid rgba(12, 62, 33, 0.1) !important;">
                    <div>
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <span class="badge bg-emerald-soft text-success px-3 py-2 text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">
                                <?php echo t('maps_info_title'); ?>
                            </span>
                            <span id="region-badge-crop" class="badge bg-emerald text-white px-3 py-2 text-uppercase fw-bold d-none" style="font-size: 10px; letter-spacing: 0.5px;"></span>
                        </div>
                        
                        <!-- Content displayed when a region is hovered/selected -->
                        <div id="region-info-content" style="display: none; animation: fadeIn 0.4s ease;">
                            <h3 id="region-info-title" class="h4 mb-4 fw-bold text-dark" style="font-family: var(--font-headings);"></h3>
                            
                            <div class="mb-4">
                                <p class="text-secondary mb-1 small fw-bold" style="letter-spacing: 0.5px;"><?php echo t('maps_info_address_label'); ?></p>
                                <p id="region-info-address" class="text-muted mb-0 fs-6 d-flex align-items-start gap-2">
                                    <span>📍</span> <span class="address-text"></span>
                                </p>
                            </div>

                            <div class="mb-4">
                                <p class="text-secondary mb-1 small fw-bold" style="letter-spacing: 0.5px;"><?php echo t('maps_info_crops_label'); ?></p>
                                <p id="region-info-crops" class="text-dark fs-5 fw-semibold d-flex align-items-center gap-2">
                                    <span>🌾</span> <span class="crops-text"></span>
                                </p>
                            </div>

                            <div class="border-top border-light pt-3 mt-3">
                                <p class="text-secondary mb-1 small fw-bold" style="letter-spacing: 0.5px;"><?php echo t('maps_info_description_label'); ?></p>
                                <p id="region-info-extra" class="text-muted small mb-0" style="line-height: 1.7;"></p>
                            </div>
                        </div>

                        <!-- Placeholder displayed by default -->
                        <div id="region-info-placeholder" class="text-center py-5">
                            <span class="fs-1 d-block mb-3 opacity-50">🗺️</span>
                            <p class="text-muted mb-0"><?php echo t('maps_info_placeholder'); ?></p>
                        </div>
                    </div>

                    <!-- CTA button displayed when region is hovered/selected -->
                    <div id="region-info-action" class="mt-4" style="display: none; animation: fadeIn 0.4s ease;">
                        <a id="region-info-link" href="#" class="btn-premium btn-premium-accent w-100 text-center py-3">
                            <?php echo t('maps_info_more'); ?> &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Addresses list & Color Legends -->
        <div class="row g-4 mt-2">
            <!-- Addresses list -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 24px;">
                    <h3 class="h5 mb-4 fw-bold" style="font-family: var(--font-headings); color: var(--primary-color);"><?php echo t('maps_addresses_title'); ?></h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 bg-transparent px-0 py-2 text-secondary d-flex align-items-start gap-2">
                            <span class="fs-5">📍</span> <span><?php echo t('maps_address_1'); ?></span>
                        </li>
                        <li class="list-group-item border-0 bg-transparent px-0 py-2 text-secondary d-flex align-items-start gap-2">
                            <span class="fs-5">📍</span> <span><?php echo t('maps_address_2'); ?></span>
                        </li>
                        <li class="list-group-item border-0 bg-transparent px-0 py-2 text-secondary d-flex align-items-start gap-2">
                            <span class="fs-5">📍</span> <span><?php echo t('maps_address_3'); ?></span>
                        </li>
                        <li class="list-group-item border-0 bg-transparent px-0 py-2 text-secondary d-flex align-items-start gap-2">
                            <span class="fs-5">📍</span> <span><?php echo t('maps_address_4'); ?></span>
                        </li>
                        <li class="list-group-item border-0 bg-transparent px-0 py-2 text-secondary d-flex align-items-start gap-2">
                            <span class="fs-5">📍</span> <span><?php echo t('maps_address_5'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Color Legends & Crops Association -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 24px;">
                    <h3 class="h5 mb-4 fw-bold" style="font-family: var(--font-headings); color: var(--primary-color);"><?php echo t('maps_legend_title'); ?></h3>
                    <p class="text-muted mb-4"><?php echo t('maps_description_1'); ?></p>
                    
                    <div class="row g-3">
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #2a9d8f;"></span>
                            <span class="text-secondary small fw-semibold"><?php echo t('maps_legend_beet'); ?> (Чуй)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #e76f51;"></span>
                            <span class="text-secondary small fw-semibold"><?php echo t('maps_legend_grain'); ?> (Ош)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #e9c46a;"></span>
                            <span class="text-secondary small fw-semibold"><?php echo t('maps_legend_cotton'); ?> (Баткен)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #f4a261;"></span>
                            <span class="text-secondary small fw-semibold"><?php echo t('maps_legend_vegetables'); ?> (Жалал-Абад)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #4ea8de;"></span>
                            <span class="text-secondary small fw-semibold"><?php echo t('maps_legend_seed'); ?> (Нарын)</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-3">
                            <span style="display: block; width: 16px; height: 16px; border-radius: 4px; background: #1e5e3a;"></span>
                            <span class="text-secondary small fw-semibold">Зерновые / Овощи (Ысык-Көл)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentLang = '<?php echo currentLang(); ?>';

    const regions = {
        'KGB': {
            id: 'KGB',
            title: 'Баткенская область',
            title_ky: 'Баткен облусу',
            title_en: 'Batken Region',
            address: 'г. Баткен, ул. Кызыл-Кия',
            address_ky: 'Баткен ш., Кызыл-Кыя көч.',
            address_en: 'Batken city, Kyzyl-Kiya str.',
            crops: 'Хлопок',
            crops_ky: 'Пахта',
            crops_en: 'Cotton',
            extra: 'Дополнительная информация: селекционная станция технических культур.',
            extra_ky: 'Кошумча маалымат: техникалык өсүмдүктөрдүн селекциялык станциясы.',
            extra_en: 'Additional info: breeding station of industrial crops.',
            color: '#e9c46a'
        },
        'KGGB': {
            id: 'KGGB',
            title: 'г. Бишкек',
            title_ky: 'Бишкек ш.',
            title_en: 'Bishkek',
            address: 'г. Бишкек, ул. Примерная, 1',
            address_ky: 'Бишкек ш., Примерная көч., 1',
            address_en: 'Bishkek, Primernaya str., 1',
            crops: 'Научные лаборатории',
            crops_ky: 'Илимий лабораториялар',
            crops_en: 'Scientific laboratories',
            extra: 'Главное управление Кыргызского научно-исследовательского института земледелия.',
            extra_ky: 'Кыргыз дыйканчылык илим изилдөө институтунун башкы башкармалыгы.',
            extra_en: 'Headquarters of the Kyrgyz Scientific Research Institute of Agriculture.',
            color: '#2b2d42'
        },
        'KGC': {
            id: 'KGC',
            title: 'Чуйская область',
            title_ky: 'Чүй облусу',
            title_en: 'Chuy Region',
            address: 'г. Бишкек, ул. Примерная, 1',
            address_ky: 'Бишкек ш., Примерная көч., 1',
            address_en: 'Bishkek, Primernaya str., 1',
            crops: 'Сахарная свекла, зерновые, овощи',
            crops_ky: 'Кант кызылчасы, дан өсүмдүктөрү, жашылчалар',
            crops_en: 'Sugar beet, grains, vegetables',
            extra: 'Опытные участки селекции пшеницы, сахарной свеклы и ячменя.',
            extra_ky: 'Буудай, кант кызылчасы жана арпа селекциясынын тажрыйба тилкелери.',
            extra_en: 'Experimental plots for wheat, sugar beet, and barley breeding.',
            color: '#2a9d8f'
        },
        'KGY': {
            id: 'KGY',
            title: 'Иссык-Кульская область',
            title_ky: 'Ысык-Көл облусу',
            title_en: 'Issyk-Kul Region',
            address: 'г. Каракол',
            address_ky: 'Каракол ш.',
            address_en: 'Karakol city',
            crops: 'Овощи, зерновые',
            crops_ky: 'Жашылчалар, дан өсүмдүктөрү',
            crops_en: 'Vegetables, grains',
            extra: 'Иссык-Кульский высокогорный научно-опытный филиал.',
            extra_ky: 'Ысык-Көл бийик тоолуу илимий-тажрыйба филиалы.',
            extra_en: 'Issyk-Kul high-altitude scientific-experimental branch.',
            color: '#1e5e3a'
        },
        'KGJ': {
            id: 'KGJ',
            title: 'Джалал-Абадская область',
            title_ky: 'Жалал-Абад облусу',
            title_en: 'Jalal-Abad Region',
            address: 'с. Тогуз-Торо',
            address_ky: 'Тогуз-Торо айылы',
            address_en: 'Toguz-Toro village',
            crops: 'Овощные культуры',
            crops_ky: 'Жашылча өсүмдүктөрү',
            crops_en: 'Vegetable crops',
            extra: 'Тогуз-Тороуский опытный пункт садоводства и овощеводства.',
            extra_ky: 'Тогуз-Торо тажрыйбалык мөмө-жемиш жана жашылча өстүрүү пункту.',
            extra_en: 'Toguz-Toro experimental point of horticulture and vegetable growing.',
            color: '#f4a261'
        },
        'KGN': {
            id: 'KGN',
            title: 'Нарынская область',
            title_ky: 'Нарын облусу',
            title_en: 'Naryn Region',
            address: 'ул. Ленина, 209',
            address_ky: 'Ленин көч., 209',
            address_en: 'Lenin str., 209',
            crops: 'Семеноводство',
            crops_ky: 'Үрөнчүлүк',
            crops_en: 'Seed production',
            extra: 'Нарынский высокогорный семеноводческий пункт.',
            extra_ky: 'Нарын бийик тоолуу үрөнчүлүк пункту.',
            extra_en: 'Naryn high-altitude seed production point.',
            color: '#4ea8de'
        },
        'KGO': {
            id: 'KGO',
            title: 'Ошская область',
            title_ky: 'Ош облусу',
            title_en: 'Osh Region',
            address: 'с. Кара-Суу, ул. Большевик',
            address_ky: 'Кара-Суу айылы, Большевик көч.',
            address_en: 'Kara-Suu village, Bolshevik str.',
            crops: 'Зерновые культуры',
            crops_ky: 'Дан өсүмдүктөрү',
            crops_en: 'Grain crops',
            extra: 'Кара-Сууйская опытно-селекционная станция.',
            extra_ky: 'Кара-Суу тажрыйба-селекциялык станциясы.',
            extra_en: 'Kara-Suu experimental breeding station.',
            color: '#e76f51'
        },
        'KGT': {
            id: 'KGT',
            title: 'Таласская область',
            title_ky: 'Талас облусу',
            title_en: 'Talas Region',
            address: 'г. Талас',
            address_ky: 'Талас ш.',
            address_en: 'Talas city',
            crops: 'Бобовые культуры',
            crops_ky: 'Буурчак өсүмдүктөрү',
            crops_en: 'Legumes',
            extra: 'Таласский филиал по селекции фасоли и гороха.',
            extra_ky: 'Фасоль жана буурчак селекциясы боюнча Талас филиалы.',
            extra_en: 'Talas branch for bean and pea breeding.',
            color: '#8ab17d'
        }
    };

    const getTranslation = (item, field) => {
        if (currentLang === 'ky') {
            return item[field + '_ky'] || item[field] || '';
        } else if (currentLang === 'en') {
            return item[field + '_en'] || item[field] || '';
        } else {
            return item[field] || '';
        }
    };

    // Tooltip elements
    const tooltip = document.getElementById('map-tooltip');
    const tooltipTitle = document.getElementById('tooltip-title');
    const tooltipCrops = document.getElementById('tooltip-crops');

    // Details panel elements
    const panel = document.getElementById('region-info-panel');
    const panelContent = document.getElementById('region-info-content');
    const panelPlaceholder = document.getElementById('region-info-placeholder');
    const panelAction = document.getElementById('region-info-action');
    const panelBadgeCrop = document.getElementById('region-badge-crop');

    const infoTitle = panelContent.querySelector('#region-info-title');
    const infoAddress = panelContent.querySelector('#region-info-address .address-text');
    const infoCrops = panelContent.querySelector('#region-info-crops .crops-text');
    const infoExtra = panelContent.querySelector('#region-info-extra');
    const infoLink = document.getElementById('region-info-link');

    // Mouse interactive functions
    document.querySelectorAll('.region-path').forEach(path => {
        const id = path.getAttribute('data-id');
        const info = regions[id];

        if (info) {
            // Mouse Enter (Tooltip show and details panel highlight preview)
            path.addEventListener('mouseenter', function() {
                tooltipTitle.textContent = getTranslation(info, 'title');
                tooltipCrops.textContent = getTranslation(info, 'crops');
                tooltip.style.display = 'block';
            });

            // Mouse Move (Tooltip position follow)
            path.addEventListener('mousemove', function(e) {
                const rect = document.querySelector('.map-wrapper').getBoundingClientRect();
                tooltip.style.left = (e.clientX - rect.left + 15) + 'px';
                tooltip.style.top = (e.clientY - rect.top + 15) + 'px';
            });

            // Mouse Leave (Tooltip hide)
            path.addEventListener('mouseleave', function() {
                tooltip.style.display = 'none';
            });

            // Click Handler (Select region details & update panel)
            path.addEventListener('click', function() {
                // Focus and style path
                document.querySelectorAll('.region-path').forEach(p => {
                    p.style.fillOpacity = '0.85';
                    p.style.strokeWidth = '1.5';
                    p.style.stroke = '#ffffff';
                });
                
                path.style.fillOpacity = '1';
                path.style.strokeWidth = '3.5';
                path.style.stroke = '#ffffff';

                // Update detail card panel contents
                infoTitle.textContent = getTranslation(info, 'title');
                infoAddress.textContent = getTranslation(info, 'address');
                infoCrops.textContent = getTranslation(info, 'crops');
                infoExtra.textContent = getTranslation(info, 'extra');
                infoLink.href = 'plot.php?id=' + id + '&lang=' + currentLang;

                // Border matching region crop color
                panel.style.borderColor = info.color;

                // Badge display
                panelBadgeCrop.textContent = getTranslation(info, 'crops');
                panelBadgeCrop.classList.remove('d-none');
                panelBadgeCrop.style.backgroundColor = info.color;

                // Toggle visibility
                panelPlaceholder.style.display = 'none';
                panelContent.style.display = 'block';
                panelAction.style.display = 'block';
            });
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>