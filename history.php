<?php
include_once 'includes/lang.php';
$page_title = t('page_title_history');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2><?php echo t('history_title'); ?></h2>
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