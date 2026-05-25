<footer class="site-footer text-white py-5">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Column 1: Brand & Contacts -->
            <div class="col-lg-4">
                <h3 class="mb-3 fw-bold" style="color: var(--accent-color); font-family: var(--font-headings);"><?php echo t('logo'); ?></h3>
                <p class="mb-4" style="font-size: 14px; opacity: 0.8; line-height: 1.6;"><?php echo t('footer_about_line1'); ?></p>
                
                <div style="font-size: 14.5px; opacity: 0.9; line-height: 1.7;" class="mb-4">
                    <p class="mb-2"><strong>📍 Адрес:</strong> <a href="https://2gis.kg/bishkek/firm/70000001021237453" target="_blank" rel="noopener noreferrer" class="footer-address-link">Кыргызская Республика, г. Бишкек, ул. Тимура Фрунзе 100/1</a></p>
                    <p class="mb-2"><strong>📞 Тел:</strong> 0(312) 41 71 54</p>
                    <p class="mb-2"><strong>📠 Факс:</strong> 0(312) 41 79 08</p>
                    <p class="mb-2"><strong>✉️ Email:</strong> <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nauca.zemledel%40gmail.com" target="_blank" rel="noopener noreferrer" class="footer-address-link">nauca.zemledel@gmail.com</a></p>
                    <p class="mb-0"><strong>🕒 График работы:</strong> Понедельник – Пятница: 9:00 – 18:00</p>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/KyrgyzNIIzemledel" target="_blank" rel="noopener noreferrer" class="icon-button d-flex align-items-center justify-content-center" aria-label="Facebook" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; text-decoration: none; transition: 0.3s;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@KyrgyzResearchInstitute" target="_blank" rel="noopener noreferrer" class="icon-button d-flex align-items-center justify-content-center" aria-label="YouTube" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; text-decoration: none; transition: 0.3s;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.377.55a3.016 3.016 0 0 0-2.122 2.136C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.55 9.376.55 9.376.55s7.505 0 9.377-.55a3.016 3.016 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    
                </div>
            </div>
            
            <!-- Column 2: 2GIS Widget Map -->
            <div class="col-lg-8">
                <style>
                    .dg-widget-container iframe {
                        width: 100% !important;
                        height: 350px !important;
                        border-radius: 12px;
                    }
                </style>
                <div class="p-2 bg-white shadow-lg" style="border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                    <div class="w-100 dg-widget-container" style="height: 350px; border-radius: 12px; overflow: hidden;">
                        <iframe frameborder="no" style="border: 1px solid #e2ebdc; box-sizing: border-box; width: 100%; height: 350px; border-radius: 12px;" src="https://widgets.2gis.com/widget?type=firmsonmap&options=%7B%22pos%22%3A%7B%22lat%22%3A42.85399265864424%2C%22lon%22%3A74.53481197357179%2C%22zoom%22%3A16%7D%2C%22opt%22%3A%7B%22city%22%3A%22bishkek%22%7D%2C%22org%22%3A%2270000001021237453%22%7D"></iframe>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom text-center pt-4 mt-5 border-top border-white-10" style="opacity: 0.6; font-size: 13px;">
            <?php echo t('footer_copyright'); ?>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
