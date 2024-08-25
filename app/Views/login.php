<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Sistem Absesi | SD Negeri Pangkalan</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href=" <?= base_url('assets/css/bootstrap.min.css')?> " />
    <link rel="stylesheet" href=" <?= base_url('assets/css/main.css')?> " />
    <link rel="stylesheet" href=" <?= base_url('assets/css/login.css')?> " />
  </head>
  <style>
    body {
    background-image: url('<?= base_url('assets/images/logo/bg.jpeg') ?>');
    background-size: 100%;
    background-position: center;
    background-repeat: no-repeat;
}
  </style>
  <body>
  <div class="wrapper">
        <div class="logo">
            <img src="<?=  base_url('assets/images/logo/pangkalan.png') ?>" alt="">
        </div>
        <div class="text-center mt-4 name">
            SISTEM ABSENSI PEGAWAI
            SD NEGERI PANGKALAN
        </div>
        <!-- Alert kesalahan Login -->
        <?php if(!empty(session()->getFlashdata('pesan'))) :  ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php endif ?>
                  <!-- End Alert -->
                  <form method="POST" action="<?= base_url('login') ?>" class="p-3 mt-3">
                <!-- Username Field -->
                <div class="form-field d-flex flex-column mb-3">
                    <input type="text" id="username" class="<?= ($validation->hasError('username')) ? 'is-invalid' : '' ?> form-control" name="username" placeholder="username"/>
                    <div class="invalid-feedback">
                        <?= $validation->GetError('username') ?>
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="form-field d-flex flex-column mb-3">
                    <input type="password" id="password" class="<?= ($validation->hasError('password')) ? 'is-invalid' : '' ?> form-control" name="password" placeholder="Password"/>
                    <div class="invalid-feedback">
                        <?= $validation->GetError('password') ?>
                    </div>
                </div>
                
                <button class="btn mt-3">Login</button>
            </form>

                </div>

     

    <!-- ========= All Javascript files linkup ======== -->
    <script src=" <?= base_url('assets/js/bootstrap.bundle.min.js')?> "></script>
    <script src=" <?= base_url('assets/js/main.js')?> "></script>
  </body>
</html>
