<?php
include_once 'includes/lang.php';
$page_title = t('page_title_maps');
$page_head = '<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>';
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2 class="section-title"><?php echo t('maps_title'); ?></h2>
        <p class="section-text"><?php echo t('maps_text'); ?></p>

        <div class="map-page" style="display:flex; justify-content:center;">
            <div class="map-frame" id="kyrgyz-map" style="width:100%; min-width:700px; height:480px; background:#e6f2ff; border-radius:12px; box-shadow:0 2px 8px #0001; z-index: 1;"></div>

        </div>

        <div id="region-info-panel" style="margin-top: 20px; padding: 20px; background: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 8px; display: none;">
            <h3 id="region-info-title" style="margin-top: 0; color: #216c3d;"></h3>
            <p><strong>Адрес:</strong> <span id="region-info-address"></span></p>
            <p><strong>Основные культуры:</strong> <span id="region-info-crops"></span></p>
            <p id="region-info-extra"></p>
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





<script>
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('kyrgyz-map').setView([41.20438, 74.766098], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const regions = {
        'KGB': {
            title: 'Баткенская область',
            address: 'г. Баткен, ул. Кызыл-Кия',
            crops: 'Хлопок',
            extra: 'Дополнительная информация: ...',
            coords: [40.06259, 70.81939]
        },
        'KGGB': {
            title: 'г. Бишкек',
            address: 'г. Бишкек',
            crops: '—',
            extra: '...',
            coords: [42.8746, 74.5698]
        },
        'KGC': {
            title: 'Чуйская область',
            address: 'г. Бишкек, ул. Примерная, 1',
            crops: 'Сахарная свекла, зерновые, овощи и др.',
            extra: 'Дополнительная информация: ...',
            coords: [42.87, 74.8]
        },
        'KGY': {
            title: 'Иссык-Кульская область',
            address: 'г. Каракол',
            crops: 'Овощи, зерновые',
            extra: 'Курортная зона',
            coords: [42.4907, 78.3936]
        },
        'KGJ': {
            title: 'Джалал-Абадская область',
            address: 'с. Тогуз-Торо',
            crops: 'Овощные культуры',
            extra: '...',
            coords: [40.9332, 73.0000]
        },
        'KGN': {
            title: 'Нарынская область',
            address: 'ул. Ленина, 209',
            crops: 'Семеноводство',
            extra: '...',
            coords: [41.4287, 75.9611]
        },
        'KGO': {
            title: 'Ошская область',
            address: 'с. Кара-Суу, ул. Большевик',
            crops: 'Зерновые культуры',
            extra: '...',
            coords: [40.2, 73.0]
        },
        'KGGO': {
            title: 'г. Ош',
            address: 'г. Ош',
            crops: '—',
            extra: 'Южная столица',
            coords: [40.5140, 72.8161]
        },
        'KGT': {
            title: 'Таласская область',
            address: 'г. Талас',
            crops: '...',
            extra: '...',
            coords: [42.5228, 72.2427]
        }
    };

    const infoPanel = document.getElementById('region-info-panel');
    const infoTitle = document.getElementById('region-info-title');
    const infoAddress = document.getElementById('region-info-address');
    const infoCrops = document.getElementById('region-info-crops');
    const infoExtra = document.getElementById('region-info-extra');

    Object.keys(regions).forEach(function(key) {
        const info = regions[key];
        const marker = L.marker(info.coords).addTo(map);
        
        marker.bindTooltip(`
            <div style="font-family: Arial, sans-serif;">
                <h3 style="margin-top:0; margin-bottom: 8px;">${info.title}</h3>
                <p style="margin: 4px 0;"><strong>Адрес:</strong> ${info.address}</p>
                <p style="margin: 4px 0;"><strong>Основные культуры:</strong> ${info.crops}</p>
                <p style="margin: 4px 0;">${info.extra}</p>
            </div>
        `);

        // Переход на отдельную страницу при клике по маркеру
        marker.on('click', function() {
            window.location.href = 'plot.php?id=' + key;
        });

        marker.on('mouseover', function() {
            infoTitle.textContent = info.title;
            infoAddress.textContent = info.address;
            infoCrops.textContent = info.crops;
            infoExtra.textContent = info.extra;
            infoPanel.style.display = 'block';
        });

        marker.on('mouseout', function() {
            infoPanel.style.display = 'none';
        });
    });
});
</script>
</main>

<?php include 'includes/footer.php'; ?>