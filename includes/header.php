<?php
include_once __DIR__ . '/lang.php';
$currentFile = basename($_SERVER['SCRIPT_NAME']);
function navClass($file) {
    global $currentFile;
    return $currentFile === $file ? 'nav-link active' : 'nav-link';
}
$languageOptions = getLanguages();
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(currentLang()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . t('logo') : t('logo'); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if (!empty($page_head)) { echo $page_head; } ?>
</head>
<body>

<header>
    <div class="top-navbar">
        <div class="logo"><?php echo t('logo'); ?></div>
        <div class="right-panel">
            <div class="search-wrap">
                <input type="text" placeholder="<?php echo t('search_placeholder'); ?>" class="search-input">
            </div>
            <select class="lang-select" onchange="changeLang(this.value)">
                <?php foreach ($languageOptions as $code => $label): ?>
                    <option value="<?php echo $code; ?>" <?php echo currentLang() === $code ? 'selected' : ''; ?>><?php echo htmlspecialchars($label); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <nav class="navigation">
        <a href="index.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('index.php'); ?>"><?php echo t('nav_home'); ?></a>
        <a href="history.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('history.php'); ?>"><?php echo t('nav_history'); ?></a>
        <a href="maps.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('maps.php'); ?>"><?php echo t('nav_maps'); ?></a>
        <a href="science.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('science.php'); ?>"><?php echo t('nav_science'); ?></a>
        <a href="products.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('products.php'); ?>"><?php echo t('nav_products'); ?></a>
        <a href="news.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('news.php'); ?>"><?php echo t('nav_news'); ?></a>
        <a href="gallery.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('gallery.php'); ?>"><?php echo t('nav_gallery'); ?></a>
        <a href="contacts.php<?php echo '?lang=' . currentLang(); ?>" class="<?php echo navClass('contacts.php'); ?>"><?php echo t('nav_contacts'); ?></a>
    </nav>
</header>
<script>
function changeLang(lang) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}
</script>