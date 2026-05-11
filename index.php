<?php
include_once 'includes/lang.php';
$page_title = t('page_title_home');
include 'includes/header.php';
?>

<section class="hero">
    <div class="overlay">
        <h1><?php echo t('hero_title'); ?></h1>
        <p><?php echo t('hero_text'); ?></p>
        <a href="history.php?lang=<?php echo currentLang(); ?>" class="hero-btn"><?php echo t('hero_button_more'); ?></a>
    </div>
</section>

<section class="about-section">
    <div class="container about-grid">
        <div class="about-text">
            <h2><?php echo t('about_title'); ?></h2>
            <p><?php echo t('about_text'); ?></p>

            <div class="stats-grid">
                <div class="stat-card">
                    <strong>120+</strong>
                    <span><?php echo t('stats_projects'); ?></span>
                </div>
                <div class="stat-card">
                    <strong>10</strong>
                    <span><?php echo t('stats_experience'); ?></span>
                </div>
                <div class="stat-card">
                    <strong>5</strong>
                    <span><?php echo t('stats_stations'); ?></span>
                </div>
            </div>

            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="hero-btn"><?php echo t('hero_button_contact'); ?></a>
        </div>
        <div class="about-image">
            <img src="assets/images/about-us.svg" alt="<?php echo t('about_title'); ?>" />
        </div>
    </div>
</section>

<section class="goals-section">
    <div class="container">
        <h2 class="section-title"><?php echo t('goals_title'); ?></h2>
        <div class="feature-grid">
            <article class="feature-card">
                <h3><?php echo t('goal_research_title'); ?></h3>
                <p><?php echo t('goal_research_text'); ?></p>
            </article>
            <article class="feature-card">
                <h3><?php echo t('goal_planning_title'); ?></h3>
                <p><?php echo t('goal_planning_text'); ?></p>
            </article>
            <article class="feature-card">
                <h3><?php echo t('goal_support_title'); ?></h3>
                <p><?php echo t('goal_support_text'); ?></p>
            </article>
        </div>
    </div>
</section>

<section class="stations-section">
    <div class="container">
        <h2 class="section-title"><?php echo t('stations_title'); ?></h2>
        <div class="stations-row">
            <div class="stations-card">
                <h3><?php echo t('stations_direction_title'); ?></h3>
                <ul>
                    <li><?php echo t('stations_direction_1'); ?></li>
                    <li><?php echo t('stations_direction_2'); ?></li>
                    <li><?php echo t('stations_direction_3'); ?></li>
                    <li><?php echo t('stations_direction_4'); ?></li>
                </ul>
            </div>
            <div class="stations-card">
                <h3><?php echo t('stations_sites_title'); ?></h3>
                <p><?php echo t('stations_sites_text'); ?></p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>