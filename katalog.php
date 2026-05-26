<?php
include_once "includes/lang.php";
$page_title = t("page_title_katalog");
$page_description = t("meta_desc_katalog");
$page_keywords = t("meta_keys_katalog");
$page_head = '<link rel="stylesheet" href="assets/css/katalog.css">';
include "includes/header.php";
?>

<!-- ============================================================
     CATALOG HERO BANNER
     ============================================================ -->
<section class="kataog-hero-section" id="main-content">
    <div class="katalog-hero-overlay"></div>
    <div class="container katalog-hero-inner">
        <h1 class="katalog-hero-title">
            <?php echo t("katalog_hero_title"); ?>
        </h1>
        <p class="katalog-hero-desc">
            <?php echo t("katalog_hero_desc"); ?>
        </p>
        <div class="katalog-hero-stats">
            <div class="katalog-hero-stat">
                <span class="stat-num">20+</span>
                <span class="stat-lbl"><?php echo t("katalog_stat_barley_count"); ?></span>
            </div>
            <div class="katalog-hero-stat">
                <span class="stat-num">1972</span>
                <span class="stat-lbl"><?php echo t("katalog_stat_first_rayon"); ?></span>
            </div>
            <div class="katalog-hero-stat">
                <span class="stat-num">85 ц/га</span>
                <span class="stat-lbl"><?php echo t("katalog_stat_yield"); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     MAIN CATALOG LAYOUT
     ============================================================ -->
<section class="katalog-main py-5">
    <div class="container">
        <div class="katalog-layout">

            <!-- ============ SIDEBAR FILTER ============ -->
            <aside class="katalog-sidebar" id="katalog-sidebar">
                <div class="sidebar-inner">

                    <div class="sidebar-header">
                        <span class="sidebar-title">🌾 <?php echo t("katalog_filter_title"); ?></span>
                        <button class="sidebar-reset" id="resetFilters" onclick="resetAllFilters()"><?php echo t("katalog_filter_reset"); ?></button>
                    </div>

                    <!-- SEARCH -->
                    <div class="filter-group">
                        <label class="filter-group-label"><?php echo t("katalog_search_label"); ?></label>
                        <div class="filter-search-wrap">
                            <input type="text" id="searchSort" class="filter-search-input" placeholder="<?php echo t("katalog_search_placeholder"); ?>" oninput="filterCards()">
                            <span class="filter-search-icon">🔍</span>
                        </div>
                    </div>

                    <!-- CULTURE -->
                    <div class="filter-group">
                        <label class="filter-group-label"><?php echo t("katalog_filter_culture_label"); ?></label>
                        <div class="filter-chips" id="cultureFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('culture','all',this)"><?php echo t("katalog_filter_all"); ?></button>
                            <button class="filter-chip" data-value="barley" onclick="setFilter('culture','barley',this)">🌾 <?php echo t("katalog_filter_culture_barley"); ?></button>
                            <button class="filter-chip" data-value="wheat" onclick="setFilter('culture','wheat',this)">🌿 <?php echo t("katalog_filter_culture_wheat"); ?></button>
                        </div>
                    </div>

                    <!-- SEASON -->
                    <div class="filter-group">
                        <label class="filter-group-label"><?php echo t("katalog_filter_season_label"); ?></label>
                        <div class="filter-chips" id="seasonFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('season','all',this)"><?php echo t("katalog_filter_all"); ?></button>
                            <button class="filter-chip" data-value="spring" onclick="setFilter('season','spring',this)">☀️ <?php echo t("katalog_filter_season_spring"); ?></button>
                            <button class="filter-chip" data-value="winter" onclick="setFilter('season','winter',this)">❄️ <?php echo t("katalog_filter_season_winter"); ?></button>
                        </div>
                    </div>

                    <!-- MATURITY -->
                    <div class="filter-group">
                        <label class="filter-group-label"><?php echo t("katalog_filter_maturity_label"); ?></label>
                        <div class="filter-chips" id="maturityFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('maturity','all',this)"><?php echo t("katalog_filter_all"); ?></button>
                            <button class="filter-chip" data-value="early" onclick="setFilter('maturity','early',this)"><?php echo t("katalog_filter_maturity_early"); ?></button>
                            <button class="filter-chip" data-value="mid-early" onclick="setFilter('maturity','mid-early',this)"><?php echo t("katalog_filter_maturity_mid_early"); ?></button>
                            <button class="filter-chip" data-value="mid" onclick="setFilter('maturity','mid',this)"><?php echo t("katalog_filter_maturity_mid"); ?></button>
                        </div>
                    </div>

                    <!-- DROUGHT RESISTANCE -->
                    <div class="filter-group">
                        <label class="filter-group-label"><?php echo t("katalog_filter_drought_label"); ?></label>
                        <div class="filter-chips" id="droughtFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('drought','all',this)"><?php echo t("katalog_filter_all"); ?></button>
                            <button class="filter-chip" data-value="high" onclick="setFilter('drought','high',this)"><?php echo t("katalog_filter_drought_high"); ?></button>
                            <button class="filter-chip" data-value="medium" onclick="setFilter('drought','medium',this)"><?php echo t("katalog_filter_drought_medium"); ?></button>
                        </div>
                    </div>

                    <div class="filter-count-wrap">
                        <span class="filter-count-text"><?php echo t("katalog_filter_count_prefix"); ?> <strong id="visibleCount">0</strong> <?php echo t("katalog_filter_count_suffix"); ?></span>
                    </div>

                </div>
            </aside>

            <!-- ============ CARDS GRID ============ -->
            <div class="katalog-content">

                <!-- RESULTS BAR -->
                <div class="katalog-results-bar">
                    <div class="katalog-results-info">
                        <h2 class="katalog-results-title"><?php echo t("katalog_results_title"); ?></h2>
                        <span class="katalog-results-count" id="totalCount"><?php echo str_replace('{{count}}', '0', t("katalog_results_phrase")); ?></span>
                    </div>
                    <div class="katalog-sort-wrap">
                        <select class="katalog-sort-select" id="sortSelect" onchange="sortCards()">
                            <option value="name"><?php echo t("katalog_sort_name"); ?></option>
                            <option value="yield-desc"><?php echo t("katalog_sort_yield_desc"); ?></option>
                            <option value="yield-asc"><?php echo t("katalog_sort_yield_asc"); ?></option>
                            <option value="year"><?php echo t("katalog_sort_year"); ?></option>
                        </select>
                    </div>
                </div>

                <!-- NO RESULTS MESSAGE -->
                <div class="katalog-no-results" id="noResults" style="display:none;">
                    <div class="no-results-icon">🌱</div>
                    <h3><?php echo t("katalog_no_results_title"); ?></h3>
                    <p><?php echo t("katalog_no_results_text"); ?></p>
                    <button class="btn-premium btn-premium-accent mt-3" onclick="resetAllFilters()"><?php echo t("katalog_filter_reset"); ?></button>
                </div>

                <!-- CARDS GRID -->
                <div class="cards-grid" id="cardsGrid">

                    <?php
                    $katalog_file = __DIR__ . "/database/katalog.json";
                    $varieties = is_file($katalog_file)
                        ? json_decode(file_get_contents($katalog_file), true)
                        : [];
                    if (!is_array($varieties)) {
                        $varieties = [];
                    }

                    // sortData will be built here for the JS modal
                    $sortData = [];

                    foreach ($varieties as $v):

                        $name = $v["name"][$currentLang] ?? $v["name"]["ru"];
                        $type = $v["type"][$currentLang] ?? $v["type"]["ru"];
                        $desc =
                            $v["description"][$currentLang] ??
                            $v["description"]["ru"];
                        $mass = $v["mass"][$currentLang] ?? $v["mass"]["ru"];
                        $yield_t =
                            $v["yield_text"][$currentLang] ??
                            $v["yield_text"]["ru"];
                        $prot =
                            $v["protein"][$currentLang] ?? $v["protein"]["ru"];
                        $year_t =
                            $v["year_text"][$currentLang] ??
                            $v["year_text"]["ru"];

                        $modalKey = $v["modal_key"] ?? $v["id"];
                        $sortData[$modalKey] = [
                            "name" => $name,
                            "type" => $type,
                            "season" =>
                                $v["season"] === "spring"
                                    ? t("season_spring", "Яровой")
                                    : t("season_winter", "Озимый"),
                            "seasonClass" =>
                                $v["season"] === "spring"
                                    ? "sort-badge-spring"
                                    : "sort-badge-winter",
                            "stats" => [
                                [
                                    "icon" => "📦",
                                    "val" => $mass,
                                    "label" => t(
                                        "stat_mass",
                                        "Масса 1000 зерён",
                                    ),
                                ],
                                [
                                    "icon" => "🌾",
                                    "val" => $yield_t,
                                    "label" => t(
                                        "stat_yield",
                                        "Потенц. урожайность",
                                    ),
                                ],
                                [
                                    "icon" => "🧬",
                                    "val" => $prot,
                                    "label" => t(
                                        "stat_protein",
                                        "Белок в зерне",
                                    ),
                                ],
                                [
                                    "icon" => "📅",
                                    "val" => $year_t,
                                    "label" => t(
                                        "stat_year",
                                        "Допущен к использованию",
                                    ),
                                ],
                            ],
                            "desc" => $desc,
                            "seeding" =>
                                $v["seeding"][$currentLang] ??
                                $v["seeding"]["ru"],
                        ];
                        ?>
                    <article class="sort-card"
                        data-culture="<?php echo htmlspecialchars(
                            $v["culture"],
                        ); ?>"
                        data-season="<?php echo htmlspecialchars(
                            $v["season"],
                        ); ?>"
                        data-maturity="<?php echo htmlspecialchars(
                            $v["maturity"],
                        ); ?>"
                        data-drought="<?php echo htmlspecialchars(
                            $v["drought"],
                        ); ?>"
                        data-yield="<?php echo htmlspecialchars(
                            $v["yield_num"],
                        ); ?>"
                        data-year="<?php echo htmlspecialchars(
                            $v["year_num"],
                        ); ?>"
                        data-name="<?php echo htmlspecialchars($name); ?>">
                        <?php
                        // Если путь уже содержит uploads/ или начинается с ../ — используем как есть
                        // Иначе считаем что это просто имя файла в assets/images/
                        $img_path = $v["image"] ?? "barley_field.png";
                        if (
                            strpos($img_path, "uploads/") !== false ||
                            strpos($img_path, "http") === 0
                        ) {
                            $img_src = $img_path;
                        } else {
                            $img_src = "assets/images/" . ltrim($img_path, "/");
                        }
                        ?>
                        <div class="sort-card-image">
                            <img src="<?php echo htmlspecialchars(
                                $img_src,
                            ); ?>" alt="<?php echo htmlspecialchars(
    $name,
); ?>" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge <?php echo $v[
                                    "season"
                                ] === "spring"
                                    ? "sort-badge-spring"
                                    : "sort-badge-winter"; ?>">
                                    <?php echo $v["season"] === "spring"
                                        ? t("season_spring", "Яровой")
                                        : t("season_winter", "Озимый"); ?>
                                </span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type"><?php echo htmlspecialchars(
                                $type,
                            ); ?></div>
                            <h3 class="sort-card-name"><?php echo htmlspecialchars(
                                $name,
                            ); ?></h3>
                            <p class="sort-card-desc"><?php echo htmlspecialchars(
                                mb_substr($desc, 0, 100),
                            ) . "..."; ?></p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val"><?php echo htmlspecialchars(
                                        $mass,
                                    ); ?></span>
                                    <span class="sort-stat-label"><?php echo t(
                                        "stat_mass",
                                        "Масса 1000 зерён",
                                    ); ?></span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val"><?php echo htmlspecialchars(
                                        $yield_t,
                                    ); ?></span>
                                    <span class="sort-stat-label"><?php echo t(
                                        "stat_yield",
                                        "Урожайность",
                                    ); ?></span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val"><?php echo htmlspecialchars(
                                        $year_t,
                                    ); ?></span>
                                    <span class="sort-stat-label"><?php echo t(
                                        "stat_year",
                                        "Допущен",
                                    ); ?></span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <?php foreach (
                                    $v["properties"][$currentLang] ?? $v["properties"]["ru"]
                                    as $prop
                                ): ?>
                                    <span class="sort-prop"><?php echo htmlspecialchars(
                                        $prop,
                                    ); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('<?php echo $modalKey; ?>'); return false;">
                                    <?php echo t(
                                        "more_details",
                                        "Подробнее →",
                                    ); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php
                    endforeach;
                    ?>

                </div><!-- /.cards-grid -->

            </div><!-- /.katalog-content -->
        </div><!-- /.katalog-layout -->
    </div><!-- /.container -->
</section>

<!-- ============================================================
     DETAIL MODALS
     ============================================================ -->
<div class="sort-modal-overlay" id="modalOverlay" onclick="closeModal()">
    <div class="sort-modal" id="sortModal" onclick="event.stopPropagation()">
        <button class="sort-modal-close" onclick="closeModal()">×</button>
        <div class="sort-modal-image">
            <img src="assets/images/barley_field.png" alt="" id="modalImage">
            <div class="sort-modal-badges" id="modalBadges"></div>
        </div>
        <div class="sort-modal-body">
            <div class="sort-modal-type" id="modalType"></div>
            <h2 class="sort-modal-name" id="modalName"></h2>
            <div class="sort-modal-grid" id="modalGrid"></div>
            <div class="sort-modal-desc" id="modalDesc"></div>
            <div class="sort-modal-seeding" id="modalSeeding"></div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script>
/* ================================================================
   MODAL DATA
   ================================================================ */

const sortData = <?php echo json_encode($sortData, JSON_UNESCAPED_UNICODE); ?>;


/* ================================================================
   FILTER STATE
   ================================================================ */
const filters = { culture: 'all', season: 'all', maturity: 'all', drought: 'all' };
const katalogResultsPhrase = "<?php echo addslashes(t("katalog_results_phrase")); ?>";

function setFilter(type, value, el) {
    filters[type] = value;
    // update active chip
    const group = { culture: 'cultureFilter', season: 'seasonFilter', maturity: 'maturityFilter', drought: 'droughtFilter' }[type];
    document.querySelectorAll('#' + group + ' .filter-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    filterCards();
}

function filterCards() {
    const search = document.getElementById('searchSort').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.sort-card');
    let visible = 0;

    cards.forEach(card => {
        const culture  = card.dataset.culture;
        const season   = card.dataset.season;
        const maturity = card.dataset.maturity;
        const drought  = card.dataset.drought;
        const name     = card.dataset.name.toLowerCase();

        const ok =
            (filters.culture  === 'all' || culture  === filters.culture)  &&
            (filters.season   === 'all' || season   === filters.season)    &&
            (filters.maturity === 'all' || maturity === filters.maturity)  &&
            (filters.drought  === 'all' || drought  === filters.drought)   &&
            (search === '' || name.includes(search));

        if (ok) {
            card.style.display = '';
            card.style.animation = 'fadeInCard 0.4s ease both';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('visibleCount').textContent = visible;
    document.getElementById('totalCount').textContent = katalogResultsPhrase.replace('{{count}}', visible);
    document.getElementById('noResults').style.display = visible === 0 ? 'flex' : 'none';
}

function pluralRu(n) {
    const mod10 = n % 10, mod100 = n % 100;
    if (mod10 === 1 && mod100 !== 11) return 'а найден';
    if ([2,3,4].includes(mod10) && ![12,13,14].includes(mod100)) return 'а найдено';
    return 'ов найдено';
}

function resetAllFilters() {
    filters.culture = 'all'; filters.season = 'all'; filters.maturity = 'all'; filters.drought = 'all';
    document.querySelectorAll('.filter-chip').forEach(c => {
        c.classList.toggle('active', c.dataset.value === 'all');
    });
    document.getElementById('searchSort').value = '';
    filterCards();
}

function sortCards() {
    const grid = document.getElementById('cardsGrid');
    const cards = [...grid.querySelectorAll('.sort-card')];
    const val = document.getElementById('sortSelect').value;

    cards.sort((a, b) => {
        if (val === 'name')       return a.dataset.name.localeCompare(b.dataset.name, 'ru');
        if (val === 'yield-desc') return parseFloat(b.dataset.yield) - parseFloat(a.dataset.yield);
        if (val === 'yield-asc')  return parseFloat(a.dataset.yield) - parseFloat(b.dataset.yield);
        if (val === 'year')       return parseInt(a.dataset.year) - parseInt(b.dataset.year);
        return 0;
    });
    cards.forEach(c => grid.appendChild(c));
}

/* ================================================================
   MODAL
   ================================================================ */
function openModal(id) {
    const d = sortData[id];
    if (!d) return;

    document.getElementById('modalType').textContent = d.type;
    document.getElementById('modalName').textContent = d.name;
    document.getElementById('modalBadges').innerHTML =
        `<span class="sort-badge ${d.seasonClass}">${d.season}</span>
         <span class="sort-badge sort-badge-barley">${d.type}</span>`;

    document.getElementById('modalGrid').innerHTML = d.stats.map(s =>
        `<div class="modal-stat">
            <span class="modal-stat-icon">${s.icon}</span>
            <span class="modal-stat-val">${s.val}</span>
            <span class="modal-stat-label">${s.label}</span>
         </div>`
    ).join('');

    document.getElementById('modalDesc').innerHTML = `<p>${d.desc}</p>`;
    document.getElementById('modalSeeding').innerHTML = `<div class="modal-seeding-box">🌱 ${d.seeding}</div>`;

    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    return false;
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

/* ================================================================
   INIT
   ================================================================ */
document.addEventListener('DOMContentLoaded', () => {
    filterCards();
});
</script>
