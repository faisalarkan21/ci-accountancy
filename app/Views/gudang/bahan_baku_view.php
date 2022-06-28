<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Bahan Baku</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Bahan Baku</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Bahan Baku</strong></h3>
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
                                                data-target="#tambahModalBahan"><i class="fa fa-fw fa-folder-plus"></i>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="false">Daftar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab3" data-toggle="pill" href="#sisa" role="tab"
                                        aria-controls="home" aria-selected="false">Stok</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab2">
                                    <table id="daftarbahan" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Bahan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($databahanbaku as $row) : ?>
                                                <td> <?= $row['id_bahan'];?>
                                                </td>
                                                <td><?= $row['nama_bahan'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['harga'],0,',','.');?>
                                                </td>
                                                <td> <?= $row['satuan'];?>
                                                </td>
                                                <td><button type="button" data-toggle="modal" data-target="#editBahan"
                                                        id="btn-edit" class="btn btn-primary"
                                                        data-idbahan="<?= $row['id_bahan']; ?>"
                                                        data-stock="<?= $row['stock']; ?>"
                                                        data-harga="<?= $row['harga']; ?>"
                                                        data-satuan="<?= $row['satuan']; ?>">
                                                        Edit </button>
                                                    <button type="button" data-toggle="modal" data-target="#ModalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_bahan']; ?>">
                                                        Delete </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="sisa" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historybahan" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Bahan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Bahan Diminta Terakhir</th>
                                                <th scope="col">Tanggal Permintaan</th>
                                                <th scope="col">Stok Sisa</th>
                                                <th scope="col">Safety Stok</th>
                                                <th scope="col" width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark  bg-light">
                                            <tr>
                                                <?php foreach($databahansisa as $row) : ?>
                                                <td> <?= $row['id_bahan'];?>
                                                </td>
                                                <td><?= $row['nama_bahan'];?>
                                                </td>
                                                <td><?= $row['satuan'];?>
                                                </td>
                                                <td><?= $row['jmlh_permintaan'];?>
                                                </td>
                                                <td> <?= date_indo ($row['tgl_permintaan']);?>
                                                </td>
                                                <td><?= $row['stok_sisa'];?>
                                                </td>
                                                <td><?= $row['safety_stok'];?>
                                                </td>
                                                <?php if($row['stok_sisa'] < $row['safety_stok'] ):?>
                                                <td><a href="<?= base_url('gudang/pembelian_bahan_gudang') ?>"><button
                                                            type="button" class="btn btn-warning">
                                                            Beli </button></a>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalHapusSisa" id="btn-hapus-sisa"
                                                        class="btn btn-success ml-2" data-id="<?= $row['id']; ?>">
                                                        Delete </button>
                                                </td>
                                                <?php elseif($row['stok_sisa'] > $row['safety_stok'] ):?>
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalHapusSisa" id="btn-hapus-sisa"
                                                        class="btn btn-success" data-id="<?= $row['id']; ?>">
                                                        Delete </button>
                                                </td>
                                                <?php endif;?>
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

<form method="POST" action="<?= base_url('/gudang/bahan_baku') ?>">
    <div class="modal fade" id="tambahModalBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Bahan Baku</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_bahan" id="id_bahan"
                                    value="<?= $getidbahan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_bahan" id="nama_bahan">
                            </div>
                        </div>
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Stock</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="stock" id="stock">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Safety Stock</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="safety_stok" id="safety_stok">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga" id="harga">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" id="satuan">
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

<form method="POST" action="<?= base_url('/gudang/beli_bahan_baku') ?>">
    <div class="modal fade" id="BeliBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Beli Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Jumlah Bahan yang Dibeli</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="beli_bahan" id="beli_bahan">
                            </div>
                        </div>
                        <input type="hidden" id="stok_sisa" name="stok_sisa">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_sisa" name="id_sisa">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form method="POST" action="<?= base_url('gudang/edit_bahan_baku') ?>">
    <div class="modal fade" id="editBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Stock</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="stock" id="stock">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" id="satuan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga" id="harga">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_bahan" name="id_bahan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('gudang/delete_bahan_baku') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus Data Bahan Baku?
                        </h5>
                        <input type="hidden" id="id_bahan" name="id_bahan">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="ModalHapusSisa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('gudang/delete_sisa_bahan') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus Data Bahan Baku?
                        </h5>
                        <input type="hidden" id="id_sisa" name="id_sisa">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idbahan');
        var stk = $(this).data('stock');
        var sat = $(this).data('satuan');
        var hrg = $(this).data('harga');
        $('.modal-footer #id_bahan').val(id);
        $('.modal-body #stock').val(stk);
        $('.modal-body #satuan').val(sat);
        $('.modal-body #harga').val(hrg);
    })


    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_bahan').val($(this).data('id'));

    })

    $(document).on('click', '#btn-beli', function() {
        var idsisa = $(this).data('id');
        var sisa = $(this).data('stoksisa');
        $('.modal-footer #id_sisa').val(idsisa);
        $('.modal-body #stok_sisa').val(sisa);

    })

    $(document).on('click', '#btn-hapus-sisa', function() {
        $('.modal-body #id_sisa').val($(this).data('id'));

    })


})
</script>

<script>
$(document).ready(function() {
    $('#historybahan').DataTable({
        responsive: true
    });
    $('#daftarbahan').DataTable({
        responsive: true

    });



});
</script>

<?= $this->endSection();?>