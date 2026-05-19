<?php
include_once 'includes/lang.php';
$page_title = t('page_title_structure');
include 'includes/header.php';

$departments = [

    [
        'id' => 'wheat',
        'title' => 'Отдел селекции пшеницы',
        'description' => 'Разработка конкурентоспособных сортов мягкой и твердой пшеницы и производство исходного семенного материала.',
        'image' => 'assets/images/wheet1.jpg'
    ],

    [
        'id' => 'barley',
        'title' => 'Отдел первичного ячменя',
        'description' => 'Селекция и первичное семеноводство ячменя, создание адаптивных сортов и обеспечение качественного семенного материала.',
        'image' => 'assets/images/wheet.png'
    ],

    [
        'id' => 'corn',
        'title' => 'Отдел кукурузы',
        'description' => 'Научные исследования в области кукурузы и гибридов.',
        'image' => 'assets/images/corn.jpg'
    ],

    [
        'id' => 'fruit',
        'title' => 'Плодоовощной отдел',
        'description' => 'Разработка технологий выращивания овощей и фруктов.',
        'image' => 'assets/images/grape.png'
    ],

    [
        'id' => 'soil',
        'title' => 'Отдел почвоведения',
        'description' => 'Изучение почвенных ресурсов и плодородия.',
        'image' => 'assets/images/potato.png'
    ],

    [
        'id' => 'agro',
        'title' => 'Отдел агрохимии',
        'description' => 'Анализ удобрений и агрохимических процессов.',
        'image' => 'assets/images/hlopok.png'
    ],

    [
        'id' => 'beet',
        'title' => 'Отдел сахарной свеклы',
        'description' => 'Селекция сахарной свеклы на основе CMS и первичное семеноводство для получения высококачественных гибридов.',
        'image' => 'assets/images/svekla.png'
    ],

    [
        'id' => 'issyk',
        'title' => 'Иссык-Кульский филиал',
        'description' => 'Научные исследования в Иссык-Кульском регионе.',
        'image' => 'assets/images/hlopoknapole.png'
    ]

];
?>

<main class="structure-page">

<section class="tree-section">

<div class="container">

<h1 class="section-title">Структура института</h1>

<div class="structure-tree">
    <div class="structure-root-card">
        <div class="structure-root-title">КНИИЗ</div>
        <p>Кыргызский научно-исследовательский институт земледелия имени К.К. Азыкова</p>
    </div>
    <div class="structure-branches">
        <div class="structure-branch-card">
            <strong>Отделы</strong>
            <span>Селекция, семеноводство, почвоведение, агрохимия и растениеводство</span>
        </div>
        <div class="structure-branch-card">
            <strong>Филиалы</strong>
            <span>Региональные опытные станции и опорные пункты</span>
        </div>
    </div>
</div>

<div class="departments-grid">

<?php foreach($departments as $department): ?>

<a 
href="structure-detail.php?item=<?php echo $department['id']; ?>&lang=<?php echo currentLang(); ?>" 
class="department-card"
>

<div 
class="department-image"
style="background-image: url('<?php echo $department['image']; ?>');"
>

<div class="image-overlay"></div>

<div class="department-title">
<?php echo $department['title']; ?>
</div>

</div>

<div class="department-content">

<p>
<?php echo $department['description']; ?>
</p>

<span class="department-button">
Подробнее →
</span>

</div>

</a>

<?php endforeach; ?>

</div>

</div>

</section>

</main>

<?php include 'includes/footer.php'; ?>