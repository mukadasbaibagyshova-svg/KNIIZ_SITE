<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - КНИИЗ' : 'КНИИЗ'; ?></title>
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/' ? '' : '../'; ?>assets/css/style.css">
</head>
<body>

<header>
    <div class="top-navbar">
        <div class="logo">
            КНИИЗ
        </div>

        <div class="right-panel">
            <input type="text" placeholder="Поиск" class="search-input">
            <select class="lang-select">
                <option value="ru">Рус</option>
                <option value="en">Eng</option>
            </select>
        </div>
    </div>

    <nav class="navigation">
        <a href="index.php" class="nav-link">Главная</a>
        <a href="history.php" class="nav-link">История</a>
        <a href="maps.php" class="nav-link">Карты</a>
        <a href="science.php" class="nav-link">Наука</a>
        <a href="products.php" class="nav-link">Продукция</a>
        <a href="news.php" class="nav-link">Новости</a>
        <a href="gallery.php" class="nav-link">Галерея</a>
        <a href="contacts.php" class="nav-link">Контакты</a>
    </nav>
</header>