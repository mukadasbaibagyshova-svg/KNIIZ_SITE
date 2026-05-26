<?php
include_once "includes/lang.php";
$page_title = t("page_title_history");
$page_description = t("meta_desc_history");
$page_keywords = t("meta_keys_history");
include "includes/header.php";
?>

<main id="main-content" class="py-5">
    <section class="pt-5 pt-lg-6">
        <div class="container">
            <div class="mb-5 text-center">
                <h1 class="section-title-premium text-dark mb-3"><?php echo t("history_title"); ?></h1>
                <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 880px; line-height: 1.8;">
                    <?php echo t("history_page_subtitle"); ?>
                </p>
            </div>

            <div class="d-flex flex-column gap-4">
                <!-- Блок 1: картинка слева, текст справа -->
                <section class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                            <img src="assets/images/история картинка 1.png" alt="<?php echo t("history_title"); ?>" class="img-fluid w-100 rounded-4">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                            <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                                <span class="badge rounded-pill px-3 py-2" style="background: var(--primary-color); color: #fff; font-size: 14px;"><?php echo t("history_block1_year"); ?></span>
                                <span style="color: var(--accent-color); font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; font-size: 12px;"><?php echo t("history_block1_tag"); ?></span>
                            </div>
                            <h2 class="mb-3" style="font-size: 2rem;"><?php echo t("history_block1_title"); ?></h2>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo t("history_foundation_text"); ?>
                            </p>
                            <p class="text-muted mb-0" style="line-height: 1.9;">
                                <?php echo t("history_foundation_more"); ?>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Блок 2: текст слева, картинка справа -->
                <section class="row g-4 align-items-start">
                    <div class="col-lg-7 order-2 order-lg-1">
                        <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                            <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                                <span class="badge rounded-pill px-3 py-2" style="background: var(--primary-color); color: #fff; font-size: 14px;"><?php echo t("history_block2_year"); ?></span>
                                <span style="color: var(--accent-color); font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; font-size: 12px;"><?php echo t("history_block2_tag"); ?></span>
                            </div>
                            <h2 class="mb-3" style="font-size: 2rem;"><?php echo t("history_block2_title"); ?></h2>
                            <p class="text-muted mb-0" style="line-height: 1.9;">
                                <?php echo t("history_foundation_more_2"); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                            <img src="assets/images/история картинка 2.png" alt="<?php echo t("history_block2_title"); ?>" class="img-fluid w-100 rounded-4">
                        </div>
                    </div>
                </section>

                <!-- Блок 3: картинка слева, текст справа -->
                <section class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 24px; background: #fff;">
                            <img src="assets/images/история картинка 3.png" alt="<?php echo t("history_block3_title"); ?>" class="img-fluid w-100 rounded-4">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px; background: #fff;">
                            <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                                <span class="badge rounded-pill px-3 py-2" style="background: var(--primary-color); color: #fff; font-size: 14px;"><?php echo t("history_block3_year"); ?></span>
                                <span style="color: var(--accent-color); font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; font-size: 12px;"><?php echo t("history_block3_tag"); ?></span>
                            </div>
                            <h2 class="mb-3" style="font-size: 2rem;"><?php echo t("history_block3_title"); ?></h2>
                            <p class="text-muted mb-3" style="line-height: 1.9;">
                                <?php echo t("history_achievements_intro"); ?>
                            </p>
                            <ul class="text-muted mb-0" style="line-height: 1.9; padding-left: 18px;">
                                <li><?php echo t("history_achievement_1"); ?></li>
                                <li><?php echo t("history_achievement_2"); ?></li>
                                <li><?php echo t("history_achievement_3"); ?></li>
                                <li><?php echo t("history_achievement_4"); ?></li>
                                <li><?php echo t("history_achievement_5"); ?></li>
                                <li><?php echo t("history_achievement_6"); ?></li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.php"; ?>
