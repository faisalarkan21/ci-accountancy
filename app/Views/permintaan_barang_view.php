<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Permintaan Barang atau Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Produksi</a></div>
                <div class="breadcrumb-item">Permintaan Barang atau Bahan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-warning">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f9e8a0;">
                                <strong class="text-dark ">Perhitungan Kebutuhan Barang</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    <?php 
                                        $d=($datapermintaan->jmlh_brg_dibutuhkan);
                                        $k=($datapermintaan->b_pemesanan);
                                        $h=($datapermintaan->b_penyimpanan);
                                        echo round(sqrt(2*$d*$k/$h));
                                    ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-danger">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f8c9c4;">
                                <strong class="text-dark">Safety Stock</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    <?php 
                                        $maks=$datapermintaan->pem_maks;
                                        $min=$datapermintaan->pem_min;
                                        $lead=$datapermintaan->lead_time;
                                        echo $safety = ($maks-$min)*$lead." Hari";
                                    ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-success">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #c7e6c7;">
                                <strong class="text-dark">Reorder Point</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    <?php 
                                        echo $safety+$lead." Hari";
                                    ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Data Permintaan Barang</strong></h3>
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
                                            href="#kebutuhan-barang" role="tab" aria-controls="home"
                                            aria-selected="true">Perhitungan Kebutuhan Barang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab2" data-toggle="tab" href="#safety-stock"
                                            role="tab" aria-controls="profile" aria-selected="false">Safety Stock</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab3" data-toggle="tab" href="#rop" role="tab"
                                            aria-controls="home" aria-selected="false">Reorder Point</a>
                                    </li>

                                </ul>
                                <div class="tab-content " id="myTab3Content">
                                    <div class="tab-pane fade show active" id="kebutuhan-barang" role="tabpanel"
                                        aria-labelledby="home-tab1">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Jumlah Barang yang dibutuhkan
                                                    </th>
                                                    <th scope="col">Biaya Pemesanan</th>
                                                    <th scope="col">Biaya Penyimpanan
                                                    </th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> <?= $d=$datapermintaan->jmlh_brg_dibutuhkan;?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format($k=$datapermintaan->b_pemesanan,0,',','.');?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format($h=$datapermintaan->b_penyimpanan,0,',','.');?>
                                                    </td>
                                                    <td><?= round(sqrt(2*$d*$k/$h));?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="safety-stock" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Pemakaian Maksimum</th>
                                                    <th scope="col">Pemakaian Minimum</th>
                                                    <th scope="col">Lead Time</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= ($maks=$datapermintaan->pem_maks);?>
                                                        Hari
                                                    </td>
                                                    <td><?= ($min=$datapermintaan->pem_min);?>
                                                        Hari</td>
                                                    <td><?= ($lead=$datapermintaan->lead_time);?>
                                                        Hari</td>
                                                    </td>
                                                    <td><?= $safety = ($maks-$min)*$lead;?> Hari

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="rop" role="tabpanel" aria-labelledby="home-tab3">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">Lead time</th>
                                                    <th scope="col">Safety Stock</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $lead;?> Hari
                                                    </td>
                                                    <td><?= $safety;?> Hari
                                                    </td>
                                                    <td><?= $rop=$lead+$safety;?> Hari
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
                                    Tambah Data Permintaan Barang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<form method="POST" action="<?= base_url('produksi/permintaan_barang') ?>">
    <div class="modal fade" id="editModalCosting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Permintaan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body form">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center  mt-3">
                            <label class="col-sm-4">Jumlah Barang Yang Dibutuhkan</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jmlh_barang" id="jmlh_barang"
                                    placeholder="<?= number_format($datapermintaan->jmlh_brg_dibutuhkan,0,',','.');?>">
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Pemesanan</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="b_pemesanan" id="b_pemesanan"
                                    placeholder="<?= number_format($datapermintaan->b_pemesanan,0,',','.');?>">
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Penyimpanan</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="b_penyimpanan" id="b_penyimpanan"
                                    placeholder="<?= number_format($datapermintaan->b_penyimpanan,0,',','.');?>">
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4">Lead Time (Waktu Tunggu)</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="lead_time" id="lead_time"
                                    placeholder="<?= number_format($datapermintaan->lead_time,0,',','.');?>">
                            </div>
                            <div class="col-sm-2">Hari</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4">Pemakaian Minimum</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pem_min" id="pem_min"
                                    placeholder="<?= number_format($datapermintaan->pem_min,0,',','.');?>">
                            </div>
                            <div class="col-sm-2">Hari</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4">Pemakaian Maksimum</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pem_maks" id="pem_maks"
                                    placeholder="<?= number_format($datapermintaan->pem_maks,0,',','.');?>">
                            </div>
                            <div class="col-sm-2">Hari</div>
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
    </div>
</form>


<?= $this->endSection();?>