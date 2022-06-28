<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Perhitungan Costing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Produksi</a></div>
                <div class="breadcrumb-item">Perhitungan Costing</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-warning">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f9e8a0;">
                                <strong class="text-dark">Biaya Tenaga Kerja</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    Rp.
                                    <?= number_format($c = ($datacosting->gaji) * ($datacosting->orang),0,',','.');?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-danger">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f8c9c4;">
                                <strong class="text-dark">Biaya Produksi</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    Rp.
                                    <?= number_format ($produksi =$c + ($datacosting->b_overhead) + ($datacosting->b_bahan_baku),0,',','.') ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-success">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #c7e6c7;">
                                <strong class="text-dark">Biaya Non Produksi</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    Rp.
                                    <?= number_format ($nonproduksi =$c + ($datacosting->b_admin_umum) + ($datacosting->b_pemasaran),0,',','.')?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-primary">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #ADCBF4;">
                                <strong class="text-dark">Total Harga Pokok Produksi</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    Rp. <?= number_format($produksi + $nonproduksi,0,',','.');?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Data Perhitungan Costing</strong></h3>
                    </div>
                    <?php 
                    if(isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors()?>
                    </div>
                    <?php endif;?>

                    <?php if(isset($error)): ?>
                    <div class='alert alert-danger'><?= $error;?></div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif;?>

                    <?php if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif;?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab1" data-toggle="tab"
                                            href="#biaya-tenaga-kerja" role="tab" aria-controls="home"
                                            aria-selected="true">Biaya Tenaga Kerja</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab2" data-toggle="tab" href="#biaya-produksi"
                                            role="tab" aria-controls="home" aria-selected="false">Biaya Produksi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab3" data-toggle="tab" href="#biaya-non-produksi"
                                            role="tab" aria-controls="profile" aria-selected="false">Biaya Non
                                            Produksi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab4" data-toggle="tab" href="#total-harga-pokok"
                                            role="tab" aria-controls="profile" aria-selected="false">Total Harga Pokok
                                            Produksi</a>
                                    </li>
                                </ul>
                                <div class="tab-content " id="myTab3Content">
                                    <div class="tab-pane fade show active" id="biaya-tenaga-kerja" role="tabpanel"
                                        aria-labelledby="home-tab1">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Gaji</th>
                                                    <th scope="col">Jumlah Orang</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rp. <?= number_format($datacosting->gaji,0,',','.');?></td>
                                                    <td><?= number_format($datacosting->orang,0,',','.');?></td>
                                                    <td>Rp.
                                                        <?= number_format($c = ($datacosting->gaji) * ($datacosting->orang),0,',','.');?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="biaya-produksi" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Biaya Bahan Baku</th>
                                                    <th scope="col">Biaya Tenaga Kerja</th>
                                                    <th scope="col">Biaya Overhead Pabrik </th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rp. <?= number_format($datacosting->b_bahan_baku,0,',','.');?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format($c,0,',','.');?>
                                                    </td>
                                                    <td>Rp. <?= number_format($datacosting->b_overhead,0,',','.');?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format ($produksi =$c + ($datacosting->b_overhead) + ($datacosting->b_bahan_baku),0,',','.') ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="biaya-non-produksi" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Biaya Administrasi Umum</th>
                                                    <th scope="col">Biaya Tenaga Kerja</th>
                                                    <th scope="col">Biaya Pemasaran</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rp. <?= number_format($datacosting->b_admin_umum,0,',','.');?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format($c,0,',','.');?></td>
                                                    <td>Rp. <?= number_format($datacosting->b_pemasaran,0,',','.');?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format ($nonproduksi =$c + ($datacosting->b_admin_umum) + ($datacosting->b_pemasaran),0,',','.')?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="total-harga-pokok" role="tabpanel"
                                        aria-labelledby="home-tab4">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Biaya Produksi</th>
                                                    <th scope="col">Biaya Non Produksi</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rp. <?= number_format($produksi,0,',','.');?></td>
                                                    <td>Rp. <?= number_format($nonproduksi,0,',','.');?></td>
                                                    <td>Rp. <?= number_format($produksi + $nonproduksi,0,',','.');?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModalCosting"><i
                                        class="fa fa-fw fa-folder-plus"></i>
                                    Tambah Data Perhitungan Costing</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<form method="POST" action="<?= base_url('produksi/perhitungan_costing') ?>">
    <div class="modal fade" id="editModalCosting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Costing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Gaji</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="gaji" id="gaji"
                                    placeholder="<?= number_format($datacosting->gaji,0,',','.');?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Orang</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="orang" id="orang"
                                    placeholder="<?= number_format($datacosting->orang,0,',','.');?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Overhead Pabrik</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="overhead" id="overhead"
                                    placeholder="<?= number_format($datacosting->b_overhead,0,',','.');?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Administrasi Umum</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="administrasi" id="administrasi"
                                    placeholder="<?= number_format($datacosting->b_admin_umum,0,',','.');?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Pemasaran</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pemasaran" id="pemasaran"
                                    placeholder="<?= number_format($datacosting->b_pemasaran,0,',','.');?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?= $this->endSection();?>