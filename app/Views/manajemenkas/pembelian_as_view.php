<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembelian Aset</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_manajemenkas') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
                <div class="breadcrumb-item">Pembelian Aset</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Pembelian Aset</strong></h3>
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
                                            data-target="#tambahModalPembelianAs"><i
                                                class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Pembelian Aset
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#tambahModalPenyusutan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Penyusutan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab3" data-toggle="pill" href="#penyusutan" role="tab"
                                        aria-controls="home" aria-selected="false">Penyusutan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab4" data-toggle="pill" href="#asetdimiliki"
                                        role="tab" aria-controls="home" aria-selected="false">Aset Dimiliki</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Pembelian</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Nilai Aset</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datapembelianaset as $row) : ?>
                                                <td> <?= $row['id_pembelian_aset'];?>
                                                </td>
                                                <td><?= $row['nama_aset'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_biaya_pembelian'],0,',','.');;?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td><button type="button" data-toggle="modal" data-target="#modalBayar"
                                                        id="btn-bayar" class="btn btn-warning"
                                                        data-idpembelian="<?= $row['id_pembelian_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-tgl="<?= $row['tgl_pembelian']; ?>"
                                                        data-namatoko="<?= $row['nama_toko']; ?>"
                                                        data-kategori="<?= $row['kategori']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>"
                                                        data-total="<?=  $row['tot_biaya_pembelian']; ?>">
                                                        Bayar </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#EditPembelian" id="btn-edit"
                                                        data-idpembelian="<?= $row['id_pembelian_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-tgl="<?= $row['tgl_pembelian']; ?>"
                                                        data-namatoko="<?= $row['nama_toko']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>"
                                                        data-total="<?=  $row['tot_biaya_pembelian']; ?>">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailAs" id="btn-detail"
                                                        data-idpembelian="<?= $row['id_pembelian_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-tgl="<?= date_indo ($row['tgl_pembelian']); ?>"
                                                        data-namatoko="<?= $row['nama_toko']; ?>"
                                                        data-kategori="<?= $row['kategori']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-buktibyr="<?= $row['bukti_bayar']; ?>"
                                                        data-total="<?=  number_format($row['tot_biaya_pembelian'],0,',','.'); ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusPembelian" id="btn-hapus-pembelian"
                                                        class="btn btn-success"
                                                        data-id="<?= $row['id_pembelian_aset']; ?>"> Delete </button> -->
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
                                                <th scope="col">ID Pembelian</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Tanggal Pembelian</th>
                                                <th scope="col">Nama Toko</th>
                                                <th scope="col">Nilai Aset</th>
                                                <th scope="col">Tanggal Pembayaran</th>
                                                <th scope="col">Keterangan</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorypembelian as $row) : ?>
                                                <td> <?= $row['id_pembelian_aset'];?>
                                                </td>
                                                <td><?= $row['nama_aset'];?>
                                                </td>
                                                <td> <?= date_indo ($row['tgl_pembelian']);?>
                                                </td>
                                                <td><?= $row['nama_toko'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_biaya_pembelian'],0,',','.');;?>
                                                </td>
                                                <td><?= date_indo ($row['tgl_pembayaran']);?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <!-- <td><button type="button" data-toggle="modal"
                                                        data-target="#modalHapusHistoryPembelian" id="btn-hapus-history"
                                                        class="btn btn-success" data-id="<?= $row['id']; ?>">
                                                        Delete </button>
                                                </td> -->
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="penyusutan" role="tabpanel" aria-labelledby="home-tab3">
                                    <table id="penyusutantable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Penyusutan</th>
                                                <th scope="col">Tanggal Penyusutan</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Nilai Aset</th>
                                                <th scope="col">Nilai Sisa</th>
                                                <th scope="col">Umur Ekonomis</th>
                                                <th scope="col">Nilai Penyusutan</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataPenyusutan as $row) : ?>
                                                <td> <?= $row['id_penyusutan'];?>
                                                </td>
                                                <td> <?= date_indo ($row['tgl_penyusutan']);?>
                                                </td>
                                                <td><?= $row['nama_aset'];?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_harga'],0,',','.');;?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['nilai_sisa'],0,',','.');;?>
                                                </td>
                                                <td><?= $row['umr_ekonomis'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['nilai_pen'],0,',','.');;?>
                                                </td>
                                                <!-- <td><button type="button" data-toggle="modal"
                                                        data-target="#modalHapusPenyusutan" id="btn-hapus-penyusutan"
                                                        class="btn btn-success" data-id="<?= $row['id_penyusutan']; ?>">
                                                        Delete </button>
                                                </td> -->
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="asetdimiliki" role="tabpanel"
                                    aria-labelledby="home-tab4">
                                    <table id="dimilikitable" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Aset</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Nilai Aset</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataAsetDimiliki as$row) : ?>
                                                <td> <?= $row['id_aset'];?>
                                                </td>
                                                <td><?= $row['nama_aset'];?>
                                                </td>
                                                <td><?= $row['keterangan'];?>
                                                </td>
                                                <td>Rp. <?=  number_format($row['tot_harga'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailDimiliki" id="btn-detail-dimiliki"
                                                        data-idaset="<?= $row['id_aset']; ?>"
                                                        data-namaaset="<?= $row['nama_aset']; ?>"
                                                        data-namatk="<?= $row['nama_toko']; ?>"
                                                        data-keterangan="<?= $row['keterangan']; ?>"
                                                        data-buktibyr="<?= $row['upload_pembayaran']; ?>"
                                                        data-totalaset="<?=  number_format($row['tot_harga'],0,',','.'); ?>"
                                                        data-tglaset="<?= date_indo ($row['tgl_beli']); ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusDimiliki" id="btn-hapus-dimiliki"
                                                        class="btn btn-success" data-id="<?= $row['id']; ?>">
                                                        Delete </button> -->
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-end">
                                        <table class="table table-hover table-borderless text-left col-5 mr-3">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th scope="col">Total Nilai Aset</th>
                                                    <th scope="col" class="text-center">
                                                        Rp.
                                                        <?=  number_format($datatotalaset['tot_harga'],0,',','.'); ?>
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

<form method="POST" action="<?= base_url('/manajemenkas/pembelian_aset') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalPembelianAs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pembelian</h5>
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
                                <input type="text" class="form-control" name="id_pembelian_aset" id="id_pembelian_aset"
                                    value="<?= $getidhistoryaset?>" readonly>
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
                            <label class="col-sm-4">Tanggal Pembelian Aset</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_pembelian" name="tgl_pembelian"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_aset" id="nama_aset">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Toko</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_toko" id="nama_toko">
                            </div>
                        </div>
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_aset" id="jmlh_aset">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nilai Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_biaya_pembelian"
                                    id="tot_biaya_pembelian">
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
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form method="POST" action="<?= base_url('/manajemenkas/penyusutan') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="tambahModalPenyusutan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Penyusutan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_penyusutan" id="id_penyusutan"
                                    value="<?= $getidpenyusutan?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Aset</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_aset" name="id_aset">
                                    <?php foreach($dataAsetDimiliki as $row) : ?>
                                    <option value="<?=$row['id_aset'];?>"><?=$row['id_aset'];?>
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
                            <label class="col-sm-4">Tanggal Penyusutan</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_penyusutan"
                                        name="tgl_penyusutan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nilai Sisa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nilai_sisa" id="nilai_sisa">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Umur Ekonomis</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="umur_ekonomis" id="umur_ekonomis">
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


<form method="POST" action="<?= base_url('/manajemenkas/edit_pembelian_aset') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="EditPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Pembelian Aset</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_pembelian" name="tgl_pembelian"
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
                            <label class="col-sm-4">Nama Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_aset" id="nama_aset">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Toko</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_toko" id="nama_toko">
                            </div>
                        </div>
                        <!-- <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_aset" id="jmlh_aset">
                            </div>
                        </div> -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nilai Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tot_biaya_pembelian"
                                    id="tot_biaya_pembelian">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-4">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div>
                        <input type="hidden" id="id_pembelian_aset" name="id_pembelian_aset">
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
            <form action="<?= base_url('manajemenkas/update_history_pembelianAs') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Pembayaran Pembelian Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Apakah data pembelian sudah di konfirmasi?</h5>
                        <input type="hidden" id="id_pembelian_aset" name="id_pembelian_aset">
                        <input type="hidden" id="nama_aset" name="nama_aset">
                        <input type="hidden" id="tgl_pembelian" name="tgl_pembelian">
                        <input type="hidden" id="nama_toko" name="nama_toko">
                        <input type="hidden" id="tot_biaya_pembelian" name="tot_biaya_pembelian">
                        <input type="hidden" id="kategori" name="kategori">
                        <input type="hidden" id="bukti_bayar" name="bukti_bayar">
                        <input type="hidden" id="keterangan" name="keterangan">
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

<div class="modal fade" id="modalHapusPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_pembelianaset') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data Pembelian Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus, apakah data pembelian sudah di konfirmasi?
                        </h5>
                        <input type="hidden" id="id_pembelian_aset" name="id_pembelian_aset">

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

<div class="modal fade" id="modalHapusHistoryPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_historypembelian') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data History Pembelian Aset
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

<div class="modal fade" id="modalHapusDimiliki" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('manajemenkas/delete_aset_dimiliki') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Hapus Data Aset yang dimiliki
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menghapus data Aset yang dimiliki?
                        </h5>
                        <input type="hidden" id="id_dimiliki" name="id_dimiliki">

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

<div class="modal fade" id="detailAs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Pembelian Aset</h5>
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
                                <th>ID Pembelian Aset</th>
                                <td>: <span id="id_pembelian_aset"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Aset</th>
                                <td>: <span id="nama_aset"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <td>: <span id="tgl_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Toko</th>
                                <td>: <span id="nama_toko"></span></td>
                            </tr>
                            <!-- <tr>
                                <th>Jumlah Aset</th>
                                <td>: <span id="jmlh_aset"></span></td>
                            </tr> -->
                            <tr>
                                <th>Nilai Aset</th>
                                <td>: Rp. <span id="tot_biaya_pembelian"></span></td>
                            </tr>
                            <tr>
                                <th>Bukti Bayar</th>
                                <td><img src="" width="300" height="150" id="bukti_bayar"></img></td>
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


<div class="modal fade" id="detailDimiliki">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Aset Dimiliki</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <th>Nama Aset</th>
                                <td>: <span id="nama_aset"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Toko</th>
                                <td>: <span id="nama_toko"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <td>: <span id="tgl_beli"></span></td>
                            </tr>
                            <!-- <tr>
                                <th>Jumlah Aset</th>
                                <td>: <span id="jml_aset"></span></td>
                            </tr> -->
                            <tr>
                                <th>Nilai Aset</th>
                                <td>: Rp. <span id="tot_harga"></span></td>
                            </tr>
                            <tr>
                                <th>Bukti Bayar</th>
                                <td><img src="" width="300" height="150" id="bukti_bayar"></img></td>
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
        var namaAs = $(this).data('namaaset');
        var tanggal = $(this).data('tgl');
        var namaTk = $(this).data('namatoko');
        var total_biaya = $(this).data('total');
        var kat = $(this).data('kategori');
        var ket = $(this).data('keterangan');
        var bukti = $(this).data('buktibyr');
        $('.modal-body #id_pembelian_aset').val(id);
        $('.modal-body #nama_aset').val(namaAs);
        $('.modal-body #tgl_pembelian').val(tanggal);
        $('.modal-body #nama_toko').val(namaTk);
        $('.modal-body #tot_biaya_pembelian').val(total_biaya);
        $('.modal-body #kategori').val(kat);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #bukti_bayar').val(bukti);
    })

    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idpembelian');
        var namaAs = $(this).data('namaaset');
        var tanggal = $(this).data('tgl');
        var namaTk = $(this).data('namatoko');
        var total_biaya = $(this).data('total');
        var kat = $(this).data('kategori');
        var ket = $(this).data('keterangan');
        var bukti = $(this).data('buktibyr');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-pembelian-aset/"
        $('.modal-body #id_pembelian_aset').text(id);
        $('.modal-body #nama_aset').text(namaAs);
        $('.modal-body #tgl_pembelian').text(tanggal);
        $('.modal-body #nama_toko').text(namaTk);
        $('.modal-body #tot_biaya_pembelian').text(total_biaya);
        $('.modal-body #kategori').text(kat);
        $('.modal-body #keterangan').text(ket);
        $('.modal-body #bukti_bayar').attr('src', base_url + bukti);
    })


    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idpembelian');
        var namaAs = $(this).data('namaaset');
        var tanggal = $(this).data('tgl');
        var namaTk = $(this).data('namatoko');
        var total_biaya = $(this).data('total');
        var ket = $(this).data('keterangan');
        var bukti = $(this).data('buktibyr');
        $('.modal-body #id_pembelian_aset').val(id);
        $('.modal-body #nama_aset').val(namaAs);
        $('.modal-body #tgl_pembelian').val(tanggal);
        $('.modal-body #nama_toko').val(namaTk);
        $('.modal-body #tot_biaya_pembelian').val(total_biaya);
        $('.modal-body #keterangan').val(ket);
        $('.modal-body #uploads').val(bukti);
    })

    $(document).on('click', '#btn-detail-dimiliki', function() {
        var id = $(this).data('idaset');
        var nama = $(this).data('namaaset');
        var total = $(this).data('totalaset');
        var tgl = $(this).data('tglaset');
        var ket = $(this).data('keterangan');
        var tk = $(this).data('namatk');
        var bukti = $(this).data('buktibyr');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-aset/"
        $('.modal-body #id_aset').text(id);
        $('.modal-body #nama_aset').text(nama);
        $('.modal-body #tot_harga').text(total);
        $('.modal-body #tgl_beli').text(tgl);
        $('.modal-body #keterangan').text(ket);
        $('.modal-body #nama_toko').text(tk);
        $('.modal-body #bukti_bayar').attr('src', base_url + bukti);
    })

    $(document).on('click', '#btn-hapus-pembelian', function() {
        $('.modal-body #id_pembelian_aset').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-history', function() {
        $('.modal-body #id_history').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-dimiliki', function() {
        $('.modal-body #id_dimiliki').val($(this).data('id'));

    })

})
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
$(document).ready(function() {
    $('#historytable').DataTable({
        responsive: true
    });
    $('#dimilikitable').DataTable({
        responsive: true
    });
    $('#penyusutantable').DataTable({
        responsive: true
    });
    $('#daftartable').DataTable({
        responsive: true
    });



});
</script>

<?= $this->endSection();?>