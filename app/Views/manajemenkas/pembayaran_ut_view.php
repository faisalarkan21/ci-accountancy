<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran Utang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Pembayaran Utang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Pembayaran Utang</strong></h3>
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
                                        <div class="dropdown">
                                            <button class="btn btn-danger " data-toggle="modal"
                                                data-target="#tambahModalPembayaranUt"><i
                                                    class="fa fa-fw fa-folder-plus"></i>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active  " id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">History</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Pembayaran</th>
                                                <th scope="col">Total Harga Utang</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datapembayaranut as $row) : ?>
                                                <td> <?= $row['id_pembayaranut'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_harga_utang'],0,',','.');?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td><button type="button" data-toggle="modal" data-target="#modalBayar"
                                                        id="btn-bayar" class="btn btn-warning"
                                                        data-idpembayaran="<?= $row['id_pembayaranut']; ?>"
                                                        data-jenisutang="<?= $row['jenis_utang']; ?>"
                                                        data-ket="<?= $row['keterangan']; ?>"
                                                        data-tgl="<?= $row['tgl_utang']; ?>"
                                                        data-buktibayar="<?= $row['bukti_bayar']; ?>"
                                                        data-total="<?= $row['tot_harga_utang']; ?>"> Bayar </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#EditPembayaran" id="btn-edit"
                                                        data-idpembayaran="<?= $row['id_pembayaranut']; ?>"
                                                        data-jenisutang="<?= $row['jenis_utang']; ?>"
                                                        data-ket="<?= $row['keterangan']; ?>"
                                                        data-tgl="<?= $row['tgl_utang']; ?>"
                                                        data-kategori="<?= $row['kategori']; ?>"
                                                        data-upload="<?= $row['bukti_bayar']; ?>"
                                                        data-total="<?=  $row['tot_harga_utang']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailut" id="btn-detail"
                                                        data-idpembayaran="<?= $row['id_pembayaranut']; ?>"
                                                        data-jenisutang="<?= $row['jenis_utang']; ?>"
                                                        data-ket="<?= $row['keterangan']; ?>"
                                                        data-buktibayar="<?= $row['bukti_bayar']; ?>"
                                                        data-tgl="<?= date_indo ($row['tgl_utang']); ?>"
                                                        data-total="<?=  number_format($row['tot_harga_utang'],0,',','.'); ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusPembayaran" id="btn-hapus-bayar"
                                                        class="btn btn-success"
                                                        data-id="<?= $row['id_pembayaranut']; ?>"> Delete </button> -->
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historytable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Pembayaran</th>
                                                <th scope="col">Tanggal Utang</th>
                                                <th scope="col">Total Harga Utang</th>
                                                <th scope="col">Tanggal Pembayaran</th>
                                                <th scope="col">Jenis Utang</th>
                                                <th scope="col">Keterangan</th>
                                                <!-- <th scope="col">Bukti Pembayaran</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorypembayaran as $row) : ?>
                                                <td> <?= $row['id_pembayaranut'];?>
                                                </td>
                                                <td> <?= date_indo ($row['tgl_utang']);?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_harga_utang'],0,',','.');?>
                                                </td>
                                                <td><?= date_indo ($row['tgl_pembayaran']);?>
                                                </td>
                                                <td><?= $row['jenis_utang'];?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <!-- <td><button type="button" data-toggle="modal"
                                                        data-target="#modalHapusHistoryPembayaran"
                                                        id="btn-hapus-history" class="btn btn-success"
                                                        data-id="<?= $row['id']; ?>">
                                                        Delete </button>
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

<form method="POST" action="<?= base_url('/manajemenkas/pembayaran_utang') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalPembayaranUt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_pembayaranut" id="id_pembayaranut"
                                    value="<?= $getidhistoryutang?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Proses</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_proses" name="id_proses">
                                    <option value="">
                                    </option>
                                    <?php foreach($getidproses as $row) : ?>
                                    <option value="<?=$row['id_proses'];?>"><?=$row['id_proses'];?>
                                    </option>
                                    <?php endforeach;  ?>
                                </select>
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
                            <label class="col-sm-4">Jenis Utang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jenis_utang" name="jenis_utang">
                                    <?php foreach($datajenisutang as $row) : ?>
                                    <option value="<?=$row['jenis_utang'];?>"><?=$row['jenis_utang'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Penagihan</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_utang" name="tgl_utang"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Total Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_harga_utang" id="tot_harga_utang">
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

<form method="POST" action="<?= base_url('/manajemenkas/edit_pembayaran_utang') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="EditPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Penagihan</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_utang" name="tgl_utang"
                                        class="form-control">
                                </div>
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
                            <label class="col-sm-4">Jenis Utang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jenis_utang" name="jenis_utang">
                                    <?php foreach($datajenisutang as $row) : ?>
                                    <option value="<?=$row['jenis_utang'];?>"><?=$row['jenis_utang'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Total Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="total_utang" id="total_utang">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div>
                        <input type="hidden" name="id_pembayaranut" id="id_pembayaranut">
                        <input type="hidden" id="uploads" name="uploads">
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


<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/update_history_pembayaranut') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Pembayaran utang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Apakah data pembayaran sudah di konfirmasi?</h5>
                        <input type="hidden" id="id_pembayaranut" name="id_pembayaranut">
                        <input type="hidden" id="ket_pembayaran" name="ket_pembayaran">
                        <input type="hidden" id="tgl_utang" name="tgl_utang">
                        <input type="hidden" id="total_utang" name="total_utang">
                        <input type="hidden" id="bukti_bayar" name="bukti_bayar">
                        <input type="hidden" id="jenis_utang" name="jenis_utang">
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

<div class="modal fade" id="modalHapusPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_pembayaranut') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data Pembayaran Utang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus, apakah data pembayaran sudah di konfirmasi?
                        </h5>
                        <input type="hidden" id="id_pembayaranut" name="id_pembayaranut">

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

<div class="modal fade" id="modalHapusHistoryPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_historyut') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data History Pembayaran Utang
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus, apakah data pembayaran sudah di konfirmasi?
                        </h5>
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

<div class="modal fade" id="detailut">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Pembayaran Utang</h5>
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
                                <th>ID Pembayaran Utang</th>
                                <td>: <span id="id_pembayaranut"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="ket_pembayaran"></span></td>
                            </tr>
                            <tr>
                                <th>Jenis Utang</th>
                                <td>: <span id="jenis_utang"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penagihan</th>
                                <td>: <span id="tgl_utang"></span></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>: Rp. <span id="total_utang"></span></td>
                            </tr>
                            <tr>
                                <th>Upload Bukti Pembayaran</th>
                                <td>: <img src="" width="300" height="150" id="upload_gambar"></img></td>
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
    $(document).on('click', '#btn-bayar', function() {
        var id = $(this).data('idpembayaran');
        var keterangan = $(this).data('ket');
        var tgl_utang = $(this).data('tgl');
        var total_utang = $(this).data('total');
        var jenis = $(this).data('jenisutang');
        var bukti = $(this).data('buktibayar');
        $('.modal-body #id_pembayaranut').val(id);
        $('.modal-body #ket_pembayaran').val(keterangan);
        $('.modal-body #tgl_utang').val(tgl_utang);
        $('.modal-body #total_utang').val(total_utang);
        $('.modal-body #jenis_utang').val(jenis);
        $('.modal-body #bukti_bayar').val(bukti);
    })

    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idpembayaran');
        var keterangan = $(this).data('ket');
        var tgl_utang = $(this).data('tgl');
        var total_utang = $(this).data('total');
        var jenis = $(this).data('jenisutang');
        var up = $(this).data('upload');
        $('.modal-body #id_pembayaranut').val(id);
        $('.modal-body #ket_pembayaran').val(keterangan);
        $('.modal-body #tgl_utang').val(tgl_utang);
        $('.modal-body #total_utang').val(total_utang);
        $('.modal-body #jenis_utang').val(jenis);
        $('.modal-body #uploads').val(up);
    })

    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idpembayaran');
        var keterangan = $(this).data('ket');
        var tgl_utang = $(this).data('tgl');
        var total_utang = $(this).data('total');
        var jenis = $(this).data('jenisutang');
        var bukti = $(this).data('buktibayar');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-utang/"
        $('.modal-body #id_pembayaranut').text(id);
        $('.modal-body #ket_pembayaran').text(keterangan);
        $('.modal-body #tgl_utang').text(tgl_utang);
        $('.modal-body #total_utang').text(total_utang);
        $('.modal-body #jenis_utang').text(jenis);
        $('.table #upload_gambar').attr('src', base_url + bukti);
    })

    $(document).on('click', '#btn-hapus-bayar', function() {
        $('.modal-body #id_pembayaranut').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-history', function() {
        $('.modal-body #id_history').val($(this).data('id'));

    })

})
</script>

<script>
$(document).ready(function() {
    $('#historytable').DataTable({
        responsive: true
    });
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