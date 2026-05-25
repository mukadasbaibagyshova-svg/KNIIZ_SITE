/**
 * Интерактивная SVG-карта Кыргызстана (maps.php)
 */
(function () {
    'use strict';

    const config = window.AGRO_COUNTRY_CONFIG || {};
    const regions = config.regions || {};
    const lang = config.lang || 'ru';
    const basePath = config.basePath || '';

    const tooltip = document.getElementById('map-tooltip');
    const tooltipTitle = document.getElementById('tooltip-title');
    const tooltipCrops = document.getElementById('tooltip-crops');

    const panel = document.getElementById('region-info-panel');
    const panelContent = document.getElementById('region-info-content');
    const panelPlaceholder = document.getElementById('region-info-placeholder');
    const panelAction = document.getElementById('region-info-action');
    const panelBadgeCrop = document.getElementById('region-badge-crop');

    if (!panel) return;

    const infoTitle = document.getElementById('region-info-title');
    const infoAddress = panelContent?.querySelector('.address-text');
    const infoCrops = panelContent?.querySelector('.crops-text');
    const infoExtra = document.getElementById('region-info-extra');
    const infoLink = document.getElementById('region-info-link');

    function t(item, field) {
        const suffix = lang === 'ru' ? '' : '_' + lang;
        return item[field + suffix] || item[field + '_ru'] || item[field] || '';
    }

    function selectRegion(id, info) {
        document.querySelectorAll('.region-path').forEach((p) => {
            p.classList.remove('is-selected');
            p.style.fillOpacity = '';
        });
        const path = document.querySelector('.region-path[data-id="' + id + '"]');
        if (path) {
            path.classList.add('is-selected');
        }

        if (infoTitle) infoTitle.textContent = t(info, 'title');
        if (infoAddress) infoAddress.textContent = t(info, 'address');
        if (infoCrops) infoCrops.textContent = t(info, 'crops');
        if (infoExtra) infoExtra.textContent = t(info, 'extra');
        if (infoLink) {
            infoLink.href = basePath + 'regions/' + info.slug + '.php?lang=' + lang;
        }

        if (panel) {
            panel.style.setProperty('--region-accent', info.color || '#c9a227');
            panel.classList.add('agro-card-accent');
        }
        if (panelBadgeCrop) {
            panelBadgeCrop.textContent = t(info, 'crops');
            panelBadgeCrop.classList.remove('d-none');
            panelBadgeCrop.style.backgroundColor = info.color;
        }

        panelPlaceholder.style.display = 'none';
        panelContent.style.display = 'block';
        panelAction.style.display = 'block';
        panelContent.classList.add('agro-fade-in');
    }

    document.querySelectorAll('.region-path').forEach((path) => {
        const id = path.getAttribute('data-id');
        const info = regions[id];
        if (!info) return;

        path.addEventListener('mouseenter', () => {
            if (tooltipTitle) tooltipTitle.textContent = t(info, 'title');
            if (tooltipCrops) tooltipCrops.textContent = t(info, 'crops');
            if (tooltip) tooltip.style.display = 'block';
        });

        path.addEventListener('mousemove', (e) => {
            const wrap = document.querySelector('.map-wrapper');
            if (!wrap || !tooltip) return;
            const rect = wrap.getBoundingClientRect();
            tooltip.style.left = e.clientX - rect.left + 16 + 'px';
            tooltip.style.top = e.clientY - rect.top + 16 + 'px';
        });

        path.addEventListener('mouseleave', () => {
            if (tooltip) tooltip.style.display = 'none';
        });

        path.addEventListener('click', () => selectRegion(id, info));

        path.addEventListener('dblclick', () => {
            window.location.href = basePath + 'regions/' + info.slug + '.php?lang=' + lang;
        });
    });
})();
