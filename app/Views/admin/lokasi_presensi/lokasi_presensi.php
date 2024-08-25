<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/lokasi_presensi/create') ?>" class="btn btn-primary btn-sm d-inline-flex align-items-center">
    <i class="lni lni-circle-plus me-2"></i>Tambah Data
</a>

    <?= csrf_field()?>
    <table class="table table-bordered table-striped" id="datatables">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lokasi</th>
                <th>Alamat Lokasi</th>
                <th>Tipe Lokasi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no =1;
         foreach($lokasi_presensi as $lok) : ?>
           
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $lok['nama_lokasi']?></td>
                    <td><?= $lok['alamat_lokasi']?></td>
                    <td><?= $lok['tipe_lokasi']?></td>
                    <td class="text-center">
                        <a href="<?= base_url('admin/lokasi_presensi/detail/'.$lok['id'])  ?>" class="badge bg-primary">Detail</a>
                        <a href="<?= base_url('admin/lokasi_presensi/edit/'.$lok['id'])  ?>" class="badge bg-primary">Edit</a>
                        <a href="<?= base_url('admin/lokasi_presensi/delete/'.$lok['id'])  ?>" class="badge bg-danger tombol-hapus">Delete</a>
                    </td>
                </tr>
        <?php endforeach ?>
        </tbody>
    </table>



<?= $this->endSection() ?>