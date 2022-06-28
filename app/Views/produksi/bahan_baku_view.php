<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Bahan Baku</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
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
                                <!-- <div class="row justify-content-end">
                                    <div class="col-2">
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalBahanBaku"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Bahan Baku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">Stock Bahan Baku Siap Pakai</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="tabeldaftarbahan"
                                        class="table table-md table-bordered table-hover table-responsive-md text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Bahan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Harga Bahan</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($databahan as $row) : ?>
                                                <td> <?= $row['id_bahan'];?>
                                                </td>
                                                <td> <?= $row['nama_bahan'];?>
                                                </td>
                                                <td> <?= $row['quantity'];?>
                                                </td>
                                                <td> <?= $row['satuan'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['harga_bahan'],0,',','.');?>
                                                </td>
                                                <!-- <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editBahan" id="btn-edit"
                                                        data-idbahan="<?= $row['id_bahan']; ?>"
                                                        data-namabahan="<?= $row['nama_bahan']; ?>"
                                                        data-quantity="<?=$row['quantity']; ?>"
                                                        data-satuanbahan="<?=$row['satuan']; ?>"
                                                        data-hargabahan="<?=$row['harga_bahan']; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_bahan']; ?>"> Hapus </button>
                                                </td> -->
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historybahan"
                                        class="table table-md table-hover table-responsive-md table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Bahan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Bahan Pakai</th>
                                                <th scope="col">Sisa Stock</th>
                                                <th scope="col">Tanggal Ambil Stock</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorybahan as $row) : ?>
                                                <td> <?= $row['id_history_bahan'];?>
                                                </td>
                                                <td> <?= $row['nama_bahan'];?>
                                                </td>
                                                <td> <?= $row['quantity'];?>
                                                </td>
                                                <td> <?= $row['bahan_pakai'];?>
                                                </td>
                                                <td> <?= $row['sisa_stock'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_ambil_stock']);?>
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusHistory" id="btn-hapus-history"
                                                        class="btn btn-success" data-idhistory="<?= $row['id']; ?>">
                                                        Hapus
                                                    </button>
                                                </td> -->
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

<form method="POST" action="<?= base_url('produksi/edit_bahan_baku') ?>">
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
                        <div class="form-group row align-items-center mt-3">
                            <div class="">
                                <p class="text-danger col-sm-12 mt-2"> * Note silahkan masukan jumlah quantity yang
                                    ingin di
                                    tambah</P>
                            </div>
                            <label class="col-sm-4">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="quantity" id="quantity">
                            </div>

                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" id="satuan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_bahan" id="harga_bahan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_bahan" name="id_bahan">
                        <input type="hidden" id="nama_bahan" name="nama_bahan">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onClick="window.location.reload();">Close</button>
                        <button type="submit" class="btn btn-primary" name="update"> Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('produksi/bahan_baku') ?>">
    <div class="modal fade" id="tambahModalBahanBaku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <label class="col-sm-4">ID Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_bahan" id="id_bahan"
                                    value="<?= $getidbahanbaku?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_bahan" id="nama_bahan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="quantity" id="quantity">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" id="satuan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_bahan" id="harga_bahan">
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


<div class="modal fade" id="tambahModalHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/history_bahan_baku') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Tambah Data History Sisa Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_bahan" name="nama_bahan">
                                    <?php foreach($databahan as $row) : ?>
                                    <option value="<?=$row['nama_bahan'];?>"><?=$row['nama_bahan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Bahan Pakai</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="bahan_pakai" id="bahan_pakai">
                            </div>
                        </div>
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_bahan_baku') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Bahan Baku?</h5>
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

<div class="modal fade" id="modalHapusHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_history_bahan') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Sisa Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data History Sisa Bahan Baku?</h5>
                        <input type="hidden" id="id_history" name="id_history">
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
        var qty = $(this).data('quantity');
        var satuan = $(this).data('satuanbahan');
        var harga = $(this).data('hargabahan');
        var nama = $(this).data('namabahan');
        $('.modal-footer #id_bahan').val(id);
        $('.modal-footer #nama_bahan').val(nama);
        $('.modal-body #quantity').val(qty);
        $('.modal-body #satuan').val(satuan);
        $('.modal-body #harga_bahan').val(harga);
    })


    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_bahan').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-history', function() {
        $('.modal-body #id_history').val($(this).data('idhistory'));

    })

})
</script>

<script>
$(document).ready(function() {
    $('#tabeldaftarbahan').DataTable({
        responsive: true
    });
    $('#historybahan').DataTable({
        responsive: true
    });
});
</script>

<?= $this->endSection();?>