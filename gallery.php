<?php
include_once 'includes/lang.php';
$page_title = t('page_title_gallery');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            <span class="section-tag"><?php echo t('nav_gallery'); ?></span>
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('gallery_title'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t('gallery_text'); ?></p>
        </div>
        
        <!-- Interactive Gallery Grid -->
        <section class="mt-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/hero1.jpg" alt="Поля института" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Общее</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Поля института</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/hero2.jpg" alt="Коллаж культур" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Культуры</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Разнообразие культур</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/hero3.jpg" alt="Пшеница и кукуруза" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Посевы</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Пшеница и кукуруза</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/wheet1.jpg" alt="Пшеничные поля" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Зерновые</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Селекционные питомники пшеницы</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/corn.jpg" alt="Кукурузные гибриды" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Кукуруза</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Гибридные посевы кукурузы</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/grape.png" alt="Плодоовощные культуры" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Садоводство</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Исследования плодоовощных культур</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/potato.png" alt="Почвоведение" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Картофель</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Сортоиспытания картофеля</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/hlopok.png" alt="Хлопковые поля" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Технические культуры</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Агрохимия и селекция хлопка</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card shadow-sm border-0 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="gallery-img-wrapper" style="overflow: hidden; height: 260px;">
                            <img src="assets/images/svekla.png" alt="Сахарная свекла" class="w-100 h-100 object-fit-cover transition-all" style="transition: transform 0.5s ease;">
                        </div>
                        <div class="p-3">
                            <span class="badge bg-emerald mb-2">Сахарная свекла</span>
                            <h4 class="h6 mb-0 text-dark fw-bold">Селекция сахарной свеклы на основе ЦМС</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.gallery-card {
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid rgba(12, 62, 33, 0.05);
}
.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(12, 62, 33, 0.08) !important;
}
.gallery-card:hover img {
    transform: scale(1.04);
}
</style>

<?php include 'includes/footer.php'; ?>