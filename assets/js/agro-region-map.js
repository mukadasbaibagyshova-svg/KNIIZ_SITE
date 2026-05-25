/**
 * Leaflet-карта региона и полей с полигонами
 */
(function () {
    'use strict';

    // Вспомогательная функция для экранирования HTML
    function escapeHtml(str) {
        if (!str) return '';
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    // 1. Инициализация для одиночной страницы поля (field.php)
    if (window.AGRO_FIELD_DETAIL_CONFIG) {
        const detailCfg = window.AGRO_FIELD_DETAIL_CONFIG;
        const field = detailCfg.field;
        const mapEl = document.getElementById('field-single-map');
        
        if (field && mapEl && typeof L !== 'undefined') {
            const singleMap = L.map('field-single-map', {
                zoomControl: true,
                scrollWheelZoom: true,
            });

            // Спутник по умолчанию для премиум вида
            const satellite = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                { attribution: 'Tiles &copy; Esri', maxZoom: 18 }
            ).addTo(singleMap);

            const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap',
                maxZoom: 19,
            });

            L.control.layers({ 'Спутник': satellite, 'Карта': osm }, null, { collapsed: true }).addTo(singleMap);

            const coords = field.coordinates || [];
            if (coords.length >= 3) {
                const latlngs = coords.map((c) => [c[0], c[1]]);
                const poly = L.polygon(latlngs, {
                    color: '#ffffff',
                    weight: 3,
                    dashArray: '6 6',
                    fillColor: field.color || '#c9a227',
                    fillOpacity: 0.5,
                }).addTo(singleMap);

                // Всплывающее окно
                const popupHtml = '<div class="agro-popup">' +
                    '<h3>' + escapeHtml(field.name) + '</h3>' +
                    '<div class="meta">' +
                    'Культура: ' + escapeHtml(field.culture) +
                    '<br>Площадь: ' + field.hectares + ' га' +
                    '<br>Влажность: ' + (field.moisture != null ? field.moisture + '%' : '—') +
                    '</div></div>';

                poly.bindPopup(popupHtml, { className: 'agro-popup', closeButton: false }).openPopup();
                singleMap.fitBounds(poly.getBounds().pad(0.2));
            }
        }
        return; // Завершаем выполнение, если это страница деталей
    }

    // 2. Инициализация для дашборда региона (region.php)
    const cfg = window.AGRO_REGION_CONFIG || {};
    const mapEl = document.getElementById('region-map');
    if (!mapEl || typeof L === 'undefined') return;

    const lang = cfg.lang || 'ru';
    const regionSlug = cfg.regionSlug;
    const apiBase = cfg.apiBase || '../api/';
    const center = cfg.center || [41.4, 76.0];
    const zoom = cfg.zoom || 10;
    const accent = cfg.accent || '#c9a227';

    let map;
    let layerGroup;
    let fieldsData = [];
    let selectedLayer = null;
    let activeCulture = '';

    const cultureColors = cfg.cultureColors || {};
    const cultureLabels = cfg.cultureLabels || {};

    function initMap() {
        map = L.map('region-map', {
            zoomControl: true,
            scrollWheelZoom: true,
        }).setView(center, zoom);

        const satellite = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
            { attribution: 'Tiles &copy; Esri', maxZoom: 18 }
        ).addTo(map);

        const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap',
            maxZoom: 19,
        });

        L.control.layers({ 'Спутник': satellite, 'Карта': osm }, null, { collapsed: true }).addTo(map);

        layerGroup = L.layerGroup().addTo(map);
    }

    function statusLabel(status) {
        const labels = cfg.statusLabels || {};
        return labels[status] || status;
    }

    function renderSidebarPanel(field) {
        const panel = document.getElementById('field-detail-panel');
        if (!panel) return;

        if (!field) {
            panel.innerHTML =
                '<div class="agro-placeholder"><div class="agro-placeholder-icon">🌾</div><p>' +
                (cfg.placeholderText || 'Выберите поле на карте') +
                '</p></div>';
            return;
        }

        const detailUrl = (cfg.basePath || '../') + 'field.php?id=' + field.id + '&lang=' + lang;
        panel.innerHTML =
            '<div class="agro-fade-in">' +
            '<div class="d-flex justify-content-between align-items-start mb-3">' +
            '<h3 class="h5 mb-0" style="color:#f4faf7">' +
            escapeHtml(field.name) +
            '</h3>' +
            '<span class="agro-status agro-status-' +
            escapeHtml(field.status || 'good') +
            '">' +
            statusLabel(field.status) +
            '</span></div>' +
            '<div class="mb-3" style="font-size:0.88rem;line-height:1.7;opacity:0.9">' +
            '<div><strong>Культура:</strong> ' + escapeHtml(field.culture) + '</div>' +
            '<div><strong>Площадь:</strong> ' + field.hectares + ' га</div>' +
            '<div><strong>Влажность:</strong> ' + (field.moisture != null ? field.moisture + '%' : '—') + '</div>' +
            '<div><strong>Год:</strong> ' + field.year + '</div>' +
            '</div>' +
            '<div class="history-timeline-container mb-3"></div>' +
            '<a href="' + detailUrl + '" class="agro-btn agro-btn-primary w-100">' +
            (cfg.moreText || 'Подробнее') + ' &rarr;</a>' +
            '</div>';

        panel.style.setProperty('--region-accent', field.color || accent);

        // Динамическая загрузка истории культур в карточку детализации
        const timelineContainer = panel.querySelector('.history-timeline-container');
        if (timelineContainer) {
            fetch(apiBase + 'field.php?id=' + field.id)
                .then((r) => r.json())
                .then((data) => {
                    const history = data.field?.history || [];
                    let hHtml = '<div class="pt-3 border-top"><div class="gp-label mb-2">История культур:</div>';
                    if (history.length > 0) {
                        hHtml += '<table class="w-100 text-start" style="font-size:0.78rem; line-height:1.6; color:#a3bba8;">';
                        history.forEach((h) => {
                            const col = cultureColors[h.culture_key] || '#fff';
                            hHtml += '<tr>' +
                                '<td><strong>' + h.year + '</strong></td>' +
                                '<td><span style="display:inline-block;width:6px;height:6px;border-radius:50%;margin-right:6px;background:' + col + '"></span>' + escapeHtml(h.culture) + '</td>' +
                                '<td class="text-end text-white">' + (h.yield_tons != null ? h.yield_tons : '—') + ' т</td>' +
                                '</tr>';
                        });
                        hHtml += '</table>';
                    } else {
                        hHtml += '<p class="small opacity-50 mb-0">История севооборота отсутствует</p>';
                    }
                    hHtml += '</div>';
                    timelineContainer.innerHTML = hHtml;
                })
                .catch(console.error);
        }
    }

    function styleForField(field, selected) {
        return {
            color: selected ? '#ffffff' : '#101c15',
            weight: selected ? 3 : 1.5,
            dashArray: selected ? '6 6' : null,
            fillColor: field.color || accent,
            fillOpacity: selected ? 0.65 : 0.45,
        };
    }

    function bindPolygon(layer, field) {
        const popupHtml =
            '<div class="agro-popup">' +
            '<h3>' + escapeHtml(field.name) + '</h3>' +
            '<div class="meta">' +
            'Культура: ' + escapeHtml(field.culture) +
            '<br>Площадь: ' + field.hectares + ' га' +
            '<br>Влажность: ' + (field.moisture != null ? field.moisture + '%' : '—') +
            '</div>' +
            '<a class="btn-link-field" href="' + (cfg.basePath || '../') + 'field.php?id=' + field.id + '&lang=' + lang + '">' +
            (cfg.moreText || 'Подробнее') + ' &rarr;</a>' +
            '</div>';

        layer.bindPopup(popupHtml, { className: 'agro-popup', maxWidth: 280, closeButton: false });

        layer.on('mouseover', function () {
            if (selectedLayer !== layer) {
                layer.setStyle({ fillOpacity: 0.58, weight: 2, color: '#ffffff' });
            }
        });
        layer.on('mouseout', function () {
            if (selectedLayer !== layer) {
                layer.setStyle(styleForField(field, false));
            }
        });
        layer.on('click', function () {
            selectField(layer, field);
        });
    }

    function selectField(layer, field) {
        if (selectedLayer) {
            const prev = selectedLayer._agroField;
            selectedLayer.setStyle(styleForField(prev, false));
        }
        selectedLayer = layer;
        layer.setStyle(styleForField(field, true));
        renderSidebarPanel(field);
        highlightListItem(field.id);
        map.panTo(layer.getBounds().getCenter(), { animate: true });
    }

    function highlightListItem(id) {
        document.querySelectorAll('.field-list-item').forEach((el) => {
            el.classList.toggle('active', parseInt(el.dataset.fieldId, 10) === id);
        });
    }

    function drawFields(fields) {
        layerGroup.clearLayers();
        const bounds = [];

        fields.forEach((field) => {
            const coords = field.coordinates || [];
            if (coords.length < 3) return;
            const latlngs = coords.map((c) => [c[0], c[1]]);
            const poly = L.polygon(latlngs, styleForField(field, false));
            poly._agroField = field;
            bindPolygon(poly, field);
            poly.addTo(layerGroup);
            bounds.push(poly.getBounds());
        });

        if (bounds.length) {
            map.fitBounds(L.featureGroup(bounds).getBounds().pad(0.1));
        }
    }

    function renderFieldList(fields) {
        const list = document.getElementById('field-list');
        if (!list) return;
        if (!fields.length) {
            list.innerHTML = '<p class="text-muted small py-3 text-center mb-0">Нет полей по запросу</p>';
            return;
        }
        list.innerHTML = fields
            .map(
                (f) =>
                    '<a href="#" class="field-list-item" data-field-id="' + f.id + '">' +
                    '<span class="field-list-swatch" style="background:' + (f.color || accent) + '"></span>' +
                    '<span class="field-list-body">' +
                    '<span class="field-list-name">' + escapeHtml(f.name) + '</span>' +
                    '<span class="field-list-meta">' + escapeHtml(f.culture) + ' · ' + f.hectares + ' га</span>' +
                    '</span></a>'
            )
            .join('');

        list.querySelectorAll('.field-list-item').forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const id = parseInt(item.dataset.fieldId, 10);
                const field = fieldsData.find((f) => f.id === id);
                if (!field) return;
                layerGroup.eachLayer((layer) => {
                    if (layer._agroField && layer._agroField.id === id) {
                        selectField(layer, field);
                    }
                });
            });
        });
    }

    function updateStats(stats) {
        const set = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val;
        };
        set('stat-fields-count', stats.fields_count ?? 0);
        set('stat-total-ha', stats.total_hectares ?? 0);
        
        const floatMoisture = document.getElementById('float-moisture');
        if (floatMoisture) {
            floatMoisture.textContent = stats.avg_moisture != null ? stats.avg_moisture + '%' : '—';
        }

        // Рендеринг графика культур
        const chart = document.getElementById('culture-bar-chart');
        if (chart && stats.cultures) {
            const entries = Object.entries(stats.cultures);
            const max = Math.max(...entries.map((e) => e[1]), 1);
            chart.innerHTML = entries
                .map(([key, count]) => {
                    const h = Math.round((count / max) * 70); // Высота в px
                    const label = cultureLabels[key] || key;
                    const color = cultureColors[key] || accent;
                    return (
                        '<div class="flex-fill d-flex flex-column align-items-center" style="max-width:40px;">' +
                        '<div class="agro-bar w-100" style="height:' + h + 'px; background:' + color + '; border-radius: 4px 4px 0 0; box-shadow: 0 0 8px ' + color + '44;"></div>' +
                        '<div class="agro-bar-label" title="' + escapeHtml(label) + '">' + escapeHtml(label.substring(0, 3)) + '.</div>' +
                        '</div>'
                    );
                })
                .join('');
        }
    }

    function loadFields() {
        const search = document.getElementById('field-search')?.value?.trim() || '';
        let url = apiBase + 'fields.php?region=' + encodeURIComponent(regionSlug);
        
        if (cfg.enterpriseId) {
            url += '&enterprise_id=' + encodeURIComponent(cfg.enterpriseId);
        }
        if (activeCulture) {
            url += '&culture=' + encodeURIComponent(activeCulture);
        }
        if (search) {
            url += '&search=' + encodeURIComponent(search);
        }

        fetch(url)
            .then((r) => r.json())
            .then((data) => {
                fieldsData = data.fields || [];
                updateStats(data.stats || {});
                drawFields(fieldsData);
                renderFieldList(fieldsData);
            })
            .catch(console.error);
    }

    function setupFilters() {
        document.querySelectorAll('.agro-filter-chip').forEach((chip) => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.agro-filter-chip').forEach((c) => c.classList.remove('active'));
                chip.classList.add('active');
                activeCulture = chip.dataset.culture || '';
                loadFields();
            });
        });

        const searchInput = document.getElementById('field-search');
        if (searchInput) {
            let timer;
            searchInput.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(loadFields, 300);
            });
        }
    }

    // Инициализация дашборда после загрузки страницы
    document.addEventListener('DOMContentLoaded', () => {
        initMap();
        setupFilters();
        loadFields();

        const preselect = parseInt(cfg.preselectFieldId, 10);
        if (preselect) {
            setTimeout(() => {
                layerGroup.eachLayer((layer) => {
                    if (layer._agroField && layer._agroField.id === preselect) {
                        selectField(layer, layer._agroField);
                    }
                });
            }, 800);
        }
    });
})();
