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

$scienceDeptNav = [
    ['id' => 'wheat', 'title_key' => 'structure_detail_wheat_title'],
    ['id' => 'barley', 'title_key' => 'structure_detail_barley_title'],
    ['id' => 'corn', 'title_key' => 'structure_detail_corn_title'],
    ['id' => 'sugarbeet', 'title_key' => 'structure_detail_sugarbeet_title'],
    ['id' => 'fruit_veg', 'title_key' => 'structure_detail_fruit_veg_title'],
    ['id' => 'soil', 'title_key' => 'structure_detail_soil_title'],
    ['id' => 'agrochemistry', 'title_key' => 'structure_detail_agrochemistry_title'],
];
$scienceNavActive = in_array($currentFile, ['science.php', 'structure-detail.php'], true) ? 'nav-link active' : 'nav-link';
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
<?php
$isHome = (basename($_SERVER['SCRIPT_NAME']) === 'index.php');
$headerClass = $isHome ? 'site-header' : 'site-header header-solid';
?>
<header class="<?php echo $headerClass; ?>">
    <div class="top-bar container d-flex align-items-center justify-content-between">
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
                <!-- Home (no dropdown) -->
                <li>
                    <a href="index.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('index.php'); ?>">
                        <?php echo t('nav_home'); ?>
                    </a>
                </li>

                <!-- About (dropdown) -->
                <li class="dropdown-li" style="position: relative;">
                    <a href="#" class="dropdown-trigger">
                        <?php echo t('nav_about'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li><a href="history.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_history'); ?></a></li>
                        <li><a href="maps.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_maps'); ?></a></li>
                        <li><a href="administration.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_administration'); ?></a></li>
                        <li><a href="documents.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_documents'); ?></a></li>
                        <li><a href="international.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_international'); ?></a></li>
                    </ul>
                </li>

                <!-- Science (dropdown) -->
                <li class="dropdown-li" style="position: relative;">
                    <a href="science.php?lang=<?php echo currentLang(); ?>" class="<?php echo $scienceNavActive; ?> dropdown-trigger">
                        <?php echo t('nav_science'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <?php foreach ($scienceDeptNav as $deptNav): ?>
                        <li><a href="structure-detail.php?item=<?php echo $deptNav['id']; ?>&lang=<?php echo currentLang(); ?>"><?php echo t($deptNav['title_key']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Media (dropdown) -->
                <li class="dropdown-li" style="position: relative;">
                    <a href="#" class="dropdown-trigger">
                        <?php echo t('nav_media'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li><a href="news.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_news'); ?></a></li>
                        <li><a href="gallery.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_gallery'); ?></a></li>
                    </ul>
                </li>

                <!-- Contacts (no dropdown) -->
                <li>
                    <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('contacts.php'); ?>">
                        <?php echo t('nav_contacts'); ?>
                    </a>
                </li>
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
            <!-- Home -->
            <a href="index.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_home'); ?></a>

            <!-- About (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t('nav_about'); ?> ▾</button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <a href="history.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_history'); ?></a>
                    <a href="maps.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_maps'); ?></a>
                    <a href="administration.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_administration'); ?></a>
                    <a href="documents.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_documents'); ?></a>
                    <a href="international.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_international'); ?></a>
                </div>
            </div>

            <!-- Science (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t('nav_science'); ?> ▾</button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <?php foreach ($scienceDeptNav as $deptNav): ?>
                    <a href="structure-detail.php?item=<?php echo $deptNav['id']; ?>&lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t($deptNav['title_key']); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Media (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t('nav_media'); ?> ▾</button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <a href="news.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_news'); ?></a>
                    <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_gallery'); ?></a>
                </div>
            </div>

            <!-- Contacts -->
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_contacts'); ?></a>
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

function toggleMobileSubmenu(event) {
    event.preventDefault();
    event.stopPropagation();
    const btn = event.target.closest('button');
    const submenu = btn.nextElementSibling;
    if (submenu && submenu.classList.contains('mobile-sublinks')) {
        submenu.style.display = submenu.style.display === 'none' ? 'flex' : 'none';
    }
}

function toggleSearchPopup() {
    document.getElementById('searchPopup').classList.toggle('open');
}

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');
    header.classList.toggle('scrolled', window.scrollY > 24);
});
</script>