<?php
include_once 'includes/lang.php';
$page_title = t('page_title_history');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <!-- Заголовок и подзаголовок -->
        <h2 style="margin-bottom: 10px; color: #216c3d;">История Кыргызского научно-исследовательского института земледелия имени К.К. Азыкова</h2>
        <h4 style="margin-top: 0; color: #4b7c4b; font-weight: 400;">...</h4>

        <!-- Блок с картинкой и текстом о К.К. Азыкове -->
        <div style="display: flex; flex-wrap: wrap; align-items: flex-start; margin-top: 30px; margin-bottom: 40px;">
            <div style="flex: 1 1 250px; min-width: 220px; max-width: 400px; order: 2; text-align: right;">
                <img src="assets/images/azyikov.jpg" alt="К.К. Азыков" style="max-width: 100%; border-radius: 12px; box-shadow: 0 2px 8px #0002;">
            </div>
            <div style="flex: 2 1 300px; min-width: 220px; margin-right: 30px; order: 1;">
                <h3 style="margin-top: 0; color: #216c3d;">К.К. Азыков</h3>
                <p style="font-size: 1.1em;">Калыбай Калыбекович Азыков — выдающийся учёный, внесший огромный вклад в развитие сельского хозяйства Кыргызстана. Под его руководством институт стал ведущим научным центром по вопросам селекции, агрохимии и растениеводства. Его научные труды и организационная деятельность способствовали внедрению современных технологий и повышению урожайности в республике.</p>
            </div>
        </div>


        <!-- Основная история -->
        <h3><?php echo t('history_title'); ?></h3>
        <p><?php echo t('history_text'); ?></p>

        <section style="margin-top: 30px;">
            <h3><?php echo t('history_foundation_title'); ?></h3>
            <p><?php echo t('history_foundation_text'); ?></p>
            <p><?php echo t('history_foundation_more'); ?></p>
            <p><?php echo t('history_foundation_more_2'); ?></p>
        </section>

        <section style="margin-top: 30px;">
            <h3><?php echo t('history_achievements_title'); ?></h3>
            <p><?php echo t('history_achievements_intro'); ?></p>
            <ul style="margin-left: 20px;">
                <li><?php echo t('history_achievement_1'); ?></li>
                <li><?php echo t('history_achievement_2'); ?></li>
                <li><?php echo t('history_achievement_3'); ?></li>
                <li><?php echo t('history_achievement_4'); ?></li>
                <li><?php echo t('history_achievement_5'); ?></li>
                <li><?php echo t('history_achievement_6'); ?></li>
            </ul>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>