<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

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
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= base_url('template') ?>/assets/img/stisla-fill.svg" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Reset Password</h4>
                            </div>
                            <?php 
            if(isset($validation)): ?>
                            <div class="alert alert-danger">
                                <?= $validation->listErrors()?>
                            </div>
                            <?php endif;?>

                            <?php if(session()->getFlashdata('Gagal')):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('Gagal') ?></div>
                            <?php endif;?>

                            <div class="card-body">
                                <?php if(isset($error)):?>
                                <div class='alert alert-danger'><?= $error;?></div>
                                <?php else: ?>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input id="pwd" type="password" class="form-control" name="pwd" tabindex="2"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input id="cpwd" type="password" class="form-control" name="cpwd" tabindex="2"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Reset Password
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <a class="btn btn-primary btn-lg btn-block" href="<?= base_url('login')?>">
                                            Batal ? Kembali ke halaman Login
                                        </a>
                                    </div>
                                </form>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Akuntan Digital Company 2021
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