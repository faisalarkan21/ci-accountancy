<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Jadwal Produksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Jadwal Produksi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Jadwal Produksi</strong></h3>
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
                                            data-target="#tambahModalJadwal"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Jadwal Produksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">History</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="tablejadwal"
                                        class="table table-md table-bordered table-hover table-responsive-md  text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Jadwal</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datajadwal as $row) : ?>
                                                <td> <?= $row['id_jadwal'];?>
                                                </td>
                                                <td> <?= $row['nama_produk'];?>
                                                </td>
                                                <td> <?= $row['rencana_produksi'];?>
                                                </td>
                                                <td>
                                                    <?php  if ($row['keterangan'] == 'Mulai Produksi') : ?>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#mulaiProduksi" id="btn-mulai"
                                                        data-idmulai="<?= $row['id_jadwal']; ?>"
                                                        data-ketmulai="<?=$row['keterangan']; ?>">
                                                        Mulai Produksi
                                                    </button>
                                                    <?php elseif($row['keterangan'] == 'Sedang Proses') : ?>
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#prosesProduksi" id="btn-proses"
                                                        data-idselesai="<?= $row['id_jadwal']; ?>"
                                                        data-ketselesai="<?=$row['keterangan']; ?>">
                                                        Selesai Proses
                                                    </button>
                                                    <?php else : ?>
                                                    <?= $row['keterangan']; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailJadwal" id="btn-detail"
                                                        data-idjadwal="<?= $row['id_jadwal']; ?>"
                                                        data-namaproduk="<?=$row['nama_produk']; ?>"
                                                        data-rencanaproduksi="<?=$row['rencana_produksi']; ?>"
                                                        data-tglmulai="<?= date_indo($row['tgl_mulai']); ?>"
                                                        data-tglselesai="<?= date_indo($row['tgl_selesai']); ?>"
                                                        data-keterangan="<?=$row['keterangan']; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusdaftar" id="btn-delete"
                                                        class="btn btn-success"
                                                        data-idjadwal="<?= $row['id_jadwal']; ?>"> Hapus </button> -->
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="tablehistoryjadwal"
                                        class="table table-md table-hover table-responsive-md table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Jadwal</th>
                                                <th scope="col">Tanggal Produksi</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Waktu Pengerjaan</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistoryjadwal as $row) : ?>
                                                <td> <?= $row['id_jadwal'];?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_selesai']);?>
                                                </td>
                                                <td> <?= $row['nama_produk'];?>
                                                </td>
                                                <td> <?= $row['rencana_produksi'];?>
                                                </td>
                                                <td> <?= $row['waktu_pengerjaan'];?> Hari
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id']; ?>"> Hapus </button>
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


<form method="POST" action="<?= base_url('produksi/jadwal_produksi') ?>">
    <div class="modal fade" id="tambahModalJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Jadwal </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_jadwal" id="id_jadwal"
                                    value="<?= $getidjadwal?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID BOM</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_bom" name="id_bom">
                                    <?php foreach($databom as $row) : ?>
                                    <option value="<?=$row['id_bom'];?>"><?=$row['id_bom'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Operation</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_operation" name="id_operation">
                                    <?php foreach($dataoperationlist as $row) : ?>
                                    <option value="<?=$row['id_operation'];?>"><?=$row['id_operation'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Quantity</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="quantity" id="quantity">
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


<div class="modal fade" id="mulaiProduksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/edit_keterangan_mulai') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Mulai Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin memulai produksi?</h5>
                        <input type="hidden" id="id_jadwal" name="id_jadwal">
                        <input type="hidden" id="keterangan_mulai" name="keterangan_mulai">

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

<div class="modal fade" id="prosesProduksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/edit_keterangan_selesai') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Selesai Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin produksi sudah selesai?</h5>
                        <input type="hidden" id="id_jadwal" name="id_jadwal">
                        <input type="hidden" id="nama_bahan" name="nama_bahan">
                        <input type="hidden" id="quantity" name="quantity">
                        <input type="hidden" id="rencana_produksi" name="rencana_produksi">
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_history_jadwal') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data History Jadwal?</h5>
                        <input type="hidden" id="id_jadwal" name="id_jadwal">
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

<div class="modal fade" id="modalHapusdaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_daftar_jadwal') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Jadwal?</h5>
                        <input type="hidden" id="id_daftar_jadwal" name="id_daftar_jadwal">
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

<div class="modal fade" id="detailJadwal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onClick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card card-primary">
                    <table class="table no-margin">
                        <tbody>
                            <tr>
                                <th>ID Jadwal</th>
                                <td>: <span id="id_jadwal"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>: <span id="nama_produk"></span></td>
                            </tr>
                            <tr>
                                <th>Rencana Produksi</th>
                                <td>: <span id="rencana_produksi"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <td>: <span id="tgl_mulai"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>: <span id="tgl_selesai"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>: <span id="keterangan"></span></td>
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
    $('#tablejadwal').DataTable({

    });
    $('#tablehistoryjadwal').DataTable({

    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '#btn-delete', function() {
        $('.modal-body #id_daftar_jadwal').val($(this).data('idjadwal'));
    })

    $(document).on('click', '#btn-proses', function() {
        var id = $(this).data('idselesai');
        var nama = $(this).data('namabahan');
        var qty = $(this).data('quantity');
        var rencana = $(this).data('rencanaproduksi');
        $('.modal-body #id_jadwal').val(id);
        $('.modal-body #nama_bahan').val(nama);
        $('.modal-body #quantity').val(qty);
        $('.modal-body #rencana_produksi').val(rencana);
    })

    $(document).on('click', '#btn-mulai', function() {
        var id = $(this).data('idmulai');
        var mulai = $(this).data('ketmulai');
        $('.modal-body #id_jadwal').val(id);
        $('.modal-body #keterangan_mulai').val(mulai);
    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_jadwal').val($(this).data('id'));

    })

    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idjadwal');
        var nama = $(this).data('namaproduk');
        var mulai = $(this).data('tglmulai');
        var selesai = $(this).data('tglselesai');
        var rencana = $(this).data('rencanaproduksi');
        var ket = $(this).data('keterangan');
        $('.table #id_jadwal').text(id);
        $('.table #nama_produk').text(nama);
        $('.table #tgl_mulai').text(mulai);
        $('.table #tgl_selesai').text(selesai);
        $('.table #rencana_produksi').text(rencana);
        $('.table #keterangan').text(ket);

    })

})
</script>



<?= $this->endSection();?>