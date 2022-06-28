<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Operation List</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Operation List</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Operation List</strong></h3>
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
                                            data-target="#tambahModalOperation"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#tambahModalJenisPekerjaan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Jenis Pekerjaan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Operation List</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable"
                                        class="table table-md table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Operation List</th>
                                                <th scope="col">Jenis Pekerjaan</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Quantity</th>
                                                <!-- <th scope="col">Waktu Pengerjaan</th> -->
                                                <!-- <th scope="col">Total Biaya Gaji</th> -->
                                                <!-- <th scope="col">Upload Bukti Bayar</th> -->
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataoperationlist as $row) : ?>
                                                <td> <?= $row['id_operation'];?>
                                                </td>
                                                <td>
                                                    <?php foreach ($dataoperationall as $row2) : ?>
                                                    <?php if ($row2['id_operation'] == $row['id_operation']) : ?>
                                                    <p><?= $row2['jenis_tenaga_kerja']; ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td> <?= $row['nama_produk'];?>
                                                </td>
                                                <td> <?= $row['quantity'];?>
                                                </td>
                                                <!-- <td> <?= $row['waktu_pengerjaan'];?> Hari
                                                </td> -->
                                                <!-- <td> Rp. <?= number_format($row['total_gaji'],0,',','.'); ?>
                                                </td> -->
                                                <!-- <td> <img
                                                        src="<?=base_url('template/assets/img/bukti-bayar-operation-list/'.$row['upload_pembayaran']); ?>"
                                                        width="100">
                                                </td> -->
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal" data-target="#deleteBiaya"
                                                        id="btn-delete" class="btn btn-success"
                                                        data-id="<?= $row['id_operation']; ?>"> Delete </button>
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


<form method="POST" action="<?= base_url('produksi/operation_list') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Operation List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Operation List</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_operation" id="id_operation"
                                    value="<?= $getidoperationlist?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Tenaga Kerja</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_tenaga_kerja" name="id_tenaga_kerja">
                                    <?php foreach($datatenagakerja as $row) : ?>
                                    <option value="<?=$row['id_tenaga_kerja'];?>"><?=$row['jenis_tenaga_kerja'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Produk</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_produk" name="nama_produk">
                                    <?php foreach($datarencana as $row) : ?>
                                    <option value="<?=$row['nama_produk'];?>"><?=$row['nama_produk'];?></option>
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
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Kategori</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="kategori" name="kategori">
                                    <?php foreach($datacoa as $row) : ?>
                                    <option value="<?=$row['kode_akun'];?>">
                                        <?=$row['kode_akun'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div> -->
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

<form method="POST" action="<?= base_url('produksi/operation_jenis_pekerjaan') ?>">
    <div class="modal fade" id="tambahModalJenisPekerjaan" data-backdrop="static" tabindex="-1" role="dialog" aria-
        labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Operation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary" id="calculation">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Operation</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_operation" name="id_operation">
                                    <?php foreach($selectidoperation as $row) : ?>
                                    <option value="<?=$row['id_operation'];?>"><?=$row['id_operation'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Tenaga Kerja</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_tenaga_kerja" name="id_tenaga_kerja">
                                    <?php foreach($datatenagakerja as $row) : ?>
                                    <option value="<?=$row['id_tenaga_kerja'];?>"><?=$row['jenis_tenaga_kerja'];?></option>
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

<div class="modal fade" id="deleteBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_operation_list') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Biaya Operation List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data Operation List?</h5>
                        <input type="hidden" id="id_operation" name="id_operation">
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

    $(document).on('click', '#btn-delete', function() {
        $('.modal-body #id_operation').val($(this).data(
            'id'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('.dropify').dropify({
        messages: {
            'default': 'Click Here !',
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('#daftartable').DataTable({
        responsive: true
    });


});
</script>

<?= $this->endSection();?>