<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penerimaan Kas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_keuangan') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Penerimaan Kas</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Penerimaan Kas</strong></h3>
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
                                            data-target="#tambahModalPenerimaan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Penerimaan</a>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Penerimaan Kas</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Jenis Penerimaan</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light text-dark">
                                            <tr>
                                                <?php foreach($datapenerimaankas as $row) : ?>
                                                <td> <?= $row['id_penerimaan'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_penerimaan']);?>
                                                </td>
                                                <td> <?= $row['kategori'];?>
                                                </td>
                                                <td> <?= $row['jenis_penerimaan'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editpenerimaan" id="btn-edit"
                                                        data-idpenerimaan="<?= $row['id_penerimaan']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_penerimaan']; ?>"> Delete </button>
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
                                                        Rp. <?= number_format($totalpenerimaan['total'],0,',','.'); ?>
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

<form method="POST" action="<?= base_url('keuangan/penerimaan_kas') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Penerimaan Kas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Penerimaan Kas</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_penerimaan" id="id_penerimaan"
                                    value="<?= $getidpenerimaan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Penerimaan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jenis_penerimaan" name="jenis_penerimaan">
                                    <?php foreach($datajenis as $row) : ?>
                                    <option value="<?=$row['jenis_penerimaan'];?>"><?=$row['jenis_penerimaan'];?>
                                    </option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Keterangan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="kategori" name="kategori">
                                    <?php foreach($datacoa as $row) : ?>
                                    <option value="<?=$row['nama_akun'];?>"><?=$row['nama_akun'];?>
                                    </option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="total" id="total">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
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
        </div>
    </div>
</form>


<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('keuangan/delete_penerimaan_kas') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Penerimaan Kas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Penerimaan Kas?</h5>
                        <input type="hidden" id="id_penerimaan" name="id_penerimaan">
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

<form method="POST" action="<?= base_url('/keuangan/edit_penerimaan') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="editpenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Penerimaan Kas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-2">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                            <input type="hidden" id="uploads" name="uploads">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_penerimaan" name="id_penerimaan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_penerimaan').val($(this).data('id'));

    })

    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idpenerimaan');
        var bukti = $(this).data('buktibyr');
        $('.modal-footer #id_penerimaan').val(id);
        $('.modal-body #uploads').val(bukti);


    })

})
</script>

<script>
$(document).ready(function() {
    $('#daftartable').DataTable({
        responsive: true
    });


});
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


<?= $this->endSection();?>