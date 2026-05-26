<?php
include_once "includes/lang.php";
include_once "includes/mailer.php";

$form_success = false;
$form_error = false;
$form_errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // Validation
    if ($name === "") {
        $form_errors[] = t("form_err_name", "Введите ваше имя");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_errors[] = t("form_err_email", "Введите корректный email");
    }
    if ($message === "") {
        $form_errors[] = t("form_err_message", "Введите сообщение");
    }

    if (empty($form_errors)) {
        // 1) Всегда сохраняем в JSON — это главное
        $feedbackFile = __DIR__ . "/database/feedback.json";
        $feedback = [];
        if (is_file($feedbackFile)) {
            $decoded = json_decode(file_get_contents($feedbackFile), true);
            if (is_array($decoded)) {
                $feedback = $decoded;
            }
        }
        $feedback[] = [
            "created_at" => date("c"),
            "lang" => currentLang(),
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "ip" => $_SERVER["REMOTE_ADDR"] ?? "",
            "read" => false,
        ];
        file_put_contents(
            $feedbackFile,
            json_encode($feedback, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
        );

        // 2) Пытаемся отправить email (не блокирует успех если mail не настроен)
        $to = t("contacts_email_value");
        $subject = t("feedback_email_subject", "Website feedback");
        $body =
            '
<div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">
  <div style="background:#1a5c30;color:#fff;padding:20px 24px;border-radius:8px 8px 0 0;">
    <h2 style="margin:0;font-size:20px;">📩 ' .
            htmlspecialchars($subject) .
            '</h2>
  </div>
  <div style="background:#fff;padding:24px;border:1px solid #e0ece4;border-radius:0 0 8px 8px;">
    <p><strong>👤 Имя:</strong> ' .
            htmlspecialchars($name) .
            '</p>
    <p><strong>✉️ Email:</strong> <a href="mailto:' .
            htmlspecialchars($email) .
            '">' .
            htmlspecialchars($email) .
            '</a></p>
    <p><strong>💬 Сообщение:</strong></p>
    <div style="background:#f5f9f5;padding:14px;border-radius:8px;border-left:4px solid #10b981;">' .
            nl2br(htmlspecialchars($message)) .
            '</div>
    <p style="color:#888;font-size:12px;margin-top:16px;">Отправлено: ' .
            htmlspecialchars(date("d.m.Y H:i")) .
            " | IP: " .
            htmlspecialchars($_SERVER["REMOTE_ADDR"] ?? "") .
            '</p>
  </div>
</div>';
        @sendSiteMail($to, $subject, $body, $email); // best-effort, не влияет на $form_success

        $form_success = true;
    } else {
        $form_error = true;
    }
}

$page_title = t("page_title_contacts");
$page_description = t("meta_desc_contacts");
$page_keywords = t("meta_keys_contacts");
include "includes/header.php";
?>

<main class="py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center">
            <h1 class="section-title-premium text-dark mb-3"><?php echo t(
                "contacts_title",
            ); ?></h1>
            <p class="section-subtitle-premium text-muted mx-auto" style="max-width: 760px;"><?php echo t(
                "contacts_text",
            ); ?></p>
        </div>

        <div class="row g-5 mt-3">
            <!-- Contact Details -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white h-100" style="border-radius: 20px;">
                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t(
                            "contacts_address_title",
                        ); ?></h3>
                        <p class="text-secondary d-flex align-items-start gap-2 mb-0">
                            <span class="fs-5">📍</span>
                            <a href="<?php echo t(
                                "contacts_address_link",
                            ); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-secondary hover-green" style="transition: color 0.3s;"><?php echo t(
    "contacts_address_value",
); ?></a>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t(
                            "footer_contacts_title",
                        ); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📞</span>
                            <a href="tel:+996312417154" class="text-decoration-none text-secondary hover-green"><?php echo t(
                                "contacts_phone_value",
                            ); ?></a>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">📠</span>
                            <span><?php echo t("contacts_fax_value"); ?></span>
                        </p>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">✉</span>
                            <a href="mailto:<?php echo t(
                                "contacts_email_value",
                            ); ?>" class="text-decoration-none text-secondary hover-green"><?php echo t(
    "contacts_email_value",
); ?></a>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div>
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t(
                            "contacts_work_title",
                        ); ?></h3>
                        <p class="text-secondary d-flex align-items-center gap-2 mb-2">
                            <span class="fs-5">⏰</span>
                            <span><?php echo t(
                                "contacts_workhours_value",
                            ); ?></span>
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(12, 62, 33, 0.08);">

                    <div>
                        <h3 class="h5 mb-3" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t(
                            "contacts_social_title",
                        ); ?></h3>
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
                    <h3 class="h4 mb-4" style="font-family: var(--font-headings); font-weight: 700; color: var(--primary-color);"><?php echo t(
                        "contacts_form_title",
                    ); ?></h3>
                    <form action="" method="POST" id="contactForm">
                        <div class="mb-4">
                            <label for="name" class="form-label text-secondary fw-semibold mb-2"><?php echo t(
                                "contacts_name",
                            ); ?></label>
                            <input class="form-control px-4 py-3" type="text" id="name" name="name" required value="<?php echo htmlspecialchars(
                                $_POST["name"] ?? "",
                            ); ?>" style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label text-secondary fw-semibold mb-2"><?php echo t(
                                "contacts_email_label",
                            ); ?></label>
                            <input class="form-control px-4 py-3" type="email" id="email" name="email" required value="<?php echo htmlspecialchars(
                                $_POST["email"] ?? "",
                            ); ?>" style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc;">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-secondary fw-semibold mb-2"><?php echo t(
                                "contacts_message",
                            ); ?></label>
                            <textarea class="form-control px-4 py-3" id="message" name="message" rows="5" required style="border-radius: 12px; border: 1px solid rgba(12, 62, 33, 0.12); background-color: #fafbfc; resize: none;"><?php echo htmlspecialchars(
                                $_POST["message"] ?? "",
                            ); ?></textarea>
                        </div>
                        <button class="btn-premium btn-premium-accent w-100 py-3 mt-2" type="submit"><?php echo t(
                            "contacts_send",
                        ); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Toast notification -->
<div id="site-toast" class="site-toast" role="alert" aria-live="polite" aria-atomic="true">
    <div class="site-toast-inner" id="site-toast-inner">
        <div class="site-toast-icon" id="site-toast-icon"></div>
        <div class="site-toast-body">
            <div class="site-toast-title" id="site-toast-title"></div>
            <div class="site-toast-msg"   id="site-toast-msg"></div>
        </div>
        <button class="site-toast-close" onclick="hideSiteToast()" aria-label="Close">&times;</button>
    </div>
</div>

<style>
/* ── Site Toast ───────────────────────────────────── */
.site-toast {
    position: fixed;
    top: 28px;
    left: 50%;
    transform: translateX(-50%) translateY(-120px);
    z-index: 9999;
    min-width: 320px;
    max-width: 480px;
    width: 90vw;
    transition: transform .45s cubic-bezier(.16,1,.3,1), opacity .45s ease;
    opacity: 0;
    pointer-events: none;
}
.site-toast.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
    pointer-events: auto;
}
.site-toast-inner {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 18px 20px;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0,0,0,.18);
    backdrop-filter: blur(12px);
    font-family: var(--font-body, 'Inter', sans-serif);
}
.site-toast-inner.success {
    background: linear-gradient(135deg, #0c3e21 0%, #1a6637 100%);
    border: 1px solid rgba(16,185,129,.35);
    color: #fff;
}
.site-toast-inner.error {
    background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
    border: 1px solid rgba(239,68,68,.35);
    color: #fff;
}
.site-toast-icon {
    font-size: 26px;
    line-height: 1;
    flex-shrink: 0;
    margin-top: 2px;
}
.site-toast-body { flex: 1; }
.site-toast-title {
    font-weight: 700;
    font-size: 15px;
    margin-bottom: 3px;
    font-family: var(--font-headings, 'Outfit', sans-serif);
}
.site-toast-msg {
    font-size: 13.5px;
    opacity: .88;
    line-height: 1.4;
}
.site-toast-close {
    background: rgba(255,255,255,.18);
    border: none;
    color: #fff;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}
.site-toast-close:hover { background: rgba(255,255,255,.3); }
/* ── inline validation errors ─────────────────────── */
.field-error {
    color: #dc2626;
    font-size: 12.5px;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.input-invalid {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220,38,38,.1) !important;
}
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

<script>
// ── Toast helpers ────────────────────────────────────────
var _toastTimer = null;
function showSiteToast(type, title, msg) {
    var t  = document.getElementById('site-toast');
    var ti = document.getElementById('site-toast-inner');
    var ic = document.getElementById('site-toast-icon');
    var tl = document.getElementById('site-toast-title');
    var tm = document.getElementById('site-toast-msg');
    ti.className = 'site-toast-inner ' + (type === 'success' ? 'success' : 'error');
    ic.textContent = type === 'success' ? '✅' : '❌';
    tl.textContent = title;
    tm.innerHTML = msg;
    t.classList.add('show');
    clearTimeout(_toastTimer);
    _toastTimer = setTimeout(hideSiteToast, 6000);
}
function hideSiteToast() {
    document.getElementById('site-toast').classList.remove('show');
}

// ── Show toast on page load based on PHP result ──────
<?php if ($form_success): ?>
document.addEventListener('DOMContentLoaded', function() {
    showSiteToast(
        'success',
        '<?php echo addslashes(
            t("contacts_form_success_title", "Сообщение отправлено!"),
        ); ?>',
        '<?php echo addslashes(
            t(
                "contacts_form_success",
                "Ваше сообщение получено. Мы свяжемся с вами в ближайшее время.",
            ),
        ); ?>'
    );
    // Сбрасываем форму чтобы не отправили повторно
    var f = document.getElementById('contactForm');
    if (f) f.reset();
});
<?php elseif (!empty($form_errors)): ?>
document.addEventListener('DOMContentLoaded', function() {
    var errors = <?php echo json_encode(
        $form_errors,
        JSON_UNESCAPED_UNICODE,
    ); ?>;
    showSiteToast('error', '<?php echo addslashes(
        t("contacts_form_validation_title", "Проверьте форму"),
    ); ?>', errors.join('<br>'));
});
<?php endif; ?>

// ── Client-side form validation + loading state ──────
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('contactForm');
    if (!form) return;

    var btn = form.querySelector('button[type="submit"]');
    var origBtnText = btn ? btn.innerHTML : '';

    form.addEventListener('submit', function(e) {
        var valid = true;
        // Clear previous errors
        form.querySelectorAll('.field-error').forEach(function(el){ el.remove(); });
        form.querySelectorAll('.input-invalid').forEach(function(el){ el.classList.remove('input-invalid'); });

        var nameInput = form.querySelector('#name');
        var emailInput = form.querySelector('#email');
        var msgInput = form.querySelector('#message');

        if (nameInput && nameInput.value.trim() === '') {
            addFieldError(nameInput, '<?php echo addslashes(
                t("form_err_name", "Введите ваше имя"),
            ); ?>');
            valid = false;
        }
        if (emailInput && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
            addFieldError(emailInput, '<?php echo addslashes(
                t("form_err_email", "Введите корректный email"),
            ); ?>');
            valid = false;
        }
        if (msgInput && msgInput.value.trim() === '') {
            addFieldError(msgInput, '<?php echo addslashes(
                t("form_err_message", "Введите сообщение"),
            ); ?>');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return;
        }

        // Loading state
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<span style="display:inline-flex;align-items:center;gap:8px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spin 1s linear infinite;"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg> <?php echo addslashes(
                t("contacts_send", "Отправляем..."),
            ); ?></span>';
        }
    });

    function addFieldError(input, msg) {
        input.classList.add('input-invalid');
        var div = document.createElement('div');
        div.className = 'field-error';
        div.innerHTML = '⚠️ ' + msg;
        input.parentNode.appendChild(div);
    }
});
</script>
<style>@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}</style>
<?php include "includes/footer.php"; ?>
