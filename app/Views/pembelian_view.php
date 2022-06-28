<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Pembelian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Persediaan Barang</a></div>
                <div class="breadcrumb-item">Pembelian</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-warning">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f9e8a0;">
                                <strong class="text-dark">Pembelian Belum Dibayar (dalam IDR) </strong>
                            </div>
                            <div class="card-body">
                                Rp.0,0
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-danger">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f8c9c4;">
                                <strong class="text-dark">Pembelian Jatuh Tempo (dalam IDR)</strong>
                            </div>
                            <div class="card-body">
                                Rp.0,0
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-success">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #c7e6c7;">
                                <strong class="text-dark">Pelunasan Dibayar 30 Hari Terakhir (dalam IDR)</strong>
                            </div>
                            <div class="card-body">
                                Rp.0,0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Data Transaksi Pembelian</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#tentang"
                                            role="tab" aria-controls="home" aria-selected="true">Faktur Pembelian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                            role="tab" aria-controls="profile" aria-selected="false">Pemesanan
                                            Pembelian</a>
                                    </li>
                                </ul>
                                <div class="tab-content " id="myTab3Content">
                                    <div class="tab-pane fade show active" id="tentang" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="table-secondary">
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Nomor</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Tgl Jatuh Tempo</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Sisa Tagihan<strong class="text-dark">(dalam
                                                            IDR)</strong></th>
                                                    <th scope="col">Total<strong class="text-dark">(dalam
                                                            IDR)</strong></th>
                                                    <th scope="col">Tags</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile2" role="tabpanel"
                                        aria-labelledby="profile-tab2">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="table-secondary">
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Nomor</th>
                                                    <th scope="col">Supplier</th>
                                                    <th scope="col">Tgl Jatuh Tempo</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Jumlah DP<strong class="text-dark">(dalam
                                                            IDR)</strong></th>
                                                    <th scope="col">Total<strong class="text-dark">(dalam
                                                            IDR)</strong></th>
                                                    <th scope="col">Tags</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-primary" href="<?= base_url('Pembelian/tambah_data')?>">
                                    Tambah
                                    Pembelian
                                    Baru<i class="fa fa-fw fa-folder-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<?= $this->endSection();?>