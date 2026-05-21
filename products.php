<?php
include_once 'includes/lang.php';
$page_title = t('page_title_products');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            <span class="section-tag"><?php echo t('nav_products'); ?></span>
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('products_title'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t('products_text'); ?></p>
        </div>
        
        <section class="mt-5">
            <h3 class="mb-4 text-center" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('products_main_title'); ?></h3>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 20px; transition: transform 0.3s ease;">
                        <div class="fs-1 mb-3">🌾</div>
                        <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('products_item_1_title'); ?></h3>
                        <p class="text-muted small mb-0"><?php echo t('products_item_1_text'); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 20px; transition: transform 0.3s ease;">
                        <div class="fs-1 mb-3">🌱</div>
                        <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('products_item_2_title'); ?></h3>
                        <p class="text-muted small mb-0"><?php echo t('products_item_2_text'); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 20px; transition: transform 0.3s ease;">
                        <div class="fs-1 mb-3">🧪</div>
                        <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('products_item_3_title'); ?></h3>
                        <p class="text-muted small mb-0"><?php echo t('products_item_3_text'); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 20px; transition: transform 0.3s ease;">
                        <div class="fs-1 mb-3">📚</div>
                        <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('products_item_4_title'); ?></h3>
                        <p class="text-muted small mb-0"><?php echo t('products_item_4_text'); ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.card:hover {
    transform: translateY(-5px);
}
</style>

<?php include 'includes/footer.php'; ?>