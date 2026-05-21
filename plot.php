<?php
include_once 'includes/lang.php';
include 'includes/header.php';

// Массив данных участков (согласовано с локализацией и реальными файлами изображений)
$plots = [
    'KGB' => [
        'title' => 'Баткенская область',
        'title_ky' => 'Баткен облусу',
        'title_en' => 'Batken Region',
        'address' => 'г. Баткен, ул. Кызыл-Кия',
        'address_ky' => 'Баткен ш., Кызыл-Кыя көч.',
        'address_en' => 'Batken city, Kyzyl-Kiya str.',
        'crops' => 'Хлопок',
        'crops_ky' => 'Пахта',
        'crops_en' => 'Cotton',
        'extra' => 'Дополнительная информация: селекционная станция технических культур. Проводятся исследования по выведению высокоурожайных сортов хлопчатника, устойчивых к местным почвенно-климатическим условиям.',
        'extra_ky' => 'Кошумча маалымат: техникалык өсүмдүктөрдүн селекциялык станциясы. Жергиликтүү топурак жана климаттык шарттарга туруктуу, жогорку түшүмдүү пахта сортторун чыгаруу боюнча изилдөөлөр жүргүзүлүүдө.',
        'extra_en' => 'Additional info: breeding station of industrial crops. Research is being conducted on breeding high-yielding cotton varieties resistant to local soil and climatic conditions.',
        'image' => 'assets/images/hlopok.png'
    ],
    'KGGB' => [
        'title' => 'г. Бишкек',
        'title_ky' => 'Бишкек ш.',
        'title_en' => 'Bishkek',
        'address' => 'г. Бишкек, ул. Примерная, 1',
        'address_ky' => 'Бишкек ш., Примерная көч., 1',
        'address_en' => 'Bishkek, Primernaya str., 1',
        'crops' => 'Научные лаборатории',
        'crops_ky' => 'Илимий лабораториялар',
        'crops_en' => 'Scientific laboratories',
        'extra' => 'Главное управление Кыргызского научно-исследовательского института земледелия. Здесь проводятся передовые генетические исследования, анализы качества семенного материала и координация всех филиалов института.',
        'extra_ky' => 'Кыргыз дыйканчылык илим изилдөө институтунун башкы башкармалыгы. Бул жерде заманбап генетикалык изилдөөлөр, үрөндүн сапатын анализдөө жана институттун бардык филиалдарын координациялоо иштери жүргүзүлөт.',
        'extra_en' => 'Headquarters of the Kyrgyz Scientific Research Institute of Agriculture. Advanced genetic research, seed quality analysis, and coordination of all institute branches are carried out here.',
        'image' => 'assets/images/hlopoknapole.png'
    ],
    'KGC' => [
        'title' => 'Чуйская область',
        'title_ky' => 'Чүй облусу',
        'title_en' => 'Chuy Region',
        'address' => 'г. Бишкек, ул. Примерная, 1',
        'address_ky' => 'Бишкек ш., Примерная көч., 1',
        'address_en' => 'Bishkek, Primernaya str., 1',
        'crops' => 'Сахарная свекла, зерновые, овощи',
        'crops_ky' => 'Кант кызылчасы, дан өсүмдүктөрү, жашылчалар',
        'crops_en' => 'Sugar beet, grains, vegetables',
        'extra' => 'Опытные участки селекции пшеницы, сахарной свеклы и ячменя. Проводится разработка современных интенсивных технологий возделывания и семеноводства основных сельскохозяйственных культур Чуйской долины.',
        'extra_ky' => 'Буудай, кант кызылчасы жана арпа селекциясынын тажрыйба тилкелери. Чүй өрөөнүнүн негизги айыл чарба өсүмдүктөрүнүн үрөнчүлүгү жана заманбап интенсивдүү өстүрүү технологияларын иштеп чыгуу жүргүзүлүүдө.',
        'extra_en' => 'Experimental plots for wheat, sugar beet, and barley breeding. Development of modern intensive cultivation and seed production technologies for key agricultural crops of the Chuy Valley is conducted.',
        'image' => 'assets/images/svekla.png'
    ],
    'KGY' => [
        'title' => 'Иссык-Кульская область',
        'title_ky' => 'Ысык-Көл облусу',
        'title_en' => 'Issyk-Kul Region',
        'address' => 'г. Каракол',
        'address_ky' => 'Каракол ш.',
        'address_en' => 'Karakol city',
        'crops' => 'Овощи, зерновые',
        'crops_ky' => 'Жашылчалар, дан өсүмдүктөрү',
        'crops_en' => 'Vegetables, grains',
        'extra' => 'Иссык-Кульский высокогорный научно-опытный филиал. Исследования сфокусированы на адаптации различных сортов зерновых и овощей к климатическим условиям Прииссыккулья и высокогорных зон.',
        'extra_ky' => 'Ысык-Көл бийик тоолуу илимий-тажрыйба филиалы. Изилдөөлөр дан өсүмдүктөрүнүн жана жашылчалардын сортторун Ысык-Көл аймагынын жана бийик тоолуу зоналарынын климаттык шарттарына ылайыкташтырууга багытталган.',
        'extra_en' => 'Issyk-Kul high-altitude scientific-experimental branch. Research is focused on adapting various grain and vegetable varieties to the climatic conditions of the Issyk-Kul basin and high-altitude zones.',
        'image' => 'assets/images/wheet1.jpg'
    ],
    'KGJ' => [
        'title' => 'Джалал-Абадская область',
        'title_ky' => 'Жалал-Абад облусу',
        'title_en' => 'Jalal-Abad Region',
        'address' => 'с. Тогуз-Торо',
        'address_ky' => 'Тогуз-Торо айылы',
        'address_en' => 'Toguz-Toro village',
        'crops' => 'Овощные культуры',
        'crops_ky' => 'Жашылча өсүмдүктөрү',
        'crops_en' => 'Vegetable crops',
        'extra' => 'Тогуз-Тороуский опытный пункт садоводства и овощеводства. Основной упор делается на разведение фруктовых деревьев, ягодников и гибридов овощей, подходящих для южных предгорных регионов.',
        'extra_ky' => 'Тогуз-Торо тажрыйбалык мөмө-жемиш жана жашылча өстүрүү пункту. Түштүк тоо этектериндеги аймактарга ылайыктуу мөмө-жемиш дарактарын, мөмөлөрдү жана жашылча гибриддерин өстүрүүгө басым жасалат.',
        'extra_en' => 'Toguz-Toro experimental point of horticulture and vegetable growing. The main focus is on cultivation of fruit trees, berries, and vegetable hybrids suitable for the southern foothill regions.',
        'image' => 'assets/images/grape.png'
    ],
    'KGN' => [
        'title' => 'Нарынская область',
        'title_ky' => 'Нарын облусу',
        'title_en' => 'Naryn Region',
        'address' => 'ул. Ленина, 209',
        'address_ky' => 'Ленин көч., 209',
        'address_en' => 'Lenin str., 209',
        'crops' => 'Семеноводство',
        'crops_ky' => 'Үрөнчүлүк',
        'crops_en' => 'Seed production',
        'extra' => 'Нарынский высокогорный семеноводческий пункт. Специализируется на выращивании семенного картофеля высокой репродукции и устойчивых кормовых трав в экстремальных условиях высокогорья.',
        'extra_ky' => 'Нарын бийик тоолуу үрөнчүлүк пункту. Бийик тоонун экстремалдык шарттарында жогорку репродукциядагы үрөндүк картошканы жана туруктуу тоют чөптөрүн өстүрүүгө адистешкен.',
        'extra_en' => 'Naryn high-altitude seed production point. Specializes in cultivation of high-reproduction seed potatoes and resilient forage grasses under extreme high-altitude conditions.',
        'image' => 'assets/images/potato.png'
    ],
    'KGO' => [
        'title' => 'Ошская область',
        'title_ky' => 'Ош облусу',
        'title_en' => 'Osh Region',
        'address' => 'с. Кара-Суу, ул. Большевик',
        'address_ky' => 'Кара-Суу айылы, Большевик көч.',
        'address_en' => 'Kara-Suu village, Bolshevik str.',
        'crops' => 'Зерновые культуры',
        'crops_ky' => 'Дан өсүмдүктөрү',
        'crops_en' => 'Grain crops',
        'extra' => 'Кара-Сууйская опытно-селекционная станция. Проводит масштабную селекцию и первичное семеноводство озимой пшеницы, ячменя и кукурузы для южных областей Кыргызстана.',
        'extra_ky' => 'Кара-Суу тажрыйба-селекциялык станциясы. Кыргызстандын түштүк облустары үчүн күздүк буудайдын, арпанын жана жүгөрүнүн масштабдуу селекциясын жана биринчи үрөнчүлүгүн жүргүзөт.',
        'extra_en' => 'Kara-Suu experimental breeding station. Performs large-scale breeding and primary seed production of winter wheat, barley, and maize for the southern regions of Kyrgyzstan.',
        'image' => 'assets/images/wheet.png'
    ],
    'KGT' => [
        'title' => 'Таласская область',
        'title_ky' => 'Талас облусу',
        'title_en' => 'Talas Region',
        'address' => 'г. Талас',
        'address_ky' => 'Талас ш.',
        'address_en' => 'Talas city',
        'crops' => 'Бобовые культуры',
        'crops_ky' => 'Буурчак өсүмдүктөрү',
        'crops_en' => 'Legumes',
        'extra' => 'Таласский филиал по селекции фасоли и гороха. Разработка и внедрение новых высокопродуктивных линий фасоли, устойчивых к заболеваниям и засухе, для экспорта и внутреннего рынка.',
        'extra_ky' => 'Фасоль жана буурчак селекциясы боюнча Талас филиалы. Экспортко жана ички рынокко багытталган, ооруларга жана кургакчылыкка туруктуу фасольдун жаңы жогорку түшүмдүү линияларын иштеп чыгуу жана жайылтуу.',
        'extra_en' => 'Talas branch for bean and pea breeding. Development and implementation of new high-yielding bean lines resistant to disease and drought, targeting both export and domestic markets.',
        'image' => 'assets/images/about-photo.jpg'
    ]
];

$id = $_GET['id'] ?? '';
$plot = $plots[$id] ?? null;

// Функция для получения языковых полей
function getPlotTranslation($plot, $field) {
    $lang = currentLang();
    if ($lang === 'ky') {
        return $plot[$field . '_ky'] ?? $plot[$field] ?? '';
    } elseif ($lang === 'en') {
        return $plot[$field . '_en'] ?? $plot[$field] ?? '';
    } else {
        return $plot[$field] ?? '';
    }
}
?>
<main class="py-5 bg-light" style="min-height: 80vh;">
    <div class="container">
        <!-- Back Link -->
        <div class="mb-4">
            <a href="maps.php?lang=<?php echo currentLang(); ?>" class="text-success text-decoration-none fw-semibold">&larr; <?php echo t('back_to_map'); ?></a>
        </div>

        <?php if ($plot): ?>
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px; background: white;">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-3">
                            <img src="<?= htmlspecialchars($plot['image']) ?>" alt="<?= htmlspecialchars(getPlotTranslation($plot, 'title')) ?>" class="img-fluid w-100 rounded-4 shadow-sm" style="object-fit: cover; max-height: 480px; min-height: 320px;">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 p-md-5">
                            <span class="badge bg-emerald mb-3 px-3 py-2 text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 1px;"><?php echo t('maps_info_title'); ?></span>
                            <h1 class="display-6 fw-bold mb-4 text-dark" style="font-family: var(--font-headings);"><?= htmlspecialchars(getPlotTranslation($plot, 'title')) ?></h1>
                            
                            <div class="mb-4">
                                <h3 class="h6 text-success fw-bold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 0.5px;"><?php echo t('maps_info_address_label'); ?></h3>
                                <p class="text-secondary fs-5 d-flex align-items-start gap-2">
                                    <span>📍</span> <?= htmlspecialchars(getPlotTranslation($plot, 'address')) ?>
                                </p>
                            </div>

                            <div class="mb-4">
                                <h3 class="h6 text-success fw-bold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 0.5px;"><?php echo t('maps_info_crops_label'); ?></h3>
                                <p class="text-secondary fs-5 d-flex align-items-center gap-2">
                                    <span>🌾</span> <?= htmlspecialchars(getPlotTranslation($plot, 'crops')) ?>
                                </p>
                            </div>

                            <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                            <div>
                                <h3 class="h6 text-success fw-bold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 0.5px;"><?php echo t('maps_info_description_label'); ?></h3>
                                <p class="text-muted mb-0" style="line-height: 1.7;"><?= htmlspecialchars(getPlotTranslation($plot, 'extra')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning border-0 p-4 text-center" style="border-radius: 16px;">
                <span class="fs-1 d-block mb-3">⚠️</span>
                <h4 class="fw-bold"><?php echo t('plot_not_found'); ?></h4>
                <p class="text-muted mb-0"><?php echo t('plot_not_found_desc'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
