<?php
include_once "includes/lang.php";
$page_title = t("nav_international");
$page_description = t("meta_desc_international");
$page_keywords = t("meta_keys_international");
include "includes/header.php";
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">

            <h1 class="section-title-premium text-dark mb-3"><?php echo t(
                "nav_international",
            ); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t("intl_subtitle"); ?></p>
        </div>

        <!-- Partnership Sections -->
        <div class="row g-4 mt-3">
            <!-- Section 1 -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t("intl_partners_title"); ?></h3>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary"><?php echo t("intl_partners_fao"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary"><?php echo t("intl_partners_cgiar"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary"><?php echo t("intl_partners_universities"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">✓</span>
                            <span class="text-secondary"><?php echo t("intl_partners_regional"); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">
                        <?php echo t("intl_directions_title"); ?>
                    </h3>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary"><?php echo t("intl_direction_1"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary"><?php echo t("intl_direction_2"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary"><?php echo t("intl_direction_3"); ?></span>
                        </li>
                        <li class="mb-2" style="padding-left: 20px; position: relative;">
                            <span style="position: absolute; left: 0;">→</span>
                            <span class="text-secondary"><?php echo t("intl_direction_4"); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="mt-5">
            <h2 class="h4 mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">
                <?php echo t("intl_projects_title"); ?>
            </h2>
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 20px;">
                <h3 class="h5 mb-2" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">
                    <?php echo t("intl_fao_project"); ?>
                </h3>
                <p class="text-secondary mb-0"><?php echo t("intl_fao_desc"); ?></p>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-5 p-4 bg-light" style="border-radius: 20px;">
            <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);">
                <?php echo t("intl_contact_title"); ?>
            </h3>
            <p class="text-secondary mb-3"><?php echo t("intl_contact_desc"); ?></p>
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="btn-premium btn-premium-accent" style="padding: 10px 20px;">
                <?php echo t("intl_contact_btn"); ?>
            </a>
        </div>
    </div>
</main>

<?php include "includes/footer.php"; ?>
