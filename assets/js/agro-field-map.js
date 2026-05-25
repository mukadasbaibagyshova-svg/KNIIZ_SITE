// assets/js/agro-field-map.js – Initialize Leaflet map for a single field
document.addEventListener('DOMContentLoaded', function () {
    const config = window.AGRO_FIELD_DETAIL_CONFIG || {};
    const field = config.field;
    if (!field) return;

    // Initialize map
    const map = L.map('field-single-map', {
        center: [0, 0], // temporary, will fit bounds later
        zoom: 15,
        scrollWheelZoom: false,
        attributionControl: false,
    });

    // Add tile layer (satellite style)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Expect field.geometry to be an array of [lat, lng] pairs (or GeoJSON)
    let layer;
    if (field.geometry && Array.isArray(field.geometry)) {
        // Assume simple polygon latlng array
        layer = L.polygon(field.geometry, {
            color: field.color || '#c9a227',
            weight: 2,
            fillOpacity: 0.3,
        }).addTo(map);
    } else if (field.geojson) {
        layer = L.geoJSON(field.geojson, {
            style: function (feature) {
                return {
                    color: field.color || '#c9a227',
                    weight: 2,
                    fillOpacity: 0.3,
                };
            },
        }).addTo(map);
    }

    if (layer) {
        map.fitBounds(layer.getBounds());
    }
});
