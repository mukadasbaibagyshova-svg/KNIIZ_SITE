<?php
<<<<<<< HEAD
include_once "includes/lang.php";
$page_title = t("page_title_home");
$page_head = require __DIR__ . "/includes/map/land-fund-assets.php";
=======
include_once 'includes/lang.php';
include_once 'includes/news_helpers.php';
include_once 'includes/site_images.php';
$page_title = t('page_title_home');
$page_head = require __DIR__ . '/includes/map/land-fund-assets.php';
>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc

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
                    <img src="<?php echo siteImage('index.hero1', 'assets/images/hero1.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 1">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage('index.hero2', 'assets/images/hero2.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 2">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage('index.hero3', 'assets/images/hero3.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 3">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="<?php echo siteImage('index.hero4', 'assets/images/wheet1.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Institute image 4">
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
                                <span class="stat-label"><?php echo t('index_stat_years'); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">50+</span>
                                <span class="stat-label"><?php echo t('index_stat_staff'); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">70+</span>
                                <span class="stat-label"><?php echo t('index_stat_publications'); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">1350 га</span>
                                <span class="stat-label"><?php echo t('index_stat_landfund'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card position-relative overflow-hidden shadow-lg" style="border-radius: 24px;">
<<<<<<< HEAD
                        <img src="assets/images/about-photo.jpg" alt="<?php echo t(
                            "about_title",
                        ); ?>" class="img-fluid w-100" style="object-fit: cover; min-height: 480px;">
=======
                        <img src="<?php echo siteImage('index.about_photo', 'assets/images/about-photo.jpg'); ?>" alt="<?php echo t('about_title'); ?>" class="img-fluid w-100" style="object-fit: cover; min-height: 480px;">
>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc
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
<<<<<<< HEAD

                        $desc = mb_substr(
                            strip_tags($news["text"]),
                            0,
                            150,
                            "UTF-8",
                        );
                        if (mb_strlen($news["text"], "UTF-8") > 150) {
                            $desc .= "...";
                        }
                        $img = !empty($news["images"][0])
                            ? $upload_dir . htmlspecialchars($news["images"][0])
                            : "assets/images/wheet1.jpg";
                        $news_json = htmlspecialchars(
                            json_encode(
                                $news,
                                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
                            ),
                            ENT_QUOTES,
                            "UTF-8",
                        );
                        ?>
=======
                        $text = newsGetText($news, currentLang());
                        $title = newsGetTitle($news, currentLang());
                        $desc = mb_substr(strip_tags($text), 0, 150, 'UTF-8');
                        if (mb_strlen($text, 'UTF-8') > 150) $desc .= '...';
                        $img = !empty($news['images'][0]) ? $upload_dir . htmlspecialchars($news['images'][0]) : 'assets/images/wheet1.jpg';
                        $news_display = $news;
                        $news_display['text'] = $text;
                        $news_display['title'] = $title;
                        $news_json = htmlspecialchars(json_encode($news_display, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                ?>
>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card news-card-premium" data-news='<?= $news_json ?>' data-upload-dir="<?= $upload_dir ?>">
                            <div class="news-img-box" style="background: url('<?= $img ?>') center/cover;">
                                <span class="news-date"><?= htmlspecialchars(
                                    $news["date"],
                                ) ?></span>
                            </div>
                            <div class="news-body-premium">
<<<<<<< HEAD
                                <h3 class="news-title-premium"><?= htmlspecialchars(
                                    $news["title"],
                                ) ?></h3>
                                <p class="news-desc-premium"><?= htmlspecialchars(
                                    $desc,
                                ) ?></p>
                                <button type="button" class="news-more news-link-premium border-0 bg-transparent text-success fw-bold p-0">Подробнее &rarr;</button>
=======
                                <h3 class="news-title-premium"><?= htmlspecialchars($title) ?></h3>
                                <p class="news-desc-premium"><?= htmlspecialchars($desc) ?></p>
                                <button type="button" class="news-more news-link-premium border-0 bg-transparent text-success fw-bold p-0"><?php echo t('news_more'); ?> &rarr;</button>
>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                else:
                    echo '<p class="text-center text-muted">' . t('news_empty') . '</p>';
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
                <a href="maps.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent"><?php echo t('index_open_full_map'); ?></a>
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
                        <img src="<?php echo siteImage('index.gallery1', 'assets/images/wheet1.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery1_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery1_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery1_text'); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage('index.gallery2', 'assets/images/hlopoknapole.png'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery2_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery2_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery2_text'); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage('index.gallery3', 'assets/images/svekla.png'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery3_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery3_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery3_text'); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage('index.gallery4', 'assets/images/potato.png'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery4_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery4_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery4_text'); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage('index.gallery5', 'assets/images/corn.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery5_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery5_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery5_text'); ?></p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?php echo siteImage('index.gallery6', 'assets/images/about-photo.jpg'); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars(t('index_gallery6_alt')); ?>">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;"><?php echo t('index_gallery6_title'); ?></h5>
                            <p class="mb-0 text-white-50"><?php echo t('index_gallery6_text'); ?></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php echo t('carousel_prev'); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php echo t('carousel_next'); ?></span>
                </button>
            </div>
            <div class="text-center mt-5">
                <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent"><?php echo t('index_gallery_more'); ?></a>
            </div>
        </div>
    </section>

    <!-- SECTION 6: Contact Section -->
    <section id="contacts" class="py-5">
        <div class="container">
<<<<<<< HEAD
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="contact-form-container">
                        <h3 class="mb-4" style="font-family: var(--font-headings); font-weight: 700;"><?php echo t(
                            "contacts_form_title",
                        ); ?></h3>
                        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Сообщение отправлено!');">
                            <div class="mb-3">
                                <label for="form-name" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_name",
                                ); ?></label>
                                <input type="text" id="form-name" class="input-field" placeholder="Иван Иванов" required>
                            </div>
                            <div class="mb-3">
                                <label for="form-email" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_email_label",
                                ); ?></label>
                                <input type="email" id="form-email" class="input-field" placeholder="ivan@example.com" required>
                            </div>
                            <div class="mb-4">
                                <label for="form-msg" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t(
                                    "contacts_message",
                                ); ?></label>
                                <textarea id="form-msg" rows="5" class="textarea-field" placeholder="Введите ваше сообщение..." required></textarea>
=======
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="contact-sidebar-premium">
                        <h3><?php echo t('index_contacts_title'); ?></h3>
                        <p class="mb-4" style="opacity: 0.85;"><?php echo t('index_contacts_subtitle'); ?></p>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">📍</div>
                            <div class="contact-meta-text">
                                <strong><?php echo t('contacts_address_label'); ?></strong>
                                <p><?php echo t('contacts_address_value'); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">📞</div>
                            <div class="contact-meta-text">
                                <strong><?php echo t('index_phonefax_label'); ?></strong>
                                <p><?php echo t('contacts_phone_label'); ?>: <?php echo t('contacts_phone_value'); ?><br><?php echo t('contacts_fax_label'); ?>: <?php echo t('contacts_fax_value'); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">✉️</div>
                            <div class="contact-meta-text">
                                <strong>Email</strong>
                                <p><a href="mailto:<?php echo t('contacts_email_value'); ?>" style="color: #10b981;"><?php echo t('contacts_email_value'); ?></a></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">🕒</div>
                            <div class="contact-meta-text">
                                <strong><?php echo t('contacts_workhours_label'); ?></strong>
                                <p><?php echo t('contacts_workhours_value'); ?></p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <a href="https://www.facebook.com/" target="_blank" title="Facebook" style="width:42px;height:42px;border-radius:50%;background:#1877F2;display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12z"/></svg>
                            </a>
                            <a href="https://www.youtube.com/" target="_blank" title="YouTube" style="width:42px;height:42px;border-radius:50%;background:#FF0000;display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                            <a href="https://wa.me/" target="_blank" title="WhatsApp" style="width:42px;height:42px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" title="Instagram" style="width:42px;height:42px;border-radius:50%;background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="contact-form-container">
                        <h3 class="mb-4" style="font-family: var(--font-headings); font-weight: 700;"><?php echo t('contacts_form_title'); ?></h3>
                        <form action="contacts.php?lang=<?php echo currentLang(); ?>" method="POST">
                            <div class="mb-3">
                                <label for="form-name" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_name'); ?></label>
                                <input type="text" id="form-name" name="name" class="input-field" placeholder="<?php echo htmlspecialchars(t('index_form_name_ph')); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="form-email" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_email_label'); ?></label>
                                <input type="email" id="form-email" name="email" class="input-field" placeholder="<?php echo htmlspecialchars(t('index_form_email_ph')); ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="form-msg" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_message'); ?></label>
                                <textarea id="form-msg" name="message" rows="5" class="textarea-field" placeholder="<?php echo htmlspecialchars(t('index_form_message_ph')); ?>" required></textarea>
>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc
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

<<<<<<< HEAD
<?php include "includes/footer.php"; ?>
=======
<?php include 'includes/footer.php'; ?>

>>>>>>> 6296ae5ee820ebc0dc5edf01369d28d8e236b0fc
