<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Good Receipt</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Good Receipt</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Good Receipt</strong></h3>
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
                                <div class="row justify-content-end">
                                    <div class="col-2">
                                        <div class="dropdown">
                                            <button class="btn btn-danger " data-toggle="modal"
                                                data-target="#tambahModalGood"><i class="fa fa-fw fa-folder-plus"></i>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active  " id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active bg-light" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table class="table table-responsive-sm table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID</th>
                                                <th scope="col">ID Pembelian</th>
                                                <th scope="col">Nama Vendor</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach($datareceipt as $row) : ?>
                                                <td> <?= $row['id_receipt'];?>
                                                </td>
                                                <td><?= $row['id_pembelian'];?>
                                                </td>
                                                <td><?= $row['nama_vendor'];?>
                                                </td>
                                                <td><button type="button" data-toggle="modal" data-target="#detailgood"
                                                        id="btn-detail" class="btn btn-primary"
                                                        data-idreceipt="<?= $row['id_receipt']; ?>"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-namavendor="<?= $row['nama_vendor']; ?>"
                                                        data-tglpenerimaan="<?= date_indo($row['tgl_penerimaan']); ?>">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form method="POST" action="<?= base_url('gudang/good_receipt') ?>">
    <div class="modal fade" id="tambahModalGood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Good Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Good Receipt</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_receipt" id="id_receipt"
                                    value="<?= $idreceipt ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Pembelian</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_pembelian" name="id_pembelian">
                                    <?php foreach($idpembelian as $row) : ?>
                                    <option value="<?=$row['id_pembelian'];?>"> <?=$row['id_pembelian'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="detailgood">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Good Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onClick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card card-primary">
                    <table class="table  no-margin">
                        <tbody>
                            <tr>
                                <th>ID Good Receipt</th>
                                <td>: <span id="id_receipt"></span></td>
                            </tr>
                            <tr>
                                <th>ID Pembelian</th>
                                <td>: <span id="id_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Vendor</th>
                                <td>: <span id="nama_vendor"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penerimaan</th>
                                <td>: <span id="tgl_penerimaan"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $(document).on('click', '#btn-detail', function() {
        var idrc = $(this).data('idreceipt');
        var idpem = $(this).data('idpembelian');
        var nama = $(this).data('namavendor');
        var tgl = $(this).data('tglpenerimaan');
        $('.modal-body #id_receipt').text(idrc);
        $('.modal-body #id_pembelian').text(idpem);
        $('.modal-body #nama_vendor').text(nama);
        $('.modal-body #tgl_penerimaan').text(tgl);
    })

})
</script>

<?= $this->endSection();?>