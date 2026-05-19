import re

with open('maps.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace $page_head
content = re.sub(
    r"\$page_head = '<link rel=\"stylesheet\" href=\"https://unpkg\.com/leaflet/dist/leaflet\.css\" />';",
    """$page_head = '<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />\\n<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>';""",
    content
)

# Replace <div class="map-frame" ...>...</div>
content = re.sub(
    r'<div class="map-frame" id="kyrgyz-map".*?</div>',
    '<div class="map-frame" id="kyrgyz-map" style="width:100%; min-width:700px; height:480px; background:#e6f2ff; border-radius:12px; box-shadow:0 2px 8px #0001; z-index: 1;"></div>',
    content,
    flags=re.DOTALL
)

# Replace <script>...</script>
script_content = """<script>
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

    Object.keys(regions).forEach(function(key) {
        const info = regions[key];
        const marker = L.marker(info.coords).addTo(map);
        marker.bindPopup(`
            <div style="font-family: Arial, sans-serif;">
                <h3 style="margin-top:0; margin-bottom: 8px;">${info.title}</h3>
                <p style="margin: 4px 0;"><strong>Адрес:</strong> ${info.address}</p>
                <p style="margin: 4px 0;"><strong>Основные культуры:</strong> ${info.crops}</p>
                <p style="margin: 4px 0;">${info.extra}</p>
            </div>
        `);
    });
});
</script>"""

content = re.sub(r'<script>.*?</script>', script_content, content, flags=re.DOTALL)

with open('maps.php', 'w', encoding='utf-8') as f:
    f.write(content)
