<?php
include_once 'includes/lang.php';
$page_title = t('page_title_contacts');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            <span class="section-tag"><?php echo t('nav_contacts'); ?></span>
            <h1 class="section-title-premium text-dark mb-3"><?php echo t('contacts_title'); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t('contacts_text'); ?></p>
        </div>

        <div class="row g-5 mt-3">
            <!-- Contact Details -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white h-100" style="border-radius: 20px;">
                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_address_title'); ?></h3>
                        <p class="text-secondary d-flex align-items-start gap-2 mb-0">
                            <span class="fs-5">📍</span>
                            <span>Кыргызская Республика, г. Бишкек, ул. Тимура Фрунзе 100/1</span>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('footer_contacts_title'); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📞</span>
                            <span>0(312) 41 71 54</span>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📠</span>
                            <span>0(312) 41 79 08</span>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">✉</span>
                            <a href="mailto:nauca.zemledel@gmail.com" class="text-decoration-none text-secondary hover-green">nauca.zemledel@gmail.com</a>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div>
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_work_title'); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">⏰</span>
                            <span>Понедельник – Пятница: 9:00 – 18:00</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h4 mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_form_title'); ?></h3>
                    <form action="#" method="POST">
                        <div class="mb-4">
                            <label for="name" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_name'); ?></label>
                            <input class="form-control px-4 py-3" type="text" id="name" name="name" required style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_email_label'); ?></label>
                            <input class="form-control px-4 py-3" type="email" id="email" name="email" required style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_message'); ?></label>
                            <textarea class="form-control px-4 py-3" id="message" name="message" rows="5" required style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc; resize: none;"></textarea>
                        </div>
                        <button class="btn-premium btn-premium-accent w-100 py-3 mt-2" type="submit"><?php echo t('contacts_send'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.hover-green:hover {
    color: var(--accent-color) !important;
}
.form-control:focus {
    border-color: var(--accent-color) !important;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important;
}
</style>

<?php include 'includes/footer.php'; ?>