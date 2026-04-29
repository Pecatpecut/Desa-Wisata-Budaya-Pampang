<?php
$active    = 'galeri';
require ROOT . '/app/views/admin/partials/header.php';
?>

<?php if ($success): ?>
<div class="toast-msg" id="toast-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="toast-msg error" id="toast-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="page-header">
  <h2 class="page-title">Manajemen Galeri</h2>
  <p class="page-sub">Kelola foto dan gambar kegiatan desa</p>
</div>

<div id="galeri-app">
  <div class="form-card">
    <h5 class="form-title"><i class="bi bi-cloud-upload me-2"></i>Upload Foto Baru</h5>
    <form method="POST" action="<?= BASE_URL ?>/admin/galeri/upload" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Judul Foto <span class="req">*</span></label>
          <input type="text" name="title" class="form-input" placeholder="Masukkan judul foto..." v-model="uploadTitle" required />
        </div>
        <div class="col-12">
          <label class="form-label">Gambar <span class="req">*</span></label>
          <div class="tab-switch mb-2">
            <button type="button" :class="['tab-btn', tab==='file'?'active':'']" @click="tab='file'">
              <i class="bi bi-upload me-1"></i>Upload File
            </button>
            <button type="button" :class="['tab-btn', tab==='url'?'active':'']" @click="tab='url'">
              <i class="bi bi-link-45deg me-1"></i>URL Gambar
            </button>
          </div>
          <div v-show="tab==='file'">
            <div class="file-drop" @click="$refs.fileInput.click()" @dragover.prevent @drop.prevent="onDrop">
              <template v-if="!previewFile">
                <i class="bi bi-image fs-3 text-muted"></i>
                <span>Klik atau seret gambar ke sini (JPG/PNG/WEBP, maks 5MB)</span>
              </template>
              <template v-else>
                <img :src="previewFile" style="max-height:80px;border-radius:8px;object-fit:cover" />
                <span style="font-size:12px;color:#555">{{ fileName }}</span>
              </template>
            </div>
            <input type="file" ref="fileInput" name="image" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none" @change="onFileChange" />
          </div>
          <div v-show="tab==='url'">
            <input type="text" name="image_url" class="form-input" placeholder="https://contoh.com/gambar.jpg" v-model="urlInput" />
            <img v-if="urlInput" :src="urlInput" style="margin-top:8px;width:80px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #eee" @error="urlInput=''" />
          </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn-red btn-sm-submit"><i class="bi bi-plus-lg me-1"></i>Upload</button>
        </div>
      </div>
    </form>
  </div>
  <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <div class="search-wrap flex-grow-1">
      <i class="bi bi-search search-icon"></i>
      <input type="text" class="search-input" placeholder="Cari judul foto..." v-model="search" />
    </div>
    <select class="form-select" style="width:auto;min-width:160px;font-size:13px;padding:8px 12px;border-radius:10px;border:1px solid #e0e0e0" v-model="sortBy">
      <option value="newest">Terbaru</option>
      <option value="oldest">Terlama</option>
      <option value="az">A → Z</option>
      <option value="za">Z → A</option>
    </select>
    <span style="font-size:13px;color:#888;white-space:nowrap">{{ filtered.length }} foto</span>
  </div>
  <div v-if="filtered.length === 0" class="empty-state">
    <i class="bi bi-images"></i><p>Tidak ada foto ditemukan</p>
  </div>
  <div class="galeri-grid" v-else>
    <div class="galeri-card" v-for="g in paginated" :key="g.id">
      <div class="galeri-img-wrap">
        <img :src="g.image" :alt="g.title" />
        <div class="galeri-overlay">
          <button class="ov-btn edit" @click="openEdit(g)"><i class="bi bi-pencil"></i></button>
          <button class="ov-btn del" @click="confirmHapus(g)"><i class="bi bi-trash"></i></button>
        </div>
      </div>
      <div class="galeri-info">{{ g.title }}</div>
    </div>
  </div>
  <div class="d-flex justify-content-center gap-1 mt-4" v-if="totalPages > 1">
    <button class="pg-btn" :disabled="page===1" @click="page--">&lsaquo;</button>
    <button v-for="p in pageRange" :key="p" :class="['pg-num', p===page?'active':'']"
      @click="typeof p==='number' && (page=p)">{{ p }}</button>
    <button class="pg-btn" :disabled="page===totalPages" @click="page++">&rsaquo;</button>
  </div>
  <div class="modal-overlay" v-if="editModal" style="display:flex" @click.self="editModal=false">
    <div class="modal-box">
      <div class="modal-header">
        <h5>Edit Judul Foto</h5>
        <button class="modal-close" @click="editModal=false">✕</button>
      </div>
      <form method="POST" action="<?= BASE_URL ?>/admin/galeri/edit">
        <div class="modal-body">
          <input type="hidden" name="id" :value="editData.id" />
          <label class="form-label">Judul <span class="req">*</span></label>
          <input type="text" name="title" class="form-input" v-model="editData.title" required />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-outline" @click="editModal=false">Batal</button>
          <button type="submit" class="btn-red"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-overlay" v-if="confirmModal" style="display:flex" @click.self="confirmModal=false">
    <div class="confirm-modal-box">
      <i class="bi bi-exclamation-triangle confirm-icon"></i>
      <p>Yakin ingin menghapus foto <strong>{{ hapusTarget?.title }}</strong>?</p>
      <div class="actions">
        <button class="btn-outline" @click="confirmModal=false">Batal</button>
        <form :action="'<?= BASE_URL ?>/admin/galeri/hapus'" method="POST" style="display:inline">
          <input type="hidden" name="id" :value="hapusTarget?.id" />
          <button type="submit" class="btn-red">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>

</div>

<style>
.pg-btn{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:15px;transition:.2s}
.pg-btn:hover:not(:disabled){background:#f0f0f0;border-color:#c0392b;color:#c0392b}
.pg-btn:disabled{opacity:.4;cursor:default}
.pg-num{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:13px;transition:.2s}
.pg-num:hover{background:#f0f0f0;color:#c0392b;border-color:#c0392b}
.pg-num.active{background:#c0392b;color:white;border-color:#c0392b}
.btn-sm-submit{padding:8px 22px;font-size:13px;width:auto;display:inline-flex;align-items:center}
</style>

<script>
const { createApp, ref, computed, reactive } = Vue;

const galeriData = <?= json_encode(array_map(fn($g) => [
  'id'         => (int)$g['id'],
  'title'      => $g['title'],
  'image'      => $g['image'],
  'created_at' => $g['created_at'] ?? '',
], $galeri)) ?>;

createApp({
  setup() {
    const search   = ref('');
    const sortBy   = ref('newest');
    const page     = ref(1);
    const PER_PAGE = 12;

    const tab         = ref('file');
    const uploadTitle = ref('');
    const previewFile = ref('');
    const fileName    = ref('');
    const urlInput    = ref('');

    const editModal  = ref(false);
    const editData   = reactive({ id:0, title:'' });
    const confirmModal = ref(false);
    const hapusTarget  = ref(null);

    function onFileChange(e) {
      const file = e.target.files[0];
      if (!file) return;
      fileName.value = file.name;
      const reader = new FileReader();
      reader.onload = ev => previewFile.value = ev.target.result;
      reader.readAsDataURL(file);
    }
    function onDrop(e) {
      const file = e.dataTransfer.files[0];
      if (!file) return;
      fileName.value = file.name;
      const reader = new FileReader();
      reader.onload = ev => previewFile.value = ev.target.result;
      reader.readAsDataURL(file);
    }
    function openEdit(g) {
      Object.assign(editData, { id: g.id, title: g.title });
      editModal.value = true;
    }
    function confirmHapus(g) {
      hapusTarget.value = g;
      confirmModal.value = true;
    }

    const filtered = computed(() => {
      const q = search.value.toLowerCase();
      let data = galeriData.filter(g => !q || g.title.toLowerCase().includes(q));
      if (sortBy.value === 'newest') data.sort((a,b) => b.created_at.localeCompare(a.created_at));
      else if (sortBy.value === 'oldest') data.sort((a,b) => a.created_at.localeCompare(b.created_at));
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

    return { search, sortBy, page, tab, uploadTitle, previewFile, fileName, urlInput, editModal, editData, confirmModal, hapusTarget, filtered, paginated, totalPages, pageRange, onFileChange, onDrop, openEdit, confirmHapus };
  }
}).mount('#galeri-app');
</script>

<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
