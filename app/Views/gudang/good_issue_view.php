<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Good Issue</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Good Issue</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Good Issue</strong></h3>
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
                                    <!-- <div class="col-2">
                                        <div class="dropdown">
                                            <button class="btn btn-danger " data-toggle="modal"
                                                data-target="#tambahModalGood"><i class="fa fa-fw fa-folder-plus"></i>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active  " id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftargood"
                                        class="table table-responsive-sm table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID</th>
                                                <th scope="col">ID Permintaan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datagood as $row) : ?>
                                                <td> <?= $row['id_good'];?>
                                                </td>
                                                <td> <?= $row['id_permintaan'];?>
                                                </td>
                                                <td><?= $row['nama_bahan'];?>
                                                </td>
                                                <td><?= $row['quantity'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['harga'],0,',','.');?>
                                                </td>
                                                <td>Rp. <?= number_format($row['total'],0,',','.');?>
                                                </td>
                                                <td><button type="button" data-toggle="modal" data-target="#detailgood"
                                                        id="btn-detail" class="btn btn-primary"
                                                        data-idgood="<?= $row['id_good']; ?>"
                                                        data-idpermintaan="<?= $row['id_permintaan']; ?>"
                                                        data-namabahan="<?= $row['nama_bahan']; ?>"
                                                        data-quantity="<?= $row['quantity']; ?>"
                                                        data-harga="<?= number_format($row['harga'],0,',','.'); ?>"
                                                        data-total="<?= number_format($row['total'],0,',','.'); ?>"
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

<form method="POST" action="<?= base_url('gudang/good_issue') ?>">
    <div class="modal fade" id="tambahModalGood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Good Issue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Good Issue</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_good" id="id_good"
                                    value="<?= $idgood ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Permintaan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_permintaan" name="id_permintaan">
                                    <?php foreach($datapermintaan as $row) : ?>
                                    <option value="<?=$row['id_permintaan'];?>"> <?=$row['id_permintaan'];?></option>
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
                                <th>ID Good Issue</th>
                                <td>: <span id="id_good"></span></td>
                            </tr>
                            <tr>
                                <th>ID Permintaan</th>
                                <td>: <span id="id_permintaan"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Bahan</th>
                                <td>: <span id="nama_bahan"></span></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>: <span id="quantity"></span></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp. <span id="harga"></span></td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>: Rp. <span id="total"></span></td>
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
        var idgd = $(this).data('idgood');
        var idper = $(this).data('idpermintaan');
        var nama = $(this).data('namabahan');
        var qty = $(this).data('quantity');
        var hrg = $(this).data('harga');
        var tot = $(this).data('total');
        var tgl = $(this).data('tglpenerimaan');
        $('.modal-body #id_good').text(idgd);
        $('.modal-body #id_permintaan').text(idper);
        $('.modal-body #nama_bahan').text(nama);
        $('.modal-body #quantity').text(qty);
        $('.modal-body #harga').text(hrg);
        $('.modal-body #total').text(tot);
        $('.modal-body #tgl_penerimaan').text(tgl);
    })

})
</script>
<script>
$(document).ready(function() {
    $('#daftargood').DataTable({
        responsive: true

    });



});
</script>

<?= $this->endSection();?>