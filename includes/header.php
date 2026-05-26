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
    ['id' => 'soil', 'title_key' => 'structure_detail_soil_title'],
    ['id' => 'genetic_resources', 'title_key' => 'structure_detail_genetic_resources_title'],
    ['id' => 'sugarbeet', 'title_key' => 'structure_detail_sugarbeet_title'],
    ['id' => 'fruit_veg', 'title_key' => 'structure_detail_fruit_veg_title'],
    ['id' => 'fiber', 'title_key' => 'structure_detail_fiber_title'],
    ['id' => 'potato', 'title_key' => 'structure_detail_potato_title'],
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
<link rel="stylesheet" href="assets/css/agro-map-dark.css" media="(prefers-color-scheme: dark)">
<style>
    .search-highlight { background: rgba(255, 236, 179, 0.8); border-radius: 8px; padding: 0.1rem 0.2rem; }
    .search-status { margin-top: 0.75rem; font-size: 0.95rem; opacity: 0.95; }
    .search-status.no-results { color: #f43f5e; }

    /* Nested Dropdown styles for "История" */
    .nested-dropdown {
        position: relative;
        width: 100%;
    }
    .nested-dropdown-trigger {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        cursor: pointer;
    }
    .nested-dropdown-trigger .arrow {
        font-size: 10px;
        margin-left: 6px;
        transition: transform 0.25s ease;
        display: inline-block;
        color: rgba(255, 255, 255, 0.6);
    }
    .nested-dropdown.open .nested-dropdown-trigger .arrow {
        transform: rotate(90deg);
        color: var(--accent-color);
    }
    .nested-submenu {
        max-height: 0;
        overflow: hidden;
        list-style: none;
        padding: 0;
        margin: 0;
        transition: max-height 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        opacity: 0;
        width: 100%;
    }
    .nested-dropdown.open .nested-submenu {
        max-height: 200px;
        opacity: 1;
        margin-top: 4px;
        margin-bottom: 4px;
    }
    .nested-submenu a {
        padding-left: 36px !important;
        font-size: 13.5px !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }
    .nested-submenu a:hover,
    .nested-submenu a.active {
        padding-left: 40px !important;
        color: #ffffff !important;
        background: rgba(16, 185, 129, 0.15) !important;
    }
</style>
</head>
<body<?php echo !empty($body_class) ? ' class="' . htmlspecialchars($body_class) . '"' : ''; ?>>
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
                    <button type="button" class="country-item" onclick="changeLang('en')">🇬🇧 <?php echo t('lang_en'); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ru')">🇷🇺 <?php echo t('lang_ru'); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ky')">🇰🇬 <?php echo t('lang_ky'); ?></button>
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

                <li class="dropdown-li" style="position: relative;">
                    <a href="#" class="dropdown-trigger">
                        <?php echo t('nav_about'); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li class="nested-dropdown">
                            <a href="#" class="nested-dropdown-trigger" onclick="toggleNestedDropdown(event)">
                                <?php echo t('nav_about_history'); ?> <span class="arrow">▶</span>
                            </a>
                            <ul class="nested-submenu">
                                <li><a href="history.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_history'); ?></a></li>
                                <li><a href="about.php?lang=<?php echo currentLang(); ?>"><?php echo t('nav_about_azyikov'); ?></a></li>
                            </ul>
                        </li>
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

                <!-- Catalog -->
                <li>
                    <a href="katalog.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass('katalog.php'); ?>">
                        <?php echo t('nav_catalog'); ?>
                    </a>
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
            <div id="searchStatus" class="search-status" aria-live="polite"></div>
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
                    <div class="mobile-nav-group mb-2">
                        <button class="mobile-link fw-bold mb-2" style="font-size: 20px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t('nav_about_history'); ?> ▾</button>
                        <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                            <a href="history.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_history'); ?></a>
                            <a href="about.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t('nav_about_azyikov'); ?></a>
                        </div>
                    </div>
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

            <!-- Catalog -->
            <a href="katalog.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_catalog'); ?></a>

            <!-- Contacts -->
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t('nav_contacts'); ?></a>
        </nav>
        <div class="mobile-subtitle" style="text-align: left; margin-top: 20px;"><?php echo t('top_lang_selector'); ?></div>
        <div class="d-flex flex-column gap-2">
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('en')">🇬🇧 <?php echo t('lang_en'); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ru')">🇷🇺 <?php echo t('lang_ru'); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ky')">🇰🇬 <?php echo t('lang_ky'); ?></button>
        </div>
    </div>
</div>

<script>
function toggleNestedDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    const item = event.currentTarget.closest('.nested-dropdown');
    item.classList.toggle('open');
}

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

function normalizeSearchText(value) {
    return String(value || '').trim().toLowerCase();
}

function clearSearchHighlights() {
    document.querySelectorAll('.search-highlight').forEach(function(el) {
        el.classList.remove('search-highlight');
    });
}

function isVisibleElement(element) {
    return element.offsetParent !== null && getComputedStyle(element).visibility !== 'hidden';
}

function getSearchableElements() {
    const selectors = 'h1,h2,h3,h4,h5,h6,p,li,dt,dd,a,button,span,article,section,header,main';
    return Array.from(document.querySelectorAll(selectors)).filter(function(el) {
        return el.textContent && normalizeSearchText(el.textContent).length > 0 && isVisibleElement(el) && !el.closest('.search-popup');
    });
}

function scrollToElement(element) {
    if (!element) {
        return;
    }
    clearSearchHighlights();
    element.classList.add('search-highlight');
    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function searchOnCurrentPage(query) {
    const normalizedQuery = normalizeSearchText(query);
    if (!normalizedQuery) {
        return false;
    }
    const elements = getSearchableElements();
    const match = elements.find(function(el) {
        return normalizeSearchText(el.innerText).includes(normalizedQuery);
    });
    if (match) {
        scrollToElement(match);
        return true;
    }
    return false;
}

const pageSearchRoutes = <?php echo json_encode([
    ['href' => 'index.php', 'keys' => [t('nav_home'), t('top_search'), 'home', 'главная', 'башкы бет'] ],
    ['href' => 'history.php', 'keys' => [t('nav_history'), t('nav_about'), 'history', 'история', 'тарых'] ],
    ['href' => 'about.php', 'keys' => [t('nav_about_azyikov'), t('nav_about'), 'azyikov', 'азиков', 'kuliya', 'кулия'] ],
    ['href' => 'maps.php', 'keys' => [t('nav_maps'), 'map', 'карта', 'карты', 'карталар', 'станция', 'станции', 'жер фонду'] ],
    ['href' => 'science.php', 'keys' => [t('nav_science'), 'science', 'наука', 'илим', 'отделы', 'departments', 'бөлүмдөр', 'научные отделы', 'илимий бөлүмдөр'] ],
    ['href' => 'structure-detail.php?item=wheat', 'keys' => [t('structure_detail_wheat_title'), 'wheat', 'пшеница', 'жүгөрү', 'будай'] ],
    ['href' => 'structure-detail.php?item=barley', 'keys' => [t('structure_detail_barley_title'), 'barley', 'ячмень', 'арпа'] ],
    ['href' => 'structure-detail.php?item=sugarbeet', 'keys' => [t('structure_detail_sugarbeet_title'), 'sugar beet', 'сахарная свекла', ' кант кызылчасы'] ],
    ['href' => 'structure-detail.php?item=corn', 'keys' => [t('structure_detail_corn_title'), 'corn', 'кукуруза', 'буудай'] ],
    ['href' => 'structure-detail.php?item=fruit_veg', 'keys' => [t('structure_detail_fruit_veg_title'), 'fruit', 'vegetable', 'овощные', 'жемиш', 'жашылча'] ],
    ['href' => 'structure-detail.php?item=agrochemistry', 'keys' => [t('structure_detail_agrochemistry_title'), 'agrochemistry', 'агрохимия'] ],
    ['href' => 'structure-detail.php?item=soil', 'keys' => [t('structure_detail_soil_title'), 'soil', 'почвоведение', 'топурак таануу'] ],
    ['href' => 'structure-detail.php?item=genetic_resources', 'keys' => [t('structure_detail_genetic_resources_title'), 'genetic', 'генетические', 'ресурсы', 'генетикалык'] ],
    ['href' => 'structure-detail.php?item=fiber', 'keys' => [t('structure_detail_fiber_title'), 'fiber', 'хлопок', 'волокно', 'була'] ],
    ['href' => 'structure-detail.php?item=potato', 'keys' => [t('structure_detail_potato_title'), 'potato', 'картофель', 'картошка'] ],
    ['href' => 'administration.php', 'keys' => [t('nav_administration'), 'administration', 'администрация', 'администрация', 'отделы', 'departments', 'бөлүмдөр'] ],
    ['href' => 'documents.php', 'keys' => [t('nav_documents'), 'documents', 'документы', 'документтер'] ],
    ['href' => 'international.php', 'keys' => [t('nav_international'), 'international', 'международная', 'эл аралык'] ],
    ['href' => 'news.php', 'keys' => [t('nav_news'), 'news', 'новости', 'билдирүүлөр'] ],
    ['href' => 'gallery.php', 'keys' => [t('nav_gallery'), 'gallery', 'галерея', 'галерея'] ],
    ['href' => 'contacts.php', 'keys' => [t('nav_contacts'), 'contacts', 'контакты', 'контакттар'] ],
    ['href' => 'katalog.php', 'keys' => ['каталог', 'catalog', 'katalog', 'сортов', 'сорттор'] ],
]) ?>;

function getSearchStatusElement() {
    return document.getElementById('searchStatus');
}

function setSearchStatus(message, isError) {
    const status = getSearchStatusElement();
    if (!status) return;
    status.textContent = message;
    status.classList.toggle('no-results', Boolean(isError));
}

function searchPageRoutes(query) {
    const normalizedQuery = normalizeSearchText(query);
    if (!normalizedQuery) {
        return false;
    }
    let bestMatch = null;
    let bestScore = 0;
    pageSearchRoutes.forEach(function(route) {
        let score = 0;
        route.keys.forEach(function(key) {
            if (normalizeSearchText(key).includes(normalizedQuery)) {
                score += 1;
            }
        });
        if (score > bestScore) {
            bestScore = score;
            bestMatch = route;
        }
    });
    if (bestMatch && bestScore > 0) {
        const pageUrl = new URL(bestMatch.href, window.location.origin);
        const currentPath = window.location.pathname.replace(/^\/+/, '');
        const targetPath = pageUrl.pathname.replace(/^\/+/, '');
        if (targetPath === currentPath) {
            return false;
        }
        pageUrl.searchParams.set('search', query);
        pageUrl.searchParams.set('lang', '<?php echo currentLang(); ?>');
        window.location.href = pageUrl.toString();
        return true;
    }
    return false;
}

function runSearch(query) {
    const normalizedQuery = normalizeSearchText(query);
    if (!normalizedQuery) {
        setSearchStatus('<?php echo t('search_placeholder'); ?>...');
        return;
    }
    clearSearchHighlights();
    const foundOnPage = searchOnCurrentPage(normalizedQuery);
    if (foundOnPage) {
        setSearchStatus('<?php echo t('search_page_match'); ?>: "' + query + '"');
        return;
    }
    if (searchPageRoutes(normalizedQuery)) {
        return;
    }
    setSearchStatus('<?php echo t('search_no_results'); ?>');
}

function setupSearchHandlers() {
    const searchQuery = document.getElementById('searchQuery');
    const searchSubmit = document.querySelector('.search-submit');
    if (!searchQuery || !searchSubmit) {
        return;
    }
    searchSubmit.addEventListener('click', function() {
        runSearch(searchQuery.value);
    });
    searchQuery.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            runSearch(searchQuery.value);
        }
    });
}

function handleSearchQueryParam() {
    const params = new URLSearchParams(window.location.search);
    const query = params.get('search');
    if (!query) {
        return;
    }
    const searchQuery = document.getElementById('searchQuery');
    if (searchQuery) {
        searchQuery.value = query;
    }
    const foundOnPage = searchOnCurrentPage(query);
    if (foundOnPage) {
        setSearchStatus('<?php echo t('search_page_match'); ?>: "' + query + '"');
    }
}

window.addEventListener('DOMContentLoaded', function () {
    setupSearchHandlers();
    handleSearchQueryParam();

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.main-nav')) {
            document.querySelectorAll('.nested-dropdown.open').forEach(function(el) {
                el.classList.remove('open');
            });
        }
    });
});

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');
    header.classList.toggle('scrolled', window.scrollY > 24);
});
</script>
