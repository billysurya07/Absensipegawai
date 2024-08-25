<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

    
   <div class="card col-md-6">
    <div class="card-body">
    <form method="POST" action="<?= base_url('pegawai/ketidakhadiran/store') ?>" enctype="multipart/form-data">
    <?= csrf_field()?>
        <input type="hidden" value="<?= session()->get('id_pegawai') ?>" name="id_pegawai">
        <div class="input-style-1">
        <div class="input-style-1">
         <label>Keterangan</label>
        <select name="keterangan" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>">
                <option value="">---Pilih Keterangan---</option>
                <option value="Izin" <?= set_value('keterangan') == 'Izin' ? 'selected' : '' ?>>Izin</option>
                <option value="Sakit" <?= set_value('keterangan') == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
        </select>
        <div class="invalid-feedback"><?= $validation->getError('keterangan') ?></div>
        </div>
                <label>Tanggal Ketidakhadiran</label>
                <input type="date" class="form-control <?= ($validation->hasError('tanggal'))? 'is-invalid' : '' ?>" name="tanggal" value="<?= set_value('tanggal') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('tanggal') ?></div>
        </div>
        <div class="input-style-1">
                <label>Deskripsi</label>
               <textarea name="deskripsi"  placeholder="Deskripsi" class="form-control <?= ($validation->hasError('deskripsi'))? 'is-invalid' : '' ?>" ><?= set_value('deskripsi') ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
        </div>
        <div class="input-style-1">
                <label>File</label>
                <input type="file" class="form-control <?= ($validation->hasError('file'))? 'is-invalid' : '' ?>" name="file"  value="<?= set_value('file') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('file') ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
</form>
    </div>
   </div>


<?= $this->endSection() ?>