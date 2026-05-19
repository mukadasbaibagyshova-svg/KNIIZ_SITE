<?php
session_start();
$admin_password = 'admin123'; // Задайте свой пароль

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
    $news_file = 'database/news.json';
    $upload_dir = 'uploads/news/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    // Удаление новости
    if (isset($_GET['delete'])) {
        $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];
        $id = (int)$_GET['delete'];
        if (isset($all_news[$id])) {
            // Удалить фото
            if (!empty($all_news[$id]['images'])) {
                foreach ($all_news[$id]['images'] as $img) {
                    $img_path = $upload_dir . basename($img);
                    if (is_file($img_path)) unlink($img_path);
                }
            }
            array_splice($all_news, $id, 1);
            file_put_contents($news_file, json_encode($all_news, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            header('Location: admin.php');
            exit;
        }
    }


    // Редактирование новости
    if (isset($_POST['edit_id']) && $_POST['edit_id'] !== '') {
        $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];
        $id = (int)$_POST['edit_id'];
        if (isset($all_news[$id])) {
            $all_news[$id]['title'] = trim($_POST['news_title']);
            $all_news[$id]['text'] = trim($_POST['news_text']);
            $all_news[$id]['date'] = $_POST['news_date'];
            // Если не было фото, и не загружено новых, images должен быть массивом
            if (!isset($all_news[$id]['images']) || !is_array($all_news[$id]['images'])) {
                $all_news[$id]['images'] = [];
            }
            // Добавление новых фото
            if (!empty($_FILES['news_images']['name'][0])) {
                foreach ($_FILES['news_images']['tmp_name'] as $k => $tmp_name) {
                    if ($tmp_name && $_FILES['news_images']['error'][$k] === 0) {
                        $ext = pathinfo($_FILES['news_images']['name'][$k], PATHINFO_EXTENSION);
                        $fname = uniqid('news_', true) . '.' . $ext;
                        move_uploaded_file($tmp_name, $upload_dir . $fname);
                        $all_news[$id]['images'][] = $fname;
                    }
                }
            }
            file_put_contents($news_file, json_encode($all_news, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            $success = 'Новость обновлена!';
        }
    }

    // Добавление новости
    if (isset($_POST['news_title'], $_POST['news_text']) && (!isset($_POST['edit_id']) || $_POST['edit_id'] === '')) {
        $title = trim($_POST['news_title']);
        $text = trim($_POST['news_text']);
        $date = $_POST['news_date'] ?: date('Y-m-d');
        $images = [];
        if (!empty($_FILES['news_images']['name'][0])) {
            foreach ($_FILES['news_images']['tmp_name'] as $k => $tmp_name) {
                if ($tmp_name && $_FILES['news_images']['error'][$k] === 0) {
                    $ext = pathinfo($_FILES['news_images']['name'][$k], PATHINFO_EXTENSION);
                    $fname = uniqid('news_', true) . '.' . $ext;
                    move_uploaded_file($tmp_name, $upload_dir . $fname);
                    $images[] = $fname;
                }
            }
        }
        if ($title && $text) {
            $news = [
                'title' => $title,
                'text' => $text,
                'date' => $date,
                'images' => $images
            ];
            $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];
            $all_news[] = $news; // Добавляем в конец, чтобы индексы не сбивались
            file_put_contents($news_file, json_encode($all_news, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            $success = 'Новость добавлена!';
        }
    }

    // Получить все новости
    $all_news = file_exists($news_file) ? json_decode(file_get_contents($news_file), true) : [];

    // Форма редактирования
    $edit_news = null;
    if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        if (isset($all_news[$id])) {
            $edit_news = $all_news[$id];
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Админ-панель — Новости</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f7f7f7; }
            .admin-panel { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
            h2 { color: #216c3d; }
            input, textarea, .date-input { width: 100%; margin-bottom: 12px; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
            button { background: #216c3d; color: #fff; border: none; padding: 10px 24px; border-radius: 6px; cursor: pointer; }
            .success { color: green; }
            .logout { float: right; }
            .news-list { margin-top: 40px; }
            .news-item { border-bottom: 1px solid #eee; padding: 16px 0; }
            .news-images img { max-width: 120px; max-height: 90px; margin: 4px 8px 4px 0; border-radius: 6px; }
            .news-actions { margin-top: 8px; }
        </style>
    </head>
    <body>
    <div class="admin-panel">
        <a href="?logout=1" class="logout">Выйти</a>
        <h2><?php echo $edit_news ? 'Редактировать новость' : 'Добавить новость'; ?></h2>
        <?php if (!empty($success)) echo '<div class="success">'.$success.'</div>'; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?php echo $edit_news ? $id : ''; ?>">
            <input type="text" name="news_title" placeholder="Заголовок" required value="<?php echo $edit_news ? htmlspecialchars($edit_news['title']) : ''; ?>">
            <textarea name="news_text" placeholder="Текст новости" rows="5" required><?php echo $edit_news ? htmlspecialchars($edit_news['text']) : ''; ?></textarea>
            <input type="date" name="news_date" class="date-input" value="<?php echo $edit_news ? htmlspecialchars($edit_news['date']) : date('Y-m-d'); ?>">
            <input type="file" name="news_images[]" multiple accept="image/*">
            <?php if ($edit_news && !empty($edit_news['images'])): ?>
                <div class="news-images">
                    <?php foreach ($edit_news['images'] as $img): ?>
                        <img src="<?php echo $upload_dir . $img; ?>" alt="Фото">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <button type="submit"><?php echo $edit_news ? 'Сохранить' : 'Добавить'; ?></button>
        </form>

        <!-- Список новостей -->
        <div class="news-list" style="margin-top:32px;">
            <h2>Все новости</h2>
            <table style="width:100%; border-collapse:collapse; font-size:15px;">
                <thead>
                    <tr style="background:#f4f6f1; color:#216c3d;">
                        <th style="padding:7px 4px; border-bottom:1px solid #e0e0e0;">#</th>
                        <th style="padding:7px 4px; border-bottom:1px solid #e0e0e0;">Заголовок</th>
                        <th style="padding:7px 4px; border-bottom:1px solid #e0e0e0;">Дата</th>
                        <th style="padding:7px 4px; border-bottom:1px solid #e0e0e0;">Фото</th>
                        <th style="padding:7px 4px; border-bottom:1px solid #e0e0e0;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($all_news as $i => $news): ?>
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:6px 4px; text-align:center; color:#888; width:32px;"><?php echo $i+1; ?></td>
                        <td style="padding:6px 4px; max-width:220px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                            <?php echo htmlspecialchars($news['title']); ?>
                        </td>
                        <td style="padding:6px 4px; color:#888; width:90px; text-align:center;">
                            <?php echo htmlspecialchars($news['date']); ?>
                        </td>
                        <td style="padding:6px 4px; width:90px; text-align:center;">
                            <?php if (!empty($news['images'][0])): ?>
                                <img src="<?php echo $upload_dir . $news['images'][0]; ?>" alt="Фото" style="max-width:60px; max-height:40px; border-radius:4px;">
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td style="padding:6px 4px; width:120px; text-align:center;">
                            <a href="?edit=<?php echo $i; ?>">✏️</a> |
                            <a href="?delete=<?php echo $i; ?>" onclick="return confirm('Удалить новость?');">🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .login-panel { max-width: 350px; margin: 80px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 32px; }
        h2 { color: #216c3d; }
        input { width: 100%; margin-bottom: 12px; padding: 8px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #216c3d; color: #fff; border: none; padding: 10px 24px; border-radius: 6px; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
<div class="login-panel">
    <h2>Вход в админ-панель</h2>
    <?php if (!empty($error)) echo '<div class="error">'.$error.'</div>'; ?>
    <form method="post">
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</div>
</body>
</html>