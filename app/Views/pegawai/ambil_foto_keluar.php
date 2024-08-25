<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<input type="hidden" id="tanggal_keluar" name="tanggal_keluar" value="<?= $tanggal_keluar?>">
<input type="hidden" id="jam_keluar" name="jam_keluar" value="<?= $jam_keluar?>">
<div id="my_camera"></div>
<div style="display:none;" id="my_result"></div>
<button class="btn btn-danger mt-2" id="ambil_foto_keluar">keluar</button>


<script>
    Webcam.set({
        width: 320,
        height: 240,
        dest_width: 320,
        dest_height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });

    Webcam.attach('#my_camera'); // Pastikan #my_camera ada di halaman

    document.getElementById('ambil_foto_keluar').addEventListener('click', function(){
        let tanggal_keluar = document.getElementById('tanggal_keluar').value;
        let jam_keluar = document.getElementById('jam_keluar').value;

        Webcam.snap(function(data_uri){
            var xhttp = new XMLHttpRequest();
            document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>';
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    // Tindakan yang dilakukan setelah berhasil mengirim data
                    window.location.href = '<?= base_url('pegawai/home') ?>';
                }
            };

            // Buka koneksi POST
            xhttp.open("POST", "<?= base_url('pegawai/presensi_keluar_aksi/'. $id_presensi) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Kirim data
            xhttp.send(
                'foto_keluar=' + encodeURIComponent(data_uri) + 
                '&tanggal_keluar=' + encodeURIComponent(tanggal_keluar) +
                '&jam_keluar=' + encodeURIComponent(jam_keluar)
            );

            // Tampilkan hasil foto di elemen dengan ID my_result
            
        });
    });
</script>
    
<?= $this->endSection() ?>