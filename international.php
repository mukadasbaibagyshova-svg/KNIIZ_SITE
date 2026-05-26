<?php
include_once 'includes/lang.php';
$page_title = t('nav_international');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('nav_international'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;">Международное сотрудничество и партнерства Институт</p>
        </div>

        <!-- Partnership Sections -->
        <div class="row g-4 mt-3">
            <!-- Section 1 -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Международные партнеры</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary">Глобальная организация по продовольствию и сельскому хозяйству (ФАО)</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary">CGIAR - Консультативная группа по международным сельскохозяйственным исследованиям</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary">Ведущие университеты и научные центры мира</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary">Региональные сельскохозяйственные организации</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Направления сотрудничества</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary">Обмен научными знаниями и технологиями</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary">Совместные исследовательские проекты</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary">Обучение и повышение квалификации</span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary">Участие в международных конференциях и семинарах</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="mt-5">
            <h2 class="h4 mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Последние проекты</h2>
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 20px;">
                <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Глобальная программа ФАО "Доктора для почв"</h3>
                <p class="text-secondary mb-0">Институт активно участвует в реализации глобальной программы ФАО, направленной на устойчивое управление почвенными ресурсами и повышение плодородия земель в Кыргызстане.</p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-5 p-4 bg-light" style="border-radius: 20px;">
            <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">Заинтересованы в сотрудничестве?</h3>
            <p class="text-secondary mb-3">Институт открыт для новых партнерств и сотрудничества с международными организациями, научными центрами и образовательными учреждениями.</p>
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent" style="padding: 10px 20px;">Свяжитесь с нами</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
