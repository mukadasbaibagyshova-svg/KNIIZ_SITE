<?php
include_once 'includes/lang.php';
$page_title = t('page_title_science');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2><?php echo t('science_title'); ?></h2>
        <p><?php echo t('science_intro'); ?></p>
        
        <section style="margin-top: 30px;">
            <h3><?php echo t('science_direction_title'); ?></h3>
            <ul style="margin-left: 20px;">
                <li><?php echo t('science_direction_1'); ?></li>
                <li><?php echo t('science_direction_2'); ?></li>
                <li><?php echo t('science_direction_3'); ?></li>
                <li><?php echo t('science_direction_4'); ?></li>
                <li><?php echo t('science_direction_5'); ?></li>
            </ul>
        </section>

        <section style="margin-top: 30px;">
            <h3><?php echo t('science_publications_title'); ?></h3>
            <p><?php echo t('science_publications_text'); ?></p>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>