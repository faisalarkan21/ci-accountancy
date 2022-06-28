<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Barang Tersedia</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Produksi</a></div>
                <div class="breadcrumb-item">Barang Tersedia</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-warning">
                        <div class="card-wrap">
                            <div class="card-header" style="background-color: #f9e8a0;">
                                <strong class="text-dark ">Banyak Jumlah Barang Tersedia</strong>
                            </div>
                            <div class="card-body">
                                <strong class="text-dark">
                                    <?= 
                                        $hitungjumlahbarang; 
                                        
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
                        <h3><strong class="text-dark">Data Barang Tersedia</strong></h3>
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
                                            aria-selected="true">Barang Tersedia</a>
                                    </li>
                                </ul>
                                <div class="tab-content " id="myTab3Content">
                                    <div class="tab-pane fade show active" id="kebutuhan-barang" role="tabpanel"
                                        aria-labelledby="home-tab1">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Harga Produksi</th>
                                                    <th scope="col">Jumlah Bahan Baku</th>
                                                    <th scope="col">Tanggal Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php $a = 1;?>
                                                    <?php foreach($datapersediaan as $row) : ?>
                                                    <td scope="row"><?= $a; ?></td>
                                                    <td> <?= $row['nama_barang'];?>
                                                    </td>
                                                    <td>Rp.
                                                        <?= number_format($row['harga_produksi'],0,',','.');?>
                                                    </td>
                                                    <td>
                                                        <?= $row['jmlh_bahan_baku'];?>
                                                    </td>
                                                    <td><?= date_indo($row['tgl_stock']) ?></td>
                                                </tr>
                                                <?php $a++;?>
                                                <?php endforeach;  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModalCosting"><i
                                        class="fa fa-fw fa-folder-plus"></i>
                                    Tambah Data Barang Tersedia</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<form method="POST" action="<?= base_url('produksi/barang_tersedia') ?>">
    <div class="modal fade" id="editModalCosting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Barang Tersedia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body form">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center  mt-3">
                            <label class="col-sm-4">Nama Barang</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga Produksi</label>
                            <div class="col-sm-2">Rp.</div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_produksi" id="harga_produksi"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Bahan Baku</label>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_bahan_baku" id="jmlh_bahan_baku"
                                    placeholder="">
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