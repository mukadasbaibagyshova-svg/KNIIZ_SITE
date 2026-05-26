<?php
include_once 'includes/lang.php';
$page_title = t('nav_documents');
include 'includes/header.php';

function getSectionFiles($subdir, array $labelKeys) {
    $labels = array_map('t', $labelKeys);
    $dir = __DIR__ . '/assets/documents/' . $subdir;
    $paths = is_dir($dir) ? (glob($dir . '/*.pdf') ?: []) : [];
    natsort($paths);

    $files = [];
    foreach (array_values($paths) as $index => $absolutePath) {
        $filename = basename($absolutePath);
        $files[] = [
            'path' => 'assets/documents/' . $subdir . '/' . $filename,
            'label' => $labels[$index] ?? pathinfo($filename, PATHINFO_FILENAME),
            'filename' => $filename,
        ];
    }

    return $files;
}

$documentSections = [
    [
        'id' => 'polozhenie',
        'title' => t('docs_cat_polozhenie'),
        'files' => getSectionFiles('polozhenie', ['docs_polozhenie_file_1', 'docs_polozhenie_file_2']),
    ],
    [
        'id' => 'postanovlenie',
        'title' => t('docs_cat_postanovlenie'),
        'files' => getSectionFiles('postanovlenie', ['docs_postanovlenie_file_1', 'docs_postanovlenie_file_2']),
    ],
];
?>

<main class="py-5">
    <div class="container">
        <div class="mb-5 text-center">
            
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('nav_documents'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t('docs_page_subtitle'); ?></p>
        </div>

        <div class="row g-4 documents-accordion-grid">
            <?php foreach ($documentSections as $section): ?>
            <div class="col-lg-6">
                <div class="documents-accordion-item">
                    <button
                        class="documents-accordion-btn collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#doc-<?php echo $section['id']; ?>"
                        aria-expanded="false"
                        aria-controls="doc-<?php echo $section['id']; ?>"
                    >
                        <span class="documents-accordion-title"><?php echo htmlspecialchars($section['title']); ?></span>
                        <span class="documents-accordion-chevron" aria-hidden="true"></span>
                    </button>
                    <div id="doc-<?php echo $section['id']; ?>" class="collapse documents-accordion-collapse">
                        <div class="documents-accordion-body">
                            <?php if (!empty($section['files'])): ?>
                            <ul class="documents-file-list list-unstyled mb-0">
                                <?php foreach ($section['files'] as $file): ?>
                                <li>
                                    <a
                                        href="<?php echo htmlspecialchars($file['path']); ?>"
                                        class="documents-file-link"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <span class="documents-file-icon" aria-hidden="true">PDF</span>
                                        <span class="documents-file-name"><?php echo htmlspecialchars($file['label']); ?></span>
                                        <span class="documents-file-action"><?php echo t('docs_open'); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <p class="documents-accordion-empty mb-0"><?php echo t('docs_empty'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
