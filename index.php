<?php
include_once 'includes/lang.php';
$page_title = t('page_title_home');
include 'includes/header.php';

// Read geographic paths for regions
$paths_json = file_exists('scratch/extracted_paths.json') ? file_get_contents('scratch/extracted_paths.json') : '';
$paths_data = !empty($paths_json) ? json_decode($paths_json, true) : [];
?>

<main id="main-content">
    <!-- SECTION 1: Fullscreen Hero Section -->
    <section class="hero text-white position-relative d-flex align-items-center justify-content-center">
        <div class="hero-overlay"></div>
        <div class="container hero-container text-center">
            <h1 class="hero-title"><?php echo t('hero_title'); ?></h1>
            <p class="hero-description"><?php echo t('hero_text'); ?></p>
            <div class="hero-buttons">
                <a href="#about" class="btn-premium btn-premium-accent"><?php echo t('hero_button_more'); ?></a>
                <a href="#contacts" class="btn-premium btn-premium-outline"><?php echo t('hero_button_contact'); ?></a>
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
                    <span class="section-tag"><?php echo t('about_title'); ?></span>
                    <h2 class="section-title-premium mb-4"><?php echo t('about_title'); ?></h2>
                    <p class="text-muted mb-4 fs-5" style="line-height: 1.8;"><?php echo t('about_text'); ?></p>
                    
                    <!-- Advanced CSS statistics grid -->
                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">100+</span>
                                <span class="stat-label">Лет научных исследований</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">Научных сотрудников</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">70+</span>
                                <span class="stat-label">Научных публикаций</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="stat-box">
                                <span class="stat-number">25</span>
                                <span class="stat-label">Докторов и кандидатов наук</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-card position-relative overflow-hidden shadow-lg" style="border-radius: 24px;">
                        <img src="assets/images/about-photo.jpg" alt="<?php echo t('about_title'); ?>" class="img-fluid w-100" style="object-fit: cover; min-height: 480px;">
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
                <span class="section-tag"><?php echo t('news_title'); ?></span>
                <h2 class="section-title-premium"><?php echo t('news_title'); ?></h2>
                <p class="section-subtitle-premium"><?php echo t('news_intro'); ?></p>
            </div>
            
            <div class="row g-4">
                <?php
                $news_file = 'database/news.json';
                $upload_dir = 'uploads/news/';
                $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];
                $latest_news = array_slice($all_news, 0, 3);
                if ($latest_news):
                    foreach ($latest_news as $news):
                        $desc = mb_substr(strip_tags($news['text']), 0, 150, 'UTF-8');
                        if (mb_strlen($news['text'], 'UTF-8') > 150) $desc .= '...';
                        $img = !empty($news['images'][0]) ? $upload_dir . htmlspecialchars($news['images'][0]) : 'assets/images/wheet1.jpg';
                        $news_json = htmlspecialchars(json_encode($news, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card news-card-premium" data-news='<?= $news_json ?>' data-upload-dir="<?= $upload_dir ?>">
                            <div class="news-img-box" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(12, 62, 33, 0.4)), url('<?= $img ?>') center/cover;">
                                <span class="news-date"><?= htmlspecialchars($news['date']) ?></span>
                            </div>
                            <div class="news-body-premium">
                                <h3 class="news-title-premium"><?= htmlspecialchars($news['title']) ?></h3>
                                <p class="news-desc-premium"><?= htmlspecialchars($desc) ?></p>
                                <button type="button" class="news-more news-link-premium border-0 bg-transparent text-success fw-bold p-0">Подробнее &rarr;</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                else:
                    echo '<p class="text-center text-muted">Пока нет новостей.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Research Maps & Laboratories -->
    <section id="maps-preview" class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="about-card shadow-md p-4 bg-white" style="border-radius: 24px; position: relative;">
                        <div class="map-wrapper w-100">
                            <svg viewBox="0 0 800 392" width="100%" height="auto" class="kyrgyzstan-svg-map">
                                <?php if (!empty($paths_data)): ?>
                                    <?php foreach ($paths_data as $region): 
                                        $iso = $region['iso'];
                                        $id = str_replace('-', '', $iso); // KG-Y -> KGY
                                    ?>
                                        <path d="<?php echo $region['d']; ?>" 
                                              id="path-home-<?php echo strtolower($id); ?>" 
                                              data-id="<?php echo $id; ?>"
                                              data-iso="<?php echo $iso; ?>"
                                              class="region-path region-<?php echo strtolower($id); ?>" />
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <text x="400" y="200" text-anchor="middle" fill="#ccc">Error loading map paths</text>
                                <?php endif; ?>
                            </svg>
                        </div>
                        
                        <!-- Custom Mouse-Following Tooltip for homepage -->
                        <div id="map-home-tooltip" style="position: absolute; display: none; background: rgba(7, 37, 19, 0.95); backdrop-filter: var(--glass-blur); color: white; padding: 12px 18px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 10px 30px rgba(0,0,0,0.3); z-index: 100; pointer-events: none; transition: opacity 0.15s ease;">
                            <h4 id="tooltip-home-title" style="margin: 0 0 6px 0; font-size: 14px; font-weight: 700; color: var(--accent-color); font-family: var(--font-headings);"></h4>
                            <p id="tooltip-home-crops" style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.85); font-family: var(--font-text);"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <span class="section-tag"><?php echo t('maps_title'); ?></span>
                    <h2 class="section-title-premium mb-4"><?php echo t('maps_title'); ?></h2>
                    <p class="text-muted fs-5 mb-4"><?php echo t('maps_text'); ?></p>
                    <p class="text-muted mb-4"><?php echo t('maps_description_1'); ?> <?php echo t('maps_description_2'); ?></p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-emerald-soft text-success py-2 px-3 fw-semibold">Чуй: Свекла</span>
                        <span class="badge bg-emerald-soft text-success py-2 px-3 fw-semibold">Ош: Зерновые</span>
                        <span class="badge bg-emerald-soft text-success py-2 px-3 fw-semibold">Баткен: Хлопок</span>
                    </div>
                    <a href="maps.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent">Открыть полную карту</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: Gallery -->
    <section id="gallery" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag"><?php echo t('gallery_title'); ?></span>
                <h2 class="section-title-premium"><?php echo t('gallery_title'); ?></h2>
                <p class="section-subtitle-premium"><?php echo t('gallery_text'); ?></p>
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
                        <img src="assets/images/wheet1.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Посевы пшеницы">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Научные посевы</h5>
                            <p class="mb-0 text-white-50">Выведение и испытание новых сортов пшеницы, устойчивых к климатическим условиям Кыргызстана.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="assets/images/hlopoknapole.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="Сбор хлопка">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Технические культуры</h5>
                            <p class="mb-0 text-white-50">Исследования хлопка и других технических культур на южных опытных станциях института.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="assets/images/svekla.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="Сахарная свекла">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Сахарная свекла</h5>
                            <p class="mb-0 text-white-50">Селекция высокосахаристых гибридов и первичное семеноводство для отечественных аграриев.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="assets/images/potato.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="Почвоведение">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Исследования почв</h5>
                            <p class="mb-0 text-white-50">Анализ состава почв, разработка рекомендаций по сохранению плодородия и агрохимии.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="assets/images/corn.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Кукуруза">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Поля кукурузы</h5>
                            <p class="mb-0 text-white-50">Гибриды кукурузы отечественной селекции с высоким потенциалом урожайности.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img src="assets/images/about-photo.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Лаборатория">
                        <div class="carousel-caption d-none d-md-block p-4 rounded-4" style="background: rgba(12, 62, 33, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); max-width: 500px; margin-bottom: 20px; left: 50px; text-align: left;">
                            <h5 class="fw-bold text-success mb-2" style="color: var(--accent-color) !important;">Современные лаборатории</h5>
                            <p class="mb-0 text-white-50">Научно-исследовательские биотехнологические центры и фитосанитарный контроль.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon p-3 bg-dark bg-opacity-25 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="text-center mt-5">
                <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent">Посмотреть больше</a>
            </div>
        </div>
    </section>

    <!-- SECTION 6: Contact Section -->
    <section id="contacts" class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="contact-sidebar-premium">
                        <h3><?php echo t('footer_contacts_title'); ?></h3>
                        <p class="mb-5" style="opacity: 0.85;"><?php echo t('contacts_text'); ?></p>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">📍</div>
                            <div class="contact-meta-text">
                                <strong>Адрес</strong>
                                <p><?php echo t('contacts_address_text'); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">📞</div>
                            <div class="contact-meta-text">
                                <strong>Телефоны</strong>
                                <p><?php echo t('contacts_phone'); ?><br><?php echo t('contacts_fax'); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">✉️</div>
                            <div class="contact-meta-text">
                                <strong>Email</strong>
                                <p><?php echo t('contacts_email'); ?></p>
                            </div>
                        </div>
                        
                        <div class="contact-meta-item">
                            <div class="contact-meta-icon">🕒</div>
                            <div class="contact-meta-text">
                                <strong>Режим работы</strong>
                                <p><?php echo t('contacts_work_week'); ?><br><?php echo t('contacts_work_weekend'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="contact-form-container">
                        <h3 class="mb-4" style="font-family: var(--font-headings); font-weight: 700;"><?php echo t('contacts_form_title'); ?></h3>
                        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Сообщение отправлено!');">
                            <div class="mb-3">
                                <label for="form-name" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_name'); ?></label>
                                <input type="text" id="form-name" class="input-field" placeholder="Иван Иванов" required>
                            </div>
                            <div class="mb-3">
                                <label for="form-email" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_email_label'); ?></label>
                                <input type="email" id="form-email" class="input-field" placeholder="ivan@example.com" required>
                            </div>
                            <div class="mb-4">
                                <label for="form-msg" class="form-label fw-semibold text-secondary" style="font-size: 14px;"><?php echo t('contacts_message'); ?></label>
                                <textarea id="form-msg" rows="5" class="textarea-field" placeholder="Введите ваше сообщение..." required></textarea>
                            </div>
                            <button type="submit" class="btn-premium btn-premium-accent px-5"><?php echo t('contacts_send'); ?></button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentLang = '<?php echo currentLang(); ?>';
    const regions = {
        'KGB': {
            title: 'Баткенская область', title_ky: 'Баткен облусу', title_en: 'Batken Region',
            crops: 'Хлопок', crops_ky: 'Пахта', crops_en: 'Cotton'
        },
        'KGGB': {
            title: 'г. Бишкек', title_ky: 'Бишкек ш.', title_en: 'Bishkek',
            crops: 'Научные лаборатории', crops_ky: 'Илимий лабораториялар', crops_en: 'Scientific laboratories'
        },
        'KGC': {
            title: 'Чуйская область', title_ky: 'Чүй облусу', title_en: 'Chuy Region',
            crops: 'Сахарная свекла, зерновые, овощи', crops_ky: 'Кант кызылчасы, дан өсүмдүктөрү, жашылчалар', crops_en: 'Sugar beet, grains, vegetables'
        },
        'KGY': {
            title: 'Иссык-Кульская область', title_ky: 'Ысык-Көл облусу', title_en: 'Issyk-Kul Region',
            crops: 'Овощи, зерновые', crops_ky: 'Жашылчалар, дан өсүмдүктөрү', crops_en: 'Vegetables, grains'
        },
        'KGJ': {
            title: 'Джалал-Абадская область', title_ky: 'Жалал-Абад облусу', title_en: 'Jalal-Abad Region',
            crops: 'Овощные культуры', crops_ky: 'Жашылча өсүмдүктөрү', crops_en: 'Vegetable crops'
        },
        'KGN': {
            title: 'Нарынская область', title_ky: 'Нарын облусу', title_en: 'Naryn Region',
            crops: 'Семеноводство', crops_ky: 'Үрөнчүлүк', crops_en: 'Seed production'
        },
        'KGO': {
            title: 'Ошская область', title_ky: 'Ош облусу', title_en: 'Osh Region',
            crops: 'Зерновые культуры', crops_ky: 'Дан өсүмдүктөрү', crops_en: 'Grain crops'
        },
        'KGT': {
            title: 'Таласская область', title_ky: 'Талас облусу', title_en: 'Talas Region',
            crops: 'Бобовые культуры', crops_ky: 'Буурчак өсүмдүктөрү', crops_en: 'Legumes'
        }
    };

    const getTranslation = (item, field) => {
        if (currentLang === 'ky') return item[field + '_ky'] || item[field] || '';
        if (currentLang === 'en') return item[field + '_en'] || item[field] || '';
        return item[field] || '';
    };

    const tooltip = document.getElementById('map-home-tooltip');
    const tooltipTitle = document.getElementById('tooltip-home-title');
    const tooltipCrops = document.getElementById('tooltip-home-crops');

    document.querySelectorAll('#maps-preview .region-path').forEach(path => {
        const id = path.getAttribute('data-id');
        const info = regions[id];

        if (info) {
            path.addEventListener('mouseenter', function() {
                tooltipTitle.textContent = getTranslation(info, 'title');
                tooltipCrops.textContent = getTranslation(info, 'crops');
                tooltip.style.display = 'block';
            });

            path.addEventListener('mousemove', function(e) {
                const rect = path.closest('.about-card').getBoundingClientRect();
                tooltip.style.left = (e.clientX - rect.left + 15) + 'px';
                tooltip.style.top = (e.clientY - rect.top + 15) + 'px';
            });

            path.addEventListener('mouseleave', function() {
                tooltip.style.display = 'none';
            });

            path.style.cursor = 'pointer';

            path.addEventListener('click', function() {
                window.location.href = 'plot.php?id=' + id + '&lang=' + currentLang;
            });
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>