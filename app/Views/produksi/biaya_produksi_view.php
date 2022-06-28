<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>
<script>
$(function() {
    $("#date").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        language: 'id'
    });
});
</script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Biaya Produksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Biaya Produksi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Biaya Produksi</strong></h3>
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
                                            data-target="#tambahModalBiayaProduksi"><i
                                                class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#prosesjurnal"><i class="fa fa-fw fa-folder-plus"></i>
                                            Proses Ke Jurnal
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">History</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable"
                                        class="table table-md table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Biaya Produksi</th>
                                                <th scope="col">Total Biaya Bahan</th>
                                                <th scope="col">Total Biaya Tenaga Kerja</th>
                                                <th scope="col">Total Biaya Overhead</th>
                                                <th scope="col">Total Biaya Produksi</th>
                                                <th scope="col">Status</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($databiayaproduksi as $row) : ?>
                                                <td> <?= $row['id_biaya_produksi'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_bahan'],0,',','.');?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_tenaga'],0,',','.');?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_overhead'],0,',','.'); ?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_produksi'],0,',','.'); ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#BayarBiaya" id="btn-bayar"
                                                        data-idproduksi="<?= $row['id_biaya_produksi']; ?>"
                                                        data-biayabahan="<?=$row['biaya_bahan']; ?>"
                                                        data-biayatenaga="<?=$row['biaya_tenaga']; ?>"
                                                        data-biayaoverhead="<?=$row['biaya_overhead']; ?>"
                                                        data-buktibyr="<?=$row['upload_pembayaran']; ?>"
                                                        data-kategoris="<?=$row['kategori']; ?>"
                                                        data-totalproduksi="<?=$row['total_produksi']; ?>">
                                                        Bayar
                                                    </button>
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal" data-target="#"
                                                        id="btn-delete-biaya" class="btn btn-danger"
                                                        data-id="<?= $row['id_biaya_produksi']; ?>"> Edit </button>
                                                    <button type="button" data-toggle="modal" data-target="#deleteBiaya"
                                                        id="btn-delete-biaya" class="btn btn-success"
                                                        data-id="<?= $row['id_biaya_produksi']; ?>"> Delete </button>
                                                </td> -->
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historytable"
                                        class="table table-md table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Biaya Produksi</th>
                                                <th scope="col">Total Biaya Bahan</th>
                                                <th scope="col">Total Biaya Tenaga Kerja</th>
                                                <th scope="col">Total Biaya Overhead</th>
                                                <th scope="col">Total Biaya Produksi</th>
                                                <th scope="col">Tanggal Pembayaran</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorybiayaproduksi as $row) : ?>
                                                <td> <?= $row['id_biaya_produksi'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_bahan'],0,',','.');?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_tenaga'],0,',','.');?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_overhead'],0,',','.'); ?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_produksi'],0,',','.'); ?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_pembayaran_produksi']);?>
                                                </td>
                                                <td> <?= $row['kategori'];?>
                                                </td>
                                                <td> <img
                                                        src="<?=base_url('template/assets/img/bukti-bayar-biaya-produksi/'.$row['upload_pembayaran']); ?>"
                                                        width="100">
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#deleteHistory" id="btn-delete-history"
                                                        class="btn btn-success" data-id="<?= $row['id']; ?>"> Delete
                                                    </button>
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


<form method="POST" action="<?= base_url('produksi/biaya_produksi') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalBiayaProduksi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Biaya Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Biaya Produksi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_biaya_produksi" id="id_biaya_produksi"
                                    value="<?= $getidbiayaproduksi?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Biaya Bahan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_biaya_bahan" name="id_biaya_bahan">
                                    <?php foreach($datahistorybiayabahan as $row) : ?>
                                    <option value="<?=$row['id_biaya_bahan'];?>">
                                        <?=$row['id_biaya_bahan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Biaya Tenaga Kerja</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_biaya_tenaga" name="id_biaya_tenaga">
                                    <?php foreach($datahistorytenagakerja as $row) : ?>
                                    <option value="<?=$row['id_biaya_tenaga'];?>">
                                        <?=$row['id_biaya_tenaga'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Biaya Overhead</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_biaya_overhead" name="id_biaya_overhead">
                                    <?php foreach($datahistorybiayoverhead as $row) : ?>
                                    <option value="<?=$row['id_biaya_overhead'];?>">
                                        <?=$row['id_biaya_overhead'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Kategori</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="kategori" name="kategori">
                                    <?php foreach($datacoa as $row) : ?>
                                    <option value="<?=$row['kode_akun'];?>">
                                        <?=$row['kode_akun'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-4">
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
                    <button type="submit" class="btn btn-primary" name="update">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('produksi/jurnal_persediaan_barang_jadi') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="prosesjurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Biaya Bahan Ke Jurnal Per Bulan
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
                                    <option value="<?=$row['tahun'];?>">
                                        <?=$row['tahun'];?></option>
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

<div class="modal fade" id="BayarBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/update_history_biaya_produksi') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Bayar Biaya Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin membayar
                            Biaya Produksi?</h5>
                        <input type="hidden" id="id_biaya_produksi" name="id_biaya_produksi">
                        <input type="hidden" id="biaya_bahan" name="biaya_bahan">
                        <input type="hidden" id="biaya_tenaga" name="biaya_tenaga">
                        <input type="hidden" id="biaya_overhead" name="biaya_overhead">
                        <input type="hidden" id="total_produksi" name="total_produksi">
                        <input type="hidden" id="upload_pembayaran" name="upload_pembayaran">
                        <input type="hidden" id="kategori_produksi" name="kategori_produksi">
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

<div class="modal fade" id="deleteBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_biaya_produksi') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Biaya Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data Biaya Produksi?</h5>
                        <input type="hidden" id="id_biaya_produksi" name="id_biaya_produksi">
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

<div class="modal fade" id="deleteHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_history_biaya_produksi') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Biaya Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data History Biaya Produksi?</h5>
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



<script>
$(document).ready(function() {

    $(document).on('click', '#btn-bayar', function() {
        var id = $(this).data('idproduksi');
        var bahan = $(this).data('biayabahan');
        var tenaga = $(this).data('biayatenaga');
        var overhead = $(this).data('biayaoverhead');
        var total = $(this).data('totalproduksi');
        var bukti = $(this).data('buktibyr');
        var kat = $(this).data('kategoris');
        $('.modal-body #id_biaya_produksi').val(id);
        $('.modal-body #biaya_bahan').val(bahan);
        $('.modal-body #biaya_tenaga').val(tenaga);
        $('.modal-body #biaya_overhead').val(overhead);
        $('.modal-body #total_produksi').val(total);
        $('.modal-body #upload_pembayaran').val(bukti);
        $('.modal-body #kategori_produksi').val(kat);
    })

    $(document).on('click', '#btn-delete-biaya', function() {
        $('.modal-body #id_biaya_produksi').val($(this).data(
            'id'));

    })

    $(document).on('click', '#btn-delete-history', function() {
        $('.modal-body #id_history').val($(this).data(
            'id'));
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

<script>
$('#tanggal').datepicker({
    format: 'yyyy-mm-dd',
    daysOfWeekDisabled: "0",
    autoclose: true
});
</script>

<?= $this->endSection();?>