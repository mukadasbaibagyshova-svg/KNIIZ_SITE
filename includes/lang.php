<?php
$availableLangs = [
    "ru" => "Рус",
    "en" => "Eng",
    "ky" => "Кыргыз",
];
$defaultLang = "ru";
$currentLang = $defaultLang;
if (!empty($_GET["lang"]) && array_key_exists($_GET["lang"], $availableLangs)) {
    $currentLang = $_GET["lang"];
    setcookie("lang", $currentLang, time() + 30 * 24 * 3600, "/");
} elseif (
    !empty($_COOKIE["lang"]) &&
    array_key_exists($_COOKIE["lang"], $availableLangs)
) {
    $currentLang = $_COOKIE["lang"];
}

$_lang = [
    "ru" => [
        "admin_subtitle" =>
            "Руководство, научные отделы и региональные филиалы",
        "admin_search_placeholder" =>
            "Поиск по имени, должности, отделу или почте...",
        "admin_tab_all" => "Все сотрудники",
        "admin_tab_admin" => "Администрация",
        "admin_tab_science" => "Научные отделы",
        "admin_tab_branches" => "Филиалы и станции",
        "admin_section_leadership" => "Руководство и административный аппарат",
        "admin_section_support" => "Административная поддержка",
        "admin_section_science" => "Научно-исследовательские отделы",
        "admin_section_branches" => "Региональные опытные станции и филиалы",
        "admin_branch_management" => "Руководство и специалисты",
        "admin_search_found" => "Найдено",
        "admin_search_not_found" => "Сотрудников не найдено по запросу",
        "admin_support_dept" => "Отдел административной поддержки",
        "admin_support_desc" =>
            "Обеспечение деятельности, IT, бухгалтерия и техническое сопровождение",
        "science_dept_tag_breeding" => "Селекция",
        "science_dept_tag_technology" => "Технологии",
        "science_dept_tag_soil" => "Почвоведение",
        "science_dept_tag_agro" => "Агрохимия",
        "science_dept_desc_wheat" =>
            "Разработка новых конкурентоспособных сортов пшеницы.",
        "science_dept_desc_barley" =>
            "Селекция и первичное семеноводство ячменя.",
        "science_dept_desc_corn" =>
            "Создание высокопродуктивных гибридов кукурузы, первичное семеноводство и селекция инбредных линий.",
        "science_dept_desc_sugarbeet" =>
            "Селекция гибридов на основе ЦМС, первичное семеноводство и оценка качества корнеплодов.",
        "science_dept_desc_fruit_veg" =>
            "Разработка инновационных технологий выращивания плодоовощных культур.",
        "science_dept_desc_soil" =>
            "Изучение почвенных ресурсов и методов повышения плодородия.",
        "science_dept_desc_agro" =>
            "Анализ питательных веществ и систем удобрений.",
        "science_dept_desc_issyk" =>
            "Научные исследования в Иссык-Кульском регионе.",
        "science_hero_title" =>
            "Кыргызский научно-исследовательский институт земледелия",
        "science_hero_desc" =>
            "Мы работаем по направлениям селекции, агрономии, почвоведения и семеноводства, чтобы дать стране новые сорта и технологические решения.",
        "science_departments_title" => "Научно-исследовательские отделы",
        "science_departments_count" => "7 подразделений",
        "science_btn_more" => "Подробнее",
        "science_branches_title" => "Региональные филиалы",
        "science_branch_address" => "Адрес",
        "science_branch_activity" => "Деятельность",
        "science_branch_area" => "Площадь",
        "science_branch_director" => "Руководитель",
        "science_branch_phone" => "Телефон",
        "structure_detail_intro" => "Краткое описание деятельности отдела",
        "structure_detail_photo_placeholder" => "Место для фотографии отдела",
        "structure_detail_staff_title" => "Руководители и сотрудники",
        "structure_detail_head" => "Руководитель",
        "structure_detail_experience" => "Опыт:",
        "structure_detail_years" => "лет",
        "structure_detail_research_title" =>
            "Основные направления исследований",
        "structure_detail_results_title" =>
            "Ключевые результаты и достижения отдела",
        "structure_detail_international_title" => "Международные проекты",
        "structure_detail_international_coop" => "Сотрудничество и обмен",
        "structure_detail_projects_current" => "Текущие научные проекты",
        "structure_detail_projects_completed" => "Завершённые проекты",
        "structure_detail_publications_title" => "Публикации отдела",
        "structure_detail_publications_desc" =>
            "Статьи, монографии, рекомендации",
        "structure_detail_goals_title" => "Цели отдела",
        "structure_detail_perspectives_title" => "Перспективы развития",
        "structure_detail_services_title" => "Услуги и товары отдела",
        "structure_detail_events_title" => "Научные мероприятия",
        "structure_detail_infrastructure_title" =>
            "Материально-техническая база",
        "structure_detail_cta_title" => "Свяжитесь с отделом",
        "structure_detail_cta_desc" =>
            "Для получения дополнительной информации о деятельности отдела, сотрудничестве или приобретении семенного материала",
        "structure_detail_cta_btn" => "Контакты",
        "page_title_home" => "Главная",
        "page_title_history" => "История",
        "page_title_maps" => "Карты",
        "page_title_science" => "Наука",
        "page_title_products" => "Продукция",
        "page_title_news" => "Новости",
        "page_title_gallery" => "Галерея",
        "page_title_structure" => "Структура",
        "structure_detail_back" => "Вернуться к разделу «Наука»",
        "structure_detail_wheat_title" =>
            "Отдел селекции и первичного семеноводства пшеницы",
        "structure_detail_barley_title" =>
            "Отдел селекции и первичного семеноводства ячменя",
        "structure_detail_sugarbeet_title" =>
            "Отдел селекции и первичного семеноводства сахарной свеклы",
        "structure_detail_corn_title" =>
            "Отдел селекции и первичного семеноводства кукурузы",
        "structure_detail_fruit_veg_title" => "Плодоовощной отдел",
        "structure_detail_agrochemistry_title" => "Отдел агрохимии",
        "structure_detail_soil_title" => "Отдел почвоведения",
        "structure_detail_issyk_title" => "Иссык-Кульский филиал",
        "page_title_contacts" => "Контакты",
        "logo" => "Институт",
        "top_navigation" => "Навигация",
        "top_contacts" => "Контакты",
        "top_search" => "Поиск",
        "top_lang_selector" => "Выбор языка",
        "lang_en" => "English",
        "lang_ru" => "Русский",
        "lang_ky" => "Кыргызча",
        "footer_subscribe_title" => "Подписка",
        "footer_subscribe_text" =>
            "Получайте последние новости исследований и семеноводства первыми.",
        "footer_subscribe_placeholder" => "Ваш Email",
        "footer_subscribe_success" => "Спасибо за подписку!",
        "search_placeholder" => "Поиск",
        "search_no_results" => "Ничего не найдено",
        "search_page_match" => "Найдено на странице",
        "nav_home" => "Главная",
        "nav_about" => "О нас",
        "nav_history" => "История",
        "nav_maps" => "Карты",
        "nav_structure" => "Структура",
        "nav_science" => "Наука",
        "nav_products" => "Продукция",
        "nav_news" => "Новости",
        "nav_gallery" => "Галерея",
        "nav_catalog" => "Каталог сортов",
        "nav_contacts" => "Контакты",
        "nav_management" => "Правление",
        "nav_departments" => "Отделы",
        "nav_branches" => "Филиалы",
        "hero_title" =>
            "Кыргызский научно-исследовательский институт земледелия имени К.К. Азыкова",
        "hero_text" => "Обеспечим продовольственную безопасность Кыргызстана!",
        "hero_button_more" => "Узнать больше",
        "hero_button_contact" => "Связаться с нами",
        "about_title" => "Об институте",
        "about_text" =>
            "Институт земледелия занимается научно-исследовательской работой в области селекции и первичного семеноводства, земледелия, почвоведения, агрохимии и растениеводства. Мы разрабатываем технологии для повышения урожайности и продовольственной безопасности Кыргызстана.",
        "index_stat_years" => "Лет научных исследований",
        "index_stat_staff" => "Научных сотрудников",
        "index_stat_publications" => "Научных публикаций",
        "index_stat_landfund" => "Земельный фонд",
        "index_map_load_error" => "Ошибка загрузки карты",
        "index_badge_chuy" => "Чуй: Свекла",
        "index_badge_osh" => "Ош: Зерновые",
        "index_badge_batken" => "Баткен: Хлопок",
        "index_open_full_map" => "Открыть полную карту",
        "carousel_prev" => "Предыдущий",
        "carousel_next" => "Следующий",
        "index_gallery_more" => "Посмотреть больше",
        "index_gallery1_alt" => "Посевы пшеницы",
        "index_gallery1_title" => "Научные посевы",
        "index_gallery1_text" =>
            "Выведение и испытание новых сортов пшеницы, устойчивых к климатическим условиям Кыргызстана.",
        "index_gallery2_alt" => "Сбор хлопка",
        "index_gallery2_title" => "Технические культуры",
        "index_gallery2_text" =>
            "Исследования хлопка и других технических культур на южных опытных станциях института.",
        "index_gallery3_alt" => "Сахарная свекла",
        "index_gallery3_title" => "Сахарная свекла",
        "index_gallery3_text" =>
            "Селекция высокосахаристых гибридов и первичное семеноводство для отечественных аграриев.",
        "index_gallery4_alt" => "Почвоведение",
        "index_gallery4_title" => "Исследования почв",
        "index_gallery4_text" =>
            "Анализ состава почв, разработка рекомендаций по сохранению плодородия и агрохимии.",
        "index_gallery5_alt" => "Кукуруза",
        "index_gallery5_title" => "Поля кукурузы",
        "index_gallery5_text" =>
            "Гибриды кукурузы отечественной селекции с высоким потенциалом урожайности.",
        "index_gallery6_alt" => "Лаборатория",
        "index_gallery6_title" => "Современные лаборатории",
        "index_gallery6_text" =>
            "Научно-исследовательские биотехнологические центры и фитосанитарный контроль.",
        "index_contacts_title" => "Контактная информация",
        "index_contacts_subtitle" => "Свяжитесь с нами любым удобным способом",
        "index_phonefax_label" => "Телефон / Факс",
        "index_form_name_ph" => "Иван Иванов",
        "index_form_email_ph" => "ivan@example.com",
        "index_form_message_ph" => "Введите ваше сообщение...",
        "stats_projects" => "исследовательских проектов",
        "stats_experience" => "лет научного опыта",
        "stats_stations" => "опытно-селекционных станций",
        "goals_title" => "Цели и задачи",
        "goal_research_title" => "Научные исследования и развитие",
        "goal_research_text" =>
            "Разрабатываем актуальные вопросы развития селекции, почвоведения и растениеводства, создаём инновационные технологии и повышаем урожайность.",
        "goal_planning_title" => "Планирование и методики",
        "goal_planning_text" =>
            "Разрабатываем методические планы для лабораторий и полевых испытаний, чтобы новые решения быстро внедрялись.",
        "goal_support_title" => "Внедрение и поддержка",
        "goal_support_text" =>
            "Внедряем научные достижения на полях, поддерживаем сельхозпроизводителей и распространяем лучшие практики.",
        "stations_title" => "Опытно-селекционные станции",
        "stations_direction_title" => "Ключевые направления",
        "stations_direction_1" => "Семеноводство и селекция семян",
        "stations_direction_2" =>
            "Исследования сахарной свеклы и овощных культур",
        "stations_direction_3" => "Агроклиматические и почвенные исследования",
        "stations_direction_4" => "Повышение продуктивности сельхозкультур",
        "stations_sites_title" => "Наши площадки",
        "stations_sites_text" =>
            "Институт работает с несколькими опытно-селекционными станциями по всей стране, чтобы обеспечить устойчивое развитие сельского хозяйства.",
        "history_title" =>
            "История Кыргызского научно-исследовательского института земледелия",
        "history_text" =>
            "Кыргызский научно-исследовательский институт земледелия был создан в 1956 г. на базе Государственной селекционной и Республиканской плодоовощной опытных станций.",
        "history_foundation_title" => "Основание и структура",
        "history_foundation_text" =>
            "Институт земледелия представлял собой крупнейшее многоотраслевое и комплексное научно-исследовательское учреждение, в структуре которого имелось 17 отделов, включающих 26 лабораторий и секторов.",
        "history_foundation_more" =>
            "В состав института входили Экспериментальные хозяйства, Кыргызская опытно-селекционная станция по сахарной свекле, Кыргызская опытная станция по хлопководству, Республиканская кормовая опытная станция, Иссык-Кульская опытно-селекционная станция, Нарынский и Бургандинский опорные пункты, семеноводческие хозяйства имени 50-летия СССР и «Кугарт».",
        "history_foundation_more_2" =>
            "Научная тематика института, его опытных станций и опорных пунктов, расположенных в различных почвенно-климатических зонах, была направлена на решение основных проблем: научные основы системы поливного и богарного земледелия; выведение высокоурожайных сортов; совершенствование семеноводства; разработка технологий на базе комплексной механизации; экономика аграрного сектора Кыргызстана.",
        "history_achievements_title" => "Достижения и результаты",
        "history_achievements_intro" =>
            "Все эти и другие задачи разрабатывались слаженной работой квалифицированного коллектива ученых института, его опытных станций и опорных пунктов:",
        "history_achievement_1" =>
            "В институте работало 700 научно-технических сотрудников, из них 341 научный работник, включая 99 кандидатов и докторов наук.",
        "history_achievement_2" =>
            "Были разработаны рекомендации по ведению типичных хозяйств для отдельных сельскохозяйственных зон республики.",
        "history_achievement_3" =>
            "Научно-производственная деятельность проводилась на общей площади 135 тыс. га, в том числе 35 тыс. га пашни, почти половина из которых орошаемая.",
        "history_achievement_4" =>
            "Сады и виноградники занимали 1100 га, остальная площадь была занята сенокосами и пастбищами.",
        "history_achievement_5" =>
            "Опытные станции и семхозы ежегодно производили для колхозов и совхозов около 80 тыс. ц элитных семян зерновых и первой репродукции.",
        "history_achievement_6" =>
            "Кроме того, выпускались свыше 5 тыс. ц семян кукурузы, 6 тыс. ц семенного картофеля, 2 тыс. ц семян многолетних трав, 400 ц овощных семян и 50-60 тыс. саженцев плодов и винограда.",
        "maps_title" => "Опытно-селекционные станции",
        "maps_text" =>
            "Интерактивная карта с типами посевов, точными адресами станций и цветовой легендой.",
        "maps_legend_title" => "Условные обозначения",
        "maps_legend_beet" => "Свекла",
        "maps_legend_grain" => "Зерновые",
        "maps_legend_cotton" => "Хлопок",
        "maps_legend_vegetables" => "Овощные культуры",
        "maps_legend_seed" => "Семеноводство",
        "maps_addresses_title" => "Точки с точными адресами",
        "maps_address_1" =>
            "Чуйская обл., с. Прочность, ул. Спортивная, 61 — Сахарная свекла",
        "maps_address_2" =>
            "Ошская обл., с. Кара-Суу, ул. Большевик — Зерновые культуры",
        "maps_address_3" => "Баткенская обл., с. Кызыл-Кия — Хлопок",
        "maps_address_4" =>
            "Жалал-Абадская обл., с. Тогуз-Торо — Овощные культуры",
        "maps_address_5" => "Нарынская обл., ул. Ленина, 209 — Семеноводство",
        "maps_description_1" =>
            "На карте отмечены ключевые опытно-селекционные пункты института.",
        "maps_description_2" =>
            "Каждый цвет соответствует типу культуры и помогает быстро понять направления работы.",
        "maps_info_placeholder" =>
            "Наведите курсор на область карты или кликните по ней для просмотра информации",
        "maps_info_title" => "Информация об участке",
        "maps_info_more" => "Подробнее об участке",
        "maps_info_address_label" => "Адрес / Местоположение",
        "maps_info_crops_label" => "Основные культуры",
        "maps_info_description_label" => "Описание и исследования",
        "maps_label_area" => "Площадь",
        "maps_label_crops" => "Что посеяно",
        "maps_label_activity" => "Вид деятельности",
        "maps_label_location" => "Местонахождение",
        "maps_label_director" => "Руководитель",
        "maps_label_contacts" => "Контакты",
        "maps_show_on_map" => "Показать на карте",
        "maps_area_label" => "Площадь",
        "maps_area_not_specified" => "не указана в данных",
        "maps_kml_error" => "Не удалось загрузить карту участков.",
        "maps_land_fund_aria_label" => "Карта земельного фонда КНИИЗ",
        "station_ioss_title" => "ГП Иссык-Кульская опытно-селекционная станция",
        "station_ioss_area" => "102,0 га",
        "station_ioss_crops" =>
            "Картофель, плодовые культуры, зерновые и кормовые культуры",
        "station_ioss_activity" =>
            "Семеноводство картофеля, селекционные и производственные испытания",
        "station_ioss_location" =>
            "Иссык-Кульская область, Ак-Суйский район, с. Челпек",
        "station_ioss_director" => "Осмонов Дайырбек Турсунгазиевич",
        "station_jany_pachta_title" =>
            "ГП Семеноводческое хозяйство «Жаны-Пахта»",
        "station_jany_pachta_area" => "482,0 га",
        "station_jany_pachta_crops" =>
            "Пшеница, ячмень, люцерна и другие сельхозкультуры",
        "station_jany_pachta_activity" =>
            "Семеноводство сельхозкультур высших репродукций, земледелие",
        "station_jany_pachta_location" =>
            "Чуйская область, Сокулукский район, с. Жаны-Пахта",
        "station_jany_pachta_director" => "Эргешов Арзымат Нурмаматович",
        "station_koss_title" =>
            "ГП Кыргызская опытно-селекционная станция по сахарной свекле",
        "station_koss_area" => "239,0 га",
        "station_koss_crops" => "Сахарная свекла, зерновые и кормовые культуры",
        "station_koss_activity" =>
            "Первичное семеноводство, производство семян сахарной свеклы",
        "station_koss_location" =>
            "Чуйская область, Сокулукский район, с. Первомайское",
        "station_koss_director" => "Есеналиев Кубанычбек Дженишбекович",
        "station_atai_title" => "ГУ Семеноводческое хозяйство «Атай»",
        "station_atai_area" => "125,8 га",
        "station_atai_crops" => "Кукуруза, зерновые и кормовые культуры",
        "station_atai_activity" =>
            "Семеноводческое хозяйство, производство элитных семян",
        "station_atai_location" =>
            "Жалал-Абадская область, Тогуз-Тороуский район, с. Атай",
        "station_atai_director" => "Сакеев Жыргалбек Керимжанович",
        "back_to_map" => "Вернуться к карте",
        "plot_not_found" => "Участок не найден",
        "plot_not_found_desc" =>
            "К сожалению, запрашиваемый опытно-селекционный участок отсутствует.",
        "agro_region_map" => "Карта полей региона",
        "agro_stats" => "Статистика",
        "agro_fields_count" => "Полей",
        "agro_total_ha" => "Площадь",
        "agro_search_fields" => "Поиск поля...",
        "agro_filter_all" => "Все культуры",
        "agro_select_field" => "Выберите поле на карте",
        "agro_open_region_map" => "Открыть карту полей",
        "agro_quick_regions" => "Быстрый переход",
        "agro_dblclick_hint" => "Двойной клик — открыть карту региона",
        "agro_map_load_error" => "Не удалось загрузить контуры областей",
        "agro_back_region_map" => "К карте региона",
        "agro_field_details" => "Данные поля",
        "agro_label_culture" => "Культура",
        "agro_label_moisture" => "Влажность",
        "agro_label_year" => "Год",
        "agro_label_yield" => "Урожай",
        "agro_label_notes" => "Примечание",
        "agro_crop_history" => "История культур по годам",
        "agro_no_history" => "История посевов пока не заполнена",
        "agro_region_naryn" => "Нарын",
        "agro_region_issyk" => "Ысык-Көл",
        "agro_region_chuy" => "Чуй",
        "agro_region_osh" => "Ош",
        "agro_region_batken" => "Баткен",
        "agro_region_jalal" => "Жалал-Абад",
        "science_title" => "Научные исследования",
        "science_intro" =>
            "Институт проводит обширную научно-исследовательскую работу в следующих направлениях:",
        "science_direction_title" => "Основные направления",
        "science_direction_1" =>
            "Селекция и семеноводство: разработка новых сортов сельхозкультур, адаптированных к условиям Кыргызстана",
        "science_direction_2" =>
            "Растениеводство: исследование технологий возделывания основных культур",
        "science_direction_3" =>
            "Почвоведение: изучение свойств почв и методы повышения плодородия",
        "science_direction_4" =>
            "Защита растений: методы борьбы с вредителями и болезнями",
        "science_direction_5" =>
            "Агрономия: исследование технологий земледелия и хозяйственных приемов",
        "science_publications_title" => "Публикации и разработки",
        "science_publications_text" =>
            "Результаты научных исследований публикуются в национальных и международных журналах и внедряются в практику сельского хозяйства.",
        "products_title" => "Продукция и услуги",
        "products_text" =>
            "Институт предлагает продукты и услуги для сельхозпредприятий и фермеров:",
        "products_main_title" => "Основная продукция",
        "products_item_1_title" => "Семена и посевной материал",
        "products_item_1_text" =>
            "Высококачественные сорта сельхозкультур для различных почвенно-климатических условий.",
        "products_item_2_title" => "Технологические решения",
        "products_item_2_text" =>
            "Разработанные и апробированные технологии возделывания основных культур.",
        "products_item_3_title" => "Агрохимикаты",
        "products_item_3_text" =>
            "Рекомендации по применению удобрений и средств защиты растений.",
        "products_item_4_title" => "Консультационные услуги",
        "products_item_4_text" =>
            "Экспертные консультации по вопросам сельскохозяйственного производства.",
        "news_title" => "Новости",
        "news_intro" => "Последние новости и события из жизни Институт:",
        "news_category_default" => "Новости",
        "news_empty" => "Пока нет новостей.",
        "news_more" => "Подробнее",
        "photo_alt" => "Фото",
        "news_article_1_title" => "Новый сорт пшеницы разработан Институт",
        "news_article_1_date" => "Опубликовано: 2024-05-11",
        "news_article_1_text" =>
            "Институт представляет новый высокоурожайный сорт пшеницы, специально адаптированный к условиям Кыргызского нагорья...",
        "news_article_2_title" =>
            "Международная конференция по аграрным наукам",
        "news_article_2_date" => "Опубликовано: 2024-05-05",
        "news_article_2_text" =>
            "Институт принял участие в международной конференции, где были представлены последние разработки в области растениеводства...",
        "news_article_3_title" =>
            "Расширение партнерства с иностранными организациями",
        "news_article_3_date" => "Опубликовано: 2024-04-28",
        "news_article_3_text" =>
            "Институт подписал соглашение о сотрудничестве с несколькими ведущими научными центрами...",
        "gallery_title" => "Галерея",
        "gallery_text" =>
            "Фотографии мероприятий, исследований и объектов Институт.",
        "contacts_title" => "Контакты",
        "contacts_text" =>
            "Свяжитесь с Кыргызским научно-исследовательским институтом земледелия имени К.К. Азыкова по любым вопросам о науке, продукции и сотрудничестве.",
        "contacts_address_title" => "Наш адрес",
        "contacts_address_text" =>
            "Кыргызский научно-исследовательский институт земледелия имени К.К. Азыкова, г. Бишкек, Кыргызская Республика",
        "contacts_address_label" => "Адрес",
        "contacts_address_value" =>
            "Кыргызская Республика, г. Бишкек, ул. Тимура Фрунзе 100/1",
        "contacts_address_link" =>
            "https://2gis.kg/bishkek/firm/70000001021237453",
        "contacts_phone" => "Телефон: +996 (312) XX-XX-XX",
        "contacts_phone_label" => "Тел",
        "contacts_phone_value" => "0(312) 41 71 54",
        "contacts_fax" => "Факс: +996 (312) XX-XX-XX",
        "contacts_fax_label" => "Факс",
        "contacts_fax_value" => "0(312) 41 79 08",
        "contacts_email" => "Email: info@kniiz.kg",
        "contacts_email_label_text" => "Email",
        "contacts_email_value" => "nauca.zemledel@gmail.com",
        "contacts_website" => "Веб-сайт: www.kniiz.kg",
        "contacts_work_title" => "Режим работы",
        "contacts_work_week" => "Пн-Пт: 09:00 - 18:00",
        "contacts_work_weekend" => "Сб-Вс: Выходной",
        "contacts_workhours_label" => "График работы",
        "contacts_workhours_value" => "Понедельник – Пятница: 9:00 – 18:00",
        "contacts_form_title" => "Форма обратной связи",
        "contacts_name" => "Имя",
        "contacts_email_label" => "Email",
        "contacts_message" => "Сообщение",
        "contacts_send" => "Отправить",
        "contacts_social_title" => "Социальные сети",
        "contacts_form_success" =>
            "Ваше сообщение получено. Мы свяжемся с вами в ближайшее время.",
        "contacts_form_success_title" => "Сообщение отправлено!",
        "contacts_form_validation_title" => "Проверьте форму",
        "contacts_form_error" => "Пожалуйста, заполните все поля.",
        "form_err_name" => "Введите ваше имя",
        "form_err_email" => "Введите корректный email",
        "form_err_message" => "Введите сообщение",
        "feedback_email_subject" => "Заявка с сайта Институт",
        "footer_about_title" => "О Институт",
        "footer_about_line1" =>
            "Кыргызский научно-исследовательский институт земледелия имени К.К. Азыкова.",
        "footer_about_line2" =>
            "Развитие сельского хозяйства и продовольственная безопасность Кыргызстана.",
        "footer_contacts_title" => "Контакты",
        "footer_menu_title" => "Меню",
        "footer_copyright" => "© 2026 Институт. Все права защищены.",
        "footer_menu_home" => "Главная",
        "footer_menu_history" => "История",
        "footer_menu_maps" => "Карты",
        "footer_menu_science" => "Наука",
        "footer_menu_products" => "Продукция",
        "lang_switcher_label" => "Язык",
        "nav_media" => "Медиа",
        "nav_administration" => "Администрация",
        "admin_subtitle" =>
            "Руководство, заведующие отделами и директора филиалов Институт",
        "admin_section_leadership" => "Руководство",
        "admin_role_director" => "Директор",
        "admin_role_deputy" => "Зам. директора",
        "admin_role_secretary" => "Ученый секретарь",
        "admin_section_departments" => "Зав. отделы института",
        "admin_section_departments_note" => "только зав. отделы",
        "admin_section_branches" => "Руководители филиалов",
        "admin_section_branches_note" =>
            "в этом разделе будут только директора",
        "admin_head_wheat" => "Зав. отдел пшеницы",
        "admin_head_barley" => "Зав. отдел ячменя",
        "admin_head_corn" => "Зав. отдел кукурузы",
        "admin_head_sugarbeet" => "Зав. отдел сахарной свеклы",
        "admin_head_fruit_veg" => "Зав. плодоовощного отдела",
        "admin_head_soil" => "Зав. отдела почвоведения",
        "admin_head_agrochemistry" => "Зав. отдела агрохимии",
        "nav_documents" => "Документы",
        "nav_international" => "Международная деятельность",
        "docs_page_subtitle" =>
            "Официальные документы и справочные материалы Институт",
        "docs_cat_polozhenie" => "Положение",
        "docs_cat_postanovlenie" => "Постановление",
        "docs_polozhenie_file_1" =>
            "Жобо Кыргыз дыйканчылык илимий-изилдөө институту жөнүндө 11.11.25 жыл",
        "docs_polozhenie_file_2" =>
            "Положение о Кыргызском научно-исследовательском институте земледелия от 11.11.25 г.",
        "docs_postanovlenie_file_1" => "Постановление Институт переименование",
        "docs_postanovlenie_file_2" => "Токтом Институт переименование",
        "docs_empty" => "Документы в этом разделе скоро будут добавлены.",
        "docs_download" => "Скачать PDF",
        "docs_view" => "Читать",
        "docs_viewer_title" => "Просмотр документа",
        "docs_viewer_close" => "Закрыть",
        "meta_desc_home" =>
            "Кыргызский научно-исследовательский институт земледелия им. К.К. Азыкова — ведущее научное учреждение по селекции, семеноводству и агрохимии Кыргызстана.",
        "meta_keys_home" =>
            "КНИИЗ, Кыргызский институт земледелия, селекция, семеноводство, агрохимия, Кыргызстан",
        "meta_desc_news" =>
            "Последние новости и события Кыргызского научно-исследовательского института земледелия.",
        "meta_keys_news" =>
            "новости КНИИЗ, события института, аграрные новости Кыргызстан",
        "meta_desc_history" =>
            "История создания и развития Кыргызского научно-исследовательского института земледелия с 1956 года.",
        "meta_keys_history" =>
            "история КНИИЗ, история института, 1956, Кыргызстан",
        "meta_desc_maps" =>
            "Интерактивные карты опытно-селекционных станций КНИИЗ по Кыргызстану.",
        "meta_keys_maps" =>
            "карта КНИИЗ, опытные станции, Кыргызстан, сельскохозяйственные угодья",
        "meta_desc_science" =>
            "Научно-исследовательские отделы КНИИЗ: пшеница, ячмень, кукуруза, сахарная свекла, почвоведение, агрохимия.",
        "meta_keys_science" =>
            "научные отделы КНИИЗ, пшеница, ячмень, кукуруза, сахарная свекла, почвоведение",
        "meta_desc_administration" =>
            "Руководство и научный состав Кыргызского научно-исследовательского института земледелия.",
        "meta_keys_administration" =>
            "руководство КНИИЗ, администрация, сотрудники, учёные",
        "meta_desc_documents" =>
            "Официальные документы и нормативные акты Кыргызского научно-исследовательского института земледелия.",
        "meta_keys_documents" =>
            "документы КНИИЗ, положение, постановление, официальные документы",
        "meta_desc_gallery" =>
            "Фотогалерея мероприятий, исследований и объектов КНИИЗ.",
        "meta_keys_gallery" =>
            "галерея КНИИЗ, фотографии, мероприятия института",
        "meta_desc_contacts" =>
            "Контактная информация Кыргызского научно-исследовательского института земледелия — адрес, телефон, email.",
        "meta_keys_contacts" => "контакты КНИИЗ, адрес, телефон, Бишкек",
        "meta_desc_katalog" =>
            "Каталог сортов сельскохозяйственных культур, разработанных КНИИЗ: пшеница, ячмень, кукуруза и другие.",
        "meta_keys_katalog" =>
            "каталог сортов, сорта пшеницы, сорта ячменя, сорта кукурузы, КНИИЗ",
        "meta_desc_international" =>
            "Международная деятельность и сотрудничество КНИИЗ с зарубежными научными организациями.",
        "meta_keys_international" =>
            "международное сотрудничество КНИИЗ, международные проекты, аграрная наука",
    ],
    "en" => [
        "admin_subtitle" =>
            "Management, scientific departments and regional branches",
        "admin_search_placeholder" =>
            "Search by name, role, department or email...",
        "admin_tab_all" => "All Staff",
        "admin_tab_admin" => "Administration",
        "admin_tab_science" => "Scientific Depts",
        "admin_tab_branches" => "Branches & Stations",
        "admin_section_leadership" => "Administration & Management",
        "admin_section_support" => "Administrative Support",
        "admin_section_science" => "Scientific Research Departments",
        "admin_section_branches" => "Regional Experimental Stations & Branches",
        "admin_branch_management" => "Management & Specialists",
        "admin_search_found" => "Found",
        "admin_search_not_found" => "No staff found matching",
        "admin_support_dept" => "Administrative Support Department",
        "admin_support_desc" =>
            "Support, IT, accounting, and technical operations",
        "science_dept_tag_breeding" => "Breeding",
        "science_dept_tag_technology" => "Technology",
        "science_dept_tag_soil" => "Soil Science",
        "science_dept_tag_agro" => "Agrochemistry",
        "science_dept_desc_wheat" =>
            "Development of new competitive wheat varieties.",
        "science_dept_desc_barley" =>
            "Breeding and primary seed production of barley.",
        "science_dept_desc_corn" =>
            "Creation of highly productive corn hybrids, primary seed production and breeding of inbred lines.",
        "science_dept_desc_sugarbeet" =>
            "Breeding of hybrids based on CMS, primary seed production and evaluation of root crop quality.",
        "science_dept_desc_fruit_veg" =>
            "Development of innovative technologies for growing fruit and vegetable crops.",
        "science_dept_desc_soil" =>
            "Study of soil resources and methods to increase fertility.",
        "science_dept_desc_agro" =>
            "Analysis of nutrients and fertilizer systems.",
        "science_dept_desc_issyk" =>
            "Scientific research in the Issyk-Kul region.",
        "science_hero_title" => "Kyrgyz Research Institute of Farming",
        "science_hero_desc" =>
            "We work in the fields of breeding, agronomy, soil science, and seed production to provide the country with new varieties and technological solutions.",
        "science_departments_title" => "Research Departments",
        "science_departments_count" => "7 subdivisions",
        "science_btn_more" => "Read more",
        "science_branches_title" => "Regional Branches",
        "science_branch_address" => "Address",
        "science_branch_activity" => "Activity",
        "science_branch_area" => "Area",
        "science_branch_director" => "Director",
        "science_branch_phone" => "Phone",
        "structure_detail_intro" =>
            "Brief description of department activities",
        "structure_detail_photo_placeholder" =>
            "Placeholder for department photo",
        "structure_detail_staff_title" => "Management and Staff",
        "structure_detail_head" => "Head of Department",
        "structure_detail_experience" => "Experience:",
        "structure_detail_years" => "years",
        "structure_detail_research_title" => "Main research directions",
        "structure_detail_results_title" =>
            "Key results and achievements of the department",
        "structure_detail_international_title" => "International Projects",
        "structure_detail_international_coop" => "Cooperation and Exchange",
        "structure_detail_projects_current" => "Current scientific projects",
        "structure_detail_projects_completed" => "Completed projects",
        "structure_detail_publications_title" => "Department Publications",
        "structure_detail_publications_desc" =>
            "Articles, monographs, recommendations",
        "structure_detail_goals_title" => "Department Goals",
        "structure_detail_perspectives_title" => "Development Perspectives",
        "structure_detail_services_title" =>
            "Services and Products of the Department",
        "structure_detail_events_title" => "Scientific Events",
        "structure_detail_infrastructure_title" =>
            "Material and Technical Base",
        "structure_detail_cta_title" => "Contact the Department",
        "structure_detail_cta_desc" =>
            'For additional information about the department\'s activities, cooperation, or purchasing seed material',
        "structure_detail_cta_btn" => "Contacts",
        "page_title_home" => "Home",
        "page_title_history" => "History",
        "page_title_maps" => "Maps",
        "page_title_science" => "Science",
        "page_title_products" => "Products",
        "page_title_news" => "News",
        "page_title_gallery" => "Gallery",
        "page_title_structure" => "Structure",
        "structure_detail_back" => "Back to Science",
        "structure_detail_wheat_title" =>
            "Department of Wheat Breeding and Primary Seed Production",
        "structure_detail_barley_title" =>
            "Department of Barley Breeding and Primary Seed Production",
        "structure_detail_sugarbeet_title" =>
            "Department of Sugar Beet Breeding and Primary Seed Production",
        "structure_detail_corn_title" =>
            "Department of Corn Breeding and Primary Seed Production",
        "structure_detail_fruit_veg_title" => "Fruit and Vegetable Department",
        "structure_detail_agrochemistry_title" => "Agrochemistry Department",
        "structure_detail_soil_title" => "Soil Science Department",
        "structure_detail_issyk_title" => "Issyk-Kul Branch",
        "page_title_contacts" => "Contacts",
        "logo" => "Institute",
        "top_navigation" => "Navigation",
        "top_contacts" => "Contacts",
        "top_search" => "Search",
        "top_lang_selector" => "Language Selector",
        "lang_en" => "English",
        "lang_ru" => "Russian",
        "lang_ky" => "Kyrgyz",
        "footer_subscribe_title" => "Newsletter",
        "footer_subscribe_text" =>
            "Get the latest news on research and seed production first.",
        "footer_subscribe_placeholder" => "Your Email",
        "footer_subscribe_success" => "Thank you for subscribing!",
        "search_placeholder" => "Search",
        "search_no_results" => "No results found",
        "search_page_match" => "Found on page",
        "nav_home" => "Home",
        "nav_about" => "About Us",
        "nav_history" => "History",
        "nav_maps" => "Maps",
        "nav_structure" => "Structure",
        "nav_science" => "Science",
        "nav_products" => "Products",
        "nav_news" => "News",
        "nav_gallery" => "Gallery",
        "nav_catalog" => "Varieties catalog",
        "nav_contacts" => "Contacts",
        "nav_management" => "Management",
        "nav_departments" => "Departments",
        "nav_branches" => "Branches",
        "hero_title" =>
            "Kyrgyz Scientific Research Institute of Agriculture named after K.K. Azykov",
        "hero_text" => "We will ensure the food security of Kyrgyzstan!",
        "hero_button_more" => "Learn more",
        "hero_button_contact" => "Contact us",
        "about_title" => "About the Institute",
        "about_text" =>
            "The Institute of Agriculture conducts research in breeding and primary seed production, agriculture, soil science, agrochemistry and crop production. We develop technologies to increase yields and food security in Kyrgyzstan.",
        "index_stat_years" => "Years of research",
        "index_stat_staff" => "Research staff",
        "index_stat_publications" => "Scientific publications",
        "index_stat_landfund" => "Land fund",
        "index_map_load_error" => "Error loading map",
        "index_badge_chuy" => "Chuy: Beet",
        "index_badge_osh" => "Osh: Grains",
        "index_badge_batken" => "Batken: Cotton",
        "index_open_full_map" => "Open full map",
        "carousel_prev" => "Previous",
        "carousel_next" => "Next",
        "index_gallery_more" => "View more",
        "index_gallery1_alt" => "Wheat fields",
        "index_gallery1_title" => "Research crops",
        "index_gallery1_text" =>
            "Breeding and testing new wheat varieties adapted to the climate conditions of Kyrgyzstan.",
        "index_gallery2_alt" => "Cotton harvest",
        "index_gallery2_title" => "Industrial crops",
        "index_gallery2_text" =>
            "Research on cotton and other industrial crops at the institute’s southern experimental stations.",
        "index_gallery3_alt" => "Sugar beet",
        "index_gallery3_title" => "Sugar beet",
        "index_gallery3_text" =>
            "Breeding high-sugar hybrids and primary seed production for local farmers.",
        "index_gallery4_alt" => "Soil science",
        "index_gallery4_title" => "Soil research",
        "index_gallery4_text" =>
            "Soil composition analysis and recommendations on fertility preservation and agrochemistry.",
        "index_gallery5_alt" => "Corn",
        "index_gallery5_title" => "Corn fields",
        "index_gallery5_text" =>
            "Locally bred corn hybrids with high yield potential.",
        "index_gallery6_alt" => "Laboratory",
        "index_gallery6_title" => "Modern laboratories",
        "index_gallery6_text" =>
            "Research biotechnology centers and phytosanitary control.",
        "index_contacts_title" => "Contact information",
        "index_contacts_subtitle" => "Contact us in any convenient way",
        "index_phonefax_label" => "Phone / Fax",
        "index_form_name_ph" => "John Smith",
        "index_form_email_ph" => "john@example.com",
        "index_form_message_ph" => "Enter your message...",
        "stats_projects" => "research projects",
        "stats_experience" => "years of scientific experience",
        "stats_stations" => "experimental stations",
        "goals_title" => "Goals and Objectives",
        "goal_research_title" => "Scientific research and development",
        "goal_research_text" =>
            "We develop current issues of breeding, soil science and crop production, create innovative technologies and improve yields.",
        "goal_planning_title" => "Planning and methodology",
        "goal_planning_text" =>
            "We develop methodical plans for laboratories and field trials so that new solutions are ready for implementation quickly.",
        "goal_support_title" => "Implementation and support",
        "goal_support_text" =>
            "We implement scientific achievements in the fields, support agricultural producers and share best practices.",
        "stations_title" => "Experimental breeding stations",
        "stations_direction_title" => "Key directions",
        "stations_direction_1" => "Seed production and breeding",
        "stations_direction_2" => "Research of sugar beet and vegetable crops",
        "stations_direction_3" => "Agroclimatic and soil research",
        "stations_direction_4" => "Increasing crop productivity",
        "stations_sites_title" => "Our sites",
        "stations_sites_text" =>
            "The Institute works with several experimental breeding stations across the country to ensure sustainable agricultural development.",
        "history_title" =>
            "The history of the Kyrgyz Scientific Research Institute of Agriculture",
        "history_text" =>
            "The Kyrgyz Scientific Research Institute of Agriculture was established in 1956 on the basis of the State Breeding and Republican Fruit and Vegetable experimental stations.",
        "history_foundation_title" => "Foundation and structure",
        "history_foundation_text" =>
            "The Institute of Agriculture was the largest diversified and comprehensive research institution, with 17 departments including 26 laboratories and sectors.",
        "history_foundation_more" =>
            "The institute included experimental farms, the Kyrgyz experimental breeding station for sugar beet, the Kyrgyz experimental station for cotton growing, the Republican Feed Experimental Station, the Issyk-Kul experimental breeding station, Naryn and Burgandinsky support points, seed farms named after the 50th anniversary of the USSR and Kugart.",
        "history_foundation_more_2" =>
            'The scientific work of the institute, its experimental stations and support points in various soil and climatic zones was aimed at solving key problems: the scientific foundations of irrigation and rain-fed agriculture; breeding high-yield, high-quality crop varieties; improving seed production methods; developing promising crop cultivation technology based on complex mechanization; and the economy of Kyrgyzstan\'s agricultural sector.',
        "history_achievements_title" => "Achievements and results",
        "history_achievements_intro" =>
            "These and other tasks were carried out by a well-coordinated, highly qualified team of scientists from the institute, its experimental stations and support points:",
        "history_achievement_1" =>
            "The institute employed 700 scientific and technical staff, including 341 researchers, of whom 99 were candidates and doctors of sciences.",
        "history_achievement_2" =>
            "Recommendations were developed for managing typical farms in the main agricultural zones of the republic.",
        "history_achievement_3" =>
            "Scientific and production activities covered 135,000 hectares, including 35,000 hectares of arable land, about half of which was irrigated.",
        "history_achievement_4" =>
            "Orchards and vineyards occupied 1,100 hectares, while the remaining land was occupied by hayfields and pastures.",
        "history_achievement_5" =>
            "Experimental stations and seed farms annually produced about 80,000 tons of elite and first-reproduction grain seeds for collective and state farms.",
        "history_achievement_6" =>
            "They also produced over 5,000 tons of maize seed, 6,000 tons of seed potatoes, 2,000 tons of perennial grass seeds, 400 tons of vegetable seeds, all elite sugar beet seeds, and 50-60 thousand fruit and grape seedlings.",
        "maps_title" => "Maps of Kyrgyzstan",
        "maps_text" =>
            "Interactive map with crop types, station addresses and color legend.",
        "maps_legend_title" => "Legend",
        "maps_legend_beet" => "Beet",
        "maps_legend_grain" => "Grains",
        "maps_legend_cotton" => "Cotton",
        "maps_legend_vegetables" => "Vegetable crops",
        "maps_legend_seed" => "Seed production",
        "maps_addresses_title" => "Locations with addresses",
        "maps_address_1" =>
            "Chuy region, Prochnost village, Sportivnaya str. 61 — Sugar beet",
        "maps_address_2" =>
            "Osh region, Kara-Suu village, Bolshevik str. — Grain crops",
        "maps_address_3" => "Batken region, Kyzyl-Kiya village — Cotton",
        "maps_address_4" =>
            "Jalal-Abad region, Toguz-Toro village — Vegetable crops",
        "maps_address_5" => "Naryn region, Lenin str. 209 — Seed production",
        "maps_description_1" =>
            "The map shows key experimental and breeding sites of the Institute.",
        "maps_description_2" =>
            "Each color corresponds to a crop type and helps to quickly identify the research directions.",
        "maps_info_placeholder" =>
            "Hover over a region or click it to view details",
        "maps_info_title" => "Station Information",
        "maps_info_more" => "More about the station",
        "maps_info_address_label" => "Address / Location",
        "maps_info_crops_label" => "Primary Crops",
        "maps_info_description_label" => "Description & Research",
        "maps_label_area" => "Area",
        "maps_label_crops" => "Crops",
        "maps_label_activity" => "Activity",
        "maps_label_location" => "Location",
        "maps_label_director" => "Director",
        "maps_label_contacts" => "Contacts",
        "maps_show_on_map" => "Show on map",
        "maps_area_label" => "Area",
        "maps_area_not_specified" => "not specified in data",
        "maps_kml_error" => "Unable to load the land plot map.",
        "maps_land_fund_aria_label" => "KNIIZ land fund map",
        "station_ioss_title" => "Issyk-Kul Experimental Breeding Station",
        "station_ioss_area" => "102.0 ha",
        "station_ioss_crops" =>
            "Potatoes, fruit crops, grains and fodder crops",
        "station_ioss_activity" =>
            "Potato seed production, breeding and production trials",
        "station_ioss_location" =>
            "Issyk-Kul region, Ak-Suu district, Chelpek village",
        "station_ioss_director" => "Dairbek Tursungazievich Osmonov",
        "station_jany_pachta_title" => "Jany-Pakhta Seed Farm",
        "station_jany_pachta_area" => "482.0 ha",
        "station_jany_pachta_crops" => "Wheat, barley, alfalfa and other crops",
        "station_jany_pachta_activity" =>
            "Seed production of high-reproduction crops, agriculture",
        "station_jany_pachta_location" =>
            "Chuy region, Sokuluk district, Jany-Pakhta village",
        "station_jany_pachta_director" => "Arzymat Nurmamatovich Ergeshov",
        "station_koss_title" =>
            "Kyrgyz Experimental Breeding Station for Sugar Beet",
        "station_koss_area" => "239.0 ha",
        "station_koss_crops" => "Sugar beet, grains and fodder crops",
        "station_koss_activity" =>
            "Primary seed production, sugar beet seed production",
        "station_koss_location" =>
            "Chuy region, Sokuluk district, Pervomayskoye village",
        "station_koss_director" => "Kubanychbek Jenishbekovich Esenaliyev",
        "station_atai_title" => "Atai Seed Farm",
        "station_atai_area" => "125.8 ha",
        "station_atai_crops" => "Corn, cereals and fodder crops",
        "station_atai_activity" => "Seed farming, elite seed production",
        "station_atai_location" =>
            "Jalal-Abad region, Toguz-Toro district, Atai village",
        "station_atai_director" => "Jyrgalbek Kerimzhanovich Sakeev",
        "back_to_map" => "Back to Map",
        "plot_not_found" => "Plot Not Found",
        "plot_not_found_desc" =>
            "Unfortunately, the requested experimental plot was not found.",
        "agro_region_map" => "Regional field map",
        "agro_stats" => "Statistics",
        "agro_fields_count" => "Fields",
        "agro_total_ha" => "Area",
        "agro_search_fields" => "Search field...",
        "agro_filter_all" => "All crops",
        "agro_select_field" => "Select a field on the map",
        "agro_open_region_map" => "Open field map",
        "agro_quick_regions" => "Quick navigation",
        "agro_dblclick_hint" => "Double-click to open regional map",
        "agro_map_load_error" => "Failed to load region boundaries",
        "agro_back_region_map" => "Back to regional map",
        "agro_field_details" => "Field details",
        "agro_label_culture" => "Crop",
        "agro_label_moisture" => "Moisture",
        "agro_label_year" => "Year",
        "agro_label_yield" => "Yield",
        "agro_label_notes" => "Notes",
        "agro_crop_history" => "Crop history by year",
        "agro_no_history" => "No crop history yet",
        "agro_region_naryn" => "Naryn",
        "agro_region_issyk" => "Issyk-Kul",
        "agro_region_chuy" => "Chuy",
        "agro_region_osh" => "Osh",
        "agro_region_batken" => "Batken",
        "agro_region_jalal" => "Jalal-Abad",
        "science_title" => "Scientific research",
        "science_intro" =>
            "Institute conducts extensive research in the following areas:",
        "science_direction_title" => "Main directions",
        "science_direction_1" =>
            "Breeding and seed production: developing new varieties adapted to Kyrgyzstan conditions",
        "science_direction_2" =>
            "Crop production: researching cultivation technologies for major crops",
        "science_direction_3" =>
            "Soil science: studying soil properties and methods to improve fertility",
        "science_direction_4" =>
            "Plant protection: methods to combat pests and diseases",
        "science_direction_5" =>
            "Agronomy: researching farming technologies and agricultural practices",
        "science_publications_title" => "Publications and developments",
        "science_publications_text" =>
            "Research results are published in national and international journals and implemented in agricultural practice.",
        "products_title" => "Products and services",
        "products_text" =>
            "Institute offers products and services for agricultural enterprises and farmers:",
        "products_main_title" => "Main products",
        "products_item_1_title" => "Seeds and planting material",
        "products_item_1_text" =>
            "High-quality crop varieties for different soil and climate conditions.",
        "products_item_2_title" => "Technological solutions",
        "products_item_2_text" =>
            "Tested technologies for cultivation of major crops.",
        "products_item_3_title" => "Agrochemicals",
        "products_item_3_text" =>
            "Recommendations on fertilizers and plant protection products.",
        "products_item_4_title" => "Consulting services",
        "products_item_4_text" =>
            "Expert advice on agricultural production issues.",
        "news_title" => "News",
        "news_intro" => "Latest news and events from Institute:",
        "news_category_default" => "News",
        "news_empty" => "No news yet.",
        "news_more" => "Read more",
        "photo_alt" => "Photo",
        "news_article_1_title" => "Institute developed a new wheat variety",
        "news_article_1_date" => "Published: 2024-05-11",
        "news_article_1_text" =>
            "Institute presents a new high-yield wheat variety specially adapted to the conditions of the Kyrgyz highlands...",
        "news_article_2_title" =>
            "International conference on agricultural sciences",
        "news_article_2_date" => "Published: 2024-05-05",
        "news_article_2_text" =>
            "Institute participated in an international conference presenting the latest developments in crop production...",
        "news_article_3_title" =>
            "Expanding partnerships with foreign organizations",
        "news_article_3_date" => "Published: 2024-04-28",
        "news_article_3_text" =>
            "Institute signed cooperation agreements with several leading scientific centers...",
        "gallery_title" => "Gallery",
        "gallery_text" =>
            "Photos of events, research and facilities of Institute.",
        "contacts_title" => "Contacts",
        "contacts_text" =>
            "Contact the Kyrgyz Scientific Research Institute of Agriculture named after K.K. Azykov for any questions about research, products and cooperation.",
        "contacts_address_title" => "Our address",
        "contacts_address_text" =>
            "Kyrgyz Scientific Research Institute of Agriculture named after K.K. Azykov, Bishkek, Kyrgyz Republic",
        "contacts_address_label" => "Address",
        "contacts_address_value" =>
            "Kyrgyz Republic, Bishkek, Timur Frunze st. 100/1",
        "contacts_address_link" =>
            "https://2gis.kg/bishkek/firm/70000001021237453",
        "contacts_phone" => "Phone: +996 (312) XX-XX-XX",
        "contacts_phone_label" => "Phone",
        "contacts_phone_value" => "0(312) 41 71 54",
        "contacts_fax" => "Fax: +996 (312) XX-XX-XX",
        "contacts_fax_label" => "Fax",
        "contacts_fax_value" => "0(312) 41 79 08",
        "contacts_email" => "Email: info@kniiz.kg",
        "contacts_email_label_text" => "Email",
        "contacts_email_value" => "nauca.zemledel@gmail.com",
        "contacts_website" => "Website: www.kniiz.kg",
        "contacts_work_title" => "Working hours",
        "contacts_work_week" => "Mon-Fri: 09:00 - 18:00",
        "contacts_work_weekend" => "Sat-Sun: Closed",
        "contacts_workhours_label" => "Working hours",
        "contacts_workhours_value" => "Monday – Friday: 9:00 – 18:00",
        "contacts_form_title" => "Contact form",
        "contacts_name" => "Name",
        "contacts_email_label" => "Email",
        "contacts_message" => "Message",
        "contacts_send" => "Send",
        "contacts_social_title" => "Social media",
        "contacts_form_success" =>
            "Your message has been received. We will get back to you shortly.",
        "contacts_form_success_title" => "Message sent!",
        "contacts_form_validation_title" => "Please check the form",
        "contacts_form_error" => "Please fill in all required fields.",
        "form_err_name" => "Please enter your name",
        "form_err_email" => "Please enter a valid email",
        "form_err_message" => "Please enter your message",
        "feedback_email_subject" => "Message from Institute website",
        "footer_about_title" => "About Institute",
        "footer_about_line1" =>
            "Kyrgyz Scientific Research Institute of Agriculture named after K.K. Azykov.",
        "footer_about_line2" =>
            "Development of agriculture and food security of Kyrgyzstan.",
        "footer_contacts_title" => "Contacts",
        "footer_menu_title" => "Menu",
        "footer_copyright" => "© 2026 Institute. All rights reserved.",
        "footer_menu_home" => "Home",
        "footer_menu_history" => "History",
        "footer_menu_maps" => "Maps",
        "footer_menu_science" => "Science",
        "footer_menu_products" => "Products",
        "lang_switcher_label" => "Language",
        "nav_media" => "Media",
        "nav_administration" => "Administration",
        "admin_subtitle" =>
            "Leadership, department heads and branch directors of Institute",
        "admin_section_leadership" => "Leadership",
        "admin_role_director" => "Director",
        "admin_role_deputy" => "Deputy Director",
        "admin_role_secretary" => "Scientific Secretary",
        "admin_section_departments" => "Institute department heads",
        "admin_section_departments_note" => "department heads only",
        "admin_section_branches" => "Branch directors",
        "admin_section_branches_note" => "directors only in this section",
        "admin_head_wheat" => "Head of wheat department",
        "admin_head_barley" => "Head of barley department",
        "admin_head_corn" => "Head of corn department",
        "admin_head_sugarbeet" => "Head of sugar beet department",
        "admin_head_fruit_veg" => "Head of fruit and vegetable department",
        "admin_head_soil" => "Head of soil science department",
        "admin_head_agrochemistry" => "Head of agrochemistry department",
        "nav_documents" => "Documents",
        "nav_international" => "International Cooperation",
        "docs_page_subtitle" =>
            "Official documents and reference materials of Institute",
        "docs_cat_polozhenie" => "Regulations",
        "docs_cat_postanovlenie" => "Resolution",
        "docs_polozhenie_file_1" => "Regulations on KG",
        "docs_polozhenie_file_2" => "Regulations on RS",
        "docs_postanovlenie_file_1" => "Resolution on RS",
        "docs_postanovlenie_file_2" => "Resolution on KG",
        "docs_empty" => "Documents in this section will be added soon.",
        "docs_download" => "Download PDF",
        "docs_view" => "Read",
        "docs_viewer_title" => "Document Viewer",
        "docs_viewer_close" => "Close",
        "meta_desc_home" =>
            "Kyrgyz Research Institute of Agriculture named after K.K. Azykov — leading scientific institution for plant breeding, seed production and agrochemistry in Kyrgyzstan.",
        "meta_keys_home" =>
            "KNIIZ, Kyrgyz Institute of Agriculture, breeding, seed production, agrochemistry, Kyrgyzstan",
        "meta_desc_news" =>
            "Latest news and events from the Kyrgyz Research Institute of Agriculture.",
        "meta_keys_news" =>
            "KNIIZ news, institute events, agricultural news Kyrgyzstan",
        "meta_desc_history" =>
            "History of the Kyrgyz Research Institute of Agriculture since 1956.",
        "meta_keys_history" =>
            "KNIIZ history, institute history, 1956, Kyrgyzstan",
        "meta_desc_maps" =>
            "Interactive maps of KNIIZ experimental breeding stations across Kyrgyzstan.",
        "meta_keys_maps" =>
            "KNIIZ map, experimental stations, Kyrgyzstan, agricultural land",
        "meta_desc_science" =>
            "KNIIZ research departments: wheat, barley, corn, sugar beet, soil science, agrochemistry.",
        "meta_keys_science" =>
            "KNIIZ research departments, wheat, barley, corn, sugar beet, soil science",
        "meta_desc_administration" =>
            "Leadership and scientific staff of the Kyrgyz Research Institute of Agriculture.",
        "meta_keys_administration" =>
            "KNIIZ leadership, administration, staff, scientists",
        "meta_desc_documents" =>
            "Official documents and regulations of the Kyrgyz Research Institute of Agriculture.",
        "meta_keys_documents" =>
            "KNIIZ documents, regulations, official documents",
        "meta_desc_gallery" =>
            "Photo gallery of KNIIZ events, research and facilities.",
        "meta_keys_gallery" => "KNIIZ gallery, photos, institute events",
        "meta_desc_contacts" =>
            "Contact information for the Kyrgyz Research Institute of Agriculture — address, phone, email.",
        "meta_keys_contacts" => "KNIIZ contacts, address, phone, Bishkek",
        "meta_desc_katalog" =>
            "Catalog of crop varieties developed by KNIIZ: wheat, barley, corn and others.",
        "meta_keys_katalog" =>
            "variety catalog, wheat varieties, barley varieties, corn varieties, KNIIZ",
        "meta_desc_international" =>
            "International activities and cooperation of KNIIZ with foreign scientific organizations.",
        "meta_keys_international" =>
            "KNIIZ international cooperation, international projects, agricultural science",
    ],
    "ky" => [
        "admin_subtitle" =>
            "Жетекчилик, илимий бөлүмдөр жана аймактык филиалдар",
        "admin_search_placeholder" => "Ысым, кызмат же бөлүм боюнча издөө...",
        "admin_tab_all" => "Баары",
        "admin_tab_admin" => "Башкаруу аппараты",
        "admin_tab_science" => "Илимий бөлүмдөр",
        "admin_tab_branches" => "Филиалдар",
        "admin_section_leadership" => "Башкаруу жана административдик аппарат",
        "admin_section_support" => "Административдик колдоо",
        "admin_section_science" => "Илимий-изилдөө бөлүмдөрү",
        "admin_section_branches" =>
            "Аймактык тажрыйба станциялары жана филиалдар",
        "admin_branch_management" => "Жетекчилик жана адистер",
        "admin_search_found" => "Табылды",
        "admin_search_not_found" => "Эч нерсе табылган жок",
        "admin_support_dept" => "Административдик колдоо бөлүмү",
        "admin_support_desc" =>
            "Колдоо, IT, бухгалтердик эсеп жана техникалык иштер",
        "science_dept_tag_breeding" => "Селекция",
        "science_dept_tag_technology" => "Технологиялар",
        "science_dept_tag_soil" => "Топурак таануу",
        "science_dept_tag_agro" => "Агрохимия",
        "science_dept_desc_wheat" =>
            "Буудайдын жаңы атаандаштыкка жөндөмдүү сортторун иштеп чыгуу.",
        "science_dept_desc_barley" =>
            "Арпаны селекциялоо жана алгачкы үрөнчүлүк.",
        "science_dept_desc_corn" =>
            "Жүгөрүнүн жогорку түшүмдүү гибриддерин түзүү, алгачкы үрөнчүлүк жана инбреддик линияларды селекциялоо.",
        "science_dept_desc_sugarbeet" =>
            "ЦМС негизинде гибриддерди селекциялоо, алгачкы үрөнчүлүк жана тамыры азык өсүмдүктөрдүн сапатын баалоо.",
        "science_dept_desc_fruit_veg" =>
            "Мөмө-жемиш өсүмдүктөрүн өстүрүүнүн инновациялык технологияларын иштеп чыгуу.",
        "science_dept_desc_soil" =>
            "Топурак ресурстарын жана күрдүүлүктү жогорулатуу ыкмаларын изилдөө.",
        "science_dept_desc_agro" =>
            "Азык заттарын жана жер семирткичтер тутумун талдоо.",
        "science_dept_desc_issyk" => "Ысык-Көл аймагындагы илимий изилдөөлөр.",
        "science_hero_title" => "Кыргыз дыйканчылык илим-изилдөө институту",
        "science_hero_desc" =>
            "Биз өлкөгө жаңы сортторду жана технологиялык чечимдерди берүү үчүн селекция, агрономия, топурак таануу жана үрөнчүлүк багыттарында иштейбиз.",
        "science_departments_title" => "Илимий-изилдөө бөлүмдөрү",
        "science_departments_count" => "7 бөлүм",
        "science_btn_more" => "Кененирээк",
        "science_branches_title" => "Аймактык филиалдар",
        "science_branch_address" => "Дарек",
        "science_branch_activity" => "Ишмердүүлүк",
        "science_branch_area" => "Аянты",
        "science_branch_director" => "Жетекчи",
        "science_branch_phone" => "Телефон",
        "structure_detail_intro" =>
            "Бөлүмдүн ишмердүүлүгүнүн кыскача сүрөттөлүшү",
        "structure_detail_photo_placeholder" => "Бөлүмдүн сүрөтү үчүн орун",
        "structure_detail_staff_title" => "Жетекчилик жана кызматкерлер",
        "structure_detail_head" => "Жетекчи",
        "structure_detail_experience" => "Тажрыйбасы:",
        "structure_detail_years" => "жыл",
        "structure_detail_research_title" => "Изилдөөлөрдүн негизги багыттары",
        "structure_detail_results_title" =>
            "Бөлүмдүн негизги жыйынтыктары жана жетишкендиктери",
        "structure_detail_international_title" => "Эл аралык долбоорлор",
        "structure_detail_international_coop" => "Кызматташтык жана алмашуу",
        "structure_detail_projects_current" => "Учурдагы илимий долбоорлор",
        "structure_detail_projects_completed" => "Аяктаган долбоорлор",
        "structure_detail_publications_title" => "Бөлүмдүн басылмалары",
        "structure_detail_publications_desc" =>
            "Макалалар, монографиялар, сунуштамалар",
        "structure_detail_goals_title" => "Бөлүмдүн максаттары",
        "structure_detail_perspectives_title" => "Өнүгүү перспективалары",
        "structure_detail_services_title" =>
            "Бөлүмдүн кызматтары жана товарлары",
        "structure_detail_events_title" => "Илимий иш-чаралар",
        "structure_detail_infrastructure_title" =>
            "Материалдык-техникалык база",
        "structure_detail_cta_title" => "Бөлүм менен байланышыңыз",
        "structure_detail_cta_desc" =>
            "Бөлүмдүн ишмердүүлүгү, кызматташуу же үрөн материалын сатып алуу боюнча кошумча маалымат алуу үчүн",
        "structure_detail_cta_btn" => "Байланыштар",
        "page_title_home" => "Башкы бет",
        "page_title_history" => "Тарых",
        "page_title_maps" => "Карталар",
        "page_title_science" => "Илим",
        "page_title_products" => "Өнүмдөр",
        "page_title_news" => "Жаңылыктар",
        "page_title_gallery" => "Галерея",
        "page_title_structure" => "Түзүм",
        "structure_detail_back" => "«Илим» бөлүмүнө кайтуу",
        "structure_detail_wheat_title" =>
            "Буудай селекциясы жана баштапкы үрөнчүлүк бөлүмү",
        "structure_detail_barley_title" =>
            "Арпанын селекциясы жана алгачкы үрөнчүлүк бөлүмү",
        "structure_detail_sugarbeet_title" =>
            "Кант кызылчасынын селекциясы жана баштапкы үрөнчүлүк бөлүмү",
        "structure_detail_corn_title" =>
            "Жүгөрүнүн селекциясы жана баштапкы үрөнчүлүк бөлүмү",
        "structure_detail_fruit_veg_title" => "Жемиш-жашылча бөлүмү",
        "structure_detail_agrochemistry_title" => "Агрохимия бөлүмү",
        "structure_detail_soil_title" => "Топурак таануу бөлүмү",
        "structure_detail_issyk_title" => "Ысык-Көл филиалы",
        "page_title_contacts" => "Контакттар",
        "logo" => "Институт",
        "top_navigation" => "Навигация",
        "top_contacts" => "Байланышуу",
        "top_search" => "Издөө",
        "top_lang_selector" => "Тил тандаңыз",
        "lang_en" => "English",
        "lang_ru" => "Орусча",
        "lang_ky" => "Кыргызча",
        "footer_subscribe_title" => "Жазылуу",
        "footer_subscribe_text" =>
            "Изилдөө жана үрөнчүлүк боюнча акыркы жаңылыктарды биринчилерден болуп алыңыз.",
        "footer_subscribe_placeholder" => "Сиздин Email",
        "footer_subscribe_success" => "Жазылганыңыз үчүн рахмат!",
        "search_placeholder" => "Издөө",
        "search_no_results" => "Эч нерсе табылган жок",
        "search_page_match" => "Бетте табылды",
        "nav_home" => "Башкы бет",
        "nav_about" => "Биз жөнүндө",
        "nav_history" => "Тарых",
        "nav_maps" => "Карталар",
        "nav_structure" => "Түзүм",
        "nav_science" => "Илим",
        "nav_products" => "Өнүмдөр",
        "nav_news" => "Жаңылыктар",
        "nav_gallery" => "Галерея",
        "nav_catalog" => "Сорттор каталогу",
        "nav_contacts" => "Контакттар",
        "nav_management" => "Башкармалык",
        "nav_departments" => "Бөлүмдөр",
        "nav_branches" => "Филиалдар",
        "hero_title" =>
            "К.К. Азыкoв атындагы Кыргыз дыйканчылык илим изилдөө институту ",
        "hero_text" =>
            "Биз Кыргызстандын азык-түлүк коопсуздугун камсыз кылабыз!",
        "hero_button_more" => "Көбүрөк билүү",
        "hero_button_contact" => "Биз менен байланыш",
        "about_title" => "Институт жөнүндө",
        "about_text" =>
            "Дыйканчылык институту селекция жана баштапкы үрөн өндүрүшү, дыйканчылык, топурак таануу, агрохимия жана өсүмдүк өстүрүү жаатындагы изилдөөлөрдү жүргүзөт. Биз түшүмдүүлүктү жана азык-түлүк коопсуздугун жогорулатууга технологияларды иштеп чыгабыз.",
        "index_stat_years" => "Илимий изилдөөлөр жылдары",
        "index_stat_staff" => "Илимий кызматкерлер",
        "index_stat_publications" => "Илимий басылмалар",
        "index_stat_landfund" => "Жер фонду",
        "index_map_load_error" => "Картаны жүктөөдө ката",
        "index_badge_chuy" => "Чүй: Кызылча",
        "index_badge_osh" => "Ош: Дан өсүмдүктөрү",
        "index_badge_batken" => "Баткен: Пахта",
        "index_open_full_map" => "Толук картаны ачуу",
        "carousel_prev" => "Мурунку",
        "carousel_next" => "Кийинки",
        "index_gallery_more" => "Көбүрөөк көрүү",
        "index_gallery1_alt" => "Буудай айдоо талаалары",
        "index_gallery1_title" => "Илимий айдоо",
        "index_gallery1_text" =>
            "Кыргызстандын климаттык шарттарына туруктуу буудайдын жаңы сортторун чыгаруу жана сыноо.",
        "index_gallery2_alt" => "Пахта жыйноо",
        "index_gallery2_title" => "Техникалык өсүмдүктөр",
        "index_gallery2_text" =>
            "Институттун түштүк тажрыйба станцияларында пахта жана башка техникалык өсүмдүктөр боюнча изилдөөлөр.",
        "index_gallery3_alt" => "Кант кызылчасы",
        "index_gallery3_title" => "Кант кызылчасы",
        "index_gallery3_text" =>
            "Жогорку канттуулуктагы гибриддерди чыгаруу жана баштапкы үрөнчүлүк.",
        "index_gallery4_alt" => "Топурак таануу",
        "index_gallery4_title" => "Топурак изилдөөлөрү",
        "index_gallery4_text" =>
            "Топурактын курамын талдоо жана түшүмдүүлүктү сактоо боюнча сунуштар.",
        "index_gallery5_alt" => "Жүгөрү",
        "index_gallery5_title" => "Жүгөрү талаалары",
        "index_gallery5_text" =>
            "Жогорку түшүм потенциалы бар ата мекендик селекциядагы жүгөрү гибриддери.",
        "index_gallery6_alt" => "Лаборатория",
        "index_gallery6_title" => "Заманбап лабораториялар",
        "index_gallery6_text" =>
            "Илимий-изилдөө биотехнология борборлору жана фитосанитардык көзөмөл.",
        "index_contacts_title" => "Байланыш маалыматы",
        "index_contacts_subtitle" =>
            "Биз менен ыңгайлуу жол аркылуу байланышыңыз",
        "index_phonefax_label" => "Телефон / Факс",
        "index_form_name_ph" => "Аты-жөнү",
        "index_form_email_ph" => "email@example.com",
        "index_form_message_ph" => "Кабарыңызды жазыңыз...",
        "stats_projects" => "илимий долбоорлор",
        "stats_experience" => "илимий тажрыйба жылдары",
        "stats_stations" => "тажрыйба-сиелектоо станциялары",
        "goals_title" => "Максаттар жана тапшырмалар",
        "goal_research_title" => "Илимий изилдөөлөр жана өнүгүү",
        "goal_research_text" =>
            "Биз селекция, топурак таануу жана өсүмдүк өстүрүү маселелерин изилдеп, инновациялык технологияларды түзөбүз жана түшүмдүүлүктү жогорулатабыз.",
        "goal_planning_title" => "Пландоо жана ыкмалар",
        "goal_planning_text" =>
            "Биз лабораториялар жана талаа сыноолору үчүн методикалык пландарды даярдап, жаңы чечимдерди ыкчам ишке киргизүүгө даяр кылабыз.",
        "goal_support_title" => "Внедрение жана колдоо",
        "goal_support_text" =>
            "Биз илимий жетишкендиктерди талаада колдонуп, айыл чарба ишканаларын колдойбуз жана мыкты тажрыйбаларды жайылтабыз.",
        "stations_title" => "Тажрыйба-сиелектоо станциялары",
        "stations_direction_title" => "Негизги багыттар",
        "stations_direction_1" => "Өнүмдүүлүк жана үрөнчүлүк",
        "stations_direction_2" =>
            "Кант кызылчасы жана жашылча өсүмдүктөрү боюнча изилдөөлөр",
        "stations_direction_3" => "Агроклиматикалык жана топурак изилдөөлөрү",
        "stations_direction_4" => "Өсүмдүктөрдүн продуктивдүүлүгүн жогорулатуу",
        "stations_sites_title" => "Биздин жайлар",
        "stations_sites_text" =>
            "Институт өлкө боюнча бир нече тажрыйба-сиелектоо станциялары менен иштейт жана туруктуу айыл чарба өнүгүүсүн камсыз кылат.",
        "history_title" =>
            "Кыргыз дыйканчылык илимий-изилдөө институтунун тарыхы",
        "history_text" =>
            "Кыргыз дыйканчылык илимий-изилдөө институту 1956-жылы Мамлекеттик селекциялык жана Республикалык мөмө-жемиш тажрыйба станцияларынын базасында түзүлгөн.",
        "history_foundation_title" => "Түзүлүшү жана түзүмү",
        "history_foundation_text" =>
            "Институт ири көп тармактуу жана комплекстүү илимий-изилдөө мекемеси болуп, 17 бөлүмдөн жана 26 лабораториядан жана сектордон турган.",
        "history_foundation_more" =>
            'Институттун курамына эксперименталдык чарбалар, Кыргыз кант кызылчасы боюнча тажрыйба-селекциялык станциясы, Кыргыз пахта өстүрүү боюнча тажрыйба станциясы, Республикалык тоют тажрыйба станциясы, Ысык-Көл тажрыйба-селекциялык станциясы, Нарын жана Бүргөндү таяныч пункттары, 50 жылдык СССР атындагы үрөн чарбалары жана "Кугарт" кирген.',
        "history_foundation_more_2" =>
            "Институттун илимий тематикасы жана ар кандай кыртыштык-климаттык зоналардагы тажрыйба станциялары жана таяныч пункттары сугат жана кайрак дыйканчылык системаларынын илимий негиздерин, жогорку түшүмдүү сортторду, үрөнчүлүктү, комплексдүү механизацияны жана Кыргызстандын айыл чарба экономикасын изилдөөгө багытталган.",
        "history_achievements_title" => "Жетишкендиктер жана натыйжалар",
        "history_achievements_intro" =>
            "Бул жана башка тапшырмалар институттун, анын тажрыйба станцияларынын жана таяныч пункттарынын тыгыз макулдашылган колективи тарабынан ишке ашырылган:",
        "history_achievement_1" =>
            "Институтта 700 илимий-техникалык кызматкер иштеп, алардын ичинен 341 илимий кызматкер, 99 илимдин кандидаты жана доктору болгон.",
        "history_achievement_2" =>
            "Республикалык айыл чарба зоналары үчүн типтүү чарбаларды башкаруу боюнча сунуштар иштелип чыккан.",
        "history_achievement_3" =>
            "Илимий-өндүрүштүк иш 135 миң гектар жерди, анын ичинде 35 миң гектар айдоо аянтын, анын жарымына жакыны сугат аянтын камтыган.",
        "history_achievement_4" =>
            "Бакчалар жана жүзүмзарлар 1100 гектарды ээлеп, калган аянт чөп чабуучулар жана жайыттар болгон.",
        "history_achievement_5" =>
            "Тажрыйба станциялары жана үрөн чарбалары жыл сайын колхоздорго жана совхоздорго 80 миң центнерге жакын элита жана биринчи репродукциядагы үрөн өндүрүшчү.",
        "history_achievement_6" =>
            "Ошондой эле 5 миңден ашык центнер жүгөрү үрөнү, 6 миң центнер үрөндүк картошка, 2 миң центнер көп жылдык чөптөрдүн уругу, 400 центнер жашылча уругу жана 50-60 миң мөмө-жемиш жана жүзүм көчөттөрү өндүрүлгөн.",
        "maps_title" => "Кыргызстандын карталары",
        "maps_text" =>
            "Өсүмдүк түрлөрү, станция даректери жана түстүү легендасы бар интерактивдүү карта.",
        "maps_legend_title" => "Белгилөө",
        "maps_legend_beet" => "Кызылча",
        "maps_legend_grain" => "Дан өсүмдүктөрү",
        "maps_legend_cotton" => "Хлопок",
        "maps_legend_vegetables" => "Жашылча өсүмдүктөрү",
        "maps_legend_seed" => "Үрөнчүлүк",
        "maps_addresses_title" => "Даректер менен жайлар",
        "maps_address_1" =>
            "Чүй облусу, Прочность айылы, Спорттук 61 — Кант кызылчасы",
        "maps_address_2" =>
            "Ош облусу, Кара-Суу айылы, Большевик — Дан өсүмдүктөрү",
        "maps_address_3" => "Баткен облусу, Кызыл-Кыя айылы — Хлопок",
        "maps_address_4" =>
            "Жалал-Абад облусу, Тоҕуз-Торо айылы — Жашылча өсүмдүктөрү",
        "maps_address_5" => "Нарын облусу, Ленин 209 — Үрөнчүлүк",
        "maps_description_1" =>
            "Картада институттун негизги тажрыйба-сиелектоо пункттары белгиленген.",
        "maps_description_2" =>
            "Ар бир түстүн өзүнө таандык өсүмдүк түрү бар жана изилдөө багыттарын тез түшүнүүгө жардам берет.",
        "maps_info_placeholder" =>
            "Маалымат алуу үчүн картанын аймагын тандаңыз же курсорду багыттаңыз",
        "maps_info_title" => "Участок тууралуу маалымат",
        "maps_info_more" => "Участок тууралуу кененирээк",
        "maps_info_address_label" => "Дареги / Жайгашкан жери",
        "maps_info_crops_label" => "Негизги өсүмдүктөр",
        "maps_info_description_label" => "Сүрөттөлүшү жана изилдөөлөр",
        "maps_label_area" => "Аянт",
        "maps_label_crops" => "Эгиндер",
        "maps_label_activity" => "Ишмердүүлүк",
        "maps_label_location" => "Жайгашкан жери",
        "maps_label_director" => "Директор",
        "maps_label_contacts" => "Байланыштар",
        "maps_show_on_map" => "Картада көрсөтүү",
        "maps_area_label" => "Аянт",
        "maps_area_not_specified" => "маалыматтарда көрсөтүлгөн эмес",
        "maps_kml_error" => "Участок картасын жүктөө мүмкүн болгон жок.",
        "maps_land_fund_aria_label" => "КНИИЗ жер фонду картасы",
        "station_ioss_title" => "Ысык-Көл тажрыйба-сыелектоо станциясы",
        "station_ioss_area" => "102.0 га",
        "station_ioss_crops" =>
            "Картөшкө, мөмө-жемиш өсүмдүктөрү, дан өсүмдүктөрү жана мал азыктары",
        "station_ioss_activity" =>
            "Картөшкө үрөн өндүрүү, селекциялык жана өндүрүштүк сыноолор",
        "station_ioss_location" =>
            "Ысык-Көл облусу, Ак-Суу району, Челпек айылы",
        "station_ioss_director" => "Осмонов Дайырбек Турсунгазиевич",
        "station_jany_pachta_title" => "Жаны-Пахта үрөн чарбасы",
        "station_jany_pachta_area" => "482.0 га",
        "station_jany_pachta_crops" => "Буудай, арпа, жуңга жана башка эгиндер",
        "station_jany_pachta_activity" =>
            "Жогорку репродукциядагы эгиндердин үрөн өндүрүшү, айыл чарба",
        "station_jany_pachta_location" =>
            "Чүй облусу, Сокулук району, Жаны-Пахта айылы",
        "station_jany_pachta_director" => "Эргешов Арзымат Нурмаматович",
        "station_koss_title" =>
            "КЫСС кант кызылчасына арналган тажрыйба-сыелектоо станциясы",
        "station_koss_area" => "239.0 га",
        "station_koss_crops" => "Кант кызылчасы, дан жана мал азыктары",
        "station_koss_activity" =>
            "Баштапкы үрөн өндүрүшү, кант кызылчасы үрөн өндүрүшү",
        "station_koss_location" =>
            "Чүй облусу, Сокулук району, Первомайское айылы",
        "station_koss_director" => "Есеналиев Кубанычбек Дженишбекович",
        "station_atai_title" => "Атай үрөн чарбасы",
        "station_atai_area" => "125.8 га",
        "station_atai_crops" => "Жүгөрү, дан жана мал азыктары",
        "station_atai_activity" => "Үрөн чарбасы, элита үрөн өндүрүшү",
        "station_atai_location" =>
            "Жалал-Абад облусу, Тоңуз-Торо району, Атай айылы",
        "station_atai_director" => "Сакеев Жыргалбек Керимжанович",
        "back_to_map" => "Картага кайтуу",
        "plot_not_found" => "Участок табылган жок",
        "plot_not_found_desc" =>
            "Тилекке каршы, суралган тажрыйбалык-селекциялык участок табылган жок.",
        "agro_region_map" => "Аймактын талаа картасы",
        "agro_stats" => "Статистика",
        "agro_fields_count" => "Талаалар",
        "agro_total_ha" => "Аянты",
        "agro_search_fields" => "Талаа издөө...",
        "agro_filter_all" => "Бардык өсүмдүктөр",
        "agro_select_field" => "Картадан талаа тандаңыз",
        "agro_open_region_map" => "Талаа картасын ачуу",
        "agro_quick_regions" => "Тез өтүү",
        "agro_dblclick_hint" => "Эки жолу чыкылдатуу — аймак картасы",
        "agro_map_load_error" => "Аймак чектери жүктөлбөй калды",
        "agro_back_region_map" => "Аймак картасына",
        "agro_field_details" => "Талаа маалыматы",
        "agro_label_culture" => "Өсүмдүк",
        "agro_label_moisture" => "Нымдуулук",
        "agro_label_year" => "Жыл",
        "agro_label_yield" => "Түшүм",
        "agro_label_notes" => "Эскертме",
        "agro_crop_history" => "Жылдар боюнча тарых",
        "agro_no_history" => "Эгилген өсүмдүктөрдүн тарыхы жок",
        "agro_region_naryn" => "Нарын",
        "agro_region_issyk" => "Ысык-Көл",
        "agro_region_chuy" => "Чүй",
        "agro_region_osh" => "Ош",
        "agro_region_batken" => "Баткен",
        "agro_region_jalal" => "Жалал-Абад",
        "science_title" => "Илимий изилдөөлөр",
        "science_intro" =>
            "Институт төмөнкү багыттарда кеңири изилдөө жүргүзөт:",
        "science_direction_title" => "Негизги багыттар",
        "science_direction_1" =>
            "Селекция жана үрөн өнүктүрүү: Кыргызстандын шарттарына ылайык келүүчү жаңы сорттор",
        "science_direction_2" =>
            "Өсүмдүк өстүрүү: негизги эгиндерди өстүрүү технологияларын изилдөө",
        "science_direction_3" =>
            "Топурак таануу: топурак мүнөздөмөлөрүн изилдөө жана түзүмдүүлүктү жогорулатуу ыкмалары",
        "science_direction_4" =>
            "Өсүмдүктөрдү коргоо: зыянкечтер менен ооруларга каршы ыкмалар",
        "science_direction_5" =>
            "Агрономия: дыйканчылык технологиялары жана чарба практикаларын изилдөө",
        "science_publications_title" => "Публикациялар жана иштеп чыгуулар",
        "science_publications_text" =>
            "Илимий изилдөөлөрдүн натыйжалары улуттук жана эл аралык журналдарда жарыяланат жана айыл чарбасында колдонулат.",
        "products_title" => "Өнүмдөр жана кызматтар",
        "products_text" =>
            "Институт айыл чарба ишканалары жана дыйкандар үчүн өнүмдөрдү жана кызматтарды сунуштайт:",
        "products_main_title" => "Негизги өнүмдөр",
        "products_item_1_title" => "Үрөндөр жана отургузуучу материал",
        "products_item_1_text" =>
            "Ар кандай топурак-климаттык шарттар үчүн жогорку сапаттуу эгин сорттору.",
        "products_item_2_title" => "Технологиялык чечимдер",
        "products_item_2_text" =>
            "Негизги эгиндерди өстүрүү боюнча сыноодон өткөн технологиялар.",
        "products_item_3_title" => "Агрохимиялык сунуштар",
        "products_item_3_text" =>
            "Убаделер жана өсүмдүктөрдү коргоо каражаттарын колдонуу боюнча сунуштар.",
        "products_item_4_title" => "Консультациялык кызматтар",
        "products_item_4_text" =>
            "Айыл чарба өндүрүшүнө байланыштуу эксперттик консультация.",
        "news_title" => "Билдирүүлөр",
        "news_intro" => "Институтдин акыркы жаңылыктары жана окуялары:",
        "news_category_default" => "Жаңылыктар",
        "news_empty" => "Азырынча жаңылык жок.",
        "news_more" => "Толугураак",
        "photo_alt" => "Сүрөт",
        "news_article_1_title" => "Институт жаңы буудай сортун иштеп чыкты",
        "news_article_1_date" => "Жарыяланган: 2024-05-11",
        "news_article_1_text" =>
            "Институт Кыргыз тоолуу аймактардын шарттарына ылайыкталган жаңы жогорку түшүмдүү буудай сортун тартуулайт...",
        "news_article_2_title" =>
            "Айыл чарба илимдери боюнча эл аралык конференция",
        "news_article_2_date" => "Жарыяланган: 2024-05-05",
        "news_article_2_text" =>
            "Институт өсүмдүк өстүрүү жаатындагы акыркы өнүгүүлөрдү сунуштаган эл аралык конференцияга катышты...",
        "news_article_3_title" =>
            "Чет өлкөлүк уюмдар менен өнөктөштүктү кеңейтүү",
        "news_article_3_date" => "Жарыяланган: 2024-04-28",
        "news_article_3_text" =>
            "Институт бир нече алдыңкы илимий борборлор менен кызматташууну бекитти...",
        "gallery_title" => "Галерея",
        "gallery_text" =>
            "Институтдин иш-чараларынын, изилдөөлөрүнүн жана объекттеринин сүрөттөрү.",
        "contacts_title" => "Контакттар",
        "contacts_text" =>
            "К.К. Aзыкoв атындагы Кыргыз дыйканчылык илим изилдөө институту менен изилдөө, өнүмдөр жана кызматташуу боюнча байланышкыла.",
        "contacts_address_title" => "Биздин дарек",
        "contacts_address_text" =>
            "К.К. Азыкoв атындагы Кыргыз дыйканчылык илим изилдөө институту, Бишкек, Кыргыз Республикаһы",
        "contacts_address_label" => "Дарек",
        "contacts_address_value" =>
            "Кыргыз Республикасы, Бишкек ш., Тимур Фрунзе көч. 100/1",
        "contacts_address_link" =>
            "https://2gis.kg/bishkek/firm/70000001021237453",
        "contacts_phone" => "Телефон: +996 (312) XX-XX-XX",
        "contacts_phone_label" => "Тел",
        "contacts_phone_value" => "0(312) 41 71 54",
        "contacts_fax" => "Факс: +996 (312) XX-XX-XX",
        "contacts_fax_label" => "Факс",
        "contacts_fax_value" => "0(312) 41 79 08",
        "contacts_email" => "Email: info@kniiz.kg",
        "contacts_email_label_text" => "Email",
        "contacts_email_value" => "nauca.zemledel@gmail.com",
        "contacts_website" => "Веб-сайт: www.kniiz.kg",
        "contacts_work_title" => "Иш убактысы",
        "contacts_work_week" => "Дш-Жш: 09:00 - 18:00",
        "contacts_work_weekend" => "Иш-Жк: Жабык",
        "contacts_workhours_label" => "Иш графиги",
        "contacts_workhours_value" => "Дүйшөмбү – Жума: 9:00 – 18:00",
        "contacts_form_title" => "Кайчылаш байланыш формасы",
        "contacts_name" => "Аты-жөнү",
        "contacts_email_label" => "Email",
        "contacts_message" => "Кабар",
        "contacts_send" => "Жөнөтүү",
        "contacts_social_title" => "Социалдык тармактар",
        "contacts_form_success" =>
            "Сиздин билдирүү кабыл алынды. Биз жакынки сиз менен байланышыбыз.",
        "contacts_form_success_title" => "Билдирүү жөнөтүлдү!",
        "contacts_form_validation_title" => "Форманы текшериңиз",
        "contacts_form_error" => "Бардык маалыматтарды толтуруңуз.",
        "form_err_name" => "Атыңызды жазыңыз",
        "form_err_email" => "Туура email жазыңыз",
        "form_err_message" => "Хабарыңызды жазыңыз",
        "feedback_email_subject" => "Институт сайтынан билдирүү",
        "footer_about_title" => "Институт жөнүндө",
        "footer_about_line1" =>
            "К.К. Азыкoв атындагы Кыргыз дыйканчылык илим изилдөө институту.",
        "footer_about_line2" =>
            "Кыргызстандын айыл чарбасын өнүктүрүү жана азык-түлүк коопсуздугу.",
        "footer_contacts_title" => "Контакттар",
        "footer_menu_title" => "Меню",
        "footer_copyright" => "© 2026 Институт. Бардык укуктар корголгон.",
        "footer_menu_home" => "Башкы бет",
        "footer_menu_history" => "Тарых",
        "footer_menu_maps" => "Карталар",
        "footer_menu_science" => "Илим",
        "footer_menu_products" => "Өнүмдөр",
        "lang_switcher_label" => "Тил",
        "nav_media" => "Медиа",
        "nav_administration" => "Администрация",
        "admin_subtitle" =>
            "Институтдин жетекчилиги, бөлүм башчылары жана филиал директорлору",
        "admin_section_leadership" => "Жетекчилик",
        "admin_role_director" => "Директор",
        "admin_role_deputy" => "Директордун орун басары",
        "admin_role_secretary" => "Илимий катчы",
        "admin_section_departments" => "Институттун бөлүм башчылары",
        "admin_section_departments_note" => "бөлүм башчылары гана",
        "admin_section_branches" => "Филиалдардын жетекчилери",
        "admin_section_branches_note" => "бул бөлүмдө директорлор гана",
        "admin_head_wheat" => "Буудай бөлүмүнүн башчысы",
        "admin_head_barley" => "Арпа бөлүмүнүн башчысы",
        "admin_head_corn" => "Жүгөрү бөлүмүнүн башчысы",
        "admin_head_sugarbeet" => "Кант кызылчасы бөлүмүнүн башчысы",
        "admin_head_fruit_veg" => "Жемиш-жашылча бөлүмүнүн башчысы",
        "admin_head_soil" => "Топурак таануу бөлүмүнүн башчысы",
        "admin_head_agrochemistry" => "Агрохимия бөлүмүнүн башчысы",
        "nav_documents" => "Документтер",
        "nav_international" => "Эл аралык кызматташуу",
        "docs_page_subtitle" =>
            "Институтдин расмий документтери жана маалыматтык материалдары",
        "docs_cat_polozhenie" => "Жобо",
        "docs_cat_postanovlenie" => "Токтом",
        "docs_polozhenie_file_1" =>
            "Жобо Кыргыз дыйканчылык илимий-изилдөө институту жөнүндө 11.11.25 жыл",
        "docs_polozhenie_file_2" =>
            "Положение о Кыргызском научно-исследовательском институте земледелия от 11.11.25 г.",
        "docs_postanovlenie_file_1" => "Постановление Институт переименование",
        "docs_postanovlenie_file_2" => "Токтом Институт переименование",
        "docs_empty" => "Бул бөлүмдөгү документтер жакында кошулат.",
        "docs_download" => "PDF жүктөп алуу",
        "docs_open" => "PDF ачуу",
        "docs_view" => "Окуу",
        "docs_viewer_title" => "Документти көрүү",
        "docs_viewer_close" => "Жабуу",
        "meta_desc_home" =>
            "К.К. Азыков атындагы Кыргыз дыйканчылык илим-изилдөө институту — Кыргызстандын селекция, үрөнчүлүк жана агрохимия боюнча жетектөөчү илимий мекемеси.",
        "meta_keys_home" =>
            "КНИИЗ, Кыргыз дыйканчылык институту, селекция, үрөнчүлүк, агрохимия, Кыргызстан",
        "meta_desc_news" =>
            "Кыргыз дыйканчылык илим-изилдөө институтунун акыркы жаңылыктары жана окуялары.",
        "meta_keys_news" =>
            "КНИИЗ жаңылыктары, институт окуялары, айыл чарба жаңылыктары Кыргызстан",
        "meta_desc_history" =>
            "1956-жылдан берки Кыргыз дыйканчылык илим-изилдөө институтунун тарыхы.",
        "meta_keys_history" =>
            "КНИИЗ тарыхы, институт тарыхы, 1956, Кыргызстан",
        "meta_desc_maps" =>
            "Кыргызстан боюнча КНИИЗ тажрыйба-сиелектоо станцияларынын интерактивдүү карталары.",
        "meta_keys_maps" =>
            "КНИИЗ картасы, тажрыйба станциялары, Кыргызстан, айыл чарба жерлери",
        "meta_desc_science" =>
            "КНИИЗ илимий-изилдөө бөлүмдөрү: буудай, арпа, жүгөрү, кант кызылчасы, топурак таануу, агрохимия.",
        "meta_keys_science" =>
            "КНИИЗ илимий бөлүмдөрү, буудай, арпа, жүгөрү, кант кызылчасы, топурак таануу",
        "meta_desc_administration" =>
            "Кыргыз дыйканчылык илим-изилдөө институтунун жетекчилиги жана илимий курамы.",
        "meta_keys_administration" =>
            "КНИИЗ жетекчилиги, администрация, кызматкерлер, илимпоздор",
        "meta_desc_documents" =>
            "Кыргыз дыйканчылык илим-изилдөө институтунун расмий документтери жана ченемдик актылары.",
        "meta_keys_documents" =>
            "КНИИЗ документтери, жобо, токтом, расмий документтер",
        "meta_desc_gallery" =>
            "КНИИЗ иш-чараларынын, изилдөөлөрүнүн жана объекттеринин фотогалереясы.",
        "meta_keys_gallery" =>
            "КНИИЗ галереясы, сүрөттөр, институт иш-чаралары",
        "meta_desc_contacts" =>
            "Кыргыз дыйканчылык илим-изилдөө институтунун байланыш маалыматы — дарек, телефон, email.",
        "meta_keys_contacts" => "КНИИЗ байланыштары, дарек, телефон, Бишкек",
        "meta_desc_katalog" =>
            "КНИИЗ тарабынан иштелип чыккан айыл чарба сортторунун каталогу: буудай, арпа, жүгөрү жана башкалар.",
        "meta_keys_katalog" =>
            "сорттор каталогу, буудай сорттору, арпа сорттору, жүгөрү сорттору, КНИИЗ",
        "meta_desc_international" =>
            "КНИИЗ менен чет өлкөлүк илимий уюмдар менен эл аралык кызматташтыгы.",
        "meta_keys_international" =>
            "КНИИЗ эл аралык кызматташуу, эл аралык долбоорлор, айыл чарба илими",
    ],
];

// --- Admin overrides (database/lang_overrides.json) ---
// Позволяет менять тексты всех страниц из админки без правки кода.
// Формат:
// {
//   "ru": { "key": "value", ... },
//   "en": { "key": "value", ... },
//   "ky": { "key": "value", ... }
// }
$__langOverridesFile = __DIR__ . "/../database/lang_overrides.json";
if (is_file($__langOverridesFile)) {
    $overridesRaw = file_get_contents($__langOverridesFile);
    $overrides = json_decode($overridesRaw, true);
    if (is_array($overrides)) {
        foreach (["ru", "en", "ky"] as $lc) {
            if (!empty($overrides[$lc]) && is_array($overrides[$lc])) {
                $_lang[$lc] = array_merge($_lang[$lc] ?? [], $overrides[$lc]);
            }
        }
    }
}

function t($key, $default = "")
{
    global $_lang, $currentLang;
    if (isset($_lang[$currentLang][$key])) {
        return $_lang[$currentLang][$key];
    }

    // Если нет перевода на текущем языке — используем русский, но фиксируем "пропуск",
    // чтобы можно было доперевести через админку.
    if (isset($_lang["ru"][$key])) {
        _logMissingTranslation($currentLang, $key);
        return $_lang["ru"][$key];
    }

    _logMissingTranslation("ru", $key);
    return $default;
}

function _logMissingTranslation($lang, $key)
{
    // Стараемся не раздувать файл логов: пишем только новые ключи.
    $file = __DIR__ . "/../database/lang_missing.json";
    $data = [];
    if (is_file($file)) {
        $raw = file_get_contents($file);
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $data = $decoded;
        }
    }
    if (!isset($data[$lang])) {
        $data[$lang] = [];
    }
    if (!in_array($key, $data[$lang], true)) {
        $data[$lang][] = $key;
        file_put_contents(
            $file,
            json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
        );
    }
}

function langUrl($langCode)
{
    $url = $_SERVER["REQUEST_URI"];
    $parts = parse_url($url);
    $query = [];
    if (!empty($parts["query"])) {
        parse_str($parts["query"], $query);
    }
    $query["lang"] = $langCode;
    $newQuery = http_build_query($query);
    return ($parts["path"] ?? "") . "?" . $newQuery;
}

function currentLang()
{
    global $currentLang;
    return $currentLang;
}

function getLanguages()
{
    global $availableLangs;
    return $availableLangs;
}
