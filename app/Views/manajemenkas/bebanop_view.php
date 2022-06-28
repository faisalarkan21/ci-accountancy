<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Beban Operasional</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Beban Operasional</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Beban Operasional</strong></h3>
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
                                            data-target="#tambahModalBeban"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#aset" role="tab"
                                        aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="aset" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="asetTable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Beban</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataBebanop as$row) : ?>
                                                <td> <?= $row['id_bebanop'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['tot_harga_beban'],0,',','.');?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#EditBeban" id="btn-edit"
                                                        data-idbeban="<?= $row['id_bebanop']; ?>"
                                                        data-tglbayar="<?= $row['tgl_bayar']; ?>"
                                                        data-totalbeban="<?=$row['tot_harga_beban']; ?>"
                                                        data-jenisbeban="<?= $row['jenis_beban']; ?>"
                                                        data-buktibyr="<?= $row['upload_pembayaran']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailBeban" id="btn-detail"
                                                        data-idbeban="<?= $row['id_bebanop']; ?>"
                                                        data-jenisbeban="<?= $row['jenis_beban']; ?>"
                                                        data-tglbayar="<?= date_indo ($row['tgl_bayar']); ?>"
                                                        data-totalbeban="<?= number_format($row['tot_harga_beban'],0,',','.'); ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-buktibyr="<?= $row['upload_pembayaran']; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_bebanop']; ?>"> Delete </button> -->
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

<form method="POST" action="<?= base_url('/manajemenkas/beban_operasional') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalBeban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Beban Operasional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Beban</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_bebanop" id="id_bebanop"
                                    value="<?= $getidbebanop ?>" readonly>
                            </div>
                        </div>
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
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Beban Operasional</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_bayar" name="tgl_bayar"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Beban</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jenis_beban" name="jenis_beban">
                                    <?php foreach($datajenisbeban as $row) : ?>
                                    <option value="<?=$row['jenis_beban'];?>"><?=$row['jenis_beban'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Total Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_harga_beban" id="tot_harga_beban">
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

<form method="POST" action="<?= base_url('/manajemenkas/edit_beban_operasional') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="EditBeban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Beban Operasional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Tanggal Beban Operasional</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_bayar" name="tgl_bayar"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Beban</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jenis_beban" name="jenis_beban">
                                    <?php foreach($datajenisbeban as $row) : ?>
                                    <option value="<?=$row['jenis_beban'];?>"><?=$row['jenis_beban'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Total Harga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_harga_beban" id="tot_harga_beban">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Keterangan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="keterangan" id="keterangan">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="upload_pembayaran"
                                    name="upload_pembayaran">
                            </div>
                        </div>
                        <input type="hidden" id="id_bebanop" name="id_bebanop">
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

<div class="modal fade" id="detailBeban">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Beban Operasional</h5>
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
                                <th>ID Beban OP</th>
                                <td>: <span id="id_beban"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Jenis Beban</th>
                                <td>: <span id="jenis_beban"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Bayar</th>
                                <td>: <span id="tgl_bayar"></span></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>: Rp. <span id="total_beban"></span></td>
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
            <form action="<?= base_url('manajemenkas/delete_bebanop') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data beban operasional?</h5>
                        <input type="hidden" id="id_bebanop" name="id_bebanop">
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
        var id = $(this).data('idbeban');
        var tgl = $(this).data('tglbayar');
        var total = $(this).data('totalbeban');
        var ket = $(this).data('keterangan');
        var jenis = $(this).data('jenisbeban');
        var bukti = $(this).data('buktibyr');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-op/"
        $('.table #id_beban').text(id);
        $('.table #tgl_bayar').text(tgl);
        $('.table #total_beban').text(total);
        $('.table #keterangan').text(ket);
        $('.table #jenis_beban').text(jenis);
        $('.table #upload_gambar').attr('src', base_url + bukti);

    })
    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idbeban');
        var tgl = $(this).data('tglbayar');
        var total = $(this).data('totalbeban');
        var ket = $(this).data('keterangan');
        var jenis = $(this).data('jenisbeban');
        var bukti = $(this).data('buktibyr');
        $('.modal-body #id_bebanop').val(id);
        $('.modal-body #tgl_bayar').val(tgl);
        $('.modal-body #tot_harga_beban').val(total);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #jenis_beban').val(jenis);
        $('.modal-body #uploads').val(bukti);

    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_bebanop').val($(this).data('id'));

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