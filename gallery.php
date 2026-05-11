<?php
include_once 'includes/lang.php';
$page_title = t('page_title_gallery');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2><?php echo t('gallery_title'); ?></h2>
        <p><?php echo t('gallery_text'); ?></p>
        
        <section style="margin-top: 30px;">
            <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 1]</p>
                </div>
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 2]</p>
                </div>
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 3]</p>
                </div>
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 4]</p>
                </div>
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 5]</p>
                </div>
                <div class="gallery-item" style="background: #e0e0e0; padding: 40px; text-align: center; border-radius: 8px;">
                    <p>[<?php echo t('gallery_title'); ?> 6]</p>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>