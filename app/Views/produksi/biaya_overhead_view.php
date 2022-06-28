<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Biaya Overhead</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Biaya Overhead</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Biaya Overhead</strong></h3>
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
                                            data-target="#tambahModalBiayaOverhead"><i
                                                class="fa fa-fw fa-folder-plus"></i>
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
                                    <table id="daftartable"
                                        class="table table-md table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Biaya Overhead</th>
                                                <th scope="col">Nama Overhead</th>
                                                <th scope="col">Total Biaya Overhead</th>
                                                <th scope="col">Status</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($databiayaoverhead as $row) : ?>
                                                <td> <?= $row['id_biaya_overhead'];?>
                                                </td>
                                                <td> <?= $row['nama_overhead'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_overhead'],0,',','.'); ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#BayarBiaya" id="btn-bayar"
                                                        data-idbiayaoverhead="<?= $row['id_biaya_overhead']; ?>"
                                                        data-namaoverhead="<?=$row['nama_overhead']; ?>"
                                                        data-kategori="<?= $row['kategori']; ?>"
                                                        data-upload="<?= $row['upload_pembayaran']; ?>"
                                                        data-totalbiaya="<?=$row['total_overhead']; ?>">
                                                        Bayar
                                                    </button>
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal" data-target="#deleteBiaya"
                                                        id="btn-delete-biaya" class="btn btn-success"
                                                        data-id="<?= $row['id_biaya_overhead']; ?>"> Delete </button>
                                                </td> -->
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="historytable"
                                        class="table table-md table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Biaya Overhead</th>
                                                <th scope="col">Nama Overhead</th>
                                                <th scope="col">Total Biaya Overhead</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Tanggal Bayar</th>
                                                <th scope="col">Bukti Pembayaran</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorybiayoverhead as $row) : ?>
                                                <td> <?= $row['id_biaya_overhead'];?>
                                                </td>
                                                <td> <?= $row['nama_overhead'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_overhead'],0,',','.'); ?>
                                                </td>
                                                <td> <?= $row['kategori'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_pembayaran']);?>
                                                </td>
                                                <td> <img
                                                        src="<?=base_url('template/assets/img/bukti-bayar-overhead/'.$row['upload_pembayaran']); ?>"
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


<form method="POST" action="<?= base_url('produksi/biaya_overhead') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalBiayaOverhead" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Biaya Overhead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Biaya Overhead</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_biaya_overhead" id="id_biaya_overhead"
                                    value="<?= $getidbiayaoverhead?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Overhead</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_overhead" name="nama_overhead">
                                    <?php foreach($dataoverhead as $row) : ?>
                                    <option value="<?=$row['nama_overhead'];?>">
                                        <?=$row['nama_overhead'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Total Biaya Overhead</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="total_overhead" id="total_overhead">
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


<div class="modal fade" id="BayarBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/update_history_biaya_overhead') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Bayar Biaya Overhead</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin membayar
                            Biaya Overhead?</h5>
                        <input type="hidden" id="id_biaya_overhead" name="id_biaya_overhead">
                        <input type="hidden" id="nama_overhead" name="nama_overhead">
                        <input type="hidden" id="total_overhead" name="total_overhead">
                        <input type="hidden" id="kategori" name="kategori">
                        <input type="hidden" id="upload_file" name="upload_file">
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
            <form action="<?= base_url('produksi/delete_biaya_overhead') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Biaya Overhead</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data Biaya Overhead?</h5>
                        <input type="hidden" id="id_biaya_overhead" name="id_biaya_overhead">
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
            <form action="<?= base_url('produksi/delete_history_biaya_overhead') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Biaya Overhead</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data History Biaya Overhead?</h5>
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
        var id = $(this).data('idbiayaoverhead');
        var nama = $(this).data('namaoverhead');
        var total = $(this).data('totalbiaya');
        var kat = $(this).data('kategori');
        var up = $(this).data('upload');
        $('.modal-body #id_biaya_overhead').val(id);
        $('.modal-body #nama_overhead').val(nama);
        $('.modal-body #total_overhead').val(total);
        $('.modal-body #kategori').val(kat);
        $('.modal-body #upload_file').val(up);
    })

    $(document).on('click', '#btn-delete-biaya', function() {
        $('.modal-body #id_biaya_overhead').val($(this).data(
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

<?= $this->endSection();?>