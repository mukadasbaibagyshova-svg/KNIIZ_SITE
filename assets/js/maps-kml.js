/**
 * Институт земельный фонд — карта с группировкой участков по станциям (папкам KML)
 */
(function () {
    'use strict';

    var FOLDER_COLORS = {
        'ИОСС': { color: '#2dc0fb' },
        'ЖАНЫ ПАХТА 482 га': { color: '#10b981' },
        'КОСС 239 га': { color: '#b73a67' },
        'Атай': { color: '#e9c46a' },
        'default': { color: '#10b981' }
    };

    var FOLDER_ZOOM = {
        'ИОСС': 14,
        'ЖАНЫ ПАХТА 482 га': 12,
        'КОСС 239 га': 14,
        'Атай': 14
    };

    function getOutermostFolderName(placemark) {
        var names = [];
        var el = placemark.parentElement;
        while (el) {
            if (el.tagName === 'Folder') {
                var nameEl = el.querySelector(':scope > name');
                if (nameEl && nameEl.textContent) {
                    names.push(nameEl.textContent.trim());
                }
            }
            el = el.parentElement;
        }
        return names.length ? names[names.length - 1] : '';
    }

    function buildPlacemarkFolderMap(kmlDoc) {
        var map = {};
        kmlDoc.querySelectorAll('Placemark').forEach(function (pm) {
            var id = pm.getAttribute('id');
            var name = (pm.querySelector(':scope > name') || {}).textContent;
            name = name ? name.trim() : '';
            var folder = getOutermostFolderName(pm);
            if (id) {
                map[id] = folder;
            }
            if (name) {
                map['name:' + name] = folder;
            }
        });
        return map;
    }

    function styleForFolder(folder) {
        return FOLDER_COLORS[folder] || FOLDER_COLORS.default;
    }

    function resolveFolder(feature, folderMap) {
        var props = feature.properties || {};
        if (feature.id && folderMap[feature.id]) {
            return folderMap[feature.id];
        }
        if (props.id && folderMap[props.id]) {
            return folderMap[props.id];
        }
        if (props.name && folderMap['name:' + props.name]) {
            return folderMap['name:' + props.name];
        }
        return '';
    }

    function polygonStyle(folder, state) {
        var s = styleForFolder(folder);
        if (state === 'active') {
            return {
                color: s.color,
                weight: 4,
                opacity: 1,
                fillColor: s.color,
                fillOpacity: 0.5
            };
        }
        if (state === 'dim') {
            return {
                color: s.color,
                weight: 1.5,
                opacity: 0.3,
                fillColor: s.color,
                fillOpacity: 0.1
            };
        }
        return {
            color: s.color,
            weight: 2.5,
            opacity: 0.85,
            fillColor: s.color,
            fillOpacity: 0.32
        };
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text == null ? '' : String(text);
        return div.innerHTML;
    }

    /** Извлекает площадь в гектарах из названия участка в KML */
    function parseHectaresFromName(name) {
        if (!name) {
            return null;
        }
        var matches = name.match(/(\d+(?:[.,]\d+)?)\s*га/gi);
        if (!matches || !matches.length) {
            return null;
        }
        var last = matches[matches.length - 1];
        var numMatch = last.match(/(\d+(?:[.,]\d+)?)/i);
        if (!numMatch) {
            return null;
        }
        return parseFloat(numMatch[1].replace(',', '.'));
    }

    function formatHectares(value) {
        if (value == null || isNaN(value)) {
            return null;
        }
        var text = value % 1 === 0 ? String(value) : value.toFixed(2).replace(/\.?0+$/, '');
        return text.replace('.', ',') + ' га';
    }

    function buildPlotPopupHtml(plotName, hectares) {
        var areaText = hectares != null ? formatHectares(hectares) : 'не указана в данных';
        var html = '<div class="kml-plot-popup-inner">';
        if (plotName && !/^(поле|корпус)$/i.test(plotName)) {
            html += '<p class="kml-plot-popup-title">' + escapeHtml(plotName) + '</p>';
        }
        html += '<p class="kml-plot-popup-area"><span>Площадь</span><strong>' + escapeHtml(areaText) + '</strong></p>';
        html += '</div>';
        return html;
    }

    function getStationLabelsFromPanel() {
        var labels = {};
        document.querySelectorAll('.agro-land-fund-station-btn').forEach(function (btn) {
            var folder = btn.getAttribute('data-folder');
            var nameEl = btn.querySelector('.agro-land-fund-station-name');
            if (folder && nameEl) {
                labels[folder] = nameEl.textContent.trim();
            }
        });
        return labels;
    }

    function createStationMarkerIcon(color) {
        return L.divIcon({
            className: 'kml-station-marker-wrap',
            html: '<span class="kml-station-marker-dot" style="background:' + color + '"></span>',
            iconSize: [18, 18],
            iconAnchor: [9, 9]
        });
    }

    function filterPolygonFeatures(geojson) {
        if (!geojson || !geojson.features) {
            return geojson;
        }
        geojson.features = geojson.features.filter(function (feature) {
            var type = feature.geometry && feature.geometry.type;
            return type === 'Polygon' || type === 'MultiPolygon';
        });
        return geojson;
    }

    function initLandFundMap() {
        var container = document.getElementById('kml-map');
        if (!container || typeof L === 'undefined' || typeof toGeoJSON === 'undefined') {
            return;
        }

        var kmlUrl = container.getAttribute('data-kml-url') || 'assets/data/kniiz-land-fund.kml';
        var map = L.map(container, { scrollWheelZoom: true }).setView([42.8, 75.5], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        var stationGroups = {};
        var layerFolder = new WeakMap();
        var stationMarkers = L.layerGroup().addTo(map);
        var stationLabels = getStationLabelsFromPanel();
        var geoLayer = null;

        function getStationLayers(folder) {
            return stationGroups[folder] ? stationGroups[folder].layers : [];
        }

        function setStationStyles(activeFolder) {
            if (!geoLayer) {
                return;
            }
            geoLayer.eachLayer(function (layer) {
                var folder = layerFolder.get(layer);
                if (!folder) {
                    return;
                }
                var state =
                    !activeFolder ? 'normal' : folder === activeFolder ? 'active' : 'dim';
                layer.setStyle(polygonStyle(folder, state));
            });
            document.querySelectorAll('.agro-land-fund-station-btn').forEach(function (btn) {
                btn.classList.toggle(
                    'is-active',
                    activeFolder && btn.getAttribute('data-folder') === activeFolder
                );
            });
        }

        /** Приближение ко всем полигонам станции (общий охват) */
        function zoomToStation(folder) {
            var layers = getStationLayers(folder);
            if (!layers.length) {
                return;
            }

            var group = L.featureGroup(layers);
            if (!group.getBounds().isValid()) {
                return;
            }

            map.closePopup();
            map.fitBounds(group.getBounds(), {
                padding: [56, 56],
                maxZoom: FOLDER_ZOOM[folder] || 14
            });
        }

        function focusStation(folder) {
            if (!folder) {
                return;
            }
            setStationStyles(folder);
            zoomToStation(folder);
        }

        function registerPolygon(folder, leafletLayer, popupHtml) {
            layerFolder.set(leafletLayer, folder);
            if (!stationGroups[folder]) {
                stationGroups[folder] = { layers: [] };
            }
            stationGroups[folder].layers.push(leafletLayer);

            leafletLayer.bindPopup(popupHtml, {
                className: 'kml-plot-popup',
                closeButton: true,
                autoClose: true,
                closeOnClick: true
            });

            leafletLayer.on('click', function (e) {
                L.DomEvent.stopPropagation(e);
                leafletLayer.openPopup(e.latlng);
            });
        }

        function addStationMarkers() {
            Object.keys(stationGroups).forEach(function (folder) {
                var layers = stationGroups[folder].layers;
                if (!layers.length) {
                    return;
                }
                var group = L.featureGroup(layers);
                if (!group.getBounds().isValid()) {
                    return;
                }
                var color = styleForFolder(folder).color;
                var title = stationLabels[folder] || folder;
                var marker = L.marker(group.getBounds().getCenter(), {
                    icon: createStationMarkerIcon(color),
                    zIndexOffset: 600
                });
                marker.bindTooltip(title, {
                    permanent: false,
                    sticky: true,
                    direction: 'top',
                    offset: [0, -10],
                    className: 'kml-station-tooltip'
                });
                marker.on('click', function (e) {
                    L.DomEvent.stopPropagation(e);
                    focusStation(folder);
                });
                stationMarkers.addLayer(marker);
            });
        }

        function bindStationTriggers() {
            document.querySelectorAll('.agro-land-fund-station-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    focusStation(btn.getAttribute('data-folder'));
                });
            });
            document.querySelectorAll('[data-station-focus]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    focusStation(btn.getAttribute('data-station-focus'));
                    var mapEl = document.getElementById('kml-map');
                    if (mapEl) {
                        mapEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            });
        }

        window.kniizFocusLandStation = focusStation;
        bindStationTriggers();

        fetch(kmlUrl)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('KML HTTP ' + response.status);
                }
                return response.text();
            })
            .then(function (kmlText) {
                var parser = new DOMParser();
                var kmlDoc = parser.parseFromString(kmlText, 'text/xml');
                if (kmlDoc.querySelector('parsererror')) {
                    throw new Error('KML parse error');
                }

                var folderMap = buildPlacemarkFolderMap(kmlDoc);
                var geojson = filterPolygonFeatures(toGeoJSON.kml(kmlDoc));

                geoLayer = L.geoJSON(geojson, {
                    style: function (feature) {
                        var folder = resolveFolder(feature, folderMap);
                        return polygonStyle(folder, 'normal');
                    },
                    onEachFeature: function (feature, leafletLayer) {
                        var folder = resolveFolder(feature, folderMap);
                        if (!folder) {
                            return;
                        }
                        var props = feature.properties || {};
                        var plotName = (props.name || '').trim();
                        var hectares = parseHectaresFromName(plotName);
                        var popupHtml = buildPlotPopupHtml(plotName, hectares);
                        registerPolygon(folder, leafletLayer, popupHtml);
                    }
                }).addTo(map);

                addStationMarkers();

                if (geoLayer.getBounds().isValid()) {
                    map.fitBounds(geoLayer.getBounds(), { padding: [40, 40], maxZoom: 12 });
                }
            })
            .catch(function (err) {
                console.error('Land fund KML:', err);
                container.innerHTML =
                    '<div class="kml-map-error">Не удалось загрузить карту участков.</div>';
            });
    }

    function start() {
        if (typeof L !== 'undefined' && typeof toGeoJSON !== 'undefined') {
            initLandFundMap();
        } else {
            window.addEventListener('load', initLandFundMap);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
