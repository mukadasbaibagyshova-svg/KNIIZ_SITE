<?php
include_once __DIR__ . "/lang.php";
$currentFile = basename($_SERVER["SCRIPT_NAME"]);
function navClass($file)
{
    global $currentFile;
    return $currentFile === $file ? "nav-link active" : "nav-link";
}
function isDropdownActive($files)
{
    global $currentFile;
    return in_array($currentFile, $files) ? "active" : "";
}
$languageOptions = getLanguages();

$scienceDeptNav = [
    ["id" => "wheat", "title_key" => "structure_detail_wheat_title"],
    ["id" => "barley", "title_key" => "structure_detail_barley_title"],
    ["id" => "corn", "title_key" => "structure_detail_corn_title"],
    ["id" => "soil", "title_key" => "structure_detail_soil_title"],
    [
        "id" => "genetic_resources",
        "title_key" => "structure_detail_genetic_resources_title",
    ],
    ["id" => "sugarbeet", "title_key" => "structure_detail_sugarbeet_title"],
    ["id" => "fruit_veg", "title_key" => "structure_detail_fruit_veg_title"],
    ["id" => "fiber", "title_key" => "structure_detail_fiber_title"],
    ["id" => "potato", "title_key" => "structure_detail_potato_title"],
];
$scienceNavActive = in_array(
    $currentFile,
    ["science.php", "structure-detail.php"],
    true,
)
    ? "nav-link active"
    : "nav-link";
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(currentLang()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title)
        ? $page_title . " - " . t("logo")
        : t("logo"); ?></title>
    <?php
    // ── SEO meta block ────────────────────────────────────────────────────────
    $_seo_scheme =
        !empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off"
            ? "https"
            : "http";
    $_seo_host = $_SERVER["HTTP_HOST"];
    $_seo_parts = parse_url($_SERVER["REQUEST_URI"]);
    $_seo_path = $_seo_parts["path"] ?? "/";
    $_seo_qarr = [];
    if (!empty($_seo_parts["query"])) {
        parse_str($_seo_parts["query"], $_seo_qarr);
    }
    unset($_seo_qarr["lang"]);
    $_seo_canonical = $_seo_scheme . "://" . $_seo_host . $_seo_path;
    if (!empty($_seo_qarr)) {
        $_seo_canonical .= "?" . http_build_query($_seo_qarr);
    }
    $_seo_locale_map = ["ru" => "ru_RU", "en" => "en_US", "ky" => "ky_KG"];
    $_seo_locale = $_seo_locale_map[currentLang()] ?? "ru_RU";
    $_seo_desc = htmlspecialchars(
        isset($page_description) ? $page_description : t("meta_desc_home"),
        ENT_QUOTES,
        "UTF-8",
    );
    $_seo_keys = isset($page_keywords)
        ? htmlspecialchars($page_keywords, ENT_QUOTES, "UTF-8")
        : "";
    $_seo_og_title = htmlspecialchars(
        isset($page_title) ? $page_title . " — " . t("logo") : t("logo"),
        ENT_QUOTES,
        "UTF-8",
    );
    $_seo_og_type = htmlspecialchars(
        isset($og_type) ? $og_type : "website",
        ENT_QUOTES,
        "UTF-8",
    );
    $_seo_og_image = isset($og_image) ? $og_image : "assets/images/hero1.jpg"; // fallback — hero1.jpg guaranteed to exist
    $_seo_og_img_url = htmlspecialchars(
        $_seo_scheme . "://" . $_seo_host . "/" . ltrim($_seo_og_image, "/"),
        ENT_QUOTES,
        "UTF-8",
    );
    $_seo_site_name = htmlspecialchars(t("logo"), ENT_QUOTES, "UTF-8");
    $_seo_can_esc = htmlspecialchars($_seo_canonical, ENT_QUOTES, "UTF-8");

// ─────────────────────────────────────────────────────────────────────────
?>
    <meta name="description" content="<?php echo $_seo_desc; ?>">
    <?php if (!empty($_seo_keys)): ?>
    <meta name="keywords" content="<?php echo $_seo_keys; ?>">
    <?php endif; ?>
    <meta name="robots" content="index, follow">
    <!-- Open Graph -->
    <meta property="og:type"        content="<?php echo $_seo_og_type; ?>">
    <meta property="og:title"       content="<?php echo $_seo_og_title; ?>">
    <meta property="og:description" content="<?php echo $_seo_desc; ?>">
    <meta property="og:url"         content="<?php echo $_seo_can_esc; ?>">
    <meta property="og:image"       content="<?php echo $_seo_og_img_url; ?>">
    <meta property="og:site_name"   content="<?php echo $_seo_site_name; ?>">
    <meta property="og:locale"      content="<?php echo $_seo_locale; ?>">
    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo $_seo_og_title; ?>">
    <meta name="twitter:description" content="<?php echo $_seo_desc; ?>">
    <meta name="twitter:image"       content="<?php echo $_seo_og_img_url; ?>">
    <!-- Canonical & hreflang -->
    <link rel="canonical" href="<?php echo $_seo_can_esc; ?>">
    <?php
    foreach (["ru", "en", "ky"] as $_hl):

        $_hlq = $_seo_qarr;
        $_hlq["lang"] = $_hl;
        $_hlhref = htmlspecialchars(
            $_seo_scheme .
                "://" .
                $_seo_host .
                $_seo_path .
                "?" .
                http_build_query($_hlq),
            ENT_QUOTES,
            "UTF-8",
        );
        ?>
    <link rel="alternate" hreflang="<?php echo $_hl; ?>" href="<?php echo $_hlhref; ?>">
    <?php
    endforeach;
    $_hlq_def = $_seo_qarr;
    $_hlq_def["lang"] = "ru";
    $_hlhref_def = htmlspecialchars(
        $_seo_scheme .
            "://" .
            $_seo_host .
            $_seo_path .
            "?" .
            http_build_query($_hlq_def),
        ENT_QUOTES,
        "UTF-8",
    );
    ?>
    <link rel="alternate" hreflang="x-default" href="<?php echo $_hlhref_def; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <?php if (!empty($page_head)) {
        echo $page_head;
    } ?>
<link rel="stylesheet" href="assets/css/agro-map-dark.css" media="(prefers-color-scheme: dark)">
<style>
    .search-highlight { background: rgba(255, 236, 179, 0.8); border-radius: 8px; padding: 0.1rem 0.2rem; }
    .search-status { margin-top: 0.75rem; font-size: 0.95rem; opacity: 0.95; }
    .search-status.no-results { color: #f43f5e; }

    .dropdown-trigger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dropdown-arrow,
    .nested-arrow,
    .mobile-arrow {
        display: inline-block;
        transition: transform 0.25s ease, color 0.25s ease;
    }

    .dropdown-li.open > .dropdown-trigger .dropdown-arrow,
    .nested-dropdown.open > .nested-dropdown-trigger .nested-arrow,
    .mobile-nav-group.open > button .mobile-arrow {
        transform: rotate(90deg);
        color: var(--accent-color);
    }

    .dropdown-li.open .dropdown-submenu {
        display: block;
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        pointer-events: auto;
    }

    .nested-dropdown + li {
        margin-top: 2px;
    }

    .nested-dropdown-trigger {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .nested-submenu {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition: max-height 0.25s ease, opacity 0.25s ease, margin 0.25s ease;
    }

    .nested-dropdown.open > .nested-submenu {
        max-height: 180px;
        opacity: 1;
        margin-top: 4px;
        margin-bottom: 4px;
    }

    .nested-submenu a {
        padding-left: 34px !important;
        font-size: 13.5px !important;
        color: rgba(255, 255, 255, 0.72) !important;
    }

    .nested-submenu a:hover,
    .nested-submenu a.active {
        padding-left: 38px !important;
        color: #fff !important;
        background: rgba(16, 185, 129, 0.16) !important;
    }
</style>
</head>
<body<?php echo !empty($body_class)
    ? ' class="' . htmlspecialchars($body_class) . '"'
    : ""; ?>>
<a class="skip-link" href="#main-content"><?php echo t("top_navigation"); ?></a>
<?php
$isHome = basename($_SERVER["SCRIPT_NAME"]) === "index.php";
$headerClass = $isHome ? "site-header" : "site-header header-solid";
?>
<header class="<?php echo $headerClass; ?>">
    <div class="nav-bar container d-flex align-items-center justify-content-between">
        <a class="brand" href="index.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "logo",
); ?></a>
        <nav class="main-nav d-none d-lg-flex">
            <ul class="main-menu d-flex gap-4 align-items-center mb-0 list-unstyled">
                <!-- Home (no dropdown) -->
                <li>
                    <a href="index.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass(
    "index.php",
); ?>">
                        <?php echo t("nav_home"); ?>
                    </a>
                </li>

                <!-- About (dropdown) -->
                <li class="dropdown-li about-dropdown-li" style="position: relative;" onmouseleave="closeAboutNestedSubmenu()">
                    <a href="#" class="dropdown-trigger">
                        <?php echo t("nav_about"); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li class="nested-dropdown">
                            <a href="#" class="nested-dropdown-trigger" onclick="toggleNestedDropdown(event)">
                                <?php echo t(
                                    "nav_about_history",
                                ); ?> <span class="nested-arrow">▶</span>
                            </a>
                            <ul class="nested-submenu">
                                <li><a href="history.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_history",
); ?></a></li>
                                <li><a href="about.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_about_azyikov",
); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="maps.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_maps",
); ?></a></li>
                        <li><a href="administration.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_administration",
); ?></a></li>
                        <li><a href="documents.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_documents",
); ?></a></li>
                        <li><a href="international.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_international",
); ?></a></li>
                    </ul>
                </li>

                <!-- Science (dropdown) -->
                <li class="dropdown-li" style="position: relative;">
                    <a href="science.php?lang=<?php echo currentLang(); ?>" class="<?php echo $scienceNavActive; ?> dropdown-trigger">
                        <?php echo t("nav_science"); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <?php foreach ($scienceDeptNav as $deptNav): ?>
                        <li><a href="structure-detail.php?item=<?php echo $deptNav[
                            "id"
                        ]; ?>&lang=<?php echo currentLang(); ?>"><?php echo t(
    $deptNav["title_key"],
); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Media (dropdown) -->
                <li class="dropdown-li" style="position: relative;">
                    <a href="#" class="dropdown-trigger">
                        <?php echo t("nav_media"); ?> ▾
                    </a>
                    <ul class="dropdown-submenu">
                        <li><a href="news.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_news",
); ?></a></li>
                        <li><a href="gallery.php?lang=<?php echo currentLang(); ?>"><?php echo t(
    "nav_gallery",
); ?></a></li>
                    </ul>
                </li>

                <!-- Catalog -->
                <li>
                    <a href="katalog.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass(
    "katalog.php",
); ?>">
                        <?php echo t("nav_catalog"); ?>
                    </a>
                </li>

                <!-- Contacts (no dropdown) -->
                <li>
                    <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="<?php echo navClass(
    "contacts.php",
); ?>">
                        <?php echo t("nav_contacts"); ?>
                    </a>
                </li>

            </ul>
        </nav>
        <div class="nav-actions d-flex align-items-center gap-2">
            <button type="button" class="icon-button" onclick="toggleSearchPopup()"><?php echo t(
                "top_search",
            ); ?></button>
            <div class="country-dropdown">
                <button type="button" class="country-trigger" onclick="toggleCountryDropdown(event)"><?php echo t(
                    "top_lang_selector",
                ); ?> ▾</button>
                <div class="country-menu">
                    <button type="button" class="country-item" onclick="changeLang('en')">🇬🇧 <?php echo t(
                        "lang_en",
                    ); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ru')">🇷🇺 <?php echo t(
                        "lang_ru",
                    ); ?></button>
                    <button type="button" class="country-item" onclick="changeLang('ky')">🇰🇬 <?php echo t(
                        "lang_ky",
                    ); ?></button>
                </div>
            </div>
            <button class="burger-button d-lg-none" type="button" aria-label="Open menu" onclick="toggleMobileMenu()">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<div class="search-popup" id="searchPopup">
    <div class="search-popup-inner">
        <button class="close-popup" type="button" aria-label="Close search" onclick="toggleSearchPopup()">×</button>
        <div class="search-block">
            <label for="searchQuery" class="search-label"><?php echo t(
                "search_placeholder",
            ); ?></label>
            <input id="searchQuery" type="search" placeholder="<?php echo t(
                "search_placeholder",
            ); ?>..." class="form-control search-popup-input">
            <button type="button" class="btn-premium btn-premium-accent search-submit"><?php echo t(
                "search_placeholder",
            ); ?></button>
            <div id="searchStatus" class="search-status" aria-live="polite"></div>
        </div>
    </div>
</div>

<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-inner p-4" style="overflow-y: auto;">
        <button class="btn-close btn-close-white mb-4" type="button" aria-label="Close menu" onclick="toggleMobileMenu()"></button>
        <nav class="mobile-nav-list mb-4">
            <!-- Home -->
            <a href="index.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t(
    "nav_home",
); ?></a>

            <!-- About (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t(
                    "nav_about",
                ); ?> <span class="mobile-arrow">▶</span></button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <div class="mobile-nav-group mb-2" style="border-bottom: 0; padding-bottom: 0;">
                        <button class="mobile-sublink border-0 bg-transparent py-1" style="width: 100%; display: flex; justify-content: space-between; align-items: center;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t(
                            "nav_about_history",
                        ); ?> <span class="mobile-arrow">▶</span></button>
                        <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                            <a href="history.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_history",
); ?></a>
                            <a href="about.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_about_azyikov",
); ?></a>
                        </div>
                    </div>
                    <a href="maps.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_maps",
); ?></a>
                    <a href="administration.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_administration",
); ?></a>
                    <a href="documents.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_documents",
); ?></a>
                    <a href="international.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_international",
); ?></a>
                </div>
            </div>

            <!-- Science (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t(
                    "nav_science",
                ); ?> <span class="mobile-arrow">▶</span></button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <?php foreach ($scienceDeptNav as $deptNav): ?>
                    <a href="structure-detail.php?item=<?php echo $deptNav[
                        "id"
                    ]; ?>&lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    $deptNav["title_key"],
); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Media (expandable) -->
            <div class="mobile-nav-group mb-3">
                <button class="mobile-link fw-bold mb-2" style="font-size: 22px; text-align: left; background: transparent; border: none; padding: 0; cursor: pointer; width: 100%;" type="button" onclick="toggleMobileSubmenu(event)"><?php echo t(
                    "nav_media",
                ); ?> <span class="mobile-arrow">▶</span></button>
                <div class="mobile-sublinks ps-3" style="display: none; flex-direction: column; gap: 8px;">
                    <a href="news.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_news",
); ?></a>
                    <a href="gallery.php?lang=<?php echo currentLang(); ?>" class="mobile-sublink" onclick="toggleMobileMenu()"><?php echo t(
    "nav_gallery",
); ?></a>
                </div>
            </div>

            <!-- Catalog -->
            <a href="katalog.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t(
    "nav_catalog",
); ?></a>

            <!-- Contacts -->
            <a href="contacts.php?lang=<?php echo currentLang(); ?>" class="mobile-link mb-3 fw-bold" style="font-size: 22px; text-align: left;" onclick="toggleMobileMenu()"><?php echo t(
    "nav_contacts",
); ?></a>
        </nav>
        <div class="mobile-subtitle" style="text-align: left; margin-top: 20px;"><?php echo t(
            "top_lang_selector",
        ); ?></div>
        <div class="d-flex flex-column gap-2">
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('en')">🇬🇧 <?php echo t(
                "lang_en",
            ); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ru')">🇷🇺 <?php echo t(
                "lang_ru",
            ); ?></button>
            <button class="mobile-link border-0 bg-transparent py-1" style="font-size: 18px; text-align: left;" type="button" onclick="changeLang('ky')">🇰🇬 <?php echo t(
                "lang_ky",
            ); ?></button>
        </div>
    </div>
</div>

<script>
function changeLang(lang) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}

function closeDesktopDropdowns() {
    document.querySelectorAll('.dropdown-li.open').forEach(function(item) {
        item.classList.remove('open');
    });
    document.querySelectorAll('.nested-dropdown.open').forEach(function(item) {
        item.classList.remove('open');
    });
}

function toggleDesktopDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    const trigger = event.currentTarget;
    const item = trigger.closest('.dropdown-li');
    if (!item) {
        return;
    }
    const wasOpen = item.classList.contains('open');
    closeDesktopDropdowns();
    if (!wasOpen) {
        item.classList.add('open');
    }
}

function toggleNestedDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    const trigger = event.currentTarget;
    const item = trigger.closest('.nested-dropdown');
    if (!item) {
        return;
    }
    item.classList.toggle('open');
}

function closeMobileSubmenus() {
    document.querySelectorAll('.mobile-nav-group.open').forEach(function(group) {
        group.classList.remove('open');
    });
    document.querySelectorAll('.mobile-sublinks').forEach(function(menu) {
        menu.style.display = 'none';
    });
}

function toggleMobileMenu(forceState) {
    const menu = document.getElementById('mobileMenu');
    const shouldOpen = typeof forceState === 'boolean' ? forceState : !menu.classList.contains('open');
    menu.classList.toggle('open', shouldOpen);
    if (!shouldOpen) {
        closeMobileSubmenus();
    }
}

function toggleMobileSubmenu(event) {
    event.preventDefault();
    event.stopPropagation();
    const btn = event.currentTarget;
    const group = btn.closest('.mobile-nav-group');
    const submenu = btn.nextElementSibling;
    if (group && submenu && submenu.classList.contains('mobile-sublinks')) {
        const isOpen = group.classList.contains('open');
        group.classList.toggle('open', !isOpen);
        submenu.style.display = isOpen ? 'none' : 'flex';
    }
}

function toggleCountryDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    const dropdown = event.currentTarget.closest('.country-dropdown');
    if (!dropdown) {
        return;
    }
    dropdown.classList.toggle('open');
}

function closeCountryDropdown() {
    document.querySelectorAll('.country-dropdown.open').forEach(function(dropdown) {
        dropdown.classList.remove('open');
    });
}

function toggleSearchPopup() {
    document.getElementById('searchPopup').classList.toggle('open');
}

function closeAboutNestedSubmenu() {
    document.querySelectorAll('.about-dropdown-li .nested-dropdown.open').forEach(function(item) {
        item.classList.remove('open');
    });
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('.about-dropdown-li')) {
        closeDesktopDropdowns();
    }
    if (!event.target.closest('.country-dropdown')) {
        closeCountryDropdown();
    }
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenu.classList.contains('open') && event.target === mobileMenu) {
        toggleMobileMenu(false);
    }
});

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
    [
        "href" => "index.php",
        "keys" => [
            t("nav_home"),
            t("top_search"),
            "home",
            "главная",
            "башкы бет",
        ],
    ],
    [
        "href" => "history.php",
        "keys" => [
            t("nav_history"),
            t("nav_about"),
            "history",
            "история",
            "тарых",
        ],
    ],
    [
        "href" => "maps.php",
        "keys" => [
            t("nav_maps"),
            "map",
            "карта",
            "карты",
            "карталар",
            "станция",
            "станции",
            "жер фонду",
        ],
    ],
    [
        "href" => "science.php",
        "keys" => [
            t("nav_science"),
            "science",
            "наука",
            "илим",
            "отделы",
            "departments",
            "бөлүмдөр",
            "научные отделы",
            "илимий бөлүмдөр",
        ],
    ],
    [
        "href" => "structure-detail.php?item=wheat",
        "keys" => [
            t("structure_detail_wheat_title"),
            "wheat",
            "пшеница",
            "жүгөрү",
            "будай",
        ],
    ],
    [
        "href" => "structure-detail.php?item=barley",
        "keys" => [
            t("structure_detail_barley_title"),
            "barley",
            "ячмень",
            "арпа",
        ],
    ],
    [
        "href" => "structure-detail.php?item=sugarbeet",
        "keys" => [
            t("structure_detail_sugarbeet_title"),
            "sugar beet",
            "сахарная свекла",
            " кант кызылчасы",
        ],
    ],
    [
        "href" => "structure-detail.php?item=corn",
        "keys" => [
            t("structure_detail_corn_title"),
            "corn",
            "кукуруза",
            "буудай",
        ],
    ],
    [
        "href" => "structure-detail.php?item=fruit_veg",
        "keys" => [
            t("structure_detail_fruit_veg_title"),
            "fruit",
            "vegetable",
            "овощные",
            "жемиш",
            "жашылча",
        ],
    ],
    [
        "href" => "structure-detail.php?item=agrochemistry",
        "keys" => [
            t("structure_detail_agrochemistry_title"),
            "agrochemistry",
            "агрохимия",
        ],
    ],
    [
        "href" => "structure-detail.php?item=soil",
        "keys" => [
            t("structure_detail_soil_title"),
            "soil",
            "почвоведение",
            "топурак таануу",
        ],
    ],
    [
        "href" => "administration.php",
        "keys" => [
            t("nav_administration"),
            "administration",
            "администрация",
            "администрация",
            "отделы",
            "departments",
            "бөлүмдөр",
        ],
    ],
    [
        "href" => "documents.php",
        "keys" => [t("nav_documents"), "documents", "документы", "документтер"],
    ],
    [
        "href" => "international.php",
        "keys" => [
            t("nav_international"),
            "international",
            "международная",
            "эл аралык",
        ],
    ],
    [
        "href" => "news.php",
        "keys" => [t("nav_news"), "news", "новости", "билдирүүлөр"],
    ],
    [
        "href" => "gallery.php",
        "keys" => [t("nav_gallery"), "gallery", "галерея", "галерея"],
    ],
    [
        "href" => "contacts.php",
        "keys" => [t("nav_contacts"), "contacts", "контакты", "контакттар"],
    ],
    [
        "href" => "katalog.php",
        "keys" => ["каталог", "catalog", "katalog", "сортов", "сорттор"],
    ],
]); ?>;

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
        setSearchStatus('<?php echo t("search_placeholder"); ?>...');
        return;
    }
    clearSearchHighlights();
    const foundOnPage = searchOnCurrentPage(normalizedQuery);
    if (foundOnPage) {
        setSearchStatus('<?php echo t(
            "search_page_match",
        ); ?>: "' + query + '"');
        return;
    }
    if (searchPageRoutes(normalizedQuery)) {
        return;
    }
    setSearchStatus('<?php echo t("search_no_results"); ?>');
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
        setSearchStatus('<?php echo t(
            "search_page_match",
        ); ?>: "' + query + '"');
    }
}

window.addEventListener('DOMContentLoaded', function () {
    setupSearchHandlers();
    handleSearchQueryParam();
});

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');
    header.classList.toggle('scrolled', window.scrollY > 24);
});
</script>
