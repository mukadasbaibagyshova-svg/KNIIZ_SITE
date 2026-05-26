<?php

include_once 'includes/lang.php';



$page_title = t('page_title_maps');

$page_head = require __DIR__ . '/includes/map/land-fund-assets.php';

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


        <section class="agro-land-fund mb-5">

            <?php include __DIR__ . '/includes/map/land-fund-widget.php'; ?>

        </section>



        <section class="maps-stations-info">

            <div class="row g-4">

                <?php foreach ($land_stations as $station):

                    $color = $land_station_colors[$station['folder']] ?? '#10b981';
                    $stationTitle = isset($station['title_key']) ? t($station['title_key']) : $station['title'];
                    $stationArea = isset($station['area_key']) ? t($station['area_key']) : $station['area'];
                    $stationCrops = isset($station['crops_key']) ? t($station['crops_key']) : $station['crops'];
                    $stationActivity = isset($station['activity_key']) ? t($station['activity_key']) : $station['activity'];
                    $stationLocation = isset($station['location_key']) ? t($station['location_key']) : $station['location'];
                    $stationDirector = isset($station['director_key']) ? t($station['director_key']) : $station['director'];

                ?>

                <div class="col-lg-6">

                    <article class="maps-station-card" data-folder="<?php echo htmlspecialchars($station['folder']); ?>">

                        <div class="maps-station-card__img-wrap">

                            <img src="<?php echo htmlspecialchars($station['image']); ?>" alt="<?php echo htmlspecialchars($stationTitle); ?>" class="maps-station-card__img" loading="lazy">

                            <span class="maps-station-card__badge" style="background:<?php echo htmlspecialchars($color); ?>"></span>

                        </div>

                        <div class="maps-station-card__body">

                            <h2 class="maps-station-card__title"><?php echo htmlspecialchars($stationTitle); ?></h2>

                            <dl class="maps-station-card__meta">

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_area'); ?></dt>

                                    <dd><?php echo htmlspecialchars($stationArea); ?></dd>

                                </div>

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_crops'); ?></dt>

                                    <dd><?php echo htmlspecialchars($stationCrops); ?></dd>

                                </div>

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_activity'); ?></dt>

                                    <dd><?php echo htmlspecialchars($stationActivity); ?></dd>

                                </div>

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_location'); ?></dt>

                                    <dd><?php echo htmlspecialchars($stationLocation); ?></dd>

                                </div>

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_director'); ?></dt>

                                    <dd><?php echo htmlspecialchars($stationDirector); ?></dd>

                                </div>

                                <div class="maps-station-card__row">

                                    <dt><?php echo t('maps_label_contacts'); ?></dt>

                                    <dd>

                                        <a href="tel:<?php echo preg_replace('/\D+/', '', $station['phone']); ?>"><?php echo htmlspecialchars($station['phone']); ?></a>

                                        <?php if (!empty($station['email'])): ?>

                                            <br><a href="mailto:<?php echo htmlspecialchars($station['email']); ?>"><?php echo htmlspecialchars($station['email']); ?></a>

                                        <?php endif; ?>

                                    </dd>

                                </div>

                            </dl>

                            <button type="button" class="maps-station-card__map-btn" data-station-focus="<?php echo htmlspecialchars($station['folder']); ?>">

                                <?php echo t('maps_show_on_map'); ?>

                            </button>

                        </div>

                    </article>

                </div>

                <?php endforeach; ?>

            </div>

        </section>

    </div>

</main>

<script>
window.kniizLandFundLang = <?php echo json_encode([
    'areaLabel' => t('maps_area_label'),
    'areaUnknown' => t('maps_area_not_specified'),
    'kmlLoadError' => t('maps_kml_error'),
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>

<?php include 'includes/footer.php'; ?>

