<?php
/**
 * Виджет карты земельного фонда + панель хозяйств
 *
 * @var array $land_stations
 * @var array $land_station_colors
 */
$map_id = $map_id ?? 'kml-map';
$kml_url = $kml_url ?? 'assets/data/kniiz-land-fund.kml';
$legend_title = $legend_title ?? t('maps_legend_title');
?>
<div class="agro-land-fund-widget" data-land-fund-widget>
    <div class="agro-land-fund-layout">
        <div
            id="<?php echo htmlspecialchars($map_id); ?>"
            class="agro-land-fund-map"
            data-land-fund-map
            data-kml-url="<?php echo htmlspecialchars($kml_url); ?>"
            role="application"
            aria-label="<?php echo htmlspecialchars(t('maps_land_fund_aria_label')); ?>"
        ></div>
        <aside class="agro-land-fund-legend agro-card" data-land-fund-legend>
            <h3 class="agro-land-fund-legend-title h6 mb-3"><?php echo htmlspecialchars($legend_title); ?></h3>
            <ul class="agro-land-fund-stations list-unstyled mb-0">
                <?php foreach ($land_stations as $station):
                    $color = $land_station_colors[$station['folder']] ?? '#10b981';
                ?>
                <li>
                    <button type="button" class="agro-land-fund-station-btn" data-folder="<?php echo htmlspecialchars($station['folder']); ?>">
                        <span class="agro-land-fund-swatch" style="background:<?php echo htmlspecialchars($color); ?>"></span>
                        <span class="agro-land-fund-station-name"><?php echo htmlspecialchars(isset($station['title_key']) ? t($station['title_key']) : $station['title']); ?></span>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>
