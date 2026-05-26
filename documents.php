<?php
include_once "includes/lang.php";
$page_title = t("nav_documents");
$page_description = t("meta_desc_documents");
$page_keywords = t("meta_keys_documents");
include "includes/header.php";

function getSectionFiles($subdir, array $labelKeys)
{
    $labels = array_map("t", $labelKeys);
    $dir = __DIR__ . "/assets/documents/" . $subdir;
    $paths = is_dir($dir) ? (glob($dir . "/*.pdf") ?: []) : [];
    natsort($paths);

    $files = [];
    foreach (array_values($paths) as $index => $absolutePath) {
        $filename = basename($absolutePath);
        $files[] = [
            "path" => "assets/documents/" . $subdir . "/" . $filename,
            "label" =>
                $labels[$index] ?? pathinfo($filename, PATHINFO_FILENAME),
            "filename" => $filename,
        ];
    }

    return $files;
}

$documentSections = [
    [
        "id" => "polozhenie",
        "title" => t("docs_cat_polozhenie"),
        "files" => getSectionFiles("polozhenie", [
            "docs_polozhenie_file_1",
            "docs_polozhenie_file_2",
        ]),
    ],
    [
        "id" => "postanovlenie",
        "title" => t("docs_cat_postanovlenie"),
        "files" => getSectionFiles("postanovlenie", [
            "docs_postanovlenie_file_1",
            "docs_postanovlenie_file_2",
        ]),
    ],
];
?>

<main class="py-5">
    <div class="container">
        <div class="mb-5 text-center">
            <h1 class="section-title-premium text-dark mb-3"><?php echo t(
                "nav_documents",
            ); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t(
                "docs_page_subtitle",
            ); ?></p>
        </div>

        <div class="row g-4 documents-accordion-grid">
            <?php foreach ($documentSections as $section): ?>
            <div class="col-lg-6">
                <div class="documents-accordion-item">
                    <button
                        class="documents-accordion-btn collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#doc-<?php echo $section["id"]; ?>"
                        aria-expanded="false"
                        aria-controls="doc-<?php echo $section["id"]; ?>"
                    >
                        <span class="documents-accordion-title"><?php echo htmlspecialchars(
                            $section["title"],
                        ); ?></span>
                        <span class="documents-accordion-chevron" aria-hidden="true"></span>
                    </button>
                    <div id="doc-<?php echo $section[
                        "id"
                    ]; ?>" class="collapse documents-accordion-collapse">
                        <div class="documents-accordion-body">
                            <?php if (!empty($section["files"])): ?>
                            <ul class="documents-file-list list-unstyled mb-0">
                                <?php foreach ($section["files"] as $file): ?>
                                <li>
                                    <button
                                        type="button"
                                        class="documents-file-link w-100"
                                        onclick="openPdfViewer('<?php echo htmlspecialchars(
                                            $file["path"],
                                            ENT_QUOTES,
                                        ); ?>', '<?php echo htmlspecialchars(
    $file["label"],
    ENT_QUOTES,
); ?>')"
                                    >
                                        <span class="documents-file-icon" aria-hidden="true">PDF</span>
                                        <span class="documents-file-name"><?php echo htmlspecialchars(
                                            $file["label"],
                                        ); ?></span>
                                        <span class="documents-file-action"><?php echo t(
                                            "docs_view",
                                        ); ?></span>
                                    </button>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <p class="documents-accordion-empty mb-0"><?php echo t(
                                "docs_empty",
                            ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<!-- PDF Viewer Modal -->
<div class="pdf-viewer-overlay" id="pdfViewerOverlay" role="dialog" aria-modal="true" aria-label="<?php echo t(
    "docs_viewer_title",
); ?>">
    <div class="pdf-viewer-panel">
        <div class="pdf-viewer-header">
            <span class="pdf-viewer-title" id="pdfViewerTitle"></span>
            <button type="button" class="pdf-viewer-close" onclick="closePdfViewer()" aria-label="<?php echo t(
                "docs_viewer_close",
            ); ?>">&#x2715;</button>
        </div>
        <div class="pdf-viewer-body">
            <iframe
                id="pdfViewerFrame"
                class="pdf-viewer-frame"
                src=""
                title="PDF"
                allowfullscreen
            ></iframe>
        </div>
    </div>
</div>

<script>
function openPdfViewer(path, title) {
    const overlay = document.getElementById('pdfViewerOverlay');
    const frame   = document.getElementById('pdfViewerFrame');
    const label   = document.getElementById('pdfViewerTitle');

    // #toolbar=0&navpanes=0 hides download/print toolbar in Chromium & Firefox
    frame.src = path + '#toolbar=0&navpanes=0&scrollbar=1&view=FitH';
    label.textContent = title;
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closePdfViewer() {
    const overlay = document.getElementById('pdfViewerOverlay');
    const frame   = document.getElementById('pdfViewerFrame');
    overlay.classList.remove('open');
    document.body.style.overflow = '';
    // Small delay so the iframe unloads after the animation
    setTimeout(function() { frame.src = ''; }, 300);
}

// Close on backdrop click
document.getElementById('pdfViewerOverlay').addEventListener('click', function(e) {
    if (e.target === this) closePdfViewer();
});

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePdfViewer();
});
</script>

<?php include "includes/footer.php"; ?>
