<?php
include_once "includes/lang.php";
$page_title = t("page_title_gallery");
$page_description = t("meta_desc_gallery");
$page_keywords = t("meta_keys_gallery");
include "includes/header.php";

// Load gallery from JSON
$gallery_file = __DIR__ . "/database/gallery.json";
$gallery_items = [];
if (is_file($gallery_file)) {
    $raw = json_decode(file_get_contents($gallery_file), true);
    $gallery_items = is_array($raw) ? $raw : [];
}
$lang = currentLang();
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            <h1 class="section-title-premium text-dark mb-3"><?php echo t(
                "gallery_title",
            ); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t(
                "gallery_text",
            ); ?></p>
        </div>

        <!-- Gallery Grid -->
        <section class="mt-5">
            <?php if (empty($gallery_items)): ?>
                <p class="text-center text-muted"><?php echo t(
                    "gallery_empty",
                    "Галерея пока пуста.",
                ); ?></p>
            <?php else: ?>
            <div class="row g-4">
                <?php foreach ($gallery_items as $item):

                    $title =
                        $item["title"][$lang] ?? ($item["title"]["ru"] ?? "");
                    $category =
                        $item["category"][$lang] ??
                        ($item["category"]["ru"] ?? "");
                    $image = htmlspecialchars($item["image"] ?? "");
                    ?>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="<?php echo $image; ?>"
                                 alt="<?php echo htmlspecialchars($title); ?>"
                                 class="w-100 h-100 object-fit-cover"
                                 style="transition: transform 0.5s ease; object-fit: cover;"
                                 loading="lazy">
                        </div>
                        <div class="p-3">
                            <?php if ($category): ?>
                            <span class="badge bg-emerald mb-2"><?php echo htmlspecialchars(
                                $category,
                            ); ?></span>
                            <?php endif; ?>
                            <h4 class="h6 mb-0 text-dark fw-bold"><?php echo htmlspecialchars(
                                $title,
                            ); ?></h4>
                        </div>
                    </div>
                </div>
                <?php
                endforeach; ?>
            </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<style>
.gallery-card {
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid rgba(12, 62, 33, 0.05);
}
.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(12, 62, 33, 0.08) !important;
}
.gallery-card:hover img {
    transform: scale(1.04);
}
.bg-emerald {
    background-color: var(--accent-color, #10b981) !important;
    color: white;
}
</style>

<?php include "includes/footer.php"; ?>
