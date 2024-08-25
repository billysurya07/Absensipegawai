<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

    <a href="<?= base_url('admin/jabatan/create') ?>" class="btn btn-primary btn-sm d-inline-flex              align-items-center">
        <i class="lni lni-circle-plus me-2"></i>Tambah Data
    </a>

    <?= csrf_field()?>
    <table class="table table-bordered table-striped" id="datatables" >
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Jabatan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no =1;
         foreach($jabatan as $jab) : ?>
           
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $jab['jabatan']?></td>
                    <td class="text-center">
                        <a href="<?= base_url('admin/jabatan/edit/'.$jab['id'])  ?>" class="badge bg-primary">Edit Data</a>
                        <a href="<?= base_url('admin/jabatan/delete/'.$jab['id'])  ?>" class="badge bg-danger tombol-hapus">Delete Data</a>
                    </td>
                </tr>
        <?php endforeach ?>
        </tbody>
    </table>



<?= $this->endSection() ?>