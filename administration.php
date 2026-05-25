<?php
include_once 'includes/lang.php';
$page_title = t('nav_administration');
include 'includes/header.php';

$lang = currentLang();

function adminInitials($name) {
    $parts = preg_split('/\s+/u', trim($name));
    $initials = '';
    if (!empty($parts[0])) $initials .= mb_substr($parts[0], 0, 1, 'UTF-8');
    if (!empty($parts[1])) $initials .= mb_substr($parts[1], 0, 1, 'UTF-8');
    return mb_strtoupper($initials, 'UTF-8');
}

// Renders a single person card
// $size: 'lg' | 'md' | 'sm'
function personCard($name, $role, $image = null, $size = 'md') {
    $initials = adminInitials($name);
    $sizeClass = 'pcard--' . $size;
    echo '<div class="pcard ' . $sizeClass . '">';
    if ($image && file_exists($image)) {
        echo '<img src="' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($name) . '" class="pcard__photo">';
    } else {
        echo '<div class="pcard__avatar">' . $initials . '</div>';
    }
    echo '<div class="pcard__body">';
    echo '<p class="pcard__name">' . htmlspecialchars($name) . '</p>';
    echo '<p class="pcard__role">' . htmlspecialchars($role) . '</p>';
    echo '</div>';
    echo '</div>';
}
?>

<main class="admin-page py-5">
<div class="container">

    <!-- Page header -->
    <div class="text-center mb-5">
        
        <h1 class="section-title-premium text-dark mb-3"><?php echo t('nav_administration'); ?></h1>
        <p class="section-subtitle-premium text-muted mx-auto" style="max-width:720px;"><?php echo t('admin_subtitle'); ?></p>
    </div>

    <!-- ══════════════════════════════════════════════
         1. АДМИНИСТРАТИВНО-УПРАВЛЕНЧЕСКИЙ АППАРАТ
    ══════════════════════════════════════════════ -->
    <section class="hier-section mb-5">
        <h2 class="hier-section-label">Административно-управленческий аппарат</h2>

        <!-- Директор — вверху по центру -->
        <div class="hier-top">
            <?php personCard('Усубалиев Биржан Кубатович', 'Директор', null, 'lg'); ?>
        </div>

        <!-- Коннектор -->
        <div class="hier-connector" aria-hidden="true">
            <div class="hier-line-v"></div>
            <div class="hier-line-h"></div>
            <div class="hier-line-v-pair">
                <div class="hier-line-v"></div>
                <div class="hier-line-v"></div>
            </div>
        </div>

        <!-- Зам. директора + Ученый секретарь -->
        <div class="hier-row hier-row--2">
            <?php personCard('Исаев Кутман Мукашевич', 'Заместитель директора', null, 'md'); ?>
            <?php personCard('Федичкина Ирина Григорьевна', 'Ученый секретарь', null, 'md'); ?>
        </div>
    </section>

    <hr class="hier-divider">

    <!-- ══════════════════════════════════════════════
         2. ОТДЕЛ АДМИНИСТРАТИВНОЙ ПОДДЕРЖКИ
    ══════════════════════════════════════════════ -->
    <section class="hier-section mb-5">
        <h2 class="hier-section-label">Отдел административной поддержки</h2>

        <div class="hier-top">
            <?php personCard('Алыбаева Тамара Жанадиловна', 'Заведующий отделом', null, 'md'); ?>
        </div>
        <div class="hier-connector" aria-hidden="true">
            <div class="hier-line-v"></div>
            <div class="hier-line-h"></div>
            <div class="hier-line-v-group" data-cols="4">
                <?php for($i=0;$i<4;$i++) echo '<div class="hier-line-v"></div>'; ?>
            </div>
        </div>
        <div class="hier-row hier-row--4">
            <?php personCard('Сопакунова Нуржамал Жумаковна', 'Главный бухгалтер', null, 'sm'); ?>
            <?php personCard('Назаркулова Зарима Шактыбековна', 'Редактор-корректор', null, 'sm'); ?>
            <?php personCard('Орозов Аманбек Ибрагимович', 'IT специалист', null, 'sm'); ?>
            <?php personCard('Кожоев Жаныбек Кокумбекович', 'Инженер', null, 'sm'); ?>
        </div>
    </section>

    <hr class="hier-divider">

    <!-- ══════════════════════════════════════════════
         3. НАУЧНЫЕ ОТДЕЛЫ
    ══════════════════════════════════════════════ -->
    <section class="hier-section mb-5">
        <h2 class="hier-section-label">Научные отделы</h2>

        <!-- Пшеница -->
        <div class="dept-block">
            <div class="dept-block__title">Отдел селекции и первичного семеноводства пшеницы</div>
            <div class="hier-top">
                <?php personCard('Пахомеев Олег Владимирович', 'Заведующий отделом', null, 'md'); ?>
            </div>
            <div class="hier-row hier-row--3">
                <?php personCard('Ибрагимова Василя Санкеевна', 'Старший научный сотрудник', null, 'sm'); ?>
                <?php personCard('Амергамзаев Али Гусенович', 'Старший научный сотрудник', null, 'sm'); ?>
                <?php personCard('Исакова Ибадат Сабиржановна', 'Научный сотрудник', null, 'sm'); ?>
            </div>
        </div>

        <!-- Ячмень -->
        <div class="dept-block">
            <div class="dept-block__title">Отдел селекции и первичного семеноводства ячменя</div>
            <div class="hier-top">
                <?php personCard('Иманалиев Бакытбек Табылдыевич', 'Заведующий отделом', 'assets/images/imanalievbakytbek.png', 'md'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Кузнецова Валентина Леонидовна', 'Старший лаборант', null, 'sm'); ?>
                <?php personCard('Немцова Любовь Васильевна', 'Старший лаборант', null, 'sm'); ?>
            </div>
        </div>

        <!-- Кукуруза -->
        <div class="dept-block">
            <div class="dept-block__title">Отдел селекции и первичного семеноводства кукурузы</div>
            <div class="hier-row hier-row--2">
                <?php personCard('Гочадзе Гедия Сайдуллаевна', 'Старший лаборант', null, 'sm'); ?>
                <?php personCard('Седоев Сальвар Камалович', 'Старший агроном', null, 'sm'); ?>
            </div>
        </div>

        <!-- Генресурсы -->
        <div class="dept-block">
            <div class="dept-block__title">Группа генетических ресурсов растений и лаборатория технологии</div>
            <div class="hier-top">
                <?php personCard('Кулназаров Калман Кулназарович', 'Заведующий отделом', null, 'md'); ?>
            </div>
            <div class="hier-row hier-row--3">
                <?php personCard('Чыналиев Мухтар Турдубекович', 'Старший научный сотрудник', null, 'sm'); ?>
                <?php personCard('Кадырбаев Урмат Кадырбаевич', 'Старший научный сотрудник', null, 'sm'); ?>
                <?php personCard('Турсуналиева Бегимай Мирзаолимовна', 'Старший научный сотрудник', null, 'sm'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Вагина Галина Петровна', 'Старший лаборант', null, 'sm'); ?>
                <?php personCard('Насирова Асель Турусбековна', 'Старший лаборант', null, 'sm'); ?>
            </div>
        </div>

        <!-- Почвоведение -->
        <div class="dept-block">
            <div class="dept-block__title">Отдел почвоведения</div>
            <div class="hier-top">
                <?php personCard('Исмаилов Турусбек Асанкадырович', 'Заведующий отделом', null, 'md'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Мусаева Гульсун Мусаевна', 'Старший научный сотрудник', null, 'sm'); ?>
                <?php personCard('Худайбергенов Рустам Сапязович', 'Старший научный сотрудник', null, 'sm'); ?>
            </div>
        </div>
    </section>

    <hr class="hier-divider">

    <!-- ══════════════════════════════════════════════
         4. ФИЛИАЛЫ
    ══════════════════════════════════════════════ -->
    <section class="hier-section mb-5">
        <h2 class="hier-section-label">Филиалы</h2>

        <!-- КОСС -->
        <div class="dept-block">
            <div class="dept-block__title">№1 Кыргызская опытно-селекционная станция по сахарной свекле</div>
            <div class="hier-top">
                <?php personCard('Есеналиев Кубанычбек Дженишбекович', 'Директор', null, 'md'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Аккулуков Талантбек Мараимович', 'Заместитель директора', null, 'sm'); ?>
                <?php personCard('Мусина Каныкей Кубанычбековна', 'Главный бухгалтер', null, 'sm'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Тараненко Татьяна Алексеевна', 'Главный агроном', null, 'sm'); ?>
                <?php personCard('Ганагина Людмила Николаевна', 'Инспектор отдела кадров', null, 'sm'); ?>
            </div>

            <!-- Подотдел: плодово-ягодные -->
            <div class="dept-sub-block">
                <div class="dept-sub-block__title">Отдел плодово-ягодных культур</div>
                <div class="hier-row hier-row--2">
                    <?php personCard('Джуманалиева Айнура Эсеналиевна', 'Старший научный сотрудник', null, 'sm'); ?>
                    <?php personCard('Тажаматова Салтанат Касымовна', 'Научный сотрудник', null, 'sm'); ?>
                </div>
            </div>

            <!-- Подотдел: сахарная свекла -->
            <div class="dept-sub-block">
                <div class="dept-sub-block__title">Отдел по сахарной свекле</div>
                <div class="hier-top">
                    <?php personCard('Качибеков Уланбек Байтилешович', 'Заведующий отделом', null, 'sm'); ?>
                </div>
                <div class="hier-row hier-row--2">
                    <?php personCard('Назарова Лайлихан Сагынбековна', 'Старший лаборант', null, 'sm'); ?>
                    <?php personCard('Есенкулова Елизавета Манапаевна', 'Старший лаборант', null, 'sm'); ?>
                </div>
            </div>
        </div>

        <!-- Жаны-Пахта -->
        <div class="dept-block">
            <div class="dept-block__title">№2 Государственное семеноводческое хозяйство Жаны-Пахта</div>
            <div class="hier-top">
                <?php personCard('Алмасбеков Кубат Алмасбекович', 'Директор', null, 'md'); ?>
            </div>
        </div>

        <!-- Хлопководство -->
        <div class="dept-block">
            <div class="dept-block__title">Кыргызская опытная станция по хлопководству</div>
            <div class="hier-top">
                <?php personCard('Матаев Маматкадыр Маматкадырович', 'Директор', null, 'md'); ?>
            </div>
            <div class="hier-row hier-row--2">
                <?php personCard('Сансызбаев Абдилла Зулпукарович', 'Главный агроном-механик', null, 'sm'); ?>
                <?php personCard('Эргешева Чынара Дарбановна', 'Главный бухгалтер', null, 'sm'); ?>
            </div>
            <div class="hier-row hier-row--3">
                <?php personCard('Тургунбаев Алимжан Ташболотович', 'Зав. отделом элиты', null, 'sm'); ?>
                <?php personCard('Маматова Карамат', 'Старший лаборант', null, 'sm'); ?>
                <?php personCard('Ысмаилова Гулзада Токтобаевна', 'Старший лаборант', null, 'sm'); ?>
            </div>
        </div>

        <!-- Иссык-Куль -->
        <div class="dept-block">
            <div class="dept-block__title">№3 Иссык-Кульская опытно-селекционная станция</div>
            <div class="hier-top">
                <?php personCard('Осмонов Дайырбек Турсунгазиевич', 'Директор', null, 'md'); ?>
            </div>
        </div>

        <!-- Нарын -->
        <div class="dept-block">
            <div class="dept-block__title">Нарынская опытная станция</div>
            <div class="hier-top">
                <?php personCard('Эралиева Асел Муканбетовна', 'Директор', null, 'md'); ?>
            </div>
        </div>

        <!-- Бургундинский -->
        <div class="dept-block">
            <div class="dept-block__title">№6 Бургундинский опорный пункт</div>
            <div class="hier-top">
                <?php personCard('Юзбаев Бахтияр Абдыхалилович', 'Директор', null, 'md'); ?>
            </div>
        </div>

        <!-- Атай -->
        <div class="dept-block">
            <div class="dept-block__title">Семеноводческое хозяйство «Атай»</div>
            <div class="hier-top">
                <?php personCard('Сакеев Жыргалбек Керимжанович', 'Директор', null, 'md'); ?>
            </div>
        </div>

        <!-- Ак-Алтын -->
        <div class="dept-block">
            <div class="dept-block__title">Семеноводческое хозяйство «Ак-Алтын»</div>
            <div class="hier-top">
                <?php personCard('Усобаев Акылбек Сатыбалдыевич', 'Директор', null, 'md'); ?>
            </div>
        </div>

    </section>

</div>
</main>

<?php include 'includes/footer.php'; ?>
