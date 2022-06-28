<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Vendor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_pembelian') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Vendor</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Vendor</strong></h3>
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
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalVendor"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#aset"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="aset" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="asetTable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Vendor</th>
                                                <th scope="col">Nama Vendor</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Nomor Telepon</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datavendor as$row) : ?>
                                                <td> <?= $row['id_vendor'];?>
                                                </td>
                                                <td> <?= $row['nama_vendor'];?>
                                                </td>
                                                <td> <?= $row['alamat'];?>
                                                </td>
                                                <td> <?= $row['no_telp'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editVendor" id="btn-edit"
                                                        data-idvendor="<?= $row['id_vendor']; ?>"
                                                        data-alamatven="<?=$row['alamat']; ?>"
                                                        data-notelp="<?=$row['no_telp']; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_vendor']; ?>">
                                                        Delete </button>
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

<form method="POST" action="<?= base_url('/pembelian/edit_vendor') ?>">
    <div class="modal fade" id="editVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Alamat</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nomor Telepon</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="no_telp" id="no_telp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_vendor" name="id_vendor">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('/pembelian/vendor') ?>">
    <div class="modal fade" id="tambahModalVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Vendor</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_vendor" id="id_vendor"
                                    value="<?= $idvendor ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Vendor</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_vendor" id="nama_vendor">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Alamat</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nomor Telepon</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="no_telp" id="no_telp">
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
            <form action="<?= base_url('pembelian/delete_vendor') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Vendor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Vendor?</h5>
                        <input type="hidden" id="id_vendor" name="id_vendor">
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
        var id = $(this).data('idvendor');
        var alamat = $(this).data('alamatven');
        var telp = $(this).data('notelp');
        $('.modal-footer #id_vendor').val(id);
        $('.modal-body #alamat').val(alamat);
        $('.modal-body #no_telp').val(telp);


    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_vendor').val($(this).data('id'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('#asetTable').DataTable({
        responsive: true

    });



});
</script>

<?= $this->endSection();?>