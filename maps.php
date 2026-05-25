<?php
include_once 'includes/lang.php';

$page_title = t('page_title_maps');
$page_head = '<link rel="stylesheet" href="assets/css/agro-map.css?v=' . time() . '">'
    . '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" crossorigin="anonymous" />'
    . '<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" crossorigin="anonymous" defer></script>'
    . '<script src="https://cdn.jsdelivr.net/npm/@tmcw/togeojson@5.8.1/dist/togeojson.umd.min.js" crossorigin="anonymous" defer></script>'
    . '<script src="assets/js/maps-kml.js?v=' . time() . '" defer></script>';
$body_class = 'maps-page';

$land_station_colors = [
    'ИОСС' => '#2dc0fb',
    'ЖАНЫ ПАХТА 482 га' => '#10b981',
    'КОСС 239 га' => '#b73a67',
    'Атай' => '#e9c46a',
];
$land_stations = require __DIR__ . '/includes/map/land-stations.php';

include 'includes/header.php';
?>

<main id="main-content" class="maps-page-main">
    <div class="container">
        <div class="mb-5 text-center">
            
            <h1 class="section-title-premium mb-3"><?php echo t('maps_title'); ?></h1>
            <p class="section-subtitle-premium mx-auto" style="max-width: 760px;"><?php echo t('maps_text'); ?></p>
        </div>

        <!-- Земельный фонд КНИИЗ (KML) -->
        <section class="agro-land-fund mb-5">
            <div class="agro-land-fund-layout">
                <div id="kml-map" class="agro-land-fund-map" data-kml-url="assets/data/kniiz-land-fund.kml" role="application" aria-label="Карта земельного фонда КНИИЗ"></div>
                <aside id="agro-land-fund-legend" class="agro-land-fund-legend agro-card">
                    <h3 class="agro-land-fund-legend-title h6 mb-3">Хозяйства</h3>
                    <ul class="agro-land-fund-stations list-unstyled mb-0">
                        <?php foreach ($land_stations as $station):
                            $color = $land_station_colors[$station['folder']] ?? '#10b981';
                        ?>
                        <li>
                            <button type="button" class="agro-land-fund-station-btn" data-folder="<?php echo htmlspecialchars($station['folder']); ?>">
                                <span class="agro-land-fund-swatch" style="background:<?php echo htmlspecialchars($color); ?>"></span>
                                <span class="agro-land-fund-station-name"><?php echo htmlspecialchars($station['title']); ?></span>
                            </button>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            </div>
        </section>

        <section class="maps-stations-info">
            <div class="row g-4">
                <?php foreach ($land_stations as $station):
                    $color = $land_station_colors[$station['folder']] ?? '#10b981';
                ?>
                <div class="col-lg-6">
                    <article class="maps-station-card" data-folder="<?php echo htmlspecialchars($station['folder']); ?>">
                        <div class="maps-station-card__img-wrap">
                            <img src="<?php echo htmlspecialchars($station['image']); ?>" alt="<?php echo htmlspecialchars($station['title']); ?>" class="maps-station-card__img" loading="lazy">
                            <span class="maps-station-card__badge" style="background:<?php echo htmlspecialchars($color); ?>"></span>
                        </div>
                        <div class="maps-station-card__body">
                            <h2 class="maps-station-card__title"><?php echo htmlspecialchars($station['title']); ?></h2>
                            <dl class="maps-station-card__meta">
                                <div class="maps-station-card__row">
                                    <dt>Площадь</dt>
                                    <dd><?php echo htmlspecialchars($station['area']); ?></dd>
                                </div>
                                <div class="maps-station-card__row">
                                    <dt>Что посеяно</dt>
                                    <dd><?php echo htmlspecialchars($station['crops']); ?></dd>
                                </div>
                                <div class="maps-station-card__row">
                                    <dt>Вид деятельности</dt>
                                    <dd><?php echo htmlspecialchars($station['activity']); ?></dd>
                                </div>
                                <div class="maps-station-card__row">
                                    <dt>Местонахождение</dt>
                                    <dd><?php echo htmlspecialchars($station['location']); ?></dd>
                                </div>
                                <div class="maps-station-card__row">
                                    <dt>Руководитель</dt>
                                    <dd><?php echo htmlspecialchars($station['director']); ?></dd>
                                </div>
                                <div class="maps-station-card__row">
                                    <dt>Контакты</dt>
                                    <dd>
                                        <a href="tel:<?php echo preg_replace('/\D+/', '', $station['phone']); ?>"><?php echo htmlspecialchars($station['phone']); ?></a>
                                        <?php if (!empty($station['email'])): ?>
                                            <br><a href="mailto:<?php echo htmlspecialchars($station['email']); ?>"><?php echo htmlspecialchars($station['email']); ?></a>
                                        <?php endif; ?>
                                    </dd>
                                </div>
                            </dl>
                            <button type="button" class="maps-station-card__map-btn" data-station-focus="<?php echo htmlspecialchars($station['folder']); ?>">
                                Показать на карте
                            </button>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
