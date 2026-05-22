/* ================================================
   main.js — Global Functionality
   ================================================ */

(function () {
  'use strict';

  /* ── Sidebar Toggle ── */
  const sidebar  = document.querySelector('.sidebar');
  const overlay  = document.querySelector('.sidebar-overlay');
  const toggleBtns = document.querySelectorAll('[data-sidebar-toggle]');

  function isMobile() { return window.innerWidth <= 900; }

  function openSidebar() {
    sidebar.classList.add('sidebar--mobile-open');
    overlay && overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    sidebar.classList.remove('sidebar--mobile-open');
    overlay && overlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  function toggleDesktop() {
    sidebar.classList.toggle('sidebar--collapsed');
    localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('sidebar--collapsed'));
  }

  // Restore desktop collapsed state
  if (!isMobile() && localStorage.getItem('sidebar-collapsed') === 'true') {
    sidebar && sidebar.classList.add('sidebar--collapsed');
  }

  toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (isMobile()) {
        sidebar.classList.contains('sidebar--mobile-open') ? closeSidebar() : openSidebar();
      } else {
        toggleDesktop();
      }
    });
  });

  overlay && overlay.addEventListener('click', closeSidebar);

  window.addEventListener('resize', () => {
    if (!isMobile()) { closeSidebar(); }
  });

  /* ── Mark active nav item ── */
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.sidebar__menu-link').forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href === currentPage || (currentPage === 'index.html' && href === 'index.html')) {
      link.closest('.sidebar__menu-item')?.classList.add('sidebar__menu-item--active');
    }
  });

})();
