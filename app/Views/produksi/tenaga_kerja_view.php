<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Tenaga Kerja</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_produksi') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Tenaga Kerja</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Tenaga Kerja</strong></h3>
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
                                            data-target="#tambahModalTenagaKerja"><i
                                                class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Pegawai
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#tambahModalGaji"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Gaji
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Tenaga Kerja</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#datagaji" role="tab"
                                        aria-controls="home" aria-selected="false">Data Gaji Tenaga Kerja</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftartenaga"
                                        class="table table-md table-bordered table-hover table-responsive-md  text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Tenaga Kerja</th>
                                                <th scope="col">Jenis Tenaga Kerja</th>
                                                <th scope="col">Tarif</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark  bg-light">
                                            <tr>
                                                <?php foreach($datatenagakerja as $row) : ?>
                                                <td> <?= $row['id_tenaga_kerja'];?>
                                                </td>
                                                <td> <?= $row['jenis_tenaga_kerja'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['tarif'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editPegawai" id="btn-edit"
                                                        data-idpegawai="<?= $row['id_tenaga_kerja']; ?>"
                                                        data-tarifpeg="<?=$row['tarif']; ?>">
                                                        Edit
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                                        id="btn-hapus" class="btn btn-success"
                                                        data-id="<?= $row['id_tenaga_kerja']; ?>"> Hapus </button> -->
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="datagaji" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="databiayagaji"
                                        class="table table-md table-hover table-responsive-md table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Gaji</th>
                                                <th scope="col">Jenis Pekerjaan</th>
                                                <th scope="col">Gaji</th>
                                                <th scope="col">Tanggal Bayar Gaji</th>
                                                <!-- <th scope="col">Action</th> -->

                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datagaji as $row) : ?>
                                                <td> <?= $row['id_gaji'];?>
                                                </td>
                                                <td> <?= $row['jenis_tenaga_kerja'];?>
                                                </td>
                                                <td> Rp. <?= number_format($row['total_gaji'],0,',','.');?>
                                                </td>
                                                <td> <?= date_indo($row['tgl_bayar']);?>
                                                </td>
                                                <!-- <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modalHapusGaji" id="btn-hapusGaji"
                                                        class="btn btn-success" data-id="<?= $row['id_gaji']; ?>"> Hapus
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

<form method="POST" action="<?= base_url('produksi/edit_tenaga_kerja') ?>">
    <div class="modal fade" id="editPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data Tenaga Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Tarif</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tarif" id="tarif">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_tenaga_kerja" name="id_tenaga_kerja">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onClick="window.location.reload();">Close</button>
                        <button type="submit" class="btn btn-primary" name="update"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('produksi/tenaga_kerja') ?>">
    <div class="modal fade" id="tambahModalTenagaKerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Tenaga Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Tenaga Kerja</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_tenaga_kerja" id="id_tenaga_kerja"
                                    value="<?= $getidtenagakerja?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jenis Tenaga Kerja</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jenis_tenaga_kerja"
                                    id="jenis_tenaga_kerja">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tarif</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tarif" id="tarif">
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

<form method="POST" action="<?= base_url('produksi/daftar_gaji') ?>">
    <div class="modal fade" id="tambahModalGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Gaji Tenaga Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Gaji</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_gaji" id="id_gaji"
                                    value="<?= $getidgaji?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">ID Operation List</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_operation" name="id_operation">
                                    <?php foreach($dataoperationlist as $row) : ?>
                                    <option value="<?=$row['id_operation'];?>">
                                        <?=$row['id_operation'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Tanggal Bayar</label>
                            <div class="col-sm-6">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input placeholder="Select date" type="date" id="tgl_bayar" name="tgl_bayar"
                                        class="form-control">
                                </div>
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


<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_tenaga_kerja') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Tenaga Kerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Tenaga Kerja?</h5>
                        <input type="hidden" id="id_tenaga_kerja" name="id_tenaga_kerja">
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

<div class="modal fade" id="modalHapusGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('produksi/delete_gaji') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete Gaji Tenaga Kerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data Gaji?</h5>
                        <input type="hidden" id="id_gaji" name="id_gaji">
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
    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('idpegawai');
        var tarif = $(this).data('tarifpeg');
        $('.modal-footer #id_tenaga_kerja').val(id);
        $('.modal-body #tarif').val(tarif);
    })

    $(document).on('click', '#btn-selesai', function() {
        var id = $(this).data('idpenjualan');
        var customer = $(this).data('namacustomer');
        var alamat = $(this).data('alamatcustomer');
        var telp = $(this).data('notelp');
        var barang = $(this).data('namabarang');
        var jmlh = $(this).data('jmlhbarang');
        var merchant = $(this).data('namamerchant');
        var ekspedisi = $(this).data('namaekspedisi');
        var resi = $(this).data('noresi');
        var tgl = $(this).data('retur');
        $('.modal-body #id_penjualan').val(id);
        $('.modal-body #nama_customer').val(customer);
        $('.modal-body #alamat').val(alamat);
        $('.modal-body #no_telp').val(telp);
        $('.modal-body #nama_barang').val(barang);
        $('.modal-body #jmlh_barang').val(jmlh);
        $('.modal-body #nama_merchant').val(merchant);
        $('.modal-body #nama_ekspedisi').val(ekspedisi);
        $('.modal-body #no_resi').val(resi);
        $('.modal-body #tgl_retur').val(tgl);
    })

    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_tenaga_kerja').val($(this).data('id'));

    })
    $(document).on('click', '#btn-hapusGaji', function() {
        $('.modal-body #id_gaji').val($(this).data('id'));

    })

})
</script>

<script>
$(document).ready(function() {
    $('#daftartenaga').DataTable({
        responsive: true
    });
    $('#databiayagaji').DataTable({
        responsive: true
    });
});
</script>

<?= $this->endSection();?>