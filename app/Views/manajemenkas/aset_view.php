<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Aset</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Aset</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Aset</strong></h3>
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
                                            data-target="#tambahModalAset"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#aset" role="tab"
                                        aria-controls="home" aria-selected="true">Aset</a>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="aset" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Aset</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataAset as $row) : ?>
                                                <td> <?= $row['id_aset'];?>
                                                </td>
                                                <td><?= $row['nama_aset'];?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#EditAset" id="btn-edit"
                                                        data-idaset="<?= $row['id_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-totalaset="<?=  $row['tot_harga']; ?>"
                                                        data-upload="<?=  $row['upload_pembayaran']; ?>"
                                                        data-tglaset="<?= $row['tgl_beli']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailAset" id="btn-detail"
                                                        data-idaset="<?= $row['id_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-namatk="<?= $row['nama_toko']; ?>"
                                                        data-buktibayar="<?= $row['upload_pembayaran']; ?>"
                                                        data-totalaset="<?=  number_format($row['tot_harga'],0,',','.'); ?>"
                                                        data-tglaset="<?= date_indo ($row['tgl_beli']); ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_aset']; ?>">
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

<form method="POST" action="<?= base_url('/manajemenkas/aset') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalAset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_aset" id="id_aset"
                                    value="<?= $getidaset ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_aset" id="nama_aset">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Pembelian Aset</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_beli" name="tgl_beli"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nilai Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_harga" id="tot_harga">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Toko</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_toko" id="nama_toko">
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
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="upload_pembayaran"
                                    name="upload_pembayaran">
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

<form method="POST" action="<?= base_url('/manajemenkas/edit_aset') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="EditAset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
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
                        <div class="form-group row align-items-center ">
                            <label class="col-sm-4">Nama Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_aset" id="nama_aset">
                            </div>
                        </div>
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jml_aset" id="jml_aset">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nilai Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_harga" id="tot_harga">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Pembelian Aset</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_beli" name="tgl_beli"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="upload_pembayaran"
                                    name="upload_pembayaran">
                            </div>
                        </div>

                        <input type="hidden" id="uploads" name="uploads">
                        <input type="hidden" id="id_aset" name="id_aset">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="detailAset">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Aset</h5>
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
                                <th>ID Aset</th>
                                <td>: <span id="id_aset"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Aset</th>
                                <td>: <span id="nama_aset"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Beli</th>
                                <td>: <span id="tgl_beli"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Toko</th>
                                <td>: <span id="nama_toko"></span></td>
                            </tr>
                            <tr>
                                <th>Nilai Aset</th>
                                <td>: Rp. <span id="tot_harga"></span></td>
                            </tr>
                            <tr>
                                <th>Upload Bukti Pembayaran</th>

                                <td>: <img src="" width="300" height="150" id="upload_gambar"></img> </td>
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


<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_aset') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data aset?</h5>
                        <input type="hidden" id="id_aset" name="id_aset">
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
    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idaset');
        var nama = $(this).data('namaaset');
        var total = $(this).data('totalaset');
        var tgl = $(this).data('tglaset');
        var ket = $(this).data('keterangan');
        var toko = $(this).data('namatk');
        var bukti = $(this).data('buktibayar');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-aset/"
        $('.table #id_aset').text(id);
        $('.table #nama_aset').text(nama);
        $('.table #tot_harga').text(total);
        $('.table #tgl_beli').text(tgl);
        $('.table #keterangan').text(ket);
        $('.table #nama_toko').text(toko);
        $('.table #upload_gambar').attr('src', base_url + bukti);

    })

    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idaset');
        var nama = $(this).data('namaaset');
        var total = $(this).data('totalaset');
        var tgl = $(this).data('tglaset');
        var ket = $(this).data('keterangan');
        var toko = $(this).data('namatk');
        var bukti = $(this).data('buktibayar');
        var up = $(this).data('upload');
        $('.modal-body #id_aset').val(id);
        $('.modal-body #nama_aset').val(nama);
        $('.modal-body #tot_harga').val(total);
        $('.modal-body #tgl_beli').val(tgl);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #uploads').val(up);

    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_aset').val($(this).data('id'));

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