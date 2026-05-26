<?php
include_once 'includes/lang.php';
include_once 'includes/mailer.php';

$form_success = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name !== '' && $message !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // 1) сохраняем заявку в файл (для админки)
        $feedbackFile = __DIR__ . '/database/feedback.json';
        $feedback = [];
        if (is_file($feedbackFile)) {
            $raw = file_get_contents($feedbackFile);
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) $feedback = $decoded;
        }
        $feedback[] = [
            'created_at' => date('c'),
            'lang' => currentLang(),
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        file_put_contents($feedbackFile, json_encode($feedback, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        // 2) отправляем на почту института
        $to = t('contacts_email_value');
        $subject = t('feedback_email_subject', 'Website feedback');
        $body = '<h2>' . htmlspecialchars($subject) . '</h2>'
            . '<p><b>' . htmlspecialchars(t('contacts_name')) . ':</b> ' . htmlspecialchars($name) . '</p>'
            . '<p><b>Email:</b> ' . htmlspecialchars($email) . '</p>'
            . '<p><b>' . htmlspecialchars(t('contacts_message')) . ':</b><br>' . nl2br(htmlspecialchars($message)) . '</p>'
            . '<p style="color:#888;font-size:12px;">' . htmlspecialchars(date('Y-m-d H:i:s')) . '</p>';

        if (sendSiteMail($to, $subject, $body, $email)) {
            $form_success = true;
        } else {
            $form_error = true;
        }
    } else {
        $form_error = true;
    }
}

$page_title = t('page_title_contacts');
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
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
                            <a href="<?php echo t('contacts_address_link'); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-secondary hover-green" style="transition: color 0.3s;"><?php echo t('contacts_address_value'); ?></a>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('footer_contacts_title'); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📞</span>
                            <a href="tel:+996312417154" class="text-decoration-none text-secondary hover-green"><?php echo t('contacts_phone_value'); ?></a>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📠</span>
                            <span><?php echo t('contacts_fax_value'); ?></span>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">✉</span>
                            <a href="mailto:<?php echo t('contacts_email_value'); ?>" class="text-decoration-none text-secondary hover-green"><?php echo t('contacts_email_value'); ?></a>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div>
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_work_title'); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">⏰</span>
                            <span><?php echo t('contacts_workhours_value'); ?></span>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div>
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_social_title'); ?></h3>
                        <div class="d-flex gap-3">
                            <a href="https://www.facebook.com/KyrgyzNIIzemledel" target="_blank" rel="noopener noreferrer" class="icon-button d-flex align-items-center justify-content-center" aria-label="Facebook" style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary-color); color: white; text-decoration: none; transition: 0.3s; opacity: 0.9;">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="https://www.youtube.com/@KyrgyzResearchInstitute" target="_blank" rel="noopener noreferrer" class="icon-button d-flex align-items-center justify-content-center" aria-label="YouTube" style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary-color); color: white; text-decoration: none; transition: 0.3s; opacity: 0.9;">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.377.55a3.016 3.016 0 0 0-2.122 2.136C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.55 9.376.55 9.376.55s7.505 0 9.377-.55a3.016 3.016 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white h-100" style="border-radius: 20px;">
                    <h3 class="h4 mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t('contacts_form_title'); ?></h3>
                    <?php if ($form_success): ?>
                        <div class="alert alert-success"><?php echo t('contacts_form_success'); ?></div>
                    <?php elseif ($form_error): ?>
                        <div class="alert alert-danger"><?php echo t('contacts_form_error'); ?></div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-4">
                            <label for="name" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_name'); ?></label>
                            <input class="form-control px-4 py-3" type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_email_label'); ?></label>
                            <input class="form-control px-4 py-3" type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-secondary fw-semibold mb-2"><?php echo t('contacts_message'); ?></label>
                            <textarea class="form-control px-4 py-3" id="message" name="message" rows="5" required style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc; resize: none;"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
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
.icon-button:hover {
    background-color: var(--accent-color) !important;
    transform: scale(1.1);
}
a[href^="https://maps"],
a[href^="https://www.facebook"],
a[href^="https://www.youtube"] {
    color: var(--primary-color);
    transition: all 0.3s ease;
}
a[href^="https://maps"]:hover,
a[href^="https://www.facebook"]:hover,
a[href^="https://www.youtube"]:hover {
    color: var(--accent-color);
    opacity: 0.8;
}
</style>

<?php include 'includes/footer.php'; ?>
