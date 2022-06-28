<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_admin') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Barang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Barang</strong></h3>
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
                                            data-target="#tambahModalProduct"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Barang Siap Jual
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab3" data-toggle="pill" href="#daftarsiapjual"
                                        role="tab" aria-controls="home" aria-selected="false">Daftar Barang Siap
                                        Jual</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">Barang Terjual</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarbrg"
                                        class="table table-hover table-responsive-sm table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Stok</th>
                                                <th scope="col">Harga Dasar</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataproduct as$row) : ?>
                                                <td> <?= $row['id_barang'];?>
                                                </td>
                                                <td> <?= $row['nama_barang'];?>
                                                </td>
                                                <td> <?= $row['jmlh_barang'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['harga_barang'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editProduct" id="btn-edit"
                                                        data-idbarang="<?= $row['id_barang']; ?>"
                                                        data-namabarang="<?= $row['nama_barang']; ?>"
                                                        data-hargabarang="<?= $row['harga_barang']; ?>"
                                                        data-jmlhbarang="<?=$row['jmlh_barang']; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_barang']; ?>"> Delete </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-end">
                                        <table id="" class="table table-hover table-borderless text-left col-5 mr-3">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th scope="col">Total</th>
                                                    <th scope="col" class="text-right">
                                                        <?= $datatotalbarang['jmlh_barang']; ?>
                                                    </th>
                                                </tr>

                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="daftarsiapjual" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <table id="daftarbrgsiap"
                                        class="table table-md table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Merchant</th>
                                                <th scope="col">Stock Merchant</th>
                                                <th scope="col">Harga Jual</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <?php foreach($dataproductSiap as$row) : ?>
                                            <tr>
                                                <td> <?= $row['id_barang_siap'];?>
                                                </td>
                                                <td> <?= $row['nama_barang'];?>
                                                </td>
                                                <td> <?= $row['merchant'];?>
                                                </td>
                                                <td> <?= $row['jmlh_barang'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['harga_barang'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modalEditSiap" id="btn-edit-siap"
                                                        class="btn btn-primary"
                                                        data-idsiap="<?= $row['id_barang_siap']; ?>"
                                                        data-hargasiap="<?= number_format($row['harga_barang'],0,',','.'); ?>">
                                                        Edit </button>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modalHapussiap" id="btn-hapus-siap"
                                                        class="btn btn-success"
                                                        data-idsiap="<?= $row['id_barang_siap']; ?>"> Delete </button>
                                                </td>

                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="daftarbrgjual"
                                        class="table table-md table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary ">
                                                <th scope="col">ID Penjualan</th>
                                                <th scope="col">Tanggal Penjualan</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Nama Merchant</th>
                                                <th scope="col">Stock Barang</th>
                                                <th scope="col">Barang Terjual</th>
                                                <th scope="col">Total Sisa Stock</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <?php foreach($dataproductTerjual as$row) : ?>
                                            <tr>
                                                <td> <?= $row['id_penjualan'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_penjualan']);?>
                                                </td>
                                                <td> <?= $row['nama_barang'];?>
                                                </td>
                                                <td> <?= $row['nama_merchant'];?>
                                                </td>
                                                <td> <?= $row['stock_barang'];?>
                                                </td>
                                                <td> <?= $row['jmlh_barang'];?>
                                                </td>
                                                <td><?= $row['sisa_stock'];?>
                                                </td>

                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-end">
                                        <table class="table table-hover table-borderless text-left col-5 mr-3">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th scope="col">Total</th>
                                                    <th scope="col" class="text-right">
                                                        <?= $datatotalbarangterjual['jmlh_barang']; ?>
                                                    </th>
                                                </tr>

                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form method="POST" action="<?= base_url('/admin/edit_product') ?>">
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Harga Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_barang" id="harga_barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_barang" name="id_barang">
                    <input type="hidden" id="nama_barang" name="nama_barang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('/admin/edit_barang_siap') ?>">
    <div class="modal fade" id="modalEditSiap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Barang Siap Jual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Harga Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_barang_siap" id="harga_barang_siap">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_barang_siap" name="id_barang_siap">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('/admin/product') ?>">
    <div class="modal fade" id="tambahModalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Barang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_barang" name="nama_barang">
                                    <?php foreach($dataproduct as $row) : ?>
                                    <option value="<?=$row['nama_barang'];?>">
                                        <?=$row['nama_barang'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Merchant</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_merchant" name="nama_merchant">
                                    <?php foreach($datamerchant as $row) : ?>
                                    <option value="<?=$row['nama_merchant'];?>">
                                        <?=$row['nama_merchant'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_barang" id="jmlh_barang">
                            </div>
                        </div>
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_barang" id="harga_barang">
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/delete_product') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data barang?</h5>
                        <input type="hidden" id="id_barang" name="id_barang">
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

<div class="modal fade" id="modalHapussiap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/delete_siap') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Barang Siap Jual</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data barang siap jual?</h5>
                        <input type="hidden" id="id_barang_siap" name="id_barang_siap">
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
        var id = $(this).data('idbarang');
        var jmlh = $(this).data('jmlhbarang');
        var nama = $(this).data('namabarang');
        var harga = $(this).data('hargabarang');
        $('.modal-footer #id_barang').val(id);
        $('.modal-footer #nama_barang').val(nama);
        $('.modal-body #jmlh_barang').val(jmlh);
        $('.modal-body #harga_barang').val(harga);


    })

    $(document).on('click', '#btn-edit-siap', function() {
        var id = $(this).data('idsiap');
        var hrg = $(this).data('hargasiap');
        $('.modal-footer #id_barang_siap').val(id);
        $('.modal-body #harga_barang_siap').val(hrg);


    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_barang').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-siap', function() {
        $('.modal-body #id_barang_siap').val($(this).data('idsiap'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('#daftarbrg').DataTable({
        responsive: true
    });
    $('#daftarbrgsiap').DataTable({
        responsive: true
    });
    $('#daftarbrgjual').DataTable({
        responsive: true
    });

});
</script>

<?= $this->endSection();?>