<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>


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
            <td class="text-center">
    <span class="badge <?= $ketidakhadiran['status'] == 'Pending' ? 'bg-warning' : ($ketidakhadiran['status'] == 'Approved' ? 'bg-success' : 'bg-secondary') ?>">
        <?= $ketidakhadiran['status'] ?>
    </span>
</td>

            <td>
                <a class="badge bg-success" href="<?= base_url('admin/approved_ketidakhadiran/'.$ketidakhadiran['id']) ?>">Approved</a>
            </td>
            
        </tr>
    <?php endforeach ?>
</tbody>

    </table>

    
<?= $this->endSection() ?>