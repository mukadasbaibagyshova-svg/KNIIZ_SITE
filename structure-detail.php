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
        'leader_image' => 'assets/images/wheet1.jpg',
        'badge' => 'Отдел пшеницы',
        'title' => 'structure_detail_wheat_title',
        'summary' => 'Отдел селекции и первичного семеноводства пшеницы занимается созданием новых конкурентоспособных сортов мягкой и твердой пшеницы, сочетая высокую урожайность с устойчивостью к биотическим и абиотическим стрессам.',
        'activity' => 'Отдел проводит полный цикл работ: от подбора родительских пар и гибридизации до экологического сортоиспытания. Важнейший этап — первичное семеноводство, обеспечивающее сохранение сортовой чистоты и биологических свойств созданных сортов.',
        'keypoints' => [
            ['title' => 'Комплексная селекция', 'text' => 'Генетическое улучшение мягкой и твердой пшеницы.'],
            ['title' => 'Устойчивость', 'text' => 'Селекция на устойчивость к засухе, холоду и патогенам.'],
            ['title' => 'Семенное обеспечение', 'text' => 'Производство оригинальных семян P-1 и P-2 с сохранением чистоты.']
        ],
        'research' => [
            'Генетическое улучшение пшеницы по показателям продуктивности и качества зерна.',
            'Селекция на устойчивость к засухе, низким температурам и патогенам (ржавчина, фузариоз и др.).',
            'Изучение мировой коллекции пшеницы для поиска новых источников ценных признаков.',
            'Производство оригинальных семян (питомники Р-1, Р-2) и поддержание чистосортности.',
            'Разработка и оптимизация сортовой агротехники для новых линий.'
        ],
        'results' => 'Создана линейка сортов пшеницы с потенциалом урожайности свыше 80–90 ц/га. Получены патенты и авторские свидетельства на новые сорта, включенные в Государственный реестр.',
        'international_projects' => 'Отдел участвует в международных программах по обмену селекционным материалом, включая сотрудничество с CIMMYT и ICARDA.',
        'publications' => 'Сотрудники публикуют статьи в рецензируемых журналах (ВАК, Scopus), освещая наследование признаков, результаты экологического испытания и новые методики ускоренной селекции.',
        'services' => [
            'Генетический анализ сортов пшеницы.',
            'Производство оригинальных и элитных семян для семеноводческих хозяйств.',
            'Методическое сопровождение по агротехнике выращивания пшеницы.',
            'Консультации по организации семеноводства и сертификации.',
            'Разработка рекомендаций для разных агроклиматических зон.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_patents' => 'Патенты и разработки пока не указаны.',
        'head' => [
            'name' => 'Азыкова Жылдыз Кадырбековна',
            'position' => 'Зав. отделом селекции пшеницы',
            'phone' => '+996 772 123456',
            'honors' => 'Заслуженный деятель науки КР',
            'degree' => 'Кандидат сельскохозяйственных наук',
            'education' => 'Высшее'
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
        'leader_image' => 'assets/images/wheet1.jpg',
        'badge' => 'Отдел ячменя',
        'title' => 'structure_detail_barley_title',
        'summary' => 'Отдел селекции и первичного семеноводства ячменя — это структурное подразделение Кыргызского научно-исследовательского института земледелия имени К.К. Азыкова, которое занимается созданием новых сортов ячменя и обеспечением их исходным семенным материалом для дальнейшего размножения.',
        'activity' => 'Отдел селекции и первичного семеноводства ячменя осуществляет разработку и внедрение новых сортов культуры, отличающихся высокой урожайностью, устойчивостью к неблагоприятным условиям и соответствием требованиям производства. Основными направлениями работы являются проведение гибридизации, отбор перспективных линий, организация полевых испытаний и научно-методическое сопровождение селекционного процесса. Подразделение обеспечивает получение и поддержание чистоты исходного семенного материала (суперэлита, элита), необходимого для дальнейшего размножения и передачи в хозяйства. Деятельность отдела направлена на укрепление семенной базы, повышение эффективности аграрного сектора и обеспечение продовольственной безопасности страны.',
        'keypoints' => [
            ['title' => 'Устойчивость', 'text' => 'Сорта адаптированы к засухе, стрессам и болезням.'],
            ['title' => 'Семенная чистота', 'text' => 'Контролируется чистота суперэлиты и элитного семенного материала.'],
            ['title' => 'Экологичность', 'text' => 'Сорта подходят для богарных и орошаемых земель с низкими затратами.']
        ],
        'research' => [
            'Разработка сортов ячменя с высокой урожайностью, устойчивостью к болезням, засухе и другим стрессовым факторам.',
            'Изучение наследуемости признаков, проведение гибридизации и отбор перспективных линий.',
            'Исследование питательной ценности, технологических свойств и пригодности сортов для пищевой и кормовой промышленности.',
            'Получение и поддержание чистоты исходного семенного материала (суперэлита, элита), контроль сортовой идентичности.',
            'Оценка сортов в различных агроклиматических зонах для выявления наиболее устойчивых и продуктивных форм.',
            'Разработка методов защиты от болезней и вредителей, повышение иммунитета растений.'
        ],
        'goals' => [
            'Укрепление семенной базы и обеспечение продовольственной безопасности страны.',
            'Создание ресурсосберегающих сортов ячменя для орошаемых и богарных земель.',
            'Повышение качества исходного семенного материала суперэлиты и элиты.'
        ],
        'objectives' => [
            'Проведение гибридизации и отбор перспективных линий ячменя.',
            'Организация полевых испытаний и экологических сортоиспытаний.',
            'Научно-методическое сопровождение селекционного процесса.',
            'Получение и поддержание чистоты исходного семенного материала.'
        ],
        'survey' => [
            'Полное название отдела' => 'Отдел селекции и первичного семеноводства ячменя',
            'Краткое описание деятельности отдела' => 'Отдел занимается созданием новых сортов ячменя и обеспечением их исходным семенным материалом для дальнейшего размножения.',
            'Международные проекты' => 'нет',
            'Основные партнёры и сотрудничество' => 'нет',
            'Участие в грантах и программах' => 'нет'
        ],
        'current_project' => 'Выполняется НИР по теме: «Создать новые низкозатратные по ресурсам сорта ячменя, адаптированные к стрессовым факторам среды и обладающие высоким уровнем хозяйственно-полезных признаков и провести экологическое сортоиспытание».',
        'completed_projects' => [
            '2019–2021 гг. выполнено по НИР по теме: «Создать сорта ячменя для орошаемых и богарных земель, устойчивые к стрессовым факторам среды и обладающие высоким уровнем хозяйственно-полезных признаков, и провести экологическое испытание».',
            '2022–2025 гг. выполнено по НИР по теме: «Создать сорта ячменя для орошаемых и богарных земель, устойчивые к стрессовым факторам среды и обладающие высоким уровнем хозяйственно-полезных признаков и провести экологическое испытание».'
        ],
        'results' => 'Выведены сорта ярового ячменя Нарын 27, Нутанс 970, Нутанс 89, Таалай, Бестам, Ватан, Владлен, Кылым, Максат и новые сорта, озимые сорта ячменя Ардак, Жениш 60, Гаухар, Белек, Адель, Альта. В 2025 году выведены новые перспективные сорта ярового ячменя рабочим номером 7100/5 и 7012.',
        'head' => [
            'name' => 'Иманалиев Бакытбек Табылдыевич',
            'position' => 'Зав. отделом',
            'phone' => '+996 505 011019',
            'honors' => 'Ардактуу кызматкер, 6 сентября 2025 года',
            'degree' => 'Магистр агрономии',
            'education' => 'Высшее'
        ],
        'staff' => [
            ['name' => 'Иманалиев Бакытбек Табылдыевич', 'experience' => '7', 'position' => 'Зав. отдела', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Аккулаков Талантбек Мараимович', 'experience' => '2,5', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Эралиева Асель Мукамбетовна', 'experience' => '22', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Тараненко Татьяна Алексеевна', 'experience' => '1', 'position' => 'н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Кузнецова Валентина Леонидовна', 'experience' => '24', 'position' => 'ст. лаборант', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Среднее специальное'],
            ['name' => 'Немцова Любовь Васильевна', 'experience' => '17', 'position' => 'ст. лаборант', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Среднее специальное']
        ],
        'infrastructure' => 'Селекционные питомники находятся на территории Кыргызского научно-производственного объединения по земледелию в селе Первомайском Сокулукского района Чуйской области.',
        'events' => '12.07.2025 года проведён День поля на тему «Особенности возделывания зерновых и кормовых культур в условиях высокогорья Кыргызстана».',
        'prospects' => [
            'Разработка новых сортов ячменя, устойчивых к абиотическим стрессам и основным заболеваниям, с повышенным потенциалом урожайности.',
            'Совершенствование системы сертификации и контроля качества семян, расширение производственных участков.',
            'Модернизация лабораторной базы, подготовка молодых специалистов и повышение квалификации сотрудников.',
            'Участие в государственных и международных программах, привлечение грантовых средств.'
        ],
        'prospects_summary' => 'Ожидаемый результат: формирование конкурентоспособных сортов, рост объёмов сертифицированных семян и укрепление научно-производственного потенциала отдела в национальном и региональном масштабе.',
        'services' => [
            'Генетический и морфологический анализ сортов.',
            'Лабораторные исследования качества семян (всхожесть, чистота, энергия прорастания).',
            'Экспертиза сортовых посевов и семенного материала.',
            'Реализация оригинальных и элитных семян ячменя.',
            'Предоставление саженцев и коллекционных образцов.',
            'Создание демонстрационных участков для апробации сортов.',
            'Методическое сопровождение фермеров и хозяйств по агротехнике выращивания ячменя.',
            'Консультации по организации семеноводства и сертификации.',
            'Подготовка рекомендаций по адаптации сортов к различным природно-климатическим зонам.',
            'Проведение семинаров, тренингов и стажировок для специалистов и студентов.',
            'Издание методических материалов, каталогов сортов и семян.',
            'Организация научных и практических конференций.',
            'Разработка инновационных технологий в селекции и семеноводстве.',
            'Формирование семенного банка и базы данных сортов.'
        ],
        'no_projects' => 'Международные проекты отсутствуют.',
        'no_partners' => 'Основные партнёры и сотрудничество отсутствуют.',
        'no_grants' => 'Участие в грантах и программах отсутствует.',
        'no_publications' => 'Публикации отдела пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ],
    'corn' => [
        'photoClass' => 'corn',
        'hero_image' => 'assets/images/corn.jpg',
        'badge' => 'Отдел кукурузы',
        'title' => 'structure_detail_corn_title',
        'summary' => 'Отдел кукурузы занимается научными исследованиями и селекцией кукурузы, работая над гибридами для устойчивого производства и повышения урожайности.',
        'activity' => 'Направления работы отдела включают разработку высокопродуктивных гибридов, агротехнологии выращивания и оценку устойчивости к стрессам.',
        'research' => [
            'Разработка гибридов кукурузы с высокой продуктивностью.',
            'Оценка устойчивости к засухе и болезням.',
            'Исследование оптимальных агротехнологий и сортовой адаптации.'
        ],
        'services' => [
            'Оценка гибридного и посевного материала.',
            'Консультации по агротехнике кукурузы.',
            'Поддержка внедрения новых сортов в производство.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_publications' => 'Публикации отдела пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ],
    'fruit_veg' => [
        'photoClass' => 'fruit-veg',
        'hero_image' => 'assets/images/grape.png',
        'badge' => 'Плодоовощной отдел',
        'title' => 'structure_detail_fruit_veg_title',
        'summary' => 'Плодоовощной отдел развивает технологии выращивания фруктовых и овощных культур, обеспечивая качество и устойчивость продукции.',
        'activity' => 'Отдел разрабатывает агротехнические схемы, новые сорта и методы защиты растений для овощей и фруктов.',
        'research' => [
            'Селекция и адаптация овощных и плодовых культур.',
            'Изучение агротехнологий для повышения качества продукции.',
            'Оценка климатической устойчивости сортов.'
        ],
        'services' => [
            'Консультации по возделыванию овощей и фруктов.',
            'Разработка схем защиты растений.',
            'Поддержка демонстрационных участков.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_publications' => 'Публикации отдела пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ],
    'agrochemistry' => [
        'photoClass' => 'agrochemistry',
        'hero_image' => 'assets/images/hlopok.png',
        'badge' => 'Отдел агрохимии',
        'title' => 'structure_detail_agrochemistry_title',
        'summary' => 'Отдел агрохимии исследует удобрения, агрохимические процессы и рекомендации для оптимального питания растений.',
        'activity' => 'Работа отдела направлена на анализ почв и удобрений, разработку методик внесения агрохимикатов и повышение эффективности минерального питания.',
        'research' => [
            'Анализ химического состава почвы и удобрений.',
            'Изучение влияния агрохимикатов на урожайность.',
            'Разработка рекомендаций по рациональному внесению удобрений.'
        ],
        'services' => [
            'Анализ почв и агрохимикатов.',
            'Рекомендации по удобрению сельхозкультур.',
            'Методическая поддержка агрохимических исследований.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_publications' => 'Публикации отдела пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ],
    'soil' => [
        'photoClass' => 'soil',
        'hero_image' => 'assets/images/potato.png',
        'badge' => 'Отдел почвоведения',
        'title' => 'structure_detail_soil_title',
        'summary' => 'Отдел почвоведения изучает свойства почв, плодородие и методы восстановления деградированных земель.',
        'activity' => 'Отдел проводит исследования по анализу почвенных параметров, улучшению структуры почвы и повышению её плодородия.',
        'research' => [
            'Изучение свойств и структуры почв.',
            'Разработка технологий повышения плодородия.',
            'Оценка влияния удобрений и агротехники на почвы.'
        ],
        'services' => [
            'Анализ почвенных образцов.',
            'Рекомендации по улучшению плодородия.',
            'Исследования по защите почв от эрозии.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_publications' => 'Публикации отдела пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ],
    'sugarbeet' => [
        'photoClass' => 'sugarbeet',
        'hero_image' => 'assets/images/svekla.png',
        'leader_image' => 'assets/images/svekla.png',
        'badge' => 'Отдел сахарной свеклы',
        'title' => 'structure_detail_sugarbeet_title',
        'summary' => 'Отдел селекции и первичного семеноводства сахарной свеклы проводит комплексные НИР по созданию высокопродуктивных гибридов на основе цитоплазматической мужской стерильности (ЦМС).',
        'activity' => 'Основная задача отдела — селекция компонентов гибридов с высокой сахаристостью и технологическими качествами для промышленной переработки, а также первичное семеноводство для сохранения генетической чистоты линий.',
        'research' => [
            'Создание новых диплоидных и тетраплоидных многосемянных и односемянных линий-опылителей.',
            'Селекция на повышение сахаристости и технологических качеств сока.',
            'Оценка устойчивости к основным патогенам (церкоспороз, мучнистая роса, корнеед).',
            'Совершенствование выращивания маточников и высадков для максимального выхода кондиционных семян.',
            'Разработка адаптивных технологий возделывания гибридов, минимизирующих потери сахара при хранении.'
        ],
        'results' => 'Созданы гибриды сахарной свеклы с потенциальным сбором сахара 8–10 т/га и высокой чистотой сока. Внедрена система двулетнего цикла семеноводства и разработаны регламенты защиты семенников от вредителей и болезней.',
        'international_projects' => 'Отдел осуществляет обмен генетическими ресурсами сахарной свеклы с зарубежными селекционными центрами и проводит совместные экологические испытания гибридов.',
        'publications' => 'Результаты исследований регулярно публикуются в ВАК и Scopus; основные темы — генетика ЦМС, корреляция массы корнеплода с сахаристостью и предпосевная подготовка семян.',
        'patents' => 'Получены патенты на новые компоненты и гибриды, успешно прошедшие Государственное испытание.',
        'services' => [
            'Оценка качества корнеплодов и содержание сахара.',
            'Разработка гибридных линий и первичное семеноводство.',
            'Консультации по технологиям возделывания и хранению свёклы.',
            'Поддержка семеноводческих хозяйств методическими рекомендациями.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.'
    ],
    'issyk' => [
        'photoClass' => 'issyk',
        'hero_image' => 'assets/images/hlopoknapole.png',
        'badge' => 'Иссык-Кульский филиал',
        'title' => 'structure_detail_issyk_title',
        'summary' => 'Иссык-Кульский филиал представляет собой региональный научно-опытный центр, который адаптирует исследования института к условиям высокогорья и местным климатическим особенностям.',
        'activity' => 'Филиал проводит полевые испытания, оценивает адаптацию культивируемых сортов и внедряет региональные технологии выращивания сельхозкультур.',
        'research' => [
            'Оценка сортов на устойчивость к высокогорным и климатическим условиям.',
            'Испытания новых агротехнологий на опытных площадках филиала.',
            'Сбор рекомендаций по адаптации семенного материала к региону.'
        ],
        'services' => [
            'Полевые испытания новых сортов.',
            'Региональные агротехнические рекомендации.',
            'Консультации по ведению сельского хозяйства в высокогорье.'
        ],
        'no_partners' => 'Основные партнёры и сотрудничество пока не указаны.',
        'no_grants' => 'Участие в грантах и программах пока не указано.',
        'no_publications' => 'Публикации филиала пока не указаны.',
        'no_patents' => 'Патенты и разработки пока не указаны.'
    ]
];

$itemId = $_GET['item'] ?? '';
if (!isset($structureDetails[$itemId])) {
    header('Location: structure.php?lang=' . currentLang());
    exit;
}

$detail = $structureDetails[$itemId];
?>

<main class="structure-detail-page py-5 bg-light">
    <div class="container">
        <div class="mb-4">
            <a href="structure.php?lang=<?php echo currentLang(); ?>" class="text-success text-decoration-none fw-semibold">&larr; <?php echo t('structure_detail_back'); ?></a>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden mb-5">
            <div class="row g-0 align-items-center">
                <div class="col-lg-7">
                    <div class="position-relative detail-hero-image" <?php if (!empty($detail['hero_image'])): ?> style="background-image:url('<?php echo $detail['hero_image']; ?>');"<?php endif; ?>>
                        <div class="detail-hero-overlay"></div>
                        <div class="p-4 p-lg-5 h-100 d-flex flex-column justify-content-end text-white">
                            <span class="badge bg-white text-success mb-3"><?php echo $detail['badge'] ?? t($detail['title']); ?></span>
                            <h1 class="display-5 fw-bold mb-3"><?php echo t($detail['title']); ?></h1>
                            <?php if (!empty($detail['summary'])): ?>
                                <p class="mb-0 fs-6 fw-semibold text-white-75"><?php echo $detail['summary']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 p-lg-5 bg-white h-100">
                        <?php if (!empty($detail['activity'])): ?>
                            <h2 class="h4 text-success mb-3">О проекте отдела</h2>
                            <p class="text-muted mb-4"><?php echo $detail['activity']; ?></p>
                        <?php endif; ?>
                        <div class="row g-3">
                            <?php if (!empty($detail['goals'])): ?>
                                <div class="col-12">
                                    <div class="p-3 rounded-4 border bg-soft">
                                        <h3 class="h6 text-success mb-2">Цели отдела</h3>
                                        <ul class="mb-0 ps-3 text-secondary">
                                            <?php foreach ($detail['goals'] as $goal): ?>
                                                <li><?php echo $goal; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($detail['objectives'])): ?>
                                <div class="col-12">
                                    <div class="p-3 rounded-4 border bg-soft">
                                        <h3 class="h6 text-success mb-2">Задачи отдела</h3>
                                        <ul class="mb-0 ps-3 text-secondary">
                                            <?php foreach ($detail['objectives'] as $objective): ?>
                                                <li><?php echo $objective; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-5">
            <div class="col-lg-8">
                <?php if (!empty($detail['research'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Основные направления исследований</h3>
                                <ul class="list-group list-group-flush rounded-3 overflow-hidden">
                                    <?php foreach ($detail['research'] as $researchItem): ?>
                                        <li class="list-group-item border-0 px-0 py-2 text-secondary">&#8226; <?php echo $researchItem; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['current_project'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Текущий научный проект</h3>
                                <p class="text-secondary mb-0"><?php echo $detail['current_project']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['completed_projects'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Завершённые проекты за последние 5 лет</h3>
                                <ul class="list-group list-group-flush rounded-3 overflow-hidden">
                                    <?php foreach ($detail['completed_projects'] as $project): ?>
                                        <li class="list-group-item border-0 px-0 py-2 text-secondary">&#8226; <?php echo $project; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['results'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Ключевые результаты и достижения</h3>
                                <p class="text-secondary mb-0"><?php echo $detail['results']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="mb-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h3 class="h5 text-success mb-3">Партнёры и гранты</h3>
                            <p class="text-secondary mb-2"><?php echo $detail['no_partners']; ?></p>
                            <p class="text-secondary mb-0"><?php echo $detail['no_grants']; ?></p>
                        </div>
                    </div>
                </section>

                <section class="mb-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h3 class="h5 text-success mb-3">Публикации и патенты</h3>
                            <p class="text-secondary mb-2"><?php echo !empty($detail['publications']) ? $detail['publications'] : $detail['no_publications']; ?></p>
                            <?php if (!empty($detail['patents'])): ?>
                                <p class="text-secondary mb-0"><?php echo $detail['patents']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

                <?php if (!empty($detail['infrastructure'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Материально-техническая база</h3>
                                <p class="text-secondary mb-0"><?php echo $detail['infrastructure']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['events'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Научные мероприятия</h3>
                                <p class="text-secondary mb-0"><?php echo $detail['events']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['prospects'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Перспективы развития</h3>
                                <ul class="list-group list-group-flush rounded-3 overflow-hidden mb-3">
                                    <?php foreach ($detail['prospects'] as $prospect): ?>
                                        <li class="list-group-item border-0 px-0 py-2 text-secondary">&#8226; <?php echo $prospect; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p class="text-secondary mb-0"><?php echo $detail['prospects_summary']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['services'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Услуги и товары отдела</h3>
                                <ul class="list-group list-group-flush rounded-3 overflow-hidden">
                                    <?php foreach ($detail['services'] as $service): ?>
                                        <li class="list-group-item border-0 px-0 py-2 text-secondary">&#8226; <?php echo $service; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($detail['survey'])): ?>
                    <section class="mb-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h3 class="h5 text-success mb-3">Анкета отдела</h3>
                                <div class="row g-3">
                                    <?php foreach ($detail['survey'] as $label => $value): ?>
                                        <div class="col-12">
                                            <div class="p-3 rounded-4 border bg-soft">
                                                <span class="d-block fw-semibold text-success mb-1"><?php echo $label; ?></span>
                                                <p class="mb-0 text-secondary"><?php echo $value; ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="mb-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h3 class="h5 text-success mb-3">Фотогалерея</h3>
                            <div class="row row-cols-1 row-cols-sm-2 g-3">
                                <div class="col"><div class="gallery-item">ava1</div></div>
                                <div class="col"><div class="gallery-item">ava2</div></div>
                                <div class="col"><div class="gallery-item">ava3</div></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-lg-4">
                <?php if (!empty($detail['head'])): ?>
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                        <div class="detail-leader-sidebar-image" <?php if (!empty($detail['leader_image'])): ?> style="background-image:url('<?php echo $detail['leader_image']; ?>');"<?php endif; ?>></div>
                        <div class="card-body p-4">
                            <h3 class="h5 text-success mb-3">Руководитель отдела</h3>
                            <h4 class="fs-5 mb-2"><?php echo $detail['head']['name']; ?></h4>
                            <p class="mb-1 text-secondary"><strong>Должность:</strong> <?php echo $detail['head']['position']; ?></p>
                            <p class="mb-1 text-secondary"><strong>Телефон:</strong> <?php echo $detail['head']['phone']; ?></p>
                            <p class="mb-1 text-secondary"><strong>Звания:</strong> <?php echo $detail['head']['honors']; ?></p>
                            <p class="mb-1 text-secondary"><strong>Ученая степень:</strong> <?php echo $detail['head']['degree']; ?></p>
                            <p class="mb-0 text-secondary"><strong>Образование:</strong> <?php echo $detail['head']['education']; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($detail['staff'])): ?>
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h3 class="h5 text-success mb-3 fw-bold" style="font-family: var(--font-headings);">Команда отдела</h3>
                        <div class="row g-3">
                            <?php foreach ($detail['staff'] as $index => $member): ?>
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-light h-100 transition-all hover-lift">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="avatar-gradient d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); font-size: 15px; flex-shrink: 0;">
                                                <?php echo getInitials($member['name']); ?>
                                            </div>
                                            <div class="w-100">
                                                <h6 class="mb-1 fw-bold text-dark" style="font-size: 14.5px;"><?php echo $member['name']; ?></h6>
                                                <div class="badge bg-emerald-soft text-success mb-2 fw-semibold" style="font-size: 11px;"><?php echo $member['position']; ?></div>
                                                
                                                <div class="small text-secondary" style="font-size: 12.5px; line-height: 1.5;">
                                                    <p class="mb-1"><strong>🎓 Образование:</strong> <?php echo $member['education']; ?></p>
                                                    <p class="mb-1"><strong>⏳ Стаж:</strong> <?php echo $member['experience']; ?> <?php echo ($member['experience'] == '1') ? 'год' : (($member['experience'] >= 2 && $member['experience'] <= 4) ? 'года' : 'лет'); ?></p>
                                                    <?php if ($member['degree'] !== 'нет'): ?>
                                                        <p class="mb-1"><strong>🔬 Степень:</strong> <?php echo $member['degree']; ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($member['title'] !== 'нет'): ?>
                                                        <p class="mb-0"><strong>📚 Звание:</strong> <?php echo $member['title']; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>