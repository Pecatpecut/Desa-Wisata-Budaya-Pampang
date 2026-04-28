<?php
$pageTitle = 'Manajemen Agenda';
$active    = 'agenda';
require ROOT . '/app/views/admin/partials/header.php';
?>

<?php if ($success): ?>
<div class="toast-msg" id="toast-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="toast-msg error" id="toast-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="page-header">
  <h2 class="page-title">Manajemen Agenda</h2>
  <p class="page-sub">Kelola jadwal kegiatan Desa Budaya Pampang</p>
</div>

<div id="agenda-app">
  <div class="form-card">
    <h5 class="form-title"><i class="bi bi-plus-circle me-2"></i>Tambah Agenda</h5>
    <form method="POST" action="<?= BASE_URL ?>/admin/agenda/tambah">
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Nama Kegiatan <span class="req">*</span></label>
          <input type="text" name="title" class="form-input" placeholder="Nama kegiatan..." v-model="form.title" required />
        </div>
        <div class="col-7">
          <label class="form-label">Tanggal <span class="req">*</span></label>
          <input type="date" name="date" class="form-input" v-model="form.date" required />
        </div>
        <div class="col-5">
          <label class="form-label">Waktu <span class="req">*</span></label>
          <input type="time" name="time" class="form-input" v-model="form.time" required />
        </div>
        <div class="col-12">
          <label class="form-label">Lokasi <span class="req">*</span></label>
          <input type="text" name="location" class="form-input" placeholder="Lokasi..." v-model="form.location" required />
        </div>
        <div class="col-12">  
          <div v-if="form.title || form.date" class="preview-box mb-2">
            <small class="text-muted">Preview:</small>
            <strong>{{ form.title || '-' }}</strong> &bull;
            {{ form.date || '-' }} {{ form.time || '' }} &bull;
            {{ form.location || '-' }}
          </div>
          <button type="submit" class="btn-red" :disabled="!formValid">
            <i class="bi bi-plus-lg me-1"></i>Tambah
          </button>
        </div>
      </div>
    </form>
  </div>


  <div class="d-flex gap-2 mb-3 flex-wrap align-items-center">
    <div class="search-wrap flex-grow-1">
      <i class="bi bi-search search-icon"></i>
      <input type="text" class="search-input" placeholder="Cari agenda..." v-model="search" />
    </div>
    <select class="form-select" style="width:auto;min-width:140px;font-size:13px;padding:8px 12px;border-radius:10px;border:1px solid #e0e0e0" v-model="sortBy">
      <option value="newest">Terbaru</option>
      <option value="oldest">Terlama</option>
      <option value="az">A → Z</option>
      <option value="za">Z → A</option>
    </select>
    <span style="font-size:13px;color:#888;white-space:nowrap">{{ filtered.length }} agenda</span>
  </div>

  <div class="table-card agenda-desktop">
    <table>
      <thead>
        <tr>
          <th>Nama Kegiatan</th><th>Tanggal</th><th>Waktu</th><th>Lokasi</th><th>Status</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="paginated.length === 0">
          <td colspan="6" class="text-center text-muted py-4">Tidak ada agenda ditemukan</td>
        </tr>
        <tr v-for="ag in paginated" :key="ag.id">
          <td>{{ ag.title }}</td>
          <td style="white-space:nowrap">{{ formatDate(ag.date) }}</td>
          <td style="white-space:nowrap">{{ ag.time.slice(0,5) }}</td>
          <td>{{ ag.location }}</td>
          <td><span :class="ag.upcoming ? 'badge-upcoming' : 'badge-past'">{{ ag.upcoming ? 'Mendatang' : 'Selesai' }}</span></td>
          <td>
            <div class="d-flex gap-2">
              <button class="btn-edit" @click="openEdit(ag)"><i class="bi bi-pencil"></i></button>
              <button class="btn-del" @click="confirmHapus(ag)"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="agenda-mobile">
    <div v-if="paginated.length === 0" class="text-center text-muted py-4">Tidak ada agenda ditemukan</div>
    <div v-for="ag in paginated" :key="'m'+ag.id" class="agenda-card">
      <div class="agenda-card-top">
        <div class="agenda-card-info">
          <div class="agenda-card-title">{{ ag.title }}</div>
          <div class="agenda-card-meta"><i class="bi bi-calendar3"></i> {{ formatDate(ag.date) }} &bull; <i class="bi bi-clock"></i> {{ ag.time.slice(0,5) }}</div>
          <div class="agenda-card-meta"><i class="bi bi-geo-alt"></i> {{ ag.location }}</div>
        </div>
        <span :class="ag.upcoming ? 'badge-upcoming' : 'badge-past'" style="flex-shrink:0;align-self:flex-start">{{ ag.upcoming ? 'Mendatang' : 'Selesai' }}</span>
      </div>
      <div class="agenda-card-actions">
        <button class="btn-edit" @click="openEdit(ag)"><i class="bi bi-pencil"></i></button>
        <button class="btn-del" @click="confirmHapus(ag)"><i class="bi bi-trash"></i></button>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center gap-1 mt-4" v-if="totalPages > 1">
    <button class="pg-btn" :disabled="page===1" @click="page--">&lsaquo;</button>
    <button v-for="p in pageRange" :key="p"
      :class="['pg-num', p===page?'active':'']"
      @click="typeof p==='number' && (page=p)">{{ p }}</button>
    <button class="pg-btn" :disabled="page===totalPages" @click="page++">&rsaquo;</button>
  </div>

  <div class="modal-overlay" v-if="editModal" style="display:flex" @click.self="editModal=false">
    <div class="modal-box">
      <div class="modal-header">
        <h5>Edit Agenda</h5>
        <button class="modal-close" @click="editModal=false">✕</button>
      </div>
      <form method="POST" action="<?= BASE_URL ?>/admin/agenda/edit">
        <div class="modal-body">
          <input type="hidden" name="id" :value="editData.id" />
          <div class="mb-3">
            <label class="form-label">Nama Kegiatan <span class="req">*</span></label>
            <input type="text" name="title" class="form-input" v-model="editData.title" required />
          </div>
          <div class="row g-2">
            <div class="col-6">
              <label class="form-label">Tanggal</label>
              <input type="date" name="date" class="form-input" v-model="editData.date" required />
            </div>
            <div class="col-6">
              <label class="form-label">Waktu</label>
              <input type="time" name="time" class="form-input" v-model="editData.time" required />
            </div>
          </div>
          <div class="mt-2">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-input" v-model="editData.location" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-outline" @click="editModal=false">Batal</button>
          <button type="submit" class="btn-red">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay" v-if="confirmModal" style="display:flex" @click.self="confirmModal=false">
    <div class="confirm-modal-box">
      <i class="bi bi-exclamation-triangle confirm-icon"></i>
      <p>Yakin ingin menghapus agenda <strong>{{ hapusTarget?.title }}</strong>?</p>
      <div class="actions">
        <button class="btn-outline" @click="confirmModal=false">Batal</button>
        <form :action="'<?= BASE_URL ?>/admin/agenda/hapus'" method="POST" style="display:inline">
          <input type="hidden" name="id" :value="hapusTarget?.id" />
          <button type="submit" class="btn-red">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>

</div>

<style>
.preview-box{background:#f8f8f8;border-radius:8px;padding:10px 14px;font-size:13px;color:#555;border-left:3px solid #c0392b}
.pg-btn{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:15px;transition:.2s}
.pg-btn:hover:not(:disabled){background:#f0f0f0;border-color:#c0392b;color:#c0392b}
.pg-btn:disabled{opacity:.4;cursor:default}
.pg-num{width:32px;height:32px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:13px;transition:.2s}
.pg-num:hover{background:#f0f0f0;color:#c0392b;border-color:#c0392b}
.pg-num.active{background:#c0392b;color:white;border-color:#c0392b}

.agenda-desktop { display:block; }
.agenda-mobile  { display:none; }

@media (max-width: 768px) {
  .agenda-desktop { display:none; }
  .agenda-mobile  { display:block; }
  .btn-red { width:100%; }
}

.agenda-card {
  background: white;
  border-radius: 14px;
  border: 1px solid #f0f0f0;
  padding: 14px 16px;
  margin-bottom: 10px;
  transition: .25s;
}
.agenda-card:hover { box-shadow: 0 6px 18px rgba(0,0,0,.07); }
.agenda-card-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 10px;
}
.agenda-card-info { flex: 1; min-width: 0; }
.agenda-card-title { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
.agenda-card-meta  { font-size: 12px; color: #888; margin-bottom: 2px; }
.agenda-card-meta i { margin-right: 4px; }
.agenda-card-actions {
  display: flex;
  gap: 8px;
  padding-top: 10px;
  border-top: 1px solid #f5f5f5;
}
</style>

<script>
const { createApp, ref, computed, reactive } = Vue;

const today = new Date().toISOString().split('T')[0];

const agendaData = <?= json_encode(array_map(fn($a) => [
  'id'       => (int)$a['id'],
  'title'    => $a['title'],
  'date'     => $a['date'],
  'time'     => $a['time'],
  'location' => $a['location'],
  'upcoming' => $a['date'] >= date('Y-m-d'),
], $agenda)) ?>;

createApp({
  setup() {
    const search  = ref('');
    const sortBy  = ref('newest');
    const page    = ref(1);
    const PER_PAGE = 10;

    const form = reactive({ title:'', date:'', time:'', location:'' });
    const formValid = computed(() => form.title && form.date && form.time && form.location);
  
    const editModal = ref(false);
    const editData  = reactive({ id:0, title:'', date:'', time:'', location:'' });
  
    const confirmModal = ref(false);
    const hapusTarget  = ref(null);

    function openEdit(ag) {
      Object.assign(editData, { id:ag.id, title:ag.title, date:ag.date, time:ag.time.slice(0,5), location:ag.location });
      editModal.value = true;
    }

    function confirmHapus(ag) {
      hapusTarget.value = ag;
      confirmModal.value = true;
    }

    function formatDate(str) {
      if (!str) return '-';
      const d = new Date(str + 'T00:00:00');
      const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
      return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    }

    const filtered = computed(() => {
      const q = search.value.toLowerCase();
      let data = agendaData.filter(a =>
        !q || a.title.toLowerCase().includes(q) || a.location.toLowerCase().includes(q)
      );
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
    const pageRange  = computed(() => {
      const total = totalPages.value, cur = page.value;
      if (total <= 7) return Array.from({length:total},(_,i)=>i+1);
      const r = [];
      if (cur <= 4) { for(let i=1;i<=5;i++) r.push(i); r.push('...'); r.push(total); }
      else if (cur >= total-3) { r.push(1); r.push('...'); for(let i=total-4;i<=total;i++) r.push(i); }
      else { r.push(1); r.push('...'); for(let i=cur-1;i<=cur+1;i++) r.push(i); r.push('...'); r.push(total); }
      return r;
    });

    return { search, sortBy, page, form, formValid, editModal, editData, confirmModal, hapusTarget, filtered, paginated, totalPages, pageRange, openEdit, confirmHapus, formatDate };
  }
}).mount('#agenda-app');
</script>

<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
