<?php
include_once 'includes/lang.php';
include 'includes/header.php';

// Массив данных участков (ключи должны совпадать с maps.php)
$plots = [
    'KGB' => [
        'title' => 'Баткенская область',
        'address' => 'г. Баткен, ул. Кызыл-Кия',
        'crops' => 'Хлопок',
        'extra' => 'Дополнительная информация: ...',
        'image' => 'images/plots/kgb.jpg'
    ],
    'KGGB' => [
        'title' => 'г. Бишкек',
        'address' => 'г. Бишкек',
        'crops' => '—',
        'extra' => '...',
        'image' => 'images/plots/kggb.jpg'
    ],
    'KGC' => [
        'title' => 'Чуйская область',
        'address' => 'г. Бишкек, ул. Примерная, 1',
        'crops' => 'Сахарная свекла, зерновые, овощи и др.',
        'extra' => 'Дополнительная информация: ...',
        'image' => 'images/plots/kgc.jpg'
    ],
    'KGY' => [
        'title' => 'Иссык-Кульская область',
        'address' => 'г. Каракол',
        'crops' => 'Овощи, зерновые',
        'extra' => 'Курортная зона',
        'image' => 'images/plots/kgy.jpg'
    ],
    'KGJ' => [
        'title' => 'Джалал-Абадская область',
        'address' => 'с. Тогуз-Торо',
        'crops' => 'Овощные культуры',
        'extra' => '...',
        'image' => 'images/plots/kgj.jpg'
    ],
    'KGN' => [
        'title' => 'Нарынская область',
        'address' => 'ул. Ленина, 209',
        'crops' => 'Семеноводство',
        'extra' => '...',
        'image' => 'images/plots/kgn.jpg'
    ],
    'KGO' => [
        'title' => 'Ошская область',
        'address' => 'с. Кара-Суу, ул. Большевик',
        'crops' => 'Зерновые культуры',
        'extra' => '...',
        'image' => 'images/plots/kgo.jpg'
    ],
    'KGGO' => [
        'title' => 'г. Ош',
        'address' => 'г. Ош',
        'crops' => '—',
        'extra' => 'Южная столица',
        'image' => 'images/plots/kgg.jpg'
    ],
    'KGT' => [
        'title' => 'Таласская область',
        'address' => 'г. Талас',
        'crops' => '...',
        'extra' => '...',
        'image' => 'images/plots/kgt.jpg'
    ]
];

$id = $_GET['id'] ?? '';
$plot = $plots[$id] ?? null;
?>
<main>
    <div class="container">
        <?php if ($plot): ?>
            <h2><?= htmlspecialchars($plot['title']) ?></h2>
            <img src="<?= htmlspecialchars($plot['image']) ?>" alt="<?= htmlspecialchars($plot['title']) ?>" style="max-width:400px; width:100%; border-radius:12px; margin-bottom:20px;">
            <p><strong>Адрес:</strong> <?= htmlspecialchars($plot['address']) ?></p>
            <p><strong>Основные культуры:</strong> <?= htmlspecialchars($plot['crops']) ?></p>
            <p><?= htmlspecialchars($plot['extra']) ?></p>
        <?php else: ?>
            <p>Участок не найден.</p>
        <?php endif; ?>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
