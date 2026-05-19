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
        // Show modal
        overlay.style.display = 'block';
        modal.style.display = 'flex';
        setTimeout(() => {
            overlay.classList.add('active');
            modal.classList.add('active');
        }, 10);
    }

    function closeModal() {
        overlay.classList.remove('active');
        modal.classList.remove('active');
        setTimeout(() => {
            overlay.style.display = 'none';
            modal.style.display = 'none';
        }, 200);
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
    overlay && overlay.addEventListener('click', closeModal);

    // Card click handler
    document.querySelectorAll('.news-card .news-more').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
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
