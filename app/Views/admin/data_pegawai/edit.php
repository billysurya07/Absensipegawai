<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

    
   <div class="card col-md-6">
    <div class="card-body">
    <?= csrf_field()?>
    <form method="POST" action="<?= base_url('admin/data_pegawai/update/'.$pegawai['id']) ?>" enctype="multipart/form-data">
        <div class="input-style-1">
                <label>Nama</label>
                <input value="<?= $pegawai['nama'] ?>" type="text" class="form-control <?= ($validation->hasError('nama'))? 'is-invalid' : '' ?>" name="nama" placeholder="Nama " />
                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
        </div>
        <div class="input-style-1">
                <label>NIP</label>
                <input  value="<?= $pegawai['nip'] ?>" type="text" class="form-control <?= ($validation->hasError('nip'))? 'is-invalid' : '' ?>" name="nip" placeholder="NIP " />
                <div class="invalid-feedback"><?= $validation->getError('nip') ?></div>
        </div>
        <div class="input-style-1">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin'))? 'is-invalid' : '' ?>" >
                <option value="<?= $pegawai['jenis_kelamin'] ?>">---Pilih Jenis Kelamin---</option>
                <option <?php if ($pegawai['jenis_kelamin'] == 'Laki-Laki' ) {echo'selected';} ?> value="Laki-Laki">Laki-Laki</option>
                <option <?php if ($pegawai['jenis_kelamin'] == 'Perempuan' ) {echo'selected';} ?> value="Perempuan">Perempuan</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ?></div>
        </div>
        <div class="i
        <div class="input-style-1">
                <label>Alamat</label>
               <textarea name="alamat"  placeholder="Alamat lokasi" class="form-control <?= ($validation->hasError('alamat'))? 'is-invalid' : '' ?>" ><?= $pegawai['alamat'] ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
        </div>
        <div class="input-style-1">
                <label>No Handphone</label>
                <input value="<?= $pegawai['no_handphone'] ?>" type="text" class="form-control <?= ($validation->hasError('no_handphone'))? 'is-invalid' : '' ?>" name="no_handphone" placeholder="No Handphone" />
                <div class="invalid-feedback"><?= $validation->getError('no_handphone') ?></div>
        </div>
        <div class="input-style-1">
                <label>Jabatan</label>
                <select name="jabatan" class="form-control <?= ($validation->hasError('jabatan'))? 'is-invalid' : '' ?>" >
                        <option value="<?= $pegawai['jabatan'] ?>"><?= $pegawai['jabatan'] ?></option>
                        <?php foreach($jabatan as $jab) :?>
                        <option value="<?= $jab['jabatan'] ?>"><?= $jab['jabatan'] ?></option>
                        <?php endforeach; ?>     
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jabatan') ?></div>
        </div>
        <div class="input-style-1">
                <label>Lokasi Presensi</label>
                <select name="lokasi_presensi" class="form-control <?= ($validation->hasError('lokasi_presensi'))? 'is-invalid' : '' ?>" >
                
                <option value="<?= $pegawai['lokasi_presensi']?>"><?= $pegawai['lokasi_presensi']?></option>
                        <?php foreach($lokasi_presensi as $lok) :?>
                <option value="<?= $lok['id'] ?>"><?= $lok['nama_lokasi'] ?></option>
                        <?php endforeach; ?>     
                </select>
                <div class="invalid-feedback"><?= $validation->getError('lokasi_presensi') ?></div>
        </div>
        <div class="input-style-1">
                <label>Foto</label>
                <input type="hidden" value="<?= $pegawai['foto'] ?>" name="foto_lama">
                <input type="file" class="form-control <?= ($validation->hasError('foto'))? 'is-invalid' : '' ?>" name="foto" placeholder="" />
                <div class="invalid-feedback"><?= $validation->getError('foto') ?></div>
        </div>
        <div class="input-style-1">
                <label>Username</label>
                <input value="<?= $pegawai['username'] ?>" type="text" class="form-control <?= ($validation->hasError('username'))? 'is-invalid' : '' ?>" name="username" placeholder="Username" />
                <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
        </div>
        <div class="input-style-1">
                <label>Password</label>
                <input type="hidden" value="<?= $pegawai['password'] ?>" name="password_lama">
                <input type="password" class="form-control <?= ($validation->hasError('password'))? 'is-invalid' : '' ?>" name="password" placeholder="password" />
                <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
        </div>
        <div class="input-style-1">
                <label>Konfirmasi Password</label>
                <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password'))? 'is-invalid' : '' ?>" name="konfirmasi_password" placeholder="konfirmasi password" />
                <div class="invalid-feedback"><?= $validation->getError('konfirmasi_password') ?></div>
        </div>
        <div class="input-style-1">
                <label>Role</label>
                <select name="role" class="form-control <?= ($validation->hasError('role'))? 'is-invalid' : '' ?>" >
                        <option value="<?= $pegawai['role'] ?>">---Pilih Role---</option>
                        <option <?php if ($pegawai['role'] == 'Admin' ) {echo'selected';} ?> value="Admin">Admin</option>
                        <option <?php if ($pegawai['role'] == 'Pegawai' ) {echo'selected';} ?> value="Pegawai">Pegawai</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
</form>
    </div>
   </div>


<?= $this->endSection() ?>