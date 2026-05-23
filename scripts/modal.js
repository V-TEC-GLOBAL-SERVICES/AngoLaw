/* ================================================
   modal.js — Modal System
   ================================================ */

(function () {
  'use strict';

  /* ── Open / Close ── */
  function openModal(modalId) {
    const overlay = document.getElementById(modalId);
    if (!overlay) return;
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    const overlay = document.getElementById(modalId);
    if (!overlay) return;
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  function closeAllModals() {
    document.querySelectorAll('.modal-overlay.active').forEach(m => {
      m.classList.remove('active');
    });
    document.body.style.overflow = '';
  }

  /* ── Wire trigger buttons ── */
  document.addEventListener('click', function (e) {
    // Open via data-modal-open="modalId"
    const openBtn = e.target.closest('[data-modal-open]');
    if (openBtn) {
      openModal(openBtn.dataset.modalOpen);
      return;
    }

    // Close via data-modal-close or .modal-overlay click
    const closeBtn = e.target.closest('[data-modal-close]');
    if (closeBtn) {
      const overlay = closeBtn.closest('.modal-overlay');
      if (overlay) closeModal(overlay.id);
      return;
    }

    // Click outside modal box
    if (e.target.classList.contains('modal-overlay')) {
      closeModal(e.target.id);
    }
  });

  // Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeAllModals();
  });

  /* ── Expose globally ── */
  window.JurisModal = { open: openModal, close: closeModal, closeAll: closeAllModals };

})();
