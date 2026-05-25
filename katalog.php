<?php
include_once 'includes/lang.php';
$page_title = "Каталог сортов";
$page_head = '<link rel="stylesheet" href="assets/css/katalog.css">';
include 'includes/header.php';
?>

<!-- ============================================================
     CATALOG HERO BANNER
     ============================================================ -->
<section class="kataog-hero-section" id="main-content">
    <div class="katalog-hero-overlay"></div>
    <div class="container katalog-hero-inner">
        <h1 class="katalog-hero-title">
            Сорта сельскохозяйственных<br>культур Кыргызстана
        </h1>
        <p class="katalog-hero-desc">
            Научно обоснованные сорта, выведенные Кыргызским НИИ земледелия для всех агроклиматических зон республики
        </p>
        <div class="katalog-hero-stats">
            <div class="katalog-hero-stat">
                <span class="stat-num">20+</span>
                <span class="stat-lbl">Сортов ячменя</span>
            </div>
            <div class="katalog-hero-stat">
                <span class="stat-num">1972</span>
                <span class="stat-lbl">Первый районированный сорт</span>
            </div>
            <div class="katalog-hero-stat">
                <span class="stat-num">85 ц/га</span>
                <span class="stat-lbl">Макс. урожайность</span>
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
                        <span class="sidebar-title">🌾 Фильтр</span>
                        <button class="sidebar-reset" id="resetFilters" onclick="resetAllFilters()">Сбросить</button>
                    </div>

                    <!-- SEARCH -->
                    <div class="filter-group">
                        <label class="filter-group-label">Поиск по названию</label>
                        <div class="filter-search-wrap">
                            <input type="text" id="searchSort" class="filter-search-input" placeholder="Нутанс, Таалай..." oninput="filterCards()">
                            <span class="filter-search-icon">🔍</span>
                        </div>
                    </div>

                    <!-- CULTURE -->
                    <div class="filter-group">
                        <label class="filter-group-label">Культура</label>
                        <div class="filter-chips" id="cultureFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('culture','all',this)">Все</button>
                            <button class="filter-chip" data-value="barley" onclick="setFilter('culture','barley',this)">🌾 Ячмень</button>
                            <button class="filter-chip" data-value="wheat" onclick="setFilter('culture','wheat',this)">🌿 Пшеница</button>
                        </div>
                    </div>

                    <!-- SEASON -->
                    <div class="filter-group">
                        <label class="filter-group-label">Тип посева</label>
                        <div class="filter-chips" id="seasonFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('season','all',this)">Все</button>
                            <button class="filter-chip" data-value="spring" onclick="setFilter('season','spring',this)">☀️ Яровой</button>
                            <button class="filter-chip" data-value="winter" onclick="setFilter('season','winter',this)">❄️ Озимый</button>
                        </div>
                    </div>

                    <!-- MATURITY -->
                    <div class="filter-group">
                        <label class="filter-group-label">Скороспелость</label>
                        <div class="filter-chips" id="maturityFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('maturity','all',this)">Все</button>
                            <button class="filter-chip" data-value="early" onclick="setFilter('maturity','early',this)">Ранний</button>
                            <button class="filter-chip" data-value="mid-early" onclick="setFilter('maturity','mid-early',this)">Среднеранний</button>
                            <button class="filter-chip" data-value="mid" onclick="setFilter('maturity','mid',this)">Среднеспелый</button>
                        </div>
                    </div>

                    <!-- DROUGHT RESISTANCE -->
                    <div class="filter-group">
                        <label class="filter-group-label">Засухоустойчивость</label>
                        <div class="filter-chips" id="droughtFilter">
                            <button class="filter-chip active" data-value="all" onclick="setFilter('drought','all',this)">Все</button>
                            <button class="filter-chip" data-value="high" onclick="setFilter('drought','high',this)">Высокая</button>
                            <button class="filter-chip" data-value="medium" onclick="setFilter('drought','medium',this)">Средняя</button>
                        </div>
                    </div>

                    <div class="filter-count-wrap">
                        <span class="filter-count-text">Показано: <strong id="visibleCount">0</strong> сортов</span>
                    </div>

                </div>
            </aside>

            <!-- ============ CARDS GRID ============ -->
            <div class="katalog-content">

                <!-- RESULTS BAR -->
                <div class="katalog-results-bar">
                    <div class="katalog-results-info">
                        <h2 class="katalog-results-title">Каталог сортов</h2>
                        <span class="katalog-results-count" id="totalCount">0 сортов найдено</span>
                    </div>
                    <div class="katalog-sort-wrap">
                        <select class="katalog-sort-select" id="sortSelect" onchange="sortCards()">
                            <option value="name">По названию А-Я</option>
                            <option value="yield-desc">По урожайности ↓</option>
                            <option value="yield-asc">По урожайности ↑</option>
                            <option value="year">По году допуска</option>
                        </select>
                    </div>
                </div>

                <!-- NO RESULTS MESSAGE -->
                <div class="katalog-no-results" id="noResults" style="display:none;">
                    <div class="no-results-icon">🌱</div>
                    <h3>Сорта не найдены</h3>
                    <p>Попробуйте изменить параметры фильтра</p>
                    <button class="btn-premium btn-premium-accent mt-3" onclick="resetAllFilters()">Сбросить фильтры</button>
                </div>

                <!-- CARDS GRID -->
                <div class="cards-grid" id="cardsGrid">

                    <!-- ========= ЯРОВОЙ ЯЧМЕНЬ ========= -->

                    <!-- НАРЫН 27 -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid"
                        data-drought="high"
                        data-yield="63.4"
                        data-year="1972"
                        data-name="Нарын 27">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Нарын 27" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Нарын 27</h3>
                            <p class="sort-card-desc">Среднеспелый сорт кормового направления. Вегетационный период 85–93 дня, высота растений 80–98 см.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">45,4–50,2 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">63,4 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,8–17,1%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 1972 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('naryn27')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- НУТАНС 970 -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="early"
                        data-drought="high"
                        data-yield="35.4"
                        data-year="1974"
                        data-name="Нутанс 970">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Нутанс 970" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Нутанс 970</h3>
                            <p class="sort-card-desc">Раннеспелый сорт для засушливых и полупустынных условий. Вегетационный период 67–85 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">43,0–47,7 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">35,4 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">15,8–16,0%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 1974 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('nutans970')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- НУТАНС 89 -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid-early"
                        data-drought="medium"
                        data-yield="82"
                        data-year="1994"
                        data-name="Нутанс 89">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Нутанс 89" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Нутанс 89</h3>
                            <p class="sort-card-desc">Интенсивный сорт для орошаемых земель. Высокая устойчивость к болезням и полеганию. Вегетационный период 72–87 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">46,6–53,0 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">82,0 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">12,8–15,5%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 1994 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-medium">💧 Засухоустойчивость: средняя</span>
                                <span class="sort-prop sort-prop-irrigation">🚿 Орошаемые земли</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('nutans89')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ТААЛАЙ -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="early"
                        data-drought="high"
                        data-yield="58"
                        data-year="1997"
                        data-name="Таалай">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Таалай" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Таалай</h3>
                            <p class="sort-card-desc">Раннеспелый сорт для богарных земель. Устойчив к твёрдой и пыльной головне. Вегетационный период 77–83 дня.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">44,7–47,5 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">58,0 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">14,1%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 1997 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: хорошая</span>
                                <span class="sort-prop sort-prop-bogara">🏔️ Богарные земли</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('taalay')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- БЕСТАМ -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid-early"
                        data-drought="high"
                        data-yield="43.1"
                        data-year="2003"
                        data-name="Бестам">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Бестам" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Бестам</h3>
                            <p class="sort-card-desc">Богарный сорт с высокой полевой устойчивостью к мучнистой росе, гельминтоспориозу и каменной головне. Период 71–78 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">48,6–53,2 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">43,1 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">15,2%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2003 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: выше средней</span>
                                <span class="sort-prop sort-prop-bogara">🏔️ Богарные земли</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('bestam')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- КЫЛЫМ -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid-early"
                        data-drought="high"
                        data-yield="46"
                        data-year="2003"
                        data-name="Кылым">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Кылым" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Кылым</h3>
                            <p class="sort-card-desc">Сорт для обеспеченных осадками богарных земель. Высокая устойчивость к мучнистой росе и гельминтоспориозу. Период 74–81 день.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">45,6–48,2 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">46 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,7%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2003 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: выше средней</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('kylym')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- МАКСАТ -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid"
                        data-drought="high"
                        data-yield="74"
                        data-year="2006"
                        data-name="Максат">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Максат" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Максат</h3>
                            <p class="sort-card-desc">Универсальный сорт для высокогорных орошаемых зон. Высокая урожайность 74 ц/га. Вегетационный период 75–89 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">44,5–48,7 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">74 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,3–15,1%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2006 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: выше средней</span>
                                <span class="sort-prop sort-prop-universal">🔄 Универсальный</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('maksat')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ВАТАН -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid-early"
                        data-drought="medium"
                        data-yield="48.5"
                        data-year="2008"
                        data-name="Ватан">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Ватан" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Ватан</h3>
                            <p class="sort-card-desc">Универсальный сорт для высокогорных зон. Высокое содержание крахмала 52,4–57,1%. Требует раннего срока посева.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">46,0–49,1 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">48,5 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,3–14,1%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2008 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-universal">🔄 Универсальный</span>
                                <span class="sort-prop sort-prop-mountain">⛰️ Высокогорье</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('vatan')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ВЛАДЛЕН -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="spring"
                        data-maturity="mid-early"
                        data-drought="high"
                        data-yield="55"
                        data-year="2012"
                        data-name="Владлен">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Владлен" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-spring">Яровой</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень яровой • Нутанс</div>
                            <h3 class="sort-card-name">Владлен</h3>
                            <p class="sort-card-desc">Богарный сорт с очень хорошей устойчивостью к патогенам. Кормового назначения. Вегетационный период 72–77 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">47–53 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">55 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">14,8%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2012 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                                <span class="sort-prop sort-prop-bogara">🏔️ Богарные земли</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('vladlen')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ========= ОЗИМЫЙ ЯЧМЕНЬ ========= -->

                    <!-- АЛЬТА -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="winter"
                        data-maturity="early"
                        data-drought="high"
                        data-yield="68"
                        data-year="2007"
                        data-name="Альта">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Альта" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-winter">Озимый</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень озимый • Нутанс</div>
                            <h3 class="sort-card-name">Альта</h3>
                            <p class="sort-card-desc">Раннеспелый озимый сорт для орошаемых и дождеобеспеченных богарных земель. Вегетационный период 211–232 дня.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">49,8–56,3 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">68,0 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,5%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2007 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                                <span class="sort-prop sort-prop-frost">❄️ Морозостойкий</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('alta')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- АДЕЛЬ -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="winter"
                        data-maturity="early"
                        data-drought="medium"
                        data-yield="56"
                        data-year="2007"
                        data-name="Адель">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Адель" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-winter">Озимый</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень озимый • Нутанс</div>
                            <h3 class="sort-card-name">Адель</h3>
                            <p class="sort-card-desc">Сорт с высокой устойчивостью к болезным и полеганию. Хорошая морозостойкость. Вегетационный период 173–211 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">48 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">56,0 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,0–15,5%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2007 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-frost">❄️ Морозостойкий</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('adel')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ГАУХАР -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="winter"
                        data-maturity="mid-early"
                        data-drought="high"
                        data-yield="85.3"
                        data-year="2005"
                        data-name="Гаухар">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Гаухар" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-winter">Озимый</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень озимый • Паллидум</div>
                            <h3 class="sort-card-name">Гаухар</h3>
                            <p class="sort-card-desc">Выдающийся сорт с урожайностью 85,3 ц/га. Высокая устойчивость к полеганию, головне, гельминтоспориозу и мучнистой росе.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">38,9–46,7 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">85,3 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">10,7–13,6%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2005 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                                <span class="sort-prop sort-prop-frost">❄️ Морозостойкий</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('gaukhar')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- БЕЛЕК -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="winter"
                        data-maturity="early"
                        data-drought="high"
                        data-yield="84.7"
                        data-year="2014"
                        data-name="Белек">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Белек" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-winter">Озимый</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень озимый • Нутанс</div>
                            <h3 class="sort-card-name">Белек</h3>
                            <p class="sort-card-desc">Высокопродуктивный сорт для орошаемых земель. Устойчив к большинству патогенов. Вегетационный период 212–243 дня.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">52,5 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">84,7 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">10,7–14,3%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2014 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                                <span class="sort-prop sort-prop-frost">❄️ Морозостойкий</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('belek')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

                    <!-- ЖЕҢИШ 60 -->
                    <article class="sort-card"
                        data-culture="barley"
                        data-season="winter"
                        data-maturity="early"
                        data-drought="high"
                        data-yield="58.6"
                        data-year="2008"
                        data-name="Жеңиш 60">
                        <div class="sort-card-image">
                            <img src="assets/images/barley_field.png" alt="Сорт ячменя Жеңиш 60" loading="lazy">
                            <div class="sort-card-badges">
                                <span class="sort-badge sort-badge-winter">Озимый</span>
                                <span class="sort-badge sort-badge-barley">Ячмень</span>
                            </div>
                        </div>
                        <div class="sort-card-body">
                            <div class="sort-card-type">Ячмень озимый • Нутанс</div>
                            <h3 class="sort-card-name">Жеңиш 60</h3>
                            <p class="sort-card-desc">Раннеспелый озимый сорт сирийской селекции для орошаемых и богарных земель. Высокая устойчивость к болезням. Период 208–218 дней.</p>
                            <div class="sort-card-stats">
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📦</span>
                                    <span class="sort-stat-val">52,3–55,8 г</span>
                                    <span class="sort-stat-label">Масса 1000 зерён</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🌾</span>
                                    <span class="sort-stat-val">58,6 ц/га</span>
                                    <span class="sort-stat-label">Урожайность</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">🧬</span>
                                    <span class="sort-stat-val">13,3–14,6%</span>
                                    <span class="sort-stat-label">Белок</span>
                                </div>
                                <div class="sort-stat">
                                    <span class="sort-stat-icon">📅</span>
                                    <span class="sort-stat-val">с 2008 г.</span>
                                    <span class="sort-stat-label">Допущен</span>
                                </div>
                            </div>
                            <div class="sort-card-properties">
                                <span class="sort-prop sort-prop-drought-high">💧 Засухоустойчивость: высокая</span>
                                <span class="sort-prop sort-prop-frost">❄️ Морозостойкий</span>
                            </div>
                            <div class="sort-card-footer">
                                <a href="#" class="sort-detail-btn" onclick="openModal('jenish60')">Подробнее →</a>
                            </div>
                        </div>
                    </article>

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

<?php include 'includes/footer.php'; ?>

<script>
/* ================================================================
   MODAL DATA
   ================================================================ */
const sortData = {
    naryn27: {
        name: 'Нарын 27',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '45,4–50,2 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '63,4 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,8–17,1%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–98 см', label: 'Высота растений' },
            { icon: '📅', val: '85–93 дня', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 1972 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен Кыргызским НИИ земледелия методом сложной гибридизации. Среднеспелый сорт кормового направления. Засухоустойчивость высокая. Ниже среднего поражается пыльной и твёрдой головнёй, среднеустойчив к полеганию. Рекомендован для жёсткой богары.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 170 кг/га (все области КР)'
    },
    nutans970: {
        name: 'Нутанс 970',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '43,0–47,7 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '35,4 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '15,8–16,0%', label: 'Белок в зерне' },
            { icon: '📏', val: '80 см', label: 'Высота растений' },
            { icon: '📅', val: '67–85 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 1974 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Раннеспелый сорт кормового направления. Засухоустойчивость высокая. В средней степени поражается гельминтоспориозом, мучнистой росой и твёрдой головнёй. Рекомендуется для засушливых, полупустынных земель Чуйской и Таласской областей.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (Чуйская, Таласская обл.)'
    },
    nutans89: {
        name: 'Нутанс 89',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '46,6–53,0 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '82,0 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '12,8–15,5%', label: 'Белок в зерне' },
            { icon: '📏', val: '85–95 см', label: 'Высота растений' },
            { icon: '📅', val: '72–87 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 1994 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Среднеранний низкостебельный сорт кормового направления. Высокая устойчивость к полеганию и поражению болезнями. Среднеустойчив к засухе. Рекомендуется для возделывания по интенсивной технологии на орошаемых землях всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га (все области КР)'
    },
    taalay: {
        name: 'Таалай',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '44,7–47,5 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '58,0 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '14,1%', label: 'Белок в зерне' },
            { icon: '📏', val: '65–98 см', label: 'Высота растений' },
            { icon: '📅', val: '77–83 дня', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 1997 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом сложного скрещивания с последующим индивидуальным отбором. Раннеспелый сорт кормового направления. Устойчив к поражению твёрдой и пыльной головнёй. Засухоустойчивость хорошая. Рекомендован для богарных земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 150 кг/га (все области КР)'
    },
    bestam: {
        name: 'Бестам',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '48,6–53,2 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '43,1 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '15,2%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–85 см', label: 'Высота растений' },
            { icon: '📅', val: '71–78 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2003 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Среднеранний кормовой сорт. Высокая полевая устойчивость к мучнистой росе, гельминтоспориозу, каменной головне. Слабо восприимчив к пыльной головне. Засухоустойчивость выше средней. Рекомендован для богарных земель.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    kylym: {
        name: 'Кылым',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '45,6–48,2 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '46 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,7%', label: 'Белок в зерне' },
            { icon: '📏', val: '85 см', label: 'Высота растений' },
            { icon: '📅', val: '74–81 день', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2003 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Среднеранний кормовой сорт. Высокая полевая устойчивость к мучнистой росе и гельминтоспориозу. В средней степени поражается пыльной и твёрдой головнёй. Засухоустойчивость выше средней. Рекомендован для дождеобеспеченных богарных земель.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    maksat: {
        name: 'Максат',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '44,5–48,7 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '74 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,3–15,1%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–85 см', label: 'Высота растений' },
            { icon: '📅', val: '75–89 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2006 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Среднеспелый универсальный сорт. Слабо восприимчив к пыльной и каменной головне, гельминтоспориозу. Засухоустойчивость выше средней. Рекомендован для орошаемых земель высокогорных зон Кыргызской Республики.',
        seeding: 'Норма посева: на поливе 180 кг/га (все области КР)'
    },
    vatan: {
        name: 'Ватан',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '46,0–49,1 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '48,5 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,3–14,1%', label: 'Белок в зерне' },
            { icon: '🌿', val: '52,4–57,1%', label: 'Крахмал' },
            { icon: '📏', val: '80–85 см', label: 'Высота растений' },
            { icon: '✅', val: 'с 2008 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Среднеспелый универсальный сорт для высокогорных зон. Высокая устойчивость к каменной головне, практически устойчив к пыльной головне. Необходим ранний срок посева. Рекомендован для земель высокогорных зон всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    vladlen: {
        name: 'Владлен',
        type: 'Ячмень яровой • Нутанс',
        season: 'Яровой',
        seasonClass: 'sort-badge-spring',
        stats: [
            { icon: '📦', val: '47–53 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '55 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '14,8%', label: 'Белок в зерне' },
            { icon: '📏', val: '85 см', label: 'Высота растений' },
            { icon: '📅', val: '72–77 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2012 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом сложной гибридизации Нутанс 3011 × (Нутанс 1963 × Нутанс 2578). Среднеранний кормовой сорт. Высокая устойчивость к наиболее вредоносным патогенам. Засухоустойчивость высокая. Рекомендован для богарных земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    alta: {
        name: 'Альта',
        type: 'Ячмень озимый • Нутанс',
        season: 'Озимый',
        seasonClass: 'sort-badge-winter',
        stats: [
            { icon: '📦', val: '49,8–56,3 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '68,0 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,5%', label: 'Белок в зерне' },
            { icon: '📏', val: '95 см', label: 'Высота растений' },
            { icon: '📅', val: '211–232 дня', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2007 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Раннеспелый озимый кормовой сорт. Устойчив к большинству болезней. Высокая засухо- и морозоустойчивость. Рекомендован для орошаемых и дождеобеспеченных богарных земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    adel: {
        name: 'Адель',
        type: 'Ячмень озимый • Нутанс',
        season: 'Озимый',
        seasonClass: 'sort-badge-winter',
        stats: [
            { icon: '📦', val: '48 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '56,0 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,0–15,5%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–95 см', label: 'Высота растений' },
            { icon: '📅', val: '173–211 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2007 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен методом гибридизации. Раннеспелый кормовой озимый сорт. Характеризуется высокой устойчивостью к наиболее вредоносным болезням. Устойчив к полеганию. Хорошая морозоустойчивость. Рекомендован для орошаемых и дождеобеспеченных богарных земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    },
    gaukhar: {
        name: 'Гаухар',
        type: 'Ячмень озимый • Паллидум',
        season: 'Озимый',
        seasonClass: 'sort-badge-winter',
        stats: [
            { icon: '📦', val: '38,9–46,7 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '85,3 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '10,7–13,6%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–95 см', label: 'Высота растений' },
            { icon: '📅', val: '235–251 день', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2005 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен путём гибридизации украинской линии с английским коллекционным образцом. Среднеранний кормовой сорт. Высокая устойчивость к полеганию, пыльной и твёрдой головне, гельминтоспориозу и мучнистой росе. Высокая засухо- и морозоустойчивость. Рекомендован для орошаемых земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га (все области КР)'
    },
    belek: {
        name: 'Белек',
        type: 'Ячмень озимый • Нутанс',
        season: 'Озимый',
        seasonClass: 'sort-badge-winter',
        stats: [
            { icon: '📦', val: '52,5 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '84,7 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '10,7–14,3%', label: 'Белок в зерне' },
            { icon: '📏', val: '80–95 см', label: 'Высота растений' },
            { icon: '📅', val: '212–243 дня', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2014 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Выведен из интродуцированной гибридной популяции методом индивидуального отбора. Быстроспелый кормовой озимый сорт. Устойчив к большинству патогенов. Высокая засухо- и морозоустойчивость. Рекомендован для орошаемых земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га (все области КР)'
    },
    jenish60: {
        name: 'Жеңиш 60',
        type: 'Ячмень озимый • Нутанс',
        season: 'Озимый',
        seasonClass: 'sort-badge-winter',
        stats: [
            { icon: '📦', val: '52,3–55,8 г', label: 'Масса 1000 зерён' },
            { icon: '🌾', val: '58,6 ц/га', label: 'Потенц. урожайность' },
            { icon: '🧬', val: '13,3–14,6%', label: 'Белок в зерне' },
            { icon: '📏', val: '75–80 см', label: 'Высота растений' },
            { icon: '📅', val: '208–218 дней', label: 'Вегетационный период' },
            { icon: '✅', val: 'с 2008 г.', label: 'Допущен к использованию' },
        ],
        desc: 'Получен из интродуцированной гибридной популяции сирийской селекции методом индивидуального отбора. Раннеспелый кормовой озимый сорт. Высокая устойчивость к полеганию, пыльной и твёрдой головне, гельминтоспориозу, мучнистой росе. Высокая засухо- и морозоустойчивость. Рекомендован для орошаемых и дождеобеспеченных богарных земель всех областей КР.',
        seeding: 'Норма посева: на поливе 180 кг/га, на богаре 160 кг/га (все области КР)'
    }
};

/* ================================================================
   FILTER STATE
   ================================================================ */
const filters = { culture: 'all', season: 'all', maturity: 'all', drought: 'all' };

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
    document.getElementById('totalCount').textContent = visible + ' сорт' + pluralRu(visible);
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
         <span class="sort-badge sort-badge-barley">Ячмень</span>`;

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