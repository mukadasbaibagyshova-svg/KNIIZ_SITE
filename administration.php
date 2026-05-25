<?php
include_once 'includes/lang.php';
$page_title = t('nav_administration');
$page_head = '<link rel="stylesheet" href="assets/css/organization.css?v=' . time() . '">';
include 'includes/header.php';

// Helper function to extract initials for beautiful fallback avatars
if (!function_exists('getInitials')) {
    function getInitials($fullName) {
        $parts = explode(' ', trim($fullName));
        $initials = '';
        if (isset($parts[0])) $initials .= mb_substr($parts[0], 0, 1, 'UTF-8');
        if (isset($parts[1])) $initials .= mb_substr($parts[1], 0, 1, 'UTF-8');
        return mb_strtoupper($initials, 'UTF-8');
    }
}

// Multilingual dataset of employees
$staff_data = [
    // 1. Leadership (Руководство)
    'leadership' => [
        [
            'name' => [
                'ru' => 'Усубалиев Биржан Кубатович',
                'ky' => 'Усубалиев Биржан Кубатович',
                'en' => 'Usubaliev Birzhan Kubatovich'
            ],
            'role' => [
                'ru' => 'Директор',
                'ky' => 'Директор',
                'en' => 'Director'
            ],
            'email' => 'nauca.zemledel@gmail.com',
            'image' => '',
            'grade' => 'director'
        ],
        [
            'name' => [
                'ru' => 'Исаев Кутман Мукашевич',
                'ky' => 'Исаев Кутман Мукашевич',
                'en' => 'Isaev Kutman Mukashevich'
            ],
            'role' => [
                'ru' => 'Заместитель директора',
                'ky' => 'Директордун орун басары',
                'en' => 'Deputy Director'
            ],
            'email' => 'ar.riva@mail.ru',
            'image' => '',
            'grade' => 'deputy'
        ],
        [
            'name' => [
                'ru' => 'Федичкина Ирина Григорьевна',
                'ky' => 'Федичкина Ирина Григорьевна',
                'en' => 'Fedichkina Irina Grigorievna'
            ],
            'role' => [
                'ru' => 'Ученый секретарь',
                'ky' => 'Илимий катчы',
                'en' => 'Scientific Secretary'
            ],
            'email' => 'irinaf.kniiz@gmail.com',
            'image' => '',
            'grade' => 'secretary'
        ]
    ],

    // 2. Administrative Support (Отдел административной поддержки)
    'admin_support' => [
        [
            'name' => [
                'ru' => 'Алыбаева Тамара Жанадиловна',
                'ky' => 'Алыбаева Тамара Жанадиловна',
                'en' => 'Alybaeva Tamara Zhanadilovna'
            ],
            'role' => [
                'ru' => 'Заведующий отделом административной поддержки',
                'ky' => 'Административдик колдоо бөлүмүнүн башчысы',
                'en' => 'Head of Administrative Support Department'
            ],
            'email' => 'tamara.jan@inbox.ru',
            'image' => '',
            'grade' => 'head'
        ],
        [
            'name' => [
                'ru' => 'Сопакунова Нуржамал Жумаковна',
                'ky' => 'Сопакунова Нуржамал Жумаковна',
                'en' => 'Sopakunova Nurzhamal Zhumakovna'
            ],
            'role' => [
                'ru' => 'Главный бухгалтер',
                'ky' => 'Башкы бухгалтер',
                'en' => 'Chief Accountant'
            ],
            'email' => 'nurjamal.kniiz@gmail.com',
            'image' => '',
            'grade' => 'staff'
        ],
        [
            'name' => [
                'ru' => 'Назаркулова Зарима Шактыбековна',
                'ky' => 'Назаркулова Зарима Шактыбековна',
                'en' => 'Nazarkulova Zarima Shaktybekovna'
            ],
            'role' => [
                'ru' => 'Редактор-корректор',
                'ky' => 'Редактор-корректор',
                'en' => 'Editor and Proofreader'
            ],
            'email' => 'zari.kniiz@gmail.com',
            'image' => '',
            'grade' => 'staff'
        ],
        [
            'name' => [
                'ru' => 'Орозов Аманбек Ибрагимович',
                'ky' => 'Орозов Аманбек Ибрагимович',
                'en' => 'Orozov Amanbek Ibragimovich'
            ],
            'role' => [
                'ru' => 'IT специалист',
                'ky' => 'IT адиси',
                'en' => 'IT Specialist'
            ],
            'email' => 'amanbek.kniiz@gmail.com',
            'image' => '',
            'grade' => 'staff'
        ],
        [
            'name' => [
                'ru' => 'Кожоев Жаныбек Кокумбекович',
                'ky' => 'Кожоев Жаныбек Кокумбекович',
                'en' => 'Kozhoev Zhanybek Kokumbekovich'
            ],
            'role' => [
                'ru' => 'Инженер',
                'ky' => 'Инженер',
                'en' => 'Engineer'
            ],
            'email' => 'salamattyk09ik.gov@gmail.com',
            'image' => '',
            'grade' => 'staff'
        ]
    ],

    // 3. Scientific Departments (Научные отделы)
    'departments' => [
        'wheat' => [
            'title' => [
                'ru' => 'Отдел селекции и первичного семеноводства пшеницы',
                'ky' => 'Буудайдын селекциясы жана баштапкы үрөнчүлүк бөлүмү',
                'en' => 'Department of Wheat Breeding and Primary Seed Production'
            ],
            'icon' => '🌾',
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Пахомеев Олег Владимирович',
                        'ky' => 'Пахомеев Олег Владимирович',
                        'en' => 'Pakhomeev Oleg Vladimirovich'
                    ],
                    'role' => [
                        'ru' => 'Заведующий отдела',
                        'ky' => 'Бөлүм башчысы',
                        'en' => 'Head of Department'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'head'
                ],
                [
                    'name' => [
                        'ru' => 'Ибрагимова Василя Санкеевна',
                        'ky' => 'Ибрагимова Василя Санкеевна',
                        'en' => 'Ibragimova Vasily Sankeevna'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Амергамзаев Али Гусенович',
                        'ky' => 'Амергамзаев Али Гусенович',
                        'en' => 'Amergamzaev Ali Gusenovich'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Исакова Ибадат Сабиржановна',
                        'ky' => 'Исакова Ибадат Сабиржановна',
                        'en' => 'Isakova Ibadat Sabirzhanovna'
                    ],
                    'role' => [
                        'ru' => 'Научный сотрудник',
                        'ky' => 'Илимий кызматкер',
                        'en' => 'Researcher'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'researcher'
                ]
            ]
        ],
        'barley' => [
            'title' => [
                'ru' => 'Отдел селекции и первичного семеноводства ячменя',
                'ky' => 'Арпанын селекциясы жана баштапкы үрөнчүлүк бөлүмү',
                'en' => 'Department of Barley Breeding and Primary Seed Production'
            ],
            'icon' => '🌱',
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Иманалиев Бакытбек Табылдыевич',
                        'ky' => 'Иманалиев Бакытбек Табылдыевич',
                        'en' => 'Imanaliev Bakytbek Tabyldievich'
                    ],
                    'role' => [
                        'ru' => 'Заведующий отделом',
                        'ky' => 'Бөлүм башчысы',
                        'en' => 'Head of Department'
                    ],
                    'email' => 'bakytbek_imanaliev@mail.ru',
                    'image' => 'assets/images/imanalievbakytbek.png',
                    'grade' => 'head'
                ],
                [
                    'name' => [
                        'ru' => 'Кузнецова Валентина Леонидовна',
                        'ky' => 'Кузнецова Валентина Леонидовна',
                        'en' => 'Kuznetsova Valentina Leonidovna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => 'assets/images/valentina.png',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Немцова Любовь Васильевна',
                        'ky' => 'Немцова Любовь Васильевна',
                        'en' => 'Nemtsova Lyubov Vasilievna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => 'assets/images/love.png',
                    'grade' => 'staff'
                ]
            ]
        ],
        'corn' => [
            'title' => [
                'ru' => 'Отдел селекции и первичного семеноводства кукурузы',
                'ky' => 'Жүгөрүнүн селекциясы жана баштапкы үрөнчүлүк бөлүмү',
                'en' => 'Department of Corn Breeding and Primary Seed Production'
            ],
            'icon' => '🌽',
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Гочадзе Гедия Сайдуллаевна',
                        'ky' => 'Гочадзе Гедия Сайдуллаевна',
                        'en' => 'Gochadze Gediya Saidullaevna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Седоев Сальвар Камалович',
                        'ky' => 'Седоев Сальвар Камалович',
                        'en' => 'Sedoev Salvar Kamalovich'
                    ],
                    'role' => [
                        'ru' => 'Старший агроном',
                        'ky' => 'Улуу агроном',
                        'en' => 'Senior Agronomist'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ]
            ]
        ],
        'genetic_resources' => [
            'title' => [
                'ru' => 'Группа генетических ресурсов растений и лаборатория технологии',
                'ky' => 'Өсүмдүктөрдүн генетикалык ресурстары тобу жана технология лабораториясы',
                'en' => 'Plant Genetic Resources Group and Technology Laboratory'
            ],
            'icon' => '🧪',
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Кулназаров Калман Кулназарович',
                        'ky' => 'Кулназаров Калман Кулназарович',
                        'en' => 'Kulnazarov Kalman Kulnazarovich'
                    ],
                    'role' => [
                        'ru' => 'Заведующий отделом',
                        'ky' => 'Бөлүм башчысы',
                        'en' => 'Head of Department'
                    ],
                    'email' => 'kulnazarovkalman@mail.ru',
                    'image' => 'assets/images/kulnazarovkalman.png',
                    'grade' => 'head'
                ],
                [
                    'name' => [
                        'ru' => 'Чыналиев Мухтар Турдубекович',
                        'ky' => 'Чыналиев Мухтар Турдубекович',
                        'en' => 'Chynaliev Mukhtar Turdubekovich'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => 'mchynaliev505@gmail.com',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Кадырбаев Урмат Кадырбаевич',
                        'ky' => 'Кадырбаев Урмат Кадырбаевич',
                        'en' => 'Kadyrbaev Urmat Kadyrbaevich'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => 'Urmat.kniiz@gmail.com',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Турсуналиева Бегимай Мирзаолимовна',
                        'ky' => 'Турсуналиева Бегимай Мирзаолимовна',
                        'en' => 'Tursunalieva Begimai Mirzaolimovna'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => 'kniiz.begimai@gmail.com',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Вагина Галина Петровна',
                        'ky' => 'Вагина Галина Петровна',
                        'en' => 'Vagina Galina Petrovna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Насирова Асель Турусбековна',
                        'ky' => 'Насирова Асель Турусбековна',
                        'en' => 'Nasirova Asel Turusbekovna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ]
            ]
        ],
        'soil_science' => [
            'title' => [
                'ru' => 'Отдел почвоведения',
                'ky' => 'Топурак таануу бөлүмү',
                'en' => 'Soil Science Department'
            ],
            'icon' => '🪨',
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Исмаилов Турусбек Асанкадырович',
                        'ky' => 'Исмаилов Турусбек Асанкадырович',
                        'en' => 'Ismailov Turusbek Asankadyrovich'
                    ],
                    'role' => [
                        'ru' => 'Заведующий отдела',
                        'ky' => 'Бөлүм башчысы',
                        'en' => 'Head of Department'
                    ],
                    'email' => 'turusbeki@mail.ru',
                    'image' => '',
                    'grade' => 'head'
                ],
                [
                    'name' => [
                        'ru' => 'Мусаева Гульсун Мусаевна',
                        'ky' => 'Мусаева Гульсун Мусаевна',
                        'en' => 'Musaeva Gulsun Musaevna'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => 'musa-eva1950@mail.ru',
                    'image' => '',
                    'grade' => 'researcher'
                ],
                [
                    'name' => [
                        'ru' => 'Худайбергенов Рустам Сапязович',
                        'ky' => 'Худайбергенов Рустам Сапязович',
                        'en' => 'Khudaibergenov Rustam Sapyazovich'
                    ],
                    'role' => [
                        'ru' => 'Старший научный сотрудник',
                        'ky' => 'Улуу илимий кызматкер',
                        'en' => 'Senior Researcher'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'researcher'
                ]
            ]
        ]
    ],

    // 4. Branches & Stations (Филиалы и опытные станции)
    'branches' => [
        [
            'id' => 'sugarbeet_station',
            'title' => [
                'ru' => '№1 Кыргызская опытно-селекционная станция по сахарной свекле (Кыргызское научно-производственное объединение по земледелию)',
                'ky' => '№1 Кант кызылчасы боюнча кыргыз тажрыйба-селекциялык станциясы (Кыргыз дыйканчылык илимий-өндүрүштүк бирикмеси)',
                'en' => 'No. 1 Kyrgyz Experimental Breeding Station for Sugar Beet (Kyrgyz Scientific-Industrial Association of Agriculture)'
            ],
            'location' => 'Сокулукский р-н, с. Первомайское',
            'has_sub_staff' => true,
            // Branch level staff
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Есеналиев Кубанычбек Дженишбекович',
                        'ky' => 'Есеналиев Кубанычбек Дженишбекович',
                        'en' => 'Esenaliev Kubanychbek Dzhenishbekovich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ],
                [
                    'name' => [
                        'ru' => 'Аккулуков Талантбек Мараимович',
                        'ky' => 'Аккулуков Талантбек Мараимович',
                        'en' => 'Akkulukov Talantbek Maraimovich'
                    ],
                    'role' => [
                        'ru' => 'Заместитель директора',
                        'ky' => 'Директордун орун басары',
                        'en' => 'Deputy Director'
                    ],
                    'email' => '',
                    'image' => 'assets/images/akkulakov.png',
                    'grade' => 'deputy'
                ],
                [
                    'name' => [
                        'ru' => 'Мусина Каныкей Кубанычбековна',
                        'ky' => 'Мусина Каныкей Кубанычбековна',
                        'en' => 'Musina Kanykey Kubanychbekovna'
                    ],
                    'role' => [
                        'ru' => 'Главный бухгалтер',
                        'ky' => 'Башкы бухгалтер',
                        'en' => 'Chief Accountant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Тараненко Татьяна Алексеевна',
                        'ky' => 'Тараненко Татьяна Алексеевна',
                        'en' => 'Taranenko Tatyana Alekseevna'
                    ],
                    'role' => [
                        'ru' => 'Главный агроном',
                        'ky' => 'Башкы агроном',
                        'en' => 'Chief Agronomist'
                    ],
                    'email' => '',
                    'image' => 'assets/images/taranenko.png',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Ганагина Людмила Николаевна',
                        'ky' => 'Ганагина Людмила Николаевна',
                        'en' => 'Ganagina Lyudmila Nikolaevna'
                    ],
                    'role' => [
                        'ru' => 'Инспектор отдела кадров',
                        'ky' => 'Кадрлар бөлүмүнүн инспектору',
                        'en' => 'HR Inspector'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ]
            ],
            // Nested departments under No.1 branch
            'sub_departments' => [
                [
                    'title' => [
                        'ru' => 'Отдел плодово-ягодных культур',
                        'ky' => 'Мөмө-жемиш өсүмдүктөрү бөлүмү',
                        'en' => 'Department of Fruit and Berry Crops'
                    ],
                    'staff' => [
                        [
                            'name' => [
                                'ru' => 'Джуманалиева Айнура Эсеналиевна',
                                'ky' => 'Джуманалиева Айнура Эсеналиевна',
                                'en' => 'Dzhumanalieva Ainura Esenalievna'
                            ],
                            'role' => [
                                'ru' => 'Старший научный сотрудник',
                                'ky' => 'Улуу илимий кызматкер',
                                'en' => 'Senior Researcher'
                            ],
                            'email' => 'ainura.kniiz@mail.ru',
                            'image' => '',
                            'grade' => 'researcher'
                        ],
                        [
                            'name' => [
                                'ru' => 'Тажаматова Салтанат Касымовна',
                                'ky' => 'Тажаматова Салтанат Касымовна',
                                'en' => 'Tazhamatova Saltanat Kasymovna'
                            ],
                            'role' => [
                                'ru' => 'Научный сотрудник',
                                'ky' => 'Илимий кызматкер',
                                'en' => 'Researcher'
                            ],
                            'email' => '',
                            'image' => '',
                            'grade' => 'researcher'
                        ]
                    ]
                ],
                [
                    'title' => [
                        'ru' => 'Отдел по сахарной свекле',
                        'ky' => 'Кант кызылчасы бөлүмү',
                        'en' => 'Sugar Beet Department'
                    ],
                    'staff' => [
                        [
                            'name' => [
                                'ru' => 'Качибеков Уланбек Байтилешович',
                                'ky' => 'Качибеков Уланбек Байтилешович',
                                'en' => 'Kachibekov Ulanbek Baitileshovich'
                            ],
                            'role' => [
                                'ru' => 'Заведующий отделом',
                                'ky' => 'Бөлүм башчысы',
                                'en' => 'Head of Department'
                            ],
                            'email' => '',
                            'image' => '',
                            'grade' => 'head'
                        ],
                        [
                            'name' => [
                                'ru' => 'Назарова Лайлихан Сагынбековна',
                                'ky' => 'Назарова Лайлихан Сагынбековна',
                                'en' => 'Nazarova Lailikhan Sagynbekovna'
                            ],
                            'role' => [
                                'ru' => 'Старший лаборант',
                                'ky' => 'Улуу лаборант',
                                'en' => 'Senior Laboratory Assistant'
                            ],
                            'email' => '',
                            'image' => '',
                            'grade' => 'staff'
                        ],
                        [
                            'name' => [
                                'ru' => 'Есенкулова Елизавета Манапаевна',
                                'ky' => 'Есенкулова Елизавета Манапаевна',
                                'en' => 'Esenkulova Elizaveta Manapaevna'
                            ],
                            'role' => [
                                'ru' => 'Старший лаборант',
                                'ky' => 'Улуу лаборант',
                                'en' => 'Senior Laboratory Assistant'
                            ],
                            'email' => '',
                            'image' => '',
                            'grade' => 'staff'
                        ]
                    ]
                ]
            ]
        ],
        [
            'id' => 'cotton_station',
            'title' => [
                'ru' => 'Кыргызская опытная станция по хлопководству',
                'ky' => 'Кыргыз пахтачылык тажрыйба станциясы',
                'en' => 'Kyrgyz Experimental Station for Cotton Growing'
            ],
            'location' => 'Кара-Сууйский р-н',
            'has_sub_staff' => true,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Матаев Маматкадыр Маматкадырович',
                        'ky' => 'Матаев Маматкадыр Маматкадырович',
                        'en' => 'Mataev Mamatkadyr Mamatkadyrovich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ],
                [
                    'name' => [
                        'ru' => 'Сансызбаев Абдилла Зулпукарович',
                        'ky' => 'Сансызбаев Абдилла Зулпукарович',
                        'en' => 'Sansyzbaev Abdilla Zulpukarovich'
                    ],
                    'role' => [
                        'ru' => 'Главный агроном-механик',
                        'ky' => 'Башкы агроном-механик',
                        'en' => 'Chief Agronomist-Mechanic'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Эргешева Чынара Дарбановна',
                        'ky' => 'Эргешева Чынара Дарбановна',
                        'en' => 'Ergesheva Chynara Darbanovna'
                    ],
                    'role' => [
                        'ru' => 'Главный бухгалтер',
                        'ky' => 'Башкы бухгалтер',
                        'en' => 'Chief Accountant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Тургунбаев Алимжан Ташболотович',
                        'ky' => 'Тургунбаев Алимжан Ташболотович',
                        'en' => 'Turgunbaev Alimzhan Tashbolotovich'
                    ],
                    'role' => [
                        'ru' => 'Заведующий отделом элиты',
                        'ky' => 'Элита бөлүмүнүн башчысы',
                        'en' => 'Head of Elite Department'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'head'
                ],
                [
                    'name' => [
                        'ru' => 'Маматова Карамат',
                        'ky' => 'Маматова Карамат',
                        'en' => 'Mamatova Karamat'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ],
                [
                    'name' => [
                        'ru' => 'Ысмаилова Гулзада Токтобаевна',
                        'ky' => 'Ысмаилова Гулзада Токтобаевна',
                        'en' => 'Ismailova Gulzada Toktobaevna'
                    ],
                    'role' => [
                        'ru' => 'Старший лаборант',
                        'ky' => 'Улуу лаборант',
                        'en' => 'Senior Laboratory Assistant'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'staff'
                ]
            ]
        ],
        // Single director stations
        [
            'id' => 'zhany_pakhta',
            'title' => [
                'ru' => '№ 2 Государственное семеноводческое хозяйство «Жаны - Пахта»',
                'ky' => '№ 2 «Жаңы-Пахта» мамлекеттик үрөнчүлүк чарбасы',
                'en' => 'No. 2 State Seed-Growing Farm "Zhany-Pakhta"'
            ],
            'location' => 'Сокулукский р-н',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Алмасбеков Кубат Алмасбекович',
                        'ky' => 'Алмасбеков Кубат Алмасбекович',
                        'en' => 'Almasbekov Kubat Almasbekovich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ]
            ]
        ],
        [
            'id' => 'issyk_kul_station',
            'title' => [
                'ru' => '№ 3 Иссык-Кульская опытно-селекционная станция',
                'ky' => '№ 3 Ысык-Көл тажрыйба-селекциялык станциясы',
                'en' => 'No. 3 Issyk-Kul Experimental Breeding Station'
            ],
            'location' => 'Иссык-Кульская область',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Осмонов Дайырбек Турсунгазиевич',
                        'ky' => 'Осмонов Дайырбек Турсунгазиевич',
                        'en' => 'Osmonov Daiyrbek Tursungazievich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ]
            ]
        ],
        [
            'id' => 'naryn_station',
            'title' => [
                'ru' => 'Нарынская опытная станция',
                'ky' => 'Нарын тажрыйба станциясы',
                'en' => 'Naryn Experimental Station'
            ],
            'location' => 'Нарынская область',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Эралиева Асел Муканбетовна',
                        'ky' => 'Эралиева Асел Муканбетовна',
                        'en' => 'Eralieva Asel Mukanbetovna'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => 'assets/images/asel.png',
                    'grade' => 'director'
                ]
            ]
        ],
        [
            'id' => 'burgundy_station',
            'title' => [
                'ru' => '№ 6 Бургундинский опорный пункт',
                'ky' => '№ 6 Бүргөндү таяныч пункту',
                'en' => 'No. 6 Burgundy Support Point'
            ],
            'location' => 'Кадамжайский р-н',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Юзбаев Бахтияр Абдыхалилович',
                        'ky' => 'Юзбаев Бахтияр Абдыхалилович',
                        'en' => 'Yuzbaev Bakhtiyar Abdykhalilovich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ]
            ]
        ],
        [
            'id' => 'atay_farm',
            'title' => [
                'ru' => 'Семеноводческое хозяйство «Атай»',
                'ky' => '«Атай» үрөнчүлүк чарбасы',
                'en' => 'Seed-Growing Farm "Atay"'
            ],
            'location' => 'Чуйская область',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Сакеев Жыргалбек Керимжанович',
                        'ky' => 'Сакеев Жыргалбек Керимжанович',
                        'en' => 'Sakeev Zhyrgalbek Kerimzhanovich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ]
            ]
        ],
        [
            'id' => 'ak_altyn_farm',
            'title' => [
                'ru' => 'Семеноводческое хозяйство «Ак-Алтын»',
                'ky' => '«Ак-Алтын» үрөнчүлүк чарбасы',
                'en' => 'Seed-Growing Farm "Ak-Altyn"'
            ],
            'location' => 'Ошская область',
            'has_sub_staff' => false,
            'staff' => [
                [
                    'name' => [
                        'ru' => 'Усобаев Акылбек Сатыбалдыевич',
                        'ky' => 'Усобаев Акылбек Сатыбалдыевич',
                        'en' => 'Usobaev Akylbek Satybaldievich'
                    ],
                    'role' => [
                        'ru' => 'Директор',
                        'ky' => 'Директор',
                        'en' => 'Director'
                    ],
                    'email' => '',
                    'image' => '',
                    'grade' => 'director'
                ]
            ]
        ]
    ]
];

$lang = currentLang();
?>

<main class="organization-page" id="main-content">
    <div class="org-container container">
        
        <!-- Header Section -->
        <div class="org-header text-center">
            <h1 class="org-title"><?php echo t('nav_administration'); ?></h1>
            <p class="org-subtitle"><?php echo t('admin_subtitle'); ?></p>
        </div>

        <!-- Filter & Search Controls -->
        <div class="controls-glasscard mb-5">
            <div class="row align-items-center gap-3 gap-md-0">
                <!-- Search Bar -->
                <div class="col-12 col-md-5">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="employeeSearch" class="employee-search" placeholder="<?php echo $lang == 'en' ? 'Search by name, role, department or email...' : ($lang == 'ky' ? 'Ысым, кызмат же бөлүм боюнча издөө...' : 'Поиск по имени, должности, отделу или почте...'); ?>">
                        <button type="button" class="clear-search-btn" id="clearSearch" style="display:none;">&times;</button>
                    </div>
                </div>
                <!-- Filter Tabs -->
                <div class="col-12 col-md-7">
                    <div class="filter-tabs-wrapper">
                        <button type="button" class="filter-tab active" data-tab="all"><?php echo $lang == 'en' ? 'All Staff' : ($lang == 'ky' ? 'Баары' : 'Все сотрудники'); ?></button>
                        <button type="button" class="filter-tab" data-tab="admin"><?php echo $lang == 'en' ? 'Administration' : ($lang == 'ky' ? 'Башкаруу аппараты' : 'Администрация'); ?></button>
                        <button type="button" class="filter-tab" data-tab="science"><?php echo $lang == 'en' ? 'Scientific Depts' : ($lang == 'ky' ? 'Илимий бөлүмдөр' : 'Научные отделы'); ?></button>
                        <button type="button" class="filter-tab" data-tab="branches"><?php echo $lang == 'en' ? 'Branches & Stations' : ($lang == 'ky' ? 'Филиалдар' : 'Филиалы и станции'); ?></button>
                    </div>
                </div>
            </div>
            <div class="search-feedback-text mt-3 text-center" id="searchFeedback" style="display:none;"></div>
        </div>

        <!-- ==================== TABS CONTENT ==================== -->

        <!-- SECTION 1: Leadership & Administrative Support -->
        <div class="tab-content-section" id="section-admin">
            <h2 class="category-heading">
                <span>🏢</span> 
                <?php echo $lang == 'en' ? 'Administration & Management' : ($lang == 'ky' ? 'Башкаруу жана административдик аппарат' : 'Руководство и административный аппарат'); ?>
            </h2>
            
            <!-- Leadership Tree Grid -->
            <div class="leadership-row mb-5">
                <?php foreach ($staff_data['leadership'] as $employee): 
                    $emp_name = $employee['name'][$lang];
                    $emp_role = $employee['role'][$lang];
                    $initials = getInitials($employee['name']['ru']);
                ?>
                    <div class="employee-card card-premium <?php echo $employee['grade']; ?>-card" data-employee-name="<?php echo htmlspecialchars($emp_name); ?>" data-employee-role="<?php echo htmlspecialchars($emp_role); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email']); ?>">
                        <div class="card-glow"></div>
                        <div class="avatar-wrapper">
                            <?php if (!empty($employee['image']) && file_exists($employee['image'])): ?>
                                <img src="<?php echo $employee['image']; ?>" alt="<?php echo htmlspecialchars($emp_name); ?>" class="employee-avatar-img">
                            <?php else: ?>
                                <div class="employee-avatar-initials grade-<?php echo $employee['grade']; ?>">
                                    <span><?php echo $initials; ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="role-badge"><?php echo $employee['grade'] == 'director' ? '👑' : ($employee['grade'] == 'deputy' ? '🔑' : '📝'); ?></span>
                        </div>
                        <h3 class="employee-name-title"><?php echo htmlspecialchars($emp_name); ?></h3>
                        <p class="employee-role-text"><?php echo htmlspecialchars($emp_role); ?></p>
                        <span class="dept-badge"><?php echo $lang == 'en' ? 'Management' : ($lang == 'ky' ? 'Жетекчилик' : 'Руководство'); ?></span>
                        
                        <?php if (!empty($employee['email'])): ?>
                            <a href="mailto:<?php echo $employee['email']; ?>" class="email-btn-modern mt-3" title="Отправить email">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span><?php echo htmlspecialchars($employee['email']); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Administrative Support Department -->
            <div class="dept-container-glass mb-5">
                <div class="dept-glass-header">
                    <span class="dept-icon-circle">📂</span>
                    <div>
                        <h3 class="dept-glass-title"><?php echo $lang == 'en' ? 'Administrative Support Department' : ($lang == 'ky' ? 'Административдик колдоо бөлүмү' : 'Отдел административной поддержки'); ?></h3>
                        <p class="dept-glass-subtitle"><?php echo $lang == 'en' ? 'Support, IT, accounting, and technical operations' : ($lang == 'ky' ? 'Колдоо, IT, бухгалтердик эсеп жана техникалык иштер' : 'Обеспечение деятельности, IT, бухгалтерия и техническое сопровождение'); ?></p>
                    </div>
                </div>
                
                <div class="staff-grid-modern">
                    <?php foreach ($staff_data['admin_support'] as $employee): 
                        $emp_name = $employee['name'][$lang];
                        $emp_role = $employee['role'][$lang];
                        $initials = getInitials($employee['name']['ru']);
                        $card_class = $employee['grade'] == 'head' ? 'head-card highlighted-border' : '';
                    ?>
                        <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars($emp_name); ?>" data-employee-role="<?php echo htmlspecialchars($emp_role); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email']); ?>">
                            <div class="card-glow"></div>
                            <div class="avatar-wrapper">
                                <?php if (!empty($employee['image']) && file_exists($employee['image'])): ?>
                                    <img src="<?php echo $employee['image']; ?>" alt="<?php echo htmlspecialchars($emp_name); ?>" class="employee-avatar-img">
                                <?php else: ?>
                                    <div class="employee-avatar-initials grade-<?php echo $employee['grade']; ?>">
                                        <span><?php echo $initials; ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($employee['grade'] == 'head'): ?><span class="role-badge">⭐</span><?php endif; ?>
                            </div>
                            <h4 class="employee-name-title"><?php echo htmlspecialchars($emp_name); ?></h4>
                            <p class="employee-role-text"><?php echo htmlspecialchars($emp_role); ?></p>
                            
                            <?php if (!empty($employee['email'])): ?>
                                <a href="mailto:<?php echo $employee['email']; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span><?php echo htmlspecialchars($employee['email']); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Scientific Departments -->
        <div class="tab-content-section" id="section-science" style="display:none;">
            <h2 class="category-heading">
                <span>🔬</span> 
                <?php echo $lang == 'en' ? 'Scientific Research Departments' : ($lang == 'ky' ? 'Илимий-изилдөө бөлүмдөрү' : 'Научно-исследовательские отделы'); ?>
            </h2>

            <?php foreach ($staff_data['departments'] as $dept_id => $dept): 
                $dept_title = $dept['title'][$lang];
            ?>
                <div class="dept-container-glass mb-5" data-dept-id="<?php echo $dept_id; ?>">
                    <div class="dept-glass-header">
                        <span class="dept-icon-circle"><?php echo $dept['icon']; ?></span>
                        <div>
                            <h3 class="dept-glass-title"><?php echo htmlspecialchars($dept_title); ?></h3>
                            <p class="dept-glass-subtitle"><?php echo $lang == 'en' ? 'Leading breeding and primary seed research' : ($lang == 'ky' ? 'Алдыңкы селекция жана баштапкы үрөн изилдөөлөрү' : 'Ведущие селекционные и первичные исследования'); ?></p>
                        </div>
                    </div>
                    
                    <div class="staff-grid-modern">
                        <?php foreach ($dept['staff'] as $employee): 
                            $emp_name = $employee['name'][$lang];
                            $emp_role = $employee['role'][$lang];
                            $initials = getInitials($employee['name']['ru']);
                            $card_class = $employee['grade'] == 'head' ? 'head-card highlighted-border' : '';
                        ?>
                            <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars($emp_name); ?>" data-employee-role="<?php echo htmlspecialchars($emp_role); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email']); ?>" data-dept-name="<?php echo htmlspecialchars($dept_title); ?>">
                                <div class="card-glow"></div>
                                <div class="avatar-wrapper">
                                    <?php if (!empty($employee['image'])): ?>
                                        <img src="<?php echo $employee['image']; ?>" alt="<?php echo htmlspecialchars($emp_name); ?>" class="employee-avatar-img">
                                    <?php else: ?>
                                        <div class="employee-avatar-initials grade-<?php echo $employee['grade']; ?>">
                                            <span><?php echo $initials; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($employee['grade'] == 'head'): ?><span class="role-badge">⭐</span><?php endif; ?>
                                </div>
                                <h4 class="employee-name-title"><?php echo htmlspecialchars($emp_name); ?></h4>
                                <p class="employee-role-text"><?php echo htmlspecialchars($emp_role); ?></p>
                                
                                <?php if (!empty($employee['email'])): ?>
                                    <a href="mailto:<?php echo $employee['email']; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span><?php echo htmlspecialchars($employee['email']); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- SECTION 3: Branches & Regional Stations -->
        <div class="tab-content-section" id="section-branches" style="display:none;">
            <h2 class="category-heading">
                <span>🌍</span> 
                <?php echo $lang == 'en' ? 'Regional Experimental Stations & Branches' : ($lang == 'ky' ? 'Аймактык тажрыйба станциялары жана филиалдар' : 'Региональные опытные станции и филиалы'); ?>
            </h2>

            <div class="branches-flex-grid">
                <?php foreach ($staff_data['branches'] as $branch): 
                    $branch_title = $branch['title'][$lang];
                ?>
                    <div class="branch-glass-card mb-4" data-branch-id="<?php echo $branch['id']; ?>">
                        <div class="branch-glass-header-bar">
                            <div class="branch-icon-badge">🏢</div>
                            <div class="branch-header-info">
                                <h3 class="branch-card-title"><?php echo htmlspecialchars($branch_title); ?></h3>
                                <p class="branch-location-text">📍 <?php echo htmlspecialchars($branch['location']); ?></p>
                            </div>
                        </div>

                        <!-- Direct Branch Staff -->
                        <div class="branch-main-staff-list p-4">
                            <h4 class="branch-inner-subtitle"><?php echo $lang == 'en' ? 'Management & Specialists' : ($lang == 'ky' ? 'Жетекчилик жана адистер' : 'Руководство и специалисты'); ?></h4>
                            <div class="staff-grid-modern">
                                <?php foreach ($branch['staff'] as $employee): 
                                    $emp_name = $employee['name'][$lang];
                                    $emp_role = $employee['role'][$lang];
                                    $initials = getInitials($employee['name']['ru']);
                                    $card_class = $employee['grade'] == 'director' ? 'director-card highlighted-border' : '';
                                ?>
                                    <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars($emp_name); ?>" data-employee-role="<?php echo htmlspecialchars($emp_role); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email']); ?>" data-branch-name="<?php echo htmlspecialchars($branch_title); ?>">
                                        <div class="card-glow"></div>
                                        <div class="avatar-wrapper">
                                            <?php if (!empty($employee['image'])): ?>
                                                <img src="<?php echo $employee['image']; ?>" alt="<?php echo htmlspecialchars($emp_name); ?>" class="employee-avatar-img">
                                            <?php else: ?>
                                                <div class="employee-avatar-initials grade-<?php echo $employee['grade']; ?>">
                                                    <span><?php echo $initials; ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($employee['grade'] == 'director'): ?><span class="role-badge">👑</span><?php endif; ?>
                                        </div>
                                        <h5 class="employee-name-title"><?php echo htmlspecialchars($emp_name); ?></h5>
                                        <p class="employee-role-text"><?php echo htmlspecialchars($emp_role); ?></p>

                                        <?php if (!empty($employee['email'])): ?>
                                            <a href="mailto:<?php echo $employee['email']; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                                <span><?php echo htmlspecialchars($employee['email']); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Nested Sub-departments (like Fruit/Berry and Sugar Beet under №1 Sugar Beet Station) -->
                        <?php if (!empty($branch['sub_departments'])): ?>
                            <div class="branch-sub-departments p-4 pt-0">
                                <?php foreach ($branch['sub_departments'] as $sub_dept): 
                                    $sub_title = $sub_dept['title'][$lang];
                                ?>
                                    <div class="sub-dept-wrapper mb-4">
                                        <h5 class="sub-dept-label-heading"><?php echo htmlspecialchars($sub_title); ?></h5>
                                        <div class="staff-grid-modern">
                                            <?php foreach ($sub_dept['staff'] as $employee): 
                                                $emp_name = $employee['name'][$lang];
                                                $emp_role = $employee['role'][$lang];
                                                $initials = getInitials($employee['name']['ru']);
                                                $card_class = $employee['grade'] == 'head' ? 'head-card highlighted-border' : '';
                                            ?>
                                                <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars($emp_name); ?>" data-employee-role="<?php echo htmlspecialchars($emp_role); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email']); ?>" data-branch-name="<?php echo htmlspecialchars($branch_title); ?>" data-dept-name="<?php echo htmlspecialchars($sub_title); ?>">
                                                    <div class="card-glow"></div>
                                                    <div class="avatar-wrapper">
                                                        <?php if (!empty($employee['image'])): ?>
                                                            <img src="<?php echo $employee['image']; ?>" alt="<?php echo htmlspecialchars($emp_name); ?>" class="employee-avatar-img">
                                                        <?php else: ?>
                                                            <div class="employee-avatar-initials grade-<?php echo $employee['grade']; ?>">
                                                                <span><?php echo $initials; ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($employee['grade'] == 'head'): ?><span class="role-badge">⭐</span><?php endif; ?>
                                                    </div>
                                                    <h5 class="employee-name-title"><?php echo htmlspecialchars($emp_name); ?></h5>
                                                    <p class="employee-role-text"><?php echo htmlspecialchars($emp_role); ?></p>

                                                    <?php if (!empty($employee['email'])): ?>
                                                        <a href="mailto:<?php echo $employee['email']; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                                <polyline points="22,6 12,13 2,6"></polyline>
                                                            </svg>
                                                            <span><?php echo htmlspecialchars($employee['email']); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('employeeSearch');
    const clearSearchBtn = document.getElementById('clearSearch');
    const tabButtons = document.querySelectorAll('.filter-tab');
    const sectionAdmin = document.getElementById('section-admin');
    const sectionScience = document.getElementById('section-science');
    const sectionBranches = document.getElementById('section-branches');
    const searchFeedback = document.getElementById('searchFeedback');
    
    const sections = {
        'admin': [sectionAdmin],
        'science': [sectionScience],
        'branches': [sectionBranches],
        'all': [sectionAdmin, sectionScience, sectionBranches]
    };

    let activeTab = 'all';

    // 1. Tab Switching Function
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            tabButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeTab = this.getAttribute('data-tab');
            
            // Switch tabs visually
            Object.keys(sections).forEach(key => {
                if (key !== 'all') {
                    sections[key].forEach(sec => sec.style.display = 'none');
                }
            });
            
            sections[activeTab].forEach(sec => {
                sec.style.display = 'block';
            });
            
            // Re-apply filter based on search input
            filterStaff();
        });
    });

    // 2. Real-time Search Filtering
    searchInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
        filterStaff();
    });

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        searchInput.focus();
        filterStaff();
    });

    function filterStaff() {
        const query = searchInput.value.toLowerCase().trim();
        let totalMatches = 0;
        let totalCards = 0;

        // Reset all cards, depts, branches visibility first
        const allCards = document.querySelectorAll('.employee-card');
        allCards.forEach(card => {
            card.classList.remove('highlight-match', 'fade-out');
            card.style.display = '';
        });

        const allDeptContainers = document.querySelectorAll('.dept-container-glass');
        allDeptContainers.forEach(cont => cont.style.display = '');

        const allBranchCards = document.querySelectorAll('.branch-glass-card');
        allBranchCards.forEach(card => card.style.display = '');

        const subDeptWrappers = document.querySelectorAll('.sub-dept-wrapper');
        subDeptWrappers.forEach(w => w.style.display = '');

        if (query.length > 0) {
            // Apply filtering logic
            allCards.forEach(card => {
                const name = (card.getAttribute('data-employee-name') || '').toLowerCase();
                const role = (card.getAttribute('data-employee-role') || '').toLowerCase();
                const email = (card.getAttribute('data-employee-email') || '').toLowerCase();
                const dept = (card.getAttribute('data-dept-name') || '').toLowerCase();
                const branch = (card.getAttribute('data-branch-name') || '').toLowerCase();

                const isMatch = name.includes(query) || role.includes(query) || email.includes(query) || dept.includes(query) || branch.includes(query);

                if (isMatch) {
                    card.classList.add('highlight-match');
                    totalMatches++;
                } else {
                    card.classList.add('fade-out');
                    card.style.display = 'none';
                }
                totalCards++;
            });

            // Clean up department headers and branch containers that have 0 matches inside
            allDeptContainers.forEach(container => {
                const visibleCards = container.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    container.style.display = 'none';
                }
            });

            subDeptWrappers.forEach(wrapper => {
                const visibleCards = wrapper.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    wrapper.style.display = 'none';
                }
            });

            allBranchCards.forEach(branchCard => {
                const visibleCards = branchCard.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    branchCard.style.display = 'none';
                }
            });

            // Display Feedback text
            searchFeedback.style.display = 'block';
            if (totalMatches > 0) {
                searchFeedback.innerHTML = `<?php echo $lang == 'en' ? 'Found' : ($lang == 'ky' ? 'Табылды' : 'Найдено'); ?>: <strong>${totalMatches}</strong>`;
                searchFeedback.style.color = '#10b981';
            } else {
                searchFeedback.innerHTML = `<?php echo $lang == 'en' ? 'No staff found matching' : ($lang == 'ky' ? 'Эч нерсе табылган жок' : 'Сотрудников не найдено по запросу'); ?> "<strong>${query}</strong>"`;
                searchFeedback.style.color = '#f43f5e';
            }
        } else {
            // Hide feedback if query is empty
            searchFeedback.style.display = 'none';
        }

        // Handle tabs visibility matching (ensure only active tab sections are shown)
        Object.keys(sections).forEach(key => {
            if (key !== 'all') {
                sections[key].forEach(sec => {
                    if (activeTab === 'all' || activeTab === key) {
                        sec.style.display = 'block';
                    } else {
                        sec.style.display = 'none';
                    }
                });
            }
        });
    }

    // Initialize animation delayed loads
    const premiumCards = document.querySelectorAll('.card-premium');
    premiumCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-in');
        }, index * 25);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
