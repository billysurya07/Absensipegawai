<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('pegawai/ketidakhadiran/create') ?>" class="btn btn-primary btn-sm d-inline-flex align-items-center">
        <i class="lni lni-circle-plus me-2"></i>Ajukan
    </a>
    <?= csrf_field()?>
    <table class="table table-bordered table-striped" id="datatables">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Keterangan</th>
        <th class="text-center">Deskripsi</th>
        <th class="text-center">File</th>
        <th class="text-center">Status</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no =1;
    foreach($ketidakhadiran as $ketidakhadiran) : ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $ketidakhadiran['tanggal']?></td>
            <td class=""><?= $ketidakhadiran['keterangan']?></td>
            <td class=""><?= $ketidakhadiran['deskripsi']?></td>
            <td>
                <a class="badge bg-primary" href="<?= base_url('file_ketidakhadiran/'.$ketidakhadiran['file']) ?>">Dwonload</a>
            </td>
            <td class="text-center"><?= $ketidakhadiran['status']?></td>
            <td class="text-center">
                <a href="<?= base_url('pegawai/ketidakhadiran/edit/'.$ketidakhadiran['id'])  ?>" class="badge bg-primary">Edit</a>
                <a href="<?= base_url('pegawai/ketidakhadiran/delete/'.$ketidakhadiran['id'])  ?>" class="badge bg-danger tombol-hapus">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>

    </table>

    
<?= $this->endSection() ?>