<?php
include_once "includes/lang.php";
$page_title = t("nav_administration");
$page_description = t("meta_desc_administration");
$page_keywords = t("meta_keys_administration");
$page_head =
    '<link rel="stylesheet" href="assets/css/organization.css?v=' .
    time() .
    '">';
include "includes/header.php";

// Helper function to extract initials for beautiful fallback avatars
if (!function_exists("getInitials")) {
    function getInitials($fullName)
    {
        $parts = explode(" ", trim($fullName));
        $initials = "";
        if (isset($parts[0])) {
            $initials .= mb_substr($parts[0], 0, 1, "UTF-8");
        }
        if (isset($parts[1])) {
            $initials .= mb_substr($parts[1], 0, 1, "UTF-8");
        }
        return mb_strtoupper($initials, "UTF-8");
    }
}

// Load staff data from JSON (editable via admin panel)
$admin_json_file = __DIR__ . "/database/administration.json";
$staff_data = is_file($admin_json_file)
    ? json_decode(file_get_contents($admin_json_file), true)
    : [];
if (!is_array($staff_data)) {
    $staff_data = [];
}

$lang = currentLang();
?>

<main class="organization-page" id="main-content">
    <div class="org-container container">

        <!-- Header Section -->
        <div class="org-header text-center">
            <h1 class="org-title"><?php echo t("nav_administration"); ?></h1>
            <p class="org-subtitle"><?php echo t("admin_subtitle"); ?></p>
        </div>

        <!-- Filter & Search Controls -->
        <div class="controls-glasscard mb-5">
            <div class="row align-items-center gap-3 gap-md-0">
                <!-- Search Bar -->
                <div class="col-12 col-md-5">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="employeeSearch" class="employee-search" placeholder="<?php echo t(
                            "admin_search_placeholder",
                        ); ?>">
                        <button type="button" class="clear-search-btn" id="clearSearch" style="display:none;">&times;</button>
                    </div>
                </div>
                <!-- Filter Tabs -->
                <div class="col-12 col-md-7">
                    <div class="filter-tabs-wrapper">
                        <button type="button" class="filter-tab active" data-tab="all"><?php echo t(
                            "admin_tab_all",
                        ); ?></button>
                        <button type="button" class="filter-tab" data-tab="admin"><?php echo t(
                            "admin_tab_admin",
                        ); ?></button>
                        <button type="button" class="filter-tab" data-tab="science"><?php echo t(
                            "admin_tab_science",
                        ); ?></button>
                        <button type="button" class="filter-tab" data-tab="branches"><?php echo t(
                            "admin_tab_branches",
                        ); ?></button>
                    </div>
                </div>
            </div>
            <div class="search-feedback-text mt-3 text-center" id="searchFeedback" style="display:none;"></div>
        </div>

        <!-- ==================== TABS CONTENT ==================== -->

        <!-- SECTION 1: Leadership & Administrative Support -->
        <div class="tab-content-section" id="section-admin">
            <h2 class="category-heading">
                <span>🏢</span>
                <?php echo t("admin_section_leadership"); ?>
            </h2>

            <!-- Leadership Tree Grid -->
            <div class="leadership-row mb-5">
                <?php foreach ($staff_data["leadership"] as $employee):

                    $emp_name = $employee["name"][$lang];
                    $emp_role = $employee["role"][$lang];
                    $initials = getInitials($employee["name"]["ru"]);
                    ?>
                    <div class="employee-card card-premium <?php echo $employee[
                        "grade"
                    ]; ?>-card" data-employee-name="<?php echo htmlspecialchars(
    $emp_name,
); ?>" data-employee-role="<?php echo htmlspecialchars(
    $emp_role,
); ?>" data-employee-email="<?php echo htmlspecialchars(
    $employee["email"],
); ?>">
                        <div class="card-glow"></div>
                        <div class="avatar-wrapper">
                            <?php if (
                                !empty($employee["image"]) &&
                                file_exists($employee["image"])
                            ): ?>
                                <img src="<?php echo $employee[
                                    "image"
                                ]; ?>" alt="<?php echo htmlspecialchars(
    $emp_name,
); ?>" class="employee-avatar-img">
                            <?php else: ?>
                                <div class="employee-avatar-initials grade-<?php echo $employee[
                                    "grade"
                                ]; ?>">
                                    <span><?php echo $initials; ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="role-badge"><?php echo $employee[
                                "grade"
                            ] == "director"
                                ? "👑"
                                : ($employee["grade"] == "deputy"
                                    ? "🔑"
                                    : "📝"); ?></span>
                        </div>
                        <h3 class="employee-name-title"><?php echo htmlspecialchars(
                            $emp_name,
                        ); ?></h3>
                        <p class="employee-role-text"><?php echo htmlspecialchars(
                            $emp_role,
                        ); ?></p>
                        <span class="dept-badge"><?php echo $lang == "en"
                            ? "Management"
                            : ($lang == "ky"
                                ? "Жетекчилик"
                                : "Руководство"); ?></span>

                        <?php if (!empty($employee["email"])): ?>
                            <a href="mailto:<?php echo $employee[
                                "email"
                            ]; ?>" class="email-btn-modern mt-3" title="Отправить email">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span><?php echo htmlspecialchars(
                                    $employee["email"],
                                ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php
                endforeach; ?>
            </div>

            <!-- Administrative Support Department -->
            <div class="dept-container-glass mb-5">
                <div class="dept-glass-header">
                    <span class="dept-icon-circle">📂</span>
                    <div>
                        <h3 class="dept-glass-title"><?php echo t(
                            "admin_support_dept",
                        ); ?></h3>
                        <p class="dept-glass-subtitle"><?php echo t(
                            "admin_support_desc",
                        ); ?></p>
                    </div>
                </div>

                <div class="staff-grid-modern">
                    <?php foreach ($staff_data["admin_support"] as $employee):

                        $emp_name = $employee["name"][$lang];
                        $emp_role = $employee["role"][$lang];
                        $initials = getInitials($employee["name"]["ru"]);
                        $card_class =
                            $employee["grade"] == "head"
                                ? "head-card highlighted-border"
                                : "";
                        ?>
                        <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars(
    $emp_name,
); ?>" data-employee-role="<?php echo htmlspecialchars(
    $emp_role,
); ?>" data-employee-email="<?php echo htmlspecialchars(
    $employee["email"],
); ?>">
                            <div class="card-glow"></div>
                            <div class="avatar-wrapper">
                                <?php if (
                                    !empty($employee["image"]) &&
                                    file_exists($employee["image"])
                                ): ?>
                                    <img src="<?php echo $employee[
                                        "image"
                                    ]; ?>" alt="<?php echo htmlspecialchars(
    $emp_name,
); ?>" class="employee-avatar-img">
                                <?php else: ?>
                                    <div class="employee-avatar-initials grade-<?php echo $employee[
                                        "grade"
                                    ]; ?>">
                                        <span><?php echo $initials; ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (
                                    $employee["grade"] == "head"
                                ): ?><span class="role-badge">⭐</span><?php endif; ?>
                            </div>
                            <h4 class="employee-name-title"><?php echo htmlspecialchars(
                                $emp_name,
                            ); ?></h4>
                            <p class="employee-role-text"><?php echo htmlspecialchars(
                                $emp_role,
                            ); ?></p>

                            <?php if (!empty($employee["email"])): ?>
                                <a href="mailto:<?php echo $employee[
                                    "email"
                                ]; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span><?php echo htmlspecialchars(
                                        $employee["email"],
                                    ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Scientific Departments -->
        <div class="tab-content-section" id="section-science" style="display:none;">
            <h2 class="category-heading">
                <span>🔬</span>
                <?php echo t("admin_section_science"); ?>
            </h2>

            <?php foreach ($staff_data["departments"] as $dept_id => $dept):
                $dept_title = $dept["title"][$lang]; ?>
                <div class="dept-container-glass mb-5" data-dept-id="<?php echo $dept_id; ?>">
                    <div class="dept-glass-header">
                        <span class="dept-icon-circle"><?php echo $dept[
                            "icon"
                        ]; ?></span>
                        <div>
                            <h3 class="dept-glass-title"><?php echo htmlspecialchars(
                                $dept_title,
                            ); ?></h3>
                            <p class="dept-glass-subtitle"><?php echo $lang ==
                            "en"
                                ? "Leading breeding and primary seed research"
                                : ($lang == "ky"
                                    ? "Алдыңкы селекция жана баштапкы үрөн изилдөөлөрү"
                                    : "Ведущие селекционные и первичные исследования"); ?></p>
                        </div>
                    </div>

                    <div class="staff-grid-modern">
                        <?php foreach ($dept["staff"] as $employee):

                            $emp_name = $employee["name"][$lang];
                            $emp_role = $employee["role"][$lang];
                            $initials = getInitials($employee["name"]["ru"]);
                            $card_class =
                                $employee["grade"] == "head"
                                    ? "head-card highlighted-border"
                                    : "";
                            ?>
                            <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars(
    $emp_name,
); ?>" data-employee-role="<?php echo htmlspecialchars(
    $emp_role,
); ?>" data-employee-email="<?php echo htmlspecialchars(
    $employee["email"],
); ?>" data-dept-name="<?php echo htmlspecialchars($dept_title); ?>">
                                <div class="card-glow"></div>
                                <div class="avatar-wrapper">
                                    <?php if (!empty($employee["image"])): ?>
                                        <img src="<?php echo $employee[
                                            "image"
                                        ]; ?>" alt="<?php echo htmlspecialchars(
    $emp_name,
); ?>" class="employee-avatar-img">
                                    <?php else: ?>
                                        <div class="employee-avatar-initials grade-<?php echo $employee[
                                            "grade"
                                        ]; ?>">
                                            <span><?php echo $initials; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (
                                        $employee["grade"] == "head"
                                    ): ?><span class="role-badge">⭐</span><?php endif; ?>
                                </div>
                                <h4 class="employee-name-title"><?php echo htmlspecialchars(
                                    $emp_name,
                                ); ?></h4>
                                <p class="employee-role-text"><?php echo htmlspecialchars(
                                    $emp_role,
                                ); ?></p>

                                <?php if (!empty($employee["email"])): ?>
                                    <a href="mailto:<?php echo $employee[
                                        "email"
                                    ]; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span><?php echo htmlspecialchars(
                                            $employee["email"],
                                        ); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>

        <!-- SECTION 3: Branches & Regional Stations -->
        <div class="tab-content-section" id="section-branches" style="display:none;">
            <h2 class="category-heading">
                <span>🌍</span>
                <?php echo t("admin_section_branches"); ?>
            </h2>

            <div class="branches-flex-grid">
                <?php foreach ($staff_data["branches"] as $branch):
                    $branch_title = $branch["title"][$lang]; ?>
                    <div class="branch-glass-card mb-4" data-branch-id="<?php echo $branch[
                        "id"
                    ]; ?>">
                        <div class="branch-glass-header-bar">
                            <div class="branch-icon-badge">🏢</div>
                            <div class="branch-header-info">
                                <h3 class="branch-card-title"><?php echo htmlspecialchars(
                                    $branch_title,
                                ); ?></h3>
                                <p class="branch-location-text">📍 <?php echo htmlspecialchars(
                                    $branch["location"],
                                ); ?></p>
                            </div>
                        </div>

                        <!-- Direct Branch Staff -->
                        <div class="branch-main-staff-list p-4">
                            <h4 class="branch-inner-subtitle"><?php echo t(
                                "admin_branch_management",
                            ); ?></h4>
                            <div class="staff-grid-modern">
                                <?php foreach ($branch["staff"] as $employee):

                                    $emp_name = $employee["name"][$lang];
                                    $emp_role = $employee["role"][$lang];
                                    $initials = getInitials(
                                        $employee["name"]["ru"],
                                    );
                                    $card_class =
                                        $employee["grade"] == "director"
                                            ? "director-card highlighted-border"
                                            : "";
                                    ?>
                                    <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars(
    $emp_name,
); ?>" data-employee-role="<?php echo htmlspecialchars(
    $emp_role,
); ?>" data-employee-email="<?php echo htmlspecialchars(
    $employee["email"],
); ?>" data-branch-name="<?php echo htmlspecialchars($branch_title); ?>">
                                        <div class="card-glow"></div>
                                        <div class="avatar-wrapper">
                                            <?php if (
                                                !empty($employee["image"])
                                            ): ?>
                                                <img src="<?php echo $employee[
                                                    "image"
                                                ]; ?>" alt="<?php echo htmlspecialchars(
    $emp_name,
); ?>" class="employee-avatar-img">
                                            <?php else: ?>
                                                <div class="employee-avatar-initials grade-<?php echo $employee[
                                                    "grade"
                                                ]; ?>">
                                                    <span><?php echo $initials; ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (
                                                $employee["grade"] == "director"
                                            ): ?><span class="role-badge">👑</span><?php endif; ?>
                                        </div>
                                        <h5 class="employee-name-title"><?php echo htmlspecialchars(
                                            $emp_name,
                                        ); ?></h5>
                                        <p class="employee-role-text"><?php echo htmlspecialchars(
                                            $emp_role,
                                        ); ?></p>

                                        <?php if (
                                            !empty($employee["email"])
                                        ): ?>
                                            <a href="mailto:<?php echo $employee[
                                                "email"
                                            ]; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                                <span><?php echo htmlspecialchars(
                                                    $employee["email"],
                                                ); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                endforeach; ?>
                            </div>
                        </div>

                        <!-- Nested Sub-departments (like Fruit/Berry and Sugar Beet under №1 Sugar Beet Station) -->
                        <?php if (!empty($branch["sub_departments"])): ?>
                            <div class="branch-sub-departments p-4 pt-0">
                                <?php foreach (
                                    $branch["sub_departments"]
                                    as $sub_dept
                                ):
                                    $sub_title = $sub_dept["title"][$lang]; ?>
                                    <div class="sub-dept-wrapper mb-4">
                                        <h5 class="sub-dept-label-heading"><?php echo htmlspecialchars(
                                            $sub_title,
                                        ); ?></h5>
                                        <div class="staff-grid-modern">
                                            <?php foreach (
                                                $sub_dept["staff"]
                                                as $employee
                                            ):

                                                $emp_name =
                                                    $employee["name"][$lang];
                                                $emp_role =
                                                    $employee["role"][$lang];
                                                $initials = getInitials(
                                                    $employee["name"]["ru"],
                                                );
                                                $card_class =
                                                    $employee["grade"] == "head"
                                                        ? "head-card highlighted-border"
                                                        : "";
                                                ?>
                                                <div class="employee-card card-premium <?php echo $card_class; ?>" data-employee-name="<?php echo htmlspecialchars(
    $emp_name,
); ?>" data-employee-role="<?php echo htmlspecialchars(
    $emp_role,
); ?>" data-employee-email="<?php echo htmlspecialchars(
    $employee["email"],
); ?>" data-branch-name="<?php echo htmlspecialchars(
    $branch_title,
); ?>" data-dept-name="<?php echo htmlspecialchars($sub_title); ?>">
                                                    <div class="card-glow"></div>
                                                    <div class="avatar-wrapper">
                                                        <?php if (
                                                            !empty(
                                                                $employee[
                                                                    "image"
                                                                ]
                                                            )
                                                        ): ?>
                                                            <img src="<?php echo $employee[
                                                                "image"
                                                            ]; ?>" alt="<?php echo htmlspecialchars(
    $emp_name,
); ?>" class="employee-avatar-img">
                                                        <?php else: ?>
                                                            <div class="employee-avatar-initials grade-<?php echo $employee[
                                                                "grade"
                                                            ]; ?>">
                                                                <span><?php echo $initials; ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (
                                                            $employee[
                                                                "grade"
                                                            ] == "head"
                                                        ): ?><span class="role-badge">⭐</span><?php endif; ?>
                                                    </div>
                                                    <h5 class="employee-name-title"><?php echo htmlspecialchars(
                                                        $emp_name,
                                                    ); ?></h5>
                                                    <p class="employee-role-text"><?php echo htmlspecialchars(
                                                        $emp_role,
                                                    ); ?></p>

                                                    <?php if (
                                                        !empty(
                                                            $employee["email"]
                                                        )
                                                    ): ?>
                                                        <a href="mailto:<?php echo $employee[
                                                            "email"
                                                        ]; ?>" class="email-btn-modern mt-auto" title="Отправить email">
                                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                                <polyline points="22,6 12,13 2,6"></polyline>
                                                            </svg>
                                                            <span><?php echo htmlspecialchars(
                                                                $employee[
                                                                    "email"
                                                                ],
                                                            ); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php
                                            endforeach; ?>
                                        </div>
                                    </div>
                                <?php
                                endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                endforeach; ?>
            </div>
        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('employeeSearch');
    const clearSearchBtn = document.getElementById('clearSearch');
    const tabButtons = document.querySelectorAll('.filter-tab');
    const sectionAdmin = document.getElementById('section-admin');
    const sectionScience = document.getElementById('section-science');
    const sectionBranches = document.getElementById('section-branches');
    const searchFeedback = document.getElementById('searchFeedback');

    const sections = {
        'admin': [sectionAdmin],
        'science': [sectionScience],
        'branches': [sectionBranches],
        'all': [sectionAdmin, sectionScience, sectionBranches]
    };

    let activeTab = 'all';

    // 1. Tab Switching Function
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            tabButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeTab = this.getAttribute('data-tab');

            // Switch tabs visually
            Object.keys(sections).forEach(key => {
                if (key !== 'all') {
                    sections[key].forEach(sec => sec.style.display = 'none');
                }
            });

            sections[activeTab].forEach(sec => {
                sec.style.display = 'block';
            });

            // Re-apply filter based on search input
            filterStaff();
        });
    });

    // 2. Real-time Search Filtering
    searchInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
        filterStaff();
    });

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        searchInput.focus();
        filterStaff();
    });

    function filterStaff() {
        const query = searchInput.value.toLowerCase().trim();
        let totalMatches = 0;
        let totalCards = 0;

        // Reset all cards, depts, branches visibility first
        const allCards = document.querySelectorAll('.employee-card');
        allCards.forEach(card => {
            card.classList.remove('highlight-match', 'fade-out');
            card.style.display = '';
        });

        const allDeptContainers = document.querySelectorAll('.dept-container-glass');
        allDeptContainers.forEach(cont => cont.style.display = '');

        const allBranchCards = document.querySelectorAll('.branch-glass-card');
        allBranchCards.forEach(card => card.style.display = '');

        const subDeptWrappers = document.querySelectorAll('.sub-dept-wrapper');
        subDeptWrappers.forEach(w => w.style.display = '');

        if (query.length > 0) {
            // Apply filtering logic
            allCards.forEach(card => {
                const name = (card.getAttribute('data-employee-name') || '').toLowerCase();
                const role = (card.getAttribute('data-employee-role') || '').toLowerCase();
                const email = (card.getAttribute('data-employee-email') || '').toLowerCase();
                const dept = (card.getAttribute('data-dept-name') || '').toLowerCase();
                const branch = (card.getAttribute('data-branch-name') || '').toLowerCase();

                const isMatch = name.includes(query) || role.includes(query) || email.includes(query) || dept.includes(query) || branch.includes(query);

                if (isMatch) {
                    card.classList.add('highlight-match');
                    totalMatches++;
                } else {
                    card.classList.add('fade-out');
                    card.style.display = 'none';
                }
                totalCards++;
            });

            // Clean up department headers and branch containers that have 0 matches inside
            allDeptContainers.forEach(container => {
                const visibleCards = container.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    container.style.display = 'none';
                }
            });

            subDeptWrappers.forEach(wrapper => {
                const visibleCards = wrapper.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    wrapper.style.display = 'none';
                }
            });

            allBranchCards.forEach(branchCard => {
                const visibleCards = branchCard.querySelectorAll('.employee-card:not([style*="display: none"])');
                if (visibleCards.length === 0) {
                    branchCard.style.display = 'none';
                }
            });

            // Display Feedback text
            searchFeedback.style.display = 'block';
            if (totalMatches > 0) {
                searchFeedback.innerHTML = `<?php echo t(
                    "admin_search_found",
                ); ?>: <strong>${totalMatches}</strong>`;
                searchFeedback.style.color = '#10b981';
            } else {
                searchFeedback.innerHTML = `<?php echo t(
                    "admin_search_not_found",
                ); ?> "<strong>${query}</strong>"`;
                searchFeedback.style.color = '#f43f5e';
            }
        } else {
            // Hide feedback if query is empty
            searchFeedback.style.display = 'none';
        }

        // Handle tabs visibility matching (ensure only active tab sections are shown)
        Object.keys(sections).forEach(key => {
            if (key !== 'all') {
                sections[key].forEach(sec => {
                    if (activeTab === 'all' || activeTab === key) {
                        sec.style.display = 'block';
                    } else {
                        sec.style.display = 'none';
                    }
                });
            }
        });
    }

    // Initialize animation delayed loads
    const premiumCards = document.querySelectorAll('.card-premium');
    premiumCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-in');
        }, index * 25);
    });
});
</script>

<?php include "includes/footer.php"; ?>
