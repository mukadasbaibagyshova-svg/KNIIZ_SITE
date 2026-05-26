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
$page_head = '<link rel="stylesheet" href="assets/css/dept-detail.css?v=' . time() . '">';
include 'includes/header.php';

function deptSplitSentences($text) {
    $text = trim((string) $text);
    if ($text === '') {
        return [];
    }
    $parts = preg_split('/(?<=[.!?…])\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
    return $parts ?: [$text];
}

function deptTrimListItem($item) {
    return rtrim(trim((string) $item), ';.');
}

$structureDetails = [
    'wheat' => [
        'photoClass' => 'wheat',
        'hero_image' => 'assets/images/wheet1.jpg',
        'badge' => 'Отдел пшеницы',
        'title' => 'structure_detail_wheat_title',
        'summary' => 'Отдел занимается созданием новых конкурентоспособных сортов мягкой и твердой пшеницы, сочетающих высокую урожайность с устойчивостью к биотическим и абиотическим стрессам. Деятельность включает полный цикл: от подбора родительских пар и гибридизации до экологического сортоиспытания. Важнейшим этапом является первичное семеноводство, обеспечивающее сохранение сортовой чистоты и биологических свойств созданных сортов. Отдел формирует основу семенного фонда для агропромышленного комплекса, внедряя в производство инновационные селекционные достижения.',
        'activity' => '',
        'research' => [
            'Генетическое улучшение пшеницы по показателям продуктивности и качества зерна;',
            'Селекция на устойчивость к засухе, низким температурам и патогенам (ржавчина, фузариоз и др.);',
            'Изучение мировой коллекции пшеницы для поиска новых источников ценных признаков;',
            'Производство оригинальных семян (питомники Р-1, Р-2) и поддержание чистосортности;',
            'Разработка и оптимизация сортовой агротехники для новых линий.'
        ],
        'results_list' => [
            'Создана линейка сортов пшеницы с потенциалом урожайности свыше 80–90 ц/га;',
            'Получены патенты и авторские свидетельства на новые сорта, включенные в Государственный реестр;',
            'Налажена система производства высококачественных семян высших репродукций для обеспечения нужд семеноводческих хозяйств;',
            'Разработаны модели сортов, оптимизированные под различные уровни интенсификации земледелия.'
        ],
        'international' => 'Отдел активно участвует в обмене селекционным материалом в рамках международных программ (например, CIMMYT, ICARDA). Ведется совместное изучение международного питомника пшеницы на предмет устойчивости к стеблевой ржавчине и засухоустойчивости.',
        'publications' => 'Сотрудники отдела ежегодно публикуют статьи в рецензируемых журналах (ВАК, Scopus), освещая вопросы наследования признаков, результаты экологического испытания и новые методики ускоренной селекции. Подготовлены методические рекомендации по сортовой агротехнике для сельхозпроизводителей.',
        'staff' => [
            ['name' => 'Токтосунов Мирлан Алмазович', 'experience' => '8', 'position' => 'Старший научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Кадыров Бакыт Кубанычбекович', 'experience' => '12', 'position' => 'Старший научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Сыдыкова Айнура Нурлановна', 'experience' => '5', 'position' => 'Научный сотрудник', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее']
        ]
    ],
    'barley' => [
        'photoClass' => 'barley',
        'hero_image' => 'assets/images/ячмень.jpg',
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
        'summary' => 'Отдел осуществляет научно-исследовательскую деятельность по созданию высокопродуктивных гибридов кукурузы различных групп спелости, адаптированных к местным агроклиматическим условиям. Работа включает поиск и создание новых самоопыленных линий, изучение их комбинационной способности и разработку технологий промышленного семеноводства. Подразделение обеспечивает поддержание генетической чистоты родительских форм и производство семян высших репродукций для нужд аграрного сектора. Отдел активно взаимодействует с научно-исследовательскими центрами по вопросам обмена гермоплазмой и внедрения современных биотехнологических методов в селекционный процесс.',
        'research' => [
            'Создание и оценка новых инбредных линий кукурузы как основы для получения гетерозисных гибридов',
            'Селекция на повышение потенциала урожайности, быструю отдачу влаги зерном при созревании и устойчивость к полеганию',
            'Изучение генетической устойчивости кукурузы к основным заболеваниям (пузырчатая головня, фузариоз початка) и вредителям',
            'Совершенствование методов первичного семеноводства для обеспечения высокого качества семян родительских форм',
            'Разработка сортовых технологий возделывания гибридов на зерно и силос в различных экологических зонах'
        ],
        'results_list' => [
            'Создана серия гибридов кукурузы с потенциалом урожайности зерна 100–120 ц/га и зеленой массы 450–600 ц/га',
            'Получены патенты на новые селекционные достижения, включенные в Государственный реестр сортов',
            'Разработана эффективная система поддержания и размножения стерильных аналогов и линий-восстановителей фертильности',
            'Оптимизированы регламенты предпосевной обработки семян для повышения полевой всхожести в условиях раннего сева'
        ],
        'international' => 'Отдел ведет активное сотрудничество с международными институтами (такими как CIMMYT) по испытанию мирового генофонда кукурузы. Осуществляется прием, изучение и использование интродуцированных линий для расширения генетического разнообразия собственной селекционной программы.',
        'publications' => 'Сотрудники регулярно публикуют результаты исследований в рецензируемых журналах (ВАК, Scopus), освещая вопросы гетерозиса, генетики количественных признаков и технологий семеноводства. Изданы методические рекомендации по особенностям выращивания гибридов кукурузы в условиях изменения климата.',
    ],
    'sugarbeet' => [
        'hero_image' => 'assets/images/svekla.png',
        'badge' => 'Отдел сахарной свеклы',
        'title' => 'structure_detail_sugarbeet_title',
        'summary' => 'Отдел проводит комплексные научно-исследовательские работы по созданию высокопродуктивных гибридов сахарной свеклы на основе использования цитоплазматической мужской стерильности (ЦМС). Деятельность подразделения сосредоточена на селекции компонентов гибридов, сочетающих высокую сахаристость с технологичностью при промышленной переработке. Важнейшим аспектом работы является первичное семеноводство, направленное на сохранение генетической чистоты линий и получение высококачественных семян. Отдел интегрирует современные методы оценки качества корнеплодов и устойчивости к корневым гнилям в селекционный процесс.',
        'research' => [
            'Создание новых диплоидных и тетраплоидных многосемянных и односемянных линий-опылителей',
            'Селекция на повышение дигестии (сахаристости), технологических качеств сока и снижение содержания «вредного» азота',
            'Оценка и отбор селекционного материала на устойчивость к основным патогенам (церкоспороз, мучнистая роса, корнеед)',
            'Совершенствование приемов выращивания маточников и высадков для обеспечения максимального выхода кондиционных семян',
            'Разработка адаптивных технологий возделывания гибридов, минимизирующих потери сахара при хранении в кагатах'
        ],
        'results_list' => [
            'Созданы гибриды сахарной свеклы с потенциальным сбором сахара 8–10 т/га и высокой чистотой сока',
            'Получены патенты на новые компоненты и гибриды, успешно прошедшие Государственное испытание',
            'Внедрена система двулетнего цикла семеноводства, гарантирующая высокую всхожесть и односемянность материала',
            'Разработаны регламенты защиты семенников от вредителей и болезней, обеспечивающие стабильный урожай семян'
        ],
        'international' => 'Отдел осуществляет обмен генетическими ресурсами сахарной свеклы с ведущими зарубежными селекционными центрами. Проводятся совместные экологические испытания гибридов для оценки их пластичности в различных почвенно-климатических условиях.',
        'publications' => 'Результаты исследований сотрудников регулярно публикуются в высокорейтинговых научных изданиях (ВАК, Scopus). Основные публикации посвящены вопросам генетики ЦМС, корреляции массы корнеплода с сахаристостью и технологиям предпосевной подготовки семян.',
    ],
    'fruit_veg' => [
        'hero_image' => 'assets/images/grape.png',
        'badge' => 'Отдел плодово-ягодных культур',
        'title' => 'structure_detail_fruit_veg_title',
        'summary' => 'Плодоовощной отдел занимается исследованиями и разработками в области плодоводства и овощеводства. Основными направлениями работы являются создание новых высокоурожайных сортов плодово-ягодных культур, разработка инновационных технологий их выращивания, размножения и защиты от вредителей. Подразделение обеспечивает научное сопровождение и внедрение современных методов в практику садоводства.',
        'research' => [
            'Разработка интенсивных технологий выращивания плодовых и ягодных культур;',
            'Селекция и интродукция перспективных сортов плодовых деревьев и ягодников;',
            'Изучение способов повышения урожайности и качества плодовой продукции;',
            'Исследование методов защиты садовых культур от болезней и вредителей.'
        ],
        'results_list' => [
            'Разработаны рекомендации по закладке интенсивных садов в условиях Чуйской долины;',
            'Создана коллекция ценных сортообразцов плодовых культур и винограда;',
            'Внедрены современные безвирусные технологии выращивания посадочного материала ягодников.'
        ]
    ],
    'soil' => [
        'hero_image' => 'assets/images/hero2.jpg',
        'badge' => 'Отдел почвоведения',
        'title' => 'structure_detail_soil_title',
        'summary' => 'Отдел почвоведения изучает свойства почв, их плодородие, а также разрабатывает научно обоснованные методы предотвращения деградации, эрозии и засоления земель. Специалисты отдела ведут постоянный мониторинг почвенных ресурсов Кыргызской Республики и готовят рекомендации по рациональному использованию земельного фонда в условиях изменения климата.',
        'research' => [
            'Мониторинг качественного состояния и плодородия почв сельскохозяйственного назначения;',
            'Разработка эффективных методов борьбы с водной и ветровой эрозией почв;',
            'Исследование процессов засоления и осолонцевания почв, методы их химической мелиорации;',
            'Изучение влияния различных систем обработки на водно-физические свойства почв.'
        ],
        'results_list' => [
            'Составлены современные почвенные и картографические материалы для опытных станций;',
            'Разработаны технологии восстановления деградированных богарных и орошаемых почв;',
            'Опубликованы научно обоснованные нормативы по охране и рациональному использованию земельных ресурсов.'
        ]
    ],
    'genetic_resources' => [
        'photoClass' => 'genetic_resources',
        'hero_image' => 'assets/images/about-photo.jpg',
        'badge' => 'Отдел генетических ресурсов',
        'title' => 'structure_detail_genetic_resources_title',
        'summary' => 'Отдел занимается сбором, сохранением, документированием и эффективным использованием мировых растительных генетических ресурсов для селекционных программ КНИИЗ. В состав отдела входит технологическая лаборатория, которая проводит оценку хлебопекарных, мукомольных и иных качественных характеристик зерна и селекционных линий.',
        'research' => [
            'Сбор и поддержание жизнеспособности коллекции семян культурных растений;',
            'Интродукция ценных генетических образцов из ведущих мировых центров и банков семян;',
            'Комплексная технологическая и биохимическая оценка качества зерновых и масличных культур;',
            'Изучение изменчивости и наследуемости качественных признаков для селекции.'
        ],
        'results_list' => [
            'Сформирована и поддерживается уникальная национальная коллекция семян культурных растений;',
            'Проведена паспортизация сотен образцов зерновых по белковому спектру и качеству клейковины;',
            'Внедрены методики экспресс-оценки мукомольных и хлебопекарных свойств малых объемов зерна для ранних этапов селекции.'
        ],
        'head' => [
            'name' => 'Кулназаров Калман Кулназарович',
            'position' => 'Заведующий отделом',
            'phone' => '0555 123 456',
            'degree' => 'Кандидат сельскохозяйственных наук',
            'education' => 'Высшее',
            'image' => 'assets/images/kulnazarovkalman.png'
        ],
        'staff' => [
            ['name' => 'Кулназаров Калман Кулназарович', 'experience' => '30', 'position' => 'Зав. отделом', 'degree' => 'к.с.-х.н.', 'title' => 'нет', 'education' => 'Высшее', 'image' => 'assets/images/kulnazarovkalman.png'],
            ['name' => 'Чыналиев Мухтар Турдубекович', 'experience' => '25', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Кадырбаев Урмат Кадырбаевич', 'experience' => '15', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее'],
            ['name' => 'Турсуналиева Бегимай Мирзаолимовна', 'experience' => '10', 'position' => 'с.н.с.', 'degree' => 'нет', 'title' => 'нет', 'education' => 'Высшее']
        ]
    ],
    'fiber' => [
        'photoClass' => 'fiber',
        'hero_image' => 'assets/images/hlopok.png',
        'badge' => 'Отдел селекции волокна',
        'title' => 'structure_detail_fiber_title',
        'summary' => 'Отдел селекции, семеноводства и технологии волокна специализируется на создании новых высокоурожайных и скороспелых сортов хлопчатника, отлично адаптированных к климатическим условиям южных регионов Кыргызстана. Работа охватывает весь цикл семеноводства и оценку качественных характеристик хлопкового волокна для текстильной промышленности.',
        'research' => [
            'Селекция хлопчатника на повышение длины, прочности и выхода волокна;',
            'Создание ультраскороспелых линий хлопчатника для зон с коротким вегетационным периодом;',
            'Оптимизация технологий семеноводства хлопчатника высших репродукций;',
            'Разработка ресурсосберегающих сортовых технологий возделывания.'
        ],
        'results_list' => [
            'Выведены и запатентованы новые сорта хлопчатника с высоким выходом волокна IV-V типов;',
            'Налажено оригинальное семеноводство в южных опорных пунктах института;',
            'Разработаны научно обоснованные рекомендации по густоте стояния и режимам орошения для новых сортов.'
        ]
    ],
    'potato' => [
        'photoClass' => 'potato',
        'hero_image' => 'assets/images/potato.png',
        'badge' => 'Отдел картофеля',
        'title' => 'structure_detail_potato_title',
        'summary' => 'Отдел занимается созданием новых конкурентоспособных сортов картофеля столового и технического назначения, обладающих высокой урожайностью и устойчивостью к фитофторозу, нематодам и вирусным болезням. Важнейшим направлением работы является безвирусное семеноводство с использованием современных клональных и микромеристемных технологий.',
        'research' => [
            'Меристемно-клональное размножение безвирусного семенного картофеля в лабораторных условиях;',
            'Селекция картофеля на пригодность к промышленной переработке (чипсы, крахмал);',
            'Экологическое испытание отечественных и интродуцированных сортов картофеля в горных условиях;',
            'Разработка систем фитосанитарного оздоровления посадочного материала.'
        ],
        'results_list' => [
            'Создана и успешно функционирует научно-исследовательская лаборатория микроклонирования;',
            'Выведены новые перспективные сорта картофеля, устойчивые к фитопатогенам;',
            'Обеспечены оригинальным безвирусным посадочным материалом супер-суперэлиты семеноводческие хозяйства республики.'
        ]
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
$introImage = $detail['intro_image'] ?? ($detail['hero_image'] ?? '');
$introSentences = deptSplitSentences($detail['summary'] ?? '');
if (!empty($detail['activity'])) {
    $introSentences = array_merge($introSentences, deptSplitSentences($detail['activity']));
}
$researchIcons = ['🧬', '🛡️', '🌐', '🌾', '📋', '🔬', '🧪', '📊'];
?>

<main class="dept-detail-page" id="main-content">
<div class="dept-main-content">

    <div class="dept-page-header sd-reveal">
        <!-- <a href="science.php?lang=<?php echo currentLang(); ?>" class="dept-back-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            <?php echo t('structure_detail_back'); ?>
        </a> -->
        <?php if (!empty($detail['badge'])): ?>
            <!-- <span class="section-tag"><?php echo htmlspecialchars($detail['badge']); ?></span> -->
        <?php endif; ?>
        <h1 class="section-title-premium text-dark mb-0"><?php echo t($detail['title']); ?></h1>
    </div>

    <!-- Краткое описание + фото -->
    <?php if (!empty($introSentences) || $introImage): ?>
    <section class="dept-section dept-intro-section sd-reveal">
        <h2 class="dept-section-title" id="dept-intro-heading">Краткое описание деятельности отдела</h2>
        <div class="dept-intro-grid">
        <div class="dept-intro-text-col">
            <?php foreach ($introSentences as $sentence):
                $clean = deptTrimListItem($sentence);
                if (!preg_match('/[.!?…]$/u', $clean)) {
                    $clean .= '.';
                }
            ?>
                <p class="dept-intro-text"><?php echo htmlspecialchars($clean); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="dept-intro-photo-col">
            <?php if (!empty($introImage) && file_exists($introImage)): ?>
                <img src="<?php echo htmlspecialchars($introImage); ?>" alt="<?php echo htmlspecialchars(t($detail['title'])); ?>">
            <?php else: ?>
                <div class="dept-intro-photo-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <circle cx="8.5" cy="10" r="1.5" fill="currentColor" stroke="none"/>
                        <path d="M3 16l5-5 4 4 5-6 4 7"/>
                    </svg>
                    <span>Место для фотографии отдела</span>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Руководители и сотрудники -->
    <?php if (!empty($detail['head']) || !empty($detail['staff'])): ?>
    <section class="dept-section dept-staff-section sd-reveal">
        <h2 class="dept-section-title">Руководители и сотрудники</h2>
        <div class="dept-staff-grid">
            <?php
            $renderedStaff = [];
            if (!empty($detail['head'])):
                $head = $detail['head'];
                $renderedStaff[] = $head['name'];
                $headInitials = getInitials($head['name']);
            ?>
                <article class="dept-staff-card is-head">
                    <?php if (!empty($head['image']) && file_exists($head['image'])): ?>
                        <img src="<?php echo htmlspecialchars($head['image']); ?>" alt="" class="dept-staff-avatar">
                    <?php else: ?>
                        <div class="dept-staff-initials"><?php echo htmlspecialchars($headInitials); ?></div>
                    <?php endif; ?>
                    <div class="dept-staff-name"><?php echo htmlspecialchars($head['name']); ?></div>
                    <div class="dept-staff-position"><?php echo htmlspecialchars($head['position']); ?></div>
                    <?php if (!empty($head['degree']) || !empty($head['honors'])): ?>
                        <div class="dept-staff-meta"><?php echo htmlspecialchars(implode(' • ', array_filter([$head['degree'] ?? '', $head['honors'] ?? '']))); ?></div>
                    <?php endif; ?>
                    <span class="dept-staff-badge">Руководитель</span>
                </article>
            <?php endif; ?>

            <?php if (!empty($detail['staff'])):
                foreach ($detail['staff'] as $member):
                    if (in_array($member['name'], $renderedStaff, true)) continue;
                    $renderedStaff[] = $member['name'];
                    $memberInitials = getInitials($member['name']);
                    $isHead = !empty($detail['head']['name']) && $member['name'] === $detail['head']['name'];
            ?>
                <article class="dept-staff-card<?php echo $isHead ? ' is-head' : ''; ?>">
                    <?php if (!empty($member['image']) && file_exists($member['image'])): ?>
                        <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="" class="dept-staff-avatar">
                    <?php else: ?>
                        <div class="dept-staff-initials"><?php echo htmlspecialchars($memberInitials); ?></div>
                    <?php endif; ?>
                    <div class="dept-staff-name"><?php echo htmlspecialchars($member['name']); ?></div>
                    <div class="dept-staff-position"><?php echo htmlspecialchars($member['position']); ?></div>
                    <?php
                    $meta = [];
                    if (!empty($member['degree']) && $member['degree'] !== 'нет') $meta[] = $member['degree'];
                    if (!empty($member['experience'])) $meta[] = 'Опыт: ' . $member['experience'] . ' лет';
                    if ($meta):
                    ?>
                        <div class="dept-staff-meta"><?php echo htmlspecialchars(implode(' • ', $meta)); ?></div>
                    <?php endif; ?>
                </article>
            <?php endforeach; endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Основные направления исследований — карточки -->
    <?php if (!empty($detail['research'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Основные направления исследований</h2>
        <div class="dept-research-grid">
            <?php foreach ($detail['research'] as $i => $item): ?>
                <article class="dept-research-card">
                    <div class="dept-research-icon" aria-hidden="true"><?php echo $researchIcons[$i % count($researchIcons)]; ?></div>
                    <p class="dept-research-label"><?php echo htmlspecialchars(deptTrimListItem($item)); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Ключевые результаты — карточки -->
    <?php
    $hasResults = !empty($detail['results_list']) || !empty($detail['results']);
    if ($hasResults):
    ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Ключевые результаты и достижения отдела</h2>
        <?php if (!empty($detail['results_list'])): ?>
            <div class="dept-results-grid">
                <?php foreach ($detail['results_list'] as $item): ?>
                    <article class="dept-result-card">
                        <div class="dept-result-card__icon" aria-hidden="true">✓</div>
                        <p class="dept-result-card__text"><?php echo htmlspecialchars(deptTrimListItem($item)); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dept-section-text"><?php echo $detail['results']; ?></div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Международные проекты — карточка -->
    <?php
    $hasProjects = !empty($detail['international']) || !empty($detail['projects_current']) || !empty($detail['projects_completed']);
    if ($hasProjects):
    ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Международные проекты</h2>
        <div class="dept-feature-cards">
            <?php if (!empty($detail['international'])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">🌍</div>
                    <div class="dept-feature-card__body">
                        <h3>Сотрудничество и обмен</h3>
                        <p><?php echo htmlspecialchars($detail['international']); ?></p>
                    </div>
                </article>
            <?php endif; ?>
            <?php if (!empty($detail['projects_current'])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">📌</div>
                    <div class="dept-feature-card__body">
                        <h3>Текущие научные проекты</h3>
                        <p><?php echo htmlspecialchars($detail['projects_current']); ?></p>
                    </div>
                </article>
            <?php endif; ?>
            <?php if (!empty($detail['projects_completed'])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">✅</div>
                    <div class="dept-feature-card__body">
                        <h3>Завершённые проекты</h3>
                        <p><?php echo htmlspecialchars($detail['projects_completed']); ?></p>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Публикации — карточка -->
    <?php if (!empty($detail['publications'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Публикации отдела</h2>
        <div class="dept-feature-cards">
            <article class="dept-feature-card dept-feature-card--pub">
                <div class="dept-feature-card__icon" aria-hidden="true">📚</div>
                <div class="dept-feature-card__body">
                    <h3>Статьи, монографии, рекомендации</h3>
                    <p><?php echo htmlspecialchars($detail['publications']); ?></p>
                </div>
            </article>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail['goals'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Цели отдела</h2>
        <ul class="dept-list">
            <?php foreach ($detail['goals'] as $item): ?>
                <li><?php echo htmlspecialchars(deptTrimListItem($item)); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail['perspectives'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Перспективы развития</h2>
        <div class="dept-section-text"><?php echo nl2br(htmlspecialchars($detail['perspectives'])); ?></div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail['services'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Услуги и товары отдела</h2>
        <div class="dept-research-grid">
            <?php foreach ($detail['services'] as $i => $item): ?>
                <article class="dept-research-card">
                    <div class="dept-research-icon" aria-hidden="true"><?php echo $researchIcons[$i % count($researchIcons)]; ?></div>
                    <p class="dept-research-label"><?php echo htmlspecialchars(deptTrimListItem($item)); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail['events'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Научные мероприятия</h2>
        <div class="dept-section-text"><?php echo htmlspecialchars($detail['events']); ?></div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail['infrastructure'])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title">Материально-техническая база</h2>
        <div class="dept-section-text"><?php echo htmlspecialchars($detail['infrastructure']); ?></div>
    </section>
    <?php endif; ?>

    <!-- ==================== CTA ==================== -->
    <div class="dept-cta-section sd-reveal">
        <h3>Свяжитесь с отделом</h3>
        <p>Для получения дополнительной информации о деятельности отдела, сотрудничестве или приобретении семенного материала</p>
        <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="dept-cta-btn">
            Контакты &rarr;
        </a>
    </div>

</div>
</main>

<!-- ==================== Scroll Reveal Script ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.sd-reveal');
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('sd-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

    reveals.forEach(function(el) {
        observer.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>