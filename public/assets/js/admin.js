// ============================================
//  SIDEBAR TOGGLE (mobile)
// ============================================
window.toggleSidebar = function() {
  const sidebar  = document.getElementById('sidebar');
  const backdrop = document.getElementById('sidebar-backdrop');
  if (!sidebar || !backdrop) return;
  sidebar.classList.toggle('open');
  backdrop.classList.toggle('show');
};
window.closeSidebar = function() {
  const sidebar  = document.getElementById('sidebar');
  const backdrop = document.getElementById('sidebar-backdrop');
  if (!sidebar || !backdrop) return;
  sidebar.classList.remove('open');
  backdrop.classList.remove('show');
};

document.addEventListener('DOMContentLoaded', function() {

  // Close sidebar on nav link click (mobile)
  document.querySelectorAll('.sidebar-link').forEach(link => {
    link.addEventListener('click', closeSidebar);
  });

  // ============================================
  //  CONFIRM MODAL
  // ============================================
  window.showConfirm = function(msg, onOk) {
    const overlay = document.getElementById('confirm-modal');
    if (!overlay) { if (onOk) onOk(); return; }
    document.getElementById('confirm-msg').textContent = msg;
    overlay.style.display = 'flex';

    const okBtn     = document.getElementById('confirm-ok');
    const cancelBtn = document.getElementById('confirm-cancel');

    const newOk = okBtn.cloneNode(true);
    okBtn.parentNode.replaceChild(newOk, okBtn);
    const newCancel = cancelBtn.cloneNode(true);
    cancelBtn.parentNode.replaceChild(newCancel, cancelBtn);

    newOk.onclick     = () => { overlay.style.display = 'none'; if (onOk) onOk(); };
    newCancel.onclick = () => { overlay.style.display = 'none'; };
    overlay.onclick   = (e) => { if (e.target === overlay) overlay.style.display = 'none'; };
  };

  // ============================================
  //  FILE DROP
  // ============================================
  document.querySelectorAll('.file-drop').forEach(drop => {
    const input = document.getElementById(drop.dataset.input);
    if (!input) return;

    drop.addEventListener('click', () => input.click());
    drop.addEventListener('dragover', e => { e.preventDefault(); drop.style.borderColor = '#c0392b'; });
    drop.addEventListener('dragleave', () => { drop.style.borderColor = ''; });
    drop.addEventListener('drop', e => {
      e.preventDefault();
      drop.style.borderColor = '';
      const file = e.dataTransfer.files[0];
      if (file) setFilePreview(drop, file, input);
    });

    input.addEventListener('change', () => {
      if (input.files[0]) setFilePreview(drop, input.files[0], input);
    });
  });

  function setFilePreview(drop, file, input) {
    const reader = new FileReader();
    reader.onload = e => {
      drop.innerHTML = `
        <img src="${e.target.result}" class="file-preview" />
        <span style="font-size:12px;color:#555">${file.name}</span>
      `;
    };
    reader.readAsDataURL(file);
    const dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
  }

  // ============================================
  //  TAB SWITCH (file/url)
  // ============================================
  document.querySelectorAll('.tab-switch').forEach(tabGroup => {
    const btns = tabGroup.querySelectorAll('.tab-btn');
    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const target = btn.dataset.target;
        const parent = tabGroup.closest('.tab-container') || tabGroup.parentElement;
        parent.querySelectorAll('.tab-panel').forEach(panel => {
          panel.style.display = panel.id === target ? '' : 'none';
        });
      });
    });
  });

  // ============================================
  //  EDIT MODAL
  // ============================================
  document.querySelectorAll('[data-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
      const modal = document.getElementById(btn.dataset.modal);
      if (!modal) return;
      Object.entries(btn.dataset).forEach(([key, val]) => {
        if (key === 'modal') return;
        const field = modal.querySelector(`[name="${key}"]`);
        if (field) field.value = val;
      });
      modal.style.display = 'flex';
    });
  });

  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
      if (e.target === this) this.style.display = 'none';
    });
  });

  // ============================================
  //  SEARCH filter table
  // ============================================
  const searchInput = document.getElementById('search-input');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const q = this.value.toLowerCase();
      document.querySelectorAll('[data-searchable]').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  }

  // ============================================
  //  URL preview
  // ============================================
  document.querySelectorAll('[data-url-preview]').forEach(input => {
    const preview = document.getElementById(input.dataset.urlPreview);
    if (!preview) return;
    input.addEventListener('input', () => {
      try {
        new URL(input.value);
        preview.src = input.value;
        preview.style.display = '';
      } catch {
        preview.style.display = 'none';
      }
    });
  });

  // ============================================
  //  TOAST auto hide
  // ============================================
  ['toast-success','toast-error'].forEach(id => {
    const el = document.getElementById(id);
    if (el) setTimeout(() => { el.style.opacity = '0'; setTimeout(() => el.remove(), 400); }, 3000);
  });

});
