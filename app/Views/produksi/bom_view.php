<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data BOM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Bom</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Bom</strong></h3>
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

                                    <div class="">
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalBom"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data BOM
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#tambahModalBahan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Bahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <!-- <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Bom</a> -->
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarbom"
                                        class="table table-xl  table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Bom</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <?php foreach ($databom as $row) : ?>
                                            <tr class="text-center">
                                                <td>
                                                    <?= $row['id_bom']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['nama_product']; ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($databomall as $row2) : ?>
                                                    <?php if ($row2['id_bom'] == $row['id_bom']) : ?>
                                                    <p><?= $row2['nama_bahan']; ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($databomall as $row2) : ?>
                                                    <?php if ($row2['nama_bahan'] == "") : ?>
                                                    <?php elseif ($row2['nama_bahan'] != "") : ?>
                                                    <?php if ($row2['id_bom'] == $row['id_bom']) : ?>
                                                    <p><?= $row2['quantity']; ?></p>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailbom" id="btn-detail"
                                                        data-idbom="<?= $row['id_bom']; ?>"
                                                        data-namaproduk="<?= $row['nama_product']; ?>"
                                                        data-namabahan="<?php foreach ($databomall as $row2) : ?> <?php if ($row2['nama_bahan'] == "") : ?>
                                                    <?php elseif ($row2['nama_bahan'] != "") : ?><?php if ($row2['id_bom'] == $row['id_bom']) : ?><?= $row2['nama_bahan']; ?>,<?php endif; ?><?php endif; ?><?php endforeach; ?>"
                                                        data-quantity="<?php foreach ($databomall as $row2) : ?> <?php if ($row2['nama_bahan'] == "") : ?>
                                                    <?php elseif ($row2['nama_bahan'] != "") : ?><?php if ($row2['id_bom'] == $row['id_bom']) : ?><?= $row2['nama_bahan']; ?> = <?= $row2['quantity']; ?>, <?php endif; ?><?php endif; ?><?php endforeach; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#"
                                                        id="btn-hapus" class="btn btn-success mt-2"
                                                        data-id="<?= $row['id_bom']; ?>">
                                                        Hapus </button> -->
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
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


<form method="POST" action="<?= base_url('produksi/bom') ?>">
    <div class="modal fade" id="tambahModalBom" data-backdrop="static" tabindex="-1" role="dialog" aria-
        labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data BOM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary" id="calculation">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Bom</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_bom" id="id_bom"
                                    value="<?= $getidbom?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Produk</label>
                            <div class="col-sm-6">
                                <select type="text" class="form-control" name="nama_product" id="nama_product">
                                    <?php foreach($datarencana as $row) : ?>
                                    <option value="<?=$row['nama_produk'];?>"><?=$row['nama_produk'];?>
                                    </option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_bahan" name="id_bahan">
                                    <?php foreach($databahan as $row) : ?>
                                    <option value="<?=$row['id_bahan'];?>"><?=$row['nama_bahan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="quantity" id="quantity">
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

<form method="POST" action="<?= base_url('produksi/bahan_bom') ?>">
    <div class="modal fade" id="tambahModalBahan" data-backdrop="static" tabindex="-1" role="dialog" aria-
        labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Bahan BOM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary" id="calculation">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Bom</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_bom" name="id_bom">
                                    <?php foreach($selectidbom as $row) : ?>
                                    <option value="<?=$row['id_bom'];?>"><?=$row['id_bom'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_bahan" name="id_bahan">
                                    <?php foreach($databahan as $row) : ?>
                                    <option value="<?=$row['id_bahan'];?>"><?=$row['nama_bahan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="quantity" id="quantity">
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_bom') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete BOM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data BOM?</h5>
                        <input type="hidden" id="id_bom" name="id_bom">
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

<div class="modal fade" id="detailbom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail BOM</h5>
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
                                <th>ID BOM</th>
                                <td>: <span id="id_bom"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>: <span id="nama_product"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Bahan</th>
                                <td>: <span id="nama_bahan"></span></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>: <span id="quantity"></span>
                                </td>
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
        var id = $(this).data('idbom');
        var target = $(this).data('produksitarget');
        var nmbom = $(this).data('namabom');
        var nmproduk = $(this).data('namaproduk');
        var jenis = $(this).data('jenistk');
        var nmbahan = $(this).data('namabahan');
        var qty = $(this).data('quantity');
        var hrg = $(this).data('hargabahan');
        var total = $(this).data('biayabahan');
        var trf = $(this).data('biayatarif');
        var gaji = $(this).data('biayagaji');
        var tgl = $(this).data('tgltarget');
        $('.modal-body #id_bom').text(id);
        $('.modal-body #target_produksi').text(target);
        $('.modal-body #nama_bom').text(nmbom);
        $('.modal-body #nama_product').text(nmproduk);
        $('.modal-body #jenis_pekerjaan').text(jenis);
        $('.modal-body #nama_bahan').text(nmbahan);
        $('.modal-body #quantity').text(qty);
        $('.modal-body #harga').text(hrg);
        $('.modal-body #total_biaya_bahan').text(total);
        $('.modal-body #tarif').text(trf);
        $('.modal-body #biaya_gaji').text(gaji);
        $('.modal-body #tgl_target').text(tgl);
    })


    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_bom').val($(this).data('id'));

    })



})
</script>
<script>
$(document).ready(function() {
    $('#daftarbom').DataTable({
        responsive: true
    });

});
</script>


<?= $this->endSection();?>