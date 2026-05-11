<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3><?php echo t('footer_about_title'); ?></h3>
            <p><?php echo t('footer_about_line1'); ?></p>
            <p><?php echo t('footer_about_line2'); ?></p>
        </div>
        <div class="footer-section">
            <h3><?php echo t('footer_contacts_title'); ?></h3>
            <p><?php echo t('contacts_address_text'); ?></p>
            <p><?php echo t('contacts_phone'); ?></p>
            <p><?php echo t('contacts_email'); ?></p>
        </div>
        <div class="footer-section">
            <h3><?php echo t('footer_menu_title'); ?></h3>
            <ul>
                <li><a href="index.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_home'); ?></a></li>
                <li><a href="history.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_history'); ?></a></li>
                <li><a href="maps.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_maps'); ?></a></li>
                <li><a href="science.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_science'); ?></a></li>
                <li><a href="products.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_products'); ?></a></li>
                <li><a href="news.php?lang=<?php echo currentLang(); ?>"><?php echo t('footer_menu_news'); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom"><?php echo t('footer_copyright'); ?></div>
</footer>
</body>
</html>
