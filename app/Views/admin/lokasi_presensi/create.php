<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

    
   <div class="card col-md-6">
    <div class="card-body">
    <form method="POST" action="<?= base_url('admin/lokasi_presensi/store') ?>">
    <?= csrf_field()?>
        <div class="input-style-1">
                <label>Nama Lokasi</label>
                <input type="text" class="form-control <?= ($validation->hasError('nama_lokasi'))? 'is-invalid' : '' ?>" name="nama_lokasi" placeholder="Nama lokasi" value="<?= set_value('nama_lokasi') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('nama_lokasi') ?></div>
        </div>
        <div class="input-style-1">
                <label>Alamat Lokasi</label>
                 <textarea name="alamat_lokasi" placeholder="Alamat lokasi" class="form-control <?= ($validation->hasError('alamat_lokasi')) ? 'is-invalid' : '' ?>"><?= set_value('alamat_lokasi') ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('alamat_lokasi') ?></div>
        </div>
        <div class="input-style-1">
                <label>Tipe Lokasi</label>
                <input type="text" class="form-control <?= ($validation->hasError('tipe_lokasi'))? 'is-invalid' : '' ?>" name="tipe_lokasi" placeholder="Tipe Lokasi" value="<?= set_value('tipe_lokasi') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('tipe_lokasi') ?></div>
        </div>
        <div class="input-style-1">
                <label>Latitude</label>
                <input type="text" class="form-control <?= ($validation->hasError('latitude'))? 'is-invalid' : '' ?>" name="latitude" placeholder="Latitude" value="<?= set_value('latitude') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('latitude') ?></div>
        </div>
        <div class="input-style-1">
                <label>Longitude</label>
                <input type="text" class="form-control <?= ($validation->hasError('longitude'))? 'is-invalid' : '' ?>" name="longitude" placeholder="Longitude" value="<?= set_value('longitude') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('longitude') ?></div>
        </div>
        <div class="input-style-1">
                <label>Radius</label>
                <input type="number" class="form-control <?= ($validation->hasError('radius'))? 'is-invalid' : '' ?>" name="radius" placeholder="Radius" value="<?= set_value('radius') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('radius') ?></div>
        </div>
        <div class="input-style-1">
                <label>Zona Waktu</label>
                <select name="zona_waktu" class="form-control <?= ($validation->hasError('zona_waktu')) ? 'is-invalid' : '' ?>">
                        <option value="">---Pilih Zona Waktu---</option>
                        <option value="WIB" <?= set_value('zona_waktu') == 'WIB' ? 'selected' : '' ?>>WIB</option>
                        <option value="WITA" <?= set_value('zona_waktu') == 'WITA' ? 'selected' : '' ?>>WITA</option>
                        <option value="WIT" <?= set_value('zona_waktu') == 'WIT' ? 'selected' : '' ?>>WIT</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('zona_waktu') ?></div>
        </div>

        <div class="input-style-1">
                <label>Jam Masuk</label>
                <input type="time" class="form-control <?= ($validation->hasError('jam_masuk'))? 'is-invalid' : '' ?>" name="jam_masuk" placeholder="jam masuk" value="<?= set_value('jam_masuk') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('jam_masuk') ?></div>
        </div>
        <div class="input-style-1">
                <label>Jam Pulang</label>
                <input type="time" class="form-control <?= ($validation->hasError('jam_pulang'))? 'is-invalid' : '' ?>" name="jam_pulang" placeholder="jam pulang" value="<?= set_value('jam_pulang') ?>" />
                <div class="invalid-feedback"><?= $validation->getError('jam_pulang') ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    </div>
   </div>


<?= $this->endSection() ?>