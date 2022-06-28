<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pembelian Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_pembelian') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Pembelian Bahan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Pembelian Bahan</strong></h3>
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
                                            data-target="#tambahModalPembelian"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
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
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarpembelian"
                                        class="table table-md table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Pembelian</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Nama Vendor</th>
                                                <th scope="col">Frekuensi</th>
                                                <th scope="col">Sisa Frekuensi</th>
                                                <th scope="col">Lead Time</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datapembelian as $row) : ?>
                                                <td> <?= $row['id_pembelian'];?>
                                                </td>
                                                <td> <?= $row['nama_bahan'];?>
                                                </td>
                                                <td> <?= $row['nama_vendor'];?>
                                                </td>
                                                <td> <?= $row['frekuensi'];?>
                                                </td>
                                                <td> <?= $row['frekuensi']-$row['jmlh_click'];?>
                                                </td>
                                                <td> <?= $row['lead_time'];?>
                                                </td>
                                                <td>
                                                    <?php if($row['jmlh_click'] >= $row['frekuensi']):?>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#detailPembelian" id="btn-detail"
                                                        class="btn btn-success"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=number_format($row['harga_pembelian'],0,',','.'); ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?= date_indo($row['tgl_pembelian']); ?>"
                                                        data-totalpembelian="<?=number_format($row['total_pembelian'],0,',','.'); ?>">
                                                        Detail </button>
                                                    <?php elseif($row['tgl_clickafter'] == date('Y-m-d')):?>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#BayarBiaya" id="btn-bayar"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=$row['harga_pembelian']; ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?=$row['tgl_pembelian']; ?>"
                                                        data-totalpembelian="<?=$row['total_pembelian']; ?>"
                                                        data-jmlhclick="<?=$row['jmlh_click']; ?>">
                                                        Bayar
                                                    </button>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#detailPembelian" id="btn-detail"
                                                        class="btn btn-success"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=number_format($row['harga_pembelian'],0,',','.'); ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?= date_indo($row['tgl_pembelian']); ?>"
                                                        data-totalpembelian="<?=number_format($row['total_pembelian'],0,',','.'); ?>">
                                                        Detail </button>
                                                    <?php elseif($row['tgl_clickafter'] == '0000-00-00'):?>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#BayarBiaya" id="btn-bayar"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=$row['harga_pembelian']; ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?=$row['tgl_pembelian']; ?>"
                                                        data-totalpembelian="<?=$row['total_pembelian']; ?>"
                                                        data-jmlhclick="<?=$row['jmlh_click']; ?>">
                                                        Bayar
                                                    </button>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#detailPembelian" id="btn-detail"
                                                        class="btn btn-success"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=number_format($row['harga_pembelian'],0,',','.'); ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?= date_indo($row['tgl_pembelian']); ?>"
                                                        data-totalpembelian="<?=number_format($row['total_pembelian'],0,',','.'); ?>">
                                                        Detail </button>
                                                    <?php elseif($row['tgl_clickafter'] != date('Y-m-d')):?>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#detailPembelian" id="btn-detail"
                                                        class="btn btn-success"
                                                        data-idpembelian="<?= $row['id_pembelian']; ?>"
                                                        data-ideoq="<?=$row['id_eoq']; ?>"
                                                        data-namabahan="<?=$row['nama_bahan']; ?>"
                                                        data-namavendor="<?=$row['nama_vendor']; ?>"
                                                        data-jmlhpembelian="<?=$row['jmlh_pembelian']; ?>"
                                                        data-hargapembelian="<?=number_format($row['harga_pembelian'],0,',','.'); ?>"
                                                        data-frekuensi="<?=$row['frekuensi']; ?>"
                                                        data-leadtime="<?=$row['lead_time']; ?>"
                                                        data-tglpembelian="<?= date_indo($row['tgl_pembelian']); ?>"
                                                        data-totalpembelian="<?=number_format($row['total_pembelian'],0,',','.'); ?>">
                                                        Detail </button>

                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historypembelian"
                                        class="table table-md table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">Tanggal Pembelian</th>
                                                <th scope="col">ID Pembelian</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Nama Vendor</th>
                                                <th scope="col">Jumlah Kebutuhan</th>
                                                <th scope="col">Frekuensi</th>
                                                <th scope="col">Lead Time</th>
                                                <th scope="col">Total Biaya Pembelian</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorypembelian as $row) : ?>
                                                <td> <?= date_indo($row['tgl_pembelian']);?>
                                                </td>
                                                <td> <?= $row['id_pembelian'];?>
                                                </td>
                                                <td> <?= $row['nama_bahan'];?>
                                                </td>
                                                <td> <?= $row['nama_vendor'];?>
                                                </td>
                                                <td> <?= $row['jmlh_pembelian'];?>
                                                </td>
                                                <td> <?= $row['frekuensi'];?>
                                                </td>
                                                <td> <?= $row['lead_time'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_pembelian'],0,',','.'); ?>
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


<form method="POST" action="<?= base_url('pembelian/pembelian_bahan') ?>">
    <div class="modal fade" id="tambahModalPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pembelian Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Pembelian</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_pembelian" id="id_pembelian"
                                    value="<?= $idpembelian ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID EOQ</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_eoq" name="id_eoq">
                                    <?php foreach($ideoq as $row) : ?>
                                    <option value="<?=$row['id_eoq'];?>"> <?=$row['id_eoq'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Vendor</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_vendor" name="nama_vendor">
                                    <?php foreach($namavendor as $row) : ?>
                                    <option value="<?=$row['nama_vendor'];?>"> <?=$row['nama_vendor'];?></option>
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


<div class="modal fade" id="BayarBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('pembelian/update_history_pembayaran') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Bayar Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin membayar
                            Pembelian?</h5>
                        <input type="hidden" id="id_pembelian" name="id_pembelian">
                        <input type="hidden" id="id_eoq" name="id_eoq">
                        <input type="hidden" id="nama_bahan" name="nama_bahan">
                        <input type="hidden" id="nama_vendor" name="nama_vendor">
                        <input type="hidden" id="jmlh_pembelian" name="jmlh_pembelian">
                        <input type="hidden" id="harga_pembelian" name="harga_pembelian">
                        <input type="hidden" id="frekuensi" name="frekuensi">
                        <input type="hidden" id="lead_time" name="lead_time">
                        <input type="hidden" id="tgl_pembelian" name="tgl_pembelian">
                        <input type="hidden" id="total_pembelian" name="total_pembelian">
                        <input type="hidden" id="jmlh_click" name="jmlh_click">
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
            <form action="<?= base_url('pembelian/delete_pembayaran') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Biaya Pembayaran Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data Pembayaran Pembelian?</h5>
                        <input type="hidden" id="id_pembelian" name="id_pembelian">
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
            <form action="<?= base_url('pembelian/delete_history_pembayaran') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Pembayaran Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data History Pembayaran Pembelian?</h5>
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

<div class="modal fade" id="detailPembelian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Pembelian Bahan</h5>
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
                                <th>ID Pembelian Bahan</th>
                                <td>: <span id="id_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>ID Pembelian Bahan</th>
                                <td>: <span id="id_eoq"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Bahan</th>
                                <td>: <span id="nama_bahan"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Vendor</th>
                                <td>: <span id="nama_vendor"></span></td>
                            </tr>
                            <tr>
                                <th>Jumlah Kebutuhan</th>
                                <td>: <span id="jmlh_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Jumlah Pembelian</th>
                                <td>: Rp. <span id="harga_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Frekuensi</th>
                                <td>: <span id="frekuensi"></span></td>
                            </tr>
                            <tr>
                                <th>Lead Time</th>
                                <td>: <span id="lead_time"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <td>: <span id="tgl_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Total Biaya Pembelian</th>
                                <td>: Rp. <span id="total_pembelian"></span></td>
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
        var id = $(this).data('idpembelian');
        var eoq = $(this).data('ideoq');
        var bahan = $(this).data('namabahan');
        var vendor = $(this).data('namavendor');
        var jmlh = $(this).data('jmlhpembelian');
        var harga = $(this).data('hargapembelian');
        var frek = $(this).data('frekuensi');
        var lead = $(this).data('leadtime');
        var tgl = $(this).data('tglpembelian');
        var total = $(this).data('totalpembelian');
        var click = $(this).data('jmlhclick');
        $('.modal-body #id_pembelian').val(id);
        $('.modal-body #id_eoq').val(eoq);
        $('.modal-body #nama_bahan').val(bahan);
        $('.modal-body #nama_vendor').val(vendor);
        $('.modal-body #jmlh_pembelian').val(jmlh);
        $('.modal-body #harga_pembelian').val(harga);
        $('.modal-body #frekuensi').val(frek);
        $('.modal-body #lead_time').val(lead);
        $('.modal-body #tgl_pembelian').val(tgl);
        $('.modal-body #total_pembelian').val(total);
        $('.modal-body #jmlh_click').val(click);

    })

    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idpembelian');
        var eoq = $(this).data('ideoq');
        var bahan = $(this).data('namabahan');
        var vendor = $(this).data('namavendor');
        var jmlh = $(this).data('jmlhpembelian');
        var harga = $(this).data('hargapembelian');
        var frek = $(this).data('frekuensi');
        var lead = $(this).data('leadtime');
        var tgl = $(this).data('tglpembelian');
        var total = $(this).data('totalpembelian');
        $('.modal-body #id_pembelian').text(id);
        $('.modal-body #id_eoq').text(eoq);
        $('.modal-body #nama_bahan').text(bahan);
        $('.modal-body #nama_vendor').text(vendor);
        $('.modal-body #jmlh_pembelian').text(jmlh);
        $('.modal-body #harga_pembelian').text(harga);
        $('.modal-body #frekuensi').text(frek);
        $('.modal-body #lead_time').text(lead);
        $('.modal-body #tgl_pembelian').text(tgl);
        $('.modal-body #total_pembelian').text(total);

    })
    $(document).on('click', '#btn-delete-biaya', function() {
        $('.modal-body #id_pembelian').val($(this).data(
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
    $('#historypembelian').DataTable({
        responsive: true

    });
    $('#daftarpembelian').DataTable({
        responsive: true

    });




});
</script>

<?= $this->endSection();?>