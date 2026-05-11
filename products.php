<?php
include_once 'includes/lang.php';
$page_title = t('page_title_products');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2><?php echo t('products_title'); ?></h2>
        <p><?php echo t('products_text'); ?></p>
        
        <section style="margin-top: 30px;">
            <h3><?php echo t('products_main_title'); ?></h3>
            <div class="activities-grid">
                <div class="activity-card">
                    <h3><?php echo t('products_item_1_title'); ?></h3>
                    <p><?php echo t('products_item_1_text'); ?></p>
                </div>
                <div class="activity-card">
                    <h3><?php echo t('products_item_2_title'); ?></h3>
                    <p><?php echo t('products_item_2_text'); ?></p>
                </div>
                <div class="activity-card">
                    <h3><?php echo t('products_item_3_title'); ?></h3>
                    <p><?php echo t('products_item_3_text'); ?></p>
                </div>
                <div class="activity-card">
                    <h3><?php echo t('products_item_4_title'); ?></h3>
                    <p><?php echo t('products_item_4_text'); ?></p>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>