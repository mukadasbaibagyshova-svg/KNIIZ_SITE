<?php
/** CSS/JS для интерактивной карты земельного фонда */
return '<link rel="stylesheet" href="assets/css/agro-map.css?v=' . time() . '">'
    . '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" crossorigin="anonymous" />'
    . '<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" crossorigin="anonymous" defer></script>'
    . '<script src="https://cdn.jsdelivr.net/npm/@tmcw/togeojson@5.8.1/dist/togeojson.umd.min.js" crossorigin="anonymous" defer></script>'
    . '<script src="assets/js/maps-kml.js?v=' . time() . '" defer></script>';
