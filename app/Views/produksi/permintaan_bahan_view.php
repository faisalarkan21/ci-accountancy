<?= $this->extend("templates/main"); ?>

<?= $this->section('content'); ?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Permintaan Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
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
                    if (isset($validation)) : ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($error)) : ?>
                    <div class='alert alert-danger'><?= $error; ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="">
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalPermintaan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Bahan Lama
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#tambahModalPermintaanbaru"><i
                                                class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Bahan Baru
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Permintaan Bahan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartable"
                                        class="table table-md table-bordered table-hover table-responsive-xl text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Permintaan Bahan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach ($datapermintaanbahan as $row) : ?>
                                                <td> <?= $row['id_permintaan']; ?>
                                                </td>
                                                <td> <?= $row['nama_bahan']; ?>
                                                </td>
                                                <td> <?= $row['status']; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detailPermintaan" id="btn-detail"
                                                        data-idpermintaan="<?= $row['id_permintaan']; ?>"
                                                        data-namabahan="<?= $row['nama_bahan']; ?>"
                                                        data-jmlhpermintaan="<?= $row['jmlh_permintaan']; ?>"
                                                        data-tglpermintaan="<?= date_indo($row['tgl_permintaan']); ?>"
                                                        data-statuspenerimaan="<?= $row['status']; ?>"
                                                        data-satuanpermintaan="<?= $row['satuan']; ?>">
                                                        Detail
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#deleteBiaya"
                                                        id="btn-delete" class="btn btn-success"
                                                        data-id="<?= $row['id_permintaan']; ?>"> Delete </button> -->
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


<form method="POST" action="<?= base_url('produksi/permintaan_bahan') ?>">
    <div class="modal fade" id="tambahModalPermintaan" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Permintaan Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Permintaan Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_permintaan" id="id_permintaan"
                                    value="<?= $kodepermintaan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6 ">
                                <select class="form-control" id="nama_bahan" name="nama_bahan">
                                    <?php foreach ($databahanbaku as $row) : ?>
                                    <option value="<?= $row['nama_bahan']; ?>">
                                        <?= $row['nama_bahan']; ?></option>
                                    <?php endforeach;  ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Permintaan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_permintaan" id="jmlh_permintaan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan_bahan" id="satuan_bahan">
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

<form method="POST" action="<?= base_url('produksi/permintaan_bahan') ?>">
    <div class="modal fade" id="tambahModalPermintaanbaru" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Permintaan Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Permintaan Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_permintaan" id="id_permintaan"
                                    value="<?= $kodepermintaan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_bahan" id="nama_bahan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Permintaan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_permintaan" id="jmlh_permintaan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan_bahan" id="satuan_bahan">
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


<div class="modal fade" id="deleteBiaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_permintaan_bahan') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Permintaan Bahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin
                            menghapus data Permintaan Bahan?</h5>
                        <input type="hidden" id="id_permintaan" name="id_permintaan">
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

<div class="modal fade" id="detailPermintaan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Permintaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card card-primary">
                    <table class="table  no-margin">
                        <tbody>
                            <tr>
                                <th>ID Permintaan</th>
                                <td>: <span id="id_permintaan"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Bahan</th>
                                <td>: <span id="nama_bahan"></span></td>
                            </tr>
                            <tr>
                                <th>Jumlah Bahan</th>
                                <td>: <span id="jmlh_permintaan"></span></td>
                            </tr>
                            <tr>
                                <th>Satuan</th>
                                <td>: <span id="satuan_bahan"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Permintaan Bahan</th>
                                <td>: <span id="tgl_permintaan"></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: <span id="status_permintaan"></span></td>
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
    $(document).on('click', '#btn-detail', function() {
        var id = $(this).data('idpermintaan');
        var bahan = $(this).data('namabahan');
        var jmlh = $(this).data('jmlhpermintaan');
        var tgl = $(this).data('tglpermintaan');
        var status = $(this).data('statuspenerimaan');
        var satuan = $(this).data('satuanpermintaan');
        $('.modal-body #id_permintaan').text(id);
        $('.modal-body #nama_bahan').text(bahan);
        $('.modal-body #jmlh_permintaan').text(jmlh);
        $('.modal-body #tgl_permintaan').text(tgl);
        $('.modal-body #status_permintaan').text(status);
        $('.modal-body #satuan_bahan').text(satuan);

    })

    $(document).on('click', '#btn-delete', function() {
        $('.modal-body #id_permintaan').val($(this).data(
            'id'));

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


<?= $this->endSection(); ?>