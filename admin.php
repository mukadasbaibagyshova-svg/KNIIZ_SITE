<?php
session_start();

// Можно вынести пароль в отдельный файл и исключить его из репозитория.
$admin_password = 'admin123';

if (isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['is_admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Неверный пароль';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

if (!empty($_SESSION['is_admin'])) {
    include_once __DIR__ . '/includes/lang.php';
    include_once __DIR__ . '/includes/news_helpers.php';

    $section = $_GET['section'] ?? 'news';

    // Paths
    $news_file = __DIR__ . '/database/news.json';
    $news_upload_dir = __DIR__ . '/uploads/news/';
    if (!is_dir($news_upload_dir)) mkdir($news_upload_dir, 0777, true);

    $site_upload_dir = __DIR__ . '/uploads/site/';
    if (!is_dir($site_upload_dir)) mkdir($site_upload_dir, 0777, true);

    $katalog_upload_dir = __DIR__ . '/uploads/katalog/';
    if (!is_dir($katalog_upload_dir)) mkdir($katalog_upload_dir, 0777, true);

    $admin_upload_dir = __DIR__ . '/uploads/administration/';
    if (!is_dir($admin_upload_dir)) mkdir($admin_upload_dir, 0777, true);

    $overrides_file = __DIR__ . '/database/lang_overrides.json';
    $missing_file = __DIR__ . '/database/lang_missing.json';
    $feedback_file = __DIR__ . '/database/feedback.json';
    $image_overrides_file = __DIR__ . '/database/image_overrides.json';
    $katalog_file = __DIR__ . '/database/katalog.json';
    $administration_file = __DIR__ . '/database/administration.json';

    $success = '';
    $error_msg = '';

    // ---------- NEWS ----------
    if ($section === 'news') {
        $all_news = is_file($news_file) ? json_decode(file_get_contents($news_file), true) : [];
        if (!is_array($all_news)) $all_news = [];

        // delete
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if (isset($all_news[$id])) {
                if (!empty($all_news[$id]['images']) && is_array($all_news[$id]['images'])) {
                    foreach ($all_news[$id]['images'] as $img) {
                        $img_path = $news_upload_dir . basename($img);
                        if (is_file($img_path)) @unlink($img_path);
                    }
                }
                array_splice($all_news, $id, 1);
                file_put_contents($news_file, json_encode($all_news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                header('Location: admin.php?section=news');
                exit;
            }
        }

        // add/edit
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['news_save'])) {
            $edit_id = ($_POST['edit_id'] ?? '') !== '' ? (int)$_POST['edit_id'] : null;
            $date = trim($_POST['news_date'] ?? '') ?: date('Y-m-d');

            $title_ru = trim($_POST['news_title_ru'] ?? '');
            $title_en = trim($_POST['news_title_en'] ?? '');
            $title_ky = trim($_POST['news_title_ky'] ?? '');
            $text_ru = trim($_POST['news_text_ru'] ?? '');
            $text_en = trim($_POST['news_text_en'] ?? '');
            $text_ky = trim($_POST['news_text_ky'] ?? '');

            $images = [];
            if ($edit_id !== null && isset($all_news[$edit_id]['images']) && is_array($all_news[$edit_id]['images'])) {
                $images = $all_news[$edit_id]['images'];
            }

            // upload images
            if (!empty($_FILES['news_images']['name'][0])) {
                foreach ($_FILES['news_images']['tmp_name'] as $k => $tmp_name) {
                    if ($tmp_name && ($_FILES['news_images']['error'][$k] ?? 0) === 0) {
                        $ext = pathinfo($_FILES['news_images']['name'][$k], PATHINFO_EXTENSION);
                        $fname = uniqid('news_', true) . '.' . $ext;
                        move_uploaded_file($tmp_name, $news_upload_dir . $fname);
                        $images[] = $fname;
                    }
                }
            }

            $news_item = [
                'title' => ['ru' => $title_ru, 'en' => $title_en, 'ky' => $title_ky],
                'text' => ['ru' => $text_ru, 'en' => $text_en, 'ky' => $text_ky],
                'date' => $date,
                'images' => $images
            ];

            if ($edit_id !== null && isset($all_news[$edit_id])) {
                $all_news[$edit_id] = $news_item;
                $success = 'Новость обновлена!';
            } else {
                $all_news[] = $news_item;
                $success = 'Новость добавлена!';
            }
            file_put_contents($news_file, json_encode($all_news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        // edit form
        $edit_news = null;
        $edit_id = null;
        if (isset($_GET['edit'])) {
            $edit_id = (int)$_GET['edit'];
            if (isset($all_news[$edit_id])) $edit_news = normalizeNewsItem($all_news[$edit_id]);
        }

        // normalize list for preview
        foreach ($all_news as $i => $n) $all_news[$i] = normalizeNewsItem($n);
    }

    // ---------- TRANSLATIONS ----------
    if ($section === 'translations') {
        $overrides = is_file($overrides_file) ? json_decode(file_get_contents($overrides_file), true) : [];
        if (!is_array($overrides)) $overrides = [];
        foreach (['ru', 'en', 'ky'] as $lc) {
            if (!isset($overrides[$lc]) || !is_array($overrides[$lc])) $overrides[$lc] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_translations'])) {
            $ru = $_POST['ru'] ?? [];
            $en = $_POST['en'] ?? [];
            $ky = $_POST['ky'] ?? [];
            if (is_array($ru) && is_array($en) && is_array($ky)) {
                $keys = array_unique(array_merge(array_keys($ru), array_keys($en), array_keys($ky)));
                foreach ($keys as $key) {
                    $key = trim((string)$key);
                    if ($key === '') continue;
                    $overrides['ru'][$key] = trim((string)($ru[$key] ?? ''));
                    $overrides['en'][$key] = trim((string)($en[$key] ?? ''));
                    $overrides['ky'][$key] = trim((string)($ky[$key] ?? ''));
                }
                file_put_contents($overrides_file, json_encode($overrides, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                $success = 'Переводы сохранены!';
                // перезагрузка страницы, чтобы lang.php подхватил overrides
                header('Location: admin.php?section=translations&saved=1');
                exit;
            }
        }

        $missing = is_file($missing_file) ? json_decode(file_get_contents($missing_file), true) : [];
        if (!is_array($missing)) $missing = [];

        // собрать все ключи
        $allKeys = array_unique(array_merge(
            array_keys($_lang['ru'] ?? []),
            array_keys($_lang['en'] ?? []),
            array_keys($_lang['ky'] ?? [])
        ));
        sort($allKeys);

        $q = trim($_GET['q'] ?? '');
        if ($q !== '') {
            $allKeys = array_values(array_filter($allKeys, function ($k) use ($q) {
                return stripos($k, $q) !== false;
            }));
        }

        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 30;
        $total = count($allKeys);
        $pages = max(1, (int)ceil($total / $perPage));
        if ($page > $pages) $page = $pages;
        $slice = array_slice($allKeys, ($page - 1) * $perPage, $perPage);
    }

    // ---------- FEEDBACK ----------
    if ($section === 'feedback') {
        $feedback = is_file($feedback_file) ? json_decode(file_get_contents($feedback_file), true) : [];
        if (!is_array($feedback)) $feedback = [];

        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if (isset($feedback[$id])) {
                array_splice($feedback, $id, 1);
                file_put_contents($feedback_file, json_encode($feedback, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                header('Location: admin.php?section=feedback');
                exit;
            }
        }
    }

    // ---------- IMAGES ----------
    if ($section === 'images') {
        $imgOverrides = is_file($image_overrides_file) ? json_decode(file_get_contents($image_overrides_file), true) : [];
        if (!is_array($imgOverrides)) $imgOverrides = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_image'])) {
            $key = trim($_POST['image_key'] ?? '');
            if ($key === '') {
                $error_msg = 'Не указан ключ картинки.';
            } elseif (empty($_FILES['image_file']['tmp_name']) || ($_FILES['image_file']['error'] ?? 1) !== 0) {
                $error_msg = 'Файл не выбран или ошибка загрузки.';
            } else {
                $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                $fname = uniqid('site_', true) . '.' . $ext;
                move_uploaded_file($_FILES['image_file']['tmp_name'], $site_upload_dir . $fname);
                // относительный путь для сайта
                $imgOverrides[$key] = 'uploads/site/' . $fname;
                file_put_contents($image_overrides_file, json_encode($imgOverrides, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                $success = 'Картинка обновлена!';
                header('Location: admin.php?section=images');
                exit;
            }
        }

        if (isset($_GET['remove'])) {
            $key = trim($_GET['remove']);
            if ($key !== '' && isset($imgOverrides[$key])) {
                unset($imgOverrides[$key]);
                file_put_contents($image_overrides_file, json_encode($imgOverrides, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                header('Location: admin.php?section=images');
                exit;
            }
        }
    }

    // ---------- KATALOG ----------
    if ($section === 'katalog') {
        $katalog = is_file($katalog_file) ? json_decode(file_get_contents($katalog_file), true) : [];
        if (!is_array($katalog)) $katalog = [];

        // Delete variety
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if (isset($katalog[$id])) {
                array_splice($katalog, $id, 1);
                file_put_contents($katalog_file, json_encode($katalog, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                header('Location: admin.php?section=katalog');
                exit;
            }
        }

        // Save variety
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['katalog_save'])) {
            $edit_id = ($_POST['edit_id'] ?? '') !== '' ? (int)$_POST['edit_id'] : null;
            
            $variety = [
                'id' => trim($_POST['variety_id'] ?? '') ?: 'v_' . uniqid(),
                'name' => [
                    'ru' => trim($_POST['name_ru'] ?? ''),
                    'en' => trim($_POST['name_en'] ?? ''),
                    'ky' => trim($_POST['name_ky'] ?? '')
                ],
                'culture' => trim($_POST['culture'] ?? 'barley'),
                'season' => trim($_POST['season'] ?? 'spring'),
                'maturity' => trim($_POST['maturity'] ?? 'mid'),
                'drought' => trim($_POST['drought'] ?? 'medium'),
                'yield_num' => trim($_POST['yield_num'] ?? ''),
                'year_num' => trim($_POST['year_num'] ?? ''),
                'image' => 'barley_field.png',
                'type' => [
                    'ru' => trim($_POST['type_ru'] ?? ''),
                    'en' => trim($_POST['type_en'] ?? ''),
                    'ky' => trim($_POST['type_ky'] ?? '')
                ],
                'description' => [
                    'ru' => trim($_POST['desc_ru'] ?? ''),
                    'en' => trim($_POST['desc_en'] ?? ''),
                    'ky' => trim($_POST['desc_ky'] ?? '')
                ],
                'mass' => [
                    'ru' => trim($_POST['mass_ru'] ?? ''),
                    'en' => trim($_POST['mass_en'] ?? ''),
                    'ky' => trim($_POST['mass_ky'] ?? '')
                ],
                'yield_text' => [
                    'ru' => trim($_POST['yield_text_ru'] ?? ''),
                    'en' => trim($_POST['yield_text_en'] ?? ''),
                    'ky' => trim($_POST['yield_text_ky'] ?? '')
                ],
                'protein' => [
                    'ru' => trim($_POST['protein_ru'] ?? ''),
                    'en' => trim($_POST['protein_en'] ?? ''),
                    'ky' => trim($_POST['protein_ky'] ?? '')
                ],
                'year_text' => [
                    'ru' => trim($_POST['year_text_ru'] ?? ''),
                    'en' => trim($_POST['year_text_en'] ?? ''),
                    'ky' => trim($_POST['year_text_ky'] ?? '')
                ],
                'properties' => [
                    'ru' => array_filter(array_map('trim', explode("\n", $_POST['props_ru'] ?? ''))),
                    'en' => array_filter(array_map('trim', explode("\n", $_POST['props_en'] ?? ''))),
                    'ky' => array_filter(array_map('trim', explode("\n", $_POST['props_ky'] ?? '')))
                ],
                'modal_key' => trim($_POST['modal_key'] ?? '') ?: strtolower(preg_replace('/[^a-zA-Z0-9]/', '', trim($_POST['name_ru'] ?? ''))),
                'seeding' => [
                    'ru' => trim($_POST['seeding_ru'] ?? ''),
                    'en' => trim($_POST['seeding_en'] ?? ''),
                    'ky' => trim($_POST['seeding_ky'] ?? '')
                ]
            ];

            // Handle image upload
            if (!empty($_FILES['variety_image']['tmp_name']) && $_FILES['variety_image']['error'] === 0) {
                $ext = pathinfo($_FILES['variety_image']['name'], PATHINFO_EXTENSION);
                $fname = uniqid('sort_', true) . '.' . $ext;
                move_uploaded_file($_FILES['variety_image']['tmp_name'], $katalog_upload_dir . $fname);
                $variety['image'] = '../uploads/katalog/' . $fname;
            } elseif ($edit_id !== null && isset($katalog[$edit_id]['image'])) {
                $variety['image'] = $katalog[$edit_id]['image'];
            }

            if ($edit_id !== null && isset($katalog[$edit_id])) {
                $katalog[$edit_id] = $variety;
                $success = 'Сорт обновлен!';
            } else {
                $katalog[] = $variety;
                $success = 'Сорт добавлен!';
            }
            file_put_contents($katalog_file, json_encode($katalog, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        // edit form
        $edit_variety = null;
        $edit_id = null;
        if (isset($_GET['edit'])) {
            $edit_id = (int)$_GET['edit'];
            if (isset($katalog[$edit_id])) $edit_variety = $katalog[$edit_id];
        }
    }

    // ---------- ADMINISTRATION ----------
    if ($section === 'administration') {
        $admin_data = is_file($administration_file) ? json_decode(file_get_contents($administration_file), true) : [];
        if (!is_array($admin_data)) $admin_data = [];

        $sub = $_GET['sub'] ?? 'leadership';

        // Add staff member
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staff_save'])) {
            $target_section = $_POST['target_section'] ?? 'leadership';
            $target_dept = $_POST['target_dept'] ?? '';
            $staff_edit_id = ($_POST['staff_edit_id'] ?? '') !== '' ? (int)$_POST['staff_edit_id'] : null;

            $new_staff = [
                'name' => [
                    'ru' => trim($_POST['staff_name_ru'] ?? ''),
                    'en' => trim($_POST['staff_name_en'] ?? ''),
                    'ky' => trim($_POST['staff_name_ky'] ?? '')
                ],
                'role' => [
                    'ru' => trim($_POST['staff_role_ru'] ?? ''),
                    'en' => trim($_POST['staff_role_en'] ?? ''),
                    'ky' => trim($_POST['staff_role_ky'] ?? '')
                ],
                'email' => trim($_POST['staff_email'] ?? ''),
                'image' => '',
                'grade' => trim($_POST['staff_grade'] ?? 'staff')
            ];

            // Handle image upload
            if (!empty($_FILES['staff_image']['tmp_name']) && $_FILES['staff_image']['error'] === 0) {
                $ext = pathinfo($_FILES['staff_image']['name'], PATHINFO_EXTENSION);
                $fname = uniqid('staff_', true) . '.' . $ext;
                move_uploaded_file($_FILES['staff_image']['tmp_name'], $admin_upload_dir . $fname);
                $new_staff['image'] = 'uploads/administration/' . $fname;
            }

            // Save to appropriate section
            if ($target_section === 'leadership' || $target_section === 'admin_support') {
                if (!isset($admin_data[$target_section]) || !is_array($admin_data[$target_section])) {
                    $admin_data[$target_section] = [];
                }
                if ($staff_edit_id !== null && isset($admin_data[$target_section][$staff_edit_id])) {
                    if (empty($new_staff['image']) && !empty($admin_data[$target_section][$staff_edit_id]['image'])) {
                        $new_staff['image'] = $admin_data[$target_section][$staff_edit_id]['image'];
                    }
                    $admin_data[$target_section][$staff_edit_id] = $new_staff;
                    $success = 'Сотрудник обновлен!';
                } else {
                    $admin_data[$target_section][] = $new_staff;
                    $success = 'Сотрудник добавлен!';
                }
            } elseif ($target_section === 'departments' && $target_dept !== '') {
                if (!isset($admin_data['departments'][$target_dept]['staff'])) {
                    $admin_data['departments'][$target_dept]['staff'] = [];
                }
                if ($staff_edit_id !== null && isset($admin_data['departments'][$target_dept]['staff'][$staff_edit_id])) {
                    if (empty($new_staff['image']) && !empty($admin_data['departments'][$target_dept]['staff'][$staff_edit_id]['image'])) {
                        $new_staff['image'] = $admin_data['departments'][$target_dept]['staff'][$staff_edit_id]['image'];
                    }
                    $admin_data['departments'][$target_dept]['staff'][$staff_edit_id] = $new_staff;
                    $success = 'Сотрудник обновлен!';
                } else {
                    $admin_data['departments'][$target_dept]['staff'][] = $new_staff;
                    $success = 'Сотрудник добавлен!';
                }
            }
            
            file_put_contents($administration_file, json_encode($admin_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        // Delete staff member
        if (isset($_GET['del_staff'])) {
            $del_section = $_GET['del_section'] ?? '';
            $del_dept = $_GET['del_dept'] ?? '';
            $del_idx = (int)($_GET['del_staff'] ?? -1);
            
            if ($del_section === 'leadership' || $del_section === 'admin_support') {
                if (isset($admin_data[$del_section][$del_idx])) {
                    array_splice($admin_data[$del_section], $del_idx, 1);
                    file_put_contents($administration_file, json_encode($admin_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }
            } elseif ($del_section === 'departments' && $del_dept !== '') {
                if (isset($admin_data['departments'][$del_dept]['staff'][$del_idx])) {
                    array_splice($admin_data['departments'][$del_dept]['staff'], $del_idx, 1);
                    file_put_contents($administration_file, json_encode($admin_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                }
            }
            header('Location: admin.php?section=administration&sub=' . urlencode($sub));
            exit;
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
                <a class="<?php echo $section==='news'?'active':''; ?>" href="admin.php?section=news">📰 Новости</a>
                <a class="<?php echo $section==='katalog'?'active':''; ?>" href="admin.php?section=katalog">🌱 Каталог сортов</a>
                <a class="<?php echo $section==='administration'?'active':''; ?>" href="admin.php?section=administration">👥 Администрация</a>
                <a class="<?php echo $section==='feedback'?'active':''; ?>" href="admin.php?section=feedback">📩 Заявки</a>
                <a class="<?php echo $section==='translations'?'active':''; ?>" href="admin.php?section=translations">🌐 Переводы</a>
                <a class="<?php echo $section==='images'?'active':''; ?>" href="admin.php?section=images">🖼️ Картинки</a>
            </nav>
            <div class="content">
                <?php if (!empty($success) || !empty($_GET['saved'])): ?>
                    <div class="success"><?php echo !empty($success) ? htmlspecialchars($success) : 'Сохранено!'; ?></div>
                <?php endif; ?>
                <?php if (!empty($error_msg)): ?>
                    <div class="error"><?php echo htmlspecialchars($error_msg); ?></div>
                <?php endif; ?>

                <?php if ($section === 'news'): ?>
                    <h2><?php echo $edit_news ? '✏️ Редактировать новость' : '➕ Добавить новость'; ?></h2>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="news_save" value="1">
                        <input type="hidden" name="edit_id" value="<?php echo $edit_news ? (int)$edit_id : ''; ?>">
                        <div class="row">
                            <div class="col">
                                <label>Заголовок (RU)</label>
                                <input type="text" name="news_title_ru" required value="<?php echo htmlspecialchars($edit_news['title']['ru'] ?? ''); ?>">
                            </div>
                            <div class="col">
                                <label>Заголовок (EN)</label>
                                <input type="text" name="news_title_en" value="<?php echo htmlspecialchars($edit_news['title']['en'] ?? ''); ?>">
                            </div>
                            <div class="col">
                                <label>Заголовок (KY)</label>
                                <input type="text" name="news_title_ky" value="<?php echo htmlspecialchars($edit_news['title']['ky'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col">
                                <label>Текст (RU)</label>
                                <textarea name="news_text_ru" required><?php echo htmlspecialchars($edit_news['text']['ru'] ?? ''); ?></textarea>
                            </div>
                            <div class="col">
                                <label>Текст (EN)</label>
                                <textarea name="news_text_en"><?php echo htmlspecialchars($edit_news['text']['en'] ?? ''); ?></textarea>
                            </div>
                            <div class="col">
                                <label>Текст (KY)</label>
                                <textarea name="news_text_ky"><?php echo htmlspecialchars($edit_news['text']['ky'] ?? ''); ?></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px; align-items:end;">
                            <div class="col" style="max-width: 260px;">
                                <label>Дата</label>
                                <input type="date" name="news_date" value="<?php echo htmlspecialchars($edit_news['date'] ?? date('Y-m-d')); ?>">
                            </div>
                            <div class="col">
                                <label>Фото (можно несколько)</label>
                                <input type="file" name="news_images[]" multiple accept="image/*">
                            </div>
                            <div class="col" style="max-width: 200px;">
                                <button class="btn" type="submit"><?php echo $edit_news ? '💾 Сохранить' : '➕ Добавить'; ?></button>
                            </div>
                        </div>

                        <?php if ($edit_news && !empty($edit_news['images'])): ?>
                            <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">
                                <?php foreach ($edit_news['images'] as $img): ?>
                                    <img class="imgprev" src="<?php echo 'uploads/news/' . htmlspecialchars($img); ?>" alt="">
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
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo htmlspecialchars($n['title']['ru'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($n['date'] ?? ''); ?></td>
                                <td>
                                    <?php if (!empty($n['images'][0])): ?>
                                        <img class="imgprev" src="<?php echo 'uploads/news/' . htmlspecialchars($n['images'][0]); ?>" alt="">
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

                <?php elseif ($section === 'katalog'): ?>
                    <h2>🌱 Каталог сортов (<?php echo count($katalog); ?> сортов)</h2>
                    
                    <details <?php echo $edit_variety ? 'open' : ''; ?>>
                        <summary><?php echo $edit_variety ? '✏️ Редактировать сорт «' . htmlspecialchars($edit_variety['name']['ru'] ?? '') . '»' : '➕ Добавить новый сорт'; ?></summary>
                        <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:10px;">
                            <input type="hidden" name="katalog_save" value="1">
                            <input type="hidden" name="edit_id" value="<?php echo $edit_variety ? (int)$edit_id : ''; ?>">
                            <input type="hidden" name="variety_id" value="<?php echo htmlspecialchars($edit_variety['id'] ?? ''); ?>">
                            <input type="hidden" name="modal_key" value="<?php echo htmlspecialchars($edit_variety['modal_key'] ?? ''); ?>">
                            
                            <h3>Основные данные</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Название (RU) *</label>
                                    <input type="text" name="name_ru" required value="<?php echo htmlspecialchars($edit_variety['name']['ru'] ?? ''); ?>">
                                </div>
                                <div class="col">
                                    <label>Название (EN)</label>
                                    <input type="text" name="name_en" value="<?php echo htmlspecialchars($edit_variety['name']['en'] ?? ''); ?>">
                                </div>
                                <div class="col">
                                    <label>Название (KY)</label>
                                    <input type="text" name="name_ky" value="<?php echo htmlspecialchars($edit_variety['name']['ky'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Культура</label>
                                    <select name="culture">
                                        <option value="barley" <?php echo ($edit_variety['culture'] ?? '') === 'barley' ? 'selected' : ''; ?>>Ячмень</option>
                                        <option value="wheat" <?php echo ($edit_variety['culture'] ?? '') === 'wheat' ? 'selected' : ''; ?>>Пшеница</option>
                                        <option value="corn" <?php echo ($edit_variety['culture'] ?? '') === 'corn' ? 'selected' : ''; ?>>Кукуруза</option>
                                        <option value="sugarbeet" <?php echo ($edit_variety['culture'] ?? '') === 'sugarbeet' ? 'selected' : ''; ?>>Сахарная свекла</option>
                                        <option value="cotton" <?php echo ($edit_variety['culture'] ?? '') === 'cotton' ? 'selected' : ''; ?>>Хлопок</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Сезон</label>
                                    <select name="season">
                                        <option value="spring" <?php echo ($edit_variety['season'] ?? '') === 'spring' ? 'selected' : ''; ?>>Яровой</option>
                                        <option value="winter" <?php echo ($edit_variety['season'] ?? '') === 'winter' ? 'selected' : ''; ?>>Озимый</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Спелость</label>
                                    <select name="maturity">
                                        <option value="early" <?php echo ($edit_variety['maturity'] ?? '') === 'early' ? 'selected' : ''; ?>>Раннеспелый</option>
                                        <option value="mid-early" <?php echo ($edit_variety['maturity'] ?? '') === 'mid-early' ? 'selected' : ''; ?>>Среднеранний</option>
                                        <option value="mid" <?php echo ($edit_variety['maturity'] ?? '') === 'mid' ? 'selected' : ''; ?>>Среднеспелый</option>
                                        <option value="late" <?php echo ($edit_variety['maturity'] ?? '') === 'late' ? 'selected' : ''; ?>>Позднеспелый</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Засухоустойчивость</label>
                                    <select name="drought">
                                        <option value="high" <?php echo ($edit_variety['drought'] ?? '') === 'high' ? 'selected' : ''; ?>>Высокая</option>
                                        <option value="medium" <?php echo ($edit_variety['drought'] ?? '') === 'medium' ? 'selected' : ''; ?>>Средняя</option>
                                        <option value="low" <?php echo ($edit_variety['drought'] ?? '') === 'low' ? 'selected' : ''; ?>>Низкая</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Тип (RU)</label>
                                    <input type="text" name="type_ru" value="<?php echo htmlspecialchars($edit_variety['type']['ru'] ?? ''); ?>" placeholder="Ячмень яровой • Нутанс">
                                </div>
                                <div class="col">
                                    <label>Тип (EN)</label>
                                    <input type="text" name="type_en" value="<?php echo htmlspecialchars($edit_variety['type']['en'] ?? ''); ?>">
                                </div>
                                <div class="col">
                                    <label>Тип (KY)</label>
                                    <input type="text" name="type_ky" value="<?php echo htmlspecialchars($edit_variety['type']['ky'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <h3>Статистика</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Масса 1000 зерён (RU)</label>
                                    <input type="text" name="mass_ru" value="<?php echo htmlspecialchars($edit_variety['mass']['ru'] ?? ''); ?>" placeholder="45,4–50,2 г">
                                </div>
                                <div class="col">
                                    <label>Урожайность текст (RU)</label>
                                    <input type="text" name="yield_text_ru" value="<?php echo htmlspecialchars($edit_variety['yield_text']['ru'] ?? ''); ?>" placeholder="63,4 ц/га">
                                </div>
                                <div class="col">
                                    <label>Урожайность число</label>
                                    <input type="text" name="yield_num" value="<?php echo htmlspecialchars($edit_variety['yield_num'] ?? ''); ?>" placeholder="63.4">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Белок (RU)</label>
                                    <input type="text" name="protein_ru" value="<?php echo htmlspecialchars($edit_variety['protein']['ru'] ?? ''); ?>">
                                </div>
                                <div class="col">
                                    <label>Год допуска текст (RU)</label>
                                    <input type="text" name="year_text_ru" value="<?php echo htmlspecialchars($edit_variety['year_text']['ru'] ?? ''); ?>" placeholder="с 1972 г.">
                                </div>
                                <div class="col">
                                    <label>Год допуска число</label>
                                    <input type="text" name="year_num" value="<?php echo htmlspecialchars($edit_variety['year_num'] ?? ''); ?>" placeholder="1972">
                                </div>
                            </div>

                            <details style="margin-top:12px;">
                                <summary>Переводы EN/KY для статистики</summary>
                                <div class="row" style="margin-top:8px;">
                                    <div class="col"><label>Масса (EN)</label><input name="mass_en" value="<?php echo htmlspecialchars($edit_variety['mass']['en'] ?? ''); ?>"></div>
                                    <div class="col"><label>Масса (KY)</label><input name="mass_ky" value="<?php echo htmlspecialchars($edit_variety['mass']['ky'] ?? ''); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Урожайность текст (EN)</label><input name="yield_text_en" value="<?php echo htmlspecialchars($edit_variety['yield_text']['en'] ?? ''); ?>"></div>
                                    <div class="col"><label>Урожайность текст (KY)</label><input name="yield_text_ky" value="<?php echo htmlspecialchars($edit_variety['yield_text']['ky'] ?? ''); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Белок (EN)</label><input name="protein_en" value="<?php echo htmlspecialchars($edit_variety['protein']['en'] ?? ''); ?>"></div>
                                    <div class="col"><label>Белок (KY)</label><input name="protein_ky" value="<?php echo htmlspecialchars($edit_variety['protein']['ky'] ?? ''); ?>"></div>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <div class="col"><label>Год допуска (EN)</label><input name="year_text_en" value="<?php echo htmlspecialchars($edit_variety['year_text']['en'] ?? ''); ?>"></div>
                                    <div class="col"><label>Год допуска (KY)</label><input name="year_text_ky" value="<?php echo htmlspecialchars($edit_variety['year_text']['ky'] ?? ''); ?>"></div>
                                </div>
                            </details>

                            <h3>Описание</h3>
                            <div class="row">
                                <div class="col">
                                    <label>Описание (RU)</label>
                                    <textarea name="desc_ru"><?php echo htmlspecialchars($edit_variety['description']['ru'] ?? ''); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Описание (EN)</label>
                                    <textarea name="desc_en"><?php echo htmlspecialchars($edit_variety['description']['en'] ?? ''); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Описание (KY)</label>
                                    <textarea name="desc_ky"><?php echo htmlspecialchars($edit_variety['description']['ky'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Норма посева (RU)</label>
                                    <textarea name="seeding_ru" style="min-height:50px;"><?php echo htmlspecialchars($edit_variety['seeding']['ru'] ?? ''); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Норма посева (EN)</label>
                                    <textarea name="seeding_en" style="min-height:50px;"><?php echo htmlspecialchars($edit_variety['seeding']['en'] ?? ''); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Норма посева (KY)</label>
                                    <textarea name="seeding_ky" style="min-height:50px;"><?php echo htmlspecialchars($edit_variety['seeding']['ky'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="row" style="margin-top:10px;">
                                <div class="col">
                                    <label>Свойства (RU, по одному на строку)</label>
                                    <textarea name="props_ru" style="min-height:50px;"><?php echo htmlspecialchars(implode("\n", (array)($edit_variety['properties']['ru'] ?? []))); ?></textarea>
                                </div>
                                <div class="col">
                                    <label>Фото сорта</label>
                                    <input type="file" name="variety_image" accept="image/*">
                                    <?php if ($edit_variety && !empty($edit_variety['image'])): ?>
                                        <img class="imgprev" src="assets/images/<?php echo htmlspecialchars($edit_variety['image']); ?>" alt="" style="margin-top:6px;">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <details style="margin-top:12px;">
                                <summary>Свойства EN/KY</summary>
                                <div class="row" style="margin-top:8px;">
                                    <div class="col"><label>Свойства (EN)</label><textarea name="props_en" style="min-height:50px;"><?php echo htmlspecialchars(implode("\n", (array)($edit_variety['properties']['en'] ?? []))); ?></textarea></div>
                                    <div class="col"><label>Свойства (KY)</label><textarea name="props_ky" style="min-height:50px;"><?php echo htmlspecialchars(implode("\n", (array)($edit_variety['properties']['ky'] ?? []))); ?></textarea></div>
                                </div>
                            </details>

                            <div style="margin-top:16px;">
                                <button class="btn" type="submit"><?php echo $edit_variety ? '💾 Сохранить изменения' : '➕ Добавить сорт'; ?></button>
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
                                <td><?php echo $i+1; ?></td>
                                <td><strong><?php echo htmlspecialchars($v['name']['ru'] ?? ''); ?></strong></td>
                                <td><?php echo htmlspecialchars($v['culture'] ?? ''); ?></td>
                                <td><?php echo ($v['season'] ?? '') === 'spring' ? 'Яровой' : 'Озимый'; ?></td>
                                <td><?php echo htmlspecialchars($v['yield_text']['ru'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($v['year_num'] ?? ''); ?></td>
                                <td>
                                    <a href="admin.php?section=katalog&edit=<?php echo $i; ?>">✏️</a>
                                    &nbsp;|&nbsp;
                                    <a href="admin.php?section=katalog&delete=<?php echo $i; ?>" onclick="return confirm('Удалить сорт?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php elseif ($section === 'administration'): ?>
                    <h2>👥 Администрация и сотрудники</h2>
                    
                    <div class="sub-nav">
                        <a class="<?php echo $sub==='leadership'?'active':''; ?>" href="admin.php?section=administration&sub=leadership">👔 Руководство</a>
                        <a class="<?php echo $sub==='admin_support'?'active':''; ?>" href="admin.php?section=administration&sub=admin_support">📋 Адм. поддержка</a>
                        <?php if (!empty($admin_data['departments']) && is_array($admin_data['departments'])): ?>
                            <?php foreach ($admin_data['departments'] as $dkey => $dept): ?>
                                <a class="<?php echo $sub==='dept_'.$dkey?'active':''; ?>" href="admin.php?section=administration&sub=dept_<?php echo urlencode($dkey); ?>">
                                    <?php echo htmlspecialchars($dept['icon'] ?? '📁'); ?> <?php echo htmlspecialchars(mb_substr($dept['title']['ru'] ?? $dkey, 0, 25)); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <a class="<?php echo $sub==='branches'?'active':''; ?>" href="admin.php?section=administration&sub=branches">🏢 Филиалы</a>
                    </div>

                    <?php
                    // Determine which section to show
                    $show_staff = [];
                    $target_section_name = '';
                    $target_dept_key = '';
                    
                    if ($sub === 'leadership') {
                        $show_staff = $admin_data['leadership'] ?? [];
                        $target_section_name = 'leadership';
                    } elseif ($sub === 'admin_support') {
                        $show_staff = $admin_data['admin_support'] ?? [];
                        $target_section_name = 'admin_support';
                    } elseif (strpos($sub, 'dept_') === 0) {
                        $dkey = substr($sub, 5);
                        $target_dept_key = $dkey;
                        $show_staff = $admin_data['departments'][$dkey]['staff'] ?? [];
                        $target_section_name = 'departments';
                    } elseif ($sub === 'branches') {
                        // Show branches list
                        $target_section_name = 'branches';
                    }
                    ?>

                    <?php if ($target_section_name !== 'branches'): ?>
                        <!-- Staff list -->
                        <h3>Сотрудники (<?php echo count($show_staff); ?>)</h3>
                        <?php foreach ($show_staff as $idx => $s): ?>
                            <div class="staff-row">
                                <div class="staff-avatar">
                                    <?php if (!empty($s['image'])): ?>
                                        <img src="<?php echo htmlspecialchars($s['image']); ?>" alt="">
                                    <?php else: ?>
                                        <?php
                                        $parts = explode(' ', trim($s['name']['ru'] ?? ''));
                                        $initials = '';
                                        if (!empty($parts[0])) $initials .= mb_substr($parts[0], 0, 1, 'UTF-8');
                                        if (!empty($parts[1])) $initials .= mb_substr($parts[1], 0, 1, 'UTF-8');
                                        echo mb_strtoupper($initials, 'UTF-8');
                                        ?>
                                    <?php endif; ?>
                                </div>
                                <div class="staff-info">
                                    <div class="staff-name"><?php echo htmlspecialchars($s['name']['ru'] ?? ''); ?></div>
                                    <div class="staff-role"><?php echo htmlspecialchars($s['role']['ru'] ?? ''); ?></div>
                                    <?php if (!empty($s['email'])): ?>
                                        <div class="small"><?php echo htmlspecialchars($s['email']); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="staff-actions">
                                    <a href="admin.php?section=administration&sub=<?php echo urlencode($sub); ?>&del_staff=<?php echo $idx; ?>&del_section=<?php echo urlencode($target_section_name); ?>&del_dept=<?php echo urlencode($target_dept_key); ?>" 
                                       onclick="return confirm('Удалить сотрудника?');" title="Удалить">🗑️</a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Add staff form -->
                        <details style="margin-top:16px;">
                            <summary>➕ Добавить сотрудника</summary>
                            <form method="post" enctype="multipart/form-data" class="form-section" style="margin-top:8px;">
                                <input type="hidden" name="staff_save" value="1">
                                <input type="hidden" name="target_section" value="<?php echo htmlspecialchars($target_section_name); ?>">
                                <input type="hidden" name="target_dept" value="<?php echo htmlspecialchars($target_dept_key); ?>">
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
                        <?php if (!empty($admin_data['branches']) && is_array($admin_data['branches'])): ?>
                            <?php foreach ($admin_data['branches'] as $bi => $branch): ?>
                                <div class="card">
                                    <strong><?php echo htmlspecialchars($branch['title']['ru'] ?? ''); ?></strong>
                                    <?php if (!empty($branch['location'])): ?>
                                        <div class="small">📍 <?php echo htmlspecialchars($branch['location']); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($branch['staff'])): ?>
                                        <div style="margin-top:8px;">
                                            <?php foreach ($branch['staff'] as $s): ?>
                                                <div class="small">
                                                    👤 <?php echo htmlspecialchars($s['name']['ru'] ?? ''); ?> — <?php echo htmlspecialchars($s['role']['ru'] ?? ''); ?>
                                                    <?php if (!empty($s['email'])): ?> (<?php echo htmlspecialchars($s['email']); ?>)<?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($branch['sub_departments'])): ?>
                                        <div style="margin-top:8px;">
                                            <?php foreach ($branch['sub_departments'] as $sd): ?>
                                                <div class="small" style="margin-left:16px;">
                                                    📁 <strong><?php echo htmlspecialchars($sd['title']['ru'] ?? ''); ?></strong>
                                                    <?php if (!empty($sd['staff'])): ?>
                                                        <?php foreach ($sd['staff'] as $sds): ?>
                                                            <div style="margin-left:16px;">👤 <?php echo htmlspecialchars($sds['name']['ru'] ?? ''); ?> — <?php echo htmlspecialchars($sds['role']['ru'] ?? ''); ?></div>
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

                <?php elseif ($section === 'feedback'): ?>
                    <h2>📩 Заявки с формы обратной связи</h2>
                    <?php if (empty($feedback)): ?>
                        <p class="small">Пока нет заявок.</p>
                    <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:40px;">#</th>
                                    <th style="width:170px;">Дата</th>
                                    <th>Имя / Email</th>
                                    <th>Сообщение</th>
                                    <th style="width:90px;">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach (array_reverse($feedback, true) as $i => $f): ?>
                                <tr>
                                    <td><?php echo (int)$i + 1; ?></td>
                                    <td><?php echo htmlspecialchars($f['created_at'] ?? ''); ?><div class="small">lang: <?php echo htmlspecialchars($f['lang'] ?? ''); ?></div></td>
                                    <td>
                                        <b><?php echo htmlspecialchars($f['name'] ?? ''); ?></b><br>
                                        <?php echo htmlspecialchars($f['email'] ?? ''); ?>
                                        <div class="small"><?php echo htmlspecialchars($f['ip'] ?? ''); ?></div>
                                    </td>
                                    <td><?php echo nl2br(htmlspecialchars($f['message'] ?? '')); ?></td>
                                    <td>
                                        <a href="admin.php?section=feedback&delete=<?php echo (int)$i; ?>" onclick="return confirm('Удалить заявку?');">🗑️</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                <?php elseif ($section === 'translations'): ?>
                    <h2>🌐 Переводы (все страницы)</h2>
                    <p class="small">
                        Здесь можно менять любые тексты сайта (ключи t('...')).<br>
                        Если какой-то ключ не переведен — сайт покажет русский текст и добавит ключ в список «пропущенные».
                    </p>

                    <div style="margin: 10px 0 16px;">
                        <form method="get" style="display:flex; gap:10px; align-items:center;">
                            <input type="hidden" name="section" value="translations">
                            <input type="text" name="q" placeholder="Поиск по ключу..." value="<?php echo htmlspecialchars($q); ?>" style="max-width:320px;">
                            <button class="btn btn-secondary" type="submit">🔍 Найти</button>
                        </form>
                    </div>

                    <details style="margin: 0 0 14px;">
                        <summary><b>Пропущенные переводы</b> (что нужно доперевести)</summary>
                        <div class="small" style="margin-top:8px;">
                            <?php foreach (['en','ky','ru'] as $lc): ?>
                                <div style="margin-bottom:6px;">
                                    <b><?php echo strtoupper($lc); ?>:</b>
                                    <?php
                                        $list = $missing[$lc] ?? [];
                                        if (!is_array($list) || empty($list)) { echo '—'; }
                                        else { echo htmlspecialchars(implode(', ', $list)); }
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
                                    <td class="key"><?php echo htmlspecialchars($k); ?></td>
                                    <td><textarea name="ru[<?php echo htmlspecialchars($k); ?>]"><?php echo htmlspecialchars($_lang['ru'][$k] ?? ''); ?></textarea></td>
                                    <td><textarea name="en[<?php echo htmlspecialchars($k); ?>]"><?php echo htmlspecialchars($_lang['en'][$k] ?? ''); ?></textarea></td>
                                    <td><textarea name="ky[<?php echo htmlspecialchars($k); ?>]"><?php echo htmlspecialchars($_lang['ky'][$k] ?? ''); ?></textarea></td>
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
                            $base = 'admin.php?section=translations' . ($q !== '' ? '&q=' . urlencode($q) : '');
                            if ($page > 1) echo '<a href="'.$base.'&page='.($page-1).'">← Назад</a>';
                            if ($page < $pages) echo '<a href="'.$base.'&page='.($page+1).'">Вперед →</a>';
                        ?>
                    </div>

                <?php elseif ($section === 'images'): ?>
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
                                    <td class="key"><?php echo htmlspecialchars($k); ?></td>
                                    <td class="small"><?php echo htmlspecialchars($path); ?></td>
                                    <td><?php if (is_string($path) && $path !== ''): ?><img class="imgprev" src="<?php echo htmlspecialchars($path); ?>" alt=""><?php endif; ?></td>
                                    <td><a href="admin.php?section=images&remove=<?php echo urlencode($k); ?>" onclick="return confirm('Убрать замену?');">🗑️</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
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
    <?php if (!empty($error)) echo '<div class="error">'.$error.'</div>'; ?>
    <form method="post">
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</div>
</body>
</html>
