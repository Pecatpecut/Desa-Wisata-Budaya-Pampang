// ============================================
//  NAVBAR
// ============================================
document.addEventListener('DOMContentLoaded', function () {
  const links       = document.querySelectorAll('.nav-link');
  const mobileLinks = document.querySelectorAll('.mobile-menu a');
  function normalizePath(p) {
    return p.replace(/^\/desa_wisata_budaya_pampang/, '') || '/';
  }

  const rawPath = window.location.pathname;
  const path    = normalizePath(rawPath);

  let activeLink = null;

  links.forEach(link => {
    const href = normalizePath(new URL(link.href).pathname);
    const isActive = href === path || (href !== '/' && path.startsWith(href));
    if (isActive) {
      link.classList.add('active');
      activeLink = link;
    }
  });
  mobileLinks.forEach(link => {
    const href = normalizePath(new URL(link.href).pathname);
    const isActive = href === path || (href !== '/' && path.startsWith(href));
    if (isActive) link.classList.add('active');
  });
  function positionIndicator(el) {
    const indicator = document.querySelector('.nav-indicator');
    const menu      = document.querySelector('.menu');
    if (!indicator || !menu || !el) return;

    indicator.style.width     = el.offsetWidth + 'px';
    indicator.style.transform = `translateX(${el.offsetLeft}px)`;
  }
  if (activeLink) {
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        positionIndicator(activeLink);
      });
    });
  }
  const hamburger  = document.querySelector('.hamburger');
  const mobileMenu = document.querySelector('.mobile-menu');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      hamburger.querySelectorAll('span').forEach(s => s.classList.toggle('active'));
      mobileMenu.classList.toggle('open');
    });

    mobileMenu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        hamburger.querySelectorAll('span').forEach(s => s.classList.remove('active'));
        mobileMenu.classList.remove('open');
      });
    });
  }

  // ============================================
  //  SCROLL REVEAL
  // ============================================
  const reveals = document.querySelectorAll('.reveal');
  if (reveals.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    reveals.forEach(el => observer.observe(el));
  }

  // ============================================
  //  AUDIO PLAYER
  // ============================================
  let audio     = null;
  let isPlaying = false;
  const audioBtn = document.getElementById('audio-btn');

  if (audioBtn) {
    audioBtn.addEventListener('click', () => {
      if (!audio) {
        audio = new Audio(BASE_URL + '/public/assets/audio/dayak.mp3');
        audio.loop   = true;
        audio.volume = 0.3;
      }

      if (isPlaying) {
        audio.pause();
        audioBtn.classList.remove('bi-pause-circle-fill', 'active');
        audioBtn.classList.add('bi-headphones');
      } else {
        audio.currentTime = 0;
        audio.play().catch(() => {});
        audioBtn.classList.remove('bi-headphones');
        audioBtn.classList.add('bi-pause-circle-fill', 'active');
      }

      isPlaying = !isPlaying;
    });
  }

  // ============================================
  //  PARALLAX HERO SECTION
  // ============================================
  const parallaxSections = document.querySelectorAll('[data-parallax]');
  if (parallaxSections.length) {
    window.addEventListener('scroll', () => {
      parallaxSections.forEach(section => {
        const rect   = section.getBoundingClientRect();
        const offset = rect.top * 0.2;
        section.style.backgroundPosition = `center calc(50% + ${offset}px)`;
      });
    });
  }

  // ============================================
  //  3D TILT
  // ============================================
  document.querySelectorAll('[data-tilt]').forEach(wrapper => {
    const img = wrapper.querySelector('img');
    if (!img) return;
    wrapper.addEventListener('mousemove', e => {
      const { offsetWidth: w, offsetHeight: h } = wrapper;
      const rx = ((e.offsetY / h) - 0.5) * 10;
      const ry = ((e.offsetX / w) - 0.5) * -10;
      img.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) scale(1.05)`;
    });
    wrapper.addEventListener('mouseleave', () => {
      img.style.transform = 'rotateX(0) rotateY(0) scale(1)';
    });
  });

  // ============================================
  //  WISATA CARDS
  // ============================================
  const wisataCards = document.querySelectorAll('.wisata-card');
  if (wisataCards.length) {
    const cardObs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
          cardObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    wisataCards.forEach(card => cardObs.observe(card));
  }

  // ============================================
  //  TOAST HELPER
  // ============================================
  ['toast-success', 'toast-error'].forEach(id => {
    const toast = document.getElementById(id);
    if (toast) {
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 400);
      }, 3000);
    }
  });

  // ============================================
  //  CONFIRM DELETE MODAL
  // ============================================
  const confirmModal  = document.getElementById('confirm-modal');
  let   pendingForm   = null;

  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      const form = document.getElementById(this.dataset.form);
      if (!form) return;
      pendingForm = form;
      if (confirmModal) {
        const msg = document.getElementById('confirm-msg');
        if (msg) msg.textContent = this.dataset.confirm || 'Yakin ingin menghapus?';
        confirmModal.style.display = 'flex';
      } else {
        if (confirm(this.dataset.confirm || 'Yakin ingin menghapus?')) form.submit();
      }
    });
  });

  if (confirmModal) {
    document.getElementById('confirm-ok')?.addEventListener('click', () => {
      confirmModal.style.display = 'none';
      if (pendingForm) { pendingForm.submit(); pendingForm = null; }
    });
    document.getElementById('confirm-cancel')?.addEventListener('click', () => {
      confirmModal.style.display = 'none'; pendingForm = null;
    });
    confirmModal.addEventListener('click', e => {
      if (e.target === confirmModal) { confirmModal.style.display = 'none'; pendingForm = null; }
    });
  }

});
