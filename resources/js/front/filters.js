/* ══════════════════════════════════════════════════════════
   FILTERS.JS — CIFO Violeta Showcase
   Real-time project filtering via <select> dropdowns
   ══════════════════════════════════════════════════════════ */

const toolbar = document.querySelector('.filter-toolbar');
if (toolbar) initFilters(toolbar);

function initFilters(toolbar) {
    const selectYear = toolbar.querySelector('select[name="year"]');
    const selectCycle = toolbar.querySelector('select[name="cycle"]');
    const selectProf = toolbar.querySelector('select[name="professor"]');
    const countEl = toolbar.querySelector('.filter-count');
    const resetBtn = toolbar.querySelector('.filter-reset');
    const emptyState = document.querySelector('.projects-empty');

    function getCards() {
        return document.querySelectorAll('.card[data-course]');
    }

    function applyFilters() {
        const year = selectYear?.value || '';
        const cycle = selectCycle?.value || '';
        const professor = selectProf?.value || '';

        const cards = getCards();
        let visible = 0;

        cards.forEach(card => {
            const yearOk = !year || card.dataset.year === year;
            const cycleOk = !cycle || card.dataset.course === cycle;
            const profOk = !professor || card.dataset.professor === professor;
            const show = yearOk && cycleOk && profOk;

            card.classList.toggle('is-hidden', !show);
            if (show) visible++;
        });

        // Update count label
        if (countEl) {
            countEl.innerHTML = `<strong>${visible}</strong> de ${cards.length} proyectos`;
            countEl.setAttribute('aria-live', 'polite');
        }

        // Toggle active class on selects with non-default values
        [selectYear, selectCycle, selectProf].forEach(sel => {
            if (sel) sel.classList.toggle('is-active', sel.value !== '');
        });

        // Show reset button when any filter is active
        const anyActive = year || cycle || professor;
        if (resetBtn) resetBtn.classList.toggle('is-visible', Boolean(anyActive));

        // Show empty state when no results
        if (emptyState) emptyState.classList.toggle('is-visible', visible === 0);
    }

    function resetFilters() {
        [selectYear, selectCycle, selectProf].forEach(sel => {
            if (sel) sel.value = '';
        });
        applyFilters();
    }

    // Event listeners
    [selectYear, selectCycle, selectProf].forEach(sel => {
        if (sel) sel.addEventListener('change', applyFilters);
    });

    if (resetBtn) resetBtn.addEventListener('click', resetFilters);

    // Empty state reset button
    const emptyResetBtn = document.querySelector('#empty-reset-btn');
    if (emptyResetBtn) emptyResetBtn.addEventListener('click', resetFilters);

    // Init on load
    applyFilters();
}
