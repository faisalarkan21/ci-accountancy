<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data EOQ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">EOQ</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">EOQ</strong></h3>
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
                                            data-target="#tambahModalEoq"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#aset"
                                        role="tab" aria-controls="home" aria-selected="true">EOQ</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="aset" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="asetTable"
                                        class="table  table table-md table-responsive-xl table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID EOQ</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Biaya Pesan</th>
                                                <th scope="col">Biaya Simpan</th>
                                                <th scope="col">Jumlah Kebutuhan</th>
                                                <th scope="col">EOQ</th>
                                                <th scope="col">ROP</th>
                                                <th scope="col">Lead Time</th>
                                                <th scope="col">Biaya Optimal</th>
                                                <th scope="col">Safety Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataeoq as $row) : ?>
                                                <td> <?= $row['id_eoq'];?>
                                                </td>
                                                <td> <?= $row['nama_bahan'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_pemesanan'],0,',','.');?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_penyimpanan'],0,',','.');?>
                                                </td>
                                                <td> <?= $row['jmlh_pembelian'];?>
                                                </td>
                                                <td> <?= $row['eoq'];?> <?= $row['satuan_safety'];?>
                                                </td>
                                                <td> <?= $row['rop'];?> Kali
                                                </td>
                                                <td> <?= $row['lead_time'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['biaya_optimal'],0,',','.');?>
                                                </td>
                                                <td> <?= $row['safety_stok'];?>
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

<form method="POST" action="<?= base_url('gudang/eoq') ?>">
    <div class="modal fade" id="tambahModalEoq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data EOQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID EOQ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_eoq" id="id_eoq" value="<?= $ideoq ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Pembelian</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_pembelian" name="id_pembelian">
                                    <?php foreach($idpembelian as $row) : ?>
                                    <option value="<?=$row['id_pembelian'];?>"> <?=$row['id_pembelian'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Hari</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="jmlh_hari" name="jmlh_hari">
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan Safety Stok</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan_safety" id="satuan_safety">
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
<script>
$(document).ready(function() {
    $('#asetTable').DataTable({
        responsive: true

    });



});
</script>



<?= $this->endSection();?>