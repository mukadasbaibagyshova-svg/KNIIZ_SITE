<?php
include_once 'includes/lang.php';
$page_title = t('page_title_news');
include 'includes/header.php';
?>


<main>
    <div class="container">
        <h2><?php echo t('news_title'); ?></h2>
        <p><?php echo t('news_intro'); ?></p>

        <section class="news-grid">
        <?php
        $news_file = 'database/news.json';
        $upload_dir = 'uploads/news/';
        $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];
        if ($all_news):
            foreach ($all_news as $news):
                // Краткое описание (первые 180 символов)
                $desc = mb_substr(strip_tags($news['text']), 0, 180, 'UTF-8');
                if (mb_strlen($news['text'], 'UTF-8') > 180) $desc .= '...';
                $img = !empty($news['images'][0]) ? $upload_dir . htmlspecialchars($news['images'][0]) : 'assets/images/no-image.png';
                $category = isset($news['category']) ? htmlspecialchars($news['category']) : 'Новости';
                $news_json = htmlspecialchars(json_encode($news, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
        ?>
            <div class="news-card" data-news='<?= $news_json ?>' data-upload-dir="<?= $upload_dir ?>">
                <div class="news-card-img">
                    <img src="<?= $img ?>" alt="Фото">
                </div>
                <div class="news-card-body">
                    <div class="news-card-category"><?= $category ?></div>
                    <div class="news-card-title"><?= htmlspecialchars($news['title']) ?></div>
                    <div class="news-card-desc"><?= htmlspecialchars($desc) ?></div>
                    <button class="news-more">Узнать больше</button>
                </div>
            </div>
        <?php endforeach;
        else:
            echo '<p>Пока нет новостей.</p>';
        endif;
        ?>
        </section>
    </div>
</main>

<!-- Modal/Overlay -->
<div id="news-modal-overlay" class="news-modal-overlay"></div>
<div id="news-modal" class="news-modal">
    <div class="news-modal-gallery-wrap">
        <button id="news-modal-gallery-prev" class="news-modal-gallery-nav">&#8592;</button>
        <div id="news-modal-gallery" class="news-modal-gallery"></div>
        <button id="news-modal-gallery-next" class="news-modal-gallery-nav">&#8594;</button>
    </div>
    <div class="news-modal-content">
        <button id="news-modal-close" class="news-modal-close">&times;</button>
        <div class="news-modal-title" id="news-modal-title"></div>
        <div class="news-modal-date" id="news-modal-date"></div>
        <div class="news-modal-text" id="news-modal-text"></div>
    </div>
</div>

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="assets/css/news-modal.css?v=<?php echo time(); ?>">
<script src="assets/js/news-modal.js"></script>

<?php include 'includes/footer.php'; ?>