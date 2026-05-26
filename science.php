<?php
include_once "includes/lang.php";
$page_title = t("page_title_science");
$page_description = t("meta_desc_science");
$page_keywords = t("meta_keys_science");
$page_head =
    '<link rel="stylesheet" href="assets/css/departments.css?v=' .
    time() .
    '">';
include "includes/header.php";

$dept_tags = [
    "wheat" => t("science_dept_tag_breeding"),
    "barley" => t("science_dept_tag_breeding"),
    "corn" => t("science_dept_tag_breeding"),
    "fruit_veg" => t("science_dept_tag_technology"),
    "soil" => t("science_dept_tag_soil"),
    "agrochemistry" => t("science_dept_tag_agro"),
    "sugarbeet" => t("science_dept_tag_breeding"),
];

$departments = [
    [
        "id" => "wheat",
        "title" => t("structure_detail_wheat_title"),
        "desc" => t("science_dept_desc_wheat"),
        "image" => "assets/images/wheet1.jpg",
    ],
    [
        "id" => "barley",
        "title" => t("structure_detail_barley_title"),
        "desc" => t("science_dept_desc_barley"),
        "image" => "assets/images/ячмень.jpg",
    ],
    [
        "id" => "corn",
        "title" => t("structure_detail_corn_title"),
        "desc" => t("science_dept_desc_corn"),
        "image" => "assets/images/corn.jpg",
    ],
    [
        "id" => "sugarbeet",
        "title" => t("structure_detail_sugarbeet_title"),
        "desc" => t("science_dept_desc_sugarbeet"),
        "image" => "assets/images/svekla.png",
    ],
    [
        "id" => "fruit_veg",
        "title" => t("structure_detail_fruit_veg_title"),
        "desc" => t("science_dept_desc_fruit_veg"),
        "image" => "assets/images/grape.png",
    ],
    [
        "id" => "soil",
        "title" => t("structure_detail_soil_title"),
        "desc" => t("science_dept_desc_soil"),
        "image" => "assets/images/potato.png",
    ],
    [
        "id" => "agrochemistry",
        "title" => t("structure_detail_agrochemistry_title"),
        "desc" => t("science_dept_desc_agro"),
        "image" => "assets/images/hlopok.png",
    ],
    [
        "id" => "issyk",
        "title" => t("structure_detail_issyk_title"),
        "desc" => t("science_dept_desc_issyk"),
        "image" => "assets/images/hlopoknapole.png",
    ],
];
?>

<style>
/* Modern Farm Styling for Science Page */
body {
    background-color: #ffffff;
}
.org-container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 60px 20px;
}
.org-main-card {
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    padding: 50px 30px;
    text-align: center;
    border: 1px solid rgba(0,0,0,0.04);
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}
.org-main-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 6px;
    background: #10b981;
}
.org-main-title {
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 36px;
    color: #0f172a;
    margin-bottom: 15px;
}
.org-main-subtitle {
    font-size: 18px;
    color: #64748b;
    max-width: 800px;
    margin: 0 auto;
}
.org-grid-title {
    font-family: 'Outfit', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    display: inline-block;
}
.org-grid-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: #10b981;
    border-radius: 3px;
}

/* Cards */
.org-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    border: 1px solid rgba(0,0,0,0.06);
    overflow: hidden;
    height: 100%;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
}
.org-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(16, 185, 129, 0.1);
    border-color: rgba(16, 185, 129, 0.3);
    color: inherit;
}
.org-card-img {
    width: 100%;
    height: 350px;
    object-fit: cover;
}
.org-card-body {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.org-card-title {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
}
.org-card-desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}
.org-card-btn {
    align-self: flex-start;
    font-weight: 600;
    color: #10b981;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
}
.org-card:hover .org-card-btn {
    color: #059669;
}

/* Three Columns Section */
.org-section-container {
    padding: 40px;
    background: #f8fafc;
    border-radius: 24px;
    margin-bottom: 40px;
    border: 1px solid rgba(0,0,0,0.03);
}

</style>

<main>
    <div class="org-container">

        <!-- TOP CARD: Institute Name -->
        <div class="detail-hero-card" style="display: flex; flex-wrap: wrap; background: #ffffff; border-radius: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 60px; border: 1px solid rgba(0,0,0,0.04);">
            <div class="detail-hero-image" style="flex: 1 1 50%; min-height: 400px; background: url('assets/images/hero1.jpg') center/cover;"></div>
            <div class="detail-hero-content" style="flex: 1 1 50%; padding: 60px; display: flex; flex-direction: column; justify-content: center;">
                <!-- <span class="detail-badge" style="display: inline-block; padding: 8px 16px; background: #10b981; color: #ffffff; border-radius: 30px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; align-self: flex-start;">Институт</span> -->
                <h1 class="detail-title" style="font-family: 'Outfit', sans-serif; font-size: 36px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-bottom: 20px;"><?php echo t(
                    "science_hero_title",
                ); ?></h1>
                <p class="detail-summary" style="font-size: 18px; color: #475569; line-height: 1.6; margin-bottom: 30px;"><?php echo t(
                    "science_hero_desc",
                ); ?></p>
            </div>
        </div>

        <div class="row g-5">

            <!-- Научно-исследовательские отделы -->
            <div class="col-12">
                <section class="depts-section-embed">
                    <div class="depts-toolbar">
                        <h2 class="depts-toolbar__label"><?php echo t(
                            "science_departments_title",
                        ); ?></h2>
                        <span class="depts-toolbar__count"><?php echo t(
                            "science_departments_count",
                        ); ?></span>
                    </div>
                    <div class="depts-grid">
                        <?php
                        $dept_ids = [
                            "wheat",
                            "barley",
                            "corn",
                            "sugarbeet",
                            "fruit_veg",
                            "soil",
                            "agrochemistry",
                        ];
                        $dept_index = 0;
                        foreach ($departments as $dept):

                            if (!in_array($dept["id"], $dept_ids, true)) {
                                continue;
                            }
                            $dept_index++;
                            $tag = $dept_tags[$dept["id"]] ?? "НИР";
                            ?>
                            <a href="structure-detail.php?item=<?php echo $dept[
                                "id"
                            ]; ?>&lang=<?php echo currentLang(); ?>" class="dept-card-v2">
                                <div class="dept-card-v2__media">
                                    <img src="<?php echo htmlspecialchars(
                                        $dept["image"],
                                    ); ?>" alt="" loading="lazy" decoding="async">
                                    <span class="dept-card-v2__index"><?php echo str_pad(
                                        (string) $dept_index,
                                        2,
                                        "0",
                                        STR_PAD_LEFT,
                                    ); ?></span>
                                    <span class="dept-card-v2__tag"><?php echo htmlspecialchars(
                                        $tag,
                                    ); ?></span>
                                </div>
                                <div class="dept-card-v2__body">
                                    <h3 class="dept-card-v2__title"><?php echo htmlspecialchars(
                                        $dept["title"],
                                    ); ?></h3>
                                    <p class="dept-card-v2__desc"><?php echo htmlspecialchars(
                                        $dept["desc"],
                                    ); ?></p>
                                    <span class="dept-card-v2__link">
                                        <?php echo t("science_btn_more"); ?>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </a>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </section>
            </div>

            <!-- COLUMN 3: Branches (Филиалы) -->
            <div class="col-12">
                <div class="org-section-container mt-5">
                    <div class="text-center mb-5">
                        <h2 class="org-grid-title"><?php echo t(
                            "science_branches_title",
                        ); ?></h2>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <?php
                        $lang = currentLang();
                        $branchesFile = "database/branches_{$lang}.json";
                        if (!file_exists($branchesFile)) {
                            $branchesFile = "database/branches_ru.json";
                        }
                        $regional_branches = json_decode(
                            file_get_contents($branchesFile),
                            true,
                        );
                        if (!$regional_branches) {
                            $regional_branches = [];
                        }

                        foreach ($regional_branches as $branch): ?>
                            <div class="col-lg-6 col-12">
                                <div class="org-card" style="cursor: default;">
                                    <img src="<?php echo htmlspecialchars(
                                        $branch["image"],
                                    ); ?>" alt="<?php echo htmlspecialchars(
    $branch["title"],
); ?>" class="org-card-img">
                                    <div class="org-card-body">
                                        <h3 class="org-card-title"><?php echo htmlspecialchars(
                                            $branch["title"],
                                        ); ?></h3>
                                        <div class="org-card-desc">
                                            <p class="mb-1"><strong><?php echo t(
                                                "science_branch_address",
                                            ); ?>:</strong> <?php echo htmlspecialchars(
    $branch["address"],
); ?></p>
                                            <p class="mb-1"><strong><?php echo t(
                                                "science_branch_activity",
                                            ); ?>:</strong> <?php echo htmlspecialchars(
    $branch["activity"],
); ?></p>
                                            <p class="mb-1"><strong><?php echo t(
                                                "science_branch_area",
                                            ); ?>:</strong> <?php echo htmlspecialchars(
    $branch["area"],
); ?></p>
                                            <p class="mb-1"><strong><?php echo t(
                                                "science_branch_director",
                                            ); ?>:</strong> <?php echo htmlspecialchars(
    $branch["director"],
); ?></p>
                                            <p class="mb-0"><strong><?php echo t(
                                                "science_branch_phone",
                                            ); ?>:</strong> <?php echo htmlspecialchars(
    $branch["phone"],
); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include "includes/footer.php"; ?>
