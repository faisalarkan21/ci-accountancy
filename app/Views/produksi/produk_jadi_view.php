<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Produk Jadji</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Produk Jadi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Produk Jadi</strong></h3>
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
                                    <!-- <div class="col-2">
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalProdukJadi"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable"
                                        class="table  table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($dataprodukjadi as $row) : ?>
                                                <td> <?= $row['id_produk'];?>
                                                </td>
                                                <td> <?= $row['nama_produk'];?>
                                                </td>
                                                <td> <?= number_format($row['stock'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailproduk" id="btn-detail"
                                                        data-idproduk="<?= $row['id_produk']; ?>"
                                                        data-namaproduk="<?= $row['nama_produk']; ?>"
                                                        data-tglmulai="<?=  date_indo($row['tgl_mulai']); ?>"
                                                        data-tglselesai="<?=  date_indo($row['tgl_selesai']); ?>"
                                                        data-waktu="<?= $row['waktu_pengerjaan']; ?>"
                                                        data-stockproduk="<?= number_format($row['stock'],0,',','.'); ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_produk']; ?>">
                                                        Hapus </button> -->
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

<div class="modal fade" id="detailproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Produk Jadi</h5>
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
                                <th>ID Produk</th>
                                <td>: <span id="id_produk"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>: <span id="nama_produk"></span></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>: <span id="stock_brg"></span></td>
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
                                <th>Waktu Pengerjaan</th>
                                <td>: <span id="waktu_pengerjaan"></span> Hari</td>
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

<!-- <form method="POST" action="<?= base_url('produksi/produk_jadi') ?>">
    <div class="modal fade" id="tambahModalProdukJadi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Produk Jadi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Produk</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_produk" id="id_produk"
                                    value="<?= $getidprodukjadi?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Produk</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Stock</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="stock" id="stock">
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
</form> -->

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_produk_jadi') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Produk Jadi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Produk Jadi?</h5>
                        <input type="hidden" id="id_produk" name="id_produk">
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
        var id = $(this).data('idproduk');
        var stock = $(this).data('stockproduk');
        var mulai = $(this).data('tglmulai');
        var selesai = $(this).data('tglselesai');
        var pengerjaan = $(this).data('waktu');
        var nama = $(this).data('namaproduk');
        $('.modal-body #id_produk').text(id);
        $('.modal-body #stock_brg').text(stock);
        $('.modal-body #tgl_mulai').text(mulai);
        $('.modal-body #tgl_selesai').text(selesai);
        $('.modal-body #waktu_pengerjaan').text(pengerjaan);
        $('.modal-body #nama_produk').text(nama);
    })


    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_produk').val($(this).data('id'));

    })

})
</script>

<script>
$(document).ready(function() {
    $('#daftartable').DataTable({
        responsive: true
    });


});
</script>

<?= $this->endSection();?>