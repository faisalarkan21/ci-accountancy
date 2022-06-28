<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_admin') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Pelanggan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Pelanggan</strong></h3>
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
                                            data-target="#tambahModalCustomer"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Pelanggan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarcust"
                                        class="table table-hover table-responsive-lg table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Pelanggan</th>
                                                <th scope="col">Nama Pelanggan</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Nomor Telepon</th>
                                                <th scope="col">Email</th>
                                                <th scope="col" style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark  bg-light">
                                            <tr>
                                                <?php foreach($datacustomer as$row) : ?>
                                                <td> <?= $row['id_customer'];?>
                                                </td>
                                                <td> <?= $row['nama_customer'];?>
                                                </td>
                                                <td> <?= $row['alamat'];?>
                                                </td>
                                                <td> <?= $row['no_telp'];?>
                                                </td>
                                                <td> <?= $row['email'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editCustomer" id="btn-edit"
                                                        data-idcustomer="<?= $row['id_customer']; ?>"
                                                        data-namacustomer="<?= $row['nama_customer'];?>"
                                                        data-alamat="<?= $row['alamat'];?>"
                                                        data-notelp="<?= $row['no_telp'];?>"
                                                        data-email="<?= $row['email'];?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_customer']; ?>"> Delete </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade bg-light" id="history" role="tabpanel"
                                    aria-labelledby="home-tab2">
                                    <table class="table table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Retur</th>
                                                <th scope="col">Tanggal Retur</th>
                                                <th scope="col">ID Penjualan</th>
                                                <th scope="col">Tanggal Penjualan</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Retur</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                </td>
                                            </tr>
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

<form method="POST" action="<?= base_url('/admin/edit_customer') ?>">
    <div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Pelanggan</h5>
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
                            <label class="col-sm-4">Nama Pelanggan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_customer" id="nama_customer">
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
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_customer" name="id_customer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('admin/customer') ?>">
    <div class="modal fade" id="tambahModalCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Pelanggan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_customer" id="id_customer"
                                    value="<?= $getidcustomer?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Pelanggan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_customer" id="nama_customer">
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
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email">
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
            <form action="<?= base_url('admin/delete_customer') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data pelanggan?</h5>
                        <input type="hidden" id="id_customer" name="id_customer">
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
        var id = $(this).data('idcustomer');
        var nama = $(this).data('namacustomer');
        var alamat = $(this).data('alamat');
        var notelp = $(this).data('notelp');
        var email = $(this).data('email');
        $('.modal-footer #id_customer').val(id);
        $('.modal-body #nama_customer').val(nama);
        $('.modal-body #alamat').val(alamat);
        $('.modal-body #no_telp').val(notelp);
        $('.modal-body #email').val(email);


    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_customer').val($(this).data('id'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('#daftarcust').DataTable({
        responsive: true
    });


});
</script>

<?= $this->endSection();?>