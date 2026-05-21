<?php
include_once 'includes/lang.php';
$page_title = t('page_title_science');
include 'includes/header.php';

$departments = [
    [
        'id' => 'wheat',
        'title' => t('structure_detail_wheat_title'),
        'desc' => 'Разработка новых конкурентоспособных сортов пшеницы.',
        'image' => 'assets/images/wheet1.jpg'
    ],
    [
        'id' => 'barley',
        'title' => t('structure_detail_barley_title'),
        'desc' => 'Селекция и первичное семеноводство ячменя.',
        'image' => 'assets/images/wheet.png'
    ],
    [
        'id' => 'corn',
        'title' => t('structure_detail_corn_title'),
        'desc' => 'Научные исследования в области селекции гибридов кукурузы.',
        'image' => 'assets/images/corn.jpg'
    ],
    [
        'id' => 'sugarbeet',
        'title' => t('structure_detail_sugarbeet_title'),
        'desc' => 'Селекция высокосахаристых гибридов сахарной свеклы.',
        'image' => 'assets/images/svekla.png'
    ],
    [
        'id' => 'fruit_veg',
        'title' => t('structure_detail_fruit_veg_title'),
        'desc' => 'Разработка инновационных технологий выращивания плодоовощных культур.',
        'image' => 'assets/images/grape.png'
    ],
    [
        'id' => 'soil',
        'title' => t('structure_detail_soil_title'),
        'desc' => 'Изучение почвенных ресурсов и методов повышения плодородия.',
        'image' => 'assets/images/potato.png'
    ],
    [
        'id' => 'agrochemistry',
        'title' => t('structure_detail_agrochemistry_title'),
        'desc' => 'Анализ питательных веществ и систем удобрений.',
        'image' => 'assets/images/hlopok.png'
    ],
    [
        'id' => 'issyk',
        'title' => t('structure_detail_issyk_title'),
        'desc' => 'Научные исследования в Иссык-Кульском регионе.',
        'image' => 'assets/images/hlopoknapole.png'
    ]
];
?>

<main class="py-5">
    <!-- Hero Banner -->
    <div class="container mb-5">
        <div class="p-5 text-white rounded-5 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(12, 62, 33, 0.9), rgba(16, 185, 129, 0.8)), url('assets/images/wheet1.jpg') center/cover;">
            <span class="badge bg-emerald mb-3 px-3 py-2 text-uppercase fw-bold" style="font-size: 12px; letter-spacing: 1px;">Наука</span>
            <h1 class="display-4 fw-bold mb-3" style="font-family: var(--font-headings);"><?php echo t('nav_science'); ?></h1>
            <p class="fs-5 mb-0" style="max-width: 700px; opacity: 0.95;">Мы работаем по направлениям селекции, агрономии, почвоведения и семеноводства, чтобы дать стране новые сорта и технологические решения.</p>
        </div>
    </div>

    <!-- Science Content & Sidebar -->
    <div class="container">
        <div class="row g-5">
            <!-- Left Side: Research Directions -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white" style="border-radius: 20px;">
                    <h2 class="mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Ключевые направления</h2>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item border-0 px-0 py-3 text-secondary d-flex align-items-start gap-3 fs-5">
                            <span class="text-success">✔</span> Селекция зерновых и кормовых культур
                        </li>
                        <li class="list-group-item border-0 px-0 py-3 text-secondary d-flex align-items-start gap-3 fs-5">
                            <span class="text-success">✔</span> Изучение устойчивости к засухе и болезням
                        </li>
                        <li class="list-group-item border-0 px-0 py-3 text-secondary d-flex align-items-start gap-3 fs-5">
                            <span class="text-success">✔</span> Почвоведческие исследования и агрохимия
                        </li>
                        <li class="list-group-item border-0 px-0 py-3 text-secondary d-flex align-items-start gap-3 fs-5">
                            <span class="text-success">✔</span> Создание адаптивных сортов для разных регионов
                        </li>
                        <li class="list-group-item border-0 px-0 py-3 text-secondary d-flex align-items-start gap-3 fs-5">
                            <span class="text-success">✔</span> Методическая поддержка семеноводства
                        </li>
                    </ul>
                    <p class="fs-5 text-muted mb-0" style="line-height: 1.8;">Наши учёные работают на стыке практики и науки, чтобы каждый этап от лаборатории до поля был научно обоснованным.</p>
                </div>
            </div>

            <!-- Right Side: Sidebar Navigation -->
            <div class="col-lg-4">
                <!-- Info Card 1: Departments -->
                <div class="card border-0 shadow-sm p-4 mb-4 bg-white" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Научные отделы</h3>
                    <p class="text-muted small mb-4">Наш институт состоит из 8 научно-исследовательских отделов и филиалов, проводящих селекционную работу.</p>
                    <a href="#departments" class="btn-premium btn-premium-accent w-100">Перейти к отделам</a>
                </div>

                <!-- Info Card 2: Helpful links -->
                <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Полезные разделы</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <a href="news.php?lang=<?php echo currentLang(); ?>" class="d-flex align-items-center gap-2 text-decoration-none text-secondary fw-semibold">
                                <span class="fs-5">📰</span> Новости науки
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="d-flex align-items-center gap-2 text-decoration-none text-secondary fw-semibold">
                                <span class="fs-5">📷</span> Фото исследований
                            </a>
                        </li>
                        <li>
                            <a href="maps.php?lang=<?php echo currentLang(); ?>" class="d-flex align-items-center gap-2 text-decoration-none text-secondary fw-semibold">
                                <span class="fs-5">🗺️</span> Карты опытных участков
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scientific Structure Tree Section -->
    <div id="departments" class="container mt-5 pt-5">
        <div class="text-center mb-5">
            <span class="section-tag">Структура</span>
            <h2 class="section-title-premium">Интерактивное древо института</h2>
            <p class="section-subtitle-premium mx-auto" style="max-width: 700px;">
                Кыргызский научно-исследовательский институт земледелия делится на научно-исследовательские отделы и региональные опытно-селекционные филиалы.
            </p>
        </div>

        <style>
            .tree-container {
                padding: 2rem 0;
                overflow-x: auto;
                background: linear-gradient(180deg, rgba(248, 250, 247, 0.5) 0%, rgba(226, 235, 220, 0.2) 100%);
                border-radius: 30px;
                border: 1px solid rgba(12, 62, 33, 0.05);
            }
            .tree-wrapper {
                display: inline-block;
                min-width: 1000px;
                width: 100%;
                text-align: center;
            }
            .tree-node-card {
                background: white;
                border-radius: 20px;
                padding: 20px 24px;
                box-shadow: 0 10px 30px rgba(33, 108, 61, 0.05);
                border: 1px solid rgba(12, 62, 33, 0.1);
                display: inline-block;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .tree-node-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(33, 108, 61, 0.1);
            }
            .tree-root-card {
                width: 440px;
                border: 2px solid var(--primary-color);
            }
            .tree-branch-card {
                width: 320px;
                border: 1.5px solid var(--accent-color);
                background: rgba(16, 185, 129, 0.02);
            }
            .tree-leaf-card {
                width: 340px;
                display: flex;
                align-items: center;
                gap: 15px;
                margin: 0 auto;
                text-decoration: none;
                color: inherit;
                text-align: left;
                background: white;
                border-radius: 16px;
                padding: 16px;
                border: 1px solid rgba(12, 62, 33, 0.08);
                border-left: 4px solid var(--primary-color);
                box-shadow: 0 6px 15px rgba(0,0,0,0.03);
                transition: all 0.25s ease;
            }
            .tree-leaf-card:hover {
                background: var(--primary-color);
                color: white !important;
                transform: translateY(-3px) scale(1.02);
                box-shadow: 0 12px 25px rgba(12, 62, 33, 0.15);
            }
            .tree-leaf-card:hover .text-muted {
                color: rgba(255,255,255,0.7) !important;
            }
            .tree-leaf-disabled {
                width: 340px;
                display: flex;
                align-items: center;
                gap: 15px;
                margin: 0 auto;
                text-align: left;
                background: #f5f6f4;
                border-radius: 16px;
                padding: 16px;
                border: 1px solid rgba(0,0,0,0.05);
                border-left: 4px solid #b2c0b5;
                color: #7b887d;
                opacity: 0.85;
                cursor: not-allowed;
            }
            .tree-line-v {
                width: 2px;
                height: 40px;
                background: rgba(12, 62, 33, 0.15);
                margin: 0 auto;
            }
            .tree-line-h-wrap {
                position: relative;
                width: 66.66%;
                margin: 0 auto;
                height: 2px;
            }
            .tree-line-h {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: rgba(12, 62, 33, 0.15);
            }
            .tree-wrapper {
                display: inline-block;
                min-width: 1200px;
                width: 100%;
                text-align: center;
            }
            .tree-branch-split {
                display: flex;
                justify-content: space-around;
                align-items: flex-start;
                margin-top: 0;
            }
            .leaf-thumb {
                width: 50px;
                height: 50px;
                border-radius: 10px;
                background-size: cover;
                background-position: center;
                flex-shrink: 0;
            }
            #management .card {
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            #management .card:hover {
                transform: translateY(-8px);
                box-shadow: var(--shadow-lg) !important;
                border-color: rgba(16, 185, 129, 0.3) !important;
            }
        </style>

        <div class="tree-container shadow-sm p-4 bg-white mb-5">
            <div class="tree-wrapper">
                <!-- LEVEL 1: Root Node -->
                <div class="tree-node-card tree-root-card">
                    <div class="d-flex align-items-center gap-3 text-start">
                        <span class="fs-1">🔬</span>
                        <div>
                            <h4 class="mb-0 fw-bold" style="color: var(--primary-color);">КНИИЗ</h4>
                            <p class="small text-muted mb-0">Кыргызский научно-исследовательский институт земледелия</p>
                        </div>
                    </div>
                </div>

                <div class="tree-line-v"></div>

                <!-- Horizontal Connector Line Wrapper -->
                <div class="tree-line-h-wrap">
                    <div class="tree-line-h"></div>
                </div>

                <!-- LEVEL 2: Branches -->
                <div class="tree-branch-split">
                    
                    <!-- LEFT BRANCH: Правление (Management) -->
                    <div class="d-flex flex-column align-items-center" style="width: 33.33%;">
                        <div class="tree-line-v"></div>
                        <div class="tree-node-card tree-branch-card mb-4">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="fs-4">👥</span>
                                <h5 class="mb-0 fw-bold text-success"><?php echo t('nav_management'); ?></h5>
                            </div>
                        </div>
                        
                        <div class="tree-line-v" style="height: 20px;"></div>
                        
                        <!-- Leaf Nodes for Management -->
                        <div class="d-flex flex-column gap-3 w-100">
                            <a href="#management" class="tree-leaf-card">
                                <div class="leaf-thumb" style="background-image: url('assets/images/about-photo.jpg');"></div>
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 14.5px;">Руководство КНИИЗ</h6>
                                    <p class="small text-muted mb-0" style="font-size: 12px;">Аппарат управления и ученый совет</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- MIDDLE BRANCH: Scientific Departments -->
                    <div id="departments" class="d-flex flex-column align-items-center" style="width: 33.33%;">
                        <div class="tree-line-v"></div>
                        <div class="tree-node-card tree-branch-card mb-4">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="fs-4">📂</span>
                                <h5 class="mb-0 fw-bold text-success"><?php echo t('nav_departments'); ?></h5>
                            </div>
                        </div>
                        
                        <div class="tree-line-v" style="height: 20px;"></div>
                        
                        <!-- Leaf Nodes for Departments -->
                        <div class="d-flex flex-column gap-3 w-100">
                            <?php 
                            $dept_ids = ['wheat', 'barley', 'corn', 'sugarbeet', 'fruit_veg', 'soil', 'agrochemistry'];
                            foreach ($departments as $dept): 
                                if (in_array($dept['id'], $dept_ids)):
                            ?>
                                <a href="structure-detail.php?item=<?php echo $dept['id']; ?>&lang=<?php echo currentLang(); ?>" class="tree-leaf-card">
                                    <div class="leaf-thumb" style="background-image: url('<?php echo $dept['image']; ?>');"></div>
                                    <div>
                                        <h6 class="mb-1 fw-bold" style="font-size: 14.5px;"><?php echo $dept['title']; ?></h6>
                                        <p class="small text-muted mb-0" style="font-size: 12px;"><?php echo $dept['desc']; ?></p>
                                    </div>
                                </a>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>

                    <!-- RIGHT BRANCH: Regional Branches -->
                    <div id="branches" class="d-flex flex-column align-items-center" style="width: 33.33%;">
                        <div class="tree-line-v"></div>
                        <div class="tree-node-card tree-branch-card mb-4">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="fs-4">🏢</span>
                                <h5 class="mb-0 fw-bold text-success"><?php echo t('nav_branches'); ?></h5>
                            </div>
                        </div>
                        
                        <div class="tree-line-v" style="height: 20px;"></div>

                        <!-- Leaf Nodes for Branches -->
                        <div class="d-flex flex-column gap-3 w-100">
                            <!-- Clickable Issyk-Kul branch -->
                            <?php 
                            $issyk_branch = null;
                            foreach ($departments as $dept) {
                                if ($dept['id'] === 'issyk') {
                                    $issyk_branch = $dept;
                                    break;
                                }
                            }
                            if ($issyk_branch):
                            ?>
                                <a href="structure-detail.php?item=issyk&lang=<?php echo currentLang(); ?>" class="tree-leaf-card">
                                    <div class="leaf-thumb" style="background-image: url('<?php echo $issyk_branch['image']; ?>');"></div>
                                    <div>
                                        <h6 class="mb-1 fw-bold" style="font-size: 14.5px;"><?php echo $issyk_branch['title']; ?></h6>
                                        <p class="small text-muted mb-0" style="font-size: 12px;"><?php echo $issyk_branch['desc']; ?></p>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <!-- Disabled stations/branches -->
                            <div class="tree-leaf-disabled">
                                <div class="leaf-thumb" style="background-image: url('assets/images/hlopok.png'); filter: grayscale(100%);"></div>
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 14.5px;">Кара-Сууйская селекционная станция</h6>
                                    <p class="small mb-0" style="font-size: 11px; opacity: 0.8;">Профиль заполняется руководителем</p>
                                </div>
                            </div>

                            <div class="tree-leaf-disabled">
                                <div class="leaf-thumb" style="background-image: url('assets/images/corn.jpg'); filter: grayscale(100%);"></div>
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 14.5px;">Джалал-Абадский филиал КНИИЗ</h6>
                                    <p class="small mb-0" style="font-size: 11px; opacity: 0.8;">Профиль заполняется руководителем</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: Management Details (Правление) -->
    <section id="management" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag"><?php echo t('nav_management'); ?></span>
                <h2 class="section-title-premium" style="font-family: var(--font-headings); font-weight: 800; color: var(--primary-color);">Руководство института</h2>
                <p class="section-subtitle-premium mx-auto" style="max-width: 700px;">
                    Аппарат управления и Ученый совет Кыргызского научно-исследовательского института земледелия имени К.К. Азыкова
                </p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <!-- Director -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center position-relative overflow-hidden" style="border-radius: 24px; border: 1px solid rgba(12, 62, 33, 0.06);">
                        <div class="initials-avatar mx-auto mb-4 d-flex align-items-center justify-content-center text-white fw-bold fs-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); box-shadow: 0 10px 20px rgba(12,62,33,0.12);">
                            АБ
                        </div>
                        <h4 class="h5 mb-1 text-dark fw-bold" style="font-family: var(--font-headings);">Азыков Болотбек Кадырбекович</h4>
                        <p class="text-success fw-bold small mb-3">Директор КНИИЗ</p>
                        <hr class="w-25 mx-auto my-3" style="border-top: 2px solid var(--accent-color); opacity: 0.5;">
                        <ul class="text-start list-unstyled small text-muted mb-0 d-flex flex-column gap-2">
                            <li><strong>Ученая степень:</strong> Доктор сельскохозяйственных наук</li>
                            <li><strong>Звание:</strong> Профессор, Академик НАН КР</li>
                            <li><strong>Образование:</strong> Высшее (КНАУ им. К.И. Скрябина)</li>
                            <li><strong>Награды:</strong> Заслуженный деятель науки КР</li>
                            <li><strong>Контакты:</strong> +996 312 661234, info@kniiz.kg</li>
                        </ul>
                    </div>
                </div>

                <!-- Deputy Director -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center position-relative overflow-hidden" style="border-radius: 24px; border: 1px solid rgba(12, 62, 33, 0.06);">
                        <div class="initials-avatar mx-auto mb-4 d-flex align-items-center justify-content-center text-white fw-bold fs-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); box-shadow: 0 10px 20px rgba(12,62,33,0.12);">
                            КН
                        </div>
                        <h4 class="h5 mb-1 text-dark fw-bold" style="font-family: var(--font-headings);">Карабаев Нургазы Асанович</h4>
                        <p class="text-success fw-bold small mb-3">Зам. директора по научной работе</p>
                        <hr class="w-25 mx-auto my-3" style="border-top: 2px solid var(--accent-color); opacity: 0.5;">
                        <ul class="text-start list-unstyled small text-muted mb-0 d-flex flex-column gap-2">
                            <li><strong>Ученая степень:</strong> Кандидат сельскохозяйственных наук</li>
                            <li><strong>Звание:</strong> Старший научный сотрудник</li>
                            <li><strong>Образование:</strong> Высшее (МСХА им. К.А. Тимирязева)</li>
                            <li><strong>Награды:</strong> Почетная грамота Минсельхоза КР</li>
                            <li><strong>Контакты:</strong> +996 312 661235, science@kniiz.kg</li>
                        </ul>
                    </div>
                </div>

                <!-- Scientific Secretary -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center position-relative overflow-hidden" style="border-radius: 24px; border: 1px solid rgba(12, 62, 33, 0.06);">
                        <div class="initials-avatar mx-auto mb-4 d-flex align-items-center justify-content-center text-white fw-bold fs-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); box-shadow: 0 10px 20px rgba(12,62,33,0.12);">
                            ОА
                        </div>
                        <h4 class="h5 mb-1 text-dark fw-bold" style="font-family: var(--font-headings);">Осмоналиева Айгуль Саматовна</h4>
                        <p class="text-success fw-bold small mb-3">Ученый секретарь</p>
                        <hr class="w-25 mx-auto my-3" style="border-top: 2px solid var(--accent-color); opacity: 0.5;">
                        <ul class="text-start list-unstyled small text-muted mb-0 d-flex flex-column gap-2">
                            <li><strong>Ученая степень:</strong> Кандидат биологических наук</li>
                            <li><strong>Звание:</strong> Старший научный сотрудник</li>
                            <li><strong>Образование:</strong> Высшее (КНУ им. Ж. Баласагына)</li>
                            <li><strong>Награды:</strong> Отличник сельского хозяйства КР</li>
                            <li><strong>Контакты:</strong> +996 312 661236, secretary@kniiz.kg</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Department Card Grid -->
    <section id="departments-grid" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag"><?php echo t('nav_departments'); ?></span>
                <h2 class="section-title-premium" style="font-family: var(--font-headings); font-weight: 800; color: var(--primary-color);">Научно-исследовательские отделы</h2>
                <p class="section-subtitle-premium mx-auto" style="max-width: 700px;">
                    Подробные профили, достижения, проекты и кадровый состав подразделений института
                </p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($departments as $dept): ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="structure-detail.php?item=<?php echo $dept['id']; ?>&lang=<?php echo currentLang(); ?>" class="dept-card d-block">
                            <div class="dept-bg-image" style="background-image: url('<?php echo $dept['image']; ?>');"></div>
                            <div class="dept-overlay"></div>
                            <div class="dept-card-content">
                                <h3 class="dept-card-title"><?php echo $dept['title']; ?></h3>
                                <p class="dept-card-desc"><?php echo $dept['desc']; ?></p>
                                <span class="dept-card-btn">Перейти к профилю <span>&rarr;</span></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>