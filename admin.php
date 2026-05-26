<?php
session_start();

// --- Загрузка конфига ---
$adminConfig = [];
$adminConfigFile = __DIR__ . "/config/admin_config.php";
if (is_file($adminConfigFile)) {
    $adminConfig = require $adminConfigFile;
}
$passwordHash =
    $adminConfig["password_hash"] ?? password_hash("admin123", PASSWORD_BCRYPT);
$maxAttempts = (int) ($adminConfig["max_login_attempts"] ?? 5);
$lockoutTime = (int) ($adminConfig["lockout_duration"] ?? 900);

// --- Brute force check ---
$loginAttempts = (int) ($_SESSION["login_attempts"] ?? 0);
$lastAttemptTime = (int) ($_SESSION["last_attempt_at"] ?? 0);
$isLockedOut =
    $loginAttempts >= $maxAttempts && time() - $lastAttemptTime < $lockoutTime;

// --- Logout ---
if (isset($_GET["logout"])) {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $p = session_get_cookie_params();
        setcookie(
            session_name(),
            "",
            time() - 42000,
            $p["path"],
            $p["domain"],
            $p["secure"],
            $p["httponly"],
        );
    }
    session_destroy();
    header("Location: admin.php");
    exit();
}

// --- Login ---
if (isset($_POST["password"]) && !$isLockedOut) {
    $inputPassword = $_POST["password"] ?? "";

    if (password_verify($inputPassword, $passwordHash)) {
        // Успешный вход
        $_SESSION["login_attempts"] = 0;
        $_SESSION["last_attempt_at"] = 0;
        session_regenerate_id(true);
        $_SESSION["is_admin"] = true;
        $_SESSION["admin_ip"] = $_SERVER["REMOTE_ADDR"];
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION["login_attempts"] = $loginAttempts + 1;
        $_SESSION["last_attempt_at"] = time();
        $remainingAttempts = max(0, $maxAttempts - $_SESSION["login_attempts"]);
        if ($remainingAttempts > 0) {
            $error = "Неверный пароль. Осталось попыток: {$remainingAttempts}";
        } else {
            $error =
                "Слишком много попыток. Подождите " .
                ceil($lockoutTime / 60) .
                " минут.";
        }
    }
} elseif ($isLockedOut) {
    $waitSeconds = $lockoutTime - (time() - $lastAttemptTime);
    $error =
        "Доступ заблокирован. Подождите " . ceil($waitSeconds / 60) . " мин.";
}

// --- Check if already authed ---
if (!empty($_SESSION["is_admin"])) {

    include_once __DIR__ . "/includes/lang.php";
    include_once __DIR__ . "/includes/news_helpers.php";

    /**
     * Безопасная загрузка изображения.
     * Проверяет расширение, MIME-тип и размер файла.
     * Возвращает имя файла или false при ошибке.
     */
    function secureUploadImage(
        array $file,
        string $uploadDir,
        string $prefix = "img_",
    ): string|false {
        $allowedExtensions = ["jpg", "jpeg", "png", "webp", "gif"];
        $allowedMimes = ["image/jpeg", "image/png", "image/webp", "image/gif"];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        if ($file["error"] !== UPLOAD_ERR_OK) {
            return false;
        }
        if ($file["size"] > $maxFileSize) {
            return false;
        }

        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions, true)) {
            return false;
        }

        // Проверка MIME через finfo (реальный тип, не из заголовка)
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file["tmp_name"]);
        if (!in_array($mime, $allowedMimes, true)) {
            return false;
        }

        // Дополнительно: проверяем, что это валидное изображение
        $imgInfo = @getimagesize($file["tmp_name"]);
        if ($imgInfo === false) {
            return false;
        }

        // Генерируем безопасное имя
        $fname = $prefix . bin2hex(random_bytes(8)) . "." . $ext;
        if (!move_uploaded_file($file["tmp_name"], $uploadDir . $fname)) {
            return false;
        }

        return $fname;
    }

    $section = $_GET["section"] ?? "news";

    // Paths
    $news_file = __DIR__ . "/database/news.json";
    $news_upload_dir = __DIR__ . "/uploads/news/";
    if (!is_dir($news_upload_dir)) {
        mkdir($news_upload_dir, 0777, true);
    }

    $site_upload_dir = __DIR__ . "/uploads/site/";
    if (!is_dir($site_upload_dir)) {
        mkdir($site_upload_dir, 0777, true);
    }

    $katalog_upload_dir = __DIR__ . "/uploads/katalog/";
    if (!is_dir($katalog_upload_dir)) {
        mkdir($katalog_upload_dir, 0777, true);
    }

    $admin_upload_dir = __DIR__ . "/uploads/administration/";
    if (!is_dir($admin_upload_dir)) {
        mkdir($admin_upload_dir, 0777, true);
    }

    $overrides_file = __DIR__ . "/database/lang_overrides.json";
    $missing_file = __DIR__ . "/database/lang_missing.json";
    $feedback_file = __DIR__ . "/database/feedback.json";
    $image_overrides_file = __DIR__ . "/database/image_overrides.json";
    $katalog_file = __DIR__ . "/database/katalog.json";
    $administration_file = __DIR__ . "/database/administration.json";

    $success = "";
    $error_msg = "";

    // ---------- NEWS ----------
    if ($section === "news") {
        $all_news = is_file($news_file)
            ? json_decode(file_get_contents($news_file), true)
            : [];
        if (!is_array($all_news)) {
            $all_news = [];
        }

        // delete
        if (isset($_GET["delete"])) {
            $id = (int) $_GET["delete"];
            if (isset($all_news[$id])) {
                if (
                    !empty($all_news[$id]["images"]) &&
                    is_array($all_news[$id]["images"])
                ) {
                    foreach ($all_news[$id]["images"] as $img) {
                        $img_path = $news_upload_dir . basename($img);
                        if (is_file($img_path)) {
                            @unlink($img_path);
                        }
                    }
                }
                array_splice($all_news, $id, 1);
                file_put_contents(
                    $news_file,
                    json_encode(
                        $all_news,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                header("Location: admin.php?section=news");
                exit();
            }
        }

        // add/edit
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["news_save"])
        ) {
            $edit_id =
                ($_POST["edit_id"] ?? "") !== ""
                    ? (int) $_POST["edit_id"]
                    : null;
            $date = trim($_POST["news_date"] ?? "") ?: date("Y-m-d");

            $title_ru = trim($_POST["news_title_ru"] ?? "");
            $title_en = trim($_POST["news_title_en"] ?? "");
            $title_ky = trim($_POST["news_title_ky"] ?? "");
            $text_ru = trim($_POST["news_text_ru"] ?? "");
            $text_en = trim($_POST["news_text_en"] ?? "");
            $text_ky = trim($_POST["news_text_ky"] ?? "");

            $images = [];
            if (
                $edit_id !== null &&
                isset($all_news[$edit_id]["images"]) &&
                is_array($all_news[$edit_id]["images"])
            ) {
                $images = $all_news[$edit_id]["images"];
            }

            // upload images
            if (!empty($_FILES["news_images"]["name"][0])) {
                foreach (
                    $_FILES["news_images"]["tmp_name"]
                    as $k => $tmp_name
                ) {
                    if ($tmp_name) {
                        $fakeFile = [
                            "name" => $_FILES["news_images"]["name"][$k],
                            "tmp_name" => $tmp_name,
                            "error" =>
                                $_FILES["news_images"]["error"][$k] ??
                                UPLOAD_ERR_NO_FILE,
                            "size" => $_FILES["news_images"]["size"][$k] ?? 0,
                        ];
                        $fname = secureUploadImage(
                            $fakeFile,
                            $news_upload_dir,
                            "news_",
                        );
                        if ($fname) {
                            $images[] = $fname;
                        }
                    }
                }
            }

            $news_item = [
                "title" => [
                    "ru" => $title_ru,
                    "en" => $title_en,
                    "ky" => $title_ky,
                ],
                "text" => [
                    "ru" => $text_ru,
                    "en" => $text_en,
                    "ky" => $text_ky,
                ],
                "date" => $date,
                "images" => $images,
            ];

            if ($edit_id !== null && isset($all_news[$edit_id])) {
                $all_news[$edit_id] = $news_item;
                $success = "Новость обновлена!";
            } else {
                $all_news[] = $news_item;
                $success = "Новость добавлена!";
            }
            file_put_contents(
                $news_file,
                json_encode(
                    $all_news,
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                ),
            );
        }

        // edit form
        $edit_news = null;
        $edit_id = null;
        if (isset($_GET["edit"])) {
            $edit_id = (int) $_GET["edit"];
            if (isset($all_news[$edit_id])) {
                $edit_news = normalizeNewsItem($all_news[$edit_id]);
            }
        }

        // normalize list for preview
        foreach ($all_news as $i => $n) {
            $all_news[$i] = normalizeNewsItem($n);
        }
    }

    // ---------- TRANSLATIONS ----------
    if ($section === "translations") {
        $overrides = is_file($overrides_file)
            ? json_decode(file_get_contents($overrides_file), true)
            : [];
        if (!is_array($overrides)) {
            $overrides = [];
        }
        foreach (["ru", "en", "ky"] as $lc) {
            if (!isset($overrides[$lc]) || !is_array($overrides[$lc])) {
                $overrides[$lc] = [];
            }
        }

        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["save_translations"])
        ) {
            $ru = $_POST["ru"] ?? [];
            $en = $_POST["en"] ?? [];
            $ky = $_POST["ky"] ?? [];
            if (is_array($ru) && is_array($en) && is_array($ky)) {
                $keys = array_unique(
                    array_merge(
                        array_keys($ru),
                        array_keys($en),
                        array_keys($ky),
                    ),
                );
                foreach ($keys as $key) {
                    $key = trim((string) $key);
                    if ($key === "") {
                        continue;
                    }
                    $overrides["ru"][$key] = trim((string) ($ru[$key] ?? ""));
                    $overrides["en"][$key] = trim((string) ($en[$key] ?? ""));
                    $overrides["ky"][$key] = trim((string) ($ky[$key] ?? ""));
                }
                file_put_contents(
                    $overrides_file,
                    json_encode(
                        $overrides,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                $success = "Переводы сохранены!";
                // перезагрузка страницы, чтобы lang.php подхватил overrides
                header("Location: admin.php?section=translations&saved=1");
                exit();
            }
        }

        $missing = is_file($missing_file)
            ? json_decode(file_get_contents($missing_file), true)
            : [];
        if (!is_array($missing)) {
            $missing = [];
        }

        // собрать все ключи
        $allKeys = array_unique(
            array_merge(
                array_keys($_lang["ru"] ?? []),
                array_keys($_lang["en"] ?? []),
                array_keys($_lang["ky"] ?? []),
            ),
        );
        sort($allKeys);

        $q = trim($_GET["q"] ?? "");
        if ($q !== "") {
            $allKeys = array_values(
                array_filter($allKeys, function ($k) use ($q) {
                    return stripos($k, $q) !== false;
                }),
            );
        }

        $page = max(1, (int) ($_GET["page"] ?? 1));
        $perPage = 30;
        $total = count($allKeys);
        $pages = max(1, (int) ceil($total / $perPage));
        if ($page > $pages) {
            $page = $pages;
        }
        $slice = array_slice($allKeys, ($page - 1) * $perPage, $perPage);
    }

    // ---------- FEEDBACK ----------
    if ($section === "feedback") {
        $feedback = is_file($feedback_file)
            ? json_decode(file_get_contents($feedback_file), true)
            : [];
        if (!is_array($feedback)) {
            $feedback = [];
        }

        // Delete
        if (isset($_GET["delete"])) {
            $id = (int) $_GET["delete"];
            if (isset($feedback[$id])) {
                array_splice($feedback, $id, 1);
                file_put_contents(
                    $feedback_file,
                    json_encode(
                        $feedback,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                header("Location: admin.php?section=feedback");
                exit();
            }
        }

        // Mark as read
        if (isset($_GET["mark_read"])) {
            $id = (int) $_GET["mark_read"];
            if (isset($feedback[$id])) {
                $feedback[$id]["read"] = true;
                file_put_contents(
                    $feedback_file,
                    json_encode(
                        $feedback,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                header("Location: admin.php?section=feedback");
                exit();
            }
        }

        // Mark all as read
        if (isset($_GET["mark_all_read"])) {
            foreach ($feedback as &$f) {
                $f["read"] = true;
            }
            unset($f);
            file_put_contents(
                $feedback_file,
                json_encode(
                    $feedback,
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                ),
            );
            header("Location: admin.php?section=feedback");
            exit();
        }
    }

    // ---------- IMAGES ----------
    if ($section === "images") {
        $imgOverrides = is_file($image_overrides_file)
            ? json_decode(file_get_contents($image_overrides_file), true)
            : [];
        if (!is_array($imgOverrides)) {
            $imgOverrides = [];
        }

        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["upload_image"])
        ) {
            $key = trim($_POST["image_key"] ?? "");
            if ($key === "") {
                $error_msg = "Не указан ключ картинки.";
            } elseif (
                empty($_FILES["image_file"]["tmp_name"]) ||
                ($_FILES["image_file"]["error"] ?? 1) !== 0
            ) {
                $error_msg = "Файл не выбран или ошибка загрузки.";
            } else {
                $fname = secureUploadImage(
                    $_FILES["image_file"],
                    $site_upload_dir,
                    "site_",
                );
                if ($fname) {
                    // относительный путь для сайта
                    $imgOverrides[$key] = "uploads/site/" . $fname;
                    file_put_contents(
                        $image_overrides_file,
                        json_encode(
                            $imgOverrides,
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                    $success = "Картинка обновлена!";
                    header("Location: admin.php?section=images");
                    exit();
                } else {
                    $error_msg =
                        "Ошибка загрузки: недопустимый тип или размер файла (макс. 5 MB, форматы: jpg, png, webp, gif).";
                }
            }
        }

        if (isset($_GET["remove"])) {
            $key = trim($_GET["remove"]);
            if ($key !== "" && isset($imgOverrides[$key])) {
                unset($imgOverrides[$key]);
                file_put_contents(
                    $image_overrides_file,
                    json_encode(
                        $imgOverrides,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                header("Location: admin.php?section=images");
                exit();
            }
        }
    }

    // ---------- KATALOG ----------
    if ($section === "katalog") {
        $katalog = is_file($katalog_file)
            ? json_decode(file_get_contents($katalog_file), true)
            : [];
        if (!is_array($katalog)) {
            $katalog = [];
        }

        // Delete variety
        if (isset($_GET["delete"])) {
            $id = (int) $_GET["delete"];
            if (isset($katalog[$id])) {
                array_splice($katalog, $id, 1);
                file_put_contents(
                    $katalog_file,
                    json_encode(
                        $katalog,
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
                header("Location: admin.php?section=katalog");
                exit();
            }
        }

        // Save variety
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["katalog_save"])
        ) {
            $edit_id =
                ($_POST["edit_id"] ?? "") !== ""
                    ? (int) $_POST["edit_id"]
                    : null;

            $variety = [
                "id" => trim($_POST["variety_id"] ?? "") ?: "v_" . uniqid(),
                "name" => [
                    "ru" => trim($_POST["name_ru"] ?? ""),
                    "en" => trim($_POST["name_en"] ?? ""),
                    "ky" => trim($_POST["name_ky"] ?? ""),
                ],
                "culture" => trim($_POST["culture"] ?? "barley"),
                "season" => trim($_POST["season"] ?? "spring"),
                "maturity" => trim($_POST["maturity"] ?? "mid"),
                "drought" => trim($_POST["drought"] ?? "medium"),
                "yield_num" => trim($_POST["yield_num"] ?? ""),
                "year_num" => trim($_POST["year_num"] ?? ""),
                "image" => "barley_field.png",
                "type" => [
                    "ru" => trim($_POST["type_ru"] ?? ""),
                    "en" => trim($_POST["type_en"] ?? ""),
                    "ky" => trim($_POST["type_ky"] ?? ""),
                ],
                "description" => [
                    "ru" => trim($_POST["desc_ru"] ?? ""),
                    "en" => trim($_POST["desc_en"] ?? ""),
                    "ky" => trim($_POST["desc_ky"] ?? ""),
                ],
                "mass" => [
                    "ru" => trim($_POST["mass_ru"] ?? ""),
                    "en" => trim($_POST["mass_en"] ?? ""),
                    "ky" => trim($_POST["mass_ky"] ?? ""),
                ],
                "yield_text" => [
                    "ru" => trim($_POST["yield_text_ru"] ?? ""),
                    "en" => trim($_POST["yield_text_en"] ?? ""),
                    "ky" => trim($_POST["yield_text_ky"] ?? ""),
                ],
                "protein" => [
                    "ru" => trim($_POST["protein_ru"] ?? ""),
                    "en" => trim($_POST["protein_en"] ?? ""),
                    "ky" => trim($_POST["protein_ky"] ?? ""),
                ],
                "year_text" => [
                    "ru" => trim($_POST["year_text_ru"] ?? ""),
                    "en" => trim($_POST["year_text_en"] ?? ""),
                    "ky" => trim($_POST["year_text_ky"] ?? ""),
                ],
                "properties" => [
                    "ru" => array_filter(
                        array_map(
                            "trim",
                            explode("\n", $_POST["props_ru"] ?? ""),
                        ),
                    ),
                    "en" => array_filter(
                        array_map(
                            "trim",
                            explode("\n", $_POST["props_en"] ?? ""),
                        ),
                    ),
                    "ky" => array_filter(
                        array_map(
                            "trim",
                            explode("\n", $_POST["props_ky"] ?? ""),
                        ),
                    ),
                ],
                "modal_key" =>
                    trim($_POST["modal_key"] ?? "") ?:
                    strtolower(
                        preg_replace(
                            "/[^a-zA-Z0-9]/",
                            "",
                            trim($_POST["name_ru"] ?? ""),
                        ),
                    ),
                "seeding" => [
                    "ru" => trim($_POST["seeding_ru"] ?? ""),
                    "en" => trim($_POST["seeding_en"] ?? ""),
                    "ky" => trim($_POST["seeding_ky"] ?? ""),
                ],
            ];

            // Handle image upload
            if (
                !empty($_FILES["variety_image"]["tmp_name"]) &&
                $_FILES["variety_image"]["error"] === 0
            ) {
                $fname = secureUploadImage(
                    $_FILES["variety_image"],
                    $katalog_upload_dir,
                    "sort_",
                );
                if ($fname) {
                    $variety["image"] = "uploads/katalog/" . $fname; // path relative to site root
                } elseif (
                    $edit_id !== null &&
                    isset($katalog[$edit_id]["image"])
                ) {
                    $variety["image"] = $katalog[$edit_id]["image"];
                }
            } elseif ($edit_id !== null && isset($katalog[$edit_id]["image"])) {
                $variety["image"] = $katalog[$edit_id]["image"];
            }

            if ($edit_id !== null && isset($katalog[$edit_id])) {
                $katalog[$edit_id] = $variety;
                $success = "Сорт обновлен!";
            } else {
                $katalog[] = $variety;
                $success = "Сорт добавлен!";
            }
            file_put_contents(
                $katalog_file,
                json_encode(
                    $katalog,
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                ),
            );
        }

        // edit form
        $edit_variety = null;
        $edit_id = null;
        if (isset($_GET["edit"])) {
            $edit_id = (int) $_GET["edit"];
            if (isset($katalog[$edit_id])) {
                $edit_variety = $katalog[$edit_id];
            }
        }
    }

    // ---------- ADMINISTRATION ----------
    if ($section === "administration") {
        $admin_data = is_file($administration_file)
            ? json_decode(file_get_contents($administration_file), true)
            : [];
        if (!is_array($admin_data)) {
            $admin_data = [];
        }

        $sub = $_GET["sub"] ?? "leadership";

        // Add staff member
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["staff_save"])
        ) {
            $target_section = $_POST["target_section"] ?? "leadership";
            $target_dept = $_POST["target_dept"] ?? "";
            $staff_edit_id =
                ($_POST["staff_edit_id"] ?? "") !== ""
                    ? (int) $_POST["staff_edit_id"]
                    : null;

            $new_staff = [
                "name" => [
                    "ru" => trim($_POST["staff_name_ru"] ?? ""),
                    "en" => trim($_POST["staff_name_en"] ?? ""),
                    "ky" => trim($_POST["staff_name_ky"] ?? ""),
                ],
                "role" => [
                    "ru" => trim($_POST["staff_role_ru"] ?? ""),
                    "en" => trim($_POST["staff_role_en"] ?? ""),
                    "ky" => trim($_POST["staff_role_ky"] ?? ""),
                ],
                "email" => trim($_POST["staff_email"] ?? ""),
                "image" => "",
                "grade" => trim($_POST["staff_grade"] ?? "staff"),
            ];

            // Handle image upload
            if (
                !empty($_FILES["staff_image"]["tmp_name"]) &&
                $_FILES["staff_image"]["error"] === 0
            ) {
                $fname = secureUploadImage(
                    $_FILES["staff_image"],
                    $admin_upload_dir,
                    "staff_",
                );
                if ($fname) {
                    $new_staff["image"] = "uploads/administration/" . $fname;
                }
            }

            // Save to appropriate section
            if (
                $target_section === "leadership" ||
                $target_section === "admin_support"
            ) {
                if (
                    !isset($admin_data[$target_section]) ||
                    !is_array($admin_data[$target_section])
                ) {
                    $admin_data[$target_section] = [];
                }
                if (
                    $staff_edit_id !== null &&
                    isset($admin_data[$target_section][$staff_edit_id])
                ) {
                    if (
                        empty($new_staff["image"]) &&
                        !empty(
                            $admin_data[$target_section][$staff_edit_id][
                                "image"
                            ]
                        )
                    ) {
                        $new_staff["image"] =
                            $admin_data[$target_section][$staff_edit_id][
                                "image"
                            ];
                    }
                    $admin_data[$target_section][$staff_edit_id] = $new_staff;
                    $success = "Сотрудник обновлен!";
                } else {
                    $admin_data[$target_section][] = $new_staff;
                    $success = "Сотрудник добавлен!";
                }
            } elseif (
                $target_section === "departments" &&
                $target_dept !== ""
            ) {
                if (!isset($admin_data["departments"][$target_dept]["staff"])) {
                    $admin_data["departments"][$target_dept]["staff"] = [];
                }
                if (
                    $staff_edit_id !== null &&
                    isset(
                        $admin_data["departments"][$target_dept]["staff"][
                            $staff_edit_id
                        ],
                    )
                ) {
                    if (
                        empty($new_staff["image"]) &&
                        !empty(
                            $admin_data["departments"][$target_dept]["staff"][
                                $staff_edit_id
                            ]["image"]
                        )
                    ) {
                        $new_staff["image"] =
                            $admin_data["departments"][$target_dept]["staff"][
                                $staff_edit_id
                            ]["image"];
                    }
                    $admin_data["departments"][$target_dept]["staff"][
                        $staff_edit_id
                    ] = $new_staff;
                    $success = "Сотрудник обновлен!";
                } else {
                    $admin_data["departments"][$target_dept][
                        "staff"
                    ][] = $new_staff;
                    $success = "Сотрудник добавлен!";
                }
            }

            file_put_contents(
                $administration_file,
                json_encode(
                    $admin_data,
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                ),
            );
        }

        // Delete staff member
        if (isset($_GET["del_staff"])) {
            $del_section = $_GET["del_section"] ?? "";
            $del_dept = $_GET["del_dept"] ?? "";
            $del_idx = (int) ($_GET["del_staff"] ?? -1);

            if (
                $del_section === "leadership" ||
                $del_section === "admin_support"
            ) {
                if (isset($admin_data[$del_section][$del_idx])) {
                    array_splice($admin_data[$del_section], $del_idx, 1);
                    file_put_contents(
                        $administration_file,
                        json_encode(
                            $admin_data,
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
            } elseif ($del_section === "departments" && $del_dept !== "") {
                if (
                    isset(
                        $admin_data["departments"][$del_dept]["staff"][
                            $del_idx
                        ],
                    )
                ) {
                    array_splice(
                        $admin_data["departments"][$del_dept]["staff"],
                        $del_idx,
                        1,
                    );
                    file_put_contents(
                        $administration_file,
                        json_encode(
                            $admin_data,
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
            }
            header(
                "Location: admin.php?section=administration&sub=" .
                    urlencode($sub),
            );
            exit();
        }
    }

    // ---------- DEPARTMENTS (structure_*.json) ----------
    if ($section === "departments") {
        $dept_langs = ["ru", "en", "ky"];
        $dept_data = [];
        $dept_files = [];
        foreach ($dept_langs as $lc) {
            $f = __DIR__ . "/database/structure_{$lc}.json";
            $dept_files[$lc] = $f;
            $raw = is_file($f) ? json_decode(file_get_contents($f), true) : [];
            $dept_data[$lc] = is_array($raw) ? $raw : [];
        }
        // Dynamic: load dept IDs from JSON keys (not hardcoded)
        $dept_ids = array_keys($dept_data["ru"]);
        sort($dept_ids);
        // Labels from badge field in JSON
        $dept_labels = [];
        foreach ($dept_ids as $did) {
            $dept_labels[$did] = $dept_data["ru"][$did]["badge"] ?? $did;
        }
        $dept_item = $_GET["dept"] ?? ($dept_ids[0] ?? "wheat");
        if (!in_array($dept_item, $dept_ids, true)) {
            $dept_item = $dept_ids[0] ?? "wheat";
        }
        $dept_upload_dir = __DIR__ . "/uploads/departments/";
        if (!is_dir($dept_upload_dir)) {
            mkdir($dept_upload_dir, 0777, true);
        }

        // Save main info
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["dept_info_save"])
        ) {
            $d = $_POST["dept_item"] ?? $dept_item;
            if (in_array($d, $dept_ids, true)) {
                foreach ($dept_langs as $lc) {
                    if (!isset($dept_data[$lc][$d])) {
                        $dept_data[$lc][$d] = [];
                    }
                    $dept_data[$lc][$d]["summary"] = trim(
                        $_POST["summary_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["activity"] = trim(
                        $_POST["activity_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["research"] = array_values(
                        array_filter(
                            array_map(
                                "trim",
                                explode("\n", $_POST["research_{$lc}"] ?? ""),
                            ),
                        ),
                    );
                    $dept_data[$lc][$d]["results_list"] = array_values(
                        array_filter(
                            array_map(
                                "trim",
                                explode(
                                    "\n",
                                    $_POST["results_list_{$lc}"] ?? "",
                                ),
                            ),
                        ),
                    );
                    $dept_data[$lc][$d]["results"] = trim(
                        $_POST["results_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["international"] = trim(
                        $_POST["international_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["publications"] = trim(
                        $_POST["publications_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["projects_current"] = trim(
                        $_POST["projects_current_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["projects_completed"] = trim(
                        $_POST["projects_completed_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["events"] = trim(
                        $_POST["events_{$lc}"] ?? "",
                    );
                    $dept_data[$lc][$d]["perspectives"] = trim(
                        $_POST["perspectives_{$lc}"] ?? "",
                    );
                }
                $badge = trim($_POST["badge"] ?? "");
                foreach ($dept_langs as $lc) {
                    $dept_data[$lc][$d]["badge"] = $badge;
                }
                // Hero image
                if (
                    !empty($_FILES["hero_image"]["tmp_name"]) &&
                    $_FILES["hero_image"]["error"] === 0
                ) {
                    $fname = secureUploadImage(
                        $_FILES["hero_image"],
                        $dept_upload_dir,
                        "dept_",
                    );
                    if ($fname) {
                        foreach ($dept_langs as $lc) {
                            $dept_data[$lc][$d]["hero_image"] =
                                "uploads/departments/" . $fname;
                        }
                    }
                }
                foreach ($dept_langs as $lc) {
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
                $success = "Информация отдела сохранена!";
                header(
                    "Location: admin.php?section=departments&dept={$d}&saved=1",
                );
                exit();
            }
        }

        // Save head
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["dept_head_save"])
        ) {
            $d = $_POST["dept_item"] ?? $dept_item;
            if (in_array($d, $dept_ids, true)) {
                $cur_img = $dept_data["ru"][$d]["head"]["image"] ?? "";
                if (
                    !empty($_FILES["head_image"]["tmp_name"]) &&
                    $_FILES["head_image"]["error"] === 0
                ) {
                    $fname = secureUploadImage(
                        $_FILES["head_image"],
                        $dept_upload_dir,
                        "head_",
                    );
                    if ($fname) {
                        $cur_img = "uploads/departments/" . $fname;
                    }
                }
                $head = [
                    "name" => trim($_POST["head_name"] ?? ""),
                    "position" => trim($_POST["head_position"] ?? ""),
                    "phone" => trim($_POST["head_phone"] ?? ""),
                    "honors" => trim($_POST["head_honors"] ?? ""),
                    "degree" => trim($_POST["head_degree"] ?? ""),
                    "education" => trim($_POST["head_education"] ?? ""),
                    "image" => $cur_img,
                ];
                foreach ($dept_langs as $lc) {
                    if (!isset($dept_data[$lc][$d])) {
                        $dept_data[$lc][$d] = [];
                    }
                    $dept_data[$lc][$d]["head"] = $head;
                }
                foreach ($dept_langs as $lc) {
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
                $success = "Заведующий обновлён!";
                header(
                    "Location: admin.php?section=departments&dept={$d}&saved=1",
                );
                exit();
            }
        }

        // Add/edit staff in dept
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["dept_staff_save"])
        ) {
            $d = $_POST["dept_item"] ?? $dept_item;
            $si =
                ($_POST["dept_staff_edit_id"] ?? "") !== ""
                    ? (int) $_POST["dept_staff_edit_id"]
                    : null;
            if (in_array($d, $dept_ids, true)) {
                $cur_img =
                    $si !== null &&
                    isset($dept_data["ru"][$d]["staff"][$si]["image"])
                        ? $dept_data["ru"][$d]["staff"][$si]["image"]
                        : "";
                if (
                    !empty($_FILES["dstaff_image"]["tmp_name"]) &&
                    $_FILES["dstaff_image"]["error"] === 0
                ) {
                    $fname = secureUploadImage(
                        $_FILES["dstaff_image"],
                        $dept_upload_dir,
                        "dstaff_",
                    );
                    if ($fname) {
                        $cur_img = "uploads/departments/" . $fname;
                    }
                }
                $ns = [
                    "name" => trim($_POST["dstaff_name"] ?? ""),
                    "experience" => trim($_POST["dstaff_experience"] ?? ""),
                    "position" => trim($_POST["dstaff_position"] ?? ""),
                    "degree" => trim($_POST["dstaff_degree"] ?? ""),
                    "title" => trim($_POST["dstaff_title_field"] ?? ""),
                    "education" => trim($_POST["dstaff_education"] ?? ""),
                    "image" => $cur_img,
                ];
                foreach ($dept_langs as $lc) {
                    if (!isset($dept_data[$lc][$d]["staff"])) {
                        $dept_data[$lc][$d]["staff"] = [];
                    }
                    if (
                        $si !== null &&
                        isset($dept_data[$lc][$d]["staff"][$si])
                    ) {
                        $dept_data[$lc][$d]["staff"][$si] = $ns;
                    } else {
                        $dept_data[$lc][$d]["staff"][] = $ns;
                    }
                }
                foreach ($dept_langs as $lc) {
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
                $success =
                    $si !== null
                        ? "Сотрудник обновлён!"
                        : "Сотрудник добавлен!";
                header(
                    "Location: admin.php?section=departments&dept={$d}&saved=1",
                );
                exit();
            }
        }

        // Create new department
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["create_dept"])
        ) {
            $new_id = trim(
                preg_replace(
                    "/[^a-z0-9_]/",
                    "",
                    strtolower($_POST["new_dept_id"] ?? ""),
                ),
            );
            $new_badge = trim($_POST["new_dept_badge"] ?? $new_id);
            if ($new_id !== "" && !isset($dept_data["ru"][$new_id])) {
                $empty_dept = [
                    "badge" => $new_badge,
                    "hero_image" => "",
                    "summary" => "",
                    "activity" => "",
                    "research" => [],
                    "results_list" => [],
                    "results" => "",
                    "international" => "",
                    "publications" => "",
                    "projects_current" => "",
                    "projects_completed" => "",
                    "events" => "",
                    "perspectives" => "",
                    "staff" => [],
                    "head" => [],
                ];
                foreach ($dept_langs as $lc) {
                    $dept_data[$lc][$new_id] = $empty_dept;
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
                $success = "Отдел «{$new_id}» создан!";
                header(
                    "Location: admin.php?section=departments&dept={$new_id}&saved=1",
                );
                exit();
            } else {
                $error_msg =
                    $new_id === ""
                        ? "Введите ID отдела (латинские буквы/цифры)."
                        : "Отдел с таким ID уже существует.";
            }
        }

        // Delete department
        if (isset($_GET["delete_dept"])) {
            $d = trim($_GET["delete_dept"] ?? "");
            if ($d !== "" && isset($dept_data["ru"][$d])) {
                foreach ($dept_langs as $lc) {
                    unset($dept_data[$lc][$d]);
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
                header("Location: admin.php?section=departments&saved=1");
                exit();
            }
        }

        // Delete dept staff
        if (isset($_GET["del_dstaff"])) {
            $d = $_GET["dept"] ?? "";
            $idx = (int) ($_GET["del_dstaff"] ?? -1);
            if (in_array($d, $dept_ids, true)) {
                foreach ($dept_langs as $lc) {
                    if (isset($dept_data[$lc][$d]["staff"][$idx])) {
                        array_splice($dept_data[$lc][$d]["staff"], $idx, 1);
                    }
                }
                foreach ($dept_langs as $lc) {
                    file_put_contents(
                        $dept_files[$lc],
                        json_encode(
                            $dept_data[$lc],
                            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                        ),
                    );
                }
            }
            header("Location: admin.php?section=departments&dept={$d}");
            exit();
        }
    }

    // ---------- BRANCHES (branches_*.json) ----------
    if ($section === "branches") {
        $br_langs = ["ru", "en", "ky"];
        $br_data = [];
        $br_files = [];
        foreach ($br_langs as $lc) {
            $f = __DIR__ . "/database/branches_{$lc}.json";
            $br_files[$lc] = $f;
            $raw = is_file($f) ? json_decode(file_get_contents($f), true) : [];
            $br_data[$lc] = is_array($raw) ? array_values($raw) : [];
        }
        $br_upload_dir = __DIR__ . "/uploads/branches/";
        if (!is_dir($br_upload_dir)) {
            mkdir($br_upload_dir, 0777, true);
        }

        // Delete
        if (isset($_GET["delete_branch"])) {
            $idx = (int) $_GET["delete_branch"];
            foreach ($br_langs as $lc) {
                if (isset($br_data[$lc][$idx])) {
                    array_splice($br_data[$lc], $idx, 1);
                }
            }
            foreach ($br_langs as $lc) {
                file_put_contents(
                    $br_files[$lc],
                    json_encode(
                        array_values($br_data[$lc]),
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
            }
            header("Location: admin.php?section=branches");
            exit();
        }

        // Save
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["branch_save"])
        ) {
            $eid =
                ($_POST["edit_id"] ?? "") !== ""
                    ? (int) $_POST["edit_id"]
                    : null;
            $cur_img_br =
                $eid !== null && isset($br_data["ru"][$eid]["image"])
                    ? $br_data["ru"][$eid]["image"]
                    : "assets/images/wheet.png";
            if (
                !empty($_FILES["branch_image"]["tmp_name"]) &&
                $_FILES["branch_image"]["error"] === 0
            ) {
                $fname = secureUploadImage(
                    $_FILES["branch_image"],
                    $br_upload_dir,
                    "branch_",
                );
                if ($fname) {
                    $cur_img_br = "uploads/branches/" . $fname;
                }
            }
            $shared = [
                "area" => trim($_POST["branch_area"] ?? ""),
                "director" => trim($_POST["branch_director"] ?? ""),
                "phone" => trim($_POST["branch_phone"] ?? ""),
                "image" => $cur_img_br,
            ];
            foreach ($br_langs as $lc) {
                $item = array_merge(
                    [
                        "title" => trim($_POST["branch_title_{$lc}"] ?? ""),
                        "address" => trim($_POST["branch_address_{$lc}"] ?? ""),
                        "activity" => trim(
                            $_POST["branch_activity_{$lc}"] ?? "",
                        ),
                    ],
                    $shared,
                );
                if ($eid !== null && isset($br_data[$lc][$eid])) {
                    $br_data[$lc][$eid] = $item;
                } else {
                    $br_data[$lc][] = $item;
                }
            }
            foreach ($br_langs as $lc) {
                file_put_contents(
                    $br_files[$lc],
                    json_encode(
                        array_values($br_data[$lc]),
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
            }
            $success =
                $eid !== null ? "Станция обновлена!" : "Станция добавлена!";
            header("Location: admin.php?section=branches&saved=1");
            exit();
        }

        $edit_branch = null;
        $edit_branch_id = null;
        if (isset($_GET["edit_branch"])) {
            $edit_branch_id = (int) $_GET["edit_branch"];
            if (isset($br_data["ru"][$edit_branch_id])) {
                $edit_branch = [];
                foreach ($br_langs as $lc) {
                    $edit_branch[$lc] = $br_data[$lc][$edit_branch_id] ?? [];
                }
            }
        }
    }

    // ---------- SETTINGS ----------
    if ($section === "settings") {
        include_once __DIR__ . "/includes/site_settings.php";
        $settings = getSiteSettings();

        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["save_settings"])
        ) {
            $emails_raw = trim($_POST["contact_emails"] ?? "");
            $settings["contact_form_recipients"] = array_values(
                array_filter(array_map("trim", explode("\n", $emails_raw))),
            );
            saveSiteSettings($settings);
            $success = "Настройки сохранены!";
        }

        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["change_password"])
        ) {
            $cur = $_POST["current_password"] ?? "";
            $new1 = $_POST["new_password"] ?? "";
            $new2 = $_POST["new_password_again"] ?? "";
            if (!password_verify($cur, $passwordHash)) {
                $error_msg = "Неверный текущий пароль.";
            } elseif (mb_strlen($new1) < 8) {
                $error_msg = "Новый пароль — минимум 8 символов.";
            } elseif ($new1 !== $new2) {
                $error_msg = "Новые пароли не совпадают.";
            } else {
                $newHash = password_hash($new1, PASSWORD_BCRYPT, [
                    "cost" => 12,
                ]);
                $cfgFile = __DIR__ . "/config/admin_config.php";
                $cfgData = is_file($cfgFile) ? require $cfgFile : [];
                $cfgData["password_hash"] = $newHash;
                $cfgContent =
                    "<?php\nreturn " . var_export($cfgData, true) . ";\n";
                file_put_contents($cfgFile, $cfgContent);
                $success = "Пароль успешно изменён!";
            }
        }
    }

    // ---------- GALLERY ----------
    if ($section === "gallery") {
        $gallery_file = __DIR__ . "/database/gallery.json";
        $gallery_up_dir = __DIR__ . "/uploads/gallery/";
        if (!is_dir($gallery_up_dir)) {
            mkdir($gallery_up_dir, 0777, true);
        }

        $gallery_items = is_file($gallery_file)
            ? (json_decode(file_get_contents($gallery_file), true) ?:
            [])
            : [];
        if (!is_array($gallery_items)) {
            $gallery_items = [];
        }

        // Delete
        if (isset($_GET["delete_gallery"])) {
            $idx = (int) $_GET["delete_gallery"];
            if (isset($gallery_items[$idx])) {
                array_splice($gallery_items, $idx, 1);
                file_put_contents(
                    $gallery_file,
                    json_encode(
                        array_values($gallery_items),
                        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                    ),
                );
            }
            header("Location: admin.php?section=gallery");
            exit();
        }

        // Save (add / edit)
        if (
            $_SERVER["REQUEST_METHOD"] === "POST" &&
            isset($_POST["gallery_save"])
        ) {
            $eid =
                ($_POST["edit_id"] ?? "") !== ""
                    ? (int) $_POST["edit_id"]
                    : null;
            $cur_img = $eid !== null ? $gallery_items[$eid]["image"] ?? "" : "";
            if (
                !empty($_FILES["gallery_image"]["tmp_name"]) &&
                $_FILES["gallery_image"]["error"] === 0
            ) {
                $fname = secureUploadImage(
                    $_FILES["gallery_image"],
                    $gallery_up_dir,
                    "gal_",
                );
                if ($fname) {
                    $cur_img = "uploads/gallery/" . $fname;
                }
            }
            $item = [
                "image" => $cur_img,
                "title" => [
                    "ru" => trim($_POST["title_ru"] ?? ""),
                    "en" => trim($_POST["title_en"] ?? ""),
                    "ky" => trim($_POST["title_ky"] ?? ""),
                ],
                "category" => [
                    "ru" => trim($_POST["category_ru"] ?? ""),
                    "en" => trim($_POST["category_en"] ?? ""),
                    "ky" => trim($_POST["category_ky"] ?? ""),
                ],
            ];
            if ($eid !== null && isset($gallery_items[$eid])) {
                $gallery_items[$eid] = $item;
                $success = "Фото обновлено!";
            } else {
                $gallery_items[] = $item;
                $success = "Фото добавлено!";
            }
            file_put_contents(
                $gallery_file,
                json_encode(
                    array_values($gallery_items),
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                ),
            );
            header("Location: admin.php?section=gallery&saved=1");
            exit();
        }

        $edit_gallery = null;
        $edit_gallery_id = null;
        if (isset($_GET["edit_gallery"])) {
            $edit_gallery_id = (int) $_GET["edit_gallery"];
            $edit_gallery = $gallery_items[$edit_gallery_id] ?? null;
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Админ-панель</title>
        <style>
            * { box-sizing: border-box; }
            body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; margin: 0; color: #333; }
            .wrap { max-width: 1200px; margin: 20px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden; }
            header { background: linear-gradient(135deg, #1a5c30, #2d8a4e); color: #fff; padding: 16px 24px; display:flex; align-items:center; justify-content:space-between; }
            header a { color: #fff; text-decoration: none; opacity: .9; transition: opacity .2s; }
            header a:hover { opacity: 1; }
            nav { display:flex; gap: 6px; flex-wrap:wrap; padding: 12px 20px; border-bottom: 1px solid #e8e8e8; background:#fafbfc; }
            nav a { text-decoration:none; color:#1a5c30; padding: 8px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; transition: all .2s; }
            nav a:hover { background: #e8f5e9; }
            nav a.active { background:#1a5c30; color:#fff; }
            .content { padding: 20px 24px 32px; }
            .success { background:#e8f5e9; border:1px solid #a5d6a7; padding:12px 16px; border-radius:10px; color:#1b5e20; margin: 0 0 16px; display:flex; align-items:center; gap:8px; }
            .success::before { content:'✅'; }
            .error { background:#fce4ec; border:1px solid #ef9a9a; padding:12px 16px; border-radius:10px; color:#b71c1c; margin: 0 0 16px; display:flex; align-items:center; gap:8px; }
            .error::before { content:'❌'; }
            input, textarea, select { width:100%; padding:10px 12px; border-radius:8px; border:1px solid #d0d5dd; font-size:14px; transition: border-color .2s; }
            input:focus, textarea:focus, select:focus { outline: none; border-color: #1a5c30; box-shadow: 0 0 0 3px rgba(26,92,48,0.1); }
            textarea { min-height: 80px; resize: vertical; }
            label { font-size: 13px; color: #555; font-weight: 500; display: block; margin-bottom: 4px; }
            .row { display:flex; gap: 12px; flex-wrap: wrap; }
            .col { flex:1; min-width: 200px; }
            .btn { background: linear-gradient(135deg, #1a5c30, #2d8a4e); color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer; font-size:14px; font-weight:500; transition: transform .1s, box-shadow .2s; }
            .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(26,92,48,0.3); }
            .btn:active { transform: translateY(0); }
            .btn-secondary { background: #4b5563; }
            .btn-secondary:hover { box-shadow: 0 4px 12px rgba(75,85,99,0.3); }
            .btn-danger { background: #dc2626; }
            .btn-danger:hover { box-shadow: 0 4px 12px rgba(220,38,38,0.3); }
            .btn-sm { padding: 6px 12px; font-size: 13px; }
            table { width:100%; border-collapse: collapse; }
            th, td { border-bottom:1px solid #f0f0f0; padding:10px 8px; vertical-align: top; font-size: 14px; }
            th { background:#f8faf8; color:#1a5c30; text-align:left; font-weight: 600; position: sticky; top: 0; }
            .key { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 13px; color:#374151; background: #f3f4f6; padding: 2px 6px; border-radius: 4px; }
            .small { font-size: 12px; color:#6b7280; }
            .imgprev { max-width: 100px; max-height: 70px; border-radius: 8px; border:1px solid #e5e7eb; object-fit: cover; }
            h2 { color: #1a5c30; font-size: 20px; margin: 0 0 16px; padding-bottom: 8px; border-bottom: 2px solid #e8f5e9; }
            h3 { color: #2d5a3e; font-size: 16px; margin: 20px 0 12px; }
            .card { background: #f8faf8; border: 1px solid #e8f0e8; border-radius: 10px; padding: 16px; margin-bottom: 12px; }
            .sub-nav { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
            .sub-nav a { text-decoration: none; color: #1a5c30; padding: 6px 14px; border-radius: 6px; font-size: 13px; background: #f0f7f0; border: 1px solid #d0e8d0; transition: all .2s; }
            .sub-nav a:hover { background: #e0f0e0; }
            .sub-nav a.active { background: #1a5c30; color: #fff; border-color: #1a5c30; }
            .staff-row { display: flex; align-items: center; gap: 12px; padding: 10px; background: #fff; border: 1px solid #e8e8e8; border-radius: 8px; margin-bottom: 8px; }
            .staff-avatar { width: 48px; height: 48px; border-radius: 50%; background: #e8f5e9; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #1a5c30; font-size: 16px; overflow: hidden; flex-shrink: 0; }
            .staff-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .staff-info { flex: 1; }
            .staff-name { font-weight: 600; font-size: 14px; }
            .staff-role { font-size: 12px; color: #666; }
            .staff-actions { display: flex; gap: 8px; }
            .form-section { background: #f8faf8; border: 1px solid #e0e8e0; border-radius: 10px; padding: 16px; margin-bottom: 16px; }
            .form-section h3 { margin-top: 0; }
            details { margin-bottom: 14px; }
            details summary { cursor: pointer; font-weight: 600; color: #1a5c30; padding: 8px 0; }
            .pagination { display: flex; gap: 8px; margin-top: 16px; align-items: center; }
            .pagination a { text-decoration: none; color: #1a5c30; padding: 6px 12px; border: 1px solid #d0e8d0; border-radius: 6px; font-size: 13px; }
            .pagination a:hover { background: #e8f5e9; }
        </style>
    </head>
    <body>
        <div class="wrap">
            <header>
                <div><b>🌾 Админ-панель Институт</b></div>
                <div><a href="?logout=1">🚪 Выйти</a></div>
            </header>
            <nav>
                <a class="<?php echo $section === "news"
                    ? "active"
                    : ""; ?>" href="admin.php?section=news">📰 Новости</a>
                <a class="<?php echo $section === "katalog"
                    ? "active"
                    : ""; ?>" href="admin.php?section=katalog">🌱 Каталог сортов</a>
                <a class="<?php echo $section === "administration"
                    ? "active"
                    : ""; ?>" href="admin.php?section=administration">👥 Администрация</a>
                <a class="<?php echo $section === "feedback"
                    ? "active"
                    : ""; ?>" href="admin.php?section=feedback">📩 Заявки</a>
                <a class="<?php echo $section === "translations"
                    ? "active"
                    : ""; ?>" href="admin.php?section=translations">🌐 Переводы</a>
                <a class="<?php echo $section === "images"
                    ? "active"
                    : ""; ?>" href="admin.php?section=images">🖼️ Картинки</a>
                <a class="<?php echo $section === "departments"
                    ? "active"
                    : ""; ?>" href="admin.php?section=departments">🔬 Отделы</a>
                <a class="<?php echo $section === "branches"
                    ? "active"
                    : ""; ?>" href="admin.php?section=branches">🏢 Станции</a>
                <a class="<?php echo $section === "settings"
                    ? "active"
                    : ""; ?>" href="admin.php?section=settings">⚙️ Настройки</a>
                <a class="<?php echo $section === "gallery"
                    ? "active"
                    : ""; ?>" href="admin.php?section=gallery">🖼️ Галерея</a>
            </nav>
            <div class="content">
                <?php if (!empty($success) || !empty($_GET["saved"])): ?>
                    <div class="success"><?php echo !empty($success)
                        ? htmlspecialchars($success)
                        : "Сохранено!"; ?></div>
                <?php endif; ?>
                <?php if (!empty($error_msg)): ?>
                    <div class="error"><?php echo htmlspecialchars(
                        $error_msg,
                    ); ?></div>
                <?php endif; ?>

                <?php if ($section === "news"): ?>
                    <h2><?php echo $edit_news
                        ? "✏️ Редактировать новость"
                        : "➕ Добавить новость"; ?></h2>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="news_save" value="1">
                        <input type="hidden" name="edit_id" value="<?php echo $edit_news
                            ? (int) $edit_id
                            : ""; ?>">
                        <div class="row">
                            <div class="col">
                                <label>Заголовок (RU)</label>
                                <input type="text" name="news_title_ru" required value="<?php echo htmlspecialchars(
                                    $edit_news["title"]["ru"] ?? "",
                                ); ?>">
                            </div>
                            <div class="col">
                                <label>Заголовок (EN)</label>
                                <input type="text" name="news_title_en" value="<?php echo htmlspecialchars(
                                    $edit_news["title"]["en"] ?? "",
                                ); ?>">
                            </div>
                            <div class="col">
                                <label>Заголовок (KY)</label>
                                <input type="text" name="news_title_ky" value="<?php echo htmlspecialchars(
                                    $edit_news["title"]["ky"] ?? "",
                                ); ?>">
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col">
                                <label>Текст (RU)</label>
                                <textarea name="news_text_ru" required><?php echo htmlspecialchars(
                                    $edit_news["text"]["ru"] ?? "",
                                ); ?></textarea>
                            </div>
                            <div class="col">
                                <label>Текст (EN)</label>
                                <textarea name="news_text_en"><?php echo htmlspecialchars(
                                    $edit_news["text"]["en"] ?? "",
                                ); ?></textarea>
                            </div>
                            <div class="col">
                                <label>Текст (KY)</label>
                                <textarea name="news_text_ky"><?php echo htmlspecialchars(
                                    $edit_news["text"]["ky"] ?? "",
                                ); ?></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px; align-items:end;">
                            <div class="col" style="max-width: 260px;">
                                <label>Дата</label>
                                <input type="date" name="news_date" value="<?php echo htmlspecialchars(
                                    $edit_news["date"] ?? date("Y-m-d"),
                                ); ?>">
                            </div>
                            <div class="col">
                                <label>Фото (можно несколько)</label>
                                <input type="file" name="news_images[]" multiple accept="image/*">
                            </div>
                            <div class="col" style="max-width: 200px;">
                                <button class="btn" type="submit"><?php echo $edit_news
                                    ? "💾 Сохранить"
                                    : "➕ Добавить"; ?></button>
                            </div>
                        </div>

                        <?php if (
                            $edit_news &&
                            !empty($edit_news["images"])
                        ): ?>
                            <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">
                                <?php foreach ($edit_news["images"] as $img): ?>
                                    <img class="imgprev" src="<?php echo "uploads/news/" .
                                        htmlspecialchars($img); ?>" alt="">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </form>

                    <h2 style="margin-top:24px;">📋 Все новости</h2>
                    <table>
                        <thead>
                            <tr>
                                <th style="width:40px;">#</th>
                                <th>Заголовок (RU)</th>
                                <th style="width:110px;">Дата</th>
                                <th style="width:120px;">Фото</th>
                                <th style="width:120px;">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_news as $i => $n): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars(
                                    $n["title"]["ru"] ?? "",
                                ); ?></td>
                                <td><?php echo htmlspecialchars(
                                    $n["date"] ?? "",
                                ); ?></td>
                                <td>
                                    <?php if (!empty($n["images"][0])): ?>
                                        <img class="imgprev" src="<?php echo "uploads/news/" .
                                            htmlspecialchars(
                                                $n["images"][0],
                                            ); ?>" alt="">
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="admin.php?section=news&edit=<?php echo $i; ?>">✏️</a>
                                    &nbsp;|&nbsp;
                                    <a href="admin.php?section=news&delete=<?php echo $i; ?>" onclick="return confirm('Удалить новость?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php
                    // Determine which section to show
                    // Show branches list

                    elseif ($section === "katalog"): ?>
                    <h2>🌱 Каталог сортов (<?php echo count(
                        $katalog,
                    ); ?> сортов)</h2>

                    <details <?php echo $edit_variety ? "open" : ""; ?>>
                        <summary><?php echo $edit_variety
                            ? "✏️ Редактировать сорт «" .
                                htmlspecialchars(
                                    $edit_variety["name"]["ru"] ?? "",
                                ) .
                                "»"
                            : "➕ Добавить новый сорт"; ?></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="katalog_save" value="1">
                            <input type="hidden" name="edit_id" value="<?php echo $edit_variety
                                ? (int) $edit_id
                                : ""; ?>">
                            <input type="hidden" name="variety_id" value="<?php echo htmlspecialchars(
                                $edit_variety["id"] ?? "",
                            ); ?>">
                            <input type="hidden" name="modal_key" value="<?php echo htmlspecialchars(
                                $edit_variety["modal_key"] ?? "",
                            ); ?>">

                            <h3>Основные данные</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Название (RU) *</label>
                                    <input type="text" name="name_ru" required value="<?php echo htmlspecialchars(
                                        $edit_variety["name"]["ru"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col">
                                    <label>Название (EN)</label>
                                    <input type="text" name="name_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["name"]["en"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col">
                                    <label>Название (KY)</label>
                                    <input type="text" name="name_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["name"]["ky"] ?? "",
                                    ); ?>">
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Культура</label>
                                    <select name="culture">
                                        <option value="barley" <?php echo ($edit_variety[
                                            "culture"
                                        ] ??
                                            "") ===
                                        "barley"
                                            ? "selected"
                                            : ""; ?>>Ячмень</option>
                                        <option value="wheat" <?php echo ($edit_variety[
                                            "culture"
                                        ] ??
                                            "") ===
                                        "wheat"
                                            ? "selected"
                                            : ""; ?>>Пшеница</option>
                                        <option value="corn" <?php echo ($edit_variety[
                                            "culture"
                                        ] ??
                                            "") ===
                                        "corn"
                                            ? "selected"
                                            : ""; ?>>Кукуруза</option>
                                        <option value="sugarbeet" <?php echo ($edit_variety[
                                            "culture"
                                        ] ??
                                            "") ===
                                        "sugarbeet"
                                            ? "selected"
                                            : ""; ?>>Сахарная свекла</option>
                                        <option value="cotton" <?php echo ($edit_variety[
                                            "culture"
                                        ] ??
                                            "") ===
                                        "cotton"
                                            ? "selected"
                                            : ""; ?>>Хлопок</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Сезон</label>
                                    <select name="season">
                                        <option value="spring" <?php echo ($edit_variety[
                                            "season"
                                        ] ??
                                            "") ===
                                        "spring"
                                            ? "selected"
                                            : ""; ?>>Яровой</option>
                                        <option value="winter" <?php echo ($edit_variety[
                                            "season"
                                        ] ??
                                            "") ===
                                        "winter"
                                            ? "selected"
                                            : ""; ?>>Озимый</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Спелость</label>
                                    <select name="maturity">
                                        <option value="early" <?php echo ($edit_variety[
                                            "maturity"
                                        ] ??
                                            "") ===
                                        "early"
                                            ? "selected"
                                            : ""; ?>>Раннеспелый</option>
                                        <option value="mid-early" <?php echo ($edit_variety[
                                            "maturity"
                                        ] ??
                                            "") ===
                                        "mid-early"
                                            ? "selected"
                                            : ""; ?>>Среднеранний</option>
                                        <option value="mid" <?php echo ($edit_variety[
                                            "maturity"
                                        ] ??
                                            "") ===
                                        "mid"
                                            ? "selected"
                                            : ""; ?>>Среднеспелый</option>
                                        <option value="late" <?php echo ($edit_variety[
                                            "maturity"
                                        ] ??
                                            "") ===
                                        "late"
                                            ? "selected"
                                            : ""; ?>>Позднеспелый</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Засухоустойчивость</label>
                                    <select name="drought">
                                        <option value="high" <?php echo ($edit_variety[
                                            "drought"
                                        ] ??
                                            "") ===
                                        "high"
                                            ? "selected"
                                            : ""; ?>>Высокая</option>
                                        <option value="medium" <?php echo ($edit_variety[
                                            "drought"
                                        ] ??
                                            "") ===
                                        "medium"
                                            ? "selected"
                                            : ""; ?>>Средняя</option>
                                        <option value="low" <?php echo ($edit_variety[
                                            "drought"
                                        ] ??
                                            "") ===
                                        "low"
                                            ? "selected"
                                            : ""; ?>>Низкая</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Тип (RU)</label>
                                    <input type="text" name="type_ru" value="<?php echo htmlspecialchars(
                                        $edit_variety["type"]["ru"] ?? "",
                                    ); ?>" placeholder="Ячмень яровой • Нутанс">
                                </div>
                                <div class="col">
                                    <label>Тип (EN)</label>
                                    <input type="text" name="type_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["type"]["en"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col">
                                    <label>Тип (KY)</label>
                                    <input type="text" name="type_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["type"]["ky"] ?? "",
                                    ); ?>">
                                </div>
                            </div>

                            <h3>Статистика</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Масса 1000 зерён (RU)</label>
                                    <input type="text" name="mass_ru" value="<?php echo htmlspecialchars(
                                        $edit_variety["mass"]["ru"] ?? "",
                                    ); ?>" placeholder="45,4–50,2 г">
                                </div>
                                <div class="col">
                                    <label>Урожайность текст (RU)</label>
                                    <input type="text" name="yield_text_ru" value="<?php echo htmlspecialchars(
                                        $edit_variety["yield_text"]["ru"] ?? "",
                                    ); ?>" placeholder="63,4 ц/га">
                                </div>
                                <div class="col">
                                    <label>Урожайность число</label>
                                    <input type="text" name="yield_num" value="<?php echo htmlspecialchars(
                                        $edit_variety["yield_num"] ?? "",
                                    ); ?>" placeholder="63.4">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Белок (RU)</label>
                                    <input type="text" name="protein_ru" value="<?php echo htmlspecialchars(
                                        $edit_variety["protein"]["ru"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col">
                                    <label>Год допуска текст (RU)</label>
                                    <input type="text" name="year_text_ru" value="<?php echo htmlspecialchars(
                                        $edit_variety["year_text"]["ru"] ?? "",
                                    ); ?>" placeholder="с 1972 г.">
                                </div>
                                <div class="col">
                                    <label>Год допуска число</label>
                                    <input type="text" name="year_num" value="<?php echo htmlspecialchars(
                                        $edit_variety["year_num"] ?? "",
                                    ); ?>" placeholder="1972">
                                </div>
                            </div>

                            <details style="margin-top:12px;">
                                <summary>Переводы EN/KY для статистики</summary>
                                <div class="row" style="margin-top:8px;">
                                    <div class="col"><label>Масса (EN)</label><input name="mass_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["mass"]["en"] ?? "",
                                    ); ?>"></div>
                                    <div class="col"><label>Масса (KY)</label><input name="mass_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["mass"]["ky"] ?? "",
                                    ); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Урожайность текст (EN)</label><input name="yield_text_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["yield_text"]["en"] ?? "",
                                    ); ?>"></div>
                                    <div class="col"><label>Урожайность текст (KY)</label><input name="yield_text_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["yield_text"]["ky"] ?? "",
                                    ); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Белок (EN)</label><input name="protein_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["protein"]["en"] ?? "",
                                    ); ?>"></div>
                                    <div class="col"><label>Белок (KY)</label><input name="protein_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["protein"]["ky"] ?? "",
                                    ); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Год допуска (EN)</label><input name="year_text_en" value="<?php echo htmlspecialchars(
                                        $edit_variety["year_text"]["en"] ?? "",
                                    ); ?>"></div>
                                    <div class="col"><label>Год допуска (KY)</label><input name="year_text_ky" value="<?php echo htmlspecialchars(
                                        $edit_variety["year_text"]["ky"] ?? "",
                                    ); ?>"></div>
                                </div>
                            </details>

                            <h3>Описание</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Описание (RU)</label>
                                    <textarea name="desc_ru"><?php echo htmlspecialchars(
                                        $edit_variety["description"]["ru"] ??
                                            "",
                                    ); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Описание (EN)</label>
                                    <textarea name="desc_en"><?php echo htmlspecialchars(
                                        $edit_variety["description"]["en"] ??
                                            "",
                                    ); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Описание (KY)</label>
                                    <textarea name="desc_ky"><?php echo htmlspecialchars(
                                        $edit_variety["description"]["ky"] ??
                                            "",
                                    ); ?></textarea>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Норма посева (RU)</label>
                                    <textarea name="seeding_ru" style="min-height:50px;"><?php echo htmlspecialchars(
                                        $edit_variety["seeding"]["ru"] ?? "",
                                    ); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Норма посева (EN)</label>
                                    <textarea name="seeding_en" style="min-height:50px;"><?php echo htmlspecialchars(
                                        $edit_variety["seeding"]["en"] ?? "",
                                    ); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Норма посева (KY)</label>
                                    <textarea name="seeding_ky" style="min-height:50px;"><?php echo htmlspecialchars(
                                        $edit_variety["seeding"]["ky"] ?? "",
                                    ); ?></textarea>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Свойства (RU, по одному на строку)</label>
                                    <textarea name="props_ru" style="min-height:50px;"><?php echo htmlspecialchars(
                                        implode(
                                            "\n",
                                            (array) ($edit_variety[
                                                "properties"
                                            ]["ru"] ?? []),
                                        ),
                                    ); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Фото сорта</label>
                                    <input type="file" name="variety_image" accept="image/*">
                                    <?php if (
                                        $edit_variety &&
                                        !empty($edit_variety["image"])
                                    ): ?>
                                        <img class="imgprev" src="assets/images/<?php echo htmlspecialchars(
                                            $edit_variety["image"],
                                        ); ?>" alt="" style="margin-top:6px;">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <details style="margin-top:12px;">
                                <summary>Свойства EN/KY</summary>
                                <div class="row" style="margin-top:8px;">
                                    <div class="col"><label>Свойства (EN)</label><textarea name="props_en" style="min-height:50px;"><?php echo htmlspecialchars(
                                        implode(
                                            "\n",
                                            (array) ($edit_variety[
                                                "properties"
                                            ]["en"] ?? []),
                                        ),
                                    ); ?></textarea></div>
                                    <div class="col"><label>Свойства (KY)</label><textarea name="props_ky" style="min-height:50px;"><?php echo htmlspecialchars(
                                        implode(
                                            "\n",
                                            (array) ($edit_variety[
                                                "properties"
                                            ]["ky"] ?? []),
                                        ),
                                    ); ?></textarea></div>
                                </div>
                            </details>

                            <div style="margin-top:16px;">
                                <button class="btn" type="submit"><?php echo $edit_variety
                                    ? "💾 Сохранить изменения"
                                    : "➕ Добавить сорт"; ?></button>
                                <?php if ($edit_variety): ?>
                                    <a href="admin.php?section=katalog" class="btn btn-secondary" style="text-decoration:none; display:inline-block; margin-left:8px;">Отмена</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </details>

                    <table>
                        <thead>
                            <tr>
                                <th style="width:40px;">#</th>
                                <th>Название</th>
                                <th>Культура</th>
                                <th>Сезон</th>
                                <th>Урожайность</th>
                                <th>Год</th>
                                <th style="width:120px;">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($katalog as $i => $v): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><strong><?php echo htmlspecialchars(
                                    $v["name"]["ru"] ?? "",
                                ); ?></strong></td>
                                <td><?php echo htmlspecialchars(
                                    $v["culture"] ?? "",
                                ); ?></td>
                                <td><?php echo ($v["season"] ?? "") === "spring"
                                    ? "Яровой"
                                    : "Озимый"; ?></td>
                                <td><?php echo htmlspecialchars(
                                    $v["yield_text"]["ru"] ?? "",
                                ); ?></td>
                                <td><?php echo htmlspecialchars(
                                    $v["year_num"] ?? "",
                                ); ?></td>
                                <td>
                                    <a href="admin.php?section=katalog&edit=<?php echo $i; ?>">✏️</a>
                                    &nbsp;|&nbsp;
                                    <a href="admin.php?section=katalog&delete=<?php echo $i; ?>" onclick="return confirm('Удалить сорт?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php elseif ($section === "administration"): ?>
                    <h2>👥 Администрация и сотрудники</h2>

                    <div class="sub-nav">
                        <a class="<?php echo $sub === "leadership"
                            ? "active"
                            : ""; ?>" href="admin.php?section=administration&sub=leadership">👔 Руководство</a>
                        <a class="<?php echo $sub === "admin_support"
                            ? "active"
                            : ""; ?>" href="admin.php?section=administration&sub=admin_support">📋 Адм. поддержка</a>
                        <?php if (
                            !empty($admin_data["departments"]) &&
                            is_array($admin_data["departments"])
                        ): ?>
                            <?php foreach (
                                $admin_data["departments"]
                                as $dkey => $dept
                            ): ?>
                                <a class="<?php echo $sub === "dept_" . $dkey
                                    ? "active"
                                    : ""; ?>" href="admin.php?section=administration&sub=dept_<?php echo urlencode(
    $dkey,
); ?>">
                                    <?php echo htmlspecialchars(
                                        $dept["icon"] ?? "📁",
                                    ); ?> <?php echo htmlspecialchars(
     mb_substr($dept["title"]["ru"] ?? $dkey, 0, 25),
 ); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <a class="<?php echo $sub === "branches"
                            ? "active"
                            : ""; ?>" href="admin.php?section=administration&sub=branches">🏢 Филиалы</a>
                    </div>

                    <?php
                    $show_staff = [];
                    $target_section_name = "";
                    $target_dept_key = "";

                    if ($sub === "leadership") {
                        $show_staff = $admin_data["leadership"] ?? [];
                        $target_section_name = "leadership";
                    } elseif ($sub === "admin_support") {
                        $show_staff = $admin_data["admin_support"] ?? [];
                        $target_section_name = "admin_support";
                    } elseif (strpos($sub, "dept_") === 0) {
                        $dkey = substr($sub, 5);
                        $target_dept_key = $dkey;
                        $show_staff =
                            $admin_data["departments"][$dkey]["staff"] ?? [];
                        $target_section_name = "departments";
                    } elseif ($sub === "branches") {
                        $target_section_name = "branches";
                    }
                    ?>

                    <?php if ($target_section_name !== "branches"): ?>
                        <!-- Staff list -->
                        <h3>Сотрудники (<?php echo count($show_staff); ?>)</h3>
                        <?php foreach ($show_staff as $idx => $s): ?>
                            <div class="staff-row">
                                <div class="staff-avatar">
                                    <?php if (!empty($s["image"])): ?>
                                        <img src="<?php echo htmlspecialchars(
                                            $s["image"],
                                        ); ?>" alt="">
                                    <?php else: ?>
                                        <?php
                                        $parts = explode(
                                            " ",
                                            trim($s["name"]["ru"] ?? ""),
                                        );
                                        $initials = "";
                                        if (!empty($parts[0])) {
                                            $initials .= mb_substr(
                                                $parts[0],
                                                0,
                                                1,
                                                "UTF-8",
                                            );
                                        }
                                        if (!empty($parts[1])) {
                                            $initials .= mb_substr(
                                                $parts[1],
                                                0,
                                                1,
                                                "UTF-8",
                                            );
                                        }
                                        echo mb_strtoupper($initials, "UTF-8");
                                        ?>
                                    <?php endif; ?>
                                </div>
                                <div class="staff-info">
                                    <div class="staff-name"><?php echo htmlspecialchars(
                                        $s["name"]["ru"] ?? "",
                                    ); ?></div>
                                    <div class="staff-role"><?php echo htmlspecialchars(
                                        $s["role"]["ru"] ?? "",
                                    ); ?></div>
                                    <?php if (!empty($s["email"])): ?>
                                        <div class="small"><?php echo htmlspecialchars(
                                            $s["email"],
                                        ); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="staff-actions">
                                    <a href="admin.php?section=administration&sub=<?php echo urlencode(
                                        $sub,
                                    ); ?>&del_staff=<?php echo $idx; ?>&del_section=<?php echo urlencode(
    $target_section_name,
); ?>&del_dept=<?php echo urlencode($target_dept_key); ?>"
                                       onclick="return confirm('Удалить сотрудника?');" title="Удалить">🗑️</a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Add staff form -->
                        <details style="margin-top:16px;">
                            <summary>➕ Добавить сотрудника</summary>
                            <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:8px;">
                                <input type="hidden" name="staff_save" value="1">
                                <input type="hidden" name="target_section" value="<?php echo htmlspecialchars(
                                    $target_section_name,
                                ); ?>">
                                <input type="hidden" name="target_dept" value="<?php echo htmlspecialchars(
                                    $target_dept_key,
                                ); ?>">
                                <input type="hidden" name="staff_edit_id" value="">

                                <div class="row">
                                    <div class="col">
                                        <label>ФИО (RU) *</label>
                                        <input type="text" name="staff_name_ru" required placeholder="Иванов Иван Иванович">
                                    </div>
                                    <div class="col">
                                        <label>ФИО (EN)</label>
                                        <input type="text" name="staff_name_en" placeholder="Ivanov Ivan Ivanovich">
                                    </div>
                                    <div class="col">
                                        <label>ФИО (KY)</label>
                                        <input type="text" name="staff_name_ky">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col">
                                        <label>Должность (RU) *</label>
                                        <input type="text" name="staff_role_ru" required placeholder="Старший научный сотрудник">
                                    </div>
                                    <div class="col">
                                        <label>Должность (EN)</label>
                                        <input type="text" name="staff_role_en" placeholder="Senior Researcher">
                                    </div>
                                    <div class="col">
                                        <label>Должность (KY)</label>
                                        <input type="text" name="staff_role_ky">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col">
                                        <label>Email</label>
                                        <input type="email" name="staff_email" placeholder="email@example.com">
                                    </div>
                                    <div class="col">
                                        <label>Уровень</label>
                                        <select name="staff_grade">
                                            <option value="director">Директор</option>
                                            <option value="deputy">Зам. директора</option>
                                            <option value="secretary">Ученый секретарь</option>
                                            <option value="head">Заведующий</option>
                                            <option value="researcher">Научный сотрудник</option>
                                            <option value="staff" selected>Сотрудник</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Фото</label>
                                        <input type="file" name="staff_image" accept="image/*">
                                    </div>
                                </div>
                                <div style="margin-top:12px;">
                                    <button class="btn" type="submit">➕ Добавить сотрудника</button>
                                </div>
                            </form>
                        </details>

                    <?php else: ?>
                        <!-- Branches list -->
                        <h3>Филиалы и опытные станции</h3>
                        <?php if (
                            !empty($admin_data["branches"]) &&
                            is_array($admin_data["branches"])
                        ): ?>
                            <?php foreach (
                                $admin_data["branches"]
                                as $bi => $branch
                            ): ?>
                                <div class="card">
                                    <strong><?php echo htmlspecialchars(
                                        $branch["title"]["ru"] ?? "",
                                    ); ?></strong>
                                    <?php if (!empty($branch["location"])): ?>
                                        <div class="small">📍 <?php echo htmlspecialchars(
                                            $branch["location"],
                                        ); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($branch["staff"])): ?>
                                        <div style="margin-top:8px;">
                                            <?php foreach (
                                                $branch["staff"]
                                                as $s
                                            ): ?>
                                                <div class="small">
                                                    👤 <?php echo htmlspecialchars(
                                                        $s["name"]["ru"] ?? "",
                                                    ); ?> — <?php echo htmlspecialchars(
     $s["role"]["ru"] ?? "",
 ); ?>
                                                    <?php if (
                                                        !empty($s["email"])
                                                    ): ?> (<?php echo htmlspecialchars(
     $s["email"],
 ); ?>)<?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (
                                        !empty($branch["sub_departments"])
                                    ): ?>
                                        <div style="margin-top:8px;">
                                            <?php foreach (
                                                $branch["sub_departments"]
                                                as $sd
                                            ): ?>
                                                <div class="small" style="margin-left:16px;">
                                                    📁 <strong><?php echo htmlspecialchars(
                                                        $sd["title"]["ru"] ??
                                                            "",
                                                    ); ?></strong>
                                                    <?php if (
                                                        !empty($sd["staff"])
                                                    ): ?>
                                                        <?php foreach (
                                                            $sd["staff"]
                                                            as $sds
                                                        ): ?>
                                                            <div style="margin-left:16px;">👤 <?php echo htmlspecialchars(
                                                                $sds["name"][
                                                                    "ru"
                                                                ] ?? "",
                                                            ); ?> — <?php echo htmlspecialchars(
     $sds["role"]["ru"] ?? "",
 ); ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php elseif ($section === "feedback"):

                    $unread = array_filter(
                        $feedback,
                        fn($f) => empty($f["read"]),
                    );
                    $unread_count = count($unread);
                    ?>
                    <h2>📩 Заявки с формы обратной связи
                        <?php if ($unread_count > 0): ?>
                            <span style="background:#dc2626;color:#fff;font-size:14px;padding:2px 10px;border-radius:12px;margin-left:8px;"><?php echo $unread_count; ?> новых</span>
                        <?php endif; ?>
                    </h2>

                    <?php if (empty($feedback)): ?>
                        <div class="card" style="text-align:center;padding:32px;color:#888;">
                            <div style="font-size:48px;margin-bottom:12px;">💭</div>
                            <p>Заявок пока нет. Они появятся здесь после заполнения формы на странице <a href="contacts.php" target="_blank">Контакты</a>.</p>
                        </div>
                    <?php else: ?>
                        <div style="display:flex;gap:10px;margin-bottom:16px;align-items:center;">
                            <span class="small">Всего: <?php echo count(
                                $feedback,
                            ); ?> | Новых: <b style="color:#dc2626;"><?php echo $unread_count; ?></b></span>
                            <?php if ($unread_count > 0): ?>
                                <a href="admin.php?section=feedback&mark_all_read=1" class="btn btn-secondary btn-sm">✅ Отметить все прочитанными</a>
                            <?php endif; ?>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:12px;">
                        <?php foreach (
                            array_reverse(array_keys($feedback), true)
                            as $i
                        ):

                            $f = $feedback[$i];
                            $is_read = !empty($f["read"]);
                            ?>
                            <div class="card" style="border-left: 4px solid <?php echo $is_read
                                ? "#d1d5db"
                                : "#10b981"; ?>; opacity:<?php echo $is_read
    ? "0.8"
    : "1"; ?>;">
                                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;">
                                    <div style="flex:1;">
                                        <div style="display:flex;gap:10px;align-items:center;margin-bottom:6px;">
                                            <?php if (
                                                !$is_read
                                            ): ?><span style="background:#10b981;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;">НОВОЕ</span><?php endif; ?>
                                            <strong><?php echo htmlspecialchars(
                                                $f["name"] ?? "",
                                            ); ?></strong>
                                            <span class="small">&lt;<?php echo htmlspecialchars(
                                                $f["email"] ?? "",
                                            ); ?>&gt;</span>
                                            <span class="small" style="color:#9ca3af;"><?php echo htmlspecialchars(
                                                substr(
                                                    $f["created_at"] ?? "",
                                                    0,
                                                    16,
                                                ),
                                            ); ?></span>
                                            <span class="small" style="color:#9ca3af;">🌐 <?php echo htmlspecialchars(
                                                $f["lang"] ?? "",
                                            ); ?></span>
                                        </div>
                                        <div style="background:#f9fafb;border-radius:8px;padding:10px 14px;font-size:14px;line-height:1.6;">
                                            <?php echo nl2br(
                                                htmlspecialchars(
                                                    $f["message"] ?? "",
                                                ),
                                            ); ?>
                                        </div>
                                    </div>
                                    <div style="display:flex;flex-direction:column;gap:6px;flex-shrink:0;">
                                        <a href="mailto:<?php echo htmlspecialchars(
                                            $f["email"] ?? "",
                                        ); ?>?subject=Re: КНИИЗ" class="btn btn-sm btn-secondary">✉️ Ответить</a>
                                        <?php if (!$is_read): ?>
                                        <a href="admin.php?section=feedback&mark_read=<?php echo $i; ?>" class="btn btn-sm btn-secondary">✅ Прочитано</a>
                                        <?php endif; ?>
                                        <a href="admin.php?section=feedback&delete=<?php echo $i; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить заявку?');">🗑️</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                        </div>
                    <?php endif; ?>

                <?php
                elseif ($section === "translations"): ?>
                    <h2>🌐 Переводы (все страницы)</h2>
                    <p class="small">
                        Здесь можно менять любые тексты сайта (ключи t('...')).<br>
                        Если какой-то ключ не переведен — сайт покажет русский текст и добавит ключ в список «пропущенные».
                    </p>

                    <div style="margin: 10px 0 16px;">
                        <form method="get" style="display:flex; gap:10px; align-items:center;">
                            <input type="hidden" name="section" value="translations">
                            <input type="text" name="q" placeholder="Поиск по ключу..." value="<?php echo htmlspecialchars(
                                $q,
                            ); ?>" style="max-width:320px;">
                            <button class="btn btn-secondary" type="submit">🔍 Найти</button>
                        </form>
                    </div>

                    <details style="margin: 0 0 14px;">
                        <summary><b>Пропущенные переводы</b> (что нужно доперевести)</summary>
                        <div class="small" style="margin-top:8px;">
                            <?php foreach (["en", "ky", "ru"] as $lc): ?>
                                <div style="margin-bottom:6px;">
                                    <b><?php echo strtoupper($lc); ?>:</b>
                                    <?php
                                    $list = $missing[$lc] ?? [];
                                    if (!is_array($list) || empty($list)) {
                                        echo "—";
                                    } else {
                                        echo htmlspecialchars(
                                            implode(", ", $list),
                                        );
                                    }
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </details>

                    <form method="post">
                        <input type="hidden" name="save_translations" value="1">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ключ</th>
                                    <th>RU</th>
                                    <th>EN</th>
                                    <th>KY</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($slice as $k): ?>
                                <tr>
                                    <td class="key"><?php echo htmlspecialchars(
                                        $k,
                                    ); ?></td>
                                    <td><textarea name="ru[<?php echo htmlspecialchars(
                                        $k,
                                    ); ?>]"><?php echo htmlspecialchars(
    $_lang["ru"][$k] ?? "",
); ?></textarea></td>
                                    <td><textarea name="en[<?php echo htmlspecialchars(
                                        $k,
                                    ); ?>]"><?php echo htmlspecialchars(
    $_lang["en"][$k] ?? "",
); ?></textarea></td>
                                    <td><textarea name="ky[<?php echo htmlspecialchars(
                                        $k,
                                    ); ?>]"><?php echo htmlspecialchars(
    $_lang["ky"][$k] ?? "",
); ?></textarea></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div style="display:flex; gap:10px; align-items:center; margin-top:12px;">
                            <button class="btn" type="submit">💾 Сохранить</button>
                            <div class="small">Страница <?php echo $page; ?> из <?php echo $pages; ?> (ключей: <?php echo $total; ?>)</div>
                        </div>
                    </form>

                    <div class="pagination">
                        <?php
                        $base =
                            "admin.php?section=translations" .
                            ($q !== "" ? "&q=" . urlencode($q) : "");
                        if ($page > 1) {
                            echo '<a href="' .
                                $base .
                                "&page=" .
                                ($page - 1) .
                                '">← Назад</a>';
                        }
                        if ($page < $pages) {
                            echo '<a href="' .
                                $base .
                                "&page=" .
                                ($page + 1) .
                                '">Вперед →</a>';
                        }
                        ?>
                    </div>

                <?php elseif ($section === "images"): ?>
                    <h2>🖼️ Картинки (замена на сайте)</h2>
                    <p class="small">
                        Введите ключ картинки и загрузите файл. На сайте используйте helper <span class="key">siteImage('ключ', 'путь-по-умолчанию')</span>.<br>
                        Сейчас подключены ключи главной страницы: <span class="key">index.hero1</span>, <span class="key">index.hero2</span>, <span class="key">index.hero3</span>, <span class="key">index.hero4</span>, <span class="key">index.about_photo</span>, <span class="key">index.gallery1</span>, <span class="key">index.gallery2</span>...
                    </p>

                    <form method="post" enctype="multipart/form-data" style="max-width: 520px;">
                        <input type="hidden" name="upload_image" value="1">
                        <label>Ключ</label>
                        <input type="text" name="image_key" placeholder="например: index.hero1" required>
                        <div style="height:10px;"></div>
                        <label>Файл</label>
                        <input type="file" name="image_file" accept="image/*" required>
                        <div style="height:12px;"></div>
                        <button class="btn" type="submit">📤 Загрузить / заменить</button>
                    </form>

                    <h3>Текущие замены</h3>
                    <?php if (empty($imgOverrides)): ?>
                        <p class="small">Пока нет замен.</p>
                    <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Ключ</th>
                                    <th>Путь</th>
                                    <th style="width:140px;">Превью</th>
                                    <th style="width:90px;">Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($imgOverrides as $k => $path): ?>
                                <tr>
                                    <td class="key"><?php echo htmlspecialchars(
                                        $k,
                                    ); ?></td>
                                    <td class="small"><?php echo htmlspecialchars(
                                        $path,
                                    ); ?></td>
                                    <td><?php if (
                                        is_string($path) &&
                                        $path !== ""
                                    ): ?><img class="imgprev" src="<?php echo htmlspecialchars(
    $path,
); ?>" alt=""><?php endif; ?></td>
                                    <td><a href="admin.php?section=images&remove=<?php echo urlencode(
                                        $k,
                                    ); ?>" onclick="return confirm('Убрать замену?');">🗑️</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                <?php elseif ($section === "departments"): ?>
                    <h2>🔬 Отделы института (structure_*.json)</h2>

                    <div class="sub-nav">
                        <?php foreach ($dept_ids as $did): ?>
                            <a class="<?php echo $dept_item === $did
                                ? "active"
                                : ""; ?>"
                               href="admin.php?section=departments&dept=<?php echo urlencode(
                                   $did,
                               ); ?>">
                                <?php echo htmlspecialchars(
                                    $dept_labels[$did] ?? $did,
                                ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <?php $dd = $dept_data["ru"][$dept_item] ?? []; ?>

                    <?php if (!empty($dept_item)): ?>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
                        <span class="small">Отдел: <b><?php echo htmlspecialchars(
                            $dept_item,
                        ); ?></b></span>
                        <a href="admin.php?section=departments&delete_dept=<?php echo urlencode(
                            $dept_item,
                        ); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Удалить отдел «<?php echo htmlspecialchars(
                               $dept_item,
                           ); ?>»? Это удалит все его данные!');">
                            🗑️ Удалить отдел
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Hero image & badge -->
                    <div class="card" style="display:flex;gap:18px;align-items:flex-start;margin-bottom:20px;">
                        <?php if (!empty($dd["hero_image"])): ?>
                            <img src="<?php echo htmlspecialchars(
                                $dd["hero_image"],
                            ); ?>" style="width:120px;height:80px;object-fit:cover;border-radius:8px;">
                        <?php endif; ?>
                        <div>
                            <strong><?php echo htmlspecialchars(
                                $dept_labels[$dept_item],
                            ); ?></strong><br>
                            <span class="small">Badge: <?php echo htmlspecialchars(
                                $dd["badge"] ?? "",
                            ); ?></span><br>
                            <span class="small">hero_image: <?php echo htmlspecialchars(
                                $dd["hero_image"] ?? "—",
                            ); ?></span>
                        </div>
                    </div>

                    <!-- Main info form (tabbed by language) -->
                    <details open style="margin-bottom:16px;">
                        <summary><b>📝 Тексты отдела (редактировать)</b></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="dept_info_save" value="1">
                            <input type="hidden" name="dept_item" value="<?php echo htmlspecialchars(
                                $dept_item,
                            ); ?>">

                            <div class="row">
                                <div class="col"><label>Badge (значок/ярлык)</label>
                                    <input type="text" name="badge" value="<?php echo htmlspecialchars(
                                        $dd["badge"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Hero-изображение (загрузить)</label>
                                    <input type="file" name="hero_image" accept="image/*">
                                </div>
                            </div>

                            <?php foreach (
                                [
                                    "ru" => "🇷🇺 RU",
                                    "en" => "🇬🇧 EN",
                                    "ky" => "🇰🇬 KY",
                                ]
                                as $lc => $lbl
                            ):
                                $ld = $dept_data[$lc][$dept_item] ?? []; ?>
                            <h3 style="margin-top:16px;"><?php echo $lbl; ?></h3>
                            <div class="row">
                                <div class="col">
                                    <label>Основной текст (summary)</label>
                                    <textarea name="summary_<?php echo $lc; ?>" rows="4"><?php echo htmlspecialchars(
    $ld["summary"] ?? "",
); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Деятельность (activity)</label>
                                    <textarea name="activity_<?php echo $lc; ?>" rows="4"><?php echo htmlspecialchars(
    $ld["activity"] ?? "",
); ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Направления исследований (по одному на строке)</label>
                                    <textarea name="research_<?php echo $lc; ?>" rows="5"><?php
$ri = $ld["research"] ?? [];
echo htmlspecialchars(is_array($ri) ? implode("\n", $ri) : $ri);
?></textarea>
                                </div>
                                <div class="col">
                                    <label>Результаты-список (results_list, по одному на строке)</label>
                                    <textarea name="results_list_<?php echo $lc; ?>" rows="5"><?php
$rl = $ld["results_list"] ?? [];
echo htmlspecialchars(is_array($rl) ? implode("\n", $rl) : $rl);
?></textarea>
                                </div>
                            </div>
                            <label style="margin-top:10px;display:block;">Результаты (текст)</label>
                            <textarea name="results_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["results"] ?? "",
); ?></textarea>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Международное сотрудничество</label>
                                    <textarea name="international_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["international"] ?? "",
); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Публикации</label>
                                    <textarea name="publications_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["publications"] ?? "",
); ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Текущие проекты</label>
                                    <textarea name="projects_current_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["projects_current"] ?? "",
); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Завершённые проекты</label>
                                    <textarea name="projects_completed_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["projects_completed"] ?? "",
); ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Мероприятия / День поля</label>
                                    <textarea name="events_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["events"] ?? "",
); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Перспективы</label>
                                    <textarea name="perspectives_<?php echo $lc; ?>" rows="3"><?php echo htmlspecialchars(
    $ld["perspectives"] ?? "",
); ?></textarea>
                                </div>
                            </div>
                            <?php
                            endforeach; ?>

                            <div style="margin-top:16px;">
                                <button class="btn" type="submit">💾 Сохранить тексты</button>
                            </div>
                        </form>
                    </details>

                    <!-- Head of department -->
                    <details style="margin-bottom:16px;">
                        <summary><b>👤 Заведующий отделом</b></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="dept_head_save" value="1">
                            <input type="hidden" name="dept_item" value="<?php echo htmlspecialchars(
                                $dept_item,
                            ); ?>">
                            <?php $hd = $dd["head"] ?? []; ?>
                            <div class="row">
                                <div class="col"><label>ФИО *</label>
                                    <input type="text" name="head_name" value="<?php echo htmlspecialchars(
                                        $hd["name"] ?? "",
                                    ); ?>" required>
                                </div>
                                <div class="col"><label>Должность</label>
                                    <input type="text" name="head_position" value="<?php echo htmlspecialchars(
                                        $hd["position"] ?? "",
                                    ); ?>">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col"><label>Телефон</label>
                                    <input type="text" name="head_phone" value="<?php echo htmlspecialchars(
                                        $hd["phone"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Награды / звание</label>
                                    <input type="text" name="head_honors" value="<?php echo htmlspecialchars(
                                        $hd["honors"] ?? "",
                                    ); ?>">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col"><label>Учёная степень</label>
                                    <input type="text" name="head_degree" value="<?php echo htmlspecialchars(
                                        $hd["degree"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Образование</label>
                                    <input type="text" name="head_education" value="<?php echo htmlspecialchars(
                                        $hd["education"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Фото</label>
                                    <input type="file" name="head_image" accept="image/*">
                                    <?php if (
                                        !empty($hd["image"])
                                    ): ?><img class="imgprev" src="<?php echo htmlspecialchars(
    $hd["image"],
); ?>" alt=""><?php endif; ?>
                                </div>
                            </div>
                            <div style="margin-top:12px;">
                                <button class="btn" type="submit">💾 Сохранить заведующего</button>
                            </div>
                        </form>
                    </details>

                    <!-- Staff list -->
                    <h3>👥 Сотрудники отдела (<?php echo count(
                        $dd["staff"] ?? [],
                    ); ?>)</h3>
                    <?php foreach ($dd["staff"] ?? [] as $si => $sm): ?>
                        <div class="staff-row">
                            <div class="staff-avatar">
                                <?php if (!empty($sm["image"])): ?>
                                    <img src="<?php echo htmlspecialchars(
                                        $sm["image"],
                                    ); ?>" alt="">
                                <?php else: ?>
                                    <?php
                                    $ip = explode(" ", trim($sm["name"] ?? ""));
                                    echo mb_strtoupper(
                                        mb_substr($ip[0] ?? "", 0, 1, "UTF-8") .
                                            mb_substr(
                                                $ip[1] ?? "",
                                                0,
                                                1,
                                                "UTF-8",
                                            ),
                                        "UTF-8",
                                    );
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="staff-info">
                                <div class="staff-name"><?php echo htmlspecialchars(
                                    $sm["name"] ?? "",
                                ); ?></div>
                                <div class="staff-role"><?php echo htmlspecialchars(
                                    $sm["position"] ?? "",
                                ); ?></div>
                                <div class="small">Опыт: <?php echo htmlspecialchars(
                                    $sm["experience"] ?? "",
                                ); ?> л.  <?php echo htmlspecialchars(
     $sm["degree"] ?? "",
 ); ?></div>
                            </div>
                            <div class="staff-actions">
                                <a href="admin.php?section=departments&dept=<?php echo urlencode(
                                    $dept_item,
                                ); ?>&del_dstaff=<?php echo $si; ?>"
                                   onclick="return confirm('Удалить сотрудника?');">🗑️</a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <details style="margin-top:12px;">
                        <summary>➕ Добавить сотрудника</summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="dept_staff_save" value="1">
                            <input type="hidden" name="dept_item" value="<?php echo htmlspecialchars(
                                $dept_item,
                            ); ?>">
                            <input type="hidden" name="dept_staff_edit_id" value="">
                            <div class="row">
                                <div class="col"><label>ФИО *</label>
                                    <input type="text" name="dstaff_name" required placeholder="Иванов Иван">
                                </div>
                                <div class="col"><label>Должность</label>
                                    <input type="text" name="dstaff_position" placeholder="Научный сотрудник">
                                </div>
                                <div class="col"><label>Опыт (лет)</label>
                                    <input type="text" name="dstaff_experience" placeholder="5">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col"><label>Учёная степень</label>
                                    <input type="text" name="dstaff_degree" placeholder="к.с.-х.н.">
                                </div>
                                <div class="col"><label>Звание</label>
                                    <input type="text" name="dstaff_title_field" placeholder="доцент">
                                </div>
                                <div class="col"><label>Образование</label>
                                    <input type="text" name="dstaff_education" placeholder="Высшее">
                                </div>
                                <div class="col"><label>Фото</label>
                                    <input type="file" name="dstaff_image" accept="image/*">
                                </div>
                            </div>
                            <div style="margin-top:12px;">
                                <button class="btn" type="submit">➕ Добавить</button>
                            </div>
                        </form>
                    </details>

                    <!-- Create new department -->
                    <details style="margin-top:20px;">
                        <summary><b>➕ Создать новый отдел</b></summary>
                        <form method="post" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="create_dept" value="1">
                            <p class="small">ID отдела используется в URL и как ключ в JSON. Только латинские буквы, цифры и _</p>
                            <div class="row">
                                <div class="col">
                                    <label>ID отдела * (например: rice, potato, hemp)</label>
                                    <input type="text" name="new_dept_id" required pattern="[a-z0-9_]+" placeholder="new_dept" style="font-family:monospace;">
                                </div>
                                <div class="col">
                                    <label>Название-ярлык (badge)</label>
                                    <input type="text" name="new_dept_badge" placeholder="🌿 Название отдела">
                                </div>
                            </div>
                            <div style="margin-top:12px;">
                                <button class="btn" type="submit">➕ Создать отдел</button>
                            </div>
                        </form>
                    </details>

                <?php elseif ($section === "branches"): ?>
                    <h2>🏢 Опытные станции и филиалы</h2>

                    <!-- List -->
                    <table>
                        <thead><tr><th>#</th><th>Название (RU)</th><th>Адрес</th><th>Директор</th><th>Фото</th><th style="width:110px;">Действия</th></tr></thead>
                        <tbody>
                        <?php foreach ($br_data["ru"] as $bi => $b): ?>
                            <tr>
                                <td><?php echo $bi + 1; ?></td>
                                <td><strong><?php echo htmlspecialchars(
                                    $b["title"] ?? "",
                                ); ?></strong></td>
                                <td class="small"><?php echo htmlspecialchars(
                                    $b["address"] ?? "",
                                ); ?></td>
                                <td class="small"><?php echo htmlspecialchars(
                                    $b["director"] ?? "",
                                ); ?></td>
                                <td><?php if (
                                    !empty($b["image"])
                                ): ?><img class="imgprev" src="<?php echo htmlspecialchars(
    $b["image"],
); ?>" alt=""><?php endif; ?></td>
                                <td>
                                    <a href="admin.php?section=branches&edit_branch=<?php echo $bi; ?>" class="btn btn-sm btn-secondary">✏️</a>
                                    <a href="admin.php?section=branches&delete_branch=<?php echo $bi; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить станцию?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Add / Edit form -->
                    <details <?php echo $edit_branch
                        ? "open"
                        : ""; ?> style="margin-top:20px;">
                        <summary><b><?php echo $edit_branch
                            ? "✏️ Редактировать станцию"
                            : "➕ Добавить станцию"; ?></b></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="branch_save" value="1">
                            <input type="hidden" name="edit_id" value="<?php echo $edit_branch !==
                            null
                                ? (int) $edit_branch_id
                                : ""; ?>">

                            <?php foreach (
                                [
                                    "ru" => "🇷🇺 RU",
                                    "en" => "🇬🇧 EN",
                                    "ky" => "🇰🇬 KY",
                                ]
                                as $lc => $lbl
                            ):
                                $eb = $edit_branch[$lc] ?? []; ?>
                                <h3 style="margin-top:14px;"><?php echo $lbl; ?></h3>
                                <div class="row">
                                    <div class="col"><label>Название *</label>
                                        <input type="text" name="branch_title_<?php echo $lc; ?>" value="<?php echo htmlspecialchars(
    $eb["title"] ?? "",
); ?>" <?php echo $lc === "ru" ? "required" : ""; ?>>
                                    </div>
                                    <div class="col"><label>Адрес</label>
                                        <input type="text" name="branch_address_<?php echo $lc; ?>" value="<?php echo htmlspecialchars(
    $eb["address"] ?? "",
); ?>">
                                    </div>
                                </div>
                                <div style="margin-top:8px;">
                                    <label>Деятельность</label>
                                    <textarea name="branch_activity_<?php echo $lc; ?>" rows="2"><?php echo htmlspecialchars(
    $eb["activity"] ?? "",
); ?></textarea>
                                </div>
                            <?php
                            endforeach; ?>

                            <h3 style="margin-top:14px;">🔗 Общие поля</h3>
                            <div class="row">
                                <div class="col"><label>Площадь</label>
                                    <input type="text" name="branch_area" value="<?php echo htmlspecialchars(
                                        $edit_branch["ru"]["area"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Директор</label>
                                    <input type="text" name="branch_director" value="<?php echo htmlspecialchars(
                                        $edit_branch["ru"]["director"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Телефон</label>
                                    <input type="text" name="branch_phone" value="<?php echo htmlspecialchars(
                                        $edit_branch["ru"]["phone"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Фото</label>
                                    <input type="file" name="branch_image" accept="image/*">
                                    <?php if (
                                        !empty($edit_branch["ru"]["image"])
                                    ): ?><img class="imgprev" src="<?php echo htmlspecialchars(
    $edit_branch["ru"]["image"],
); ?>" alt=""><?php endif; ?>
                                </div>
                            </div>

                            <div style="margin-top:14px;">
                                <button class="btn" type="submit">💾 Сохранить</button>
                                <a href="admin.php?section=branches" class="btn btn-secondary" style="margin-left:8px;">✕ Отмена</a>
                            </div>
                        </form>
                    </details>

                <?php elseif ($section === "gallery"): ?>
                    <h2>🖼️ Галерея</h2>

                    <!-- Grid of current photos -->
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px;margin-bottom:24px;">
                        <?php foreach ($gallery_items as $gi => $gitem): ?>
                        <div style="border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;background:#fff;">
                            <div style="height:130px;overflow:hidden;background:#f3f4f6;">
                                <?php if (!empty($gitem["image"])): ?>
                                <img src="<?php echo htmlspecialchars(
                                    $gitem["image"],
                                ); ?>" style="width:100%;height:130px;object-fit:cover;" alt="">
                                <?php else: ?>
                                <div style="height:130px;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:32px;">🖼️</div>
                                <?php endif; ?>
                            </div>
                            <div style="padding:8px;">
                                <div style="font-size:13px;font-weight:600;margin-bottom:2px;"><?php echo htmlspecialchars(
                                    $gitem["title"]["ru"] ?? "",
                                ); ?></div>
                                <div style="font-size:11px;color:#6b7280;"><?php echo htmlspecialchars(
                                    $gitem["category"]["ru"] ?? "",
                                ); ?></div>
                                <div style="display:flex;gap:4px;margin-top:6px;">
                                    <a href="admin.php?section=gallery&edit_gallery=<?php echo $gi; ?>" class="btn btn-sm btn-secondary" style="font-size:11px;padding:3px 8px;">✏️</a>
                                    <a href="admin.php?section=gallery&delete_gallery=<?php echo $gi; ?>" class="btn btn-sm btn-danger" style="font-size:11px;padding:3px 8px;" onclick="return confirm('Удалить фото?');">🗑️</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Add / Edit form -->
                    <details <?php echo $edit_gallery
                        ? "open"
                        : ""; ?> style="margin-top:4px;">
                        <summary><b><?php echo $edit_gallery
                            ? "✏️ Редактировать фото"
                            : "➕ Добавить фото в галерею"; ?></b></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="gallery_save" value="1">
                            <input type="hidden" name="edit_id" value="<?php echo $edit_gallery !==
                            null
                                ? (int) $edit_gallery_id
                                : ""; ?>">

                            <div class="row">
                                <div class="col"><label>Изображение <?php echo $edit_gallery
                                    ? "(оставь пустым — не менять)"
                                    : "*"; ?></label>
                                    <input type="file" name="gallery_image" accept="image/*" <?php echo !$edit_gallery
                                        ? "required"
                                        : ""; ?>>
                                    <?php if (
                                        !empty($edit_gallery["image"])
                                    ): ?><img class="imgprev" src="<?php echo htmlspecialchars(
    $edit_gallery["image"],
); ?>" alt="" style="margin-top:6px;"><?php endif; ?>
                                </div>
                            </div>
                            <h3 style="margin-top:14px;">Подписи</h3>
                            <div class="row">
                                <div class="col"><label>Заголовок RU *</label>
                                    <input type="text" name="title_ru" value="<?php echo htmlspecialchars(
                                        $edit_gallery["title"]["ru"] ?? "",
                                    ); ?>" required>
                                </div>
                                <div class="col"><label>Заголовок EN</label>
                                    <input type="text" name="title_en" value="<?php echo htmlspecialchars(
                                        $edit_gallery["title"]["en"] ?? "",
                                    ); ?>">
                                </div>
                                <div class="col"><label>Заголовок KY</label>
                                    <input type="text" name="title_ky" value="<?php echo htmlspecialchars(
                                        $edit_gallery["title"]["ky"] ?? "",
                                    ); ?>">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col"><label>Категория RU</label>
                                    <input type="text" name="category_ru" value="<?php echo htmlspecialchars(
                                        $edit_gallery["category"]["ru"] ?? "",
                                    ); ?>" placeholder="Зерновые">
                                </div>
                                <div class="col"><label>Категория EN</label>
                                    <input type="text" name="category_en" value="<?php echo htmlspecialchars(
                                        $edit_gallery["category"]["en"] ?? "",
                                    ); ?>" placeholder="Grains">
                                </div>
                                <div class="col"><label>Категория KY</label>
                                    <input type="text" name="category_ky" value="<?php echo htmlspecialchars(
                                        $edit_gallery["category"]["ky"] ?? "",
                                    ); ?>" placeholder="Дан өсүмдүктөрү">
                                </div>
                            </div>
                            <div style="margin-top:14px;">
                                <button class="btn" type="submit">💾 Сохранить</button>
                                <a href="admin.php?section=gallery" class="btn btn-secondary" style="margin-left:8px;">✕ Отмена</a>
                            </div>
                        </form>
                    </details>

                <?php elseif ($section === "settings"): ?>
                    <h2>⚙️ Настройки</h2>

                    <!-- Contact emails -->
                    <div class="card" style="max-width:600px;margin-bottom:24px;">
                        <h3>📧 Email для формы обратной связи</h3>
                        <p class="small">Каждый email с новой строки. На эти адреса будут приходить заявки с сайта.</p>
                        <form method="post">
                            <input type="hidden" name="save_settings" value="1">
                            <textarea name="contact_emails" rows="4" placeholder="email1@example.com
email2@example.com"><?php echo htmlspecialchars(
    implode("\n", $settings["contact_form_recipients"] ?? []),
); ?></textarea>
                            <div style="margin-top:10px;"><button class="btn" type="submit">💾 Сохранить</button></div>
                        </form>
                    </div>

                    <!-- Password change -->
                    <div class="card" style="max-width:480px;">
                        <h3>🔒 Смена пароля админки</h3>
                        <form method="post">
                            <input type="hidden" name="change_password" value="1">
                            <label>Текущий пароль</label>
                            <input type="password" name="current_password" required autocomplete="current-password">
                            <label style="margin-top:10px;display:block;">Новый пароль (мин. 8 симв.)</label>
                            <input type="password" name="new_password" required minlength="8" autocomplete="new-password">
                            <label style="margin-top:10px;display:block;">Повторите новый пароль</label>
                            <input type="password" name="new_password_again" required minlength="8" autocomplete="new-password">
                            <div style="margin-top:14px;"><button class="btn" type="submit">🔒 Изменить пароль</button></div>
                        </form>
                    </div>

                    <div class="card" style="max-width:600px;margin-top:24px;">
                        <h3>ℹ️ Информация</h3>
                        <p class="small">Файл конфигурации: <span class="key">config/admin_config.php</span></p>
                        <p class="small">Все загруженные файлы: <span class="key">uploads/</span></p>
                        <p class="small">База данных: <span class="key">database/*.json</span></p>
                        <p class="small">Переводы: редактируются в разделе <a href="admin.php?section=translations">🌐 Переводы</a></p>
                        <p class="small">Картинки: заменяются в разделе <a href="admin.php?section=images">🖼️ Картинки</a></p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </body>
    </html>
    <?php exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в админ-панель</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #e8f5e9, #f1f8e9); min-height: 100vh; }
        .login-panel { max-width: 380px; margin: 80px auto; background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); padding: 40px 32px; }
        h2 { color: #1a5c30; margin-top: 0; }
        input { width: 100%; margin-bottom: 16px; padding: 12px; border-radius: 8px; border: 1px solid #d0d5dd; font-size: 15px; box-sizing: border-box; }
        input:focus { outline: none; border-color: #1a5c30; box-shadow: 0 0 0 3px rgba(26,92,48,0.1); }
        button { background: linear-gradient(135deg, #1a5c30, #2d8a4e); color: #fff; border: none; padding: 12px 28px; border-radius: 8px; cursor: pointer; font-size: 15px; width: 100%; }
        button:hover { opacity: .95; }
        .error { color: #dc2626; margin-bottom: 12px; font-size: 14px; }
    </style>
</head>
<body>
<div class="login-panel">
    <h2>🌾 Вход в админ-панель</h2>
    <?php if (!empty($error)) {
        echo '<div class="error">' . $error . "</div>";
    } ?>
    <form method="post">
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</div>
</body>
</html>
