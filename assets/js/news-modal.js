// news-modal.js

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('news-modal');
    const overlay = document.getElementById('news-modal-overlay');
    const closeBtn = document.getElementById('news-modal-close');
    const gallery = document.getElementById('news-modal-gallery');
    const galleryPrev = document.getElementById('news-modal-gallery-prev');
    const galleryNext = document.getElementById('news-modal-gallery-next');
    let currentImages = [];
    let currentIndex = 0;

    function openModal(news) {
        // Set gallery images
        currentImages = news.images || [];
        currentIndex = 0;
        renderGallery();
        // Set text
        document.getElementById('news-modal-title').textContent = news.title;
        document.getElementById('news-modal-date').textContent = news.date;
        document.getElementById('news-modal-text').textContent = news.text;
        // Show modal (with animation)
        overlay.style.display = 'block';
        modal.style.display = 'flex';
        // small delay to allow CSS transitions
        setTimeout(() => {
            overlay.classList.add('active');
            modal.classList.add('active');
            // ensure modal content doesn't allow background scroll if desired
        }, 10);
    }

    function closeModal() {
        overlay.classList.remove('active');
        modal.classList.remove('active');
        // wait for CSS transition to finish before hiding from layout
        setTimeout(() => {
            overlay.style.display = 'none';
            modal.style.display = 'none';
        }, 250);
    }

    function renderGallery() {
        if (!gallery) return;
        gallery.innerHTML = '';
        if (currentImages.length > 0) {
            const img = document.createElement('img');
            img.src = currentImages[currentIndex];
            img.alt = 'Фото';
            gallery.appendChild(img);
        } else {
            gallery.innerHTML = '<div class="no-image">Нет фото</div>';
        }
        galleryPrev.style.display = currentImages.length > 1 ? 'block' : 'none';
        galleryNext.style.display = currentImages.length > 1 ? 'block' : 'none';
    }

    galleryPrev && galleryPrev.addEventListener('click', function () {
        if (currentImages.length > 1) {
            currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
            renderGallery();
        }
    });
    galleryNext && galleryNext.addEventListener('click', function () {
        if (currentImages.length > 1) {
            currentIndex = (currentIndex + 1) % currentImages.length;
            renderGallery();
        }
    });

    closeBtn && closeBtn.addEventListener('click', closeModal);
    // Clicking on overlay (backdrop) should close the modal
    overlay && overlay.addEventListener('click', closeModal);

    // Clicking on modal wrapper (outside content) should also close the modal
    modal && modal.addEventListener('click', function (e) {
        // If user clicks on modal background/wrapper, close
        closeModal();
    });

    // Stop propagation for clicks inside actual content areas so they DON'T close
    var modalContent = modal ? modal.querySelector('.news-modal-content') : null;
    var galleryWrap = modal ? modal.querySelector('.news-modal-gallery-wrap') : null;
    if (modalContent) {
        modalContent.addEventListener('click', function (e) { e.stopPropagation(); });
    }
    if (galleryWrap) {
        galleryWrap.addEventListener('click', function (e) { e.stopPropagation(); });
    }

    // Close on ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            // only close if modal is currently visible
            if (modal && modal.classList.contains('active')) {
                closeModal();
            }
        }
    });

    // Card click handler - make entire card clickable
    document.querySelectorAll('.news-card').forEach(function (card) {
        card.addEventListener('click', function (e) {
            // Don't open modal if clicking on a link inside the card
            if (e.target.tagName === 'A') return;
            
            const news = JSON.parse(card.dataset.news);
            // Fix image paths
            if (news.images && news.images.length) {
                news.images = news.images.map(function (img) {
                    return card.dataset.uploadDir + img;
                });
            }
            openModal(news);
        });
    });

    // Also keep the button click handler for compatibility
    document.querySelectorAll('.news-card .news-more').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const card = btn.closest('.news-card');
            const news = JSON.parse(card.dataset.news);
            // Fix image paths
            if (news.images && news.images.length) {
                news.images = news.images.map(function (img) {
                    return card.dataset.uploadDir + img;
                });
            }
            openModal(news);
        });
    });
});
