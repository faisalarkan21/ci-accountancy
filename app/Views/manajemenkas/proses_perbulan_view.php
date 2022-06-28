<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Proses Pembayaran Per bulan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Proses Pembayaran Per bulan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Proses Pembayaran Per bulan</strong></h3>
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
                                            data-target="#tambahdataprosespemb"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Proses Pembelian
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active  " id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Proses</a>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Proses</th>
                                                <th scope="col">Nama Proses</th>
                                                <th scope="col">Nilai Proses</th>
                                                <th scope="col">Tgl Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataproses as $row) : ?>
                                                <td> <?= $row['id_proses'];?>
                                                </td>
                                                <td><?= $row['nama_proses'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['jmlh_proses'],0,',','.');?>
                                                </td>
                                                <td> <?= date_indo ($row['tgl_proses']);?>
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

<form method="POST" action="<?= base_url('manajemenkas/proses_perbulan') ?>">
    <div class="modal fade" id="tambahdataprosespemb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pembelian Per bulan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Pilih Bulan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="bln_jurnal" name="bln_jurnal">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Pilih Tahun</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="thn_history" name="thn_history">
                                    <?php foreach($tahunhistory as $row) : ?>
                                    <?php if($row['tahun']== '0') : ?>
                                    <a></a>
                                    <?php else: ?>
                                    <option value="<?=$row['tahun'];?>">
                                        <?=$row['tahun'];?></option>
                                    <?php endif; ?>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


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