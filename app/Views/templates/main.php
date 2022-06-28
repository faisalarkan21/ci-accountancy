<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Digital Akuntansi Aplication</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/bootstrap-4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/node_modules/bootstrap-social/bootstrap-social.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/highcharts/highcharts.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/aos.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">


    <script src="<?= base_url('template') ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/aos.js"></script>



</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <!-- <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> -->
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <?php if($userdata->profil_pic != ''):?>
                            <img alt="image" src='<?= ($userdata->profil_pic);?>' class="rounded-circle mr-1">
                            <?php else:?>
                            <img alt="image" src='<?= base_url('template')?>/assets/img/avatar/avatar-1.png'
                                class="rounded-circle mr-1">
                            <?php endif;?>
                            <div class="d-sm-none d-lg-inline-block"><?= ucfirst($userdata->nama);?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">CV Saudara Mulya Bersama</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">CV SMB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <!-- ROLE PRODUKSI -->
                        <?php if($userdata->role == 'produksi'):?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_produksi')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'coa' || current_url(true)->getSegment(4) == 'tenaga_kerja' 
                            || current_url(true)->getSegment(4) == 'edit_tenaga_kerja'|| current_url(true)->getSegment(4) == 'edit_coa'
                            || current_url(true)->getSegment(4) == 'bahan_baku'|| current_url(true)->getSegment(4) == 'edit_bahan_baku'
                            || current_url(true)->getSegment(4) == 'bom'|| current_url(true)->getSegment(4) == 'edit_bom'
                            || current_url(true)->getSegment(4) == 'detail_produksi'|| current_url(true)->getSegment(4) == 'edit_detail_produksi'
                            || current_url(true)->getSegment(4) == 'jadwal_produksi'|| current_url(true)->getSegment(4) == 'edit_jadwal'
                            || current_url(true)->getSegment(4) == 'rencana_produksi'
                            || current_url(true)->getSegment(4) == 'overhead'|| current_url(true)->getSegment(4) == 'edit_overhead'
                            || current_url(true)->getSegment(4) == 'produk_jadi'|| current_url(true)->getSegment(4) == 'edit_produk_jadi'
                            || current_url(true)->getSegment(4) == 'operation_list'|| current_url(true)->getSegment(4) == 'edit_operation_list'
                             ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'coa' || current_url(true)->getSegment(4) == 'edit_coa'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/coa')?>">COA</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'tenaga_kerja'|| current_url(true)->getSegment(4) == 'edit_tenaga_kerja'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/tenaga_kerja')?>">Tenaga
                                        Kerja</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'bahan_baku'|| current_url(true)->getSegment(4) == 'edit_bahan_baku'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/bahan_baku')?>">Bahan
                                        Baku</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'bom'|| current_url(true)->getSegment(4) == 'edit_bom'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/bom')?>">BOM</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'detail_produksi'|| current_url(true)->getSegment(4) == 'edit_detail_produksi'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/detail_produksi')?>">Produksi
                                        Detail</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'rencana_produksi'|| current_url(true)->getSegment(4) == 'edit_jadwal'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/rencana_produksi')?>">Rencana
                                        Produksi</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jadwal_produksi'|| current_url(true)->getSegment(4) == 'edit_jadwal'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/jadwal_produksi')?>">Jadwal
                                        Produksi</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'overhead'|| current_url(true)->getSegment(4) == 'edit_overhead'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/overhead')?>">Overhead</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'produk_jadi'|| current_url(true)->getSegment(4) == 'edit_produk_jadi'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/produk_jadi')?>">Produk
                                        Jadi</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'operation_list'|| current_url(true)->getSegment(4) == 'edit_operation_list'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/operation_list')?>">Operation
                                        List</a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'biaya_bahan' || current_url(true)->getSegment(4) == 'biaya_produksi' 
                            || current_url(true)->getSegment(4) == 'biaya_overhead'|| current_url(true)->getSegment(4) == 'biaya_tenaga_kerja'
                            || current_url(true)->getSegment(4) == 'permintaan_bahan'
                            || current_url(true)->getSegment(4) == 'permintaan_bahan'
                             ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'biaya_bahan'? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/biaya_bahan')?>">Biaya
                                        Bahan</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'biaya_tenaga_kerja' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/biaya_tenaga_kerja')?>">Biaya
                                        Tenaga Kerja</a>
                                </li>
                                <li <?=current_url(true)->getSegment(4) == 'biaya_overhead' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/biaya_overhead')?>">Biaya
                                        Overhead</a>
                                </li>
                                <li <?=current_url(true)->getSegment(4) == 'biaya_produksi'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/biaya_produksi')?>">Biaya
                                        Produksi</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'permintaan_bahan'|| current_url(true)->getSegment(4) == ''  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/produksi/permintaan_bahan')?>">Permintaan
                                        Bahan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown  <?=current_url(true)->getSegment(4) == 'jurnal_umum_produksi'|| current_url(true)->getSegment(4) == 'buku_besar_produksi'
                        || current_url(true)->getSegment(4) == 'laporan_hpp_produksi'  
                        || current_url(true)->getSegment(4) == 'laporan_laba_rugi'  
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                                <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_hpp_produksi'   ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_hpp_produksi')?>">Laporan
                                        HPP</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jurnal_umum_produksi'   ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/jurnal_umum_produksi')?>">Jurnal
                                        Umum</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'buku_besar_produksi'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/buku_besar_produksi')?>">Buku
                                        Besar</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_laba_rugi'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_laba_rugi')?>">Laba
                                        Rugi</a>
                                </li>
                            </ul>
                        </li>

                        <!-- ROLE KEUANGAN -->
                        <?php elseif($userdata->role == 'keuangan'):?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_keuangan')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'coa' || current_url(true)->getSegment(4) == 'jenis_penerimaan'
                            || current_url(true)->getSegment(4) == '' ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'coa'  ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/produksi/coa')?>">COA</a>
                                </li>
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jenis_penerimaan'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/keuangan/jenis_penerimaan')?>">Jenis
                                        Penerimaan</a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item dropdown
                            <?=current_url(true)->getSegment(4) == 'penerimaan_kas' || current_url(true)->getSegment(4) == ''? 'active' : '' ?> ">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'penerimaan_kas' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/keuangan/penerimaan_kas')?>">Penerimaan
                                        Kas</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown  <?=current_url(true)->getSegment(4) == 'jurnal_umum_keuangan' 
                        || current_url(true)->getSegment(4) == 'buku_besar_keuangan'
                        || current_url(true)->getSegment(4) == 'laporan_arus_kas' 
                        || current_url(true)->getSegment(4) == 'jurnal_penerimaan_kas'  
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                                <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jurnal_umum_keuangan'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/jurnal_umum_keuangan')?>">Jurnal
                                        Umum</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'buku_besar_keuangan'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/buku_besar_keuangan')?>">Buku
                                        Besar</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_arus_kas'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_arus_kas')?>">Laporan Arus
                                        Kas</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jurnal_penerimaan_kas' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/jurnal_penerimaan_kas')?>">Jurnal
                                        Penerimaan Kas</a>
                                </li>
                            </ul>
                        </li>

                        <!-- ROLE ADMIN -->
                        <?php elseif($userdata->role == 'admin'):?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_admin')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'product' || current_url(true)->getSegment(4) == 'edit_product'
                            || current_url(true)->getSegment(4) == 'customer'|| current_url(true)->getSegment(4) == 'ekspedisi' 
                            || current_url(true)->getSegment(4) == 'merchant'|| current_url(true)->getSegment(4) == 'edit_customer'
                            || current_url(true)->getSegment(4) == 'edit_ekspedisi' || current_url(true)->getSegment(4) == 'edit_merchant'  
                            ? 'active' : '' ?> ">

                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'product'|| current_url(true)->getSegment(4) == 'edit_product' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/admin/product')?>">Barang</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'customer'|| current_url(true)->getSegment(4) == 'edit_customer' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/admin/customer')?>">Pelanggan</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'ekspedisi' || current_url(true)->getSegment(4) == 'edit_ekspedisi' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/admin/ekspedisi')?>">Ekspedisi</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'merchant' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/admin/merchant')?>">Merchant</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'penjualan'  
                            ? 'active' : '' ?> ">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'penjualan' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/admin/penjualan')?>">Penjualan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown  <?= current_url(true)->getSegment(4) == 'laporan_penjualan' 
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                                <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_penjualan'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_penjualan')?>">Laporan
                                        Penjualan</a>
                                </li>
                            </ul>

                        </li>

                        <!-- ROLE MANAJEMENKAS -->
                        <?php elseif($userdata->role == 'manajemenkas'):?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_manajemenkas ')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown
                            <?=current_url(true)->getSegment(4) == 'coa' || current_url(true)->getSegment(4) == 'aset' || current_url(true)->getSegment(4) == 'beban_operasional'
                            || current_url(true)->getSegment(4) == 'utang' || current_url(true)->getSegment(4) == 'jenis_beban' || current_url(true)->getSegment(4) == 'jenis_utang' || current_url(true)->getSegment(4) == 'delete_aset'
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'coa' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/produksi/coa')?>">COA</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'aset' || current_url(true)->getSegment(4) == 'delete_aset' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/manajemenkas/aset')?>">Aset</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'beban_operasional' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/manajemenkas/beban_operasional')?>">Beban
                                        Operasional</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'utang' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/manajemenkas/utang')?>">Utang</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'jenis_beban' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/manajemenkas/jenis_beban')?>">Jenis
                                        Beban</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'jenis_utang' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/manajemenkas/jenis_utang')?>">Jenis
                                        Utang</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown
                            <?=current_url(true)->getSegment(4) == 'pembelian_aset' || current_url(true)->getSegment(4) == 'pembayaran_operasional' || current_url(true)->getSegment(4) == 'pembayaran_utang'
                            || current_url(true)->getSegment(4) == 'prive'
                            || current_url(true)->getSegment(4) == 'proses_perbulan' ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'pembelian_aset' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/manajemenkas/pembelian_aset')?>">Pembelian
                                        Aset</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'pembayaran_operasional' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/manajemenkas/pembayaran_operasional')?>">Pembayaran
                                        Operasional</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'pembayaran_utang' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/manajemenkas/pembayaran_utang')?>">Pembayaran
                                        Utang</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'prive' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/manajemenkas/prive')?>">Prive</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'proses_perbulan' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/manajemenkas/proses_perbulan')?>">Proses Perbulan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown  <?=current_url(true)->getSegment(4) == 'jurnal_umum_mankas'  || current_url(true)->getSegment(4) == 'buku_besar_mankas'
                        || current_url(true)->getSegment(4) == 'laporan_perubahan_modal'
                        || current_url(true)->getSegment(4) == 'laporan_neraca'
                        || current_url(true)->getSegment(4) == 'laporan_pengeluaran_kas'
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                                <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jurnal_umum_mankas' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/jurnal_umum_mankas')?>">Jurnal
                                        Umum</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_pengeluaran_kas'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_pengeluaran_kas')?>">Laporan
                                        Pengeluaran Kas </a>
                                </li>

                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'buku_besar_mankas'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/buku_besar_mankas')?>">Buku
                                        Besar</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_perubahan_modal'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_perubahan_modal')?>">Laporan
                                        Perubahan Modal</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'laporan_neraca'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_neraca')?>">Laporan
                                        Neraca</a>
                                </li>
                            </ul>

                        </li>

                        <!-- ROLE GUDANG -->
                        <?php elseif($userdata->role == 'gudang'):?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_gudang ')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li class="nav-item dropdown
                            <?=current_url(true)->getSegment(4) == 'coa' || current_url(true)->getSegment(4) == 'bahan_baku' 
                            || current_url(true)->getSegment(4) == 'edit_bahan_baku' || current_url(true)->getSegment(4) == 'beli_bahan_baku' 
                         ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'coa' ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/produksi/coa')?>">COA</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'bahan_baku' || current_url(true)->getSegment(4) == 'edit_bahan_baku' 
                                || current_url(true)->getSegment(4) == 'beli_bahan_baku'  ? 'class="active"' : '' ?>><a
                                        class="nav-link active" href="<?= base_url('/gudang/bahan_baku')?>">Bahan
                                        Baku</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'permintaan_bahan_gudang'
                            || current_url(true)->getSegment(4) == 'good_issue'|| current_url(true)->getSegment(4) == 'good_receipt'
                            || current_url(true)->getSegment(4) == 'eoq' || current_url(true)->getSegment(4) == 'pembelian_bahan_gudang'
                              ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'permintaan_bahan_gudang' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/gudang/permintaan_bahan_gudang')?>">Permintaan Bahan</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'pembelian_bahan_gudang' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active"
                                        href="<?= base_url('/gudang/pembelian_bahan_gudang')?>">Pembelian Bahan</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'eoq' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/gudang/eoq')?>">EOQ</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'good_issue' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/gudang/good_issue')?>">Good
                                        Issue</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'good_receipt' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/gudang/good_receipt')?>">Good
                                        Receipt</a>
                                </li>
                            </ul>
                        </li>



                        <!-- ROLE PEMBELIAN -->
                        <?php else:?>
                        <li class="menu-header">Dashboard</li>
                        <li
                            <?=current_url(true)->getSegment(3) == 'dashboard' || current_url(true)->getSegment(3) == '' ? 'class="active"' : '' ?>>
                            <a href="<?= base_url('dashboard/dashboard_pembelian ')?>" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        </li>
                        <li class="menu-header">Menu</li>
                        <li
                            class="nav-item dropdown <?= current_url(true)->getSegment(4) == 'vendor'|| current_url(true)->getSegment(4) == 'prive' ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Data</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'vendor' ? 'class="active"' : '' ?>>
                                    <a class="nav-link active" href="<?= base_url('/pembelian/vendor')?>">Vendor</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item dropdown <?=current_url(true)->getSegment(4) == 'pembelian_bahan' || current_url(true)->getSegment(4) == 'prive' ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li <?=current_url(true)->getSegment(4) == 'pembelian_bahan' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('/pembelian/pembelian_bahan')?>">Pembelian
                                        Bahan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown  <?=current_url(true)->getSegment(4) == 'jurnal_umum'  || current_url(true)->getSegment(4) == 'buku_besar_pembelian'
                        || current_url(true)->getSegment(4) == 'laporan_arus_kas'
                        || current_url(true)->getSegment(4) == 'laporan_pembelian'
                        || current_url(true)->getSegment(4) == 'jurnal_umum_pembelian'
                            ? 'active' : '' ?>">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                                <span>Laporan</span></a>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_pembelian' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_pembelian')?>">Laporan
                                        Pembelian</a>
                                </li>
                            </ul>
                            <!-- <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'laporan_arus_kas' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/laporan_arus_kas')?>">Laporan Arus
                                        Kas</a>
                                </li>
                            </ul> -->
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'jurnal_umum_pembelian' || current_url(true)->getSegment(4) == 'edit_merchant' ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/jurnal_umum_pembelian')?>">Jurnal
                                        Umum</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li
                                    <?=current_url(true)->getSegment(4) == 'buku_besar_pembelian'  ? 'class="active"' : '' ?>>
                                    <a class="nav-link" href="<?= base_url('laporan/buku_besar_pembelian')?>">Buku
                                        Besar</a>
                                </li>
                            </ul>
                        </li>
                        <?php endif;?>


                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a href="<?= base_url()?>/dashboard/logout"
                                class="btn btn-danger btn-lg btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>

                </aside>
            </div>

            <!-- Main Content -->

            <?= $this->renderSection("content");?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021 <div class="bullet"></div> Design By <a href="#">Akuntan Digital Company</a>
                </div>
                <div class="footer-right">
                    Version 1.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('template') ?>/assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('template') ?>/assets/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.nicescroll.min.js">
    </script>
    <script src="<?= base_url('template') ?>/assets/js/moment.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <!-- <script src="<?= base_url('template') ?>/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url('template') ?>/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->

    <!-- Template JS File -->
    <script src="<?= base_url('template') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url('template') ?>/assets/js/page/index-0.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/page/modules-chartjs.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/chart.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/chart.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/page/bootstrap-modal.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/locales/bootstrap-datepicker.id.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

    <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
    </script>
    <script>
    AOS.init();
    </script>




</body>

</html>