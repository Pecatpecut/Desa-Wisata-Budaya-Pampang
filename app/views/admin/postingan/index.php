<?php
$pageTitle = 'Manajemen Postingan';
$active    = 'postingan';
require ROOT . '/app/views/admin/partials/header.php';
?>

<?php if ($success): ?>
<div class="toast-msg" id="toast-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="toast-msg error" id="toast-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="page-header">
  <h2 class="page-title">Manajemen Postingan</h2>
  <p class="page-sub">Kelola kiriman ulang postingan dari media sosial atau berita</p>
</div>

<div id="post-app">

  <!-- FORM TAMBAH -->
  <div class="form-card">
    <h5 class="form-title"><i class="bi bi-plus-circle me-2"></i>Tambah Postingan</h5>
    <form method="POST" action="<?= BASE_URL ?>/admin/postingan/tambah" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Judul Postingan <span class="req">*</span></label>
          <input type="text" name="title" class="form-input" placeholder="Judul postingan..." v-model="form.title" required />
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Link Postingan <span class="req">*</span></label>
          <input type="url" name="link" class="form-input" placeholder="https://..." v-model="form.link" required />
        </div>
        <div class="col-12 col-md-4">
          <label class="form-label">Sumber / Credit <span class="req">*</span></label>
          <input type="text" name="source" class="form-input" placeholder="contoh: Kompas.com / @akun" v-model="form.source" required />
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Thumbnail <span class="req">*</span></label>
          <div class="tab-switch mb-2">
            <button type="button" :class="['tab-btn', tab==='file'?'active':'']" @click="tab='file'">
              <i class="bi bi-upload me-1"></i>Upload File
            </button>
            <button type="button" :class="['tab-btn', tab==='url'?'active':'']" @click="tab='url'">
              <i class="bi bi-link-45deg me-1"></i>URL Gambar
            </button>
          </div>
          <div v-show="tab==='file'">
            <div class="file-drop" @click="$refs.thumbInput.click()" @dragover.prevent @drop.prevent="onDrop">
              <template v-if="!previewFile">
                <i class="bi bi-image fs-3 text-muted"></i>
                <span>Klik atau seret gambar (JPG/PNG/WEBP, maks 5MB)</span>
              </template>
              <template v-else>
                <img :src="previewFile" style="max-height:80px;border-radius:8px;object-fit:cover" />
                <span style="font-size:12px;color:#555">{{ fileName }}</span>
              </template>
            </div>
            <input type="file" ref="thumbInput" name="thumbnail" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none" @change="onFileChange" />
          </div>
          <div v-show="tab==='url'">
            <input type="text" name="thumbnail_url" class="form-input" placeholder="https://contoh.com/gambar.jpg" v-model="urlInput" />
            <img v-if="urlInput" :src="urlInput" style="margin-top:8px;width:80px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #eee" @error="urlInput=''" />
          </div>
        </div>
        <div class="col-12 col-md-2 d-flex align-items-end">
          <button type="submit" class="btn-red w-100"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
        </div>
      </div>
    </form>
  </div>

  <!-- TOOLBAR -->
  <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <div class="search-wrap flex-grow-1">
      <i class="bi bi-search search-icon"></i>
      <input type="text" class="search-input" placeholder="Cari judul postingan..." v-model="search" />
    </div>
    <select class="form-select" style="width:auto;min-width:160px;font-size:13px;padding:8px 12px;border-radius:10px;border:1px solid #e0e0e0" v-model="sortBy">
      <option value="newest">Terbaru</option>
      <option value="oldest">Terlama</option>
      <option value="az">A → Z</option>
      <option value="za">Z → A</option>
    </select>
    <span style="font-size:13px;color:#888;white-space:nowrap">{{ filtered.length }} postingan</span>
  </div>

  <!-- LIST -->
  <div v-if="filtered.length === 0" class="empty-state">
    <i class="bi bi-newspaper"></i><p>Tidak ada postingan ditemukan</p>
  </div>
  <div class="post-list" v-else>
    <div class="post-card" v-for="p in paginated" :key="p.id">
      <div class="thumb-wrap">
        <img :src="p.thumbnail" :alt="p.title" />
      </div>
      <div class="post-body">
        <h5>{{ p.title }}</h5>
        <p class="source"><i class="bi bi-link-45deg me-1"></i>{{ p.source }}</p>
        <p class="date">{{ formatDate(p.date) }}</p>
      </div>
      <div class="post-actions">
        <a :href="p.link" target="_blank" class="btn-open"><i class="bi bi-box-arrow-up-right me-1"></i>Buka</a>
        <button class="btn-edit" @click="openEdit(p)"><i class="bi bi-pencil"></i></button>
        <button class="btn-del" @click="confirmHapus(p)"><i class="bi bi-trash"></i></button>
      </div>
    </div>
  </div>

  <!-- PAGINATION -->
  <div class="d-flex justify-content-center gap-1 mt-4" v-if="totalPages > 1">
    <button class="pg-btn" :disabled="page===1" @click="page--">&lsaquo;</button>
    <button v-for="p in pageRange" :key="p" :class="['pg-num', p===page?'active':'']"
      @click="typeof p==='number' && (page=p)">{{ p }}</button>
    <button class="pg-btn" :disabled="page===totalPages" @click="page++">&rsaquo;</button>
  </div>

  <!-- EDIT MODAL -->
  <div class="modal-overlay" v-if="editModal" style="display:flex" @click.self="editModal=false">
    <div class="modal-box">
      <div class="modal-header">
        <h5>Edit Postingan</h5>
        <button class="modal-close" @click="editModal=false">✕</button>
      </div>
      <form method="POST" action="<?= BASE_URL ?>/admin/postingan/edit">
        <div class="modal-body">
          <input type="hidden" name="id" :value="editData.id" />
          <div class="mb-3">
            <label class="form-label">Judul <span class="req">*</span></label>
            <input type="text" name="title" class="form-input" v-model="editData.title" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Link <span class="req">*</span></label>
            <input type="url" name="link" class="form-input" v-model="editData.link" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Sumber <span class="req">*</span></label>
            <input type="text" name="source" class="form-input" v-model="editData.source" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-outline" @click="editModal=false">Batal</button>
          <button type="submit" class="btn-red">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- CONFIRM HAPUS -->
  <div class="modal-overlay" v-if="confirmModal" style="display:flex" @click.self="confirmModal=false">
    <div class="confirm-modal-box">
      <i class="bi bi-exclamation-triangle confirm-icon"></i>
      <p>Yakin ingin menghapus postingan <strong>{{ hapusTarget?.title }}</strong>?</p>
      <div class="actions">
        <button class="btn-outline" @click="confirmModal=false">Batal</button>
        <form :action="'<?= BASE_URL ?>/admin/postingan/hapus'" method="POST" style="display:inline">
          <input type="hidden" name="id" :value="hapusTarget?.id" />
          <button type="submit" class="btn-red">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>

</div>

<style>
/* ── Post list ── */
.post-list{display:flex;flex-direction:column;gap:10px}
.post-card{display:flex;align-items:center;gap:14px;padding:14px 16px;background:white;border-radius:14px;border:1px solid #f0f0f0;transition:.25s;flex-wrap:nowrap}
.post-card:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(0,0,0,.06)}
.thumb-wrap{width:90px;height:68px;border-radius:10px;overflow:hidden;flex-shrink:0}
.thumb-wrap img{width:100%;height:100%;object-fit:cover}
.post-body{flex:1;min-width:0}
.post-body h5{margin:0 0 4px;font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.source,.date{font-size:12px;color:#888;margin:0 0 2px}
.post-actions{display:flex;gap:8px;flex-shrink:0;align-items:center}
.btn-open{padding:7px 14px;border-radius:8px;background:#f0f0f0;color:#333;text-decoration:none;font-size:13px;transition:.2s;display:flex;align-items:center;white-space:nowrap}
.btn-open:hover{background:#c0392b;color:white}

/* ── Pagination ── */
.pg-btn{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:15px;transition:.2s}
.pg-btn:hover:not(:disabled){background:#f0f0f0;border-color:#c0392b;color:#c0392b}
.pg-btn:disabled{opacity:.4;cursor:default}
.pg-num{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:13px;transition:.2s}
.pg-num:hover{background:#f0f0f0;color:#c0392b;border-color:#c0392b}
.pg-num.active{background:#c0392b;color:white;border-color:#c0392b}

/* ── Mobile ≤ 768px ── */
@media(max-width:768px){
  /* Form tambah - semua kolom full width */
  .form-card .row > [class*="col-"]{flex:0 0 100%;max-width:100%;width:100%}

  /* Post card wrap */
  .post-card{flex-wrap:wrap;gap:10px;padding:12px;align-items:flex-start}
  .thumb-wrap{width:72px;height:56px}
  .post-body{flex:1;min-width:0}
  .post-body h5{font-size:13px;white-space:normal}
  .post-actions{width:100%;flex-wrap:wrap;gap:6px;padding-top:8px;border-top:1px solid #f5f5f5;justify-content:flex-start}
  .btn-open{font-size:12px;padding:6px 12px}
}

/* ── Mobile ≤ 480px ── */
@media(max-width:480px){
  .thumb-wrap{width:58px;height:46px}
  .post-body h5{font-size:12px}
  .pg-btn,.pg-num{width:28px;height:28px;font-size:12px}
}
</style>

<script>
const { createApp, ref, computed, reactive } = Vue;

const postinganData = <?= json_encode(array_map(fn($p) => [
  'id'        => (int)$p['id'],
  'title'     => $p['title'],
  'link'      => $p['link'],
  'source'    => $p['source'],
  'thumbnail' => $p['thumbnail'],
  'date'      => $p['date'] ?? '',
], $postingan)) ?>;

createApp({
  setup() {
    const search   = ref('');
    const sortBy   = ref('newest');
    const page     = ref(1);
    const PER_PAGE = 10;

    const tab         = ref('file');
    const form        = reactive({ title:'', link:'', source:'' });
    const previewFile = ref('');
    const fileName    = ref('');
    const urlInput    = ref('');

    const editModal    = ref(false);
    const editData     = reactive({ id:0, title:'', link:'', source:'' });
    const confirmModal = ref(false);
    const hapusTarget  = ref(null);

    function onFileChange(e) {
      const file = e.target.files[0]; if (!file) return;
      fileName.value = file.name;
      const reader = new FileReader();
      reader.onload = ev => previewFile.value = ev.target.result;
      reader.readAsDataURL(file);
    }
    function onDrop(e) {
      const file = e.dataTransfer.files[0]; if (!file) return;
      fileName.value = file.name;
      const reader = new FileReader();
      reader.onload = ev => previewFile.value = ev.target.result;
      reader.readAsDataURL(file);
    }
    function openEdit(p) {
      Object.assign(editData, { id:p.id, title:p.title, link:p.link, source:p.source });
      editModal.value = true;
    }
    function confirmHapus(p) { hapusTarget.value = p; confirmModal.value = true; }

    function formatDate(str) {
      if (!str) return '';
      const d = new Date(str + 'T00:00:00');
      const m = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
      return d.getDate() + ' ' + m[d.getMonth()] + ' ' + d.getFullYear();
    }

    const filtered = computed(() => {
      const q = search.value.toLowerCase();
      let data = postinganData.filter(p => !q || p.title.toLowerCase().includes(q) || p.source.toLowerCase().includes(q));
      if (sortBy.value === 'newest') data.sort((a,b) => b.date.localeCompare(a.date));
      else if (sortBy.value === 'oldest') data.sort((a,b) => a.date.localeCompare(b.date));
      else if (sortBy.value === 'az') data.sort((a,b) => a.title.localeCompare(b.title));
      else if (sortBy.value === 'za') data.sort((a,b) => b.title.localeCompare(a.title));
      return data;
    });

    const totalPages = computed(() => Math.max(1, Math.ceil(filtered.value.length / PER_PAGE)));
    const paginated  = computed(() => {
      const p = Math.min(page.value, totalPages.value);
      return filtered.value.slice((p-1)*PER_PAGE, p*PER_PAGE);
    });
    const pageRange = computed(() => {
      const total = totalPages.value, cur = page.value;
      if (total <= 7) return Array.from({length:total},(_,i)=>i+1);
      const r = [];
      if (cur <= 4) { for(let i=1;i<=5;i++) r.push(i); r.push('...'); r.push(total); }
      else if (cur >= total-3) { r.push(1); r.push('...'); for(let i=total-4;i<=total;i++) r.push(i); }
      else { r.push(1); r.push('...'); for(let i=cur-1;i<=cur+1;i++) r.push(i); r.push('...'); r.push(total); }
      return r;
    });

    return { search, sortBy, page, tab, form, previewFile, fileName, urlInput, editModal, editData, confirmModal, hapusTarget, filtered, paginated, totalPages, pageRange, onFileChange, onDrop, openEdit, confirmHapus, formatDate };
  }
}).mount('#post-app');
</script>

<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
