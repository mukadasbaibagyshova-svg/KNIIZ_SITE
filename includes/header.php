<?php
include_once __DIR__ . '/lang.php';
$currentFile = basename($_SERVER['SCRIPT_NAME']);
function navClass($file) {
    global $currentFile;
    return $currentFile === $file ? 'nav-link active' : 'nav-link';
}
function isDropdownActive($files) {
    global $currentFile;
    return in_array($currentFile, $files) ? 'active' : '';
}
$languageOptions = getLanguages();
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(currentLang()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . t('logo') : t('logo'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <?php if (!empty($page_head)) { echo $page_head; } ?>
</head>
<body>
<a class="skip-link" href="#main-content"><?php echo t('top_navigation'); ?></a>
<header class="site-header">
    <div class="top-bar container d-flex align-items-center justify-content-between">
        <div class="top-left d-flex align-items-center gap-3">
            <span class="top-chip"><?php echo t('top_navigation'); ?></span>
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="top-link"><?php echo t('top_contacts'); ?></a>
        </div>
        <div class="top-right d-flex align-items-center gap-2">
            <button type="button" class="icon-button" onclick="toggleSearchPopup()"><?php echo t('top_search'); ?></button>
            <div class="country-dropdown">
                <button type="button" class="country-trigger"><?php echo t('top_lang_selector'); ?> ▾</button>
                <div class="country-menu">
                    <button type="button" class="country-item" onclick="changeLang('en')"><?php echo t('lang_en'); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ru')"><?php echo t('lang_ru'); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ky')"><?php echo t('lang_ky'); ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-bar container d-flex align-items-center justify-content-between">
        <a class="brand" href="index.php?lang=<?php echo currentLang(); ?>"><?php echo t('logo'); ?></a>
        <nav class="main-nav d-none d-lg-flex">
            <ul class="main-menu d-flex gap-4 align-items-center mb-0 list-unstyled">
                <li class="dropdown-li">
                    <a href="index.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('index.php'); ?> dropdown-trigger">
                        <?php echo t('nav_home'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li><a href="index.php?lang=<?php echo currentLang(); ?>#about"><?php echo t('nav_about'); ?></a></li>
                        <li><a href="history.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_history'); ?></a></li>
                        <li><a href="news.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_news'); ?></a></li>
                        <li><a href="maps.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_maps'); ?></a></li>
                        <li><a href="contacts.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_contacts'); ?></a></li>
                    </ul>
                </li>
                <li class="dropdown-li">
                    <a href="science.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('science.php'); ?> dropdown-trigger">
                        <?php echo t('nav_science'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li><a href="science.php?lang=<?php echo currentLang(); ?>#management"><?php echo t('nav_management'); ?></a></li>
                        <li><a href="science.php?lang=<?php echo currentLang(); ?>#departments"><?php echo t('nav_departments'); ?></a></li>
                        <li><a href="science.php?lang=<?php echo currentLang(); ?>#branches"><?php echo t('nav_branches'); ?></a></li>
                    </ul>
                </li>
                <li><a href="gallery.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('gallery.php'); ?>"><?php echo t('nav_gallery'); ?></a></li>
                <li><a href="contacts.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('contacts.php'); ?>"><?php echo t('nav_contacts'); ?></a></li>
            </ul>
        </nav>
        <button class="burger-button d-lg-none" type="button" aria-label="Open menu" onclick="toggleMobileMenu()">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<div class="search-popup" id="searchPopup">
    <div class="search-popup-inner">
        <button class="close-popup" type="button" aria-label="Close search" onclick="toggleSearchPopup()">×</button>
        <div class="search-block">
            <label for="searchQuery" class="search-label"><?php echo t('search_placeholder'); ?></label>
            <input id="searchQuery" type="search" placeholder="<?php echo t('search_placeholder'); ?>..." class="form-control search-popup-input">
            <button type="button" class="btn-premium btn-premium-accent search-submit"><?php echo t('search_placeholder'); ?></button>
        </div>
    </div>
</div>

<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-inner p-4" style="overflow-y: auto;">
        <button class="btn-close btn-close-white mb-4" type="button" aria-label="Close menu" onclick="toggleMobileMenu()"></button>
        <nav class="mobile-nav-list mb-4">
            <div class="mobile-nav-group mb-3">
                <a href="index.php?lang=<?php echo currentLang(); ?>" class="mobile-link fw-bold text-success mb-2" style="font-size: 22px; text-align: left;"><?php echo t('nav_home'); ?></a>
                <div class="mobile-sublinks ps-3" style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="index.php?lang=<?php echo currentLang(); ?>#about" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_about'); ?></a>
                    <a href="history.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_history'); ?></a>
                    <a href="news.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_news'); ?></a>
                    <a href="maps.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_maps'); ?></a>
                    <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_contacts'); ?></a>
                </div>
            </div>
            <div class="mobile-nav-group mb-3">
                <a href="science.php?lang=<?php echo currentLang(); ?>" class="mobile-link fw-bold text-success mb-2" style="font-size: 22px; text-align: left;"><?php echo t('nav_science'); ?></a>
                <div class="mobile-sublinks ps-3" style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="science.php?lang=<?php echo currentLang(); ?>#management" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_management'); ?></a>
                    <a href="science.php?lang=<?php echo currentLang(); ?>#departments" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_departments'); ?></a>
                    <a href="science.php?lang=<?php echo currentLang(); ?>#branches" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_branches'); ?></a>
                </div>
            </div>
            <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_gallery'); ?></a>
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_contacts'); ?></a>
        </nav>
        <div class="mobile-subtitle" style="text-align: left; margin-top: 20px;"><?php echo t('top_lang_selector'); ?></div>
        <div class="d-flex flex-column gap-2">
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('en')"><?php echo t('lang_en'); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ru')"><?php echo t('lang_ru'); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ky')"><?php echo t('lang_ky'); ?></button>
        </div>
    </div>
</div>

<script>
function changeLang(lang) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}

function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('open');
}

function toggleSearchPopup() {
    document.getElementById('searchPopup').classList.toggle('open');
}

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');
    header.classList.toggle('scrolled', window.scrollY > 24);
});
</script>