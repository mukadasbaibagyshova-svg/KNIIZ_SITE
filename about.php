<?php
include_once "includes/lang.php";
$page_title = t("page_title_about_azyikov");
include "includes/header.php";
?>

<main id="main-content" class="py-5">
    <section class="pt-5 pt-lg-6">
        <div class="container">
            <div class="mb-5 text-center">
                <h1 class="section-title-premium text-dark mb-3"><?php echo t("page_title_about_azyikov"); ?></h1>
                <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 900px; line-height: 1.8;">
                    <?php echo t("azyikov_page_subtitle"); ?>
                </p>
            </div>


            <!-- Верхний блок: основной текст + портрет -->
            <div class="row g-4 align-items-start mb-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                        <?php foreach (explode("\n\n", t("about_azyikov_top_text")) as $paragraph): ?>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo nl2br(htmlspecialchars($paragraph)); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                        <img src="assets/images/azyikov2.jpg" alt="<?php echo t("about_azyikov_portrait_alt"); ?>" class="img-fluid rounded-4">
                    </div>
                </div>
            </div>

            <!-- Отдельный блок: фото слева, текст справа -->
            <div class="row g-4 align-items-start mb-4">
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                        <!-- Фото 2: замените src на путь ко второй фотографии -->
                        <img src="assets/images/история азыков 2.png" alt="<?php echo t("about_azyikov_history1_alt"); ?>" class="img-fluid w-100 rounded-4">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                        <?php foreach (explode("\n\n", t("about_azyikov_block1_text")) as $paragraph): ?>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo nl2br(htmlspecialchars($paragraph)); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Отдельный блок: текст слева, фото справа -->
            <div class="row g-4 align-items-start mb-4">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                        <?php foreach (explode("\n\n", t("about_azyikov_block2_text")) as $paragraph): ?>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo nl2br(htmlspecialchars($paragraph)); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                        <!-- Фото 3: замените src на путь к третьей фотографии -->
                        <img src="assets/images/история азыков 3.png" alt="<?php echo t("about_azyikov_history2_alt"); ?>" class="img-fluid w-100 rounded-4">
                    </div>
                </div>
            </div>

            <!-- Оставшийся текст снизу -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                        <?php foreach (explode("\n\n", t("about_azyikov_bottom_text")) as $paragraph): ?>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo nl2br(htmlspecialchars($paragraph)); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Видео об Азыкове -->
            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <a href="https://youtu.be/Pdx1gM3ZuiU?si=0Cr-DL5c-2lLUHdP" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px; background: #fff;">
                            <div class="row g-0 align-items-center">
                                <div class="col-lg-5">
                                    <div class="position-relative">
                                        <img src="https://img.youtube.com/vi/Pdx1gM3ZuiU/hqdefault.jpg" alt="<?php echo t("azyikov_video_alt"); ?>" class="img-fluid w-100" style="display: block;">
                                        <div class="position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center" style="width: 74px; height: 74px; border-radius: 50%; background: rgba(255, 0, 0, 0.92); box-shadow: 0 12px 30px rgba(0,0,0,0.25);">
                                            <span style="width: 0; height: 0; border-top: 16px solid transparent; border-bottom: 16px solid transparent; border-left: 24px solid #fff; margin-left: 5px;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-4 p-lg-5">
                                        <span class="badge rounded-pill px-3 py-2 mb-3" style="background: rgba(255, 0, 0, 0.10); color: #c1121f; font-size: 14px;"><?php echo t("azyikov_video_badge"); ?></span>
                                        <h2 class="mb-3" style="font-size: 1.8rem; color: var(--primary-color);"><?php echo t("azyikov_video_title"); ?></h2>
                                        <p class="text-muted mb-3" style="line-height: 1.8;">
                                            <?php echo t("azyikov_video_desc"); ?>
                                        </p>
                                        <span class="btn-premium btn-premium-accent"><?php echo t("azyikov_video_btn"); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.php"; ?>
