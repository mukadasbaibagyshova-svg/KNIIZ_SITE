<?php
include_once 'includes/lang.php';
$page_title = t('page_title_news');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2><?php echo t('news_title'); ?></h2>
        <p><?php echo t('news_intro'); ?></p>
        
        <section style="margin-top: 30px;">
            <article class="news-item" style="border-bottom: 1px solid #ddd; padding-bottom: 20px; margin-bottom: 20px;">
                <h3><?php echo t('news_article_1_title'); ?></h3>
                <p><small><?php echo t('news_article_1_date'); ?></small></p>
                <p><?php echo t('news_article_1_text'); ?></p>
            </article>

            <article class="news-item" style="border-bottom: 1px solid #ddd; padding-bottom: 20px; margin-bottom: 20px;">
                <h3><?php echo t('news_article_2_title'); ?></h3>
                <p><small><?php echo t('news_article_2_date'); ?></small></p>
                <p><?php echo t('news_article_2_text'); ?></p>
            </article>

            <article class="news-item" style="padding-bottom: 20px;">
                <h3><?php echo t('news_article_3_title'); ?></h3>
                <p><small><?php echo t('news_article_3_date'); ?></small></p>
                <p><?php echo t('news_article_3_text'); ?></p>
            </article>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>