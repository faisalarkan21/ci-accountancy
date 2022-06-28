<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Permintaan Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Permintaan Bahan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Permintaan Bahan</strong></h3>
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
                                                data-target="#tambahModalPermintaan"><i
                                                    class="fa fa-fw fa-folder-plus"></i>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#permintaan"
                                        role="tab" aria-controls="home" aria-selected="true">Permintaan Bahan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active bg-light" id="permintaan" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Permintaan</th>
                                                <th scope="col">Jumlah Bahan Dibutuhkan</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Status Permintaan Bahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach($datapermintaan as $row) : ?>
                                                <td> <?= $row['id_permintaan'];?>
                                                </td>
                                                <td><?= $row['jmlh_permintaan'];?>
                                                </td>
                                                <td><?= $row['satuan'];?>
                                                </td>
                                                <td>
                                                    <?php if($row['status'] == 'Menunggu Diterima'):?>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#Terima" id="btn-terima"
                                                        data-idterima="<?= $row['id_permintaan']; ?>"
                                                        data-status="Diterima">
                                                        Terima
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="#Tolak"
                                                        id="btn-tolak" class="btn btn-success"
                                                        data-idtolak="<?= $row['id_permintaan']; ?>"
                                                        data-status="Ditolak"> Tolak </button>

                                                    <?php elseif($row['status'] == 'Diterima'):?>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#"
                                                        id="btn-terima" data-idterima="<?= $row['id_permintaan']; ?>"
                                                        data-status="Diterima">
                                                        Diterima
                                                    </button>

                                                    <?php elseif($row['status'] == 'Ditolak'):?>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#"
                                                        id="btn-terima" data-idterima="<?= $row['id_permintaan']; ?>"
                                                        data-status="Diterima">
                                                        Ditolak
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

<form method="POST" action="<?= base_url('/gudang/permintaan_bahan_gudang') ?>">
    <div class="modal fade" id="tambahModalPermintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Update Data Permintaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Permintaan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_permintaan" name="id_permintaan">
                                    <?php foreach($dataID as $row) : ?>
                                    <option value="<?=$row['id_permintaan'];?>"> <?=$row['id_permintaan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
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
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Safety Stok</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="safety_stok" id="safety_stok">
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
                        <input type="hidden" id="jenis_utang" name="jenis_utang">
                        <input type="hidden" id="tgl_utang" name="tgl_utang">
                        <input type="hidden" id="total_utang" name="total_utang">
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

<div class="modal fade" id="Terima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('gudang/Terima_tolak') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Terima Permintaan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('gudang/eoq') ?>" method="post">
                    <div class="modal-body">
                        <div class="card card-primary">
                            <h5 class="text-dark mt-3">Yakin ingin menerimaan permintaan?
                            </h5>
                            <input type="hidden" id="id_permintaan" name="id_permintaan">
                            <input type="hidden" id="status" name="status">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('gudang/Terima_tolak') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Tolak Permintaan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin menolak permintaan?
                        </h5>
                        <input type="hidden" id="id_permintaan" name="id_permintaan">
                        <input type="hidden" id="status" name="status">

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
    $(document).on('click', '#btn-terima', function() {
        var id = $(this).data('idterima');
        var stat = $(this).data('status');
        $('.modal-body #id_permintaan').val(id);
        $('.modal-body #status').val(stat);

    })

    $(document).on('click', '#btn-tolak', function() {
        var id = $(this).data('idtolak');
        var stat = $(this).data('status');
        $('.modal-body #id_permintaan').val(id);
        $('.modal-body #status').val(stat);

    })


    $(document).on('click', '#btn-hapus-bayar', function() {
        $('.modal-body #id_pembayaranut').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-history', function() {
        $('.modal-body #id_history').val($(this).data('id'));

    })

})
</script>

<?= $this->endSection();?>