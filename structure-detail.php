<?php
include_once "includes/lang.php";

function getInitials($fullName)
{
    $parts = explode(" ", trim($fullName));
    $initials = "";
    if (isset($parts[0])) {
        $initials .= mb_substr($parts[0], 0, 1, "UTF-8");
    }
    if (isset($parts[1])) {
        $initials .= mb_substr($parts[1], 0, 1, "UTF-8");
    }
    return mb_strtoupper($initials, "UTF-8");
}

$page_title = t("page_title_structure");
$page_head =
    '<link rel="stylesheet" href="assets/css/dept-detail.css?v=' .
    time() .
    '">';
include "includes/header.php";

function deptSplitSentences($text)
{
    $text = trim((string) $text);
    if ($text === "") {
        return [];
    }
    $parts = preg_split("/(?<=[.!?…])\s+/u", $text, -1, PREG_SPLIT_NO_EMPTY);
    return $parts ?: [$text];
}

function deptTrimListItem($item)
{
    return rtrim(trim((string) $item), ";.");
}

$lang = currentLang();
$jsonFile = "database/structure_{$lang}.json";
if (!file_exists($jsonFile)) {
    $jsonFile = "database/structure_ru.json";
}
$structureDetails = json_decode(file_get_contents($jsonFile), true);
$ruStructureDetails = json_decode(
    file_get_contents("database/structure_ru.json"),
    true,
);

if (!$structureDetails) {
    $structureDetails = [];
}
if (!$ruStructureDetails) {
    $ruStructureDetails = [];
}

$itemId = $_GET["item"] ?? "";
if (
    !isset($structureDetails[$itemId]) &&
    !isset($ruStructureDetails[$itemId])
) {
    header("Location: science.php?lang=" . currentLang());
    exit();
}

$detail = $structureDetails[$itemId] ?? $ruStructureDetails[$itemId];
$introImage = $detail["intro_image"] ?? ($detail["hero_image"] ?? "");
$introSentences = deptSplitSentences($detail["summary"] ?? "");
if (!empty($detail["activity"])) {
    $introSentences = array_merge(
        $introSentences,
        deptSplitSentences($detail["activity"]),
    );
}
$researchIcons = ["🧬", "🛡️", "🌐", "🌾", "📋", "🔬", "🧪", "📊"];
?>

<main class="dept-detail-page" id="main-content">
<div class="dept-main-content">

    <div class="dept-page-header sd-reveal">
        <!-- <a href="science.php?lang=<?php echo currentLang(); ?>" class="dept-back-link">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            <?php echo t("structure_detail_back"); ?>
        </a> -->
        <?php if (!empty($detail["badge"])): ?>
            <!-- <span class="section-tag"><?php echo htmlspecialchars(
                $detail["badge"],
            ); ?></span> -->
        <?php endif; ?>
        <h1 class="section-title-premium text-dark mb-0"><?php echo t(
            $detail["title"],
        ); ?></h1>
    </div>

    <!-- Краткое описание + фото -->
    <?php if (!empty($introSentences) || $introImage): ?>
    <section class="dept-section dept-intro-section sd-reveal">
        <h2 class="dept-section-title" id="dept-intro-heading"><?php echo t(
            "structure_detail_intro",
        ); ?></h2>
        <div class="dept-intro-grid">
        <div class="dept-intro-text-col">
            <?php foreach ($introSentences as $sentence):

                $clean = deptTrimListItem($sentence);
                if (!preg_match('/[.!?…]$/u', $clean)) {
                    $clean .= ".";
                }
                ?>
                <p class="dept-intro-text"><?php echo htmlspecialchars(
                    $clean,
                ); ?></p>
            <?php
            endforeach; ?>
        </div>
        <div class="dept-intro-photo-col">
            <?php if (!empty($introImage) && file_exists($introImage)): ?>
                <img src="<?php echo htmlspecialchars(
                    $introImage,
                ); ?>" alt="<?php echo htmlspecialchars(
    t($detail["title"]),
); ?>">
            <?php else: ?>
                <div class="dept-intro-photo-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <circle cx="8.5" cy="10" r="1.5" fill="currentColor" stroke="none"/>
                        <path d="M3 16l5-5 4 4 5-6 4 7"/>
                    </svg>
                    <span><?php echo t(
                        "structure_detail_photo_placeholder",
                    ); ?></span>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Руководители и сотрудники -->
    <?php if (!empty($detail["head"]) || !empty($detail["staff"])): ?>
    <section class="dept-section dept-staff-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_staff_title",
        ); ?></h2>
        <div class="dept-staff-grid">
            <?php
            $renderedStaff = [];
            if (!empty($detail["head"])):

                $head = $detail["head"];
                $renderedStaff[] = $head["name"];
                $headInitials = getInitials($head["name"]);
                ?>
                <article class="dept-staff-card is-head">
                    <?php if (
                        !empty($head["image"]) &&
                        file_exists($head["image"])
                    ): ?>
                        <img src="<?php echo htmlspecialchars(
                            $head["image"],
                        ); ?>" alt="" class="dept-staff-avatar">
                    <?php else: ?>
                        <div class="dept-staff-initials"><?php echo htmlspecialchars(
                            $headInitials,
                        ); ?></div>
                    <?php endif; ?>
                    <div class="dept-staff-name"><?php echo htmlspecialchars(
                        $head["name"],
                    ); ?></div>
                    <div class="dept-staff-position"><?php echo htmlspecialchars(
                        $head["position"],
                    ); ?></div>
                    <?php if (
                        !empty($head["degree"]) ||
                        !empty($head["honors"])
                    ): ?>
                        <div class="dept-staff-meta"><?php echo htmlspecialchars(
                            implode(
                                " • ",
                                array_filter([
                                    $head["degree"] ?? "",
                                    $head["honors"] ?? "",
                                ]),
                            ),
                        ); ?></div>
                    <?php endif; ?>
                    <span class="dept-staff-badge"><?php echo t(
                        "structure_detail_head",
                    ); ?></span>
                </article>
            <?php
            endif;
            ?>

            <?php if (!empty($detail["staff"])):
                foreach ($detail["staff"] as $member):

                    if (in_array($member["name"], $renderedStaff, true)) {
                        continue;
                    }
                    $renderedStaff[] = $member["name"];
                    $memberInitials = getInitials($member["name"]);
                    $isHead =
                        !empty($detail["head"]["name"]) &&
                        $member["name"] === $detail["head"]["name"];
                    ?>
                <article class="dept-staff-card<?php echo $isHead
                    ? " is-head"
                    : ""; ?>">
                    <?php if (
                        !empty($member["image"]) &&
                        file_exists($member["image"])
                    ): ?>
                        <img src="<?php echo htmlspecialchars(
                            $member["image"],
                        ); ?>" alt="" class="dept-staff-avatar">
                    <?php else: ?>
                        <div class="dept-staff-initials"><?php echo htmlspecialchars(
                            $memberInitials,
                        ); ?></div>
                    <?php endif; ?>
                    <div class="dept-staff-name"><?php echo htmlspecialchars(
                        $member["name"],
                    ); ?></div>
                    <div class="dept-staff-position"><?php echo htmlspecialchars(
                        $member["position"],
                    ); ?></div>
                    <?php
                    $meta = [];
                    if (
                        !empty($member["degree"]) &&
                        $member["degree"] !== "нет" &&
                        $member["degree"] !== "none" &&
                        $member["degree"] !== "жок"
                    ) {
                        $meta[] = $member["degree"];
                    }
                    if (!empty($member["experience"])) {
                        $meta[] =
                            t("structure_detail_experience") .
                            " " .
                            $member["experience"] .
                            " " .
                            t("structure_detail_years");
                    }
                    if ($meta): ?>
                        <div class="dept-staff-meta"><?php echo htmlspecialchars(
                            implode(" • ", $meta),
                        ); ?></div>
                    <?php endif;
                    ?>
                </article>
            <?php
                endforeach;
            endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Основные направления исследований — карточки -->
    <?php if (!empty($detail["research"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_research_title",
        ); ?></h2>
        <div class="dept-research-grid">
            <?php foreach ($detail["research"] as $i => $item): ?>
                <article class="dept-research-card">
                    <div class="dept-research-icon" aria-hidden="true"><?php echo $researchIcons[
                        $i % count($researchIcons)
                    ]; ?></div>
                    <p class="dept-research-label"><?php echo htmlspecialchars(
                        deptTrimListItem($item),
                    ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Ключевые результаты — карточки -->
    <?php
    $hasResults = !empty($detail["results_list"]) || !empty($detail["results"]);
    if ($hasResults): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_results_title",
        ); ?></h2>
        <?php if (!empty($detail["results_list"])): ?>
            <div class="dept-results-grid">
                <?php foreach ($detail["results_list"] as $item): ?>
                    <article class="dept-result-card">
                        <div class="dept-result-card__icon" aria-hidden="true">✓</div>
                        <p class="dept-result-card__text"><?php echo htmlspecialchars(
                            deptTrimListItem($item),
                        ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dept-section-text"><?php echo $detail[
                "results"
            ]; ?></div>
        <?php endif; ?>
    </section>
    <?php endif;
    ?>

    <!-- Международные проекты — карточка -->
    <?php
    $hasProjects =
        !empty($detail["international"]) ||
        !empty($detail["projects_current"]) ||
        !empty($detail["projects_completed"]);
    if ($hasProjects): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_international_title",
        ); ?></h2>
        <div class="dept-feature-cards">
            <?php if (!empty($detail["international"])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">🌍</div>
                    <div class="dept-feature-card__body">
                        <h3><?php echo t(
                            "structure_detail_international_coop",
                        ); ?></h3>
                        <p><?php echo htmlspecialchars(
                            $detail["international"],
                        ); ?></p>
                    </div>
                </article>
            <?php endif; ?>
            <?php if (!empty($detail["projects_current"])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">📌</div>
                    <div class="dept-feature-card__body">
                        <h3><?php echo t(
                            "structure_detail_projects_current",
                        ); ?></h3>
                        <p><?php echo htmlspecialchars(
                            $detail["projects_current"],
                        ); ?></p>
                    </div>
                </article>
            <?php endif; ?>
            <?php if (!empty($detail["projects_completed"])): ?>
                <article class="dept-feature-card dept-feature-card--intl">
                    <div class="dept-feature-card__icon" aria-hidden="true">✅</div>
                    <div class="dept-feature-card__body">
                        <h3><?php echo t(
                            "structure_detail_projects_completed",
                        ); ?></h3>
                        <p><?php echo htmlspecialchars(
                            $detail["projects_completed"],
                        ); ?></p>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </section>
    <?php endif;
    ?>

    <!-- Публикации — карточка -->
    <?php if (!empty($detail["publications"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_publications_title",
        ); ?></h2>
        <div class="dept-feature-cards">
            <article class="dept-feature-card dept-feature-card--pub">
                <div class="dept-feature-card__icon" aria-hidden="true">📚</div>
                <div class="dept-feature-card__body">
                    <h3><?php echo t(
                        "structure_detail_publications_desc",
                    ); ?></h3>
                    <p><?php echo htmlspecialchars(
                        $detail["publications"],
                    ); ?></p>
                </div>
            </article>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail["goals"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_goals_title",
        ); ?></h2>
        <ul class="dept-list">
            <?php foreach ($detail["goals"] as $item): ?>
                <li><?php echo htmlspecialchars(
                    deptTrimListItem($item),
                ); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail["perspectives"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_perspectives_title",
        ); ?></h2>
        <div class="dept-section-text"><?php echo nl2br(
            htmlspecialchars($detail["perspectives"]),
        ); ?></div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail["services"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_services_title",
        ); ?></h2>
        <div class="dept-research-grid">
            <?php foreach ($detail["services"] as $i => $item): ?>
                <article class="dept-research-card">
                    <div class="dept-research-icon" aria-hidden="true"><?php echo $researchIcons[
                        $i % count($researchIcons)
                    ]; ?></div>
                    <p class="dept-research-label"><?php echo htmlspecialchars(
                        deptTrimListItem($item),
                    ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail["events"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_events_title",
        ); ?></h2>
        <div class="dept-section-text"><?php echo htmlspecialchars(
            $detail["events"],
        ); ?></div>
    </section>
    <?php endif; ?>

    <?php if (!empty($detail["infrastructure"])): ?>
    <section class="dept-section sd-reveal">
        <h2 class="dept-section-title"><?php echo t(
            "structure_detail_infrastructure_title",
        ); ?></h2>
        <div class="dept-section-text"><?php echo htmlspecialchars(
            $detail["infrastructure"],
        ); ?></div>
    </section>
    <?php endif; ?>

    <!-- ==================== CTA ==================== -->
    <div class="dept-cta-section sd-reveal">
        <h3><?php echo t("structure_detail_cta_title"); ?></h3>
        <p><?php echo t("structure_detail_cta_desc"); ?></p>
        <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="dept-cta-btn">
            <?php echo t("structure_detail_cta_btn"); ?> &rarr;
        </a>
    </div>

</div>
</main>

<!-- ==================== Scroll Reveal Script ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.sd-reveal');

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('sd-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

    reveals.forEach(function(el) {
        observer.observe(el);
    });
});
</script>

<?php include "includes/footer.php"; ?>
