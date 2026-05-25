<?php
include_once 'includes/lang.php';
$page_title = t('page_title_history');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Заголовок и подзаголовок -->
        <div class="mb-5 text-center">
           
            <h1 class="section-title-premium text-dark mb-3">История Института Земледелия имени К.К. Азыкова</h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;">Летопись научных открытий и селекционных достижений с момента основания.</p>
        </div>

        <!-- Блок с картинкой и текстом о К.К. Азыкове (Bootstrap 5 Grid) -->
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-7 order-2 order-lg-1">
                <h3 class="mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">К.К. Азыков</h3>
                <p class="fs-5 text-muted" style="line-height: 1.8;">Калыбай Калыбекович Азыков — выдающийся учёный, внесший огромный вклад в развитие сельского хозяйства Кыргызстана. Под его руководством институт стал ведущим научным центром по вопросам селекции, агрохимии и растениеводства. Его научные труды и организационная деятельность способствовали внедрению современных технологий и повышению урожайности в республике.</p>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="about-card shadow-lg p-2 bg-white" style="border-radius: 20px;">
                    <!-- Use optimized 209KB image instead of 25MB one -->
                    <img src="assets/images/azyikov2.jpg" alt="К.К. Азыков" class="img-fluid w-100 rounded-4 shadow-sm" style="object-fit: cover; max-height: 380px;">
                </div>
            </div>
        </div>

        <!-- Основная история (Bootstrap 5 Card layout) -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 16px; background: white;">
                    <h3 class="mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('history_title'); ?></h3>
                    <p class="text-muted" style="line-height: 1.7;"><?php echo t('history_text'); ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 16px; background: white;">
                    <h3 class="mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('history_foundation_title'); ?></h3>
                    <p class="text-muted" style="line-height: 1.7;"><?php echo t('history_foundation_text'); ?></p>
                    <p class="text-muted" style="line-height: 1.7;"><?php echo t('history_foundation_more'); ?></p>
                    <p class="text-muted mb-0" style="line-height: 1.7;"><?php echo t('history_foundation_more_2'); ?></p>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; background: white;">
                    <h3 class="mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('history_achievements_title'); ?></h3>
                    <p class="text-muted mb-4"><?php echo t('history_achievements_intro'); ?></p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_1'); ?></li>
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_2'); ?></li>
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_3'); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_4'); ?></li>
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_5'); ?></li>
                                <li class="list-group-item border-0 bg-transparent text-muted">&#8226; <?php echo t('history_achievement_6'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>