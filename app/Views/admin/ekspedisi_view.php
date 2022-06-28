<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Ekspedisi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_admin') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Ekspedisi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Ekspedisi</strong></h3>
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
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#tambahModalEkspedisi"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Ekspedisi</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftareksp"
                                        class="table table-hover table-responsive-lg table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Ekspedisi</th>
                                                <th scope="col">Nama Ekspedisi</th>
                                                <th scope="col">Nomor Telepon</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataekspedisi as $row) : ?>
                                                <td> <?= $row['id_ekspedisi'];?>
                                                </td>
                                                <td> <?= $row['nama_ekspedisi'];?>
                                                </td>
                                                <td> <?= $row['no_telp'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editEkspedisi" id="btn-edit"
                                                        data-idekspedisi="<?= $row['id_ekspedisi']; ?>"
                                                        data-namaekspedisi="<?= $row['nama_ekspedisi'];?>"
                                                        data-notelp="<?= $row['no_telp'];?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_ekspedisi']; ?>"> Delete </button>
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

<form method="POST" action="<?= base_url('/admin/edit_ekspedisi') ?>">
    <div class="modal fade" id="editEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Ekspedisi</h5>
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
                            <label class="col-sm-4">Nama Ekspedisi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_ekspedisi" id="nama_ekspedisi">
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
                    <input type="hidden" id="id_ekspedisi" name="id_ekspedisi">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('admin/ekspedisi') ?>">
    <div class="modal fade" id="tambahModalEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Ekspedisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Ekspedisi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_ekspedisi" id="id_ekspedisi"
                                    value="<?= $getidekspedisi?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Ekspedisi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_ekspedisi" id="nama_ekspedisi">
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
            <form action="<?= base_url('admin/delete_ekspedisi') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Ekspedisi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data ekspedisi?</h5>
                        <input type="hidden" id="id_ekspedisi" name="id_ekspedisi">
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
        var id = $(this).data('idekspedisi');
        var nama = $(this).data('namaekspedisi');
        var notelp = $(this).data('notelp');
        $('.modal-footer #id_ekspedisi').val(id);
        $('.modal-body #nama_ekspedisi').val(nama);
        $('.modal-body #no_telp').val(notelp);

    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_ekspedisi').val($(this).data('id'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('#daftareksp').DataTable({
        responsive: true
    });


});
</script>

<?= $this->endSection();?>