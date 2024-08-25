<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<form class="row g-3">
  <div class="col-auto">
    <input type="date" class="form-control"  name="filter_tanggal">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Tampilkan</button>
  </div>
  <div class="col-auto">
    <button type="submit" name="excel" class="btn btn-success mb-3">Export Excel</button>
  </div>
</form>
<table class="table table-bordered table-striped" id="datatables">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Nama Pegawai</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Jam Masuk</th>
        <th class="text-center">Jam Keluar</th>
        <th class="text-center">Total Jam Kerja</th>
        <th class="text-center">Total Keterlambatan</th>
    </tr>

</thead>
<tbody>
    <?php $no =1;
    foreach($rekap_presensi as $rekap) : ?>
    <?php 

        // menghitung total jam kerja

        $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'].$rekap['jam_masuk']);
        $timestamp_jam_keluar = strtotime($rekap['tanggal_masuk'].$rekap['jam_keluar']);
        $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
        $jam = floor($selisih / 3600);
        $selisih -= $jam * 3600;
        $menit = floor($selisih / 60);

        // menghitung total jam keterlambatan

        $jam_masuk_real = strtotime($rekap['jam_masuk']);
        $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
        $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
        $jam_terlambat = floor($selisih_terlambat / 3600);
        $selisih_terlambat -= $jam_terlambat * 3600;
        $menit_terlambat = floor($selisih_terlambat / 60);
         
        
    ?>
       <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= htmlspecialchars($rekap['nama']) ?></td>
            <td class="text-center"><?= date('d-F-Y', strtotime($rekap['tanggal_masuk'])) ?></td>
            <td class="text-center"><?= htmlspecialchars($rekap['jam_masuk']) ?></td>
            <td class="text-center"><?= htmlspecialchars($rekap['jam_keluar']) ?></td>
            <td class="text-center">
                <?php 
                    // Periksa apakah 'jam_keluar' kosong atau bernilai '00:00:00'
                    if (empty($rekap['jam_keluar']) || $rekap['jam_keluar'] == '00:00:00') : 
                ?>
                    0 jam 0 menit
                <?php else : ?>
                    <?= htmlspecialchars($jam) . ' Jam ' . htmlspecialchars($menit) . ' Menit' ?>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <?php 
                    // Periksa apakah 'jam_keluar' kosong atau bernilai '00:00:00'
                    if ($jam_terlambat < 0 || $menit_terlambat < 0 ) : 
                ?>
                    <Span class="btn btn-success">On Time</Span>
                <?php else : ?>
                    <?= htmlspecialchars($jam_terlambat) . ' Jam ' . htmlspecialchars($menit_terlambat) . ' Menit' ?>
                <?php endif; ?>
            </td>
        </tr>
                <?php endforeach ?>
</tbody>

    </table>
<?= $this->endSection() ?>