<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Utang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Utang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Utang</strong></h3>
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
                                            data-target="#tambahModalUtang"><i class="fa fa-fw fa-folder-plus"></i>
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
                                                <th scope="col">ID Utang</th>
                                                <th scope="col">Total Utang</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataUtang as$row) : ?>
                                                <td> <?= $row['id_utang'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['tot_utang'],0,',','.');?>
                                                </td>
                                                <td><?= $row['ket_utang'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#EditUtang" id="btn-edits"
                                                        data-idutang="<?= $row['id_utang']; ?>"
                                                        data-tglbayar="<?= $row['tgl_bayar']; ?>"
                                                        data-jenisutang="<?= $row['jenis_utang']; ?>"
                                                        data-totalutang="<?= $row['tot_utang']; ?>"
                                                        data-keterangan="<?= $row['ket_utang']; ?>"
                                                        data-buktibayar="<?= $row['upload_pembayaran']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailUtang" id="btn-detail"
                                                        data-idutang="<?= $row['id_utang']; ?>"
                                                        data-jenisutang="<?= $row['jenis_utang']; ?>"
                                                        data-buktibayar="<?= $row['upload_pembayaran']; ?>"
                                                        data-tglbayar="<?= date_indo ($row['tgl_bayar']); ?>"
                                                        data-tgllunas="<?= date_indo ($row['tgl_lunas']); ?>"
                                                        data-totalutang="<?= number_format($row['tot_utang'],0,',','.'); ?>"
                                                        data-keterangan="<?= $row['ket_utang']; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_utang']; ?>">
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


<form method="POST" action="<?= base_url('/manajemenkas/edit_utang') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="EditUtang" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Utang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div>
                        <input type="hidden" id="id_utang" name="id_utang">
                        <input type="hidden" id="uploads" name="uploads">
                        <input type="hidden" id="keterangan" name="keterangan">
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


<form method="POST" action="<?= base_url('/manajemenkas/utang') ?>">
    <div class="modal fade" id="tambahModalUtang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Utang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Utang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_utang" id="id_utang"
                                    value="<?= $getidutang ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Penagihan</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_bayar" name="tgl_bayar"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Pelunasan</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_lunas" name="tgl_lunas"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Pembayaran Utang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_history" name="id_history">
                                    <?php foreach($datahistorypembayaran as $row) : ?>
                                    <option value="<?=$row['id_pembayaranut'];?>"><?=$row['id_pembayaranut'];?></option>
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

<div class="modal fade" id="detailUtang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Utang</h5>
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
                                <th>ID Utang</th>
                                <td>: <span id="id_utang"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Jenis Utang</th>
                                <td>: <span id="jenis_utang"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penagihan</th>
                                <td>: <span id="tgl_bayar"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pelunasan</th>
                                <td>: <span id="tgl_lunas"></span></td>
                            </tr>
                            <tr>
                                <th>Total Utang</th>
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


<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_utang') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Utang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data utang?</h5>
                        <input type="hidden" id="id_utang" name="id_utang">
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
        var id = $(this).data('idutang');
        var tgl = $(this).data('tglbayar');
        var tgllun = $(this).data('tgllunas');
        var total = $(this).data('totalutang');
        var ket = $(this).data('keterangan');
        var jenis = $(this).data('jenisutang');
        var bukti = $(this).data('buktibayar');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-utang/"
        $('.table #id_utang').text(id);
        $('.table #tgl_bayar').text(tgl);
        $('.table #tgl_lunas').text(tgllun);
        $('.table #total_utang').text(total);
        $('.table #keterangan').text(ket);
        $('.table #jenis_utang').text(jenis);
        $('.table #upload_gambar').attr('src', base_url + bukti);

    })

    $(document).on('click', '#btn-edits', function() {
        var id = $(this).data('idutang');
        var tgl = $(this).data('tglbayar');
        var total = $(this).data('totalutang');
        var ket = $(this).data('keterangan');
        var jenis = $(this).data('jenisutang');
        var bukti = $(this).data('buktibayar');
        $('.modal-body #id_utang').val(id);
        $('.modal-body #tgl_bayar').val(tgl);
        $('.modal-body #tot_utang').val(total);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #jenis_utang').val(jenis);
        $('.modal-body #uploads').val(bukti);

    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_utang').val($(this).data('id'));

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