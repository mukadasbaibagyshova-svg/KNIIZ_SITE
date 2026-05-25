-- Тестовые данные (после schema.sql)

INSERT INTO regions (slug, iso_code, name_ru, name_ky, name_en, center_lat, center_lng, default_zoom, color) VALUES
('naryn', 'KG-N', 'Нарынская область', 'Нарын облусу', 'Naryn Region', 41.4280000, 75.9910000, 10, '#4ea8de'),
('issyk_kul', 'KG-Y', 'Иссык-Кульская область', 'Ысык-Көл облусу', 'Issyk-Kul Region', 42.4900000, 78.3900000, 10, '#1e5e3a'),
('chuy', 'KG-C', 'Чуйская область', 'Чүй облусу', 'Chuy Region', 42.8700000, 74.5900000, 10, '#2a9d8f'),
('osh', 'KG-O', 'Ошская область', 'Ош облусу', 'Osh Region', 40.5300000, 72.8000000, 10, '#e76f51'),
('batken', 'KG-B', 'Баткенская область', 'Баткен облусу', 'Batken Region', 39.7500000, 71.0000000, 10, '#e9c46a'),
('jalal_abad', 'KG-J', 'Джалал-Абадская область', 'Жалал-Абад облусу', 'Jalal-Abad Region', 41.2500000, 73.2500000, 10, '#f4a261'),
('talas', 'KG-T', 'Таласская область', 'Талас облусу', 'Talas Region', 42.5200000, 72.2400000, 10, '#8ab17d')
ON DUPLICATE KEY UPDATE name_ru = VALUES(name_ru);

INSERT INTO enterprises (id, num, region_id, slug, type_key, color, name_ru, name_ky, name_en, address_ru, address_ky, address_en, activity_ru, activity_ky, activity_en, hectares, director_ru, director_ky, director_en, phone, map_x, map_y) VALUES
(1, 1, (SELECT id FROM regions WHERE slug = 'chuy'), 'sugar_beet_station', 'beet', '#2a9d8f', 'ГП Кыргызская опытно-селекционная станция по сахарной свекле', 'ГКК Кант кызылчасы боюнча Кыргыз тажрыйба-селекциялык станциясы', 'SE Kyrgyz Sugar Beet Experimental Breeding Station', '722115, Чуйская область, Сокулукский район, с. Первомайское, ул. Спортивная, 61', '722115, Чүй облусу, Сокулук району, Первомайское а., Спортивная көч., 61', '722115, Chuy region, Sokuluk district, Pervomayskoe village, Sportivnaya str., 61', 'Первичное семеноводство, производство семян сахарной свеклы и других культур высшей репродукции', 'Биринчилик үрөнчүлүк, кант кызылчасынын жана башка жогорку репродукциядагы өсүмдүктөрдүн үрөнүн өндүрүү', 'Primary seed production, sugar beet seeds and other crops of higher reproduction', 147.00, 'Есеналиев Кубанычбек Дженишбекович', 'Есеналиев Кубанычбек Дженишбекович', 'Esenaliev Kubanychbek Jenisbekovich', '0553 730 335', 312, 42),
(2, 2, (SELECT id FROM regions WHERE slug = 'chuy'), 'jany_pakhta', 'seed', '#4ea8de', 'ГП Семеноводческое хозяйство «Жаны-Пахта»', 'ГКК «Жаңы-Пахта» үрөнчүлүк чарбасы', 'SE Seed Farm Jany-Pakhta', '722110, Чуйская область, Сокулукский район, с. Жаны-Пахта, ул. Юбилейная, 10', '722110, Чүй облусу, Сокулук району, Жаны-Пахта а., Юбилейная көч., 10', '722110, Chuy region, Sokuluk district, Jany-Pakhta village, Yubileynaya str., 10', 'Семеноводство сельхозкультур высших репродукций, земледелие', 'Айыл чарба өсүмдүктөрүнүн жогорку репродукциядагы үрөнчүлүгү, дыйканчылык', 'Seed production of high reproduction agricultural crops, farming', 482.00, 'Эргешов Арзымат Нурмаматович', 'Эргешов Арзымат Нурмаматович', 'Ergeshov Arzymat Nurmamatovich', '0705 619 915', 328, 48),
(3, 3, (SELECT id FROM regions WHERE slug = 'osh'), 'cotton_station', 'cotton', '#3b82f6', 'ГП Кыргызская опытная станция по хлопководству', 'ГКК Пахтачылык боюнча Кыргыз тажрыйба станциясы', 'SE Kyrgyz Cotton Growing Experimental Station', '715511, Ошская область, Кара-Суйский район, с. Большевик, ул. Черткова, 2', '715511, Ош облусу, Кара-Суу району, Большевик а., Чертков көч., 2', '715511, Osh region, Kara-Suu district, Bolshevik village, Chertkov str., 2', 'Первичное семеноводство хлопчатника и зерновых культур, производство семян перспективных сельхозкультур', 'Пахта жана дан өсүмдүктөрүнүн биринчилик үрөнчүлүгү, келечектүү айыл чарба өсүмдүктөрүнүн үрөндөрүн өндүрүү', 'Primary cotton and grain seed production, production of promising crops seeds', 286.00, 'Ырысов Абдиашим Толонович', 'Ырысов Абдиашим Толонович', 'Yrysov Abdiashim Tolonovich', '0556 140 660', 198, 218),
(4, 4, (SELECT id FROM regions WHERE slug = 'issyk_kul'), 'issyk_kul_station', 'potato', '#8b5a2b', 'ГП Иссык-Кульская опытно-селекционная станция', 'ГКК Ысык-Көл тажрыйба-селекциялык станциясы', 'SE Issyk-Kul Experimental Breeding Station', '722200, Иссык-Кульская область, Ак-Суйский район, с. Челпек', '722200, Ысык-Көл облусу, Ак-Суу району, Челпек а.', '722200, Issyk-Kul region, Ak-Suu district, Chelpek village', 'Семеноводство картофеля, производство сельхозкультур, земледелие', 'Картошка үрөнчүлүгү, айыл чарба өсүмдүктөрүн өндүрүү, дыйканчылык', 'Potato seed production, crop production, farming', 102.00, 'Осмонов Дайырбек Турсунгазиевич', 'Осмонов Дайырбек Турсунгазиевич', 'Osmonov Daiyrbek Tursungazievich', '0709 650 412', 612, 72),
(5, 5, (SELECT id FROM regions WHERE slug = 'naryn'), 'naryn_station', 'seed', '#4ea8de', 'ГУ Нарынская опытная станция', 'МК Нарын тажрыйба станциясы', 'SI Naryn Experimental Station', '722600, Нарын область, г. Нарын, ул. Ленина, 290, кв. 2', '722600, Нарын облусу, Нарын ш., Ленин көч., 290, 2-батир', '722600, Naryn region, Naryn city, Lenin str., 290, apt. 2', 'Внедрение, пропаганда и распространение высокопродуктивных сортов сельхозкультур, передовых технологий их возделывания, земледелие', 'Айыл чарба өсүмдүктөрүнүн жогорку өндүрүмдүү сортторун, аларды өстүрүүнүн алдыңкы технологияларын ишке киргизүү, жайылтуу, дыйканчылык', 'Implementation, promotion and distribution of high-yielding crop varieties, advanced cultivation technologies, farming', 31.09, 'Эралиева Асел Муканбетовна', 'Эралиева Асел Муканбетовна', 'Eralieva Asel Mukanbetovna', '0700 052 309', 468, 168),
(6, 6, (SELECT id FROM regions WHERE slug = 'batken'), 'burgandy_station', 'horticulture', '#f4a261', 'ГП Бургандинский опорный пункт', 'ГКК Бурганды таяныч пункту', 'SE Burgandy Support Point', '713330, Баткенская область, Кадамжайский район, с. Кыргыз Кыштак, ул. Эгемберди Ата, 3', '713330, Баткен облусу, Кадамжай району, Кыргыз-Кыштак а., Эгемберди Ата көч., 3', '713330, Batken region, Kadamjay district, Kyrgyz-Kyshtak village, Egemberdi Ata str., 3', 'Производство плодовых, косточковых культур и винограда', 'Мөмө-жемиш жана жүзүм өндүрүү', 'Production of fruit, stone fruit crops and grapes', 24.95, 'Юзбаев Бахтияр Абдыхалилович', 'Юзбаев Бахтияр Абдыхалилович', 'Yuzbaev Bakhtiyar Abdykhalilovich', '0507 379 188', 88, 298),
(7, 7, (SELECT id FROM regions WHERE slug = 'jalal_abad'), 'atai_station', 'seed', '#4ea8de', 'ГУ Семеноводческое хозяйство «Атай»', 'МК «Атай» үрөнчүлүк чарбасы', 'SI Seed Farm Atai', '721502, Жалал-Абадская область, Тогуз-Тороуский район, с. Атай, ул. Маметова', '721502, Жалал-Абад облусу, Тогуз-Торо району, Атай а., Маметов көч.', '721502, Jalal-Abad region, Toguz-Toro district, Atai village, Mametov str.', 'Семеноводческое хозяйство', 'Үрөнчүлүк чарбасы', 'Seed production farm', 125.80, 'Сакеев Жыргалбек Керимжанович', 'Сакеев Жыргалбек Керимжанович', 'Sakeev Zhyrgalbek Kerimzhanovich', '0706 341 145', 278, 192),
(8, 8, (SELECT id FROM regions WHERE slug = 'osh'), 'ak_altyn_station', 'seed', '#c9a227', 'ГП Семеноводческое хозяйство «Ак-Алтын»', 'ГКК «Ак-Алтын» үрөнчүлүк чарбасы', 'SE Seed Farm Ak-Altyn', 'Ошская область, Кара-Суйский район, Кашкар Кыштак а/о, с. Кенжегул', 'Ош облусу, Кара-Суу району, Кашкар-Кыштак а.а., Кенжегул а.', 'Osh region, Kara-Suu district, Kashkar-Kyshtak a.o., Kenzhegul village', 'Семеноводческое хозяйство', 'Үрөнчүлүк чарбасы', 'Seed production farm', 57.00, 'Усобаев Акылбек Сатыбалдыевич', 'Усобаев Акылбек Сатыбалдыевич', 'Usobaev Akylbek Satybaldyevich', '0550 170 164', 168, 248)
ON DUPLICATE KEY UPDATE name_ru = VALUES(name_ru);

-- Поля: Нарын (ГУ Нарынская опытная станция, ID: 5)
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(1, (SELECT id FROM regions WHERE slug = 'naryn'), 5, 'Поле №11', 'Пшеница', 'wheat', 6.40, 2025, 28.00, 'good', '[[41.430,75.990],[41.438,75.990],[41.438,76.002],[41.430,76.002]]'),
(2, (SELECT id FROM regions WHERE slug = 'naryn'), 5, 'Поле №12', 'Пшеница', 'wheat', 7.20, 2025, 31.00, 'attention', '[[41.455,75.990],[41.463,75.990],[41.463,76.002],[41.455,76.002]]'),
(3, (SELECT id FROM regions WHERE slug = 'naryn'), 5, 'Поле №13', 'Картофель', 'potato', 5.10, 2025, 35.00, 'good', '[[41.440,76.010],[41.448,76.010],[41.448,76.022],[41.440,76.022]]'),
(4, (SELECT id FROM regions WHERE slug = 'naryn'), 5, 'Поле №14', 'Ячмень', 'barley', 4.80, 2025, 26.00, 'good', '[[41.465,76.010],[41.473,76.010],[41.473,76.022],[41.465,76.022]]');

-- Поля: Иссык-Куль (ГП Иссык-Кульская опытно-селекционная станция, ID: 4)
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(5, (SELECT id FROM regions WHERE slug = 'issyk_kul'), 4, 'Блок А', 'Пшеница', 'wheat', 8.00, 2025, 29.00, 'good', '[[42.490,78.390],[42.498,78.390],[42.498,78.402],[42.490,78.402]]'),
(6, (SELECT id FROM regions WHERE slug = 'issyk_kul'), 4, 'Блок B', 'Овощи', 'vegetables', 3.50, 2025, 33.00, 'good', '[[42.515,78.390],[42.523,78.390],[42.523,78.402],[42.515,78.402]]'),
(7, (SELECT id FROM regions WHERE slug = 'issyk_kul'), 4, 'Блок C', 'Ячмень', 'barley', 6.20, 2025, 27.00, 'good', '[[42.500,78.410],[42.508,78.410],[42.508,78.422],[42.500,78.422]]'),
(8, (SELECT id FROM regions WHERE slug = 'issyk_kul'), 4, 'Блок D', 'Кукуруза', 'corn', 5.50, 2025, 30.00, 'attention', '[[42.525,78.410],[42.533,78.410],[42.533,78.422],[42.525,78.422]]');

-- Поля: Чуй (ГП Опытно-селекционная станция по сахарной свекле (ID: 1) и Жаны-Пахта (ID: 2))
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(9, (SELECT id FROM regions WHERE slug = 'chuy'), 1, 'Участок С-1 (Свекла)', 'Сахарная свекла', 'beet', 9.10, 2025, 32.00, 'good', '[[42.870,74.590],[42.878,74.590],[42.878,74.602],[42.870,74.602]]'),
(10, (SELECT id FROM regions WHERE slug = 'chuy'), 1, 'Участок С-2 (Свекла)', 'Сахарная свекла', 'beet', 7.80, 2025, 30.00, 'good', '[[42.895,74.590],[42.903,74.590],[42.903,74.602],[42.895,74.602]]'),
(11, (SELECT id FROM regions WHERE slug = 'chuy'), 2, 'Участок ЖП-1 (Пшеница)', 'Пшеница', 'wheat', 6.50, 2025, 28.00, 'good', '[[42.880,74.610],[42.888,74.610],[42.888,74.622],[42.880,74.622]]'),
(12, (SELECT id FROM regions WHERE slug = 'chuy'), 2, 'Участок ЖП-2 (Ячмень)', 'Ячмень', 'barley', 4.20, 2025, 25.00, 'good', '[[42.905,74.610],[42.913,74.610],[42.913,74.622],[42.905,74.622]]');

-- Поля: Ош (ГП Опытная станция по хлопководству (ID: 3) и Ак-Алтын (ID: 8))
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(13, (SELECT id FROM regions WHERE slug = 'osh'), 3, 'Кара-Суу Х-1', 'Хлопок', 'cotton', 10.20, 2025, 24.00, 'good', '[[40.530,72.800],[40.538,72.800],[40.538,72.812],[40.530,72.812]]'),
(14, (SELECT id FROM regions WHERE slug = 'osh'), 3, 'Кара-Суу Х-2', 'Хлопок', 'cotton', 8.70, 2025, 22.00, 'good', '[[40.555,72.800],[40.563,72.800],[40.563,72.812],[40.555,72.812]]'),
(15, (SELECT id FROM regions WHERE slug = 'osh'), 8, 'Кара-Суу АА-1', 'Пшеница', 'wheat', 6.00, 2025, 26.00, 'attention', '[[40.540,72.820],[40.548,72.820],[40.548,72.832],[40.540,72.832]]'),
(16, (SELECT id FROM regions WHERE slug = 'osh'), 8, 'Кара-Суу АА-2', 'Ячмень', 'barley', 5.30, 2025, 23.00, 'good', '[[40.565,72.820],[40.573,72.820],[40.573,72.832],[40.565,72.832]]');

-- Поля: Баткен (ГП Бургандинский опорный пункт, ID: 6)
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(17, (SELECT id FROM regions WHERE slug = 'batken'), 6, 'Хлопок-1', 'Хлопок', 'cotton', 12.00, 2025, 18.00, 'good', '[[39.750,71.000],[39.758,71.000],[39.758,71.012],[39.750,71.012]]'),
(18, (SELECT id FROM regions WHERE slug = 'batken'), 6, 'Хлопок-2', 'Хлопок', 'cotton', 9.50, 2025, 20.00, 'good', '[[39.775,71.000],[39.783,71.000],[39.783,71.012],[39.775,71.012]]'),
(19, (SELECT id FROM regions WHERE slug = 'batken'), 6, 'Хлопок-3', 'Хлопок', 'cotton', 7.80, 2025, 19.00, 'attention', '[[39.760,71.020],[39.768,71.020],[39.768,71.032],[39.760,71.032]]');

-- Поля: Джалал-Абад (ГУ Семеноводческое хозяйство «Атай», ID: 7)
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(20, (SELECT id FROM regions WHERE slug = 'jalal_abad'), 7, 'Тогуз-Торо 1', 'Овощи', 'vegetables', 4.50, 2025, 34.00, 'good', '[[41.250,73.250],[41.258,73.250],[41.258,73.262],[41.250,73.262]]'),
(21, (SELECT id FROM regions WHERE slug = 'jalal_abad'), 7, 'Тогуз-Торо 2', 'Томаты', 'vegetables', 3.20, 2025, 36.00, 'good', '[[41.275,73.250],[41.283,73.250],[41.283,73.262],[41.275,73.262]]'),
(22, (SELECT id FROM regions WHERE slug = 'jalal_abad'), 7, 'Тогуз-Торо 3', 'Кукуруза', 'corn', 5.80, 2025, 31.00, 'good', '[[41.260,73.270],[41.268,73.270],[41.268,73.282],[41.260,73.282]]');

-- Поля: Талас (Региональные поля без конкретного предприятия, ID: NULL)
INSERT INTO fields (id, region_id, enterprise_id, name, culture, culture_key, hectares, year, moisture, status, coordinates) VALUES
(23, (SELECT id FROM regions WHERE slug = 'talas'), NULL, 'Фасоль-1', 'Фасоль', 'legumes', 5.00, 2025, 27.00, 'good', '[[42.520,72.240],[42.528,72.240],[42.528,72.252],[42.520,72.252]]'),
(24, (SELECT id FROM regions WHERE slug = 'talas'), NULL, 'Фасоль-2', 'Горох', 'legumes', 4.40, 2025, 29.00, 'good', '[[42.545,72.240],[42.553,72.240],[42.553,72.252],[42.545,72.252]]'),
(25, (SELECT id FROM regions WHERE slug = 'talas'), NULL, 'Фасоль-3', 'Пшеница', 'wheat', 6.10, 2025, 26.00, 'good', '[[42.530,72.260],[42.538,72.260],[42.538,72.272],[42.530,72.272]]');


-- Истории культур
INSERT INTO field_crop_history (field_id, year, culture, culture_key, yield_tons, notes) VALUES
(1, 2023, 'Ячмень', 'barley', 18.20, ''),
(1, 2024, 'Пшеница', 'wheat', 22.50, ''),
(1, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(2, 2023, 'Ячмень', 'barley', 18.20, ''),
(2, 2024, 'Пшеница', 'wheat', 22.50, ''),
(2, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(3, 2023, '—', 'other', NULL, 'Пар'),
(3, 2024, '—', 'other', NULL, ''),
(3, 2025, 'Картофель', 'potato', NULL, 'Текущий сезон'),
(4, 2023, '—', 'other', NULL, 'Пар'),
(4, 2024, '—', 'other', NULL, ''),
(4, 2025, 'Ячмень', 'barley', NULL, 'Текущий сезон'),
(5, 2023, 'Ячмень', 'barley', 18.20, ''),
(5, 2024, 'Пшеница', 'wheat', 22.50, ''),
(5, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(6, 2023, '—', 'other', NULL, 'Пар'),
(6, 2024, '—', 'other', NULL, ''),
(6, 2025, 'Овощи', 'vegetables', NULL, 'Текущий сезон'),
(7, 2023, '—', 'other', NULL, 'Пар'),
(7, 2024, '—', 'other', NULL, ''),
(7, 2025, 'Ячмень', 'barley', NULL, 'Текущий сезон'),
(8, 2023, '—', 'other', NULL, 'Пар'),
(8, 2024, '—', 'other', NULL, ''),
(8, 2025, 'Кукуруза', 'corn', NULL, 'Текущий сезон'),
(9, 2023, '—', 'other', NULL, 'Пар'),
(9, 2024, '—', 'other', NULL, ''),
(9, 2025, 'Сахарная свекла', 'beet', NULL, 'Текущий сезон'),
(10, 2023, '—', 'other', NULL, 'Пар'),
(10, 2024, '—', 'other', NULL, ''),
(10, 2025, 'Сахарная свекла', 'beet', NULL, 'Текущий сезон'),
(11, 2023, 'Ячмень', 'barley', 18.20, ''),
(11, 2024, 'Пшеница', 'wheat', 22.50, ''),
(11, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(12, 2023, '—', 'other', NULL, 'Пар'),
(12, 2024, '—', 'other', NULL, ''),
(12, 2025, 'Ячмень', 'barley', NULL, 'Текущий сезон'),
(13, 2023, 'Ячмень', 'barley', 18.20, ''),
(13, 2024, 'Пшеница', 'wheat', 22.50, ''),
(13, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(14, 2023, 'Ячмень', 'barley', 18.20, ''),
(14, 2024, 'Пшеница', 'wheat', 22.50, ''),
(14, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон'),
(15, 2023, '—', 'other', NULL, 'Пар'),
(15, 2024, '—', 'other', NULL, ''),
(15, 2025, 'Кукуруза', 'corn', NULL, 'Текущий сезон'),
(16, 2023, '—', 'other', NULL, 'Пар'),
(16, 2024, '—', 'other', NULL, ''),
(16, 2025, 'Ячмень', 'barley', NULL, 'Текущий сезон'),
(17, 2023, '—', 'other', NULL, 'Пар'),
(17, 2024, '—', 'other', NULL, ''),
(17, 2025, 'Хлопок', 'cotton', NULL, 'Текущий сезон'),
(18, 2023, '—', 'other', NULL, 'Пар'),
(18, 2024, '—', 'other', NULL, ''),
(18, 2025, 'Хлопок', 'cotton', NULL, 'Текущий сезон'),
(19, 2023, '—', 'other', NULL, 'Пар'),
(19, 2024, '—', 'other', NULL, ''),
(19, 2025, 'Хлопок', 'cotton', NULL, 'Текущий сезон'),
(20, 2023, '—', 'other', NULL, 'Пар'),
(20, 2024, '—', 'other', NULL, ''),
(20, 2025, 'Овощи', 'vegetables', NULL, 'Текущий сезон'),
(21, 2023, '—', 'other', NULL, 'Пар'),
(21, 2024, '—', 'other', NULL, ''),
(21, 2025, 'Томаты', 'vegetables', NULL, 'Текущий сезон'),
(22, 2023, '—', 'other', NULL, 'Пар'),
(22, 2024, '—', 'other', NULL, ''),
(22, 2025, 'Кукуруза', 'corn', NULL, 'Текущий сезон'),
(23, 2023, '—', 'other', NULL, 'Пар'),
(23, 2024, '—', 'other', NULL, ''),
(23, 2025, 'Фасоль', 'legumes', NULL, 'Текущий сезон'),
(24, 2023, '—', 'other', NULL, 'Пар'),
(24, 2024, '—', 'other', NULL, ''),
(24, 2025, 'Горох', 'legumes', NULL, 'Текущий сезон'),
(25, 2023, 'Ячмень', 'barley', 18.20, ''),
(25, 2024, 'Пшеница', 'wheat', 22.50, ''),
(25, 2025, 'Пшеница', 'wheat', NULL, 'Текущий сезон');

