<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Akun</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                        <div class="login-brand">
                            <img src="<?= base_url ('template') ?> /assets/img/stisla-fill.svg" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Daftar Akun Baru</h4>
                            </div>
                            <?php if(isset($validation)):?>
                            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                            <?php endif;?>
                            <div class="card-body">
                                <form action="<?= base_url('register/save') ?>" method="POST">
                                    <div class="form-group">
                                        <div class="card-header">
                                            <h4>Data akun </h4>
                                        </div>
                                        <label for="nama">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Username</label>
                                        <input id="usename" type="text" class="form-control" name="username">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength"
                                            data-indicator="pwindicator" name="password">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confpassword" class="d-block">Ketik Ulang Password</label>
                                        <input id="confpassword" type="password" class="form-control"
                                            name="confpassword">
                                    </div>

                                    <div class="card-header">
                                        <h4>Role / Job Desk </h4>
                                    </div>
                                    <div class="form-group">
                                        <select id="role" name="role" class="browser-default custom-select">
                                            <option value="admin" selected>Admin</option>
                                            <option value="produksi">Produksi</option>
                                            <option value="pembelian">Pembelian</option>
                                            <option value="manajemenkas">Manajemen Kas</option>
                                            <option value="keuangan">Keuangan</option>
                                            <option value="gudang">Gudang</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            <h6>Register</h6>
                                        </button>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <a class="btn btn-primary btn-lg btn-block" href="<?= base_url('login')?>">
                                        <h6>Kembali ke Halaman Login</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; 2021
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
    <script src="<?= base_url('template') ?>/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url('template') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url('template') ?>/assets/js/page/auth-register.js"></script>
    <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
    </script>
</body>

</html>