<?= $this->extend("templates/main.php");?>

<?= $this->section('content');?>
<!-- Highchart JS File -->
<script src="<?= base_url() ?>/template/assets/highcharts/highcharts.js"></script>
<script src="<?= base_url() ?>/template/assets/highcharts/highcharts-3d.js"></script>
<script src="<?= base_url() ?>/template/assets/highcharts/exporting.js"></script>
<script src="<?= base_url() ?>/template/assets/highcharts/export-data.js"></script>
<script src="<?= base_url() ?>/template/assets/highcharts/accessibility.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Dashboard</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="text-dark">Master Data</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary ">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/aset')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Aset
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 " data-aos="zoom-in" data-aos-delay="400">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/beban_operasional')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Beban Operasional
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/utang')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Utang
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/produksi/coa')?>">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    COA
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-dark">Transaksi</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger ">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/pembelian_aset')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Pembelian Aset
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/pembayaran_operasional')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Pembayaran Operasional
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/manajemenkas/pembayaran_utang')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Pembayaran Utang
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap ">
                            <a href="<?= base_url('/manajemenkas/prive')?>">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    Prive
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-dark">Laporan</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="800"
                    data-aos-once="true" data-aos-anchor=".other-element">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning ">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/laporan/jurnal_umum')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Jurnal Umum
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="800"
                    data-aos-once="true" data-aos-anchor=".other-element">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/laporan/buku_besar')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Buku Besar
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="800"
                    data-aos-once="true" data-aos-anchor=".other-element">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <a href="<?= base_url('/laporan/laporan_perubahan_modal')?>">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    Perubahan Modal
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="800"
                    data-aos-once="true" data-aos-anchor=".other-element">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap ">
                            <a href="<?= base_url('/laporan/laporan_neraca')?>">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    Laporan Neraca
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection();?>