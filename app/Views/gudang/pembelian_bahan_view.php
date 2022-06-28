<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pembelian Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
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
                                    <div class="">

                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalPembelian"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-success " data-toggle="modal"
                                            data-target="#prosesjurnal"><i class="fa fa-fw fa-folder-plus"></i>
                                            Proses Ke Jurnal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills " id="myTab2" role="tablist">
                            <li class="nav-item  ">
                                <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#pembelian"
                                    role="tab" aria-controls="home" aria-selected="true">Pembelian Bahan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTab3Content">
                            <div class="tab-pane fade show active " id="pembelian" role="tabpanel"
                                aria-labelledby="home-tab1">
                                <table id="daftarbahan" class="table table-hover table-bordered text-center">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">ID Pembelian</th>
                                            <th scope="col">Nama Bahan</th>
                                            <th scope="col">Jumlah Bahan Dibutuhkan</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Biaya Pemesanan</th>
                                            <th scope="col">Biaya Penyimpanan</th>
                                            <th scope="col">Biaya Bahan</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark bg-light">
                                        <tr>
                                            <?php foreach($datapembelian as $row) : ?>
                                            <td> <?= $row['id_pembelian'];?>
                                            </td>
                                            <td><?= $row['nama_bahan'];?>
                                            </td>
                                            <td><?= $row['jmlh_pembelian'];?>
                                            </td>
                                            <td><?= $row['satuan'];?>
                                            </td>
                                            <td>Rp. <?= number_format($row['biaya_pemesanan'],0,',','.');?>
                                            </td>
                                            <td>Rp. <?= number_format($row['biaya_penyimpanan'],0,',','.');?>
                                            </td>
                                            <td>Rp. <?= number_format($row['biaya_bahan'],0,',','.');?>
                                            </td>
                                            <td>
                                                <?php if($row['status'] == 'Sedang Proses'):?>
                                                <button class="btn btn-warning mt-2 mb-2">
                                                    Sedang Proses
                                                </button>

                                                <?php elseif($row['status'] == 'Selesai'):?>
                                                <button class="btn btn-success">
                                                    Selesai
                                                </button>

                                                <?php endif;?>

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

<form method="POST" action="<?= base_url('/gudang/pembelian_bahan_gudang') ?>">
    <div class="modal fade" id="tambahModalPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID pembelian</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_pembelian" id="id_pembelian"
                                    value="<?= $idpembelian ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_bahan" name="nama_bahan">
                                    <?php foreach($databahansisa as $row) : ?>
                                    <option value="<?=$row['nama_bahan'];?>"> <?=$row['nama_bahan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah pembelian</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_pembelian" id="jmlh_pembelian">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Pemesanan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="biaya_pemesanan" id="biaya_pemesanan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Biaya Penyimpanan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="biaya_penyimpanan" id="biaya_penyimpanan">
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

<form method="POST" action="<?= base_url('gudang/jurnal_pembelian') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="prosesjurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Persediaan Bahan Ke Jurnal Per
                        Bulan
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



<script>
$(document).ready(function() {

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
    $('#daftarbahan').DataTable({
        responsive: true

    });



});
</script>

<?= $this->endSection();?>