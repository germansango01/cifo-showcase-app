/**
 * Project detail page module.
 * Reads ?id= from the URL, finds the matching project in projectsData,
 * populates all detail page elements and sets up carousel + lazy loading.
 */

import { projectsData } from './data.js';
import { initCarousel } from './carousel.js';
import { initLazyLoad } from './lazy-load.js';

// ── Badge class map (mirrors modal.js) ────────────────
const BADGE_CYCLE_MAP = {
    DAW: 'daw',
    DAM: 'dam',
    ASIR: 'asir',
    SMX: 'smx',
};

// ── DOM refs (ES modules are deferred — DOM is ready) ─
const elBreadcrumbName = document.getElementById('detail-breadcrumb-name');
const elHeroImg = document.getElementById('detail-hero-img');
const elBadges = document.getElementById('detail-badges');
const elTitle = document.getElementById('detail-title');
const elDescription = document.getElementById('detail-description');
const elMeta = document.getElementById('detail-meta');
const elTechnologies = document.getElementById('detail-technologies');
const elTags = document.getElementById('detail-tags');
const elNavPrev = document.getElementById('detail-nav-prev');
const elNavPrevTitle = document.getElementById('detail-nav-prev-title');
const elNavNext = document.getElementById('detail-nav-next');
const elNavNextTitle = document.getElementById('detail-nav-next-title');

// ── Populate ──────────────────────────────────────────

function populatePage(project) {
    document.title = `${project.title} — CIFO Violeta Showcase`;
    document.querySelector('meta[name="description"]').content =
        project.descriptionLong.slice(0, 155);

    const ogTitle = document.querySelector('meta[property="og:title"]');
    const ogDesc = document.querySelector('meta[property="og:description"]');
    const ogImage = document.querySelector('meta[property="og:image"]');
    if (ogTitle) ogTitle.content = `${project.title} — CIFO Violeta Showcase`;
    if (ogDesc) ogDesc.content = project.descriptionLong.slice(0, 200);
    if (ogImage && project.imagesGallery[0]) ogImage.content = project.imagesGallery[0];

    elBreadcrumbName.textContent = project.title;

    elHeroImg.dataset.src = project.imagesGallery[0];
    elHeroImg.alt = `Imagen principal de ${project.title}`;

    const cycleSlug = BADGE_CYCLE_MAP[project.courseCode] ?? 'daw';
    elBadges.innerHTML = `
    <span class="badge" data-cycle="${cycleSlug}">${project.courseCode}</span>
    <span class="badge" data-type="year">${project.year}</span>
  `;

    elTitle.textContent = project.title;
    elDescription.textContent = project.descriptionLong;

    elMeta.innerHTML = [
        ['Alumno/a', project.student],
        ['Ciclo', project.course],
        ['Profesor/a', project.professor],
        ['Año', project.year],
    ]
        .map(
            ([term, value]) => `
    <div class="project-detail-meta-item">
      <dt>${term}</dt>
      <dd>${value}</dd>
    </div>`
        )
        .join('');

    elTechnologies.innerHTML = project.technologies
        .map((t) => `<li><span class="badge" data-type="tech">${t}</span></li>`)
        .join('');

    elTags.innerHTML = project.tags
        .map((tag) => `<span class="modal-tag">#${tag}</span>`)
        .join('');
}

// ── Navigation ────────────────────────────────────────

function populateNavigation(currentIndex) {
    const prev = projectsData[currentIndex - 1] ?? null;
    const next = projectsData[currentIndex + 1] ?? null;

    if (prev) {
        elNavPrev.href = `project-detail.html?id=${prev.id}`;
        elNavPrevTitle.textContent = prev.title;
    } else {
        elNavPrev.setAttribute('aria-disabled', 'true');
        elNavPrev.setAttribute('tabindex', '-1');
        elNavPrev.href = '#';
        elNavPrev.addEventListener('click', (e) => e.preventDefault());
    }

    if (next) {
        elNavNext.href = `project-detail.html?id=${next.id}`;
        elNavNextTitle.textContent = next.title;
    } else {
        elNavNext.setAttribute('aria-disabled', 'true');
        elNavNext.setAttribute('tabindex', '-1');
        elNavNext.href = '#';
        elNavNext.addEventListener('click', (e) => e.preventDefault());
    }
}

// ── Main ──────────────────────────────────────────────

const id = new URLSearchParams(window.location.search).get('id');

if (!id) {
    window.location.replace('index.html');
} else {
    const currentIndex = projectsData.findIndex((p) => p.id === id);

    if (currentIndex === -1) {
        window.location.replace('index.html');
    } else {
        const project = projectsData[currentIndex];
        populatePage(project);
        populateNavigation(currentIndex);
        initCarousel(project.imagesGallery);
        initLazyLoad();
    }
}
