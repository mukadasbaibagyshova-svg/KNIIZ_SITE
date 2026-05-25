// Accordion for departments
function toggleAccordion(header) {
    const card = header.closest('.department-accordion');
    const content = card.querySelector('.accordion-content');
    const toggle = header.querySelector('.accordion-toggle');
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
        card.classList.remove('open');
        toggle.textContent = '+';
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        card.classList.add('open');
        toggle.textContent = '–';
    }
}

// Accordion for branches
function toggleBranch(toggleBtn) {
    const card = toggleBtn.closest('.branch-card');
    const staff = card.querySelector('.branch-staff');
    if (staff.style.display === 'block') {
        staff.style.display = 'none';
        toggleBtn.querySelector('.toggle-icon').textContent = '▼';
        toggleBtn.querySelector('.toggle-text').textContent = 'Показать сотрудников';
    } else {
        staff.style.display = 'block';
        toggleBtn.querySelector('.toggle-icon').textContent = '▲';
        toggleBtn.querySelector('.toggle-text').textContent = 'Скрыть сотрудников';
    }
}

// Card hover effect
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.card-premium').forEach(card => {
    observer.observe(card);
});

// Search by employee name or position
const searchInput = document.getElementById('employeeSearch');
const searchResults = document.getElementById('searchResults');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        if (!query) {
            searchResults.style.display = 'none';
            searchResults.innerHTML = '';
            document.querySelectorAll('.employee-card').forEach(card => card.classList.remove('highlight'));
            return;
        }
        let found = 0;
        document.querySelectorAll('.employee-card').forEach(card => {
            const name = card.dataset.name;
            const position = card.dataset.position;
            if (name.includes(query) || position.includes(query)) {
                card.classList.add('highlight');
                found++;
            } else {
                card.classList.remove('highlight');
            }
        });
        if (found > 0) {
            searchResults.style.display = 'block';
            searchResults.innerHTML = 'Найдено сотрудников: ' + found;
        } else {
            searchResults.style.display = 'block';
            searchResults.innerHTML = 'Совпадений не найдено';
        }
    });
}
