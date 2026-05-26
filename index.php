<?php
include_once "includes/lang.php";
include_once "includes/news_helpers.php";
include_once "includes/site_images.php";
$page_title = t("page_title_home");
$page_head = require __DIR__ . "/includes/map/land-fund-assets.php";

$land_station_colors = [
    "ИОСС" => "#2dc0fb",
    "ЖАНЫ ПАХТА 482 га" => "#10b981",
    "КОСС 239 га" => "#b73a67",
    "Атай" => "#e9c46a",
];
$land_stations = require __DIR__ . "/includes/map/land-stations.php";

include "includes/header.php";
?>

<main id="main-content">
    <!-- SECTION 1: Fullscreen Hero Section -->
    <section class="hero text-white position-relative d-flex align-items-center justify-content-center">
        <!-- Carousel Background -->
        <div id="heroCarousel" class="carousel slide carousel-fade position-absolute w-100 h-100" data-bs-ride="carousel" data-bs-interval="2000" style="z-index: 0; top:0; left:0;">
            <div class="carousel-inner w-100 h-100">
                <div class="carousel-item active w-100 h-100">
                    <img src="<?php echo siteImage(
                        "index.hero1",
                        "assets/images/hero1.jpg",
                    ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 1">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage(
                        "index.hero2",
                        "assets/images/hero2.jpg",
                    ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 2">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage(
                        "index.hero3",
                        "assets/images/hero3.jpg",
                    ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 3">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage(
                        "index.hero4",
                        "assets/images/wheet1.jpg",
                    ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 4">
                </div>
            </div>
            <!-- Overlay to darken the images for text readability -->
            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,0,0,0.3), rgba(0,0,0,0.6)); pointer-events: none; z-index: 1;"></div>
        </div>

        <div class="hero-overlay"></div>
        <div class="container hero-container text-center" style="position: relative; z-index: 2;">
            <h1 class="hero-title"><?php echo t("hero_title"); ?></h1>
            <p class="hero-description"><?php echo t("hero_text"); ?></p>
            <div class="hero-buttons">
                <a href="#about" class="btn-premium btn-premium-accent"><?php echo t(
                    "hero_button_more",
                ); ?></a>
                <a href="#contacts" class="btn-premium btn-premium-outline"><?php echo t(
                    "hero_button_contact",
                ); ?></a>
            </div>
        </div>
        <!-- Syngenta-inspired bottom organic curve divider -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,32L120,42.7C240,53,480,75,720,74.7C960,75,1200,53,1320,42.7L1440,32L1440,120L1320,120C1200,120,960,120,720,120C480,120,240,120,120,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- SECTION 2: About Institute -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="section-title-premium mb-4"><?php echo t(
                        "about_title",
                    ); ?></h2>
                    <p class="text-muted mb-4 fs-5" style="line-height: 1.8;"><?php echo t(
                        "about_text",
                    ); ?></p>

                    <!-- Advanced CSS statistics grid -->
                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">90+</span>
                                <span class="stat-label"><?php echo t(
                                    "index_stat_years",
                                ); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">50+</span>
                                <span class="stat-label"><?php echo t(
                                    "index_stat_staff",
                                ); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">70+</span>
                                <span class="stat-label"><?php echo t(
                                    "index_stat_publications",
                                ); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">1350 га</span>
                                <span class="stat-label"><?php echo t(
                                    "index_stat_landfund",
                                ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card position-relative overflow-hidden shadow-lg" style="border-radius: 24px;">
                        <img src="<?php echo siteImage(
                            "index.about_photo",
                            "assets/images/about-photo.jpg",
                        ); ?>" alt="<?php echo t(
    "about_title",
); ?>" class="img-fluid w-100" style="object-fit: cover; min-height: 480px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Removed departments, research, and structure sections as requested -->

    <!-- SECTION 3: News & Events (Dynamic with Modals) -->
    <section id="news" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title-premium"><?php echo t(
                    "news_title",
                ); ?></h2>
                <p class="section-subtitle-premium"><?php echo t(
                    "news_intro",
                ); ?></p>
            </div>

            <div class="row g-4">
                <?php
                $news_file = "database/news.json";
                $upload_dir = "uploads/news/";
                $all_news = file_exists($news_file)
                    ? json_decode(file_get_contents($news_file), true)
                    : [];
                $latest_news = array_slice($all_news, 0, 3);
                if ($latest_news):
                    foreach ($latest_news as $news):

                        $text = newsGetText($news, currentLang());
                        $title = newsGetTitle($news, currentLang());
                        $desc = mb_substr(strip_tags($text), 0, 150, "UTF-8");
                        if (mb_strlen($text, "UTF-8") > 150) {
                            $desc .= "...";
                        }
                        $img = !empty($news["images"][0])
                            ? $upload_dir . htmlspecialchars($news["images"][0])
                            : "assets/images/wheet1.jpg";
                        $news_display = $news;
                        $news_display["text"] = $text;
                        $news_display["title"] = $title;
                        $news_json = htmlspecialchars(
                            json_encode(
                                $news_display,
                                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
                            ),
                            ENT_QUOTES,
                            "UTF-8",
                        );
                        ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card news-card-premium" data-news='<?= $news_json ?>' data-upload-dir="<?= $upload_dir ?>">
                            <div class="news-img-box" style="background: url('<?= $img ?>') center/cover;">
                                <span class="news-date"><?= htmlspecialchars(
                                    $news["date"],
                                ) ?></span>
                            </div>
                            <div class="news-body-premium">
                                <h3 class="news-title-premium"><?= htmlspecialchars(
                                    $title,
                                ) ?></h3>
                                <p class="news-desc-premium"><?= htmlspecialchars(
                                    $desc,
                                ) ?></p>
                                <button type="button" class="news-more news-link-premium border-0 bg-transparent text-success fw-bold p-0"><?php echo t(
                                    "news_more",
                                ); ?> &rarr;</button>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                else:
                    echo '<p class="text-center text-muted">' .
                        t("news_empty") .
                        "</p>";
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Земельный фонд — интерактивная карта -->
    <section id="maps-preview" class="home-land-fund-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title-premium mb-3"><?php echo t(
                    "maps_title",
                ); ?></h2>
                <p class="section-subtitle-premium mx-auto mb-0" style="max-width: 720px;"><?php echo t(
                    "maps_text",
                ); ?></p>
            </div>
            <?php
            $map_id = "kml-map-home";
            include __DIR__ . "/includes/map/land-fund-widget.php";
            ?>
            <div class="text-center mt-4">
                <a href="maps.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent"><?php echo t(
    "index_open_full_map",
); ?></a>
            </div>
        </div>
    </section>

    <!-- SECTION 5: Gallery -->
    <section id="gallery" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title-premium"><?php echo t(
                    "gallery_title",
                ); ?></h2>
                <p class="section-subtitle-premium"><?php echo t(
                    "gallery_text",
                ); ?></p>
            </div>

            <!-- Bootstrap Carousel for Gallery -->
            <div id="galleryCarousel" class="carousel slide carousel-fade shadow-lg" data-bs-ride="carousel" style="border-radius: 24px; overflow: hidden;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
                <div class="carousel-inner" style="height: 500px;">
                    <div class="carousel-item active h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery1",
                            "assets/images/wheet1.jpg",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery1_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery1_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery1_text",
                            ); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery2",
                            "assets/images/hlopoknapole.png",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery2_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery2_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery2_text",
                            ); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery3",
                            "assets/images/svekla.png",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery3_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery3_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery3_text",
                            ); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery4",
                            "assets/images/potato.png",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery4_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery4_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery4_text",
                            ); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery5",
                            "assets/images/corn.jpg",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery5_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery5_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery5_text",
                            ); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage(
                            "index.gallery6",
                            "assets/images/about-photo.jpg",
                        ); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(
    t("index_gallery6_alt"),
); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t(
                                "index_gallery6_title",
                            ); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t(
                                "index_gallery6_text",
                            ); ?></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php echo t(
                        "carousel_prev",
                    ); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php echo t(
                        "carousel_next",
                    ); ?></span>
                </button>
            </div>
            <div class="text-center mt-5">
                <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent"><?php echo t(
    "index_gallery_more",
); ?></a>
            </div>
        </div>
    </section>

    <!-- SECTION 6: Contact Section -->
    <section id="contacts" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="contact-form-container">
                        <h3 class="mb-4" style="font-family: var(--font-headings); font-weight: 700;"><?php echo t(
                            "contacts_form_title",
                        ); ?></h3>
                        <form action="contacts.php?lang=<?php echo currentLang(); ?>" method="POST">
                            <div class="mb-3">
                                <label for="form-name" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_name",
                                ); ?></label>
                                <input type="text" id="form-name" name="name" class="input-field" placeholder="<?php echo htmlspecialchars(
                                    t("index_form_name_ph"),
                                ); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="form-email" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_email_label",
                                ); ?></label>
                                <input type="email" id="form-email" name="email" class="input-field" placeholder="<?php echo htmlspecialchars(
                                    t("index_form_email_ph"),
                                ); ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="form-msg" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_message",
                                ); ?></label>
                                <textarea id="form-msg" name="message" rows="5" class="textarea-field" placeholder="<?php echo htmlspecialchars(
                                    t("index_form_message_ph"),
                                ); ?>" required></textarea>
                            </div>
                            <button type="submit" class="btn-premium btn-premium-accent px-5"><?php echo t(
                                "contacts_send",
                            ); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal/Overlay -->
<div id="news-modal-overlay" class="news-modal-overlay"></div>
<div id="news-modal" class="news-modal">
    <div class="news-modal-gallery-wrap">
        <button id="news-modal-gallery-prev" class="news-modal-gallery-nav">&#8592;</button>
        <div id="news-modal-gallery" class="news-modal-gallery"></div>
        <button id="news-modal-gallery-next" class="news-modal-gallery-nav">&#8594;</button>
    </div>
    <div class="news-modal-content">
        <button id="news-modal-close" class="news-modal-close">&times;</button>
        <div class="news-modal-title" id="news-modal-title"></div>
        <div class="news-modal-date" id="news-modal-date"></div>
        <div class="news-modal-text" id="news-modal-text" style="white-space: pre-line;"></div>
    </div>
</div>

<link rel="stylesheet" href="assets/css/news-modal.css?v=<?php echo time(); ?>">
<script src="assets/js/news-modal.js"></script>

<?php include "includes/footer.php"; ?>
