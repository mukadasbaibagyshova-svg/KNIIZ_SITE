<?php
include_once 'includes/lang.php';
$page_title = t('page_title_contacts');
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2 class="section-title"><?php echo t('contacts_title'); ?></h2>
        <p class="section-text"><?php echo t('contacts_text'); ?></p>

        <div class="page-grid page-grid-2">
            <div>
                <h3><?php echo t('contacts_address_title'); ?></h3>
                <p><?php echo t('contacts_address_text'); ?></p>

                <h3 style="margin-top: 28px;"><?php echo t('footer_contacts_title'); ?></h3>
                <p><?php echo t('contacts_phone'); ?></p>
                <p><?php echo t('contacts_fax'); ?></p>
                <p><?php echo t('contacts_email'); ?></p>
                <p><?php echo t('contacts_website'); ?></p>

                <h3 style="margin-top: 28px;"><?php echo t('contacts_work_title'); ?></h3>
                <p><?php echo t('contacts_work_week'); ?></p>
                <p><?php echo t('contacts_work_weekend'); ?></p>
            </div>

            <div>
                <h3><?php echo t('contacts_form_title'); ?></h3>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="name"><?php echo t('contacts_name'); ?></label>
                        <input class="input-field" type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo t('contacts_email_label'); ?></label>
                        <input class="input-field" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message"><?php echo t('contacts_message'); ?></label>
                        <textarea class="textarea-field" id="message" name="message" required></textarea>
                    </div>
                    <button class="btn-primary" type="submit"><?php echo t('contacts_send'); ?></button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>