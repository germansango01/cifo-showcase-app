/**
 * resources/js/front/projects-filter.js
 *
 * Client-side filter for the projects grid.
 * NOTE: In production the filters are submitted as GET params to the
 * Laravel controller (server-side), so this is a progressive enhancement
 * for instant feedback on year/cycle/professor selects.
 */

const filterYear      = document.getElementById('filter-year');
const filterCycle     = document.getElementById('filter-cycle');
const filterProfessor = document.getElementById('filter-professor');
const resetBtn        = document.querySelector('.filter-reset');
const countEl         = document.querySelector('.filter-count');
const grid            = document.querySelector('.projects-grid');

if (!grid) return;

function applyFilters() {
    const year      = filterYear?.value ?? '';
    const cycle     = filterCycle?.value?.toUpperCase() ?? '';
    const professor = filterProfessor?.value ?? '';

    const items = grid.querySelectorAll('.grid-item');
    let visible = 0;

    items.forEach((item) => {
        const matchYear      = !year      || item.dataset.year      === year;
        const matchCycle     = !cycle     || item.dataset.course     === cycle;
        const matchProfessor = !professor || item.dataset.professor  === professor;
        const show           = matchYear && matchCycle && matchProfessor;

        item.hidden = !show;
        if (show) visible++;
    });

    if (countEl) {
        countEl.innerHTML = `<strong>${visible}</strong> de ${items.length} proyectos`;
    }
}

filterYear?.addEventListener('change', applyFilters);
filterCycle?.addEventListener('change', applyFilters);
filterProfessor?.addEventListener('change', applyFilters);

resetBtn?.addEventListener('click', () => {
    if (filterYear)      filterYear.value      = '';
    if (filterCycle)     filterCycle.value     = '';
    if (filterProfessor) filterProfessor.value = '';
    applyFilters();
});
