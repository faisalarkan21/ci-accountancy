<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login Akuntan Digital</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/bootstrap-4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="<?= base_url('template') ?>/assets/img/stisla-fill.svg" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Selamat Datang di <span
                                class="font-weight-bold">Akuntan Digital</span></h4>
                        <p class="text-muted">Sebelum mulai, anda harus login terlebih dahulu atau jika belum mempunyai
                            akun harap registrasi terlebih dahulu</p>
                        <form method="POST" class="needs-validation" novalidate="">
                            <?php 
            if(isset($validation)): ?>
                            <div class="alert alert-danger">
                                <?= $validation->listErrors()?>
                            </div>
                            <?php endif;?>

                            <?php if(isset($error)): ?>
                            <div class='alert alert-danger'><?= $error;?></div>
                            <?php endif; ?>

                            <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                            <?php endif;?>

                            <?php if(session()->getFlashdata('Succes')):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('Succes') ?></div>
                            <?php endif;?>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username"
                                    value="<?= set_value('username');?>" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan Isi Username Anda
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan Isi Password Anda
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <a href="<?= base_url('/login/forgot_password')?>" class="float-left mt-3">
                                    Lupa Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>

                            <div class="mt-5 text-center">
                                Tidak Punya Akun? <a href="<?= base_url('/register')?>">Buat di Sini</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="<?= base_url('template') ?>/assets/img/Wallpaper.jpg">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-2 pb-3">
                                <h3 class="mb-2 display-4 font-weight-bold">Akuntan Digital Company</h3>
                                <h5 class="font-weight-normal text-muted-transparent">Kami hadir untuk membantu anda
                                    dalam membuat laporan keuangan perusahaan dengan menerapkan ilmu akuntansi dalam
                                    proses managing keuangan</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="<?= base_url('template') ?>/assets/js/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="<?= base_url('template') ?>/assets/js/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('template') ?>/assets/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/moment.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url('template') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/custom.js"></script>
    <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
    </script>

    <!-- Page Specific JS File -->
</body>

</html>