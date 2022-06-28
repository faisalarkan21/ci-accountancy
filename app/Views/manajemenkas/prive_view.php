<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Prive</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Prive</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Prive</strong></h3>
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
                                            data-target="#tambahModalPrive"><i class="fa fa-fw fa-folder-plus"></i>
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
                                <div class="tab-pane fade show active " id="aset" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Prive</th>
                                                <th scope="col">Tanggal Prive</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataprive as$row) : ?>
                                                <td> <?= $row['id_prive'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_prive']);?>
                                                </td>
                                                <td>Rp. <?= number_format($row['jmlh_prive'],0,',','.');?>
                                                </td>
                                                <td> <?= $row['keterangan'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editPrive" id="btn-edit"
                                                        data-idPrive="<?= $row['id_prive']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>"
                                                        data-keterangan="<?=$row['keterangan']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#detailprive" id="btn-detail"
                                                        data-idprive="<?= $row['id_prive']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>"
                                                        data-jmlhprive="<?= number_format($row['jmlh_prive'],0,',','.'); ?>"
                                                        data-tglprive="<?= date_indo($row['tgl_prive']); ?>"
                                                        data-keterangan="<?=$row['keterangan']; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_prive']; ?>">
                                                        Delete </button> -->
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

<form method="POST" action="<?= base_url('/manajemenkas/edit_prive') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="editPrive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Prive</h5>
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
                            <input type="hidden" id="keterangan" name="keterangan">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_prive" name="id_prive">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('/manajemenkas/prive') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalPrive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Prive</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Prive</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_prive" id="id_prive"
                                    value="<?= $getidprive?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Keterangan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="keterangan" name="keterangan">
                                    <?php foreach($datacoa as $row) : ?>
                                    <option value="<?=$row['nama_akun'];?>"><?=$row['nama_akun'];?>
                                    </option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Prive</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_prive" name="tgl_prive"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Prive</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_prive" id="jmlh_prive">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
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
            <form action="<?= base_url('manajemenkas/delete_prive') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Prive</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data prive?</h5>
                        <input type="hidden" id="id_prive" name="id_prive">
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

<div class="modal fade" id="detailprive">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Prive</h5>
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
                                <th>ID Prive</th>
                                <td>: <span id="id_prive"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Prive</th>
                                <td>: <span id="tgl_prive"></span></td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>: Rp. <span id="jmlh_prive"></span></td>
                            </tr>
                            <tr>
                                <th>Upload Bukti Pembayaran</th>
                                <td>: <img src="" width="300" height="150" id="bukti_bayar"></img></td>
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
    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idprive');
        var ket = $(this).data('keterangan');
        var bukti = $(this).data('buktibyr');
        $('.modal-footer #id_prive').val(id);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #uploads').val(bukti);


    })

    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idprive');
        var ket = $(this).data('keterangan');
        var bukti = $(this).data('buktibyr');
        var jmlh = $(this).data('jmlhprive');
        var tgl = $(this).data('tglprive');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-prive/"
        $('.modal-body #id_prive').text(id);
        $('.modal-body #keterangan').text(ket);
        $('.modal-body #jmlh_prive').text(jmlh);
        $('.modal-body #tgl_prive').text(tgl);
        $('.modal-body #bukti_bayar').attr('src', base_url + bukti);


    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_prive').val($(this).data('id'));

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