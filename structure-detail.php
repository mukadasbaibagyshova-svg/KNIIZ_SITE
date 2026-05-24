<?php
include_once 'includes/lang.php';

function getInitials($fullName) {
    $parts = explode(' ', trim($fullName));
    $initials = '';
    if (isset($parts[0])) $initials .= mb_substr($parts[0], 0, 1, 'UTF-8');
    if (isset($parts[1])) $initials .= mb_substr($parts[1], 0, 1, 'UTF-8');
    return mb_strtoupper($initials, 'UTF-8');
}

$page_title = t('page_title_structure');
$page_head = '<link rel="stylesheet" href="assets/css/structure-live.css?v=' . time() . '">';
include 'includes/header.php';

$structureDetails = [
    'wheat' => [
        'photoClass' => 'wheat',
        'hero_image' => 'assets/images/wheet1.jpg',
        'badge' => 'Отдел пшеницы',
        'title' => 'structure_detail_wheat_title',
        'summary' => 'Отдел селекции и первичного семеноводства пшеницы занимается созданием новых конкурентоспособных сортов мягкой и твердой пшеницы.',
        'activity' => 'Отдел проводит полный цикл работ: от подбора родительских пар и гибридизации до экологического сортоиспытания.',
        'research' => [
            'Генетическое улучшение пшеницы.',
            'Селекция на устойчивость к засухе.',
            'Изучение мировой коллекции пшеницы.'
        ],
        'head' => [
            'name' => 'Азыкова Жылдыз Кадырбековна',
            'position' => 'Зав. отделом селекции пшеницы',
            'phone' => '+996 772 123456',
            'honors' => 'Заслуженный деятель науки КР',
            'degree' => 'Кандидат сельскохозяйственных наук',
            'education' => 'Высшее',
            'image' => 'assets/images/azyikov2.jpg'
        ],
        'staff' => [
            ['name' => 'Азыкова Жылдыз Кадырбековна', 'experience' => '15', 'position' => 'Заведующая отделом', 'degree' => 'к.с.-х.н.', 'title' => 'Старший научный сотрудник', 'education' => 'Высшее'],
            ['name' => 'Токтосунов Мирлан Алмазович', 'experience' => '8', 'position' => 'Старший научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Кадыров Бакыт Кубанычбекович', 'experience' => '12', 'position' => 'Старший научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Сыдыкова Айнура Нурлановна', 'experience' => '5', 'position' => 'Научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее']
        ]
    ],
    'barley' => [
        'photoClass' => 'barley',
        'hero_image' => 'assets/images/wheet1.jpg',
        'badge' => 'Отдел ячменя',
        'title' => 'structure_detail_barley_title',
        'summary' => 'Отдел селекции и первичного семеноводства ячменя — это структурное подразделение Кыргызского научно-исследовательского института земледелия имени К.К.Азыкова, которое занимается созданием новых сортов ячменя и обеспечением их исходным семенным материалом для дальнейшего размножения.',
        'activity' => 'Отдел селекции и первичного семеноводства ячменя осуществляет разработку и внедрение новых сортов культуры, отличающихся высокой урожайностью, устойчивостью к неблагоприятным условиям и соответствием требованиям производства. Основными направлениями работы являются проведение гибридизации, отбор перспективных линий, организация полевых испытаний и научно-методическое сопровождение селекционного процесса. Подразделение обеспечивает получение и поддержание чистоты исходного семенного материала (суперэлита, элита), необходимого для дальнейшего размножения и передачи в хозяйства. Деятельность отдела направлена на укрепление семенной базы, повышение эффективности аграрного сектора и обеспечение продовольственной безопасности страны.',
        'research' => [
            'Создание новых сортов - Разработка сортов ячменя с высокой урожайностью, устойчивостью к болезням, засухе и другим стрессовым факторам.',
            'Генетико-селекционные исследования - Изучение наследуемости признаков, проведение гибридизации и отбор перспективных линий.',
            'Качество зерна - Исследование питательной ценности, технологических свойств и пригодности сортов для пищевой и кормовой промышленности.',
            'Первичное семеноводство - Получение и поддержание чистоты исходного семенного материала (суперэлита, элита), контроль сортовой идентичности.',
            'Адаптация к условиям региона - Оценка сортов в различных агроклиматических зонах для выявления наиболее устойчивых и продуктивных форм.',
            'Фитосанитарные исследования - Разработка методов защиты от болезней и вредителей, повышение иммунитета растений.'
        ],
        'projects_current' => 'Выполнения по НИР Кыргызского НИИ земледелия по теме: «Создать новые низкозатратные по ресурсам сорта ячменя, адаптированные к стрессовым факторам среды и обладающие высоким уровнем хозяйственно-полезных признаков и провести экологическое сортоиспытание».',
        'projects_completed' => '2019-2021 гг выполнено по НИР по теме: «Создать сорта ячменя для орошаемых и богарных земель, устойчивые к стрессовым факторам среды и обладающие высоким уровнем хозяйственн-полезных признаков, и провести экологическое испытание». 2022-2025 гг выполнено по НИР «Создать сорта ячменя для орошаемых и богарных земель, устойчивые к стрессовым факторам среды и обладающие высоким уровнем хозяйственно – полезных признаков и провести экологическое испытание».',
        'results' => 'Выведены сорта ярового ячменя Нарын 27, Нутанс 970, Нутанс 89, Таалай, Бестам, Ватан, Владлен, Кылым, Максат и новые сорта, озимые сорта ячменя Ардак, Жениш 60, Гаухар, Белек, Адель, Альта. В 2025 году выведены новые перспективные сорта ярового ячменя рабочим номером 7100/5 и 7012.',
        'events' => '12.07.2025 год День поля на тему Особенности возделывания зерновых и кормовых культур условиях высокогорья Кыргызстана.',
        'perspectives' => 'В ближайшие 3–5 лет деятельность отдела будет сосредоточена на следующих направлениях:
- Селекция: разработка новых сортов ячменя, устойчивых к абиотическим стрессам и основным заболеваниям, с повышенным потенциалом урожайности.
- Первичное семеноводство: совершенствование системы сертификации и контроля качества семян, расширение производственных участков.
- Инфраструктура и кадры: модернизация лабораторной базы, подготовка молодых специалистов и повышение квалификации сотрудников.
- Экономическая устойчивость: участие в государственных и международных программах, привлечение грантовых средств.
Ожидаемый результат: формирование конкурентоспособных сортов, рост объёмов сертифицированных семян и укрепление научно-производственного потенциала отдела в национальном и региональном масштабе.',
        'head' => [
            'name' => 'Иманалиев Бакытбек Табылдыевич',
            'position' => 'Зав. отделом',
            'phone' => '+996 505 011019',
            'honors' => 'Ардактуу кызматкер, 6 сентября 2025 года',
            'degree' => 'Магистр агрономии',
            'education' => 'Высшее',
            'image' => 'assets/images/imanalievbakytbek.png'
        ],
        'staff' => [
            ['name' => 'Иманалиев Бакытбек Табылдыевич', 'experience' => '7', 'position' => 'Зав. отдела', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее', 'image' => 'assets/images/imanalievbakytbek.png'],
            ['name' => 'Аккулаков Талантбек Мараимович', 'experience' => '2,5', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее', 'image' => 'assets/images/akkulakov.png'],
            ['name' => 'Эралиева Асель Мукамбетовна', 'experience' => '22', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее', 'image' => 'assets/images/asel.png'],
            ['name' => 'Тараненко Татьяна Алексеевна', 'experience' => '1', 'position' => 'н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее', 'image' => 'assets/images/taranenko.png'],
            ['name' => 'Кузнецова Валентина Леонидовна', 'experience' => '24', 'position' => 'ст. лаборант', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Среднее специальное', 'image' => 'assets/images/valentina.png'],
            ['name' => 'Немцова Любовь Васильевна', 'experience' => '17', 'position' => 'ст. лаборант', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Среднее специальное', 'image' => 'assets/images/love.png']
        ],
        'infrastructure' => 'Селекционные питомники находятся на территории Кыргызского научно-производственного объединения по земледелию в селе Первомайском Сокулукского района Чуйской области.',
        'services' => [
            'Научно-аналитические услуги: Генетический и морфологический анализ сортов; Лабораторные исследования качества семян; Экспертиза сортовых посевов.',
            'Производственные услуги и товары: Реализация оригинальных и элитных семян ячменя; Предоставление саженцев и коллекционных образцов; Создание демонстрационных участков.',
            'Консультационные услуги: Методическое сопровождение фермеров; Консультации по организации семеноводства и сертификации; Подготовка рекомендаций.',
            'Образовательные и информационные услуги: Проведение семинаров, тренингов; Издание методических материалов; Организация научных и практических конференций.',
            'Дополнительные направления: Участие в международных проектах; Разработка инновационных технологий; Формирование семенного банка и базы данных сортов.'
        ]
    ],
    'corn' => [
        'hero_image' => 'assets/images/corn.jpg',
        'badge' => 'Отдел кукурузы',
        'title' => 'structure_detail_corn_title',
        'summary' => 'Отдел кукурузы занимается научными исследованиями и селекцией кукурузы.',
    ],
    'sugarbeet' => [
        'hero_image' => 'assets/images/svekla.png',
        'badge' => 'Отдел сахарной свеклы',
        'title' => 'structure_detail_sugarbeet_title',
        'summary' => 'Отдел селекции сахарной свеклы проводит НИР по созданию гибридов.',
    ],
    'fruit_veg' => [
        'hero_image' => 'assets/images/grape.png',
        'badge' => 'Плодоовощной отдел',
        'title' => 'structure_detail_fruit_veg_title',
        'summary' => 'Плодоовощной отдел развивает технологии выращивания фруктовых и овощных культур.',
    ],
    'soil' => [
        'hero_image' => 'assets/images/potato.png',
        'badge' => 'Отдел почвоведения',
        'title' => 'structure_detail_soil_title',
        'summary' => 'Отдел почвоведения изучает свойства почв, плодородие и методы восстановления.',
    ],
    'agrochemistry' => [
        'hero_image' => 'assets/images/hlopok.png',
        'badge' => 'Отдел агрохимии',
        'title' => 'structure_detail_agrochemistry_title',
        'summary' => 'Отдел агрохимии исследует удобрения, агрохимические процессы и рекомендации.',
    ],
    'issyk' => [
        'hero_image' => 'assets/images/hlopoknapole.png',
        'badge' => 'Иссык-Кульский филиал',
        'title' => 'structure_detail_issyk_title',
        'summary' => 'Иссык-Кульский филиал представляет собой региональный научно-опытный центр.',
    ]
];

$itemId = $_GET['item'] ?? '';
if (!isset($structureDetails[$itemId])) {
    header('Location: science.php?lang=' . currentLang());
    exit;
}

$detail = $structureDetails[$itemId];
?>

<style>
/* Modern Detail Page Styling */
body {
    background-color: #ffffff;
}
.detail-main {
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
}
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 30px;
    transition: color 0.2s;
}
.back-link:hover {
    color: #10b981;
}

/* Half and Half Hero Layout */
.detail-hero-card {
    display: flex;
    flex-wrap: wrap;
    background: #ffffff;
    border-radius: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    overflow: hidden;
    margin-bottom: 60px;
    border: 1px solid rgba(0,0,0,0.04);
}
.detail-hero-image {
    flex: 1 1 50%;
    min-height: 500px;
    background-size: cover;
    background-position: center;
}
.detail-hero-content {
    flex: 1 1 50%;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.detail-badge {
    display: inline-block;
    padding: 8px 16px;
    background: #10b981;
    color: #ffffff;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
    align-self: flex-start;
}
.detail-title {
    font-family: 'Outfit', sans-serif;
    font-size: 42px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin-bottom: 20px;
}
.detail-summary {
    font-size: 18px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 30px;
}
.detail-activity {
    padding-left: 20px;
    border-left: 4px solid #10b981;
    font-size: 16px;
    color: #64748b;
    font-style: italic;
}

/* Staff Section */
.staff-section-title {
    font-family: 'Outfit', sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 40px;
    text-align: center;
}
.staff-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}
.staff-card {
    background: #f8fafc;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    transition: transform 0.3s;
    border: 1px solid rgba(0,0,0,0.03);
}
.staff-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}
.staff-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 20px;
    border: 4px solid #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}
.staff-initials {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
    border: 4px solid #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}
.staff-name {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 5px;
}
.staff-position {
    color: #10b981;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
}
.staff-details {
    color: #64748b;
    font-size: 13px;
    line-height: 1.4;
}

/* Unified Info Container */
.unified-info-card {
    background: #ffffff;
    border-radius: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    padding: 60px;
    border: 1px solid rgba(0,0,0,0.04);
}
.info-section {
    margin-bottom: 40px;
}
.info-section:last-child {
    margin-bottom: 0;
}
.info-heading {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: #10b981;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.info-heading::before {
    content: '';
    display: block;
    width: 24px;
    height: 24px;
    background: #eaf4eb;
    border-radius: 6px;
}
.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.info-list li {
    padding-left: 24px;
    position: relative;
    margin-bottom: 12px;
    color: #475569;
    line-height: 1.6;
}
.info-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    top: 0;
    color: #10b981;
    font-size: 20px;
    font-weight: bold;
}
.info-text {
    color: #475569;
    line-height: 1.6;
}

@media (max-width: 992px) {
    .detail-hero-card {
        flex-direction: column;
    }
    .detail-hero-image {
        min-height: 300px;
    }
    .detail-hero-content {
        padding: 40px 20px;
    }
    .unified-info-card {
        padding: 40px 20px;
    }
}
</style>

<main class="detail-main">
    <a href="science.php?lang=<?php echo currentLang(); ?>" class="back-link">&larr; <?php echo t('structure_detail_back'); ?></a>

    <!-- Top Hero Section -->
    <div class="detail-hero-card">
        <div class="detail-hero-image" <?php if (!empty($detail['hero_image'])): ?> style="background-image:url('<?php echo $detail['hero_image']; ?>');"<?php endif; ?>></div>
        <div class="detail-hero-content">
            <span class="detail-badge"><?php echo $detail['badge'] ?? t($detail['title']); ?></span>
            <h1 class="detail-title"><?php echo t($detail['title']); ?></h1>
            <?php if (!empty($detail['summary'])): ?>
                <p class="detail-summary"><?php echo $detail['summary']; ?></p>
            <?php endif; ?>
            <?php if (!empty($detail['activity'])): ?>
                <div class="detail-activity"><?php echo $detail['activity']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Staff Section -->
    <?php if (!empty($detail['head']) || !empty($detail['staff'])): ?>
        <h2 class="staff-section-title">Руководители и Сотрудники</h2>
        <div class="staff-grid">
            <!-- Head -->
            <?php if (!empty($detail['head'])): ?>
                <div class="staff-card" style="border: 2px solid #10b981;">
                    <?php if (!empty($detail['head']['image'])): ?>
                        <img src="<?php echo $detail['head']['image']; ?>" alt="<?php echo $detail['head']['name']; ?>" class="staff-photo">
                    <?php else: ?>
                        <div class="staff-initials"><?php echo getInitials($detail['head']['name']); ?></div>
                    <?php endif; ?>
                    <h3 class="staff-name"><?php echo $detail['head']['name']; ?></h3>
                    <p class="staff-position"><?php echo $detail['head']['position']; ?></p>
                    <div class="staff-details">
                        <?php if(!empty($detail['head']['degree'])) echo "Степень: " . $detail['head']['degree'] . "<br>"; ?>
                        <?php if(!empty($detail['head']['honors'])) echo $detail['head']['honors'] . "<br>"; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Staff -->
            <?php if (!empty($detail['staff'])): 
                // Skip the first staff member if it's the exact same name as the head
                $headName = !empty($detail['head']['name']) ? $detail['head']['name'] : '';
                foreach ($detail['staff'] as $member): 
                    if ($member['name'] === $headName) continue;
            ?>
                <div class="staff-card">
                    <?php if (!empty($member['image'])): ?>
                        <img src="<?php echo $member['image']; ?>" alt="<?php echo $member['name']; ?>" class="staff-photo">
                    <?php else: ?>
                        <div class="staff-initials"><?php echo getInitials($member['name']); ?></div>
                    <?php endif; ?>
                    <h3 class="staff-name"><?php echo $member['name']; ?></h3>
                    <p class="staff-position"><?php echo $member['position']; ?></p>
                    <div class="staff-details">
                        <?php if(!empty($member['degree']) && $member['degree'] !== 'нет') echo "Степень: " . $member['degree'] . "<br>"; ?>
                        <?php if(!empty($member['experience'])) echo "Опыт работы: " . $member['experience'] . " лет<br>"; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    <?php endif; ?>

    <!-- Unified Info Container -->
    <div class="unified-info-card">
        
        <?php if (!empty($detail['goals'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Цели отдела</h3>
                <ul class="info-list">
                    <?php foreach ($detail['goals'] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['research'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Основные направления исследований</h3>
                <ul class="info-list">
                    <?php foreach ($detail['research'] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['results'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Ключевые результаты и достижения</h3>
                <p class="info-text"><?php echo $detail['results']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['projects_current'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Текущие научные проекты</h3>
                <p class="info-text"><?php echo $detail['projects_current']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['projects_completed'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Завершенные проекты</h3>
                <p class="info-text"><?php echo $detail['projects_completed']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['services'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Услуги и товары отдела</h3>
                <ul class="info-list">
                    <?php foreach ($detail['services'] as $item): ?><li><?php echo $item; ?></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($detail['events'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Научные мероприятия</h3>
                <p class="info-text"><?php echo $detail['events']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($detail['perspectives'])): ?>
            <div class="info-section">
                <h3 class="info-heading">Перспективы развития</h3>
                <p class="info-text"><?php echo nl2br($detail['perspectives']); ?></p>
            </div>
        <?php endif; ?>
        
        <div class="info-section">
            <h3 class="info-heading">Дополнительная информация</h3>
            <p class="info-text">
                <?php if (!empty($detail['infrastructure'])) echo "<strong>Материально-техническая база:</strong> " . $detail['infrastructure'] . "<br><br>"; ?>
            </p>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>