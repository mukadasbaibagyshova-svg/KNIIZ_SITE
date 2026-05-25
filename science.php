<?php
include_once 'includes/lang.php';
$page_title = t('page_title_science');
$page_head = '<link rel="stylesheet" href="assets/css/departments.css?v=' . time() . '">';
include 'includes/header.php';

$dept_tags = [
    'wheat' => 'Селекция',
    'barley' => 'Селекция',
    'corn' => 'Селекция',
    'fruit_veg' => 'Технологии',
    'soil' => 'Почвоведение',
    'agrochemistry' => 'Агрохимия',
    'sugarbeet' => 'Селекция',
];

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
        'image' => 'assets/images/ячмень.jpg'
    ],
    [
        'id' => 'corn',
        'title' => t('structure_detail_corn_title'),
        'desc' => 'Создание высокопродуктивных гибридов кукурузы, первичное семеноводство и селекция инбредных линий.',
        'image' => 'assets/images/corn.jpg'
    ],
    [
        'id' => 'sugarbeet',
        'title' => t('structure_detail_sugarbeet_title'),
        'desc' => 'Селекция гибридов на основе ЦМС, первичное семеноводство и оценка качества корнеплодов.',
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

<style>
/* Modern Farm Styling for Science Page */
body {
    background-color: #ffffff;
}
.org-container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 60px 20px;
}
.org-main-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    padding: 50px 30px;
    text-align: center;
    border: 1px solid rgba(0,0,0,0.04);
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}
.org-main-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 6px;
    background: #10b981;
}
.org-main-title {
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 36px;
    color: #0f172a;
    margin-bottom: 15px;
}
.org-main-subtitle {
    font-size: 18px;
    color: #64748b;
    max-width: 800px;
    margin: 0 auto;
}
.org-grid-title {
    font-family: 'Outfit', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    display: inline-block;
}
.org-grid-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: #10b981;
    border-radius: 3px;
}

/* Cards */
.org-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    border: 1px solid rgba(0,0,0,0.06);
    overflow: hidden;
    height: 100%;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
}
.org-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(16, 185, 129, 0.1);
    border-color: rgba(16, 185, 129, 0.3);
    color: inherit;
}
.org-card-img {
    width: 100%;
    height: 350px;
    object-fit: cover;
}
.org-card-body {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.org-card-title {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
}
.org-card-desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}
.org-card-btn {
    align-self: flex-start;
    font-weight: 600;
    color: #10b981;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
}
.org-card:hover .org-card-btn {
    color: #059669;
}

/* Three Columns Section */
.org-section-container {
    padding: 40px;
    background: #f8fafc;
    border-radius: 24px;
    margin-bottom: 40px;
    border: 1px solid rgba(0,0,0,0.03);
}

</style>

<main>
    <div class="org-container">
        
        <!-- TOP CARD: Institute Name -->
        <div class="detail-hero-card" style="display: flex; flex-wrap: wrap; background: #ffffff; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 60px; border: 1px solid rgba(0,0,0,0.04);">
            <div class="detail-hero-image" style="flex: 1 1 50%; min-height: 400px; background: url('assets/images/hero1.jpg') center/cover;"></div>
            <div class="detail-hero-content" style="flex: 1 1 50%; padding: 60px; display: flex; flex-direction: column; justify-content: center;">
                <!-- <span class="detail-badge" style="display: inline-block; padding: 8px 16px; background: #10b981; color: #ffffff; border-radius: 30px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; align-self: flex-start;">Институт</span> -->
                <h1 class="detail-title" style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-bottom: 20px;">Кыргызский научно-исследовательский институт земледелия</h1>
                <p class="detail-summary" style="font-size: 18px; color: #475569; line-height: 1.6; margin-bottom: 30px;">Мы работаем по направлениям селекции, агрономии, почвоведения и семеноводства, чтобы дать стране новые сорта и технологические решения.</p>
            </div>
        </div>

        <div class="row g-5">

            <!-- Научно-исследовательские отделы -->
            <div class="col-12">
                <section class="depts-section-embed">
                    <div class="depts-toolbar">
                        <h2 class="depts-toolbar__label">Научно-исследовательские отделы</h2>
                        <span class="depts-toolbar__count">7 подразделений</span>
                    </div>
                    <div class="depts-grid">
                        <?php
                        $dept_ids = ['wheat', 'barley', 'corn', 'sugarbeet', 'fruit_veg', 'soil', 'agrochemistry'];
                        $dept_index = 0;
                        foreach ($departments as $dept):
                            if (!in_array($dept['id'], $dept_ids, true)) continue;
                            $dept_index++;
                            $tag = $dept_tags[$dept['id']] ?? 'НИР';
                        ?>
                            <a href="structure-detail.php?item=<?php echo $dept['id']; ?>&lang=<?php echo currentLang(); ?>" class="dept-card-v2">
                                <div class="dept-card-v2__media">
                                    <img src="<?php echo htmlspecialchars($dept['image']); ?>" alt="" loading="lazy" decoding="async">
                                    <span class="dept-card-v2__index"><?php echo str_pad((string) $dept_index, 2, '0', STR_PAD_LEFT); ?></span>
                                    <span class="dept-card-v2__tag"><?php echo htmlspecialchars($tag); ?></span>
                                </div>
                                <div class="dept-card-v2__body">
                                    <h3 class="dept-card-v2__title"><?php echo htmlspecialchars($dept['title']); ?></h3>
                                    <p class="dept-card-v2__desc"><?php echo htmlspecialchars($dept['desc']); ?></p>
                                    <span class="dept-card-v2__link">
                                        Подробнее
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>

            <!-- COLUMN 3: Branches (Филиалы) -->
            <div class="col-12">
                <div class="org-section-container mt-5">
                    <div class="text-center mb-5">
                        <h2 class="org-grid-title">Региональные филиалы</h2>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <?php 
                        $regional_branches = [
                            [
                                'title' => 'ГП Кыргызская опытно-селекционная станция по сахарной свекле',
                                'address' => 'Чуйская область, Сокулукский район, с. Первомайское',
                                'activity' => 'Первичное семеноводство, производство семян сахарной свеклы и других культур',
                                'area' => '147,0 га',
                                'director' => 'Есеналиев Кубанычбек Дженишбекович',
                                'phone' => '0553 730 335',
                                'image' => 'assets/images/svekla.png'
                            ],
                            [
                                'title' => 'ГП Семеноводческое хозяйство «Жаны-Пахта»',
                                'address' => 'Чуйская область, Сокулукский район, с. Жаны-Пахта',
                                'activity' => 'Семеноводство сельхозкультур высших репродукций, земледелие',
                                'area' => '482,0 га',
                                'director' => 'Эргешов Арзымат Нурмаматович',
                                'phone' => '0705 619 915',
                                'image' => 'assets/images/wheet.png'
                            ],
                            [
                                'title' => 'ГП Кыргызская опытная станция по хлопководству',
                                'address' => 'Ошская область, Кара-Суйский район, с. Большевик',
                                'activity' => 'Первичное семеноводство хлопчатника и зерновых культур',
                                'area' => '286,0 га',
                                'director' => 'Ырысов Абдиашим Толонович',
                                'phone' => '0556 140 660',
                                'image' => 'assets/images/hlopok.png'
                            ],
                            [
                                'title' => 'ГП Иссык-Кульская опытно-селекционная станция',
                                'address' => 'Иссык-Кульская область, Ак-Суйский район, с. Челпек',
                                'activity' => 'Семеноводство картофеля, производство сельхозкультур',
                                'area' => '102,0 га',
                                'director' => 'Осмонов Дайырбек Турсунгазиевич',
                                'phone' => '0709 650 412',
                                'image' => 'assets/images/potato.png'
                            ],
                            [
                                'title' => 'ГУ Нарынская опытная станция',
                                'address' => 'Нарынская область, г. Нарын',
                                'activity' => 'Внедрение высокопродуктивных сортов сельхозкультур, земледелие',
                                'area' => '31,09 га',
                                'director' => 'Эралиева Асел Муканбетовна',
                                'phone' => '0700 052 309',
                                'image' => 'assets/images/wheet1.jpg'
                            ],
                            [
                                'title' => 'ГП Бургандинский опорный пункт',
                                'address' => 'Баткенская область, Кадамжайский район, с. Кыргыз Кыштак',
                                'activity' => 'Производство плодовых, косточковых культур и винограда',
                                'area' => '24,95 га',
                                'director' => 'Юзбаев Бахтияр Абдыхалилович',
                                'phone' => '0507 379 188',
                                'image' => 'assets/images/grape.png'
                            ],
                            [
                                'title' => 'ГУ Семеноводческое хозяйство «Атай»',
                                'address' => 'Жалал-Абадская область, Тогуз-Тороуский район, с. Атай',
                                'activity' => 'Семеноводческое хозяйство',
                                'area' => '125,8 га',
                                'director' => 'Сакеев Жыргалбек Керимжанович',
                                'phone' => '0706 341 145',
                                'image' => 'assets/images/corn.jpg'
                            ],
                            [
                                'title' => 'ГП Семеноводческое хозяйство «Ак-Алтын»',
                                'address' => 'Ошская область, Кара-Суйский район, Кашкар Кыштак а/о, с. Кенжегул',
                                'activity' => 'Семеноводческое хозяйство',
                                'area' => '57,0 га',
                                'director' => 'Усобаев Акылбек Сатыбалдыевич',
                                'phone' => '0550 170 164',
                                'image' => 'assets/images/hlopoknapole.png'
                            ]
                        ];
                        
                        foreach ($regional_branches as $branch):
                        ?>
                            <div class="col-lg-6 col-12">
                                <div class="org-card" style="cursor: default;">
                                    <img src="<?php echo $branch['image']; ?>" alt="<?php echo $branch['title']; ?>" class="org-card-img">
                                    <div class="org-card-body">
                                        <h3 class="org-card-title"><?php echo $branch['title']; ?></h3>
                                        <div class="org-card-desc">
                                            <p class="mb-1"><strong>Адрес:</strong> <?php echo $branch['address']; ?></p>
                                            <p class="mb-1"><strong>Деятельность:</strong> <?php echo $branch['activity']; ?></p>
                                            <p class="mb-1"><strong>Площадь:</strong> <?php echo $branch['area']; ?></p>
                                            <p class="mb-1"><strong>Руководитель:</strong> <?php echo $branch['director']; ?></p>
                                            <p class="mb-0"><strong>Телефон:</strong> <?php echo $branch['phone']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>