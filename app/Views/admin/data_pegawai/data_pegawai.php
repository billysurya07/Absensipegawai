<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

    <a href="<?= base_url('admin/data_pegawai/create') ?>" class="btn btn-primary btn-sm d-inline-flex align-items-center">
        <i class="lni lni-circle-plus me-2"></i>Tambah Data
    </a>
    <?= csrf_field()?>
    <table class="table table-bordered table-striped" id="datatables">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">NIP</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Lokasi Presensi</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no =1;
    foreach($pegawai as $peg) : ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $peg['nip']?></td>
            <td class=""><?= $peg['nama']?></td>
            <td class=""><?= $peg['jabatan']?></td>
            <td class="text-center"><?= $peg['lokasi_presensi']?></td>
            <td class="text-center">
                <a href="<?= base_url('admin/data_pegawai/detail/'.$peg['id'])  ?>" class="badge bg-primary">Detail</a>
                <a href="<?= base_url('admin/data_pegawai/edit/'.$peg['id'])  ?>" class="badge bg-primary">Edit</a>
                <a href="<?= base_url('admin/data_pegawai/delete/'.$peg['id'])  ?>" class="badge bg-danger tombol-hapus">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>

    </table>



<?= $this->endSection() ?>